

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
.btn {
    padding: 5px;
    width:100px;
    margin-top:5px;
}
.login-user:hover .menu-list {
    z-index:9999;
}
</style>
<h2> Cours en attente <h2>
<table class = "temporary-table">
    <?php
      for($i = 0; $i < count($listCourse); $i++){
            $course = learn_press_get_course( $listCourse[$i]->ID );
            // In ra so student da enroll.
            $student = LP()->utils->count_course_users(
                array(
                    'course_id'  =>$listCourse[$i]->ID,
                    'status'     => learn_press_course_enrolled_slugs(),
                    'total_only' => true,
                )
            );

            $price   = $course->get_price();
            $is_paid = ! $course->is_free();
            $origin_price = '';
            $final_price = '';
            if ( $course->get_origin_price() && $course->has_sale_price() ) {
                $origin_price = $course->get_origin_price_html();
            }

            if ( $is_paid ) {
                $final_price = $origin_price . ' ' . $price;
            } else {
                $final_price = esc_html__( 'Free', 'learnpress' );
            }
           
            $vignette = $course->get_image( 'thumbnail');
            $vignette = preg_split('/"/',preg_split('/src="/', $vignette)[1])[0];
            echo '<tr><th scope="row" class="secondary-table-col scope border-bottom-0"><img style = "max-width:150px;width:100%;" src = "'.$vignette.'" /></th>';
            echo '<td class="border-bottom-0">'.$listCourse[$i]->post_title.'</td>';
            echo '<td class="secondary-table-col border-bottom-0">'.get_user_by('id',(int)$listCourse[$i]->post_author)->user_login .'</td>';
            
            echo '<td class="border-bottom-0">'.get_course_content_excerpt($listCourse[$i]->ID).'</td>';   
            echo '<td class="secondary-table-col border-bottom-0">'.$student.'</td>';
            echo '<td class="border-bottom-0">'.$final_price.'</td>';
            echo '<td class="secondary-table-col border-bottom-0">'.get_the_term_list( $listCourse[$i]->ID, 'course_category').'</td>';
            echo '<td  class="border-bottom-0">'.$listCourse[$i]->post_modified.'</td>';
            echo '<td style = "width:250px"class="secondary-table-col border-bottom-0">
             <a href="#" data-id = "'.$listCourse[$i]->ID.'" class="action-btn-allow btn btn-success">Accepter</a>
             <a href="#" data-id = "'.$listCourse[$i]->ID.'" class="action-btn-deny btn btn-danger">Refuser</a><br/>
             <a target="_blank"  href="'.get_site_url(). '/?post_type=lp_course&p='.$listCourse[$i]->ID.'&preview=true'.'" class="action-btn-preview btn btn-info">Preview</a>
             <a target="_blank"  href="'.get_site_url(). '/wp-admin/post.php?post='.$listCourse[$i]->ID.'&action=edit" class="action-btn-detail btn btn-warning">Detail</a>
             </td> 
             </tr>"';
        }
        if(count($listCourse) == 0){
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
+"<tr style = \"background:#2878EB;color:white\"><th>Vignette</th><th>Titre</th><th>Auteur</th><th>Contenu</th><th>Etudiants</th><th>Prix</th><th>Catégorie</th><th>Date</th><th>Action</th></tr></thead><tbody class = \"formateurs-demandes-table\">"

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
            xhttp.send("validCourse=accepter&course_id="+accepterButton[i].getAttribute(\'data-id\'));
        });
       
    }
},500);



 }, false);


</script>';

?>









