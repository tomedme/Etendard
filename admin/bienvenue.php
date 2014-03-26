<?php

/* Etendard Welcome Class thanks to Easy Digital Downloads */

// Exit if loaded directly
if ( ! defined( 'ABSPATH' ) ) exit;

class Etendard_Welcome {

	// Minimum role to see this page
	public $minimum_capability = 'manage_options';

	public function __construct() {
		add_action( 'admin_menu', array( $this, 'admin_menus') );
		add_action( 'admin_head', array( $this, 'admin_head' ) );
		add_action( 'admin_init', array( $this, 'welcome'    ) );
	}

	// Page registering
	public function admin_menus() {
		// Update
		add_dashboard_page(
			__('Étendard a été mis à jour', TEXT_TRANSLATION_DOMAIN),
			__('Étendard a été mis à jour', TEXT_TRANSLATION_DOMAIN),
			$this->minimum_capability,
			'etendard-update',
			array( $this, 'update_screen' )
		);

		// First Installation
		add_dashboard_page(
			__('Bienvenue sur Étendard', TEXT_TRANSLATION_DOMAIN),
			__('Bienvenue sur Étendard', TEXT_TRANSLATION_DOMAIN),
			$this->minimum_capability,
			'etendard-bienvenue',
			array( $this, 'bienvenue_screen' )
		);
	}

	// Hide those pages
	public function admin_head() {
		remove_submenu_page( 'index.php', 'etendard-update' );
		remove_submenu_page( 'index.php', 'etendard-bienvenue' );

		// Badge for welcome page
		$badge_url = get_template_directory_uri() . '/admin/img/badge.png';
		?>
		<style type="text/css" media="screen">
		/*<![CDATA[*/
		.etendard-badge {
			padding-top: 150px;
			height: 52px;
			width: 185px;
			color: #666;
			font-weight: bold;
			font-size: 14px;
			text-align: center;
			text-shadow: 0 1px 0 rgba(255, 255, 255, 0.8);
			margin: 0 -5px;
			background: url('<?php echo $badge_url; ?>') no-repeat;
		}

		.about-wrap .etendard-badge {
			position: absolute;
			top: 0;
			right: 0;
		}

		.etendard-screenshots {
			float: right;
			margin-left: 10px!important;
		}
		/*]]>*/
		</style>
		<?php
	}

	// Tabs
	public function tabs() {
		$selected = isset( $_GET['page'] ) ? $_GET['page'] : 'etendard-update';
		?>
		<h2 class="nav-tab-wrapper">
			<a class="nav-tab <?php echo $selected == 'etendard-update' ? 'nav-tab-active' : ''; ?>" href="<?php echo esc_url( admin_url( add_query_arg( array( 'page' => 'etendard-update' ), 'index.php' ) ) ); ?>">
				<?php _e( "Quoi de neuf ?", TEXT_TRANSLATION_DOMAIN ); ?>
			</a>
			<a class="nav-tab <?php echo $selected == 'etendard-bienvenue' ? 'nav-tab-active' : ''; ?>" href="<?php echo esc_url( admin_url( add_query_arg( array( 'page' => 'etendard-bienvenue' ), 'index.php' ) ) ); ?>">
				<?php _e( 'Bienvenue', TEXT_TRANSLATION_DOMAIN ); ?>
			</a>
		</h2>
		<?php
	}

