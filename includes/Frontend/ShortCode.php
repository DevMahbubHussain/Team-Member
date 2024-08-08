<?php

namespace Orbit\TeamMember\Frontend;

use WP_Query;

class ShortCode
{
    public function __construct()
    {
        add_shortcode('team_members', [$this, 'render_team_members_shortcode']);
    }

    public function render_team_members_shortcode($atts)
    {
        $post_type_slug = get_option('ot_team_member_post_type_slug', 'team-member');
        $atts = shortcode_atts([
            'number' => -1,
            'image_position' => 'top',
            'show_see_all' => true,
        ], $atts);

        // Sanitize attributes
        $number = intval($atts['number']);
        $image_position = in_array($atts['image_position'], ['top', 'bottom']) ? $atts['image_position'] : 'top';
        $show_see_all = filter_var($atts['show_see_all'], FILTER_VALIDATE_BOOLEAN);
        $team_members = $this->query_team_members($number);

        ob_start();
        require_once OT_TEAM_TEMPLATE_PATH . '/members.php';
        return ob_get_clean();
    }



    private function query_team_members($number)
    {
        $post_type_slug = get_option('ot_team_member_post_type_slug', 'team-member');
        $args = [
            'post_type' => $post_type_slug,
            'posts_per_page' => $number,
        ];
        $query = new WP_Query($args);

        return $query->posts;
    }
}
