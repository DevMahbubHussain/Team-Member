<?php

namespace Orbit\TeamMember\Admin;

class Menu
{
    public function __construct()
    {
        add_action('admin_menu', [$this, 'ot_team_member_menu']);
        add_action('admin_init', [$this, 'ot_register_settings']);
    }

    public function ot_team_member_menu()
    {
        add_menu_page(
            __('Team Member Settings', 'ot-team-member'),
            __('Team Member Settings', 'ot-team-member'),
            'manage_options',
            'team-member-settings',
            [$this, 'team_member_settings_page'],
            'dashicons-admin-users',
        );
    }

    public function team_member_settings_page()
    {
        if (!current_user_can('manage_options')) {
            wp_die(__('You do not have sufficient permissions to access this page.'));
        }
?>
        <div class="wrap">
            <h1><?php _e('Team Member Settings', 'ot-team-member'); ?></h1>
            <form method="post" action="options.php">
                <?php
                settings_fields('ot_team_member_settings_group');
                do_settings_sections('team-member-settings');
                submit_button();
                ?>
            </form>
        </div>
<?php
    }

    public function ot_register_settings()
    {
        register_setting('ot_team_member_settings_group', 'ot_team_member_post_type_name');
        register_setting('ot_team_member_settings_group', 'ot_team_member_post_type_slug');

        add_settings_section(
            'ot_team_member_settings_section',
            __('', 'ot-team-member'),
            [$this, 'ot_team_member_settings_section_callback'],
            'team-member-settings'
        );

        add_settings_field(
            'ot_team_member_post_type_name',
            __('Post Type Name', 'ot-team-member'),
            [$this, 'ot_team_member_post_type_name_render'],
            'team-member-settings',
            'ot_team_member_settings_section'
        );

        add_settings_field(
            'ot_team_member_post_type_slug',
            __('URL Slug', 'ot-team-member'),
            [$this, 'ot_team_member_post_type_slug_render'],
            'team-member-settings',
            'ot_team_member_settings_section'
        );
    }

    public function ot_team_member_settings_section_callback()
    {
        // 
    }

    public function ot_team_member_post_type_name_render()
    {
        $value = get_option('ot_team_member_post_type_name', 'Team Member');
        echo '<input type="text" name="ot_team_member_post_type_name" value="' . esc_attr($value) . '" />';
    }

    public function ot_team_member_post_type_slug_render()
    {
        $value = get_option('ot_team_member_post_type_slug', 'team-member');
        echo '<input type="text" name="ot_team_member_post_type_slug" value="' . esc_attr($value) . '" />';
    }
}
