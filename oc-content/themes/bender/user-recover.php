<?php

    // meta tag robots
osc_add_hook('header','bender_nofollow_construct');

bender_add_body_class('recover');
osc_current_web_theme_path('header.php');
?>
<section class="reg-login-page">
    <div class="container">
        <div class="form-container form-horizontal form-container-box">
            <div class="header">
                <h1><?php _e('Recover your password', 'bender'); ?></h1>
            </div>
            <div class="resp-wrapper" style="margin-top: 20px;">
                <form name="recover_password" id="recover_password" action="<?php echo osc_base_url(true); ?>" method="post" >
                    <input type="hidden" name="page" value="login" />
                    <input type="hidden" name="action" value="recover_post" />
                    <div class="control-group">
                        <label class="control-label" for="email"><?php _e('E-mail', 'bender'); ?></label>
                        <div class="controls">
                            <?php UserForm::email_text(); ?>
                            <?php osc_show_recaptcha('recover_password'); ?>
                        </div>
                    </div>
                    <div class="control-group" style="margin-top: 20px;">
                        <div class="controls">
                            <button type="submit" class="btn ui-button ui-button-middle ui-button-main"><?php _e("Send me a new password", 'bender');?></button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
<?php osc_current_web_theme_path('footer.php') ; ?>
