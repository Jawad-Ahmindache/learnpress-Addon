<?php

global $wpdb;
if(!is_user_logged_in()){
    
    die("Vous devez être connecté pour faire cela");

}

// Controller formulaire formateur si pas de demande en cours
if(!isRowExist('statut','wa_formateur','user_login',wp_get_current_user()->user_login)){
    require __DIR__.'/devenir-formateur-form.php';
}
else{
    
    $isBanned = $wpdb->get_results('SELECT statut,raison FROM wa_formateur WHERE user_login = "'.wp_get_current_user()->user_login .'"');
    if((int)$isBanned[0]->statut === 4 )
        die('Vous êtes banni :  '.$isBanned[0]->raison. '<br/>Si vous pensez que c\'est une erreur, contactez le support.');
    require(__DIR__.'/devenir-formateur-panel.php');
}




require __DIR__.'/../template/devenir-formateur.php';


  
?>