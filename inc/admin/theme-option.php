<?php

/**************************************************************/
function add_boklag_setting(){
    if(sizeof($_POST)){
        foreach ($_POST as $key => $value) {
            update_option($key,$value);
        }
    }
    $social = get_option('bl-social');
    $contact = get_option('bl-contact');
    ?>
    <div class="wrap">
        <h2><?php echo get_admin_page_title() ?></h2>

        <form method="post">
            <table>
                <tr>
                    <td>
                        <label for="bl-limit">Лимит Заказов на странице</label>
                    </td>
                    <td>
                        <input type='text' id="bl-limit" name="bl-limit" value="<?php echo get_option('bl-limit')?>">
                    </td>
                    <td></td>
                </tr>
                <tr>
                    <td>
                       <h3>Социальные сети:</h3>
                    </td>
                    <td>
                    </td>
                    <td></td>
                </tr>
                <tr>
                    <td>
                        <label for="bl-twitter">twitter</label>
                    </td>
                    <td>
                        <input type='text' id="bl-twitter" name="bl-social[twitter]" value="<?=isset($social['twitter']) ? $social['twitter'] : ''?>">
                    </td>
                    <td></td>
                </tr>
                <tr>
                    <td>
                        <label for="bl-facebook">facebook</label>
                    </td>
                    <td>
                        <input type='text' id="bl-facebook" name="bl-social[facebook]" value="<?=isset($social['facebook']) ? $social['facebook'] : ''?>">
                    </td>
                    <td></td>
                </tr>
                <tr>
                    <td>
                        <label for="bl-youtube">YouTube</label>
                    </td>
                    <td>
                        <input type='text' id="bl-youtube" name="bl-social[youtube]" value="<?=isset($social['youtube']) ? $social['youtube'] : ''?>">
                    </td>
                    <td></td>
                </tr>
                <tr>
                    <td>
                        <h3>Контакти:</h3>
                    </td>
                    <td>

                    </td>
                    <td></td>
                </tr>
                <tr>
                    <td>
                        <label for="bl_email">e-mail</label>
                    </td>
                    <td>
                        <input type='text' id="bl_email" name="bl-contact[email]" value="<?=isset($contact['email']) ? $contact['email'] : ''?>">
                    </td>
                    <td></td>
                </tr>
                <tr>
                    <td>
                        <label for="bl_address">Адресса</label>
                    </td>
                    <td>
                        <input type='text' id="bl_address" name="bl-contact[address]" value="<?=isset($contact['address']) ? $contact['address'] : ''?>">
                    </td>
                    <td></td>
                </tr>
                <tr>
                    <td>
                        <label for="bl_tel_1">Тел. 1</label>
                    </td>
                    <td>
                        <input type='text' id="bl_tel_1" name="bl-contact[tel-1]" value="<?=isset($contact['tel-1']) ? $contact['tel-1'] : ''?>">
                    </td>
                    <td></td>
                </tr>
                <tr>
                    <td>
                        <label for="bl_tel_2">Тел. 2</label>
                    </td>
                    <td>
                        <input type='text' id="bl_tel_2" name="bl-contact[tel-2]" value="<?=isset($contact['tel-2']) ? $contact['tel-2'] : ''?>">
                    </td>
                    <td></td>
                </tr>
                <tr>
                    <td>
                        <label for="bl_tel_3">Тел. 3</label>
                    </td>
                    <td>
                        <input type='text' id="bl_tel_3" name="bl-contact[tel-3]" value="<?=isset($contact['tel-3']) ? $contact['tel-3'] : '' ?>">
                    </td>
                    <td></td>
                </tr>

            </table>
            <br>
            <br>
            <input type="submit" value='save'>
        </form>
    </div>
    <?php
}
/**************************************************************/
