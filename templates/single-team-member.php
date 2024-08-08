<?php
if (wp_is_block_theme()) {
    block_template_part('header');
    wp_head();
} else {
    get_header();
}
?>

<div class="container mx-auto p-4 mt-5">
    <div class="single-team-member my-40">
        <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
                <div class="bg-white rounded-lg shadow-md p-4 flex flex-col items-center">
                    <?php if (has_post_thumbnail()) : ?>
                        <div class="w-48 h-48 rounded-full overflow-hidden mb-4">
                            <?php the_post_thumbnail('thumbnail', ['class' => 'w-full h-full object-cover']); ?>
                        </div>
                    <?php endif; ?>
                    <h1 class="mt-4 text-2xl font-semibold"><?php the_title(); ?></h1>
                    <?php
                    $meta_data = get_post_meta(get_the_ID(), '_orbit_team_key', true);
                    $position = isset($meta_data['position']) ? esc_html($meta_data['position']) : '';
                    ?>
                    <p class="text-gray-600 mb-4"><?php echo $position; ?></p>
                    <div class="entry-content">
                        <?php the_content(); ?>
                    </div>
                </div>
            <?php endwhile;
        else : ?>
            <p><?php _e('No team member found.', 'ot-team-member'); ?></p>
        <?php endif; ?>
    </div>
</div>

<?php
if (wp_is_block_theme()) {
    block_template_part('footer');
    wp_footer();
} else {
    get_footer();
}
?>