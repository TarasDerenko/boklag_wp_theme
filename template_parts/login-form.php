<div class="popup mfp-hide" id="login">
    <h2 class="popup-title">Войти в личный кабинет</h2>
    <form action="<?php echo site_url('wp-login.php'); ?>" method="post">
        <div class="popup-form">
            <div class="popup-form-input">
                <input type="email" placeholder="E-mail*" name="log">
            </div>
            <div class="popup-form-input">
                <input type="password" placeholder="Пароль*" name="pwd">
            </div>
            <div class="popup-form-checkbox">
                <label class="custom-checkbox">
                    <input type="checkbox" name="rememberme" checked>
                    <div class="custom-checkbox-image"></div>
                    <span class="custom-checkbox-text">Запомнить меня</span>
                </label>
            </div>
            <div class="popup-captcha">
                <div class="g-recaptcha" data-sitekey="6Le7iEEUAAAAAGU2NQG8UzhI8hSlBANixXM_rJsV"></div>
                <a href="#" class="popup-captcha-google"></a>
                <div class="g-signin2" data-onsuccess="onSignIn"></div>
            </div>
            <button type="submit" class="button"><span>Войти</span></button>
            <input type="hidden" name="redirect_to" value="<?php echo site_url(); ?>" />
        </div>
        <div class="popup-footer">
            <div class="popup-footer-links">
                <a href="#">Забыли пароль</a>
                <a href="#registration">Регистрация</a>
            </div>
        </div>
    </form>
</div>