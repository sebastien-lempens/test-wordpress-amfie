<?php
/**
 * Définition de la structure du site AMFIE (pages, menus, contenus par défaut) en FR/EN.
 * Les pages sont composées exclusivement avec les blocs amfie/* afin que tout reste éditable et réorganisable.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/** Sérialise un bloc (conteneur ou feuille). */
function amfie_blk( string $name, array $attrs = [], string $inner = '' ): string {
	return get_comment_delimited_block_content( $name, $attrs, $inner ) . "\n\n";
}

function amfie_p( string $html ): string {
	return "<!-- wp:paragraph -->\n<p>" . $html . "</p>\n<!-- /wp:paragraph -->\n\n";
}

function amfie_list( array $items ): string {
	$li = '';
	foreach ( $items as $item ) {
		$li .= "<!-- wp:list-item -->\n<li>" . $item . "</li>\n<!-- /wp:list-item -->\n";
	}
	return "<!-- wp:list -->\n<ul class=\"wp-block-list\">" . $li . "</ul>\n<!-- /wp:list -->\n\n";
}

function amfie_cards( array $cards ): string {
	$out = '';
	foreach ( $cards as $c ) {
		$out .= amfie_blk( 'amfie/feature-card', $c );
	}
	return $out;
}

/**
 * Liste des pages. Chaque entrée : key, slug[en|fr], title[en|fr], section (clé du parent « fil d'Ariane »), body(callable).
 * body reçoit : $t(en, fr) traducteur, $u(key) URL relative, $r(name) bloc synchronisé, $L langue.
 */
