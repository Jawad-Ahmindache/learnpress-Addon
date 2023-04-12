<?php
global $wp_query;
global $wp;
global $wpdb;
$getStatut = $wpdb->get_results("SELECT * FROM wa_formateur WHERE user_login = '".esc_sql($_GET['data-user'])."'");


if(isset($_GET['actionpdf'])){
    if($_GET['actionpdf'] != 'step2'){
        $_SESSION['tmp_pdf_file'] = __DIR__.'/../upload/'.$getStatut[0]->piece_jointe;
        wa_redirect(add_query_arg('actionpdf','step2',home_url( $wp->request ))); // VOIR MU-PLUGINS/showpdf.php pour l'affichage pdf
        die();
    }
        
}

if($wp_query->query_vars['section'] == 'gerer-les-formateurs')
    require __DIR__.'/gestion-formateurs-gerer.php'; //controller

if($wp_query->query_vars['section'] == 'devenir-formateur-demande')
    require __DIR__.'/gestion-formateurs-demandes.php'; //controller

require __DIR__.'/../template/gestion-formateurs.php';