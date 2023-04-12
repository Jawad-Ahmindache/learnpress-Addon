
<?php

if(isset($_POST['validCourse'])){
    $postID = esc_html__(esc_sql($_POST['course_id']));

    if($_POST['validCourse'] == 'accepter'){
        wp_update_post(array('ID' => $postID, 'post_status' => 'publish'));
      
    }
    die();
}
$args = array(
    'post_type'=> 'lp_course',
    'post_status' => 'pending'

);    
$listCourse = get_posts($args);



require __DIR__.'/../template/cours-en-attente.php';

?>