function amfie_page_defs(): array {
	$product = static function ( callable $cfg ): callable {
		return static function ( $t, $u, $r, $L ) use ( $cfg ): string {
			$c = $cfg( $t, $u );
			$o  = amfie_blk(
				'amfie/page-header',
				[
					'title'      => $c['title'],
					'subtitle'   => $c['sub'],
					'homeLabel'  => $t( 'Home', 'Accueil' ),
					'crumbLabel' => $c['crumb'],
					'crumbUrl'   => $c['crumbUrl'],
				]
			);
			$o .= amfie_blk( 'amfie/text-section', [ 'title' => $c['whatTitle'] ], implode( '', array_map( 'amfie_p', $c['what'] ) ) );
			$o .= amfie_blk( 'amfie/feature-grid', [ 'title' => $t( 'Benefits', 'Avantages' ), 'columns' => count( $c['benefits'] ) > 3 ? 4 : 3 ], amfie_cards( $c['benefits'] ) );
			if ( ! empty( $c['more'] ) ) {
				$o .= amfie_blk( 'amfie/text-section', [ 'title' => $c['moreTitle'], 'variant' => 'highlight' ], $c['more'] );
			}
			$o .= $r( 'digital' ) . $r( 'contact' );
			return $o;
		};
	};

	$todo = static fn( $t ) => $t( 'Content to be completed with the client.', 'Contenu à compléter avec le client.' );

	return [
		// ───────────── Accueil ─────────────
		[
			'key'   => 'home',
			'slug'  => [ 'en' => 'home', 'fr' => 'accueil' ],
			'title' => [ 'en' => 'Home', 'fr' => 'Accueil' ],
			'body'  => static function ( $t, $u, $r ): string {
				$links = '';
				foreach ( [ 'manage-my-money' => [ 'Manage my money', 'Gérer mon argent' ], 'save-securely' => [ 'Save securely', 'Épargner en sécurité' ], 'invest' => [ 'Invest in financial markets', 'Investir sur les marchés financiers' ], 'retirement' => [ 'Prepare my retirement', 'Préparer ma retraite' ], 'children' => [ 'Prepare my children\'s future', 'Préparer l\'avenir de mes enfants' ], 'staff' => [ 'Offer AMFIE to my Staff', 'Proposer AMFIE à mon personnel' ] ] as $k => $l ) {
					$links .= amfie_blk( 'amfie/link-button', [ 'label' => $t( $l[0], $l[1] ), 'url' => $u( $k ), 'style' => 'outline' ] );
				}
				$o  = amfie_blk(
					'amfie/hero',
					[ 'title' => $t( 'Financial solutions for IGO Staff and consultants', 'Solutions financières pour le personnel et les consultants des OIG' ) ],
					amfie_blk( 'amfie/quick-links', [ 'title' => $t( 'How can we assist you ?', 'Comment pouvons-nous vous aider ?' ) ], $links )
				);
				$o .= amfie_blk(
					'amfie/intro',
					[
						'title'       => $t( 'AMFIE, a unique financial cooperative', 'AMFIE, une coopérative financière unique' ),
						'text'        => $t(
							'Founded in 1990 by 21 international civil servants, AMFIE now counts over 8,000 members from 146 organisations and manages assets exceeding 500 million euros.<br><br>Any active or retired staff member of an Intergovernmental Organization can join the cooperative, whether employed on a permanent or temporary basis or as a consultant.<br><br>AMFIE also extends its services to members’ families: spouses, partners and children.',
							'Fondée en 1990 par 21 fonctionnaires internationaux, AMFIE compte aujourd’hui plus de 8 000 membres issus de 146 organisations et gère plus de 500 millions d’euros d’actifs.<br><br>Tout agent en activité ou retraité d’une organisation intergouvernementale peut rejoindre la coopérative, qu’il soit employé à titre permanent, temporaire ou consultant.<br><br>AMFIE étend également ses services à la famille des membres : conjoints, partenaires et enfants.'
						),
						'buttonLabel' => $t( 'Learn more', 'En savoir plus' ),
						'buttonUrl'   => $u( 'who-are-we' ),
					]
				);
				$o .= amfie_blk(
					'amfie/feature-grid',
					[ 'title' => $t( 'Our 3 core principles', 'Nos 3 principes fondamentaux' ), 'variant' => 'numbered', 'columns' => 3 ],
					amfie_cards(
						[
							[ 'title' => $t( 'Secure management', 'Gestion sécurisée' ), 'text' => '' ],
							[ 'title' => $t( 'Equal treatment', 'Égalité de traitement' ), 'text' => '' ],
							[ 'title' => $t( 'Reduced fees', 'Frais réduits' ), 'text' => '' ],
						]
					)
				);
				$o .= amfie_blk(
					'amfie/feature-grid',
					[
						'title'   => $t( 'Manage your assets easily with multi-currency products', 'Gérez facilement votre patrimoine avec des produits multidevises' ),
						'intro'   => $t( 'Access accounts in 7 currencies, with low and transparent fees.', 'Accédez à des comptes en 7 devises, avec des frais bas et transparents.' ),
						'columns' => 4,
					],
					amfie_cards(
						[
							[ 'title' => $t( 'Credit card', 'Carte de crédit' ), 'text' => $t( 'Make secure payments during your travels.', 'Payez en toute sécurité lors de vos déplacements.' ), 'url' => $u( 'credit-card' ), 'linkLabel' => $t( 'Learn more', 'En savoir plus' ) ],
							[ 'title' => $t( 'Multi-currency savings account', 'Compte d’épargne multidevises' ), 'text' => $t( 'Grow your savings in the currency that matches your financial goals.', 'Faites fructifier votre épargne dans la devise qui correspond à vos objectifs.' ), 'url' => $u( 'multi-currency-savings-account' ), 'linkLabel' => $t( 'Learn more', 'En savoir plus' ) ],
							[ 'title' => $t( 'Child account 0-18', 'Compte enfant 0-18' ), 'text' => $t( 'Build up the capital that will support your children’s future projects.', 'Constituez le capital qui soutiendra les projets futurs de vos enfants.' ), 'url' => $u( 'child-account' ), 'linkLabel' => $t( 'Learn more', 'En savoir plus' ) ],
							[ 'title' => $t( 'Multi-currency current account', 'Compte courant multidevises' ), 'text' => $t( 'Manage your transactions and transfers easily, from one country to another.', 'Gérez facilement vos opérations et virements d’un pays à l’autre.' ), 'url' => $u( 'multi-currency-account' ), 'linkLabel' => $t( 'Learn more', 'En savoir plus' ) ],
						]
					)
				);
				$o .= amfie_blk(
					'amfie/checklist',
					[
						'title'          => $t( 'Access your account from anywhere and at any time', 'Accédez à votre compte partout et à tout moment' ),
						'items'          => $t(
							"Send instructions for withdrawal, international transfers, currency exchange and stock market orders\nView your accounts in real time\nView your investment portfolios\nAccess your account statements and monthly credit card statements",
							"Envoyez vos instructions de retrait, virements internationaux, opérations de change et ordres de bourse\nConsultez vos comptes en temps réel\nConsultez vos portefeuilles d’investissement\nAccédez à vos relevés de compte et relevés mensuels de carte de crédit"
						),
						'primaryLabel'   => $t( 'Download our app', 'Télécharger notre application' ),
						'primaryUrl'     => 'https://portal.amfie.org/',
						'secondaryLabel' => $t( 'Become a member', 'Devenir membre' ),
						'secondaryUrl'   => 'https://onboarding.amfie.org/',
					]
				);
				$o .= amfie_blk(
					'amfie/stats',
					[ 'title' => $t( 'AMFIE in numbers', 'AMFIE en chiffres' ) ],
					amfie_blk( 'amfie/stat', [ 'value' => '+8000', 'label' => $t( 'members', 'membres' ) ] ) .
					amfie_blk( 'amfie/stat', [ 'value' => '146', 'label' => $t( 'countries', 'pays' ) ] ) .
					amfie_blk( 'amfie/stat', [ 'value' => '132', 'label' => $t( 'intergovernmental organizations', 'organisations intergouvernementales' ) ] ) .
					amfie_blk( 'amfie/stat', [ 'value' => '500M', 'label' => $t( 'in assets under management', 'd’actifs sous gestion' ) ] )
				);
				$o .= amfie_blk( 'amfie/news-list', [ 'title' => $t( 'You may also be interested in', 'Vous pourriez aussi être intéressé par' ), 'count' => 3, 'buttonLabel' => $t( 'See more news', 'Voir plus d’actualités' ), 'buttonUrl' => $u( 'news' ) ] );
				$o .= $r( 'contact' );
				return $o;
			},
		],

		// ───────────── Pages « besoin » (hero cards) ─────────────
		[
			'key'   => 'manage-my-money',
			'slug'  => [ 'en' => 'manage-my-money', 'fr' => 'gerer-mon-argent' ],
			'title' => [ 'en' => 'Manage my money', 'fr' => 'Gérer mon argent' ],
			'body'  => static function ( $t, $u, $r ): string {
				$more = $t( 'Learn more', 'En savoir plus' );
				$o    = amfie_blk( 'amfie/page-header', [ 'title' => $t( 'Manage my money', 'Gérer mon argent' ), 'subtitle' => $t( 'Financial solutions for IGO Staff and consultants', 'Solutions financières pour le personnel et les consultants des OIG' ), 'homeLabel' => $t( 'Home', 'Accueil' ) ] );
				$o   .= amfie_blk(
					'amfie/feature-grid',
					[ 'columns' => 2 ],
					amfie_cards(
						[
							[ 'title' => $t( 'Multi-currency current account', 'Compte courant multidevises' ), 'text' => $t( 'Manage your assets effortlessly. No account maintenance fees, 7 currencies, fast and secure international transfers.', 'Gérez votre patrimoine sans effort. Sans frais de tenue de compte, 7 devises, virements internationaux rapides et sécurisés.' ), 'url' => $u( 'multi-currency-account' ), 'linkLabel' => $more ],
							[ 'title' => $t( 'Capitol Mastercard Gold Credit Card', 'Carte de crédit Capitol Mastercard Gold' ), 'text' => $t( 'Easily make payments and withdraw cash worldwide. Available in 4 currencies, insurance and travel assistance included.', 'Payez et retirez de l’argent partout dans le monde. Disponible en 4 devises, assurances et assistance voyage incluses.' ), 'url' => $u( 'credit-card' ), 'linkLabel' => $more ],
							[ 'title' => $t( 'Foreign exchange', 'Change' ), 'text' => $t( 'Easily convert your currencies at attractive market rates.', 'Convertissez facilement vos devises à des taux de marché attractifs.' ), 'url' => $u( 'foreign-exchange' ), 'linkLabel' => $more ],
							[ 'title' => $t( 'International transfers', 'Virements internationaux' ), 'text' => $t( 'Send money abroad quickly and securely.', 'Envoyez de l’argent à l’étranger rapidement et en toute sécurité.' ), 'url' => $u( 'international-transfers' ), 'linkLabel' => $more ],
						]
					)
				);
				return $o . $r( 'digital' ) . $r( 'contact' );
			},
		],
		[
			'key'   => 'save-securely',
			'slug'  => [ 'en' => 'save-securely', 'fr' => 'epargner-en-securite' ],
			'title' => [ 'en' => 'Save securely', 'fr' => 'Épargner en sécurité' ],
			'body'  => static function ( $t, $u, $r ): string {
				$more = $t( 'Learn more', 'En savoir plus' );
				$o    = amfie_blk( 'amfie/page-header', [ 'title' => $t( 'Save securely', 'Épargner en sécurité' ), 'homeLabel' => $t( 'Home', 'Accueil' ) ] );
				$o   .= amfie_blk(
					'amfie/feature-grid',
					[ 'columns' => 3 ],
					amfie_cards(
						[
							[ 'title' => $t( 'Multi-currency savings account', 'Compte d’épargne multidevises' ), 'text' => $t( 'Grow your savings in the currency that matches your financial goals.', 'Faites fructifier votre épargne dans la devise de vos objectifs.' ), 'url' => $u( 'multi-currency-savings-account' ), 'linkLabel' => $more ],
							[ 'title' => $t( 'AMFIX deposit', 'Dépôt AMFIX' ), 'text' => $t( 'A term deposit with a known return.', 'Un dépôt à terme au rendement connu.' ), 'url' => $u( 'term-deposit' ), 'linkLabel' => $more ],
							[ 'title' => $t( '0–18 child account', 'Compte enfant 0-18' ), 'text' => $t( 'Build up capital for your children’s future projects.', 'Constituez un capital pour les projets de vos enfants.' ), 'url' => $u( 'child-account' ), 'linkLabel' => $more ],
						]
					)
				);
				return $o . $r( 'digital' ) . $r( 'contact' );
			},
		],
		[
			'key'   => 'invest',
			'slug'  => [ 'en' => 'invest-in-financial-markets', 'fr' => 'investir-marches-financiers' ],
			'title' => [ 'en' => 'Invest in financial markets', 'fr' => 'Investir sur les marchés financiers' ],
			'body'  => static function ( $t, $u, $r ): string {
				$more = $t( 'Learn more', 'En savoir plus' );
				$o    = amfie_blk( 'amfie/page-header', [ 'title' => $t( 'Invest in financial markets', 'Investir sur les marchés financiers' ), 'homeLabel' => $t( 'Home', 'Accueil' ) ] );
				$o   .= amfie_blk(
					'amfie/feature-grid',
					[ 'columns' => 3 ],
					amfie_cards(
						[
							[ 'title' => $t( 'AMFUND Investment Plan', 'Plan d’investissement AMFUND' ), 'text' => $t( 'Regular investment in professionally managed funds from 50 EUR.', 'Investissement régulier dans des fonds gérés professionnellement dès 50 EUR.' ), 'url' => $u( 'amfund' ), 'linkLabel' => $more ],
							[ 'title' => $t( 'Provident Savings Plan', 'Plan d’épargne prévoyance' ), 'text' => '', 'url' => $u( 'provident-savings-plan' ), 'linkLabel' => $more ],
							[ 'title' => $t( 'External Investment Account', 'Compte d’investissement externe' ), 'text' => '', 'url' => $u( 'external-investment' ), 'linkLabel' => $more ],
						]
					)
				);
				return $o . $r( 'digital' ) . $r( 'contact' );
			},
		],
		[
			'key'   => 'by-your-side',
			'slug'  => [ 'en' => 'by-your-side', 'fr' => 'a-vos-cotes' ],
			'title' => [ 'en' => 'By your side', 'fr' => 'À vos côtés' ],
			'body'  => static function ( $t, $u, $r ): string {
				$more = $t( 'Learn more', 'En savoir plus' );
				$o    = amfie_blk( 'amfie/page-header', [ 'title' => $t( 'By your side', 'À vos côtés' ), 'subtitle' => $t( 'Financial solutions for IGO Staff and consultants', 'Solutions financières pour le personnel et les consultants des OIG' ), 'homeLabel' => $t( 'Home', 'Accueil' ) ] );
				$o   .= amfie_blk(
					'amfie/feature-grid',
					[ 'columns' => 3 ],
					amfie_cards(
						[
							[ 'title' => $t( 'Prepare my retirement', 'Préparer ma retraite' ), 'text' => '', 'url' => $u( 'retirement' ), 'linkLabel' => $more ],
							[ 'title' => $t( 'Prepare my children\'s future', 'Préparer l\'avenir de mes enfants' ), 'text' => '', 'url' => $u( 'children' ), 'linkLabel' => $more ],
							[ 'title' => $t( 'Offer AMFIE to my Staff', 'Proposer AMFIE à mon personnel' ), 'text' => '', 'url' => $u( 'staff' ), 'linkLabel' => $more ],
						]
					)
				);
				return $o . $r( 'contact' );
			},
		],
		[
			'key'   => 'retirement',
			'slug'  => [ 'en' => 'prepare-my-retirement', 'fr' => 'preparer-ma-retraite' ],
			'title' => [ 'en' => 'Prepare my retirement', 'fr' => 'Préparer ma retraite' ],
			'body'  => static function ( $t, $u, $r ) use ( $todo ): string {
				return amfie_blk( 'amfie/page-header', [ 'title' => $t( 'Prepare my retirement', 'Préparer ma retraite' ), 'homeLabel' => $t( 'Home', 'Accueil' ), 'crumbLabel' => $t( 'By your side', 'À vos côtés' ), 'crumbUrl' => $u( 'by-your-side' ) ] )
					. amfie_blk( 'amfie/text-section', [ 'title' => $t( 'Our retirement solutions', 'Nos solutions retraite' ) ], amfie_p( $todo( $t ) ) )
					. amfie_blk(
						'amfie/feature-grid',
						[ 'columns' => 2 ],
						amfie_cards(
							[
								[ 'title' => $t( 'Provident Savings Plan', 'Plan d’épargne prévoyance' ), 'text' => '', 'url' => $u( 'provident-savings-plan' ), 'linkLabel' => $t( 'Learn more', 'En savoir plus' ) ],
								[ 'title' => $t( 'AMFUND Investment Plan', 'Plan d’investissement AMFUND' ), 'text' => '', 'url' => $u( 'amfund' ), 'linkLabel' => $t( 'Learn more', 'En savoir plus' ) ],
							]
						)
					) . $r( 'contact' );
			},
		],
		[
			'key'   => 'children',
			'slug'  => [ 'en' => 'prepare-my-childrens-future', 'fr' => 'preparer-avenir-enfants' ],
			'title' => [ 'en' => 'Prepare my children\'s future', 'fr' => 'Préparer l\'avenir de mes enfants' ],
			'body'  => static function ( $t, $u, $r ) use ( $todo ): string {
				return amfie_blk( 'amfie/page-header', [ 'title' => $t( 'Prepare my children\'s future', 'Préparer l\'avenir de mes enfants' ), 'homeLabel' => $t( 'Home', 'Accueil' ), 'crumbLabel' => $t( 'By your side', 'À vos côtés' ), 'crumbUrl' => $u( 'by-your-side' ) ] )
					. amfie_blk( 'amfie/text-section', [ 'title' => $t( 'A cooperative for the whole family', 'Une coopérative pour toute la famille' ) ], amfie_p( $t( 'Joint account, 0-18 Child account, passing it on: your family can join AMFIE and access the same services, on the same terms.', 'Compte joint, compte enfant 0-18, transmission : votre famille peut rejoindre AMFIE et accéder aux mêmes services, aux mêmes conditions.' ) ) )
					. amfie_blk(
						'amfie/feature-grid',
						[ 'columns' => 2 ],
						amfie_cards( [ [ 'title' => $t( '0–18 child account', 'Compte enfant 0-18' ), 'text' => '', 'url' => $u( 'child-account' ), 'linkLabel' => $t( 'Learn more', 'En savoir plus' ) ] ] )
					) . $r( 'contact' );
			},
		],
		[
			'key'   => 'staff',
			'slug'  => [ 'en' => 'offer-amfie-to-my-staff', 'fr' => 'proposer-amfie-a-mon-personnel' ],
			'title' => [ 'en' => 'Offer AMFIE to my Staff', 'fr' => 'Proposer AMFIE à mon personnel' ],
			'body'  => static function ( $t, $u, $r ) use ( $todo ): string {
				return amfie_blk( 'amfie/page-header', [ 'title' => $t( 'Offer AMFIE to my Staff', 'Proposer AMFIE à mon personnel' ), 'homeLabel' => $t( 'Home', 'Accueil' ), 'crumbLabel' => $t( 'By your side', 'À vos côtés' ), 'crumbUrl' => $u( 'by-your-side' ) ] )
					. amfie_blk( 'amfie/text-section', [ 'title' => $t( 'For HR departments of international organisations', 'Pour les services RH des organisations internationales' ) ], amfie_p( $todo( $t ) ) )
					. $r( 'contact' );
			},
		],

		// ───────────── Produits : Gérer mon argent ─────────────
		[
			'key'   => 'multi-currency-account',
			'slug'  => [ 'en' => 'multi-currency-account', 'fr' => 'compte-multidevises' ],
			'title' => [ 'en' => 'Multi-currency account', 'fr' => 'Compte multidevises' ],
			'body'  => $product(
				static fn( $t, $u ) => [
					'title'     => $t( 'Multi-currency current account', 'Compte courant multidevises' ),
					'sub'       => $t( 'Manage multiple currencies in a single account', 'Gérez plusieurs devises dans un seul compte' ),
					'crumb'     => $t( 'Manage my money', 'Gérer mon argent' ),
					'crumbUrl'  => $u( 'manage-my-money' ),
					'whatTitle' => $t( 'What is a multi-currency current account?', 'Qu’est-ce qu’un compte courant multidevises ?' ),
					'what'      => [
						$t( 'AMFIE’s multi-currency current account is free and makes it easier to manage your money from one country to another. You can also open additional current accounts for 10 EUR per year. It’s ideal if you live, work, or travel internationally.', 'Le compte courant multidevises d’AMFIE est gratuit et facilite la gestion de votre argent d’un pays à l’autre. Vous pouvez aussi ouvrir des comptes courants supplémentaires pour 10 EUR par an. Idéal si vous vivez, travaillez ou voyagez à l’international.' ),
						$t( 'Through this account, you can hold 7 major currencies: EUR, USD, CAD, CHF, GBP, AUD, DKK.', 'Ce compte vous permet de détenir 7 devises majeures : EUR, USD, CAD, CHF, GBP, AUD, DKK.' ),
					],
					'benefits'  => [
						[ 'title' => $t( 'No fees', 'Sans frais' ), 'text' => $t( 'No account maintenance fees.', 'Aucun frais de tenue de compte.' ) ],
						[ 'title' => $t( '7 currencies available', '7 devises disponibles' ), 'text' => '' ],
						[ 'title' => $t( 'Foreign exchange', 'Change' ), 'text' => '', 'url' => $u( 'foreign-exchange' ), 'linkLabel' => $t( 'Learn more', 'En savoir plus' ) ],
						[ 'title' => $t( 'Online access', 'Accès en ligne' ), 'text' => $t( 'Access your account via your member portal.', 'Accédez à votre compte via votre portail membre.' ) ],
					],
				]
			),
		],
		[
			'key'   => 'foreign-exchange',
			'slug'  => [ 'en' => 'foreign-exchange', 'fr' => 'change' ],
			'title' => [ 'en' => 'Foreign exchange', 'fr' => 'Change' ],
			'body'  => $product(
				static fn( $t, $u ) => [
					'title'     => $t( 'Foreign Exchange', 'Change' ),
					'sub'       => $t( 'Easily convert your currencies at attractive market rates', 'Convertissez facilement vos devises à des taux de marché attractifs' ),
					'crumb'     => $t( 'Manage my money', 'Gérer mon argent' ),
					'crumbUrl'  => $u( 'manage-my-money' ),
					'whatTitle' => $t( 'Simulate your foreign exchange conversion with AMFIE', 'Simulez votre conversion de devises avec AMFIE' ),
					'what'      => [ $t( 'Currency simulator to be integrated here (embed or custom block).', 'Simulateur de change à intégrer ici (embed ou bloc sur mesure).' ) ],
					'benefits'  => [
						[ 'title' => $t( 'Attractive rates', 'Taux attractifs' ), 'text' => '' ],
						[ 'title' => $t( '7 currencies', '7 devises' ), 'text' => '' ],
						[ 'title' => $t( '100% online', '100 % en ligne' ), 'text' => '' ],
					],
				]
			),
		],
		[
			'key'   => 'credit-card',
			'slug'  => [ 'en' => 'credit-card', 'fr' => 'carte-de-credit' ],
			'title' => [ 'en' => 'Credit card', 'fr' => 'Carte de crédit' ],
			'body'  => $product(
				static fn( $t, $u ) => [
					'title'     => $t( 'Capitol Mastercard Gold Credit Card', 'Carte de crédit Capitol Mastercard Gold' ),
					'sub'       => $t( 'Easily make payments and withdraw cash worldwide', 'Payez et retirez de l’argent facilement partout dans le monde' ),
					'crumb'     => $t( 'Manage my money', 'Gérer mon argent' ),
					'crumbUrl'  => $u( 'manage-my-money' ),
					'whatTitle' => $t( 'Credit cards', 'Cartes de crédit' ),
					'what'      => [ $t( 'Make secure payments during your travels with a card issued in your currency.', 'Payez en toute sécurité lors de vos voyages avec une carte émise dans votre devise.' ) ],
					'benefits'  => [
						[ 'title' => $t( '4 currencies', '4 devises' ), 'text' => $t( 'Available in 4 different currencies.', 'Disponible en 4 devises.' ) ],
						[ 'title' => $t( 'Insurance & assistance', 'Assurances & assistance' ), 'text' => $t( 'Includes insurance and travel assistance.', 'Assurances et assistance voyage incluses.' ) ],
						[ 'title' => $t( 'Preferential rates', 'Tarifs préférentiels' ), 'text' => $t( 'Preferential rates for our members.', 'Tarifs préférentiels pour nos membres.' ) ],
						[ 'title' => $t( 'Additional card', 'Carte supplémentaire' ), 'text' => $t( 'Option to add an additional card.', 'Possibilité d’ajouter une carte supplémentaire.' ) ],
					],
				]
			),
		],
		[
			'key'   => 'international-transfers',
			'slug'  => [ 'en' => 'international-transfers', 'fr' => 'virements-internationaux' ],
			'title' => [ 'en' => 'International transfers', 'fr' => 'Virements internationaux' ],
			'body'  => $product(
				static fn( $t, $u ) => [
					'title'     => $t( 'International transfers', 'Virements internationaux' ),
					'sub'       => $t( 'Send money abroad quickly and securely', 'Envoyez de l’argent à l’étranger rapidement et en sécurité' ),
					'crumb'     => $t( 'Manage my money', 'Gérer mon argent' ),
					'crumbUrl'  => $u( 'manage-my-money' ),
					'whatTitle' => $t( 'How do international transfers work?', 'Comment fonctionnent les virements internationaux ?' ),
					'what'      => [ $t( 'Content to be completed with the client.', 'Contenu à compléter avec le client.' ) ],
					'benefits'  => [
						[ 'title' => $t( 'Fast', 'Rapide' ), 'text' => '' ],
						[ 'title' => $t( 'Secure', 'Sécurisé' ), 'text' => '' ],
						[ 'title' => $t( 'Transparent fees', 'Frais transparents' ), 'text' => '' ],
					],
				]
			),
		],

		// ───────────── Produits : Épargner ─────────────
		[
			'key'   => 'multi-currency-savings-account',
			'slug'  => [ 'en' => 'multi-currency-savings-account', 'fr' => 'compte-epargne-multidevises' ],
			'title' => [ 'en' => 'Multi-currency savings account', 'fr' => 'Compte d’épargne multidevises' ],
			'body'  => $product(
				static fn( $t, $u ) => [
					'title'     => $t( 'Multi-currency savings account', 'Compte d’épargne multidevises' ),
					'sub'       => $t( 'Grow your savings in the currency that matches your financial goals', 'Faites fructifier votre épargne dans la devise de vos objectifs' ),
					'crumb'     => $t( 'Save securely', 'Épargner en sécurité' ),
					'crumbUrl'  => $u( 'save-securely' ),
					'whatTitle' => $t( 'Interest rates', 'Taux d’intérêt' ),
					'what'      => [ $t( 'Interest rate table and savings simulator ("Your savings", "Amount of your return") to be integrated here.', 'Tableau des taux et simulateur d’épargne (« Votre épargne », « Montant de votre rendement ») à intégrer ici.' ) ],
					'benefits'  => [
						[ 'title' => $t( 'Rest assured!', 'Soyez rassuré !' ), 'text' => '' ],
						[ 'title' => $t( 'Multi-currency', 'Multidevises' ), 'text' => '' ],
						[ 'title' => $t( 'Flexible', 'Flexible' ), 'text' => '' ],
					],
				]
			),
		],
		[
			'key'   => 'term-deposit',
			'slug'  => [ 'en' => 'term-deposit', 'fr' => 'depot-a-terme' ],
			'title' => [ 'en' => 'AMFIX deposit', 'fr' => 'Dépôt AMFIX' ],
			'body'  => $product(
				static fn( $t, $u ) => [
					'title'     => $t( 'Term deposit — AMFIX', 'Dépôt à terme — AMFIX' ),
					'sub'       => '',
					'crumb'     => $t( 'Save securely', 'Épargner en sécurité' ),
					'crumbUrl'  => $u( 'save-securely' ),
					'whatTitle' => $t( 'Interest rates', 'Taux d’intérêt' ),
					'what'      => [ $t( 'Interest rate table and simulator to be integrated here.', 'Tableau des taux et simulateur à intégrer ici.' ) ],
					'benefits'  => [
						[ 'title' => $t( 'Known return', 'Rendement connu' ), 'text' => '' ],
						[ 'title' => $t( 'Secure', 'Sécurisé' ), 'text' => '' ],
						[ 'title' => $t( 'Multi-currency', 'Multidevises' ), 'text' => '' ],
					],
				]
			),
		],
		[
			'key'   => 'child-account',
			'slug'  => [ 'en' => 'child-account', 'fr' => 'compte-enfant' ],
			'title' => [ 'en' => '0–18 child account', 'fr' => 'Compte enfant 0-18' ],
			'body'  => $product(
				static fn( $t, $u ) => [
					'title'     => $t( 'Child account 0-18', 'Compte enfant 0-18' ),
					'sub'       => $t( 'Build up the capital that will support your children’s future projects', 'Constituez le capital qui soutiendra les projets futurs de vos enfants' ),
					'crumb'     => $t( 'Save securely', 'Épargner en sécurité' ),
					'crumbUrl'  => $u( 'save-securely' ),
					'whatTitle' => $t( 'What is the child account?', 'Qu’est-ce que le compte enfant ?' ),
					'what'      => [ $t( 'Content to be completed with the client.', 'Contenu à compléter avec le client.' ) ],
					'benefits'  => [
						[ 'title' => $t( 'From 0 to 18', 'De 0 à 18 ans' ), 'text' => '' ],
						[ 'title' => $t( 'Same conditions', 'Mêmes conditions' ), 'text' => '' ],
						[ 'title' => $t( 'Family membership', 'Adhésion familiale' ), 'text' => '' ],
					],
				]
			),
		],

		// ───────────── Produits : Investir ─────────────
		[
			'key'   => 'amfund',
			'slug'  => [ 'en' => 'amfund', 'fr' => 'plan-amfund' ],
			'title' => [ 'en' => 'AMFUND Investment Plan', 'fr' => 'Plan d’investissement AMFUND' ],
			'body'  => $product(
				static fn( $t, $u ) => [
					'title'     => $t( 'AMFund - Investment Plan', 'AMFund - Plan d’investissement' ),
					'sub'       => $t( 'Build a future for yourself and your loved ones', 'Construisez l’avenir de vos proches et le vôtre' ),
					'crumb'     => $t( 'Invest', 'Investir' ),
					'crumbUrl'  => $u( 'invest' ),
					'whatTitle' => $t( 'What is an AMFund ?', 'Qu’est-ce qu’AMFund ?' ),
					'what'      => [
						$t( 'AMFund allows investors to gain easy access to professionally managed equity and bond portfolios.', 'AMFund permet d’accéder facilement à des portefeuilles d’actions et d’obligations gérés professionnellement.' ),
						$t( 'By investing regularly in any of the five available funds, you can gradually build the capital you need to finance your long-term projects, with a minimum subscription of just 50 EUR.', 'En investissant régulièrement dans l’un des cinq fonds disponibles, vous constituez progressivement le capital nécessaire à vos projets à long terme, dès 50 EUR.' ),
					],
					'benefits'  => [
						[ 'title' => $t( '5 funds', '5 fonds' ), 'text' => $t( 'Each fund is associated with a different level of risk.', 'Chaque fonds correspond à un niveau de risque différent.' ) ],
						[ 'title' => $t( 'From 50 EUR', 'Dès 50 EUR' ), 'text' => '' ],
						[ 'title' => $t( 'Active management', 'Gestion active' ), 'text' => '' ],
					],
					'moreTitle' => $t( 'Choose the AMFund that suits you', 'Choisissez l’AMFund qui vous convient' ),
					'more'      => amfie_p( $t( 'Fund comparison table to be integrated here.', 'Tableau comparatif des fonds à intégrer ici.' ) ),
				]
			),
		],
		[
			'key'   => 'provident-savings-plan',
			'slug'  => [ 'en' => 'provident-savings-plan', 'fr' => 'plan-epargne-prevoyance' ],
			'title' => [ 'en' => 'Provident Savings Plan', 'fr' => 'Plan d’épargne prévoyance' ],
			'body'  => $product(
				static fn( $t, $u ) => [
					'title'     => $t( 'Provident Savings Plan', 'Plan d’épargne prévoyance' ),
					'sub'       => '',
					'crumb'     => $t( 'Invest', 'Investir' ),
					'crumbUrl'  => $u( 'invest' ),
					'whatTitle' => $t( 'What is the Provident Savings Plan?', 'Qu’est-ce que le Plan d’épargne prévoyance ?' ),
					'what'      => [ $t( 'Content to be completed with the client.', 'Contenu à compléter avec le client.' ) ],
					'benefits'  => [
						[ 'title' => $t( 'Long term', 'Long terme' ), 'text' => '' ],
						[ 'title' => $t( 'Regular contributions', 'Versements réguliers' ), 'text' => '' ],
						[ 'title' => $t( 'Flexible', 'Flexible' ), 'text' => '' ],
					],
				]
			),
		],
		[
			'key'   => 'external-investment',
			'slug'  => [ 'en' => 'external-investment', 'fr' => 'compte-investissement-externe' ],
			'title' => [ 'en' => 'External Investment Account', 'fr' => 'Compte d’investissement externe' ],
			'body'  => $product(
				static fn( $t, $u ) => [
					'title'     => $t( 'External Investment Account', 'Compte d’investissement externe' ),
					'sub'       => '',
					'crumb'     => $t( 'Invest', 'Investir' ),
					'crumbUrl'  => $u( 'invest' ),
					'whatTitle' => $t( 'What is the External Investment Account?', 'Qu’est-ce que le Compte d’investissement externe ?' ),
					'what'      => [ $t( 'Content to be completed with the client.', 'Contenu à compléter avec le client.' ) ],
					'benefits'  => [
						[ 'title' => $t( 'Stock market orders', 'Ordres de bourse' ), 'text' => '' ],
						[ 'title' => $t( 'Portfolio view', 'Vue du portefeuille' ), 'text' => '' ],
						[ 'title' => $t( 'Discretionary mandate', 'Mandat discrétionnaire' ), 'text' => '' ],
					],
				]
			),
		],

		// ───────────── À propos ─────────────
		[
			'key'   => 'who-are-we',
			'slug'  => [ 'en' => 'who-are-we', 'fr' => 'qui-sommes-nous' ],
			'title' => [ 'en' => 'Who are we?', 'fr' => 'Qui sommes-nous ?' ],
			'body'  => static function ( $t, $u, $r ): string {
				return amfie_blk( 'amfie/page-header', [ 'title' => $t( 'Who are we?', 'Qui sommes-nous ?' ), 'homeLabel' => $t( 'Home', 'Accueil' ), 'crumbLabel' => $t( 'About us', 'À propos' ), 'crumbUrl' => $u( 'who-are-we' ) ] )
					. amfie_blk(
						'amfie/intro',
						[
							'title' => $t( 'AMFIE, a unique financial cooperative', 'AMFIE, une coopérative financière unique' ),
							'text'  => $t( 'Founded in 1990 by 21 international civil servants, AMFIE now counts over 8,000 members from 146 organisations and manages assets exceeding 500 million euros.', 'Fondée en 1990 par 21 fonctionnaires internationaux, AMFIE compte aujourd’hui plus de 8 000 membres de 146 organisations et gère plus de 500 millions d’euros.' ),
						]
					)
					. amfie_blk(
						'amfie/feature-grid',
						[ 'title' => $t( 'Our 3 core principles', 'Nos 3 principes fondamentaux' ), 'variant' => 'numbered' ],
						amfie_cards( [ [ 'title' => $t( 'Secure management', 'Gestion sécurisée' ), 'text' => '' ], [ 'title' => $t( 'Equal treatment', 'Égalité de traitement' ), 'text' => '' ], [ 'title' => $t( 'Reduced fees', 'Frais réduits' ), 'text' => '' ] ] )
					)
					. amfie_blk(
						'amfie/stats',
						[ 'title' => $t( 'AMFIE in numbers', 'AMFIE en chiffres' ) ],
						amfie_blk( 'amfie/stat', [ 'value' => '+8000', 'label' => $t( 'members', 'membres' ) ] ) . amfie_blk( 'amfie/stat', [ 'value' => '146', 'label' => $t( 'countries', 'pays' ) ] ) . amfie_blk( 'amfie/stat', [ 'value' => '132', 'label' => $t( 'intergovernmental organizations', 'organisations intergouvernementales' ) ] ) . amfie_blk( 'amfie/stat', [ 'value' => '500M', 'label' => $t( 'in assets under management', 'd’actifs sous gestion' ) ] )
					)
					. amfie_blk(
						'amfie/link-list',
						[ 'title' => $t( 'Documents', 'Documents' ) ],
						amfie_blk( 'amfie/link-button', [ 'label' => $t( 'Annual Report 2025', 'Rapport annuel 2025' ), 'url' => 'https://www-api.amfie.org/api/pdfs/file/AMFIE_Rapport_Annuel_2025_EN.pdf', 'style' => 'ghost' ] ) .
						amfie_blk( 'amfie/link-button', [ 'label' => $t( 'Statutes', 'Statuts' ), 'url' => 'https://www-api.amfie.org/api/pdfs/file/StatutesFile.pdf', 'style' => 'ghost' ] )
					)
					. $r( 'contact' );
			},
		],
		[
			'key'   => 'governance',
			'slug'  => [ 'en' => 'governance', 'fr' => 'gouvernance' ],
			'title' => [ 'en' => 'Governance', 'fr' => 'Gouvernance' ],
			'body'  => static function ( $t, $u, $r ) use ( $todo ): string {
				return amfie_blk( 'amfie/page-header', [ 'title' => $t( 'Governance', 'Gouvernance' ), 'homeLabel' => $t( 'Home', 'Accueil' ), 'crumbLabel' => $t( 'About us', 'À propos' ), 'crumbUrl' => $u( 'who-are-we' ) ] )
					. amfie_blk( 'amfie/text-section', [ 'title' => $t( 'General Assembly', 'Assemblée générale' ) ], amfie_p( $todo( $t ) ) )
					. amfie_blk( 'amfie/text-section', [ 'title' => $t( 'Board of Directors', 'Conseil d’administration' ), 'variant' => 'highlight' ], amfie_p( $todo( $t ) ) )
					. amfie_blk( 'amfie/text-section', [ 'title' => $t( 'Management', 'Direction' ) ], amfie_p( $todo( $t ) ) )
					. $r( 'contact' );
			},
		],
		[
			'key'   => 'news',
			'slug'  => [ 'en' => 'news', 'fr' => 'actualites' ],
			'title' => [ 'en' => 'News', 'fr' => 'Actualités' ],
			'body'  => static function ( $t, $u, $r ): string {
				return amfie_blk( 'amfie/page-header', [ 'title' => $t( 'News', 'Actualités' ), 'homeLabel' => $t( 'Home', 'Accueil' ), 'crumbLabel' => $t( 'About us', 'À propos' ), 'crumbUrl' => $u( 'who-are-we' ) ] )
					. amfie_blk( 'amfie/news-list', [ 'title' => $t( 'Latest news', 'Dernières actualités' ), 'count' => 12 ] )
					. $r( 'contact' );
			},
		],
		[
			'key'   => 'faq',
			'slug'  => [ 'en' => 'questions-and-answers', 'fr' => 'questions-reponses' ],
			'title' => [ 'en' => 'FAQ', 'fr' => 'FAQ' ],
			'body'  => static function ( $t, $u, $r ): string {
				$q = static fn( $qq, $aa ) => amfie_blk( 'amfie/faq-item', [ 'question' => $qq, 'answer' => $aa ] );
				return amfie_blk( 'amfie/page-header', [ 'title' => $t( 'Questions & answers', 'Questions & réponses' ), 'homeLabel' => $t( 'Home', 'Accueil' ), 'crumbLabel' => $t( 'About us', 'À propos' ), 'crumbUrl' => $u( 'who-are-we' ) ] )
					. amfie_blk(
						'amfie/faq',
						[ 'title' => $t( 'Becoming a member', 'Devenir membre' ) ],
						$q( $t( 'Who can join AMFIE?', 'Qui peut rejoindre AMFIE ?' ), $t( 'Any active or retired staff member of an Intergovernmental Organization, whether permanent, temporary or consultant, as well as their families.', 'Tout agent en activité ou retraité d’une organisation intergouvernementale (permanent, temporaire ou consultant), ainsi que sa famille.' ) ) .
						$q( $t( 'How do I open an account?', 'Comment ouvrir un compte ?' ), $t( 'The process is 100% digital: use the “Open an account” button.', 'Le processus est 100 % digital : utilisez le bouton « Ouvrir un compte ».' ) )
					)
					. amfie_blk(
						'amfie/faq',
						[ 'title' => $t( 'Accounts & cards', 'Comptes & cartes' ) ],
						$q( $t( 'Which currencies are available?', 'Quelles devises sont disponibles ?' ), 'EUR, USD, CAD, CHF, GBP, AUD, DKK.' ) .
						$q( $t( 'Question to be completed', 'Question à compléter' ), $t( 'Answer to be completed.', 'Réponse à compléter.' ) )
					)
					. $r( 'contact' );
			},
		],
		[
			'key'   => 'contact-us',
			'slug'  => [ 'en' => 'contact-us', 'fr' => 'contactez-nous' ],
			'title' => [ 'en' => 'Contact us', 'fr' => 'Nous contacter' ],
			'body'  => static function ( $t, $u, $r ): string {
				return amfie_blk( 'amfie/page-header', [ 'title' => $t( 'Contact our cooperative', 'Contactez notre coopérative' ), 'homeLabel' => $t( 'Home', 'Accueil' ), 'crumbLabel' => $t( 'About us', 'À propos' ), 'crumbUrl' => $u( 'who-are-we' ) ] )
					. amfie_blk(
						'amfie/contact-card',
						[
							'title'    => 'AMFIE',
							'address'  => "25A, boulevard Royal\nL-2449 Luxembourg",
							'phone'    => '+352 42 36 61 1',
							'linkedin' => 'https://www.linkedin.com/company/amfie',
						]
					)
					. amfie_blk( 'amfie/text-section', [ 'title' => $t( 'Contact form', 'Formulaire de contact' ), 'variant' => 'highlight' ], amfie_p( $t( 'Form to be integrated here (e.g. via a form plugin block).', 'Formulaire à intégrer ici (par ex. via le bloc d’un plugin de formulaires).' ) ) );
			},
		],

		// ───────────── Légal ─────────────
		...array_map(
			static function ( array $l ): array {
				return [
					'key'   => $l['key'],
					'slug'  => $l['slug'],
					'title' => $l['title'],
					'body'  => static function ( $t, $u ) use ( $l ): string {
						return amfie_blk( 'amfie/page-header', [ 'title' => $l['title'][ $t( 'en', 'fr' ) ], 'homeLabel' => $t( 'Home', 'Accueil' ) ] )
							. amfie_blk( 'amfie/text-section', [ 'title' => '', 'variant' => 'narrow' ], amfie_p( $t( 'Legal text to be provided by the client.', 'Texte légal à fournir par le client.' ) ) );
					},
				];
			},
			[
				[ 'key' => 'legal-notice', 'slug' => [ 'en' => 'legal-notice', 'fr' => 'mentions-legales' ], 'title' => [ 'en' => 'Legal notice', 'fr' => 'Mentions légales' ] ],
				[ 'key' => 'data-protection', 'slug' => [ 'en' => 'data-protection-notice', 'fr' => 'protection-des-donnees' ], 'title' => [ 'en' => 'Data protection notice', 'fr' => 'Avis de protection des données' ] ],
				[ 'key' => 'best-execution', 'slug' => [ 'en' => 'best-execution-policy', 'fr' => 'meilleure-execution' ], 'title' => [ 'en' => 'Best Execution Policy', 'fr' => 'Politique de meilleure exécution' ] ],
				[ 'key' => 'cookie-policy', 'slug' => [ 'en' => 'cookie-policy', 'fr' => 'politique-cookies' ], 'title' => [ 'en' => 'Cookie Policy', 'fr' => 'Politique de cookies' ] ],
			]
		),
	];
}

