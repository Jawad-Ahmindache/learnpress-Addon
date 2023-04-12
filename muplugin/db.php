<?php


function get_teacher_money($id){
    global $wpdb;
    return $wpdb->get_results( 'SELECT teacher_money FROM wp_users WHERE ID='.esc_sql($id))[0]->teacher_money;
}
function add_teacher_money($id,$money){ // Ajouter du crédit à un compte
    global $wpdb;
    $id = (int)esc_sql($id);
    $money = (float)esc_sql($money);
    $wpdb->query("UPDATE wp_users SET teacher_money = teacher_money + $money WHERE ID = $id");
}



