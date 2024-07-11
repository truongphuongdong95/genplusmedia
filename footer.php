<footer class="site-footer">
    <img class="footer-overlay" src="<?php echo get_template_directory_uri() . '/assets/images/footer-overlay.png'; ?>"
        alt="footer overlay" loading="lazy">
    <div class="footer-wrapper">
        <div class="left">
            <div class="site-info">
                <img class="footer-logo"
                    src="<?php echo get_template_directory_uri() . '/assets/images/logo-new.svg'; ?>"
                    alt="footer logo" loading="lazy">
                <p><b>Địa chỉ:</b> 120 & 258 Xô Viết Nghệ Tĩnh, Hải Châu, Đà Nẵng.</p>
                <p><b>Email:</b> contact@genplusmedia.com</p>
                <p><b>Thời gian:</b> Thứ hai - Thứ sáu, Sáng 08:00 - 11:30, Chiều 13:30 - 17:00</p>
            </div>
            <div class="site-contact">
                <a href="tel:+84877979777" class="btn-call"><img class="icon" src="<?php echo get_template_directory_uri() . '/assets/icon/phone.svg'; ?>"
                alt="icon" loading="lazy">(+84) 877 979 777</a>
                <ul class="site-socials">
                    <li><img class="icon" src="<?php echo get_template_directory_uri() . '/assets/icon/fb.svg'; ?>"
                    alt="social icon" loading="lazy"></li>
                    <li><img class="icon" src="<?php echo get_template_directory_uri() . '/assets/icon/tiktok.svg'; ?>"
                    alt="social icon" loading="lazy"></li>
                    <li><img class="icon" src="<?php echo get_template_directory_uri() . '/assets/icon/mail.svg'; ?>"
                    alt="social icon" loading="lazy"></li>
                </ul>
            </div>
        </div>
        <div class="right">
            <div class="menu-service">
                <h2 class="heading">Dịch vụ</h2>
                <?php if (has_nav_menu('footer-1')): ?>
                    <nav class="footer-navigation" aria-label="<?php esc_attr_e('Footer Menu', 'genplus-media'); ?>">
                        <?php
                        wp_nav_menu(
                            array(
                                'theme_location' => 'footer-1',
                                'menu_class' => 'footer-menu',
                                'depth' => 1,
                            )
                        );
                        ?>
                    </nav><!-- .footer-navigation -->
                <?php endif; ?>
            </div>
            <div class="menu-company">
                <h2 class="heading">Về công ty</h2>
                <?php if (has_nav_menu('footer-2')): ?>
                    <nav class="footer-navigation" aria-label="<?php esc_attr_e('Footer Menu', 'genplus-media'); ?>">
                        <?php
                        wp_nav_menu(
                            array(
                                'theme_location' => 'footer-2',
                                'menu_class' => 'footer-menu',
                                'depth' => 1,
                            )
                        );
                        ?>
                    </nav><!-- .footer-navigation -->
                <?php endif; ?>
            </div>
        </div>
    </div>
</footer>
<div class="copyright">
    <?php
    /* translators: %s: WordPress. */
    printf(__('Copyright © 2024 GenPlus Media', 'genplus-media'));
    ?>
</div><!-- .site-copyright -->
<script src="<?php echo get_template_directory_uri() . '/assets/js/jquery-3.7.1.min.js'; ?>"
    id="jquery-3rd-js"></script>
<?php wp_footer(); ?>
</body>
</html>