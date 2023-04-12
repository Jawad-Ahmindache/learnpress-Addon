<?php
global $wp;
if(isset($_GET['data-invoice'])){
    if(!empty($_GET['data-invoice'])){
            $facture = (array)json_decode(str_replace('\"','"',urldecode($_GET['data-invoice']))); // remplace les caractères échappés puis convertie json en array

            ob_start();
            invoice_maker($facture,'','I');
            
            ob_end_flush();
            die();
    }
}
//controller
global $wpdb;

if($versementListe = $wpdb->get_results('SELECT * FROM wa_versement WHERE user_id = '. get_current_user_id())){
    $formateurInfo = $wpdb->get_results('SELECT * FROM wa_formateur WHERE user_login = "'. wp_get_current_user()->user_login.'"');


    require __DIR__.'/../template/formateur-historique-versement.php';    
}else{
    echo 'Vous n\'avez pas encore eu de versements';
}

