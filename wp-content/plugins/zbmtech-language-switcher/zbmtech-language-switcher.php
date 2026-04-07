<?php
/**
 * Plugin Name: ZBMTech Language Switcher
 * Description: Adds an English/Spanish language switcher with WordPress and Elementor widgets.
 * Version: 1.0.0
 * Author: zbmtech
 * Text Domain: zbmtech-language-switcher
 */

if (!defined('ABSPATH')) {
    exit;
}

class ZBMTech_Language_Switcher {
    const COOKIE_KEY = 'zbmtech_lang';
    const QUERY_KEY = 'zbm_lang';

    /**
     * Supported language map.
     *
     * @return array<string, string>
     */
    public static function languages() {
        return array(
            'en' => 'en_US',
            'es' => 'es_ES',
        );
    }

    public static function init() {
        add_action('init', array(__CLASS__, 'capture_language_selection'));
        add_filter('determine_locale', array(__CLASS__, 'apply_selected_locale'));
        add_filter('locale', array(__CLASS__, 'apply_selected_locale'));
        add_shortcode('zbm_language_dropdown', array(__CLASS__, 'render_dropdown'));
        add_action('widgets_init', array(__CLASS__, 'register_widget'));
        add_action('elementor/widgets/register', array(__CLASS__, 'register_elementor_widget'));
        add_action('wp_footer', array(__CLASS__, 'render_floating_widget'));
        add_action('wp_head', array(__CLASS__, 'print_floating_styles'));
        add_action('wp_footer', array(__CLASS__, 'print_frontend_translate_script'), 99);
    }

    /**
     * Save selected language from query param.
     */
    public static function capture_language_selection() {
        if (!isset($_GET[self::QUERY_KEY])) {
            return;
        }

        $raw_lang = sanitize_text_field(wp_unslash($_GET[self::QUERY_KEY]));
        $lang     = strtolower($raw_lang);
        $valid    = array_keys(self::languages());

        if (!in_array($lang, $valid, true)) {
            return;
        }

        setcookie(
            self::COOKIE_KEY,
            $lang,
            time() + MONTH_IN_SECONDS,
            COOKIEPATH ? COOKIEPATH : '/',
            COOKIE_DOMAIN,
            is_ssl(),
            true
        );

        // Sync Google Translate cookie so frontend content can be auto-translated.
        $googtrans_value = ($lang === 'es') ? '/en/es' : '/en/en';
        setcookie('googtrans', $googtrans_value, time() + MONTH_IN_SECONDS, '/');

        $_COOKIE[self::COOKIE_KEY] = $lang;
        $_COOKIE['googtrans']      = $googtrans_value;
    }

    /**
     * Force locale by saved language.
     *
     * @param string $locale Current locale.
     * @return string
     */
    public static function apply_selected_locale($locale) {
        $lang = self::get_current_language();
        $map  = self::languages();

        if (isset($map[$lang])) {
            return $map[$lang];
        }

        return $locale;
    }

    /**
     * @return string
     */
    public static function get_current_language() {
        $default = 'en';
        $valid   = array_keys(self::languages());

        if (!empty($_GET[self::QUERY_KEY])) {
            $query_lang = strtolower(sanitize_text_field(wp_unslash($_GET[self::QUERY_KEY])));
            if (in_array($query_lang, $valid, true)) {
                return $query_lang;
            }
        }

        if (!empty($_COOKIE[self::COOKIE_KEY])) {
            $cookie_lang = strtolower(sanitize_text_field(wp_unslash($_COOKIE[self::COOKIE_KEY])));
            if (in_array($cookie_lang, $valid, true)) {
                return $cookie_lang;
            }
        }

        return $default;
    }

