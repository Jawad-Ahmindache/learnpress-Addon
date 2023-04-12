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
<h2> Historique de commandes</h2><br/>
<section class="ftco-section"><div style = "overflow:auto"class="container-fluid"><div class="row"> <div class="col-md-12"> <div class="table-wrap"> <table class="table"><thead class="thead-primary">
<tr style = "background:#2878EB;color:white\">
    <th>Commande</th>
    <th>Client</th>
    <th>Produit</th>
    <th>Prix</th>
    <th>Action</th>

</tr>
</thead>
<tbody class = "formateurs-demandes-table">
<?php


for($i = 0; $i < count($listeCommande); $i++){
    $order = learn_press_get_order($listeCommande[$i]->ID);
    $teacher = new LP_Course($order->get_items()[array_key_first($order->get_items())]['course_id']);
    $user = get_user_by('id',$order->user_id);
   
    $facture = array(
        'order_key' => $order->get_order_key(),
        'date' => (string)$order->get_date_modified(),
        'formateur' => $teacher->get_author()->get_data('first_name') . ' ' .$teacher->get_author()->get_data('last_name'). ' (' . $teacher->get_author()->get_data('nickname') . ')',
        'name' =>  $user->display_name . ' (' . $user->user_login.')',
        'email_acheteur' => $user->user_email,
        'produit' => $order->get_items()[array_key_first($order->get_items())]['name'],
        'quantite' => $order->get_items()[array_key_first($order->get_items())]['quantity'],
        'montant_tva' => round(((float)$order->get_total()/1.20) * 0.20,2),
        'prix_HT' => round((float)$order->get_total()/1.20,2) - (round((((float)$order->get_total()/1.20)/1.10) * 0.10,2)),
        'frais' => round((((float)$order->get_total()/1.20)/1.10) * 0.10,2),
        'prix_TTC' => $order->get_total(),
        'payment_method' => $order->get_payment_method_title()
    );
    
    
 
    //echo '<a href = "'.add_query_arg('data-invoice',$facture,home_url( $wp->request )).'">fff</a>';
    echo '<tr>';
    echo '<td class="secondary-table-col border-bottom-0">'.$facture['order_key'].'</td>';
    echo '<td class="border-bottom-0"><a target="_blank" href = "'.get_site_url().'/profile/'.$user->user_login.'">'.$user->display_name.'</a></td>';
    echo '<td class="secondary-table-col border-bottom-0">'.$facture['produit'].'</td>';
    echo '<td class="border-bottom-0">'.$facture['prix_TTC'].'</td>';

    echo '<td class="secondary-table-col border-bottom-0">
        '.$facture['date'].'
    </td>';

    echo '</tr>';
}

?>
        
</tbody
></table></div></div></div></div></section>

<?php
hideLearnpresTabNav();
?>