/** Menus : arbre de [clé page | url custom, libellé EN, libellé FR, enfants]. */
function amfie_menu_defs(): array {
	$pdf = 'https://www-api.amfie.org/api/pdfs/file/';
	return [
		'primary' => [
			[ 'page' => 'manage-my-money', 'en' => 'Manage my money', 'fr' => 'Gérer mon argent', 'children' => [
				[ 'page' => 'multi-currency-account', 'en' => 'Multi-currency account', 'fr' => 'Compte courant multi-devises' ],
				[ 'page' => 'foreign-exchange', 'en' => 'Foreign exchange', 'fr' => 'Conversion de devises' ],
				[ 'page' => 'credit-card', 'en' => 'Credit card', 'fr' => 'Carte de crédit' ],
				[ 'page' => 'international-transfers', 'en' => 'International transfers', 'fr' => 'Virements internationaux' ],
			] ],
			[ 'page' => 'save-securely', 'en' => 'Save', 'fr' => 'Épargner', 'children' => [
				[ 'page' => 'multi-currency-savings-account', 'en' => 'Multi-currency savings account', 'fr' => 'Compte d\'épargne multi-devises' ],
				[ 'page' => 'term-deposit', 'en' => 'AMFIX deposit', 'fr' => 'Placement AMFIX' ],
				[ 'page' => 'child-account', 'en' => '0–18 child account', 'fr' => 'Compte enfant 0-18 ans' ],
			] ],
			[ 'page' => 'invest', 'en' => 'Invest', 'fr' => 'Investir', 'children' => [
				[ 'page' => 'amfund', 'en' => 'AMFUND Investment Plan', 'fr' => 'Plan d\'investissement AMFUND' ],
				[ 'page' => 'provident-savings-plan', 'en' => 'Provident Savings Plan', 'fr' => 'Plan d\'épargne prévoyance' ],
				[ 'page' => 'external-investment', 'en' => 'External Investment Account', 'fr' => 'Compte d\'investissement externe' ],
			] ],
			[ 'page' => 'by-your-side', 'en' => 'By your side', 'fr' => 'Vous accompagner' ],
			[ 'url' => '#', 'en' => 'About us', 'fr' => 'Nous connaître', 'children' => [
				[ 'page' => 'who-are-we', 'en' => 'Who are we?', 'fr' => 'Qui sommes-nous ?' ],
				[ 'page' => 'governance', 'en' => 'Governance', 'fr' => 'Notre gouvernance' ],
				[ 'page' => 'news', 'en' => 'News', 'fr' => 'Actualités et évènements' ],
				[ 'page' => 'faq', 'en' => 'FAQ', 'fr' => 'FAQ' ],
			] ],
		],
		'utility' => [
			[ 'url' => 'https://onboarding.amfie.org/', 'en' => 'Open an account', 'fr' => 'Ouvrir un compte' ],
			[ 'url' => 'https://portal.amfie.org/', 'en' => 'Log in to MyAMFIE', 'fr' => 'Se connecter à MyAMFIE' ],
		],
		'footer'  => [
			[ 'page' => 'contact-us', 'en' => 'Contact us', 'fr' => 'Contactez-nous' ],
			[ 'url' => $pdf . 'Conditions_And_Prices.pdf', 'url_fr' => $pdf . 'Conditions%20et%20tarifs.pdf', 'en' => 'Pricing', 'fr' => 'Tarification' ],
			[ 'url' => $pdf . 'GeneralTermAndConditions.pdf', 'url_fr' => $pdf . 'ConditionsGenerales.pdf', 'en' => 'General Terms and Conditions', 'fr' => 'Conditions Générales' ],
			[ 'url' => $pdf . 'DiscretionaryMandate.pdf', 'url_fr' => $pdf . 'MandatDeGestionDiscretionnaire.pdf', 'en' => 'Discretionary Mandate', 'fr' => 'Mandat De Gestion Discretionnaire' ],
			[ 'url' => $pdf . 'AMFIE_Rapport_Annuel_2025_EN.pdf', 'url_fr' => $pdf . 'AMFIE_Rapport_Annuel_2025_FR.pdf', 'en' => 'Annual Report 2025', 'fr' => 'Rapport Annuel 2025' ],
			[ 'url' => $pdf . 'StatutesFile.pdf', 'url_fr' => $pdf . 'StatusFile.pdf', 'en' => 'Statutes', 'fr' => 'Statuts' ],
			[ 'page' => 'legal-notice', 'en' => 'Legal notice', 'fr' => 'Mentions légales' ],
			[ 'page' => 'data-protection', 'en' => 'Data protection notice', 'fr' => 'Notice de protection des données' ],
			[ 'page' => 'best-execution', 'en' => 'Best Execution Policy', 'fr' => 'Politique d\'exécution des ordres' ],
			[ 'page' => 'cookie-policy', 'en' => 'Cookie Policy', 'fr' => 'Politique en matière de cookies' ],
		],
	];
}

