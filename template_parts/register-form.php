<?php global $error_message,$register_info; ?>
<div class="popup mfp-hide" id="registration">
    <?php if(sizeof($register_info)):?>
        <div class="popup-form-input info">
            <?php foreach ($register_info as $info) {
                echo '<span>'.$info.'<span><br>';
            }?>
        </div>
    <?php endif;?>
    <h2 class="popup-title">Регистрация</h2>
    <form method="post">
        <div class="popup-form">
            <div class="popup-form-input">
                <input type="text" placeholder="Имя и Фамилия*" name="user_name" required>
            </div>
            <div class="popup-form-input">
                <input type="email" placeholder="E-mail*" name="user_login" class="<?php echo (isset($error_message['email'])) ? 'error' : ''?>" required>
            </div>
            <div class="popup-form-input">
                <input type="password" placeholder="Пароль*" name="pwd" class="<?php echo (isset($error_message['pwd'])) ? 'error' : ''?>" required>
            </div>
            <?php if(sizeof($error_message)):?>
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