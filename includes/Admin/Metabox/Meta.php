<?php

namespace Orbit\TeamMember\Admin\Metabox;

class Meta
{
    public function __construct()
    {
        add_action('add_meta_boxes', [$this, 'ot_team_member_metabox_register']);
        add_action('save_post', [$this, 'ot_team_member_save'], 10, 1);
    }

    public function ot_team_member_metabox_register()
    {
        $post_type_slug = get_option('ot_team_member_post_type_slug', 'team-member');
        add_meta_box(
            'team-member',
            __('Team Member', 'ot-team-member'),
            [$this, 'ot_team_member_metabox_render'],
            $post_type_slug,
            'normal',
            'high'
        );
    }

    public function ot_team_member_metabox_render($post)
    {
        wp_nonce_field('orbit_team', 'orbit_team_nonce');
        $data = get_post_meta($post->ID, '_orbit_team_key', true);
        $position = isset($data['position']) ? $data['position'] : '';
?>
        <p>
            <label class="meta-label" for="orbit_team_member_position"><?php _e('Team Member Position', 'ot-team-member'); ?></label>
            <input type="text" id="orbit_team_member_position" name="orbit_team_member_position" class="widefat" value="<?php echo esc_attr($position); ?>">
        </p>
<?php
    }

    public function ot_team_member_save($post_id)
    {
        // Check nonce
        if (!isset($_POST['orbit_team_nonce'])) {
            return $post_id;
        }

        $nonce = $_POST['orbit_team_nonce'];

        if (!wp_verify_nonce($nonce, 'orbit_team')) {
            return $post_id;
        }

        // Check if doing autosave
        if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
            return $post_id;
        }

        // Check user permissions
        if (!current_user_can('edit_post', $post_id)) {
            return $post_id;
        }

        $data = [
            'position' => sanitize_text_field($_POST['orbit_team_member_position']),
        ];
        update_post_meta($post_id, '_orbit_team_key', $data);

        return $post_id;
    }
}
