<?php

// Vérifier donne du formulaire des formateurs puis inserer dans la db
if(isset($_POST['dvnom'])){
    
    if(isRowExist('statut','wa_formateur','user_login',wp_get_current_user()->user_login)){
        header('Location:..');
        die();
    }
    if($_POST['dvtype'] == 'Particulier'){
        $_POST['dvsiret'] = null;
        $_POST['dventreprise'] = null;
    }
$error = false;
$paysListe = array('france','belgique','suisse','canada','luxembourg','autre');
if(!preg_match('/^[\w.\- ]+$/i',$_POST['dvnom']) || empty($_POST['dvnom']) || strlen($_POST['dvnom']) > 50 ) 
    $error = 'Votre nom doit faire maximum 50 caractères et doit être au format alphanumérique';

    
if(!preg_match('/^[\w.\- ]+$/i',$_POST['dvprenom']) || empty($_POST['dvprenom']) || strlen($_POST['dvprenom']) > 50 ) 
    $error = 'Votre prénom doit faire maximum 50 caractères et doit être au format alphanumérique';

 if(!preg_match('/^[\w.\- ]+$/i',$_POST['dvadresse']) || strlen($_POST['dvadresse']) > 50 || empty($_POST['dvadresse'])) 
    $error = 'Votre adresse doit faire maximum 50 caractères et doit être au format alphanumérique';



    if(!is_numeric($_POST['dvcodep']) || strlen($_POST['dvcodep']) > 20 || empty($_POST['dvadresse'])) 
       $error = 'Votre code postal doit faire maximum 20 caractères et doit contenir que des nombres';



if(!preg_match('/^\+?[0-9]*$/', $_POST['dvtel']) || empty($_POST['dvtel']) || strlen($_POST['dvtel']) > 15)
    $error = 'Format téléphone incorrect ou supérieur à 15 caractères';

if(!in_array($_POST['dvpays'],$paysListe) || empty($_POST['dvpays']) || strlen($_POST['dvpays']) > 100)
    $error = 'Choisissez un pays parmi la liste';

if(!empty($_POST['dvsiret'])){
    if(!is_numeric($_POST['dvsiret']) || strlen($_POST['dvsiret']) > 15)
        $error = 'Votre siret doit faire au maximum 15 caractères et ne doit contenir que des chiffres';
}

if(strlen($_POST['dviban']) > 34 || empty($_POST['dviban']) || !ctype_alnum($_POST['dviban']))
    $error = 'Votre IBAN est incorrect';

if(strlen($_POST['dvbic']) > 11 || empty($_POST['dvbic']) || !ctype_alnum($_POST['dvbic']))
    $error = 'Votre BIC est incorrect';

if($_POST['dvtype'] != 'Particulier' && $_POST['dvtype'] != 'Professionnel' && $_POST['dvtype'] != 'Auto-entrepreneur')
    $error = 'Veuillez entrer un statut valide';

if(($_POST['dvtype'] == 'Professionel' || $_POST['dvtype'] == 'Auto-entrepreneur') && empty($_POST['dvsiret']))
    $error = 'Veuillez entrer un siret';

if(($_POST['dvtype'] == 'Professionel' || $_POST['dvtype'] == 'Auto-entrepreneur') && empty($_POST['dventreprise'])){
    $error = 'Nom d\'entreprise à remplir';
}

if(!empty($_POST['dventreprise'])){
    if(!preg_match('/^[\w.\- ]+$/i',$_POST['dventreprise']) || strlen($_POST['dventreprise']) > 100){
        $error = 'le nom de votre entreprise doit contenir que des chiffres,lettres et tirets et faire maximum 100 caractères';
    }
}


if($error == false){
    if (!isset($_FILES["dvfile"])) {
        $error = 'Veuillez indiquer une pièce jointe';
    }else{
    

        
        $filepath = $_FILES['dvfile']['tmp_name'];
        $fileSize = filesize($filepath);

        $fileinfo = finfo_open(FILEINFO_MIME_TYPE);
    
        $filetype = finfo_file($fileinfo, $filepath);

        if ($fileSize === 0) {
            $error = 'Le fichier est vide.';
        }
        
        if ($fileSize > 3145728) { // 3 MB (1 byte * 1024 * 1024 * 3 (for 3 MB))
           $error = 'Le fichier est trop volumineux (max 3 MB)';
        }
        
        $allowedTypes = [
        'image/png' => 'png',
        'image/jpeg' => 'jpg',
        'application/pdf' => 'pdf'
        ];
        
        if (!in_array($filetype, array_keys($allowedTypes))) {
            $error = "Type de fichier pas permis";
        }
        
        $filename = basename($filepath); // I'm using the original name here, but you can also change the name of the file here
        
        $extension = $allowedTypes[$filetype];
        $targetDirectory = __DIR__ . "/../upload"; // __DIR__ is the directory of the current PHP file
        $filename = md5($filename);
        $newFilepath = $targetDirectory . "/" . $filename . "." . $extension;
      
        if (!move_uploaded_file($filepath, $newFilepath)) { // Copy the file, returns false if failed
            $error = 'Erreur au niveau du fichier';
        }
        
        if(!file_exists($newFilepath))
            $error = 'Le fichier a été mal téléversé veuillez réessayer';
        unlink($filepath); // Delete the temp file
        

        if($error != false)
            unlink($newFilepath);
         
        if($error == false){
            
            $success = "Demande envoyée avec succès ! Un modérateur va valider votre profil d'ici peu. Une fois validé vous pourrez déposer un cours";
            $wpdb->insert('wa_formateur',array(
                    'email' => wp_get_current_user()->user_email,
                    'iban' => strtoupper(esc_sql($_POST['dviban'])),
                    'telephone' => esc_sql($_POST['dvtel']),
                    'siret' => esc_sql($_POST['dvsiret']),
                    'nom' => ucfirst(esc_sql($_POST['dvnom'])),
                    'prenom' => ucfirst(esc_sql($_POST['dvprenom'])),
                    'adresse_postale' => ucfirst(esc_sql($_POST['dvadresse'])),
                    'code_postal' => esc_sql($_POST['dvcodep']),
                    'pays' => ucfirst(esc_sql($_POST['dvpays'])),
                    'statut' => 1, // 1 = En cours; 2 = Refusé; 3 = Accepté
                    'bic' => strtoupper(esc_sql($_POST['dvbic'])),
                    'user_login' => wp_get_current_user()->user_login,
                    'statut_legal' => $_POST['dvtype'],
                    'nom_entreprise' => esc_sql($_POST['dventreprise']),
                    'piece_jointe' => $filename.'.'.$extension,
                    'raison' => ''
            ));
    
            }

        }
    }
    


    

}

