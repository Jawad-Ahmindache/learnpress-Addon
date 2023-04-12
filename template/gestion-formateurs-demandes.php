

<style>
table > thead > tr > th, table > tbody > tr > th, table > tfoot > tr > th, table > thead > tr > td, table > tbody > tr > td, table > tfoot > tr > td{
    border:none;
}
.table td, .table th{
    vertical-align:middle;
}
.secondary-table-col {
    background:#f4f6fc;
    
}

.login-user:hover .menu-list {
    z-index:9999;
}
</style>
<table class = "temporary-table">
    <?php
       for($i = 0; $i < $resultNumber; $i++){
            echo '<tr><th scope="row" class="secondary-table-col scope border-bottom-0"><img style = "max-width:150px;width:100%;" src = "'.get_avatar_url(get_user_by('login',$getAllFormsDemandes[$i]->user_login)->ID).'" /></th>';
            echo '<td class="border-bottom-0">'.$getAllFormsDemandes[$i]->user_login.'</td>';
            echo '<td class="secondary-table-col border-bottom-0">'.$getAllFormsDemandes[$i]->email.'</td>';
            echo '<td class="border-bottom-0">'.$getAllFormsDemandes[$i]->telephone.'</td>';   
            echo '<td class="secondary-table-col border-bottom-0">'.$getAllFormsDemandes[$i]->siret.'</td>';
            echo '<td class="secondary-table-col border-bottom-0">'.$getAllFormsDemandes[$i]->nom_entreprise.'</td>';
            echo '<td class="border-bottom-0">'.$getAllFormsDemandes[$i]->iban.'</td>';
            echo '<td class="secondary-table-col border-bottom-0">'.$getAllFormsDemandes[$i]->bic.'</td>';
            echo '<td class="border-bottom-0">'.$getAllFormsDemandes[$i]->pays.'</td>';
            echo '<td class="secondary-table-col border-bottom-0">'.$getAllFormsDemandes[$i]->statut_legal.'</td>';
            
            echo '<td style = "max-width:400px" class="border-bottom-0">
                <a href="#" data-user = "'.$getAllFormsDemandes[$i]->user_login.'" class="action-btn-allow btn btn-success">Accepter</a>
                <a href="#" data-user = "'.$getAllFormsDemandes[$i]->user_login.'" class="action-btn-deny btn btn-danger">Refuser</a><br/>
                <a style = "margin-top:10px;" href="'. add_query_arg(array('actionpdf'=>'actionpdf','data-user'=>$getAllFormsDemandes[$i]->user_login),home_url( $wp->request )).'" target="_blank" class="btn btn-info">Pièce Jointe</a>
             </td> 
             </tr>"';
        }
        if($resultNumber == 0){
            echo '<td></td>';
            echo '<td></td>';
            echo '<td></td>';
            echo '<td>Il n\'y a pas de demandes en attente</td>';
            echo '<td></td>';
            echo '<td></td>';
            echo '<td></td>';
            echo '<td></td>';
            echo '<td></td>';
        }
         
    ?>



    </table>


<?php
// Faire apparaitre le tableau sur toute la page
echo '<script>
document.addEventListener(\'DOMContentLoaded\', function() {
    document.body.innerHTML += "\r\n\r\n\t<section style=\"position:absolute;min-height:"+document.querySelector(\'body\').offsetHeight + 
"px;width:100%;z-index:9998;background:white;top:90px;\" class=\"ftco-section\">\r\n\t\t <div style = \"overflow:auto\"class=\"container-fluid\"><div class=\"row\"> <div class=\"col-md-12\"> <div class=\"table-wrap\"> <table class=\"table\"><thead class=\"thead-primary\">"
+"<tr style = \"background:#2878EB;color:white\"><th>Photo de profil</th><th>Nom</th><th>E-mail</th><th>Telephone</th><th>Siret</th><th>Entreprise</th><th>Iban</th><th>Bic</th><th>Pays</th><th>Statut</th><th>Action</th></tr></thead><tbody class = \"formateurs-demandes-table\">"

        +"</tbody></table></div></div></div></div><\/section>\r\n\r\n";


let formateurTable = document.querySelector(".formateurs-demandes-table");
let temporaryTable = document.querySelector(".temporary-table").innerHTML;

formateurTable.insertAdjacentHTML( \'beforeend\', temporaryTable );


setTimeout(()=>{
    let accepterButton = document.querySelectorAll(\'.action-btn-allow\');
    let refuserButton = document.querySelectorAll(\'.action-btn-deny\');
    let raisonStatut = null;
    for(let i = 0; i < accepterButton.length; i++){
        accepterButton[i].addEventListener(\'click\',()=>{
            let xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
              if (this.readyState == 4 && this.status == 200) {
                accepterButton[i].parentElement.parentElement.remove();
              }
            };
            xhttp.open("POST", "", true);
            xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhttp.send("statutFormateur=accepter&statut-user-login="+accepterButton[i].getAttribute(\'data-user\'));
        });
        refuserButton[i].addEventListener(\'click\',()=>{
            raisonStatut = prompt("Entrez la raison du refus");
            if(raisonStatut != null){
                let xhttp = new XMLHttpRequest();
                xhttp.onreadystatechange = function() {
                  if (this.readyState == 4 && this.status == 200) {
                    accepterButton[i].parentElement.parentElement.remove();
                  }
                };
                xhttp.open("POST", "", true);
                xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                xhttp.send("statutRaison="+raisonStatut+"&statutFormateur=refuser&statut-user-login="+accepterButton[i].getAttribute(\'data-user\'));
                raisonStatut = null;
            }
            
        });
    }
},500);

 }, false);


</script>';

?>









