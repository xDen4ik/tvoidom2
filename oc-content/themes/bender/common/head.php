<?php
$js_lang = array(
    'delete' => __('Delete', 'bender'),
    'cancel' => __('Cancel', 'bender')
);

osc_enqueue_script('jquery');
osc_enqueue_script('jquery-ui');
osc_register_script('global-theme-js', osc_current_web_theme_js_url('global.js'), 'jquery');
osc_register_script('delete-user-js', osc_current_web_theme_js_url('delete_user.js'), 'jquery-ui');
osc_register_script('slick', osc_current_web_theme_js_url('slick.min.js'), 'jquery');
osc_register_script('fancybox', osc_current_web_theme_js_url('jquery.fancybox.min.js'), 'jquery');
osc_register_script('main', osc_current_web_theme_js_url('scripts.min.js'), 'jquery');
osc_enqueue_script('jquery-validate');
osc_enqueue_script('global-theme-js');
osc_enqueue_script('main');
osc_enqueue_script('slick');
osc_enqueue_script('fancybox');
osc_register_script('global-theme-js', osc_current_web_theme_js_url('jquery.maskedinput.js'), 'jquery');
?>
<meta http-equiv="Content-type" content="text/html; charset=utf-8" />

<title><?php echo meta_title(); ?></title>
<meta name="title" content="<?php echo osc_esc_html(meta_title()); ?>" />
<?php if (meta_description() != '') { ?>
    <meta name="description" content="<?php echo osc_esc_html(meta_description()); ?>" />
<?php } ?>
<?php if (meta_keywords() != '') { ?>
    <meta name="keywords" content="<?php echo osc_esc_html(meta_keywords()); ?>" />
<?php } ?>
<?php if (osc_get_canonical() != '') { ?>
    <!-- canonical -->
    <link rel="canonical" href="<?php echo osc_get_canonical(); ?>" />
    <!-- /canonical -->
<?php } ?>
<meta http-equiv="Cache-Control" content="no-cache" />
<meta http-equiv="Expires" content="Fri, Jan 01 1970 00:00:00 GMT" />

<meta name="viewport" content="initial-scale = 1.0,maximum-scale = 1.0" />

<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="black">

<!-- favicon -->
<link rel="shortcut icon" href="<?php echo osc_current_web_theme_url('favicon/favicon-48.png'); ?>">
<link rel="apple-touch-icon-precomposed" sizes="144x144" href="<?php echo osc_current_web_theme_url('favicon/favicon-144.png'); ?>">
<link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?php echo osc_current_web_theme_url('favicon/favicon-114.png'); ?>">
<link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?php echo osc_current_web_theme_url('favicon/favicon-72.png'); ?>">
<link rel="apple-touch-icon-precomposed" href="<?php echo osc_current_web_theme_url('favicon/favicon-57.png'); ?>">
<!-- /favicon -->

<link href="<?php echo osc_current_web_theme_url('js/jquery-ui/jquery-ui-1.10.2.custom.min.css'); ?>" rel="stylesheet" type="text/css" />

<script type="text/javascript">
    var bender = window.bender || {};
    bender.base_url = '<?php echo osc_base_url(true); ?>';
    bender.langs = <?php echo json_encode($js_lang); ?>;
    bender.fancybox_prev = '<?php echo osc_esc_js(__('Previous image', 'bender')) ?>';
    bender.fancybox_next = '<?php echo osc_esc_js(__('Next image', 'bender')) ?>';
    bender.fancybox_closeBtn = '<?php echo osc_esc_js(__('Close', 'bender')) ?>';
</script>
<!-- 
<link href="<?php echo osc_current_web_theme_url('css/main.css'); ?>" rel="stylesheet" type="text/css" />
 -->
<link href="<?php echo osc_current_web_theme_url('app/css/main.min.css'); ?>" rel="stylesheet" type="text/css" />
<?php osc_run_hook('header'); ?>