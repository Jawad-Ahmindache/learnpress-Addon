<?php

global $wpdb;

if(isset($_POST['statutFormateur'])){
    $postUserLogin = esc_sql($_POST['statut-user-login']);

    if($_POST['statutFormateur'] == 'accepter'){
        if($wpdb->update('wa_formateur',array('statut' => 3),array('user_login' => $postUserLogin))){ // Execute la requete et vérifie si elle a fonctionnée
                $userToAccept = get_user_by('login',$postUserLogin);
                if($userToAccept){
                    $userToAccept->set_role('lp_teacher');
                    $wpdb->update('wa_formateur',array('raison' => ''),array('user_login' => $postUserLogin));
                    
                }
                die();
        } 
            
    }
    if($_POST['statutFormateur'] == 'refuser'){
        $postRaison = esc_sql($_POST['statutRaison']);
        if($wpdb->update('wa_formateur',array('statut' => 2, 'raison' => $postRaison),array('user_login' => $postUserLogin)))
            die('statut-formateur : success');

        
    }

}

$getAllFormsDemandes = $wpdb->get_results("SELECT * FROM wa_formateur WHERE statut = 1");
$resultNumber = $wpdb->num_rows;


require __DIR__.'/../template/gestion-formateurs-demandes.php';