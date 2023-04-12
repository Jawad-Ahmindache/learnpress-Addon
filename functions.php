<?php

// Function pour savoir si une ligne sql existe
function isRowExist($select,$table,$where,$data){
    global $wpdb;
    if(sizeof($wpdb->get_results("SELECT $select FROM $table WHERE $where = '".$data."'")) > 0)
        return true;
    else
        return false;
}

// Fonction pour avoir le petit résumé du contenu du cours par exemple affichage = 1 leçons, (4 quizzes)
function get_course_content_excerpt($postId)
{
    $curd            = new LP_Course_CURD();
					$number_sections = $curd->count_sections( $postId );
			
						$output     = sprintf( _n( '<strong>%d</strong> section', '<strong>%d</strong> sections', $number_sections, 'learnpress' ), $number_sections );
						$html_items = array();
						$post_types = get_post_types( null, 'objects' );

						$stats_objects = $curd->count_items( $postId, 'edit' );

						if ( $stats_objects ) {
							foreach ( $stats_objects as $type => $count ) {
								if ( ! $count || ! isset( $post_types[ $type ] ) ) {
									continue;
								}

								$post_type_object = $post_types[ $type ];
								$singular_name    = strtolower( $post_type_object->labels->singular_name );
								$plural_name      = strtolower( $post_type_object->label );
								$html_items[]     = sprintf( _n( '<strong>%d</strong> ' . $singular_name, '<strong>%d</strong> ' . $plural_name, $count, 'learnpress' ), $count );
							}
						}

						$html_items = apply_filters( 'learn-press/course-count-items', $html_items );

						if ( $html_items ) {
							$output .= ' (' . implode( ', ', $html_items ) . ')';
						}

						return $output;
}

function generate_mail(array $content,array $mailInfo){
	ob_start();
	include __DIR__.'/template/generate-mail.php';
	$body = ob_get_clean();
	$headers = array('Content-Type: text/html; charset=UTF-8');
	wp_mail( $mailInfo['to'], $mailInfo['subject'],$body, $headers, $mailInfo['attachment']);
}

function wa_redirect($url)
{
    if (!headers_sent())
    {    
        header('Location: '.$url);
        exit;
        }
    else
        {  
        echo '<script type="text/javascript">';
        echo 'window.location.href="'.$url.'";';
        echo '</script>';
        echo '<noscript>';
        echo '<meta http-equiv="refresh" content="0;url='.$url.'" />';
        echo '</noscript>'; exit;
    }
}

function hideLearnpresTabNav(){
	echo '<script>
		document.querySelector(".learn-press-tabs").style.display = "none";
	</script>';
}

function fullWidthLpContentArea(){
	echo '<script>
		alert(document.querySelector(".lp-content-area").style.width);
	
	</script>';
}