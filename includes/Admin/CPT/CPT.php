<?php

namespace Orbit\TeamMember\Admin\CPT;

class CPT
{

    public function __construct()
    {
        add_action('init', [$this, 'ot_team_member_cpt_register']);
        add_action('init', [$this, 'ot_team_member_register_taxonomy']);
        add_filter('template_include', [$this, 'ot_team_member_archive_template'], 99);
        add_filter('template_include', [$this, 'ot_team_member_single_template'], 99);
    }

    public function ot_team_member_cpt_register()
    {
        $post_type_name = get_option('ot_team_member_post_type_name', 'Team Member');
        $post_type_slug = get_option('ot_team_member_post_type_slug', 'team-member');
        register_post_type($post_type_slug, [
            'label'  => __($post_type_name, 'ot-team-member'),
            'labels' => [
                'name'          => __($post_type_name, 'ot-team-member'),
                'singular_name' => __($post_type_name, 'ot-team-member'),
                'add_new_item'  => __(' Add New ' . $post_type_name, 'ot-team-member'),
                'add_new'       => __(' Add ' . $post_type_name, 'ot-team-member'),
                'featured_image' => __('Member Picture', 'ot-team-member'),
                'set_featured_image' => __('Set Member Picture', 'ot-team-member'),
                'archives'      => __($post_type_name . 'Archives', 'ot-team-member'),
            ],
            'public'      => true,
            'show_in_menu' => true,
            'has_archive' => true,
            'rewrite'     => ['slug' => $post_type_slug],
            'menu_icon'   => 'dashicons-admin-users',
            'taxonomies'  => ['member_type'],
            'supports'    => ['title', 'editor', 'thumbnail'],
        ]);
    }

    public function ot_team_member_register_taxonomy()
    {
        $post_type_slug = get_option('ot_team_member_post_type_slug', 'team-member');
        register_taxonomy('member_type', [$post_type_slug], [
            'labels' => [
                'name'          => __('Member Types', 'ot-team-member'),
                'singular_name' => __('Member Type', 'ot-team-member'),
            ],
            'hierarchical'      => true,
            'show_admin_column' => true,
        ]);
    }

    public function ot_team_member_archive_template($template)
    {
        if (is_post_type_archive('team-member')) {
            $custom_template = OT_TEAM_TEMPLATE_PATH . '/archive-team-member.php';
            if (file_exists($custom_template)) {
                return $custom_template;
            }
        }
        return $template;
    }

    public function ot_team_member_single_template($template)
    {
        if (is_singular('team-member')) {
            $custom_template = OT_TEAM_TEMPLATE_PATH . '/single-team-member.php';
            if (file_exists($custom_template)) {
                return $custom_template;
            }
        }
        return $template;
    }
}
