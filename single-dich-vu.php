<?php
/**
 * Single Template for Dịch Vụ (Service Detail)
 */

get_header();

// Get ACF fields for service
$intro_content = get_field('service_intro'); // WYSIWYG
$content_blocks = get_field('service_content_blocks'); // Repeater: image + title + content
$related_products_title = get_field('related_products_title') ?: __('Các sản phẩm Dịch vụ', 'canhcamtheme');
$related_products = get_field('related_products'); // Relationship field
$related_services_title = get_field('related_services_title') ?: __('Các dịch vụ liên quan', 'canhcamtheme');
$related_services = get_field('related_services'); // Relationship field

// If no related services from ACF, get from same category
if (!$related_services) {
    $terms = wp_get_post_terms(get_the_ID(), 'danh-muc-dich-vu');
    if (!empty($terms) && !is_wp_error($terms)) {
        $related_args = array(
            'post_type' => 'dich-vu',
            'posts_per_page' => 6,
            'post__not_in' => array(get_the_ID()),
            'tax_query' => array(
                array(
                    'taxonomy' => 'danh-muc-dich-vu',
                    'field' => 'term_id',
                    'terms' => wp_list_pluck($terms, 'term_id'),
                ),
            ),
        );
        $related_query = new WP_Query($related_args);
        if ($related_query->have_posts()) {
            $related_services = $related_query->posts;
        }
        wp_reset_postdata();
    }
}
?>

<!-- Banner Section -->
<?php get_template_part('modules/common/banner'); ?>

<!-- Section 1: Service Content Blocks -->
<section class="service-detail-1 section-py">
    <div class="container">
        <?php if ($intro_content): ?>
            <div class="wrap-content mb-base">
                <div class="format-content body-1 text-center">
                    <?php echo wp_kses_post($intro_content); ?>
                </div>
            </div>
        <?php endif; ?>

        <?php if ($content_blocks && is_array($content_blocks)): ?>
            <div class="wrapper flex flex-col gap-5">
                <?php foreach ($content_blocks as $index => $block): 
                    $block_image = $block['image'];
                    $block_title = $block['title'];
                    $block_content = $block['content'];
                    $is_reversed = $index % 2 === 1; // Alternate layout
                ?>
                    <div class="wrapper-main grid grid-cols-2 gap-5 <?php echo $is_reversed ? 'lg:flex-row-reverse' : ''; ?>">
                        <div class="col-left <?php echo $is_reversed ? 'order-2' : ''; ?>">
                            <div class="img img-ratio ratio:pt-[440_690] rounded-5 h-full">
                                <?php if ($block_image): ?>
                                    <?php if (is_array($block_image)): ?>
                                        <img class="lozad" data-src="<?php echo esc_url($block_image['url']); ?>" alt="<?php echo esc_attr($block_image['alt'] ?: $block_title); ?>" />
                                    <?php else: ?>
                                        <?php echo get_image_attrachment($block_image, 'image'); ?>
                                    <?php endif; ?>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="col-right <?php echo $is_reversed ? 'order-1' : ''; ?>">
                            <div class="box">
                                <?php if ($block_title): ?>
                                    <h2 class="title heading-2 font-bold text-Primary-2 mb-base"><?php echo esc_html($block_title); ?></h2>
                                <?php endif; ?>
                                <?php if ($block_content): ?>
                                    <div class="format-content body-1 font-normal">
                                        <?php echo wp_kses_post($block_content); ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php elseif (get_the_content()): ?>
            <div class="wrapper">
                <div class="format-content body-1">
                    <?php the_content(); ?>
                </div>
            </div>
        <?php endif; ?>
    </div>
</section>

<!-- Section 2: Related Products Slider -->
<?php if ($related_products && is_array($related_products) && count($related_products) > 0): ?>
<section class="service-detail-2 section-py !pt-0">
    <div class="container">
        <h2 class="title heading-2 font-bold text-Primary-2 mb-base text-center">
            <?php echo esc_html($related_products_title); ?>
        </h2>
        <div class="slide-service">
            <div class="swiper-column-auto relative mt-base swiper-loop autoplay">
                <div class="swiper">
                    <div class="swiper-wrapper">
                        <?php foreach ($related_products as $product): ?>
                            <div class="swiper-slide">
                                <a class="card-product group" href="<?php echo get_permalink($product->ID); ?>">
                                    <div class="img img-ratio ratio:pt-[1_1] zoom-img">
                                        <?php if (has_post_thumbnail($product->ID)): ?>
                                            <?php echo get_image_attrachment(get_post_thumbnail_id($product->ID), 'image'); ?>
                                        <?php else: ?>
                                            <img class="lozad" data-src="<?php echo get_template_directory_uri(); ?>/img/placeholder.jpg" alt="<?php echo esc_attr(get_the_title($product->ID)); ?>" />
                                        <?php endif; ?>
                                    </div>
                                    <div class="content-card-product">
                                        <div class="title-card-product group-hover:text-Primary-2">
                                            <p><?php echo get_the_title($product->ID); ?></p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
                <div class="wrap-button-slide">
                    <div class="btn btn-sw-1 btn-prev"></div>
                    <div class="btn btn-sw-1 btn-next"></div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php endif; ?>

<?php
// ===========================
// RELATED SERVICES (AUTO)
// ===========================
$current_id = get_the_ID();

$related_services_title = $related_services_title ?? __('Dịch vụ khác', 'canhcamtheme');

$related_services_query = new WP_Query([
    'post_type'      => 'dich-vu',
    'post_status'    => 'publish',
    'posts_per_page' => 6,
    'post__not_in'   => [$current_id],
    'orderby'        => 'date',
    'order'          => 'DESC',
]);
?>

<?php if ($related_services_query->have_posts()) : ?>
<section class="service-detail-3 section-py">
    <div class="container">
        <h2 class="title heading-2 font-bold text-Primary-2 mb-base text-center">
            <?php echo esc_html($related_services_title); ?>
        </h2>

        <div class="slide-service">
            <div class="swiper-column-auto relative mt-base swiper-loop autoplay">
                <div class="swiper">
                    <div class="swiper-wrapper">
                        <?php while ($related_services_query->have_posts()) : $related_services_query->the_post(); ?>
                            <div class="swiper-slide">
                                <a class="card-product group" href="<?php the_permalink(); ?>">
                                    <div class="img img-ratio ratio:pt-[1_1] zoom-img">
                                        <?php if (has_post_thumbnail()) : ?>
                                            <?php echo get_image_post(get_the_ID(), 'image'); ?>
                                        <?php else : ?>
                                            <img
                                                class="lozad"
                                                data-src="<?php echo get_template_directory_uri(); ?>/img/placeholder.jpg"
                                                alt="<?php the_title_attribute(); ?>"
                                            />
                                        <?php endif; ?>
                                    </div>

                                    <div class="content-card-product">
                                        <div class="title-card-product group-hover:text-Primary-2">
                                            <p><?php the_title(); ?></p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        <?php endwhile; ?>
                    </div>
                </div>

                <div class="wrap-button-slide">
                    <div class="btn btn-sw-1 btn-prev"></div>
                    <div class="btn btn-sw-1 btn-next"></div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php endif; wp_reset_postdata(); ?>


<?php get_footer(); ?>
