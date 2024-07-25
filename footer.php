<?php
$candidates = get_terms(
    'candidate_position',
    array(
        'orderby' => 'name',
        'order' => 'ASC',
        'hide_empty' => 0
    )
);
?>
<footer class="site-footer">
    <img class="footer-overlay" src="<?php echo get_template_directory_uri() . '/assets/images/footer-overlay.png'; ?>"
        alt="footer overlay" loading="lazy">
    <div class="footer-wrapper">
        <div class="left">
            <div class="site-info">
                <img class="footer-logo"
                    src="<?php echo get_template_directory_uri() . '/assets/images/logo-new.svg'; ?>" alt="footer logo"
                    loading="lazy">
                <p><b><?php esc_html_e('Địa chỉ:', 'genplus-media'); ?></b> <?php esc_html_e('120 & 258 Xô Viết Nghệ Tĩnh, Hải Châu, Đà Nẵng.', 'genplus-media'); ?></p>
                <p><b><?php esc_html_e('Email:', 'genplus-media'); ?></b> <?php esc_html_e('contact@genplusmedia.com', 'genplus-media'); ?></p>
                <p><b><?php esc_html_e('Thời gian:', 'genplus-media'); ?></b> <?php esc_html_e('Thứ hai - Thứ sáu, Sáng 08:00 - 11:30, Chiều 13:30 - 17:00', 'genplus-media'); ?></p>
            </div>
            <div class="site-contact">
                <a href="tel:+84877979777" class="btn-call"><img class="icon"
                        src="<?php echo get_template_directory_uri() . '/assets/icon/phone.svg'; ?>" alt="icon"
                        loading="lazy"><?php esc_html_e('(+84) 877 979 777', 'genplus-media'); ?></a>
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
                <h2 class="heading"><?php esc_html_e('Dịch vụ', 'genplus-media'); ?></h2>
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
                <h2 class="heading"><?php esc_html_e('Về công ty', 'genplus-media'); ?></h2>
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
    printf(__('Copyright © '.date("Y").' GenPlus Media', 'genplus-media'));
    ?>
</div><!-- .site-copyright -->
<div class="modal">
    <div class="modal-content">
        <span class="close">&times;</span>
        <div class="modal-wrapper">
            <h2 class="heading"><?php esc_html_e('Thông tin ứng tuyển', 'genplus-media'); ?></h2>
            <form action="<?php echo esc_url(sanitize_url(wp_unslash($_SERVER['REQUEST_URI']))); ?>" method="post"
                id="apply-form" class="apply-form" enctype="multipart/form-data">
                <div class="form-group">
                    <label><?php esc_html_e('Họ và Tên', 'genplus-media'); ?></label>
                    <input type="text" name="full_name" class="form-control" placeholder="Nhập tên của bạn" />
                </div>
                <div class="form-group">
                    <label><?php esc_html_e('Email', 'genplus-media'); ?></label>
                    <input type="email" name="email" class="form-control" placeholder="Nhập email của bạn" />
                </div>
                <div class="form-group">
                    <label><?php esc_html_e('Số điện thoại', 'genplus-media'); ?></label>
                    <input type="number" name="phone" class="form-control" placeholder="Nhập số điện thoại của bạn" />
                </div>
                <div class="form-group">
                    <label><?php esc_html_e('Vị trí ứng tuyển', 'genplus-media'); ?></label>
                    <select name="position" class="form-control required">
                        <option value="0"><?php esc_html_e('Chọn vị trí ứng tuyển', 'genplus-media'); ?></option>
                        <?php if (!empty($candidates) && !is_wp_error($candidates)):
                            foreach ($candidates as $key => $candidate): ?>
                                <option value="<?php esc_attr_e($candidate->term_id) ?>"><?php esc_html_e($candidate->name); ?>
                                </option>
                            <?php endforeach;
                        endif;
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <label><?php esc_html_e('Nội dung ứng tuyển', 'genplus-media'); ?></label>
                    <textarea name="content" class="form-control" placeholder="Nhập nội dung ứng tuyển"></textarea>
                </div>
                <div class="form-group form-group-media">
                    <label><?php esc_html_e('Tải CV lên', 'genplus-media'); ?></label>
                    <div id="attachment_plupload_container" class="media-upload">
                        <div class="icon-upload-media">
                            <button type="button" id="choose_attachment_files">
                                <img loading="lazy"
                                    src="<?php echo get_template_directory_uri() . "/assets/images/icon-upload.png" ?>"
                                    alt="icon">
                            </button>
                        </div>
                        <h3 class="description">
                            <?php esc_html_e('*upload file jpg, png, pdf', 'genplus-media'); ?>
                        </h3>
                        <div id="attachment_errors"></div>
                        <input type="hidden" id="attachment_id" name="attachment_id" class="do-not-ignore" value="" />
                    </div>
                </div>
                <div class="action">
                    <button class="btn-close" type="button"><?php esc_html_e('hủy', 'genplus-media'); ?></button>
                    <button class="btn-submit" type="button"><?php esc_html_e('ứng tuyển', 'genplus-media'); ?></button>
                </div>
                <div class="message"></div>
            </form>
        </div>
    </div>
</div>
<script src="<?php echo get_template_directory_uri() . '/assets/js/jquery-3.7.1.min.js'; ?>"
    id="jquery-3rd-js"></script>
<?php wp_footer(); ?>
<a class="back-to-top">&#129129;</a>
</body>
</html>