<?php
/**
 * Archive Template for Dịch Vụ (Services)
 * 
 * Lấy dữ liệu ACF từ Page có slug 'dich-vu'
 * Sử dụng WordPress main query để hiển thị danh sách dịch vụ
 */

get_header();

// Get ACF data from the associated page
$page = get_page_by_path('dich-vu');
$page_id = $page ? $page->ID : 0;

// Get ACF fields
$page_title = get_field('page_title', $page_id) ?: __('Dịch vụ', 'canhcamtheme');
$page_description = get_field('page_description', $page_id);

// Get featured services (for slider section)
$featured_services = get_field('featured_services', $page_id);
?>

<!-- Banner Section -->
<?php get_template_part('modules/common/banner'); ?>

<!-- Section: Services -->
<section class="service section-py">
    <div class="container">
        <?php if ($page_description): ?>
            <div class="format-content body-1 text-center">
                <?php echo wp_kses_post($page_description); ?>
            </div>
        <?php endif; ?>

        <!-- Featured Services Slider -->
        <?php if ($featured_services && is_array($featured_services)): ?>
            <div class="swiper-column-auto relative mt-base">
                <div class="swiper">
                    <div class="swiper-wrapper">
                        <?php foreach ($featured_services as $service): 
                            $service_image = get_post_thumbnail_id($service->ID);
                            $service_title = get_the_title($service->ID);
                            $service_excerpt = get_the_excerpt($service->ID);
                            $service_link = get_permalink($service->ID);
                        ?>
                            <div class="swiper-slide">
                                <div class="service-item">
                                    <div class="img img-ratio ratio:pt-[640_680] zoom-img rounded-5">
                                        <?php if ($service_image): ?>
                                            <?php echo get_image_attrachment($service_image, 'image'); ?>
                                        <?php else: ?>
                                            <img class="lozad" data-src="<?php echo get_template_directory_uri(); ?>/img/placeholder.jpg" alt="<?php echo esc_attr($service_title); ?>" />
                                        <?php endif; ?>
                                    </div>
                                    <div class="content flex flex-col justify-end text-white">
                                        <div class="title heading-3 font-bold">
                                            <a href="<?php echo esc_url($service_link); ?>"><?php echo esc_html($service_title); ?></a>
                                        </div>
                                        <div class="content-inner mt-5">
                                            <?php if ($service_excerpt): ?>
                                                <div class="desc body-1 font-normal mb-5">
                                                    <p><?php echo esc_html($service_excerpt); ?></p>
                                                </div>
                                            <?php endif; ?>
                                            <a class="btn btn-more" href="<?php echo esc_url($service_link); ?>">
                                                <span><?php _e('Xem chi tiết', 'canhcamtheme'); ?></span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        <?php endif; ?>

        <!-- All Services Grid -->
        <div class="wrapper-list grid lg:grid-cols-4 grid-cols-2 gap-base mt-base">
            <?php if (have_posts()): ?>
                <?php while (have_posts()): the_post(); ?>
                    <a class="card-product group" href="<?php the_permalink(); ?>">
                        <div class="img img-ratio ratio:pt-[1_1] zoom-img">
                            <?php if (has_post_thumbnail()): ?>
                                <?php echo get_image_attrachment(get_post_thumbnail_id(), 'image'); ?>
                            <?php else: ?>
                                <img class="lozad" data-src="<?php echo get_template_directory_uri(); ?>/img/placeholder.jpg" alt="<?php the_title_attribute(); ?>" />
                            <?php endif; ?>
                        </div>
                        <div class="content-card-product">
                            <div class="title-card-product group-hover:text-Primary-2">
                                <p><?php the_title(); ?></p>
                            </div>
                        </div>
                    </a>
                <?php endwhile; ?>
            <?php else: ?>
                <div class="no-services col-span-full">
                    <p><?php _e('Chưa có dịch vụ nào.', 'canhcamtheme'); ?></p>
                </div>
            <?php endif; ?>
        </div>

        <!-- Pagination -->
        <?php micco_pagination(); ?>
    </div>
</section>

<?php get_footer(); ?>
