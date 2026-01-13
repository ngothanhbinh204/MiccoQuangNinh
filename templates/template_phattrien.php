<?php
/**
 * Template Name: Trang Phát Triển Bền Vững
 */
get_header();

// Banner Section
get_template_part('modules/common/banner'); 

// ACF Fields - Section 1
$dev_1_bg = get_field('dev_1_bg');
$dev_1_title = get_field('dev_1_title');
$dev_1_desc = get_field('dev_1_desc');

// ACF Fields - Section 2
$dev_2_bg = get_field('dev_2_bg');
$dev_2_title = get_field('dev_2_title');
$dev_2_desc = get_field('dev_2_desc');
$dev_2_items = get_field('dev_2_items');

// ACF Fields - Section 3
$dev_3_image = get_field('dev_3_image');
$dev_3_title = get_field('dev_3_title');
$dev_3_desc = get_field('dev_3_desc');
$dev_3_items = get_field('dev_3_items');
?>

<!-- Section 1 -->
<?php if ($dev_1_desc): ?>
<section class="section-PhatTrien-1" <?php if($dev_1_bg) echo 'setBackground="'.esc_url($dev_1_bg).'"'; ?>>
    <div class="container">
        <div class="wrap-content">
            <?php if ($dev_1_title): ?>
                <h1 class="heading-1 capitalize text-Primary-2 leading-[1.4] font-bold"><?php echo esc_html($dev_1_title); ?></h1>
            <?php endif; ?>
            <div class="format-content">
                <?php echo wp_kses_post($dev_1_desc); ?>
            </div>
        </div>
    </div>
</section>
<?php endif; ?>

<!-- Section 2 -->
<?php if ($dev_2_desc || $dev_2_items): ?>
<section class="section-PhatTrien-2" <?php if($dev_2_bg) echo 'setBackground="'.esc_url($dev_2_bg).'"'; ?>>
    <div class="bg-section-PhatTrien-2">
        <div class="container">
            <div class="wrap-content">
                <?php if ($dev_2_title): ?>
                    <h2 class="heading-1 text-Primary-2 font-bold text-center"><?php echo esc_html($dev_2_title); ?></h2>
                <?php endif; ?>
                
                <?php if ($dev_2_desc): ?>
                    <div class="format-content">
                        <?php echo wp_kses_post($dev_2_desc); ?>
                    </div>
                <?php endif; ?>

                <?php if ($dev_2_items): ?>
                    <div class="content-PhatTrien-2">
                        <ul>
                            <?php foreach ($dev_2_items as $item): ?>
                                <li>
                                    <p><?php echo nl2br(esc_html($item['text'])); ?></p>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>
<?php endif; ?>

<!-- Section 3 -->
<?php if ($dev_3_desc || $dev_3_items): ?>
<section class="section-PhatTrien-3">
    <div class="section-py">
        <div class="container">
            <div class="wrap-content">
                <div class="block-left">
                    <?php if ($dev_3_title): ?>
                        <h2 class="heading-1 text-Primary-2 font-bold"><?php echo esc_html($dev_3_title); ?></h2>
                    <?php endif; ?>
                    
                    <div class="format-content">
                        <?php echo wp_kses_post($dev_3_desc); ?>
                    </div>
                </div>
                <div class="block-right">
                    <?php if ($dev_3_image): ?>
                        <div class="img img-ratio ratio:pt-[720_680] -lg:ratio:pt-[70%] zoom-img rounded-4 ">
                            <?php echo get_image_attrachment($dev_3_image, 'image'); ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</section>
<?php endif; ?>

<?php get_footer(); ?>
