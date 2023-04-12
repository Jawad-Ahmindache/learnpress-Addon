<?php

$getStatut = $wpdb->get_results("SELECT * FROM wa_formateur WHERE user_login = '".wp_get_current_user()->user_login."'");
global $wp;

if(isset($_GET['actionpdf'])){
    

    if($_GET['actionpdf'] != 'step2'){
        $_SESSION['tmp_pdf_file'] = __DIR__.'/../upload/'.$getStatut[0]->piece_jointe;
        wa_redirect(add_query_arg('actionpdf','step2',home_url( $wp->request ))); // VOIR MU-PLUGINS/showpdf.php pour l'affichage pdf
        die();
    }
        
}

if($getStatut[0]->statut == 3){
    header('Location:..');
    die();
}

if(isset($_POST['submit'])){ //Supprimer la demande si cliqué sur Anuler
    $wpdb->delete('wa_formateur',array('user_login' => wp_get_current_user()->user_login));
    unlink(__DIR__.'/../upload/'.$getStatut[0]->piece_jointe);
}
?>