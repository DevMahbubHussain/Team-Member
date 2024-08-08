<?php if (!empty($team_members)) : ?>
    <div class="container mx-auto p-4">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
            <?php foreach ($team_members as $member) : ?>
                <div class="bg-white rounded-lg shadow-md p-4 flex flex-col items-center">
                    <?php if ($image_position === 'top') : ?>
                        <a href="<?php echo esc_url(get_permalink($member->ID)); ?>" class="w-24 h-24 mb-4 rounded-full overflow-hidden">
                            <?php echo get_the_post_thumbnail($member->ID, 'thumbnail', ['class' => 'w-full h-full object-cover']); ?>
                        </a>
                    <?php endif; ?>

                    <div class="text-center">
                        <h2 class="text-xl font-semibold mb-2">
                            <a href="<?php echo esc_url(get_permalink($member->ID)); ?>" class="text-blue-500 hover:underline">
                                <?php echo esc_html(get_the_title($member->ID)); ?>
                            </a>
                        </h2>
                        <?php
                        $meta_data = get_post_meta($member->ID, '_orbit_team_key', true);
                        $position = isset($meta_data['position']) ? esc_html($meta_data['position']) : '';
                        ?>
                        <p class="text-gray-600"><?php echo $position; ?></p>
                    </div>

                    <?php if ($image_position === 'bottom') : ?>
                        <a href="<?php echo esc_url(get_permalink($member->ID)); ?>" class="w-24 h-24 mt-4 rounded-full overflow-hidden">
                            <?php echo get_the_post_thumbnail($member->ID, 'thumbnail', ['class' => 'w-full h-full object-cover']); ?>
                        </a>
                    <?php endif; ?>
                </div>
            <?php endforeach; ?>
        </div>

        <?php if ($show_see_all) : ?>
            <div class="mt-6 text-center">
                <a href="<?php echo esc_url(get_post_type_archive_link($post_type_slug)); ?>" class="text-blue-500 hover:underline">
                    <?php _e('See all', 'ot-team-member'); ?>
                </a>
            </div>
        <?php endif; ?>
    </div>
<?php else : ?>
    <div class="container mx-auto p-4">
        <p class="text-center text-gray-600"><?php _e('No team members found.', 'ot-team-member'); ?></p>
    </div>
<?php endif; ?>