/** Motifs synchronisés (modifiables une fois, répercutés partout). */
function amfie_synced_defs(): array {
	return [
		'contact' => static fn( $t, $u ) => amfie_blk(
			'amfie/contact-cta',
			[ 'title' => $t( 'Need more information?', 'Besoin de plus d’informations ?' ), 'buttonLabel' => $t( 'Contact us', 'Nous contacter' ), 'buttonUrl' => $u( 'contact-us' ) ]
		),
		'digital' => static fn( $t, $u ) => amfie_blk(
			'amfie/digital-process',
			[
				'title'          => $t( 'A 100% digital process', 'Un processus 100 % digital' ),
				'steps'          => $t( "Fill in the online form\nUpload your documents\nReceive your account details", "Remplissez le formulaire en ligne\nTéléversez vos documents\nRecevez les coordonnées de votre compte" ),
				'primaryLabel'   => $t( 'Open an account', 'Ouvrir un compte' ),
				'primaryUrl'     => 'https://onboarding.amfie.org/',
				'secondaryLabel' => $t( 'Log in to MyAMFIE', 'Se connecter à MyAMFIE' ),
				'secondaryUrl'   => 'https://portal.amfie.org/',
			]
		),
	];
}

/** Articles d'exemple. */
function amfie_post_defs(): array {
	return [
		[ 'key' => 'post-family', 'date' => '2026-08-04 09:00:00', 'cat' => 'products',
		  'title' => [ 'en' => 'A cooperative for the whole family', 'fr' => 'Une coopérative pour toute la famille' ],
		  'slug' => [ 'en' => 'a-cooperative-for-the-whole-family', 'fr' => 'une-cooperative-pour-toute-la-famille' ],
		  'excerpt' => [ 'en' => 'Joint account, 0-18 Child account, passing it on: your family can join AMFIE and access the same services, on the same terms.', 'fr' => 'Compte joint, compte enfant 0-18, transmission : votre famille peut rejoindre AMFIE et accéder aux mêmes services, aux mêmes conditions.' ] ],
		[ 'key' => 'post-support', 'date' => '2026-04-22 10:00:00', 'cat' => 'company-life',
		  'title' => [ 'en' => 'Supporting you every step of the way', 'fr' => 'Un accompagnement à chaque étape' ],
		  'slug' => [ 'en' => 'supporting-you-every-step-of-the-way', 'fr' => 'un-accompagnement-a-chaque-etape' ],
		  'excerpt' => [ 'en' => 'AMFIE remains committed to ensuring that every member benefits from clear guidance and personalized support throughout the transition to its new digital environment.', 'fr' => 'AMFIE s’engage à ce que chaque membre bénéficie d’un accompagnement clair et personnalisé pendant la transition vers son nouvel environnement digital.' ] ],
		[ 'key' => 'post-digital', 'date' => '2026-04-22 09:00:00', 'cat' => 'company-life',
		  'title' => [ 'en' => 'A new digital experience with AMFIE', 'fr' => 'Une nouvelle expérience digitale avec AMFIE' ],
		  'slug' => [ 'en' => 'a-new-digital-experience-with-amfie', 'fr' => 'une-nouvelle-experience-digitale-avec-amfie' ],
		  'excerpt' => [ 'en' => 'AMFIE is pleased to introduce a new digital environment designed to make access to its services simpler, faster, and more intuitive.', 'fr' => 'AMFIE a le plaisir de présenter un nouvel environnement digital conçu pour rendre l’accès à ses services plus simple, plus rapide et plus intuitif.' ] ],
	];
}
