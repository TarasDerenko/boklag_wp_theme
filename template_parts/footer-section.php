<?php
$social = get_option('bl-social');
$contact = get_option('bl-contact');
?>
<footer class="footer">
    <div class="container">
        <div class="footer-wrapper">
            <div class="footer-column footer-logo">
                <a href="index.html"><img src="<?php bloginfo('template_url')?>/img/logo-footer.png" alt="ФЛП Боклаг" width="263" height="79"></a>
            </div>
            <div class="footer-column footer-contacts">
                <h3 class="footer-title">Контакты:</h3>
                <ul class="footer-contacts-list">
                    <?php if(!empty($contact['address'])): ?>
                        <li><?=$contact['address']?></li>
                    <?php endif; ?>
                    <?php if(!empty($contact['tel-1'])): ?>
                    <li><a class="footer-contacts-link" href="tel:+380993629175"><span>тел.</span> <?=$contact['tel-1']?></a></li>
                    <?php endif; ?>
                    <?php if(!empty($contact['tel-2'])): ?>
                        <li><a class="footer-contacts-link" href="tel:+380993629175"><span>тел.</span> <?=$contact['tel-2']?></a></li>
                    <?php endif; ?>
                    <?php if(!empty($contact['tel-3'])): ?>
                        <li><a class="footer-contacts-link" href="tel:+380993629175"><span>тел.</span> <?=$contact['tel-3']?></a></li>
                    <?php endif; ?>
                    <?php if(!empty($contact['email'])): ?>
                        <li><a class="footer-contacts-link" href="mailto:ppboklag@gmail.com"><span>e-mail:</span> <?=$contact['email']?></a></li>
                    <?php endif; ?>

                </ul>
            </div>
            <div class="footer-column footer-social">
                <h3 class="footer-title">Мы в соцсетях:</h3>
                <ul class="footer-social-list">
                    <?php if(!empty($social['twitter'])): ?>
                    <li>
                        <a href="<?=$social['twitter']?>" class="footer-social-link twitter">
                            <svg xmlns="http://www.w3.org/2000/svg" width="31" height="31" viewBox="0 0 31 31">
                                <path d="M1047.99,6989H1079v31h-31.01v-31Zm15.77,12.86c-1.05-.23-2.06-0.41-3.06-0.67-2.1-.53-3.59-2.02-5.18-3.53a4.418,4.418,0,0,0,1.18,5.36c-0.74-.12-1.17-0.2-1.68-0.28-0.05,2,1.43,2.79,2.8,3.73-0.46.13-.86,0.23-1.27,0.34,0.61,1.53,1.95,2.01,3.43,2.66a11.354,11.354,0,0,1-5.32,1.89c0.76,0.41,1.26.74,1.81,0.97,6.68,2.75,14.98-2.65,15.34-10.02,0.05-1.03.11-1.88,1.13-2.38a2.388,2.388,0,0,0,.53-0.71c-0.66.07-1.13,0.12-1.65,0.18,0.48-.66.89-1.21,1.3-1.77a8.989,8.989,0,0,0-1.41.26,2.252,2.252,0,0,1-1.36-.23,3.9,3.9,0,0,0-6.2,2.07A20.336,20.336,0,0,0,1063.76,7001.86Z" transform="translate(-1048 -6989)"/>
                            </svg>
                        </a>
                    </li>
                    <?php endif; ?>
                    <?php if(!empty($social['facebook'])): ?>
                    <li>
                        <a href="<?=$social['facebook']?>" class="footer-social-link facebook">
                            <svg xmlns="http://www.w3.org/2000/svg" width="31" height="31" viewBox="0 0 31 31">
                                <path d="M1088.99,7020v-31.01H1120V7020h-31.01Zm20.64-26.22c-1.43-.07-2.74-0.22-4.05-0.17-2.52.11-3.78,1.37-3.95,3.89-0.07.96-.01,1.92-0.01,2.94-0.77.06-1.43,0.1-2.08,0.15v3.1c0.67,0.03,1.27.07,2,.11v10.13h4.26V7003.7h3.06c0.11-1.07.21-2.05,0.32-3.19h-3.56c0.14-1.15-.09-2.48.46-3.01,0.61-.59,1.92-0.45,3.05-0.64C1109.26,6996.03,1109.43,6995.02,1109.63,6993.78Z" transform="translate(-1089 -6989)"/>
                            </svg>
                        </a>
                    </li>
                    <?php endif; ?>
                    <?php if(!empty($social['youtube'])): ?>
                    <li>
                        <a href="<?=$social['youtube']?>" class="footer-social-link instagram">
                            <svg xmlns="http://www.w3.org/2000/svg" width="31" height="31" viewBox="0 0 31 31">
                                <path id="icon-youtube" class="" d="M1130,7020v-31.01h31.01V7020H1130Zm21.38-11.37h-1.12l0.01-.64a0.514,0.514,0,0,1,.52-0.51h0.07a0.523,0.523,0,0,1,.53.51Zm-4.2-1.37a0.484,0.484,0,0,0-.52.42v3.1a0.484,0.484,0,0,0,.52.42,0.478,0.478,0,0,0,.52-0.42v-3.1A0.478,0.478,0,0,0,1147.18,7007.26Zm6.82-1.73v5.9a2.691,2.691,0,0,1-2.78,2.57h-11.44a2.691,2.691,0,0,1-2.78-2.57v-5.9a2.684,2.684,0,0,1,2.78-2.57h11.44A2.684,2.684,0,0,1,1154,7005.53Zm-13.46,6.54v-6.22h1.42v-0.92h-3.78v0.9l1.18,0.01v6.23h1.18Zm4.25-5.29h-1.18v3.32a6.119,6.119,0,0,1,0,.8c-0.1.26-.53,0.53-0.7,0.03-0.02-.09,0-0.35,0-0.81v-3.34h-1.18v3.29c0,0.5-.01.88,0.01,1.05a1.057,1.057,0,0,0,.3.85,1.44,1.44,0,0,0,1.81-.59v0.68l0.94,0.01v-5.29h0Zm3.79,3.8-0.01-2.76c0-1.05-.8-1.69-1.89-0.83v-2.06l-1.18.01v7.08l0.97-.01,0.09-.44C1147.8,7012.68,1148.58,7011.92,1148.58,7010.58Zm3.7-.37-0.89.01v0.6a0.48,0.48,0,0,1-.49.47h-0.17a0.48,0.48,0,0,1-.49-0.47v-1.27h2.03v-0.75a10.871,10.871,0,0,0-.06-1.41c-0.14-.99-1.56-1.15-2.28-0.64a1.345,1.345,0,0,0-.49.65,3.694,3.694,0,0,0-.15,1.17v1.65C1149.29,7012.95,1152.68,7012.57,1152.28,7010.21Zm-4.55-8.94a0.77,0.77,0,0,0,.28.36,0.913,0.913,0,0,0,.49.13,0.775,0.775,0,0,0,.45-0.14,1.032,1.032,0,0,0,.33-0.42l-0.02.46h1.32v-5.5h-1.04v4.28a0.431,0.431,0,0,1-.43.42,0.425,0.425,0,0,1-.43-0.42v-4.28h-1.09v3.71c0,0.47.01,0.79,0.03,0.95A1.414,1.414,0,0,0,1147.73,7001.27Zm-3.99-3.1a4.381,4.381,0,0,1,.13-1.23,1.4,1.4,0,0,1,.48-0.72,1.458,1.458,0,0,1,.9-0.27,1.605,1.605,0,0,1,.78.18,1.245,1.245,0,0,1,.51.45,1.579,1.579,0,0,1,.24.57,4,4,0,0,1,.07.9v1.39a7.474,7.474,0,0,1-.06,1.12,1.835,1.835,0,0,1-.26.67,1.284,1.284,0,0,1-.51.45,1.655,1.655,0,0,1-.72.15,2.126,2.126,0,0,1-.76-0.12,1.041,1.041,0,0,1-.48-0.39,1.6,1.6,0,0,1-.25-0.61,5.821,5.821,0,0,1-.07-1.08v-1.46h0Zm1.03,2.18a0.522,0.522,0,1,0,1.04,0v-2.92a0.522,0.522,0,1,0-1.04,0v2.92Zm-3.65,1.48h1.24l0.01-4.21,1.46-3.61h-1.36l-0.78,2.68-0.79-2.69h-1.34l1.56,3.62v4.21Z" transform="translate(-1130 -6989)"/>
                            </svg>
                        </a>
                    </li>
                    <?php endif; ?>
                </ul>
            </div>
            <div class="footer-column footer-help">
                <?php
                wp_nav_menu(array(
                    'theme_location' => 'bottom-menu',
                    'container' => false,
                    'menu_class' => 'footer-help-list'
                ));
                ?>
            </div>
        </div>
        <div class="footer-copyright">2017 &copy; Все права защищены</div>
    </div>
</footer>