	// Display Update Screen
	public function update_screen() {
		list( $display_version ) = explode( '-', EDD_SL_THEME_VERSION );
		?>
		<div class="wrap about-wrap">
			<h1><?php printf( __( 'Bienvenue sur Étendard %s', TEXT_TRANSLATION_DOMAIN ), $display_version ); ?></h1>
			<div class="about-text"><?php printf( __( 'Merci d\'avoir procédé à la mise à jour, vous allez pouvoir découvrir ce que nous avons amélioré pour que votre site web soit encore plus performant.', TEXT_TRANSLATION_DOMAIN ), $display_version ); ?></div>
			<div class="etendard-badge"><?php printf( __( 'Version %s', TEXT_TRANSLATION_DOMAIN ), $display_version ); ?></div>

			<?php $this->tabs(); ?>

			<div class="changelog">
				<h3><?php _e( 'Découvrez le nouveau diaporama et les bandeaux colorés', TEXT_TRANSLATION_DOMAIN );?></h3>

				<div class="feature-section">

					<img src="<?php echo get_template_directory_uri() . '/admin/img/accueil-etendard.jpg'; ?>" class="etendard-screenshots"/>

					<h4><?php _e( 'Mise à jour du diaporama', TEXT_TRANSLATION_DOMAIN );?></h4>
					<p><?php _e( 'Il est maintenant possible d\'afficher le diaporama en pleine largeur ou de le garder cadré.', TEXT_TRANSLATION_DOMAIN );?></p>
					<p><?php _e( 'La hauteur est désormais directement personnalisable via l\'administration. Vos images seront automatiquement redimensionnées (attention toutefois à employer des images avec une taille adaptée).', TEXT_TRANSLATION_DOMAIN );?></p>

					<h4><?php _e( 'Étendard prend des couleurs', TEXT_TRANSLATION_DOMAIN );?></h4>
					<p><?php _e( 'Des bandeaux colorés ont été ajoutés pour rendre Étendard un peu moins minimaliste. La couleur que vous aurez définie dans l\'administration leur sera appliquée.', TEXT_TRANSLATION_DOMAIN );?></p>
					<p><?php _e( 'Ces bandeaux contiennent les titres des pages sur la droite et un fil d\'ariane sur la gauche si vous l\'avez activé dans le plugin WordPress SEO.', TEXT_TRANSLATION_DOMAIN );?></p>
				</div>
			</div>
			
			

			<div class="changelog">
				<h3><?php _e( 'Autres nouveautés d\'Étendard', TEXT_TRANSLATION_DOMAIN );?></h3>

				<div class="feature-section col three-col">
					<div>
						<h4><?php _e( 'L\'administration se minimalise', TEXT_TRANSLATION_DOMAIN );?></h4>
						<p><?php _e( 'Étendard repose désormais sur notre propre framework : Cocorico. Sans trop entrer dans les détails, Cocorico sert à gérer les options d\'Étendard. En fait, ce qui compte pour vous est que l\'administration d\'Étendard gagne en simplicité.', TEXT_TRANSLATION_DOMAIN );?></p>

						<h4><?php _e( 'Optimisation pour WordPress SEO', TEXT_TRANSLATION_DOMAIN );?></h4>
						<p><?php _e( 'Si vous utilisez le plugin WordPress SEO, Étendard prend maintenant en charge la fonctionnalité fil d\'ariane. Rendez-vous dans la page "Liens internes" pour l\'activer.', TEXT_TRANSLATION_DOMAIN );?></p>
					</div>

					<div>
						<h4><?php _e( 'Insertion des shortcodes simplifiée', TEXT_TRANSLATION_DOMAIN );?></h4>
						<p><?php _e( 'Cette nouvelle version permet d\'insérer les shotcodes plus simplement. Un bouton dans l\'éditeur visuel a été ajouté. Cliquez dessus et agencez vos pages et articles.', TEXT_TRANSLATION_DOMAIN );?></p>

					</div>

					<div class="last-feature">
						<h4><?php _e( 'La page portfolio gagne en flexibilité', TEXT_TRANSLATION_DOMAIN );?></h4>
						<p><?php _e( 'En vous rendant dans l\'onglet portfolio de l\'administration, vous pourrez choisir d\'afficher ou non les extraits et les boutons de la page portfolio.' ,TEXT_TRANSLATION_DOMAIN );?></p>

					</div>
				</div>
			</div>

			<div class="return-to-dashboard">
				<a href="<?php echo admin_url( 'themes.php?page=etendard_options') ?>" class="button button-primary"><?php _e( 'Découvrez la nouvelle administration d\'Étendard', TEXT_TRANSLATION_DOMAIN ); ?></a>
			</div>
		</div>
		<?php
	}

