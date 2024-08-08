<?php

namespace Orbit\TeamMember\Assets;

class Manager
{
    public function __construct()
    {
        add_action('init', array($this, 'register_all_scripts'));
        add_action('wp_enqueue_scripts', array($this, 'ot_wp_register_assets'));
        add_action('admin_enqueue_scripts', array($this, 'ot_admin_register_assets'));
    }

    public function register_all_scripts()
    {
        $this->register_styles($this->get_styles());
        $this->register_scripts($this->get_scripts());
    }

    public function get_styles()
    {
        return [
            'ot-team-member-css' => [
                'src' => OT_TEAM_BUILD . '/index.css',
                'version' => OT_TEAM_VERSION,
                'deps' => []
            ],

            'ot-team-member-main-css' => [
                'src' => OT_TEAM_ASSETS . '/main.css',
                'version' => OT_TEAM_VERSION,
                'deps' => []
            ],
        ];
    }

    public function get_scripts()
    {
        $dependency = require_once OT_TEAM_DIR . '/build/index.asset.php';
        return [
            'ot-team-js' => [
                'src'       => OT_TEAM_BUILD . '/index.js',
                'version'   => $dependency,
                'deps'      => 1,
                'in_footer' => true,
            ],
            'ot-team-main-js' => [
                'src'       => OT_TEAM_ASSETS . '/js/main.js',
                'version'   => $dependency,
                'deps'      => ['jquery'],
                'in_footer' => true,
            ],
        ];
    }

    public function register_styles(array $styles)
    {
        foreach ($styles as $handle => $style) {
            wp_register_style($handle, $style['src'], $style['deps'], $style['version']);
        }
    }

    public function register_scripts(array $scripts)
    {
        foreach ($scripts as $handle => $script) {
            wp_register_script($handle, $script['src'], $script['deps'], $script['version'], $script['in_footer']);
        }
    }


    public function ot_admin_register_assets()
    {
        if ($this->epm_is_valid_admin_page()) {
            $this->ot_enqueue_admin_styles();
            $this->ot_enqueue_admin_scripts();
        }
    }

    public function ot_wp_register_assets()
    {
        wp_enqueue_style('ot-team-member-css');
        wp_enqueue_script('ot-team-js');
    }


    private function epm_is_valid_admin_page()
    {
        $valid_pages = [
            'team-member-settings',
        ];
        return is_admin() && isset($_GET['page']) && in_array(sanitize_text_field(wp_unslash($_GET['page'])), $valid_pages);
    }


    private function ot_enqueue_admin_styles()
    {
        // Enqueue necessary admin styles
        wp_enqueue_style('ot-team-member-css');
    }

    private function ot_enqueue_admin_scripts()
    {
        // Enqueue necessary admin scripts
        wp_enqueue_script('ot-team-js');
        wp_enqueue_script('ot-team-main-js');
    }
}
