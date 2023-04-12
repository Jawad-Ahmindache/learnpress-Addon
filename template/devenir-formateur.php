
<h2> Mon profil de formateur </h2>



<?php 
// Afficher formulaire si aucune demande n'a été faite
if(!isRowExist('statut','wa_formateur','user_login',wp_get_current_user()->user_login)){
    require(__DIR__.'/devenir-formateur-form.php');
}
else
    require(__DIR__.'/devenir-formateur-panel.php');
?>