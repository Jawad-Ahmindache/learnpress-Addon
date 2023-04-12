<?php
/**
 * @package wa-es-formateur
 * @version 1.0
 */
/*
Plugin Name: wa-es-formateur
Plugin URI: http://wordpress.org/plugins/hello-dolly/
Description: Tout ce qui concerne l'espace formateur
Version: 1.0
Author URI: http://example.com/
*/

// Sur ce code on y trouve non seulement non seulement les petites améliorations générales comme les micro bugs graphiques mais aussi, le chargement des premiers fichiers du plugin.

require __DIR__.'/functions.php';
require __DIR__.'/formateur-tab.php';
require __DIR__.'/inc/statistiques.php';

add_action('wp_enqueue_scripts', 'fix_profile_section');
add_action('learnpress/template/pages/checkout/before-content','modifyCheckoutPage'); // change color checkout
add_action('learnpress/template/pages/profile/before-content','userprofil');

add_action( 'learnpress/template/pages/checkout/after-content','modifyCheckoutPageJS' );

add_action('learn-press/before-form-login','debug_form');
add_action('learn-press/before-form-register','debug_form');
function debug_form(){ //Pour afficher les messages d'erreur dans le formulaire de connexion et inscription
    if ( ! is_user_logged_in() ) {
        learn_press_print_messages( true );
    }

    echo '<style>
        .learn-press-message.error{
            padding: 20px;
            background-color: #f44336; /* Red */
            color: white;
            margin-bottom: 15px;
        }

        .login-from .rwmb-field input[type="text"], .login-from .rwmb-field input[type="email"], .login-from .rwmb-field input[type="password"], .login-from .form-field input[type="text"], .login-from .form-field input[type="email"], .login-from .form-field input[type="password"]{
                background:white!important;
                border: 2px solid rgba(40, 120, 235,0.2)!important;
                color:black!important;
        }
    </style>';
}
function userprofil(){ // Pour remettre la page profil formateur
    $user = get_user_by( 'slug', get_query_var( 'user'));
    global $current_user;
    if($user->user_login != $current_user->user_login){
        if($user != false)
            require __DIR__.'/profile-instructor.php';
    }

}


// Un bug qui faisait sortir le texte du conteneur, cette section le corrige
function fix_profile_section(){
    echo '<style>
        #learn-press-profile #profile-nav .lp-profile-nav-tabs li > ul {
            white-space:nowrap;
        }
        #learn-press-profile #profile-nav .lp-profile-nav-tabs > li.active a{
  
        }
    </style>';


}

function modifyCheckoutPage(){
    echo '<style>.error { color:red!important} .order-comments {display:none;}
    .connexion-btn {
        border-color:#2878EB;

        background:#2878EB;
    }

    .connexion-btn:hover{
        border-color:#F14D5D;
        background:#F14D5D;
    }
    </style>';

    
}

function modifyCheckoutPageJS(){

    if(!is_user_logged_in()){
        echo '<script>
        document.querySelector(".lp-checkout-form__after").innerHTML = "";
    
        document.querySelector(".lp-checkout-form__after").innerHTML = "<a href = \"register\" style = \"color:white\" class = \"btn btn-primary\">Inscription</a><a href = \"login\" style = \"color:white\" class = \"btn btn-primary connexion-btn\">Connexion</a>";
        </script>';

    }
 
}


?>