    /**
     * Render dropdown form.
     *
     * @return string
     */
    public static function render_dropdown($flags_only = false) {
        $current_lang = self::get_current_language();
        $current_url  = (is_ssl() ? 'https://' : 'http://') . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
        $action_url   = remove_query_arg(self::QUERY_KEY, $current_url);
        $action_url   = esc_url($action_url);

        ob_start();

        if ($flags_only) :
            ?>
            <div class="zbmtech-flag-switcher" translate="no">
                <a class="zbmtech-flag-btn <?php echo $current_lang === 'en' ? 'is-active' : ''; ?>" href="<?php echo esc_url(add_query_arg(self::QUERY_KEY, 'en', $action_url)); ?>" aria-label="<?php echo esc_attr__('English', 'zbmtech-language-switcher'); ?>">🇬🇧</a>
                <a class="zbmtech-flag-btn <?php echo $current_lang === 'es' ? 'is-active' : ''; ?>" href="<?php echo esc_url(add_query_arg(self::QUERY_KEY, 'es', $action_url)); ?>" aria-label="<?php echo esc_attr__('Spanish', 'zbmtech-language-switcher'); ?>">🇪🇸</a>
            </div>
            <?php
            return (string) ob_get_clean();
        endif;

        ?>
        <form class="zbmtech-language-switcher" method="get" action="<?php echo $action_url; ?>">
            <label for="zbmtech-language-select" style="display:block;margin-bottom:6px;">
                <?php echo esc_html__('Language', 'zbmtech-language-switcher'); ?>
            </label>
            <select id="zbmtech-language-select" name="<?php echo esc_attr(self::QUERY_KEY); ?>" onchange="this.form.submit()">
                <option value="en" <?php selected($current_lang, 'en'); ?>><?php echo esc_html__('English', 'zbmtech-language-switcher'); ?></option>
                <option value="es" <?php selected($current_lang, 'es'); ?>><?php echo esc_html__('Spanish', 'zbmtech-language-switcher'); ?></option>
            </select>
            <noscript>
                <button type="submit"><?php echo esc_html__('Change', 'zbmtech-language-switcher'); ?></button>
            </noscript>
        </form>
        <?php

        return (string) ob_get_clean();
    }

    public static function register_widget() {
        register_widget('ZBMTech_Language_Dropdown_Widget');
    }

