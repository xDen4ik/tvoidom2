<footer class="main__footer">
    <div class="container">
        <div class="main__footer-wrap wrap">
            <div class="col">
                <a href="/" class="main__footer-logo"><img src="<?= osc_current_web_theme_url ('app/img/logo.svg')?>" alt=""></a>
                <p class="main__footer-text">Сервис помогает с арендой и продажей недвижимости в вашем городе в минимальные сроки и по необходимой вам цене</p>
                <div class="main__footer-soc-links">
                    <a href="#"><img src="<?= osc_current_web_theme_url('app/img/icons/soc.png')?>" alt=""></a>
                    <a href="#"><img src="<?= osc_current_web_theme_url('app/img/icons/soc.png')?>" alt=""></a>
                    <a href="#"><img src="<?= osc_current_web_theme_url('app/img/icons/soc.png')?>" alt=""></a>
                </div>
            </div>
            <div class="col">
                <h4 class="main__footer-subtitle">Заголовок: <img src="<?= osc_current_web_theme_url('app/img/icons/select-angle.svg')?>" alt=""></h4>
                <ul>
                    <li><a href="#">SEO-раздел</a></li>
                    <li><a href="#">SEO-раздел</a></li>
                    <li><a href="#">SEO-раздел</a></li>
                    <li><a href="#">SEO-раздел</a></li>
                    <li><a href="#">SEO-раздел</a></li>
                    <li><a href="#">SEO-раздел</a></li>
                </ul>
            </div>
            <div class="col">
                <h4 class="main__footer-subtitle">Дополнительно: <img src="<?= osc_current_web_theme_url('app/img/icons/select-angle.svg')?>" alt=""></h4>
                <ul>
                    <li><a href="#">О проете</a></li>
                    <li><a href="#">Сотрудничество</a></li>
                    <li><a href="#">Реклама</a></li>
                </ul>
            </div>
            <div class="col">
                <h4 class="main__footer-subtitle">Контакты:</h4>
                <ul>
                    <li>Телефон: 8 (812) 457-75-85</li>
                    <li>Почта: your.house@mail.ru</li>
                    <li>Адрес: г. Екатеринбург, ул Малышева 76 </li>
                </ul>
            </div>
        </div>
        <div class="main__footer-bottom-wrap wrap">
            <div class="copy">© ООО «ТВОЙ ДОМ»</div>
            <div class="main__footer-pol">
                <a data-fancybox href="#">Политика конфиденциальности</a>
            </div>
        </div>
    </div>
</footer>
<div class="hidden">
    <? if ($_SERVER['REQUEST_URI'] !== '/item/new'): ?>
    <div class="popup" id="login">
        <h2 class="popup-title">Вход и <strong>регистрация</strong></h2>
        <p class="popup-text">Для того, чтобы публиковать объявления — авторизируйтесь</p>
        <div class="form-container form-horizontal form-container-box">
            <div class="resp-wrapper">
                <form name="login" id="login" action="<?php echo osc_base_url(true); ?>" method="post" >
                    <input type="hidden" name="page" value="login" />
                    <input type="hidden" name="action" value="login_post" />

                    <div class="control-group">
                        <label class="control-label" for="email"><?php _e('E-mail', 'bender'); ?></label>
                        <div class="controls">
                            <?php UserForm::email_login_text(); ?>
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="password"><?php _e('Password', 'bender'); ?></label>
                        <div class="controls">
                            <?php UserForm::password_login_text(); ?>
                        </div>
                    </div>
                    <div class="control-group control-group-checkbox">
                        <div class="controls checkbox">
                            <?php UserForm::rememberme_login_checkbox();?> <label for="remember"><?php _e('Remember me', 'bender'); ?></label>
                        </div>
                        <div class="controls">
                            <button type="submit" class="btn btn-yellow ui-button ui-button-middle ui-button-main"><?php _e("Log in", 'bender');?></button>
                        </div>
                    </div>
                    <div class="actions">
                        <a data-fancybox href="#reg" class="btn btn-yellow"><?php _e("Register for a free account", 'bender'); ?></a>
                        <a data-fancybox href="#recover" class="btn btn-white"><?php _e("Forgot password?", 'bender'); ?></a>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="popup" id="reg">
        <h2 class="popup-title">Вход и <strong>регистрация</strong></h2>
        <p class="popup-text">Пройдите регистрацию за 5 минут. Вы сможете писать сообщения и выкладывать объявления</p>
        <div class="form-container form-horizontal form-container-box">
            <div class="resp-wrapper">
                <form name="register" action="<?php echo osc_base_url(true); ?>" method="post" >
                    <input type="hidden" name="page" value="register" />
                    <input type="hidden" name="action" value="register_post" />
                    <ul id="error_list"></ul>
                    <div class="control-group">
                        <label class="control-label" for="name"><?php _e('Name', 'bender'); ?></label>
                        <div class="controls">
                            <?php UserForm::name_text(); ?>
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="email"><?php _e('E-mail', 'bender'); ?></label>
                        <div class="controls">
                            <?php UserForm::email_text(); ?>
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="password"><?php _e('Password', 'bender'); ?></label>
                        <div class="controls">
                            <?php UserForm::password_text(); ?>
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="password-2"><?php _e('Repeat password', 'bender'); ?></label>
                        <div class="controls">
                            <?php UserForm::check_password_text(); ?>
                            <p id="password-error" style="display:none;">
                                <?php _e("Passwords don't match", 'bender'); ?>
                            </p>
                        </div>
                    </div>
                    <div class="control-group">
                        <div class="controls">
                            <?php osc_show_recaptcha('register'); ?>
                        </div>
                    </div>
                    <div class="control-group">
                        <div class="controls">
                            <button type="submit" class="btn btn-yellow ui-button ui-button-middle ui-button-main"><?php _e("Create", 'bender'); ?></button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <?php 
        UserForm::js_validation(); 
        ?>
    </div>
    <div class="popup" id="recover">
        <h2 class="popup-title"><?php _e('Recover your password', 'bender'); ?></h2>
        <!-- <p class="popup-text">Пройдите регистрацию за 5 минут. Вы сможете писать сообщения и выкладывать объявления</p> -->
        <div class="form-container form-horizontal form-container-box">
            <div class="resp-wrapper">
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
                    <div class="control-group">
                        <div class="controls">
                            <button type="submit" class="btn btn-yellow ui-button ui-button-middle ui-button-main"><?php _e("Send me a new password", 'bender');?></button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
<? endif; ?>
<div id="call_author" class="popup">
    <?php osc_run_hook('after-main'); ?>
    <?php osc_show_widgets('footer');?>
    <?php osc_run_hook('footer'); ?>
</div>
</div>
<script src="https://api-maps.yandex.ru/2.0-stable/?apikey=c653cd16-a59c-41d5-93bf-9efc68167eba&?apikey=c653cd16-a59c-41d5-93bf-9efc68167eba&load=package.standard&lang=ru-RU" type="text/javascript"></script>
<script type="text/javascript">
		$(document).ready(function(){
			ymaps.ready(function(){
				var geolocation = ymaps.geolocation;
				$('#sCity').val(geolocation.city)
				$('#title_city').text(geolocation.city)
			});
		});
	</script>
</body>
</html>
