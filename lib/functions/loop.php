<?php
function is_lamp_firstpost(){
    global $wp_query;
    return ($wp_query->current_post === 0);
}