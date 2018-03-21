<?php global $error_login,$register_info; ?>
<div class="popup mfp-hide" id="login">
    <h2 class="popup-title">Войти в личный кабинет</h2>
    <form method="post">
        <div class="popup-form">
            <div class="popup-form-input">
                <input type="email" placeholder="E-mail*" name="log" value="<?php echo (!empty($_POST['log'])) ? $_POST['log'] : '' ?>">
            </div>
            <div class="popup-form-input">
                <input type="password" placeholder="Пароль*" name="pwd">
            </div>
            <?php if(sizeof($error_login)):?>
                <div class="popup-form-input errors">
                    <?php foreach ($error_login as $value) {
                        echo '<span>'.$value.'<span><br>';
                    }?>
                </div>
            <?php endif;?>
            <div class="popup-form-checkbox">
                <label class="custom-checkbox">
                    <input type="checkbox" name="rememberme" checked>
                    <div class="custom-checkbox-image"></div>
                    <span class="custom-checkbox-text">Запомнить меня</span>
                </label>
            </div>
            <div class="popup-captcha">
                <div class="g-recaptcha" data-sitekey="6Lfnd00UAAAAAIoh-PueHNDGojXDC40lbZoiRUrW"></div>
                <a href="#" class="popup-captcha-google"></a>
            </div>
            <button type="submit" class="button" name="login" value="1"><span>Войти</span></button>
        </div>
        <div class="popup-footer">
            <div class="popup-footer-links">
                <a href="#">Забыли пароль</a>
                <a href="#registration">Регистрация</a>
            </div>
        </div>
    </form>
</div>