<p>Vous pouvez suivre l'état de votre demande. Mais aussi refaire votre demande en cliquant sur "Annuler"</p>
<style>
<?php require __DIR__ . '/asset/css/devenir-formateur-form.css'; ?>

.devenir-formateur-form input[disabled]{
    background:#EEEEEE;
    border:1px solid #DCDCDC;
}

.statut{
    <?php 
        if((int)$getStatut[0]->statut == 1){
            echo 'color:#ff5733;';
            $statut = 'En cours de vérification';

        }
        else if((int)$getStatut[0]->statut == 2){
            echo 'color:red;';
            $statut = 'Refusé';
        }
        else{
            echo 'color:green;';
            $statut = 'Accepté';
        } 
    ?>
    font-weight:bold;
}
</style>
<?php
if(isset($success)){
    echo '<div style = "display:block;background: #04AA6D;" class="alert"><span class="closebtn" onclick="this.parentElement.style.display=\'none\';">&times;</span>'.$success.'</div>';
    echo '<script>setTimeout(() => {window.location = "";},3000);</script>';
    die();
}
?>
<p class = "statut"><span style = "color:black">Statut : </span> [<?= $statut ?>]  <?= $getStatut[0]->raison ?> </p>

<form class = "devenir-formateur-form" method="post">
    <div  class = "inline-form">
        <label for="dvnom">Nom</label>
        <input disabled required type = "text" id = "dvnom" name = "dvnom" value = "<?= htmlspecialchars($getStatut[0]->nom) ?>"placeholder="Votre nom"/>
    </div>
    <div  class = "inline-form">
        <label for="dvprenom">Prénom</label>
        <input disabled required type = "text" id = "dvprenom" name = "dvprenom" value = "<?= htmlspecialchars($getStatut[0]->prenom) ?>" placeholder="Votre prénom"/>
    </div>
    <div  class = "inline-form">
        <label for="dvadresse">Adresse</label>
        <input disabled type = "text" id = "dvadresse" name = "dvadresse" value = "<?= htmlspecialchars($getStatut[0]->adresse_postale) ?>" placeholder = "Exemple : 3 rue des bernadins"/>
    </div>
    <div  class = "inline-form">

        <label for="dvcodep">Code postal </label>
        <input disabled type = "text" id = "dvcodep" name = "dvcodep" value = "<?= htmlspecialchars($getStatut[0]->code_postal) ?>" placeholder = "Votre code postal"/>
    </div>
    <div  class = "inline-form">

    <label for="dvtype">Vous êtes un </label>
    <input disabled required type = "text"  id = "dvtype" name = "dvtype" value = "<?= htmlspecialchars($getStatut[0]->statut_legal); ?>" placeholder = "Votre pays"/>
    </div>
    <div  class = "inline-form">
        <label for="dvtel">Téléphone </label>
        <input disabled required type = "tel" 
        id = "dvtel" name = "dvtel" value = "<?= htmlspecialchars($getStatut[0]->telephone) ?>" placeholder = "Votre numéro de téléphone"/>
    </div>

    <label for="dvpays">Pays </label>
    <input disabled required type = "text" 
        id = "dvpays" name = "dvpays" value = "<?= htmlspecialchars($getStatut[0]->pays); ?>" placeholder = "Votre pays"/>

    <?php 
        if(!empty($getStatut[0]->siret)){
          echo '<div class = "inline-form">';
          echo  '<label for="dventreprise">Nom d\'entreprise </label>';
          echo  '<input disabled type = "text" id = "dventreprise" value = "'. htmlspecialchars($getStatut[0]->nom_entreprise) .'" name = "dventreprise" placeholder = "Nom de votre entreprise"/>';
          echo '</div>';

          echo '<div class = "inline-form">';
          echo  '<label for="dvsiret">Siret </label>';
          echo  '<input disabled type = "text" id = "dvsiret" value = "'. htmlspecialchars($getStatut[0]->siret) .'" name = "dvsiret" placeholder = "Votre siret"/>';
          echo '</div>';
        }
    ?>

    <div  class = "inline-form">
        <label for="dvibans">Iban </label>
        <input disabled required type = "text" id = "dviban" value = "<?= htmlspecialchars($getStatut[0]->iban) ?>" name = "dviban" placeholder = "Votre Iban"/>
    </div>
    <div  class = "inline-form">
        <label for="dvbic">Bic </label>
        <input disabled required  value = "<?= htmlspecialchars($getStatut[0]->bic) ?>" type = "text" id = "dvbic" name = "dvbic" placeholder = "Votre bic"/>
    </div>
    
    <p><b>Pièce jointe</p>
    <iframe src = "<?= add_query_arg('actionpdf','actionpdf',home_url( $wp->request ))?>" style="width:100%;min-height:400px;" >Pdf</iframe>
    <input class = "submit-dvformateur" value="Annuler" name="submit" type = "submit"/>


</form>