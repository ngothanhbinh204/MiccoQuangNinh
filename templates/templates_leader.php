<?php
/**
 * Template Name: Trang Ban Lãnh Đạo
 */
get_header();

// Banner Section
get_template_part('modules/common/banner'); 

// Get ACF Fields
$leader_desc = get_field('leader_desc');
$leader_tabs = get_field('leader_tabs');
?>

<section class="leader section-py">
    <div class="container">
        <div class="wrap" data-toggle="tabslet">
            <?php if ($leader_desc): ?>
                <div class="desc body-1 mb-base text-center">
                    <?php echo $leader_desc; ?>
                </div>
            <?php endif; ?>

            <?php if ($leader_tabs): ?>
                <!-- Tab Navigation -->
                <ul class="tabslet-tab">
                    <?php foreach ($leader_tabs as $index => $tab): 
                        $active_class = ($index === 0) ? 'active' : '';
                        $tab_id = 'tab' . ($index + 1);
                    ?>
                        <li class="<?php echo $active_class; ?>">
                            <a href="#<?php echo $tab_id; ?>"><?php echo esc_html($tab['tab_title']); ?></a>
                        </li>
                    <?php endforeach; ?>
                </ul>

                <!-- Tab Content -->
                <?php foreach ($leader_tabs as $index => $tab): 
                    $active_div = ($index === 0) ? 'active' : '';
                    $tab_id = 'tab' . ($index + 1);
                    $rows = $tab['tab_rows'];
                ?>
                    <div class="tabslet-content <?php echo $active_div; ?>" id="<?php echo $tab_id; ?>">
                        <?php if ($rows): ?>
                            <div class="wrap-content flex justify-center flex-wrap gap-8">
                                <?php foreach ($rows as $r_index => $row): 
                                    $items = $row['row_items'];
                                    $delay_base = ($r_index + 1) * 100;
                                    // Determine column class based on row index or items count if needed?
                                    // HTML used "column col-12" or "column-list col-12". Let's stick to a generic wrapper.
                                ?>
                                    <div class="column col-12" data-aos="fade-up" data-aos-delay="<?php echo $delay_base; ?>">
                                        <div class="row justify-center">
                                            <?php if ($items): ?>
                                                <?php foreach ($items as $item): ?>
                                                    <div class="item group col-lg-4">
                                                        <div class="img img-ratio zoom-img rounded-5">
                                                            <?php if ($item['image']): ?>
                                                                <?php echo get_image_attrachment($item['image'], 'image'); ?>
                                                            <?php else: ?>
                                                                <img class="lozad" data-src="<?php echo get_template_directory_uri(); ?>/img/placeholder.jpg" alt="<?php echo esc_attr($item['name']); ?>">
                                                            <?php endif; ?>
                                                        </div>
                                                        <div class="content pt-5 text-center">
                                                            <div class="title-wrapper">
                                                                <div class="title heading-3 text-Primary-2 mb-2"><?php echo esc_html($item['name']); ?></div>
                                                            </div>
                                                            <div class="role heading-5 text-Primary-3"><?php echo esc_html($item['position']); ?></div>
                                                        </div>
                                                    </div>
                                                <?php endforeach; ?>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>
</section>

<?php get_footer(); ?>
