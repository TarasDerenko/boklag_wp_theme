<?php

function init_organization_fields($user) {
    $meta = get_user_meta($user->ID);
    $fields = array(
        'user_avatar' => 'Аватар',
        'user_factory' => 'Предприятие',
        'user_tel' => 'Телефон',
        'user_messenger' => 'Меседжер',
        'user_skype' => 'Skype',
        'user_viber' => 'Viber',
        'user_whatsapp' => 'Whatsapp',
        'user_facebook' => 'Facebook',
        'user_instagram' => 'Instagram',
        'user_vkontakte' => 'Vkontakte',
        'user_pinterest' => 'Pinterest',
    );
 ?>
    <table class="form-table">
        <tbody>
        <?php foreach ($fields as $field => $label):?>
            <tr class="user-description-wrap">
                <th><label for="description"><?php echo $label ?></label></th>
                <td><input name="<?php echo $field ?>" id="<?php echo $field ?>" value="<?php echo get_bl_user_data($meta,$field)?>">
            </tr>
        <?php endforeach;?>
        </tbody>
    </table>
<?php
}
add_action('show_user_profile', 'init_organization_fields');
add_action('edit_user_profile', 'init_organization_fields');

// сохраняем
function save_organization($uid) {
if (!current_user_can('edit_user', $uid )) {
return false;
}

foreach(array('myinput') as $field_name) {
    $val = sanitize_text_field($_POST[$field_name]);
    update_user_meta($uid, $field_name, $val);
}
}
add_action('personal_options_update', 'save_organization');
add_action('edit_user_profile_update', 'save_organization');

// валидация полей
function validate_organization(&$errors, $update = null, &$user = null) {
if (!isset($_POST['myinput']) || empty($_POST['myinput'])) {
$errors->add('myinput', '<strong>Ошибка</strong>: поле MY INPUT обязательно для заполнения');
}
}
add_action('user_profile_update_errors', 'validate_organization');