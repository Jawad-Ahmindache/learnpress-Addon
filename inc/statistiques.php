<?php
global $wpdb;

// Add a view to a course 
function addCourseView(){
        global $wpdb;
        global $post;
        $course_id = $post->ID;
        $user_id = (int)$post->post_author;
        
        
        $req = $wpdb->get_results('SELECT event_date, event_count FROM wa_stats WHERE course_id = "'.$course_id.'" AND event_type = "course_view"');
        $ifSum = false;
        
        for($i = 0; $i < count($req);$i++){
            $event_count = (int)$req[$i]->event_count;
           
            $today = date('Y-m');
            $event_date = explode('-',$req[$i]->event_date);
            $event_date = $event_date[0].'-'.$event_date[1];
            if($event_date == $today){
                $ifSum = true;
                break;
            }
                
        }
        
        if($ifSum == true){
            $wpdb->update( 'wa_stats', array('event_count' => $event_count + 1), array('course_id' => $course_id), null, null );

            
        }
        else{
            $wpdb->insert('wa_stats', array('course_id' => $course_id,'course_author' => $user_id,'event_type' => 'course_view','event_count' => 1,'event_date' => wp_date('Y-m-d')), null);
        }
}

function getTotalView($args){
    global $wpdb;
     
    $req = $wpdb->get_results('SELECT event_count FROM wa_stats WHERE course_author = "'.$args['teacher'].'"  AND event_type = "course_view"');
    $sum = 0;
    for($i = 0; $i < count($req); $i++){
        $sum += $req[$i]->event_count;
    }
    return $sum;
}

function getMostViewedCourse($teacher){
    global $wpdb;
    $req = $wpdb->get_results('SELECT event_count,course_id FROM wa_stats WHERE course_author = "'.$teacher.'"  AND event_type = "course_view"');
    $courseList = array(1);
    $dopush = false;
    for($i = 0; $i < count($req); $i++){
        
        for($a = 0; $a < count($courseList); $a++){
            if($a == 0){
                $courseList = array();
                array_push($courseList,array('course_id' => (int)$req[$i]->course_id,'event_count' => $req[$i]->event_count));

            }
               
            var_dump($a);
            if(isset($courseList[$a]['course_id'])){

                if($courseList[$a]['course_id'] == (int)$req[$i]->course_id){
                    $courseList[$a]['event_count'] = $req[$i]->event_count;
                    $dopush = false;
                    break;
                    
                }

            }else{
                $dopush = true;
            }

        }
        if($dopush == true)
            array_push($courseList,array('course_id' => (int)$req[$i]->course_id,'event_count' => $req[$i]->event_count));

        
        
        
    }
  //  var_dump($courseList);
}

//getMostViewedCourse(2);

//  add_action('learn-press/before-course-buttons','addCourseView');

/*$args = array('teacher'=>2);
add_action('learn-press/before-course-buttons',function() use ( $args ) { 
               getTotalView( $args ); 
            });*/


          


            
?>