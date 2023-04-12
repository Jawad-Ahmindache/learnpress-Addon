<?php

$user = get_user_by( 'slug', get_query_var( 'user') );
   $profile      = LP_Profile::instance( $user->ID );
   $filter_status = LP_Request::get_string( 'filter-status' );
   $query         = $profile->query_courses( 'own', array( 'status' => $filter_status ) );
   $user          = $profile->get_user();
   $id            = $user->get_id();
   $custom_img    = $user->get_upload_profile_src();
   $gravatar_img  = $user->get_profile_picture( 'gravatar' );
   $thumb_size    = learn_press_get_avatar_thumb_size();

   $user_designation    = get_user_meta($id,'courselog_user_designation',true);
   $user_social_link    = get_user_meta($id,'user_social_link',true);
   $course_rating_data  = courselog_course_total_rating($query['items']);
   $total_rating        = $course_rating_data['sum'];
   if($total_rating > 0){
      $avarage_rating = number_format($total_rating/$course_rating_data['count'], 2);
   }else{
      $avarage_rating = 0; 
   }

   $following =  get_user_meta($id, 'courselog_following_instructors', true);
   $follower  =  get_user_meta($id, 'courselog_follower_instructors', true);


?>

<div class="insturctor-single main-container">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-9 col-md-8">
                <div class="instructor-profile-header d-lg-flex">
                    <div class="courselog-instructor-profile">
                        <?php if ( $custom_img ) { ?>
                        <img src="<?php echo esc_attr($custom_img); ?>" />
                        <?php } else { ?>
                        <?php echo courselog_kses($gravatar_img); ?>
                        <?php } ?>
                    </div>
                    <div class="ts-instructor-info-wrap media-body">
                        <div class="ts-instructor-info">
                            <h3 class="instructor-title ts-title">
                                <?php echo esc_html($user->get_display_name()); ?>
                            </h3>
                            <p class="instructor-designation">
                                <?php echo esc_html($user_designation); ?>
                            </p>
                        </div>
                        <?php if($user->get_description() != ''): ?>
                            <div class="ts-insturoctor-short-info">
                                <h5><?php echo esc_html__('Short Bio','courselog'); ?></h5>
                                <p class="user-bio">
                                    <?php  
                                    echo esc_html($user->get_description()); 
                                    ?>
                                </p>
                            </div>
                            <!-- info -->
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-4">
                <div class="ts-instructor-profile-info">
                    <ul class="ts-social">
                        <?php if(is_array($user_social_link)): ?>
                        <?php foreach($user_social_link as $social): ?>
                        <?php 
                               $str   = $social['icon'];
                               $class =  explode("-",$str);
                               $class = isset($class[1]) ? $class[1] : '';
                               $url   = isset($social['url']) ? $social['url'] : '';
                               $icon  = isset($social['icon']) ? $social['icon'] : '';
                              ?>
                        <li class="ts-<?php echo esc_attr($class); ?>">
                            <a href="<?php echo esc_url( $url); ?>"> <i class="<?php echo esc_attr( $icon); ?>"></i>
                            </a>
                        </li>
                        <?php endforeach; ?>
                        <?php endif; ?>
                    </ul>

                    <ul class="instructor-follow">
                        <li class="follower">
                            <i class="tsicon tsicon-students"></i>
                            <?php $total_follower = is_array($follower)?count($follower):0; ?>
                            <?php $total_follower = ($total_follower > 0) ? $total_follower-1 : $total_follower; ?>
                            <?php echo esc_html__('Follower','courselog').' '.$total_follower; ?>
                        </li>
                        <li class="following">
                            <i class="tsicon tsicon-students"></i>
                            <?php $total_following = is_array($following)?count($following):0; ?>
                            <?php $total_following = ($total_following > 0) ? $total_following-1 : $total_following; ?>

                            <?php echo esc_html__('Following','courselog').' '.$total_following; ?>
                        </li>
                    </ul>
                    <a data-user-id="<?php echo esc_attr($id); ?>" class="btn  btn-primary ts-follow-instructor">
                        <?php echo esc_html__('Follow','courselog'); ?> <i class="fas fa-plus"></i>  </a>
                </div>
            </div>
        </div>

        <ul class="user-meta-summery row">
            <li class="total-course col-md-4">
               <h4><?php echo esc_html($query['total']); ?></h4>
               <span><?php echo esc_html__('Courses Authored', 'courselog'); ?></span>
            </li>
            <li class="total-rating col-md-4">
               <h4><?php echo esc_html($total_rating); ?></h4>
               <span><?php echo esc_html__('Total Ratings', 'courselog'); ?></span>
            </li>
            <li class="avarage-rating col-md-4">
               <h4><?php echo esc_html($avarage_rating); ?></h4>
               <span><?php echo esc_html__('Avg Ratings', 'courselog'); ?></span>
            </li>
         </ul>

  
         <div class="insturctor-course-list">
            <h3 class="ts-title">
               <?php echo esc_html__('Course by ','courselog').": ".courselog_kses($user->get_display_name()); ?>
            </h3>
            <?php  get_template_part("learnpress/profile/instructor",'course'); ?>
         </div>
         
    </div>
</div>