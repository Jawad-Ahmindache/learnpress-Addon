<?php

defined( 'ABSPATH' ) || exit;
if ( ! class_exists( 'LP_Addon_Formateur_Tab' ) ) {
	/**
	 * Class LP_Addon_Wishlist.
	 */
	class LP_Addon_Formateur_Tab extends LP_Addon {

		/**
		 * @var string
		 */
		protected $_tab_slug = '';

	

		/**
		 * LP_Addon_ constructor.
		 */
		public function __construct() {
			parent::__construct();
			add_filter( 'learn-press/profile-tabs', array( $this, 'wa_es_formateur_tab' ), 100, 1 );
        
		}



	
		/**
		 * Add Wishlist tab to user profile.
		 *
		 * @param $tabs
		 *
		 * @return mixed
		 */

    



		public function wa_es_formateur_tab( $tabs ) {
			if(learn_press_current_user_is() == 'instructor'){
                $tabs['espace_formateur'] = array(
                    'title'    => esc_html__( 'Espace formateur', 'learnpress' ),
                    'slug'     => 'espace_formateur',
                    'icon'     => '<i class="fas fa-chalkboard-teacher"></i>',
                    'callback' => 'wp_educationlearn_press_custom_tab_content',
                    'priority' => 2,
					'sections' => array(
						'formateur-commande-liste' => array(
							'title'    => esc_html__( 'Historique de commandes', 'learnpress' ),
							'slug' => 'formateur-commande-liste',
							'callback' => array( $this, 'formateurCommandeListe' ),
							'priority' => 10,
						),
						'formateur-versement-liste'   => array(
							'title'    => esc_html__( 'Historique de versements', 'learnpress' ),
							'slug'     => 'formateur-versement-liste',
							'callback' => array( $this, 'formateurHistoriqueVersement' ),
							'priority' => 30,
						),
						'formateur-statistique'   => array(
							'title'    => esc_html__( 'Statistiques', 'learnpress' ),
							'slug'     => 'formateur-statistique',
							'callback' => array( $this, 'formateurStatistiques' ),
							'priority' => 30,
						),
						'formateur-shop'   => array(
							'title'    => esc_html__( 'Être mis en avant', 'learnpress' ),
							'slug'     => 'formateur-shop',
							'callback' => array( $this, 'formateurShop' ),
							'priority' => 30,
						),
						
					),
                );
            }

            if(learn_press_current_user_is() != 'instructor'){
                $tabs['espace_formateur'] = array(
                    'title'    => esc_html__( 'Devenir formateur', 'learnpress' ),
                    'slug'     => 'devenir_formateur',
                    'icon'     => '<i class="fas fa-chalkboard-teacher"></i>',
                    'callback' => array( $this, 'devenirFormateur' ),
                    'priority' => 2,
					
                );
            }

			if(learn_press_current_user_is() == 'administrator' || learn_press_current_user_is() == 'moderator'){
                $tabs['espace_formateur'] = array(
                    'title'    => esc_html__( 'Gestion formateurs', 'learnpress' ),
                    'slug'     => 'gestion_formateurs',
                    'icon'     => '<i class="fas fa-chalkboard-teacher"></i>',
                    'callback' => array( $this, 'gestionFormateurs' ),
                    'priority' => 2,
					'sections' => array(
						'devenir-formateur-demande' => array(
							'title'    => esc_html__( 'Formateurs en attente', 'learnpress' ),
							'callback' => array( $this, 'gestionFormateurs' ),
							'priority' => 10,
						),
						'cours-en-attente'   => array(
							'title'    => esc_html__( 'Cours en attente', 'learnpress' ),
							'slug'     => 'cours-en-attente',
							'callback' => array( $this, 'coursEnAttente' ),
							'priority' => 30,
						),
						'gerer-formateurs'   => array(
							'title'    => esc_html__( 'Gérer les formateurs', 'learnpress' ),
							'slug'     => 'gerer-les-formateurs',
							'callback' => array( $this, 'gestionFormateurs' ),
							'priority' => 30,
						),
					),
                );
            }

			

			return $tabs;
		}
		
        function devenirFormateur(){
            require __DIR__.'/controller/devenir-formateur.php';
        }

		function gestionFormateurs(){
			require __DIR__.'/controller/gestion-formateurs.php';
		}

		function coursEnAttente(){
			require __DIR__.'/controller/cours-en-attente.php';
		}

		function formateurShop(){
			require __DIR__.'/controller/formateur-shop.php';
		}

		function formateurCommandeListe(){
			require __DIR__.'/controller/formateur-commande-liste.php';
		}

		function formateurHistoriqueVersement(){
			require __DIR__.'/controller/formateur-historique-versement.php';
		}

		function formateurPanel(){
			 header('Location:'.get_site_url().'/wp-admin');
		}

		function formateurStatistiques(){
			require __DIR__.'/controller/formateur-statistiques.php';
		}
	
	}
}

add_action( 'plugins_loaded', array( 'LP_Addon_Formateur_Tab', 'instance' ) );




?>