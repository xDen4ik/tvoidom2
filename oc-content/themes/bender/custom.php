<?php
    bender_add_body_class('custom');
    osc_current_web_theme_path('header.php') ;
?>
<section class="custom-page">
    <div class="container">
        <?php osc_render_file(); ?>
    </div>
</section>
<?php osc_current_web_theme_path('footer.php') ; ?>