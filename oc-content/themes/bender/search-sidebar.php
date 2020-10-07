<?php
$category = (array) __get("category");
if(!isset($category['pk_i_id']) ) {
 $category['pk_i_id'] = null;
}

?>
<div class="search_meta hidden">
    <?php
    if(osc_search_category_id()) {
        osc_run_hook('search_form', osc_search_category_id()) ;
    } else {
        osc_run_hook('search_form') ;
    }
    ?>
</div>