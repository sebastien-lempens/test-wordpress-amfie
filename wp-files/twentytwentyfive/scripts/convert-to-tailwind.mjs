import { readFileSync, writeFileSync, readdirSync, statSync } from 'node:fs';
import { join } from 'node:path';

const ROOT = new URL('..', import.meta.url).pathname.replace(/^\/([A-Za-z]:)/, '$1');
const DIRS = ['templates', 'parts', 'patterns'];
const FONT_SIZES = ['small', 'medium', 'large', 'x-large', 'xx-large'];
const FONT_FAMILIES = { manrope: 'font-sans', 'fira-code': 'font-mono' };

const report = { files: 0, blocks: 0, converted: 0, skipped: [], kept: {} };
const esc = (s) => s.replace(/[.*+?^${}()|[\]\\]/g, '\\$&');
const keptOnce = (k) => { report.kept[k] = (report.kept[k] ?? 0) + 1; };

const walk = (dir) =>
	readdirSync(dir).flatMap((e) => {
		const p = join(dir, e);
		return statSync(p).isDirectory() ? walk(p) : /\.(html|php)$/.test(e) ? [p.replaceAll('\\', '/')] : [];
	});

function findMatchingBrace(src, start) {
	let depth = 0, str = false;
	for (let i = start; i < src.length; i++) {
		const c = src[i];
		if (str) c === '\\' ? i++ : c === '"' && (str = false);
		else if (c === '"') str = true;
		else if (c === '{') depth++;
		else if (c === '}' && --depth === 0) return i;
	}
	return -1;
}

