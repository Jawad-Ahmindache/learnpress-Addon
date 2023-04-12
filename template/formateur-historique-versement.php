<style>


table > thead > tr > th, table > tbody > tr > th, table > tfoot > tr > th, table > thead > tr > td, table > tbody > tr > td, table > tfoot > tr > td{
    border:none!important;
   
}

thead > tr > th {
    color:white!important;
}

.table td, .table th{
    vertical-align:middle;
}
.secondary-table-col {
    background:#f4f6fc!important;
  
}



.user-dashboard .lp-profile-content table th, .user-dashboard .lp-profile-content .lp-list-table th {
    background:#2878EB!important;
}
</style>
<h2> Historique des versements</h2>
<p> En cas de soucis, veuillez contacter le support</p><br/>
<section class="ftco-section"><div style = "overflow:auto"class="container-fluid"><div class="row"> <div class="col-md-12"> <div class="table-wrap"> <table class="table"><thead class="thead-primary">
<tr style = "background:#2878EB;color:white\">
    <th>Date</th>
    <th>Montant</th>
    <th style = "width:50px">Action</th>

</tr>
</thead>
<tbody class = "formateurs-demandes-table">
<?php


for($i = 0; $i < count($versementListe); $i++){
    $user = wp_get_current_user();
    $facture = array(
        'order_key' => $versementListe[$i]->versement_id,
        'date' => $versementListe[$i]->date_pay,
        'formateur' => $user->user_login,
        'name' =>  $user->display_name,
        'email_acheteur' => $user->user_email,
        'produit' => 'Versement du '.$versementListe[$i]->date_pay,
        'quantite' => 1,
        'montant_tva' => 0,
        'prix_HT' => $versementListe[$i]->montant,
        'frais' => 0,
        'prix_TTC' => $versementListe[$i]->montant,
        'payment_method' => 'Virement Bancaire'
    );
    

    $facture = array(
    'order_key' => $versementListe[$i]->versement_id,
    'date' => $versementListe[$i]->date_pay,
    'formateur' => 'WebCorporate Academy',
    'name' => $formateurInfo[0]->nom,
    'email_formateur' => $formateurInfo[0]->email,
    'nom_entreprise' => $formateurInfo[0]->nom_entreprise,
    'adresse_formateur' => $formateurInfo[0]->adresse_postale,
    'code_postal' => $formateurInfo[0]->code_postal,
    'siret_formateur' => $formateurInfo[0]->siret,
    'produit' => 'Versement du '.$versementListe[$i]->date_pay,
    'quantite' => 1,
    'montant_tva' => ($versementListe[$i]->montant * 1.01) * 0.20 ,
    'frais_banque' => $versementListe[$i]->montant * 0.01,
    'prix_HT' => 2,
    'frais' => 3,
    'prix_TTC' => 4,
    'payment_method' => 'Virement Bancaire'
    );

    if($formateurInfo[0]->statut === 'Particulier' || $formateurInfo[0]->statut == 'Auto-entrepreneur'){
        $facture['montant_tva'] = 0;
    }
    $additionnal = array(
        'by' => 'FM',
        'tva' => '20',
        'frais' => '10'
    );
    echo '<tr>';
    echo '<td class="secondary-table-col border-bottom-0">'.$versementListe[0]->date_pay.'</td>';
    echo '<td class="border-bottom-0">'.$versementListe[0]->montant.'</td>';

    $facture = urlencode(json_encode($facture));
    echo '<td class="secondary-table-col border-bottom-0">
        <a href = "'.add_query_arg('data-invoice',$facture,home_url( $wp->request )).'" target="_blank" style = "color:white" class="action-btn-allow btn btn-primary">Facture</a>
    </td>';

    echo '</tr>';
}

?>
        
</tbody
></table></div></div></div></div></section>

<?php
hideLearnpresTabNav();
?>
