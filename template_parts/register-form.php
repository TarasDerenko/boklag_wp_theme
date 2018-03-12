<div class="popup mfp-hide" id="registration">
    <h2 class="popup-title">Регистрация</h2>
<?php global $register_errors; ?>
    <form method="post">
        <div class="popup-form">
            <div class="popup-form-input">
                <input type="text" placeholder="Имя и Фамилия*" name="user_name" required>
            </div>
            <div class="popup-form-input">
                <input type="email" placeholder="E-mail*" name="user_login" class="<?php echo (isset($register_errors['email'])) ? 'error' : ''?>" required>
            </div>
            <div class="popup-form-input">
                <input type="password" placeholder="Пароль*" name="pwd" class="<?php echo (isset($register_errors['pwd'])) ? 'error' : ''?>" required>
            </div>
            <?php if(sizeof($register_errors)):?>
                 <div class="popup-form-input errors">
                    <?php foreach ($register_errors as $value) {
                        echo '<span>'.$value.'<span><br>';
                    }?>
                    
                </div>
            <?php endif;?>
            <div class="popup-form-checkbox">               
                <label class="custom-checkbox">
                    <input type="checkbox" name="approved" checked>
                    <div class="custom-checkbox-image"></div>
                    <span class="custom-checkbox-text">Согласиться с условиями сайта</span>
                </label>
            </div>
            <div class="popup-captcha">
                <div class="g-recaptcha" data-sitekey="6Le7iEEUAAAAAGU2NQG8UzhI8hSlBANixXM_rJsV"></div>
                <a href="#" class="popup-captcha-google"></a>
            </div>
            <input type="hidden" name="registration" value="1">
            <button type="submit" class="button"><span>Зарегистрироваться</span></button>
        </div>
    </form>
</div>