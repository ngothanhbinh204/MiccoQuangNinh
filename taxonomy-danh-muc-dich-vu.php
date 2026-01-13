<?php
/**
 * Taxonomy Template for Danh Mục Dịch Vụ (Service Category)
 * 
 * Hiển thị danh sách dịch vụ theo danh mục
 */

get_header();

// Get current term info
$term = get_queried_object();
$term_id = $term->term_id;
$term_name = $term->name;
$term_description = $term->description;

// Get ACF data from the associated page (dich-vu)
$page = get_page_by_path('dich-vu');
$page_id = $page ? $page->ID : 0;

// Get page settings
$page_title = get_field('page_title', $page_id) ?: __('Dịch vụ', 'canhcamtheme');
$page_description = get_field('page_description', $page_id);

// Get banner image from taxonomy or page
$banner_image = get_field('banner_image', 'danh-muc-dich-vu_' . $term_id);
if (!$banner_image) {
    $banner_image = get_field('banner_image', $page_id);
}
?>

<!-- Banner Section -->
<section class="page-banner-main">
    <div class="img img-ratio pt-[calc(640/1920*100rem)]">
        <?php if ($banner_image && is_array($banner_image)): ?>
            <img class="lozad" data-src="<?php echo esc_url($banner_image['url']); ?>" alt="<?php echo esc_attr($term_name); ?>" />
        <?php else: ?>
            <img class="lozad" data-src="<?php echo get_template_directory_uri(); ?>/img/banner-default.jpg" alt="<?php echo esc_attr($term_name); ?>" />
        <?php endif; ?>
    </div>
    <div class="content">
        <div class="global-breadcrumb">
            <div class="container">
                <?php 
                if (function_exists('rank_math_the_breadcrumbs')) {
                    rank_math_the_breadcrumbs();
                } else { ?>
                    <nav class="rank-math-breadcrumb" aria-label="breadcrumbs">
                        <p>
                            <a href="<?php echo home_url(); ?>"><?php _e('Trang chủ', 'canhcamtheme'); ?></a>
                            <span class="separator"> /</span>
                            <a href="<?php echo get_post_type_archive_link('dich-vu'); ?>"><?php echo esc_html($page_title); ?></a>
                            <span class="separator"> /</span>
                            <span class="last"><?php echo esc_html($term_name); ?></span>
                        </p>
                    </nav>
                <?php } ?>
                <div class="title-page heading-1 text-white font-bold mt-2"><?php echo esc_html($term_name); ?></div>
            </div>
        </div>
    </div>
</section>

<!-- Section: Services List -->
<section class="service section-py">
    <div class="container">
        <?php if ($term_description): ?>
            <div class="format-content body-1 text-center">
                <p><?php echo wp_kses_post($term_description); ?></p>
            </div>
        <?php endif; ?>

        <!-- Services Grid -->
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
                    <p><?php _e('Chưa có dịch vụ nào trong danh mục này.', 'canhcamtheme'); ?></p>
                </div>
            <?php endif; ?>
        </div>

        <!-- Pagination -->
        <?php micco_pagination(); ?>
    </div>
</section>

<?php get_footer(); ?>
