<?php

global $wpdb;

if(isset($_POST['formateurAction'])){
    $postUserLogin = esc_sql($_POST['statut-user-login']);

    if($_POST['formateurAction'] == 'paid'){
        
            
    }
    if($_POST['formateurAction'] == 'revoke'){
        $postRaison = esc_sql($_POST['statutRaison']);
        if($wpdb->update('wa_formateur',array('statut' => 4, 'raison' => $postRaison),array('user_login' => $postUserLogin))){
            $userToAccept = get_user_by('login',$postUserLogin);
            $userToAccept->set_role('subscriber');
            die('statut-formateur : success');
        }
        
    }

}

$getAllFormsDemandes = $wpdb->get_results("SELECT * FROM wa_formateur WHERE statut = 3");
$resultNumber = $wpdb->num_rows;


require __DIR__.'/../template/gestion-formateurs-gerer.php';