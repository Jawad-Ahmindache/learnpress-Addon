<?php
//controller
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
// Prendre les postes de type Order (commande) qui sont complétés et qui concernent le formateur
$args = array(
    'post_type'=> 'lp_order',
    'post_status' => 'lp-completed',
    'meta_key' => 'teacher',
    'meta_query' => array(
        array(
            'key' => 'teacher',
            'value' => wp_get_current_user()->user_login,
            'compare' => '=',
        )
    )

);


$listeCommande = get_posts($args);

require __DIR__.'/../template/formateur-commande-liste.php';