	/**
	 * Render Getting Started Screen
	 *
	 * @access public
	 * @since 1.9
	 * @return void
	 */
	public function bienvenue_screen() {
		list( $display_version ) = explode( '-', EDD_SL_THEME_VERSION );
		?>
		<div class="wrap about-wrap">
			<h1><?php printf( __( 'Bienvenue sur Étendard %s', TEXT_TRANSLATION_DOMAIN ), $display_version ); ?></h1>
			<div class="about-text"><?php printf( __( 'Merci d\'avoir installé Étendard, parcourez le contenu de cette page pour découvrir comme mettre votre site en place.', TEXT_TRANSLATION_DOMAIN ), $display_version ); ?></div>
			<div class="etendard-badge"><?php printf( __( 'Version %s', TEXT_TRANSLATION_DOMAIN ), $display_version ); ?></div>

			<?php $this->tabs(); ?>

			<p class="about-description"><?php _e( 'Ces quelques indications vont vous permettre de prendre en main votre nouveau thème.', TEXT_TRANSLATION_DOMAIN ); ?></p>

			<div class="changelog">
				<h3><?php _e( 'Les 3 premières choses à faire avec Étendard', TEXT_TRANSLATION_DOMAIN );?></h3>

				<div class="feature-section">

					<img src="<?php echo get_template_directory_uri() . '/admin/img/premieres-etapes.png'; ?>" class="etendard-screenshots"/>

					<h4><?php  _e( 'Validez votre clé de licence', TEXT_TRANSLATION_DOMAIN ); ?></h4>
					<p><?php  _e( 'Suite à votre commande, vous avez reçu une clé de licence. Entrez-là en allant dans "Options Étendard" &rarr; "Général" pour recevoir les mises à jour directement dans WordPress.', TEXT_TRANSLATION_DOMAIN ); ?></p>

					<h4><?php _e( 'Définissez une couleur principale', TEXT_TRANSLATION_DOMAIN );?></h4>
					<p><?php _e( 'Étendard peut arborer la couleur de votre choix. Rendez-vous dans l\'onglet "Apparence" des options pour la choisir avec le sélecteur de couleur.', TEXT_TRANSLATION_DOMAIN );?></p>

					<h4><?php _e( 'Envoyez votre logo', TEXT_TRANSLATION_DOMAIN );?></h4>
					<p><?php _e( 'Toujours dans l\'onglet "Apparence", vous pouvez définir l\'image correspondant au logo de votre site. Cliquez sur le bouton "Sélectionner" pour envoyer/choisir une image dans votre bibliothèque de médias.', TEXT_TRANSLATION_DOMAIN );?></p>

				</div>
			</div>

			<div class="changelog">
				<h3><?php _e( 'Ce que vous pouvez faire ensuite', TEXT_TRANSLATION_DOMAIN );?></h3>

				<div class="feature-section col three-col">

					<div>
						<h4><?php _e( 'Paramétrez votre page d\'accueil', TEXT_TRANSLATION_DOMAIN ); ?></h4>
						<p><?php _e( 'Déterminez les éléments à afficher en allant dans "Options Étendard" &rarr; "Général". Veillez à bien définir une page en tant que page d\'accueil (d\'autres options seront également disponibles sur cette page).', TEXT_TRANSLATION_DOMAIN ); ?></p>
					</div>

					<div>
						<h4><?php _e( 'Ajoutez des éléments à votre portfolio', TEXT_TRANSLATION_DOMAIN );?></h4>
						<p><?php _e( 'Une fois que vous aurez défini une page portfolio, ajoutez-y des éléments pour montrer au monde ce que vous avez accompli. N\'oubliez de définir un appel à l\'action dans l\'onglet "Portfolio" des options d\'Étendard.', TEXT_TRANSLATION_DOMAIN );?></p>
					</div>
					
					<div class="last-feature">
						<h4><?php _e( 'Sans oublier...', TEXT_TRANSLATION_DOMAIN );?></h4>
						<p><?php _e( 'La personnalisation du pied de page, la position de la barre latérale, l\'insertion du widget "Étendard Social", etc.', TEXT_TRANSLATION_DOMAIN );?></p>
					</div>
					
				</div>
			</div>
			
			<div class="return-to-dashboard">
				<a href="<?php echo admin_url( 'themes.php?page=etendard_options') ?>" class="button button-primary"><?php _e( 'C\'est bon, j\'attaque le paramétrage d\'Étendard', TEXT_TRANSLATION_DOMAIN ); ?></a>
			</div>
			
			<div class="changelog">
				<h3><?php _e( 'Besoin d\'aide avec Étendard ?', TEXT_TRANSLATION_DOMAIN );?></h3>

				<div class="feature-section">

					<h4><?php _e( 'Consultez la documentation', TEXT_TRANSLATION_DOMAIN ); ?></h4>
					<p><?php _e( 'En vous connectant sur Thèmes de France, vous pourrez accéder aux vidéos et aux tutoriels qui vous aideront à paramétrer Étendard.', TEXT_TRANSLATION_DOMAIN ); ?></p>
					
					<h4><?php _e( 'Publiez un message sur le forum de support', TEXT_TRANSLATION_DOMAIN ); ?></h4>
					<p><?php _e( 'Toute l\'équipe de Thèmes de France est là pour vous aider à régler tous problèmes relatifs à Étendard.', TEXT_TRANSLATION_DOMAIN ); ?></p>
					
				</div>
				
			</div>
			
			<div class="return-to-dashboard">
				<a href="https://www.themesdefrance.fr/documentation/manuel-etendard/" class="button button-primary" target="_blank"><?php _e( 'Ouvrir la documentation d\'Étendard', TEXT_TRANSLATION_DOMAIN ); ?></a>
			</div>
			
		</div>
		<?php
	}



	// Redirect to the First Install or Update Page
	public function welcome() {

		// Bail if no activation redirect
		if ( ! get_transient( '_etendard_activation_redirect' ) )
			return;

		// Delete the redirect transient
		delete_transient( '_etendard_activation_redirect' );

		// Bail if activating from network, or bulk
		if ( is_network_admin() || isset( $_GET['activate-multi'] ) )
			return;
		
		if ( ( isset( $_GET['action'] ) && 'do-theme-upgrade' == $_GET['action'] )){
			wp_safe_redirect( admin_url( 'index.php?page=etendard-update' ) ); exit;
		}
		elseif(( isset( $_GET['activated'] ) && 'true' == $_GET['activated'] )){
			wp_safe_redirect( admin_url( 'index.php?page=etendard-bienvenue' ) ); exit;
		}

	}
}
new Etendard_Welcome();