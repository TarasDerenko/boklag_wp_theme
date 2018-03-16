<?php
add_action('admin_menu', function(){
    add_menu_page(
        'Boklag настройки',
        'Boklag настройки',
        'manage_options',
        'boklag-options',
        'add_boklag_setting',
        '',
        73 );
} );

/**************************************************************/
function add_boklag_setting(){
    if(sizeof($_POST)){
        foreach ($_POST as $key => $value) {
            update_option($key,$value);
        }
    }

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
                        <label for="bl-twitter">twitter</label>
                    </td>
                    <td>
                        <input type='text' id="bl-twitter" name="bl-twitter" value="<?php echo get_option('bl-twitter')?>">
                    </td>
                    <td></td>
                </tr>
                <tr>
                    <td>
                        <label for="bl-facebook">facebook</label>
                    </td>
                    <td>
                        <input type='text' id="bl-facebook" name="bl-facebook" value="<?php echo get_option('bl-facebook')?>">
                    </td>
                    <td></td>
                </tr>
                <tr>
                    <td>
                        <label for="bl-youtube">YouTube</label>
                    </td>
                    <td>
                        <input type='text' id="bl-youtube" name="bl-youtube" value="<?php echo get_option('bl-youtube')?>">
                    </td>
                    <td></td>
                </tr>
                <tr>
                    <td>
                        <label for="dat_email">e-mail</label>
                    </td>
                    <td>
                        <input type='text' id="dat_email" name="bl-email" value="<?php echo get_option('bl-email')?>">
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
