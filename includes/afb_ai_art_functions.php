<?php

function display_product_category_dropdown($value) {
    $categories = get_terms('product_cat', array('hide_empty' => false));
    
    if ($categories) {
        echo '<select name="afb_ai_art_product_category">';
        echo '<option value="">Select a category</option>';
        
        foreach ($categories as $category) {
            echo '<option '.($value==esc_attr($category->term_id) ? "selected":"" ).' value="' . esc_attr($category->term_id) . '">' . esc_html($category->name) . '</option>';
        }
        
        echo '</select>';
    } else {
        echo 'No product categories found.';
    }
}
