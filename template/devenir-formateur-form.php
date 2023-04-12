<p>Vous souhaitez être formateur ? Merci de remplir ce formulaire. Une fois le formulaire envoyé, l'équipe de modération confirmera votre demande </p>
<style>
<?php require __DIR__.'/asset/css/devenir-formateur-form.css'; ?>
</style>
<?php

    if(isset($error))
    {
        if($error != false)
            echo '<div style = "display:block;background: #f44336;" class="alert"><span class="closebtn" onclick="this.parentElement.style.display=\'none\';">&times;</span>'.$error.'</div>';
    }
    


?>
<form class = "devenir-formateur-form" method = "post" enctype="multipart/form-data">

    <div  class = "inline-form">
        <label for="dvnom">Nom<span class = "required">*</span></label>
        <input required type = "text" id = "dvnom" name = "dvnom" value = "<?= isset($_POST['dvnom']) ? $_POST['dvnom']:''; ?>"placeholder="Votre nom"/>
    </div>
    <div  class = "inline-form">
        <label for="dvprenom">Prénom<span class = "required">*</span></label>
        <input required type = "text" id = "dvprenom" name = "dvprenom" value = "<?= isset($_POST['dvprenom']) ? $_POST['dvprenom']:''; ?>" placeholder="Votre prénom"/>
    </div>
    <div  class = "inline-form">
        <label for="dvadresse">Adresse<span class = "required">*</span></label>
        <input type = "text" id = "dvadresse" name = "dvadresse" value = "<?= isset($_POST['dvadresse']) ? $_POST['dvadresse']:''; ?>" placeholder = "Exemple : 3 rue des bernadins"/>
    </div>
    <div  class = "inline-form">

        <label for="dvcodep">Code postal <span class = "required">*</span></label>
        <input type = "text" id = "dvcodep" name = "dvcodep" value = "<?= isset($_POST['dvcodep']) ? $_POST['dvcodep']:''; ?>" placeholder = "Votre code postal"/>
    </div>
    <label for="dvpays">Pays<span class = "required">*</span> </label>
    <select required name="dvpays" id="dvpays">
        <option value ="">-- Pays --</option>
        <option value="france">France</option>
        <option value="belgique">Belgique</option>
        <option value="suisse">Suisse</option>
        <option value="canada">Canada</option>
        <option value="luxembourg">Luxembourg</option>
        <option value="autre">Autre</option>
    </select>
    <div  class = "inline-form">
        <label for="dvtel">Téléphone<span class = "required">*</span> </label>
        <input required type = "tel" 
        id = "dvtel" name = "dvtel" value = "<?= isset($_POST['dvtel']) ? $_POST['dvtel']:''; ?>" placeholder = "Votre numéro de téléphone"/>
    </div>
    <div  class = "inline-form">
        <label for="dvtype">Votre statut<span class = "required">*</span> </label>
        <select required name="dvtype" id="dvtype">
            <option value ="">-- Vous êtes un --</option>
            <option value="Particulier">Particulier</option>
            <option value="Auto-entrepreneur">Auto-entrepreneur</option>
            <option value="Professionnel">Professionnel</option>
        </select>
    </div>
  

    <div class = "inline-form" id = "entreprise-nom">
        <label for="dventreprise">Nom de l'entreprise<span class = "required">*</span> </label>
        <input type = "text" id = "dventreprise" value = "<?= isset($_POST['dventreprise']) ? $_POST['dventreprise']:''; ?>" name = "dventreprise" placeholder = "Nom de votre entreprise"/>
    </div>
    <div class = "inline-form" id = "siret">
        <label for="dvsiret">Siret<span class = "required">*</span> </label>
        <input type = "text" id = "dvsiret" value = "<?= isset($_POST['dvsiret']) ? $_POST['dvsiret']:''; ?>" name = "dvsiret" placeholder = "Votre siret"/>
    </div>

    
    <div  class = "inline-form">
        <label for="dvibans">Iban<span class = "required">*</span> </label>
        <input required type = "text" id = "dviban" value = "<?= isset($_POST['dviban']) ? $_POST['dviban']:''; ?>" name = "dviban" placeholder = "Votre Iban"/>
    </div>
    <div  class = "inline-form">
        <label for="dvbic">Bic<span class = "required">*</span> </label>
        <input required  value = "<?= isset($_POST['dvbic']) ? $_POST['dvbic']:''; ?>" type = "text" id = "dvbic" name = "dvbic" placeholder = "Votre bic"/>
    </div>

    <label id = "dvfile-label" for="dvfile">Votre pièce d'identité recto/verso (jpg,jpeg,png,pdf)<span class = "required">*</span> </label>
    <input type="file" name = "dvfile" id= "dvfile"/>
<input class = "submit-dvformateur" type = "submit"/>
</form>


<script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.3/dist/jquery.validate.min.js"></script>
<script><?php include __DIR__.'/asset/js/devenir-formateur-form.js'; ?></script>