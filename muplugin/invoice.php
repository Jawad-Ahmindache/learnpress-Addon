<?php

require __DIR__.'/vendor/autoload.php';
use Konekt\PdfInvoice\InvoicePrinter;

function invoice_maker($facture,$dir,$render,$additionnal){ //additionnal | by : WC = webcorporate ; FM = Formateur ; tva = indication TVA; frais = indication frais 
    
    $invoice = new InvoicePrinter('A4','€','fr');
    

    $invoice->setLogo(__DIR__."/sample1.jpg");   //logo image path
    $invoice->setColor("#007fff");      // pdf color scheme
    $invoice->setType("Facture");    // Invoice Type
    $invoice->setReference($facture['order_key']);   // Reference
    $invoice->setDate($facture['date']);   //Billing Date
    
    if($additionnal['by'] == 'WC'){
        $invoice->setFrom(array('Formateur : ' . $facture['formateur'],"WebCorporate Academy","Le Majestic, 4 Bd de Cimiez","06000 Nice","Siret : 83146390600014"));
        $invoice->setTo(array($facture['name'],$facture['email_acheteur']));
    }else{
        $invoice->setTo(array("Academy","","",""));
        $invoice->setFrom(array($facture['nom_entreprise'],$facture['email_formateur'],$facture['adresse_formateur'],$facture['code_postal'],$facture['siret_formateur']));
    }
    $invoice->addItem($facture['produit'],'',$facture['quantite'],$facture['montant_tva'],$facture['frais_banque'],$facture['prix_HT'],$facture['frais'],$facture['prix_TTC']);
    
    
    
    $invoice->addTotal("TVA ".'%'.$additionnal['tva'],$facture['montant_tva']);
    $invoice->addTotal("Total",$facture['prix_TTC'],true);
    
    
    
    $invoice->addTitle("Note importante");
    
    $invoice->addParagraph('Payé avec : '. $facture['payment_method'].'<br/> - Les frais de services sont de '.$additionnal['frais'].'%<br/> - La TVA est de '.$additionnal['tva'].'%');
    
    $invoice->setFooternote("Academy");
    
    $invoice->render($dir,$render); //$dir = DIR to save, $render =  I => Display on browser, D => Force Download, F => local path save, S => return document as string

}




