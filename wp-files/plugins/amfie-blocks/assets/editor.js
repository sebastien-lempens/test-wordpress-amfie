/**
 * AMFIE Blocks — éditeur (sans build).
 * Les blocs sont déclarés côté PHP (block.json) ; ici on ne fournit que edit/save,
 * pilotés par une spec générée (champs inline RichText + réglages dans la sidebar).
 */
( function ( wp ) {
	const { registerBlockType } = wp.blocks;
	const { createElement: el, Fragment } = wp.element;
	const { RichText, PlainText, InnerBlocks, InspectorControls, useBlockProps, MediaUpload, MediaUploadCheck } = wp.blockEditor;
	const { PanelBody, TextControl, RangeControl, SelectControl, ToggleControl, Button } = wp.components;
	const { useSelect } = wp.data;
	const { decodeEntities } = wp.htmlEntities;

	const SPEC = {
 "amfie/page-header": {
  "title": "En-tête de page",
  "rich": [
   [
    "title",
    "h1",
    "Titre de la page"
   ],
   [
    "subtitle",
    "p",
    "Sous-titre (optionnel)"
   ]
  ],
  "side": [
   [
    "homeLabel",
    "text",
    "Libellé « Accueil »"
   ],
   [
    "crumbLabel",
    "text",
    "Parent (libellé)"
   ],
   [
    "crumbUrl",
    "url",
    "Parent (URL)"
   ]
  ],
  "inner": null
 },
 "amfie/hero": {
  "title": "Hero d’accueil",
  "rich": [
   [
    "title",
    "h1",
    "Titre du hero"
   ],
   [
    "subtitle",
    "p",
    "Sous-titre (optionnel)"
   ]
  ],
  "side": [
   [
    "imageUrl",
    "image",
    "Image de fond"
   ]
  ],
  "inner": {
   "allowed": [
    "amfie/quick-links"
   ],
   "template": [
    [
     "amfie/quick-links"
    ]
   ]
  }
 },
 "amfie/quick-links": {
  "title": "Liens rapides",
  "rich": [
   [
    "title",
    "h2",
    "Titre de la boîte"
   ]
  ],
  "side": [],
  "inner": {
   "allowed": [
    "amfie/link-button"
   ],
   "template": [
    [
     "amfie/link-button",
     {
      "style": "outline"
     }
    ],
    [
     "amfie/link-button",
     {
      "style": "outline"
     }
    ]
   ],
   "orientation": "horizontal"
  }
 },
 "amfie/link-button": {
  "title": "Bouton / lien",
  "rich": [
   [
    "label",
    "span",
    "Libellé"
   ]
  ],
  "side": [
   [
    "linkType",
    "linktype",
    "Type de lien"
   ],
   [
    "pageId",
    "page",
    "Page du site"
   ],
   [
    "url",
    "url",
    "URL"
   ],
   [
    "anchor",
    "anchor",
    "Ancre"
   ],
   [
    "style",
    "select",
    "Style",
    [
     [
      "solid",
      "Plein"
     ],
     [
      "outline",
      "Contour"
     ],
     [
      "ghost",
      "Lien"
     ]
    ]
   ]
  ],
  "inner": null
 },
 "amfie/intro": {
  "title": "Présentation (texte + image)",
  "rich": [
   [
    "title",
    "h2",
    "Titre"
   ],
   [
    "text",
    "p",
    "Texte"
   ],
   [
    "buttonLabel",
    "span",
    "Libellé du bouton"
   ]
  ],
  "side": [
   [
    "buttonUrl",
    "url",
    "URL du bouton"
   ],
   [
    "imageUrl",
    "image",
    "Image"
   ],
   [
    "reverse",
    "toggle",
    "Image à gauche"
   ]
  ],
  "inner": null
 },
 "amfie/feature-grid": {
  "title": "Grille de cartes",
  "rich": [
   [
    "title",
    "h2",
    "Titre de la section"
   ],
   [
    "intro",
    "p",
    "Introduction (optionnelle)"
   ]
  ],
  "side": [
   [
    "columns",
    "range",
    "Colonnes",
    [
     1,
     4
    ]
   ],
   [
    "variant",
    "select",
    "Variante",
    [
     [
      "cards",
      "Cartes"
     ],
     [
      "plain",
      "Simple"
     ],
     [
      "numbered",
      "Numérotée"
     ]
    ]
   ]
  ],
  "inner": {
   "allowed": [
    "amfie/feature-card"
   ],
   "template": [
    [
     "amfie/feature-card"
    ],
    [
     "amfie/feature-card"
    ],
    [
     "amfie/feature-card"
    ]
   ],
   "orientation": "horizontal"
  }
 },
 "amfie/feature-card": {
  "title": "Carte",
  "rich": [
   [
    "title",
    "h3",
    "Titre"
   ],
   [
    "text",
    "p",
    "Texte"
   ],
   [
    "linkLabel",
    "span",
    "Libellé du lien (ex. En savoir plus)"
   ]
  ],
  "side": [
   [
    "icon",
    "text",
    "Icône (emoji ou texte court)"
   ],
   [
    "url",
    "url",
    "URL du lien"
   ]
  ],
  "inner": null
 },
 "amfie/stats": {
  "title": "Chiffres clés",
  "rich": [
   [
    "title",
    "h2",
    "Titre (ex. AMFIE en chiffres)"
   ]
  ],
  "side": [],
  "inner": {
   "allowed": [
    "amfie/stat"
   ],
   "template": [
    [
     "amfie/stat"
    ],
    [
     "amfie/stat"
    ],
    [
     "amfie/stat"
    ],
    [
     "amfie/stat"
    ]
   ],
   "orientation": "horizontal"
  }
 },
 "amfie/stat": {
  "title": "Chiffre clé",
  "rich": [
   [
    "value",
    "p",
    "Valeur (ex. +8000)"
   ],
   [
    "label",
    "p",
    "Libellé"
   ]
  ],
  "side": [],
  "inner": null
 },
 "amfie/text-section": {
  "title": "Section de texte",
  "rich": [
   [
    "title",
    "h2",
    "Titre de la section"
   ],
   [
    "subtitle",
    "p",
    "Sous-titre (facultatif)"
   ]
  ],
  "side": [
   [
    "variant",
    "select",
    "Variante",
    [
     [
      "default",
      "Standard"
     ],
     [
      "highlight",
      "Fond coloré"
     ],
     [
      "narrow",
      "Colonne étroite"
     ]
    ]
   ]
  ],
  "inner": {
   "allowed": [
    "core/paragraph",
    "core/heading",
    "core/list",
    "core/table",
    "core/image",
    "core/quote",
    "core/buttons",
    "core/separator",
    "core/columns",
    "amfie/link-button"
   ],
   "template": [
    [
     "core/paragraph",
     {
      "placeholder": "Votre contenu…"
     }
    ]
   ]
  }
 },
 "amfie/checklist": {
  "title": "Liste d’avantages + boutons",
  "rich": [
   [
    "title",
    "h2",
    "Titre"
   ],
   [
    "items",
    "plain",
    "Un avantage par ligne"
   ],
   [
    "primaryLabel",
    "span",
    "Bouton principal"
   ],
   [
    "secondaryLabel",
    "span",
    "Bouton secondaire"
   ]
  ],
  "side": [
   [
    "primaryUrl",
    "url",
    "URL bouton principal"
   ],
   [
    "secondaryUrl",
    "url",
    "URL bouton secondaire"
   ]
  ],
  "inner": null
 },
 "amfie/digital-process": {
  "title": "Processus 100 % digital",
  "rich": [
   [
    "title",
    "h2",
    "Titre"
   ],
   [
    "text",
    "p",
    "Texte"
   ],
   [
    "steps",
    "plain",
    "Une étape par ligne"
   ],
   [
    "primaryLabel",
    "span",
    "Bouton principal"
   ],
   [
    "secondaryLabel",
    "span",
    "Bouton secondaire"
   ]
  ],
  "side": [
   [
    "primaryUrl",
    "url",
    "URL bouton principal"
   ],
   [
    "secondaryUrl",
    "url",
    "URL bouton secondaire"
   ]
  ],
  "inner": null
 },
 "amfie/news-list": {
  "title": "Liste d’actualités",
  "rich": [
   [
    "title",
    "h2",
    "Titre (ex. Vous pourriez aussi être intéressé par)"
   ],
   [
    "buttonLabel",
    "span",
    "Libellé du bouton (optionnel)"
   ]
  ],
  "side": [
   [
    "count",
    "range",
    "Nombre d’articles",
    [
     1,
     12
    ]
   ],
   [
    "buttonUrl",
    "url",
    "URL du bouton"
   ]
  ],
  "inner": null
 },
 "amfie/faq": {
  "title": "FAQ",
  "rich": [
   [
    "title",
    "h2",
    "Titre de la FAQ"
   ],
   [
    "subtitle",
    "p",
    "Sous-titre (facultatif)"
   ]
  ],
  "side": [],
  "inner": {
   "allowed": [
    "amfie/faq-item"
   ],
   "template": [
    [
     "amfie/faq-item"
    ],
    [
     "amfie/faq-item"
    ]
   ]
  }
 },
 "amfie/faq-item": {
  "title": "Question FAQ",
  "rich": [
   [
    "question",
    "h3",
    "Question"
   ],
   [
    "answer",
    "p",
    "Réponse"
   ]
  ],
  "side": [],
  "inner": null
 },
 "amfie/contact-cta": {
  "title": "Appel à contact",
  "rich": [
   [
    "title",
    "h2",
    "Titre"
   ],
   [
    "buttonLabel",
    "span",
    "Libellé du bouton"
   ]
  ],
  "side": [
   [
    "buttonUrl",
    "url",
    "URL du bouton"
   ]
  ],
  "inner": null
 },
 "amfie/contact-card": {
  "title": "Coordonnées",
  "rich": [
   [
    "title",
    "h2",
    "Titre"
   ],
   [
    "text",
    "p",
    "Texte (optionnel)"
   ],
   [
    "address",
    "plain",
    "Adresse (une ligne par ligne)"
   ]
  ],
  "side": [
   [
    "phone",
    "text",
    "Téléphone"
   ],
   [
    "email",
    "text",
    "E-mail"
   ],
   [
    "linkedin",
    "url",
    "URL LinkedIn"
   ]
  ],
  "inner": null
 },
 "amfie/link-list": {
  "title": "Liste de liens / documents",
  "rich": [
   [
    "title",
    "h2",
    "Titre"
   ]
  ],
  "side": [],
  "inner": {
   "allowed": [
    "amfie/link-button"
   ],
   "template": [
    [
     "amfie/link-button",
     {
      "style": "ghost"
     }
    ],
    [
     "amfie/link-button",
     {
      "style": "ghost"
     }
    ]
   ]
  }
 }
};

	/**
	 * Sélecteur de pages WP filtré sur la langue de l'entrée en cours d'édition (Polylang expose `lang`
	 * sur le post et accepte `?lang=` sur /wp/v2/pages). À la lecture, le front re-traduit l'ID dans la langue courante.
	 */
	function PageSelect( { label, props } ) {
		const { attributes, setAttributes } = props;
		const lang = useSelect( ( select ) => {
			const ed = select( 'core/editor' );
			return ed && ed.getEditedPostAttribute ? ed.getEditedPostAttribute( 'lang' ) : undefined;
		}, [] );
		const pages = useSelect(
			( select ) => {
				const query = { per_page: -1, orderby: 'title', order: 'asc', _fields: 'id,title' };
				if ( lang ) {
					query.lang = lang;
				}
				return select( 'core' ).getEntityRecords( 'postType', 'page', query );
			},
			[ lang ]
		);
		const current = attributes.pageId || 0;
		const options = [ { value: 0, label: pages ? '— Aucune (URL personnalisée) —' : 'Chargement…' } ];
		( pages || [] ).forEach( ( p ) => options.push( { value: p.id, label: decodeEntities( p.title.rendered ) || '#' + p.id } ) );
		if ( pages && current && ! pages.some( ( p ) => p.id === current ) ) {
			options.push( { value: current, label: 'Page #' + current + ' (autre langue)' } );
		}
		return el( SelectControl, {
			label,
			value: current,
			options,
			help: 'Le lien suit la langue du visiteur (traduction Polylang).',
			onChange: ( v ) => {
				const id = parseInt( v, 10 ) || 0;
				const page = ( pages || [] ).find( ( p ) => p.id === id );
				const patch = { pageId: id };
				if ( page && ! ( attributes.label || '' ).trim() ) {
					patch.label = decodeEntities( page.title.rendered );
				}
				setAttributes( patch );
			},
		} );
	}

	/** Ancres (attribut `anchor`) présentes dans l'entrée en cours d'édition, y compris dans les blocs imbriqués. */
	function collectAnchors( blocks, out ) {
		blocks.forEach( ( b ) => {
			if ( b.attributes && b.attributes.anchor && b.name !== 'amfie/link-button' ) {
				out.push( b.attributes.anchor );
			}
			if ( b.innerBlocks && b.innerBlocks.length ) {
				collectAnchors( b.innerBlocks, out );
			}
		} );
		return out;
	}

	function AnchorField( { label, props, samePage } ) {
		const { attributes, setAttributes } = props;
		const anchors = useSelect( ( select ) => {
			const be = select( 'core/block-editor' );
			return be ? Array.from( new Set( collectAnchors( be.getBlocks(), [] ) ) ) : [];
		}, [] );
		return el(
			Fragment,
			null,
			el( TextControl, {
				label,
				value: attributes.anchor || '',
				list: 'amfie-anchors',
				placeholder: 'ex. tarifs',
				help: samePage
					? 'Id de la section cible sur cette page (Avancé > Ancre HTML du bloc visé). Sans « # ».'
					: 'Optionnel : ajoute #ancre à l’adresse de la page.',
				onChange: ( v ) => setAttributes( { anchor: v.replace( /^#/, '' ).replace( /\s+/g, '-' ) } ),
			} ),
			samePage ? el( 'datalist', { id: 'amfie-anchors' }, anchors.map( ( a ) => el( 'option', { key: a, value: a } ) ) ) : null
		);
	}

	/** Champs de lien visibles selon le type choisi (uniquement pour les blocs qui ont l'attribut linkType). */
	const LINK_FIELDS = { pageId: [ 'page' ], url: [ 'url' ], anchor: [ 'anchor', 'page' ] };

	function sideControl( props, [ key, type, label, opts ] ) {
		const { attributes, setAttributes } = props;
		if ( typeof attributes.linkType === 'string' && LINK_FIELDS[ key ] ) {
			const mode = attributes.linkType || ( attributes.pageId ? 'page' : 'url' );
			if ( ! LINK_FIELDS[ key ].includes( mode ) ) {
				return null;
			}
		}
		const set = ( v ) => setAttributes( { [ key ]: v } );
		switch ( type ) {
			case 'linktype':
				return el( SelectControl, {
					key,
					label,
					value: attributes.linkType || ( attributes.pageId ? 'page' : 'url' ),
					options: [
						{ value: 'page', label: 'Page du site' },
						{ value: 'anchor', label: 'Ancre sur cette page' },
						{ value: 'url', label: 'URL personnalisée' },
					],
					onChange: set,
				} );
			case 'anchor':
				return el( AnchorField, {
					key,
					label: ( attributes.linkType || ( attributes.pageId ? 'page' : 'url' ) ) === 'anchor' ? 'Ancre cible' : 'Ancre (optionnelle)',
					props,
					samePage: ( attributes.linkType || ( attributes.pageId ? 'page' : 'url' ) ) === 'anchor',
				} );
			case 'page':
				return el( PageSelect, { key, label, props } );
			case 'url':
				return el( TextControl, { key, label, type: 'url', value: attributes[ key ] || '', onChange: set, placeholder: 'https://… ou /page' } );
			case 'range':
				return el( RangeControl, { key, label, value: attributes[ key ], min: opts[ 0 ], max: opts[ 1 ], onChange: set } );
			case 'select':
				return el( SelectControl, { key, label, value: attributes[ key ], options: opts.map( ( [ value, l ] ) => ( { value, label: l } ) ), onChange: set } );
			case 'toggle':
				return el( ToggleControl, { key, label, checked: !! attributes[ key ], onChange: set } );
			case 'image':
				return el(
					MediaUploadCheck,
					{ key },
					el( 'div', { className: 'amfie-ed__media' },
						el( 'p', null, label ),
						attributes.imageUrl ? el( 'img', { src: attributes.imageUrl, alt: '', style: { maxWidth: '100%' } } ) : null,
						el( MediaUpload, {
							allowedTypes: [ 'image' ],
							value: attributes.imageId,
							onSelect: ( m ) => setAttributes( { imageUrl: m.url, imageId: m.id } ),
							render: ( { open } ) => el( Button, { variant: 'secondary', onClick: open }, attributes.imageUrl ? 'Changer l’image' : 'Choisir une image' ),
						} ),
						attributes.imageUrl ? el( Button, { variant: 'link', isDestructive: true, onClick: () => setAttributes( { imageUrl: '', imageId: 0 } ) }, 'Retirer' ) : null
					)
				);
			default:
				return el( TextControl, { key, label, value: attributes[ key ] || '', onChange: set } );
		}
	}

	function inlineField( props, [ key, tag, placeholder ] ) {
		const { attributes, setAttributes } = props;
		const onChange = ( v ) => setAttributes( { [ key ]: v } );
		if ( 'plain' === tag ) {
			return el( PlainText, { key, className: 'amfie-ed__plain', value: attributes[ key ] || '', onChange, placeholder } );
		}
		return el( RichText, {
			key,
			tagName: tag,
			className: 'amfie-ed__' + key,
			value: attributes[ key ] || '',
			onChange,
			placeholder,
			allowedFormats: [ 'core/bold', 'core/italic', 'core/link' ],
		} );
	}

	Object.entries( SPEC ).forEach( ( [ name, cfg ] ) => {
		const slug = name.split( '/' )[ 1 ];
		registerBlockType( name, {
			edit: ( props ) => {
				const blockProps = useBlockProps( { className: 'amfie-ed amfie-ed--' + slug } );
				const inner = cfg.inner
					? el( InnerBlocks, {
							allowedBlocks: cfg.inner.allowed,
							template: cfg.inner.template,
							orientation: cfg.inner.orientation,
					  } )
					: null;
				return el(
					Fragment,
					null,
					cfg.side.length
						? el( InspectorControls, null, el( PanelBody, { title: 'Réglages — ' + cfg.title, initialOpen: true }, cfg.side.map( ( s ) => sideControl( props, s ) ) ) )
						: null,
					el( 'div', blockProps, el( 'div', { className: 'amfie-ed__label' }, cfg.title ), cfg.rich.map( ( f ) => inlineField( props, f ) ), inner )
				);
			},
			save: () => ( cfg.inner ? el( InnerBlocks.Content ) : null ),
		} );
	} );
} )( window.wp );