    public static function register_elementor_widget($widgets_manager) {
        if (!class_exists('\Elementor\Widget_Base')) {
            return;
        }

        $widgets_manager->register(
            new class extends \Elementor\Widget_Base {
                public function get_name() {
                    return 'zbmtech_language_dropdown';
                }

                public function get_title() {
                    return esc_html__('ZBMTech Language Dropdown', 'zbmtech-language-switcher');
                }

                public function get_icon() {
                    return 'eicon-site-search';
                }

                public function get_categories() {
                    return array('general');
                }

                protected function render() {
                    echo ZBMTech_Language_Switcher::render_dropdown(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
                }
            }
        );
    }

    /**
     * Auto show floating dropdown on frontend pages.
     */
    public static function render_floating_widget() {
        if (is_admin()) {
            return;
        }

        echo '<div class="zbmtech-floating-language-widget">';
        echo self::render_dropdown(true); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
        echo '</div>';
    }

    /**
     * Frontend floating widget style.
     */
    public static function print_floating_styles() {
        if (is_admin()) {
            return;
        }
        ?>
        <style>
            .zbmtech-floating-language-widget {
                position: fixed;
                right: 20px;
                bottom: 20px;
                z-index: 99999;
                background: #ffffff;
                padding: 10px 12px;
                border-radius: 10px;
                box-shadow: 0 8px 24px rgba(0, 0, 0, 0.15);
            }
            .zbmtech-floating-language-widget .zbmtech-language-switcher {
                margin: 0;
            }
            .zbmtech-floating-language-widget label {
                font-size: 13px;
                font-weight: 600;
                margin-bottom: 4px !important;
            }
            .zbmtech-floating-language-widget select {
                min-width: 72px;
                height: 36px;
                border: 1px solid #d0d7de;
                border-radius: 6px;
                padding: 0 8px;
                background: #fff;
                font-size: 22px;
            }
            .zbmtech-flag-switcher {
                display: flex;
                gap: 8px;
                align-items: center;
            }
            .zbmtech-flag-btn {
                display: inline-flex;
                align-items: center;
                justify-content: center;
                width: 38px;
                height: 38px;
                border: 1px solid #d0d7de;
                border-radius: 8px;
                text-decoration: none;
                font-size: 22px;
                line-height: 1;
                background: #fff;
            }
            .zbmtech-flag-btn.is-active {
                border-color: #0a66c2;
                box-shadow: 0 0 0 2px rgba(10, 102, 194, 0.15);
            }
            #goog-gt-tt,
            .goog-tooltip,
            .goog-text-highlight {
                display: none !important;
                box-shadow: none !important;
            }
        </style>
        <?php
    }

    /**
     * Translate Elementor/static frontend text with Google Translate script.
     */
    public static function print_frontend_translate_script() {
        if (is_admin()) {
            return;
        }

        $lang = self::get_current_language();
        ?>
        <div id="zbmtech-google-translate-element" style="display:none;"></div>
        <script>
            (function () {
                var selectedLang = <?php echo wp_json_encode($lang); ?>;

                function setGoogleCookie(value) {
                    document.cookie = 'googtrans=' + value + '; path=/';
                }

                if (selectedLang === 'en') {
                    setGoogleCookie('/en/en');
                    return;
                }

                if (selectedLang !== 'es') {
                    return;
                }

                setGoogleCookie('/en/es');

                window.zbmtechApplyGoogleTranslate = function () {
                    if (window.zbmtechTranslateApplied) {
                        return;
                    }

                    if (!window.google || !window.google.translate || !window.google.translate.TranslateElement) {
                        return;
                    }

                    new window.google.translate.TranslateElement(
                        {
                            pageLanguage: 'en',
                            includedLanguages: 'en,es',
                            autoDisplay: false
                        },
                        'zbmtech-google-translate-element'
                    );

                    var attempts = 0;
                    var interval = window.setInterval(function () {
                        var combo = document.querySelector('.goog-te-combo');
                        attempts++;

                        if (combo) {
                            if (combo.value !== 'es') {
                                combo.value = 'es';
                                combo.dispatchEvent(new Event('change'));
                            }
                            window.zbmtechTranslateApplied = true;
                            window.clearInterval(interval);
                            return;
                        }

                        if (attempts > 20) {
                            window.clearInterval(interval);
                        }
                    }, 300);
                };

                var script = document.createElement('script');
                script.src = 'https://translate.google.com/translate_a/element.js?cb=zbmtechApplyGoogleTranslate';
                script.async = true;
                document.body.appendChild(script);
            })();
        </script>
        <?php
    }
}

class ZBMTech_Language_Dropdown_Widget extends WP_Widget {
    public function __construct() {
        parent::__construct(
            'zbmtech_language_dropdown_widget',
            esc_html__('ZBMTech Language Dropdown', 'zbmtech-language-switcher'),
            array(
                'description' => esc_html__('Shows English/Spanish language dropdown.', 'zbmtech-language-switcher'),
            )
        );
    }

    public function widget($args, $instance) {
        $title = !empty($instance['title']) ? $instance['title'] : esc_html__('Language', 'zbmtech-language-switcher');

        echo $args['before_widget']; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
        echo $args['before_title'] . esc_html($title) . $args['after_title']; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
        echo ZBMTech_Language_Switcher::render_dropdown(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
        echo $args['after_widget']; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
    }

    public function form($instance) {
        $title = !empty($instance['title']) ? $instance['title'] : esc_html__('Language', 'zbmtech-language-switcher');
        ?>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('title')); ?>">
                <?php echo esc_html__('Title:', 'zbmtech-language-switcher'); ?>
            </label>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr($title); ?>">
        </p>
        <?php
    }

    public function update($new_instance, $old_instance) {
        $instance          = array();
        $instance['title'] = isset($new_instance['title']) ? sanitize_text_field($new_instance['title']) : '';
        return $instance;
    }
}

ZBMTech_Language_Switcher::init();
