# Team Member Plugin

A WordPress plugin to manage and display team members with customizable settings and shortcodes. 

## Features

- **Custom Post Type**: `team-member` for managing team members.
- **Customizable Settings**: Change the post type name and slug from the settings page.
- **Shortcodes**: Display team members using `[team_members]` with various parameters.
- **Pagination**: Automatically handles pagination for the team members archive page.
- **Settings Page**: Configure settings for the post type name and slug.

## Installation

1. Upload the plugin files to the `/wp-content/plugins/team-member/` directory.
2. Activate the plugin through the 'Plugins' menu in WordPress.

## Configuration

1. Go to the **Team Member Settings** page in the WordPress admin menu.
2. Update the post type name and slug as desired.
3. Save changes. **Flush rewrite rules** by going to **Settings > Permalinks** and clicking **Save Changes**.

## Shortcodes

### `[team_members]`

Display team members with customizable options.

#### Parameters

- **`number`**: Number of team members to display. Default is `-1` (all members).
- **`image_position`**: Position of the member image. Options are `top` or `bottom`. Default is `top`.
- **`show_see_all`**: Whether to display a "See all" button. Options are `true` or `false`. Default is `true`.

#### Example

```php
[team_members number="5" image_position="bottom" show_see_all="false"]