// value may arrive as serialized ("var:preset|spacing|30") or resolved ("var(--wp--preset--spacing--30)")
const PRE = (type, prop) => new RegExp(`^(?:var\\(--wp--preset--${type}--([\\w-]+)\\)|var:preset\\|${type}\\|([\\w-]+))$`);
const spacingTok = (v) => {
	const m = PRE().exec(v) ?? null;
	const mm = /^(?:var\(--wp--preset--spacing--(\w+)\)|var:preset\|spacing\|(\w+))$/.exec(v);
	if (mm) return mm[1] ?? mm[2];
	if (/^0(px)?$/.test(v)) return '0';
	return /^-?\d*\.?\d+(px|rem|em|%|vh|vw|ch|ex)$/.test(v) ? `[${v}]` : null;
};
const presetColor = (v) => {
	const m = /^(?:var\(--wp--preset--color--([\w-]+)\)|var:preset\|color\|([\w-]+))$/.exec(v);
	if (m) return m[1] ?? m[2];
	return /^#[0-9a-fA-F]{3,8}$/.test(v) ? `[${v.toLowerCase()}]` : null;
};
const lenUtil = (prefix, v, special = {}) =>
	special[v] ?? (/^-?\d*\.?\d+(\.\d+)?(px|rem|em|%|vh|vw|ch|ex)?$/.test(v) ? `${prefix}-[${v}]` : /^(clamp|calc|var)\(/.test(v) ? `${prefix}-[length:${v.replaceAll(' ', '_')}]` : null);

function convert(attrs) {
	const classes = [];
	const strip = []; // regexes removing inline decls from saved HTML
	const rmClass = []; // literal WP companion classes to delete
	let keepAny = false;

	const cssDecl = (prop, valRaw) =>
		new RegExp(`(?<=^|["';])\\s*${prop}\\s*:\\s*${esc(valRaw)}\\s*(?=;|")`, 'g');

	const boxUtil = (decl, sideMap, box, cssProp) => {
		for (const [side, raw] of Object.entries(box)) {
			const tok = spacingTok(String(raw));
			if (!tok) { keptOnce(`${decl}.${side}`); keepAny = true; continue; }
			classes.push(`${sideMap[side]}-${tok}`);
			strip.push(new RegExp(`(?<=^|["';])\\s*${cssProp}-${side.replace(/([A-Z])/g, '-$1').toLowerCase()}\\s*:\\s*(?:var\\(--wp--preset--spacing--[\\w-]+\\)|${esc(String(raw))})\\s*(?=;|")`, 'g'));
			delete box[side];
		}
	};

	const st = attrs.style;
	if (st?.spacing) {
		st.spacing.padding && boxUtil('padding', { top: 'pt', bottom: 'pb', left: 'pl', right: 'pr' }, st.spacing.padding, 'padding');
		st.spacing.margin && boxUtil('margin', { top: 'mt', bottom: 'mb', left: 'ml', right: 'mr' }, st.spacing.margin, 'margin');
		if (st.spacing.blockGap != null) {
			const lt = String(attrs.layout?.type ?? '');
			if (/flex|grid/.test(lt)) {
				const tok = spacingTok(String(st.spacing.blockGap));
				if (tok) {
					classes.push(`gap-${tok}`);
					strip.push(new RegExp(`(?<=^|["';])\\s*gap\\s*:\\s*(?:var\\(--wp--preset--spacing--[\\w-]+\\)|${esc(String(st.spacing.blockGap))})\\s*(?=;|")`, 'g'));
				} else { keptOnce('blockGap'); keepAny = true; }
				delete st.spacing.blockGap;
			} else keptOnce('blockGap-non-flex');
		}
		if (!Object.keys(st.spacing).length) delete st.spacing;
	}

	const ty = st?.typography;
	if (ty) {
		const T = [['fontSize', 'font-size'], ['fontFamily', 'font-family'], ['fontWeight', 'font-weight'], ['fontStyle', 'font-style'], ['letterSpacing', 'letter-spacing'], ['lineHeight', 'line-height'], ['textTransform', 'text-transform'], ['textDecoration', 'text-decoration']];
		const emitDeclStrip = (attrKey, cssProp, raw) => strip.push(cssDecl(cssProp, String(raw)));

		if (ty.fontSize != null) {
			FONT_SIZES.includes(ty.fontSize)
				? (classes.push(`text-${ty.fontSize}`), rmClass.push(`has-${ty.fontSize}-font-size`))
				: lenUtil('text', String(ty.fontSize))
					? (classes.push(lenUtil('text', String(ty.fontSize))), emitDeclStrip('fontSize', 'font-size', ty.fontSize))
					: (keptOnce('fontSize=' + ty.fontSize), (keepAny = true));
			delete ty.fontSize;
		}
		if (ty.fontFamily != null) {
			FONT_FAMILIES[ty.fontFamily]
				? (classes.push(FONT_FAMILIES[ty.fontFamily]), rmClass.push(`has-${ty.fontFamily}-font-family`))
				: (keptOnce('fontFamily=' + ty.fontFamily), (keepAny = true));
			delete ty.fontFamily;
		}
		if (ty.fontWeight != null) {
			const w = String(ty.fontWeight);
			w === 'normal' ? classes.push('font-normal') : w === 'bold' ? classes.push('font-bold') : /^\d{3}$/.test(w) ? classes.push(`font-[${w}]`) : (keptOnce('fontWeight=' + w), (keepAny = true));
			emitDeclStrip('fontWeight', 'font-weight', w);
			delete ty.fontWeight;
		}
		if (ty.fontStyle != null) {
			ty.fontStyle === 'italic' ? classes.push('italic') : ty.fontStyle === 'normal' ? classes.push('not-italic') : (keptOnce('fontStyle'), (keepAny = true));
			emitDeclStrip('fontStyle', 'font-style', ty.fontStyle);
			delete ty.fontStyle;
		}
		if (ty.textTransform != null) {
			({ uppercase: 'uppercase', lowercase: 'lowercase', capitalize: 'capitalize', none: 'normal-case' })[ty.textTransform]
				? classes.push(({ uppercase: 'uppercase', lowercase: 'lowercase', capitalize: 'capitalize', none: 'normal-case' })[ty.textTransform])
				: (keptOnce('textTransform'), (keepAny = true));
			emitDeclStrip('textTransform', 'text-transform', ty.textTransform);
			delete ty.textTransform;
		}
		if (ty.textDecoration != null) {
			({ underline: 'underline', 'line-through': 'line-through', none: 'no-underline' })[ty.textDecoration]
				? classes.push(({ underline: 'underline', 'line-through': 'line-through', none: 'no-underline' })[ty.textDecoration])
				: (keptOnce('textDecoration'), (keepAny = true));
			emitDeclStrip('textDecoration', 'text-decoration', ty.textDecoration);
			delete ty.textDecoration;
		}
		if (ty.letterSpacing != null) {
			String(ty.letterSpacing) === 'normal' ? classes.push('tracking-normal') : lenUtil('tracking', String(ty.letterSpacing)) ? classes.push(lenUtil('tracking', String(ty.letterSpacing))) : (keptOnce('letterSpacing'), (keepAny = true));
			emitDeclStrip('letterSpacing', 'letter-spacing', ty.letterSpacing);
			delete ty.letterSpacing;
		}
		if (ty.lineHeight != null) {
			/^\d*\.?\d+$/.test(String(ty.lineHeight)) ? classes.push(`leading-[${ty.lineHeight}]`) : (keptOnce('lineHeight'), (keepAny = true));
			emitDeclStrip('lineHeight', 'line-height', ty.lineHeight);
			delete ty.lineHeight;
		}
		if (!Object.keys(ty).length) delete st.typography;
	}

	if (st?.color) {
		for (const [k, util, cssProp] of [['text', 'text', 'color'], ['background', 'bg', 'background-color']]) {
			if (st.color[k] == null) continue;
			const pc = presetColor(String(st.color[k]));
			if (pc) {
				classes.push(`${util}-${pc}`);
				if (!pc.startsWith('[')) {
					rmClass.push(k === 'text' ? `has-${pc}-color` : `has-${pc}-background-color`);
					rmClass.push(k === 'text' ? 'has-text-color' : 'has-background');
				} else strip.push(new RegExp(`(?<=^|["';])\\s*${cssProp}\\s*:\\s*${esc(pc.slice(1, -1))}\\s*(?=;|")`, 'g'));
			} else { keptOnce(`color.${k}`); keepAny = true; }
			delete st.color[k];
		}
		for (const k of ['gradient', 'link', 'caption', 'button', 'heading', 'cite']) if (st.color[k] != null) { keptOnce('color.' + k); delete st.color[k]; }
		if (!Object.keys(st.color).length) delete st.color;
	}

	if (st?.border) {
		const b = st.border;
		const R = { topLeft: 'tl', topRight: 'tr', bottomRight: 'br', bottomLeft: 'bl' };
		if (b.radius != null) {
			if (typeof b.radius !== 'object') {
				String(b.radius) === '0'
					? classes.push('rounded-none')
					: lenUtil('rounded', String(b.radius))
						? (classes.push(lenUtil('rounded', String(b.radius))), strip.push(cssDecl('border-radius', b.radius)))
						: (keptOnce('border.radius'), (keepAny = true));
			} else
				for (const [k, sfx] of Object.entries(R))
					b.radius[k] != null &&
						(lenUtil(`rounded-${sfx}`, String(b.radius[k]))
							? (classes.push(lenUtil(`rounded-${sfx}`, String(b.radius[k]))), strip.push(cssDecl(`border-${k.replace(/([A-Z])/g, '-$1').toLowerCase()}-radius`, b.radius[k])))
							: (keptOnce('border.radius.' + k), (keepAny = true)));
			delete b.radius;
		}
		if (b.width != null) {
			lenUtil('border', String(b.width), { '0': 'border-0', '0px': 'border-0' })
				? (classes.push(lenUtil('border', String(b.width), { '0': 'border-0', '0px': 'border-0' })), strip.push(cssDecl('border-width', b.width)))
				: (keptOnce('border.width'), (keepAny = true));
			delete b.width;
		}
		if (b.color != null) {
			const pc = presetColor(String(b.color));
			pc
				? (classes.push(`border-${pc}`), !pc.startsWith('[') && (rmClass.push(`has-${pc}-border-color`), rmClass.push('has-border-color')), strip.push(new RegExp(`(?<=^|["';])\\s*border-color\\s*:\\s*(?:var\\(--wp--preset--color--[\\w-]+\\)|${esc(String(b.color))})\\s*(?=;|")`, 'g')))
				: (keptOnce('border.color'), (keepAny = true));
			delete b.color;
		}
		const SIDES = { top: ['t', 'top'], right: ['r', 'right'], bottom: ['b', 'bottom'], left: ['l', 'left'] };
		for (const [side, [sfx, css]] of Object.entries(SIDES)) {
			if (!b[side] || typeof b[side] !== 'object') continue;
			if (b[side].color != null) {
				const pc = presetColor(String(b[side].color));
				pc ? classes.push(pc.startsWith('[') ? `border-${sfx}-${pc}` : `border-${sfx}-${pc}`) : (keptOnce('border.' + side + '.color'), (keepAny = true));
				strip.push(new RegExp(`(?<=^|["';])\\s*border-${css}-color\\s*:\\s*(?:var\\(--wp--preset--color--[\\w-]+\\)|${esc(String(b[side].color))})\\s*(?=;|")`, 'g'));
			}
			if (b[side].width != null) {
				String(b[side].width) === '0' ? classes.push(`border-${sfx}-0`) : String(b[side].width) === '1px' ? classes.push(`border-${sfx}`) : classes.push(`border-${sfx}-[${b[side].width}]`);
				strip.push(new RegExp(`(?<=^|["';])\\s*border-${css}-width\\s*:\\s*${esc(String(b[side].width))}\\s*(?=;|")`, 'g'));
			}
			delete b[side];
		}
		delete b.style;
		if (!Object.keys(b).length) delete st.border;
	}

	if (st?.dimensions) {
		const d = st.dimensions;
		const conf = { minHeight: ['min-h', { '100vh': 'min-h-screen', '100%': 'min-h-full' }, 'min-height'], width: ['w', { '100%': 'w-full' }, 'width'], maxWidth: ['max-w', {}, 'max-width'], maxHeight: ['max-h', {}, 'max-height'] };
		for (const k of Object.keys(conf)) {
			if (d[k] == null || d[k] === '') continue;
			const u = lenUtil(conf[k][0], String(d[k]), conf[k][1]);
			u ? (classes.push(u), strip.push(cssDecl(conf[k][2], d[k]))) : (keptOnce(k), (keepAny = true));
			delete d[k];
		}
		if (!Object.keys(d).length) delete st.dimensions;
	}

	if (st?.position) {
		st.position.sticky === true && classes.push('sticky');
		delete st.position;
	}
	if (attrs.style && !Object.keys(attrs.style).length) delete attrs.style;

	for (const key of ['fontSize', 'fontFamily']) {
		if (attrs[key] == null) continue;
		key === 'fontSize'
			? FONT_SIZES.includes(attrs[key])
				? (classes.push(`text-${attrs[key]}`), rmClass.push(`has-${attrs[key]}-font-size`))
				: (keptOnce('attr.fontSize'), (keepAny = true))
			: FONT_FAMILIES[attrs[key]]
				? (classes.push(FONT_FAMILIES[attrs[key]]), rmClass.push(`has-${attrs[key]}-font-family`))
				: (keptOnce('attr.fontFamily'), (keepAny = true));
		delete attrs[key];
	}
	if (attrs.textColor != null) { classes.push(`text-${attrs.textColor}`); rmClass.push(`has-${attrs.textColor}-color`, 'has-text-color'); delete attrs.textColor; }
	if (attrs.backgroundColor != null) { classes.push(`bg-${attrs.backgroundColor}`); rmClass.push(`has-${attrs.backgroundColor}-background-color`, 'has-background'); delete attrs.backgroundColor; }
	if (attrs.gradient != null) keptOnce('attr.gradient');
	if (attrs.aspectRatio != null) {
		const ar = String(attrs.aspectRatio);
		ar === 'square' || ar === '1'
			? (classes.push('aspect-square'), strip.push(cssDecl('aspect-ratio', ar)))
			: /^\d+\/\d+$/.test(ar)
				? (classes.push(`aspect-[${ar}]`), strip.push(cssDecl('aspect-ratio', ar)))
				: ar === 'auto'
					? classes.push('aspect-auto')
					: (keptOnce('aspectRatio=' + ar), (keepAny = true));
		delete attrs.aspectRatio;
	}

	return { classes: [...new Set(classes)], strip, rmClass: [...new Set(rmClass)], keepAny };
}

const pruneEmpty = (o) => {
	if (typeof o !== 'object' || o === null || Array.isArray(o)) return o;
	for (const k of Object.keys(o)) {
		pruneEmpty(o[k]);
		if (o[k] && typeof o[k] === 'object' && !Array.isArray(o[k]) && !Object.keys(o[k]).length) delete o[k];
	}
	return o;
};

for (const dir of DIRS) {
	for (const full of walk(join(ROOT, dir))) {
		let src = readFileSync(full, 'utf8');
		const origSrc = src;

		const blocks = [];
		const re = /<!--\s+wp:([\w/-]+)(?:\s+(\{))?/g;
		let m;
		while ((m = re.exec(src))) {
			report.blocks++;
			if (!m[2]) continue;
			const jsonStart = m.index + m[0].length - 1;
			const jsonEnd = findMatchingBrace(src, jsonStart);
			if (jsonEnd === -1) continue;
			try {
				blocks.push({ openStart: m.index, openEnd: src.indexOf('-->', jsonEnd) + 3, jsonStart, jsonEnd, name: m[1], attrs: JSON.parse(src.slice(jsonStart, jsonEnd + 1)) });
			} catch {
				report.skipped.push(`${dir}/${full.split(/[\\/]/).pop()}:${src.slice(0, m.index).split('\n').length} (${m[1]})`);
			}
		}

		for (const b of blocks.reverse()) {
			const short = b.name.split('/').pop();
			const cm = new RegExp(`<!--\\s*/wp:${short}\\s*-->`).exec(src.slice(b.openEnd));

			let r;
			try { r = convert(b.attrs); } catch { continue; }
			if (!r.classes.length && !r.keepAny) continue;

			if (cm) {
				let chunk = src.slice(b.openEnd, b.openEnd + cm.index);
				for (const rx of r.strip) chunk = chunk.replace(rx, '');
				for (const cls of r.rmClass) chunk = chunk.replaceAll(cls, '').replaceAll(`class="${cls}"`, '');
				chunk = chunk.replace(/\sclass="\s+"/g, ' ').replace(/class="([^"]*)\s{2,}([^"]*)"/g, 'class="$1 $2"');
				chunk = chunk.replace(/\s*style="\s*[;\s]*"/g, '');

				const objFit = /object-fit\s*:\s*(cover|contain)/.exec(chunk);
				if (objFit) {
					chunk = chunk.replace(/\s*object-fit\s*:\s*(cover|contain)\s*;?/g, '').replace(/\s*style="\s*[;\s]*"/g, '');
					r.classes.push(objFit[1] === 'cover' ? 'object-cover' : 'object-contain');
				}
				chunk = chunk.replace(/;\s*;+/g, ';');
				r.classes = [...new Set(r.classes)];

				const tag = /<([a-zA-Z][\w-]*)((?:[^>"']|"[^"]*"|'[^']*')*)>/.exec(chunk);
				if (tag) {
					let t = tag[0];
					const cAttr = /class="([^"]*)"/.exec(t);
					if (cAttr) {
						const ex = cAttr[1].split(/\s+/).filter(Boolean);
						t = t.replace(cAttr[0], `class="${[...ex, ...r.classes.filter((c) => !ex.includes(c))].join(' ')}"`);
					} else t = t.replace(/^<([a-zA-Z][\w-]*)/, `<$1 class="${r.classes.join(' ')}"`);
					chunk = chunk.slice(0, tag.index) + t + chunk.slice(tag.index + tag[0].length);
				}

				const exCls = String(b.attrs.className ?? '').split(/\s+/).filter(Boolean);
				b.attrs.className = [...new Set([...exCls, ...r.classes.filter((c) => !exCls.includes(c))])].join(' ');
				const newJson = JSON.stringify(pruneEmpty(b.attrs));
				src = src.slice(0, b.jsonStart) + newJson + ' -->' + chunk + src.slice(b.openEnd + cm.index);
			} else {
				const exCls = String(b.attrs.className ?? '').split(/\s+/).filter(Boolean);
				b.attrs.className = [...new Set([...exCls, ...r.classes.filter((c) => !exCls.includes(c))])].join(' ');
				src = src.slice(0, b.jsonStart) + JSON.stringify(pruneEmpty(b.attrs)) + src.slice(b.jsonEnd + 1);
			}
			report.converted++;
		}

		if (src !== origSrc) { writeFileSync(full, src); report.files++; }
	}
}

console.log(JSON.stringify({ fichiers_modifies: report.files, blocs_traites: report.blocks, blocs_convertis: report.converted, ignores_JSON_PHP: report.skipped.length, exemples_ignores: [...new Set(report.skipped)].slice(0, 12), styles_conserves_par_categorie: report.kept }, null, 2));
