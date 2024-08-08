<?php
if (wp_is_block_theme()) {
    block_template_part('header');
    wp_head();
} else {
    get_header();
}

?>

<div class="container mx-auto p-4 mt-5">
    <div class="team-members-archive my-40">
        <h2 class="mt-4 text-xl font-semibold my-10"><?php echo get_the_archive_title(); ?></h2>
        <?php if (have_posts()) : ?>
            <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-6">
                <?php while (have_posts()) : the_post(); ?>
                    <div class="bg-white rounded-lg shadow-md p-4 flex flex-col items-center">
                        <?php if (has_post_thumbnail()) : ?>
                            <a href="<?php the_permalink(); ?>" class="w-24 h-24 rounded-full overflow-hidden">
                                <?php the_post_thumbnail('thumbnail', ['class' => 'w-full h-full object-cover']); ?>
                            </a>
                        <?php endif; ?>
                        <h2 class="mt-4 text-xl font-semibold">
                            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                        </h2>
                        <?php
                        $meta_data = get_post_meta(get_the_ID(), '_orbit_team_key', true);
                        $position = isset($meta_data['position']) ? esc_html($meta_data['position']) : '';
                        ?>
                        <p class="text-gray-600"><?php echo $position; ?></p>
                        <div class="entry-content">
                            <?php the_content(); ?>
                        </div>
                    </div>
                <?php endwhile; ?>
            </div>
            <div class="pagination mt-6">
                <?php the_posts_pagination(); ?>
            </div>
        <?php else : ?>
            <p><?php _e('No team members found.', 'ot-team-member'); ?></p>
        <?php endif; ?>
    </div>
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