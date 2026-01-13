<?php
/**
 * Banner Component - Reusable banner for pages
 * 
 * Usage: get_template_part('modules/common/banner');
 * 
 * Supports:
 * - Page banners (using banner_select_page relationship field)
 * - Taxonomy banners (using taxonomy term)
 * - Custom post type archives (using page slug)
 * - Single posts (using post featured image or parent page banner)
 * 
 * Banner Structure:
 * - Banner CPT has featured image as the banner image
 * - Pages link to Banner CPT via 'banner_select_page' (or 'Chọn banner hiển thị') field
 */

// Initialize variables
$banner_image = null;
$page_title = '';
$banner_post = null;

// Get current page/taxonomy info
$queried_object = get_queried_object();
$id_category = $queried_object->term_id ?? null;
$taxonomy = $queried_object->taxonomy ?? null;

// Determine the ACF field source and get banner
if ($id_category && $taxonomy) {
    // ===================
    // TAXONOMY PAGE
    // ===================
    $acf_id = $taxonomy . '_' . $id_category;
    $page_title = $queried_object->name;
    
    // Try to get banner from taxonomy term
    $banner_posts = get_field('banner_select_page', $acf_id);
    if ($banner_posts && is_array($banner_posts) && !empty($banner_posts)) {
        $banner_post = $banner_posts[0];
    } elseif ($banner_posts && is_object($banner_posts)) {
        $banner_post = $banner_posts;
    }
    
} elseif (is_post_type_archive()) {
    // ===================
    // ARCHIVE PAGE (CPT)
    // ===================
    $post_type = get_post_type();
    
    // Map post type to page slug
    $page_slug_map = array(
        'san-pham' => 'san-pham',
        'dich-vu' => 'dich-vu',
    );
    
    $page_slug = isset($page_slug_map[$post_type]) ? $page_slug_map[$post_type] : $post_type;
    $page = get_page_by_path($page_slug);
    
    if ($page) {
        $acf_id = $page->ID;
        
        // Get banner from page's banner_select_page field
        $banner_posts = get_field('banner_select_page', $acf_id);
        
        // Also try with the Vietnamese field name
        if (!$banner_posts) {
            $banner_posts = get_field('Chọn banner hiển thị', $acf_id);
        }
        
        if ($banner_posts && is_array($banner_posts) && !empty($banner_posts)) {
            $banner_post = $banner_posts[0];
        } elseif ($banner_posts && is_object($banner_posts)) {
            $banner_post = $banner_posts;
        }
        
        // Get page title
        $page_title = get_field('page_title', $acf_id) ?: get_the_title($page->ID);
    }
    
    // Fallback title
    if (!$page_title) {
        $page_title = get_the_archive_title();
    }
    
} elseif (is_singular()) {
    // ===================
    // SINGLE POST / CPT DETAIL
    // ===================
    $acf_id     = get_the_ID();
    $page_title = get_the_title();

    /**
     * PRIORITY 1:
     * banner_single (ACF image field on post)
     */
    $banner_single = get_field('banner_single', $acf_id);
    if ($banner_single) {
        if (is_array($banner_single)) {
            $banner_image = $banner_single;
        } elseif (is_numeric($banner_single)) {
            $banner_image = [
                'id'  => $banner_single,
                'url' => wp_get_attachment_image_url($banner_single, 'full'),
            ];
        } elseif (is_string($banner_single)) {
            $banner_image = $banner_single;
        }
    }

    /**
     * PRIORITY 2:
     * banner_select_page (Banner CPT relationship)
     * Chỉ chạy nếu KHÔNG có banner_single
     */
    if (!$banner_image) {
        $banner_posts = get_field('banner_select_page', $acf_id)
            ?: get_field('Chọn banner hiển thị', $acf_id);

        if ($banner_posts && is_array($banner_posts) && !empty($banner_posts)) {
            $banner_post = $banner_posts[0];
        } elseif ($banner_posts && is_object($banner_posts)) {
            $banner_post = $banner_posts;
        }
    }
    
} else {
    // ===================
    // DEFAULT
    // ===================
    $acf_id = get_the_ID();
    $page_title = get_the_title();
    
    $banner_posts = get_field('banner_select_page', $acf_id);
    if (!$banner_posts) {
        $banner_posts = get_field('Chọn banner hiển thị', $acf_id);
    }
    
    if ($banner_posts && is_array($banner_posts) && !empty($banner_posts)) {
        $banner_post = $banner_posts[0];
    } elseif ($banner_posts && is_object($banner_posts)) {
        $banner_post = $banner_posts;
    }
}

// ===================
// GET BANNER IMAGE FROM BANNER POST
// ===================
if ($banner_post) {
    // Banner post can be WP_Post object or ID
    $banner_id = is_object($banner_post) ? $banner_post->ID : $banner_post;
    
    // Get featured image from banner post
    if (has_post_thumbnail($banner_id)) {
        $banner_image_id = get_post_thumbnail_id($banner_id);
        $banner_image = array(
            'id' => $banner_image_id,
            'url' => wp_get_attachment_image_url($banner_image_id, 'full'),
        );
    }
    
    // Alternative: Try to get ACF field 'banner_image' from banner post
    if (!$banner_image) {
        $banner_image = get_field('banner_image', $banner_id);
    }
}

// ===================
// FALLBACK IMAGE
// ===================
if (!$banner_image) {
    $banner_image_url = get_template_directory_uri() . '/img/banner-default.jpg';
} else {
    if (is_array($banner_image) && isset($banner_image['url'])) {
        $banner_image_url = $banner_image['url'];
        $banner_image_id = $banner_image['id'] ?? null;
    } elseif (is_string($banner_image)) {
        $banner_image_url = $banner_image;
        $banner_image_id = null;
    } else {
        $banner_image_url = get_template_directory_uri() . '/img/banner-default.jpg';
        $banner_image_id = null;
    }
}
?>

<section class="page-banner-main">
    <div class="img img-ratio pt-[calc(640/1920*100rem)]">
        <?php if (isset($banner_image_id) && $banner_image_id): ?>
            <?php echo get_image_attrachment($banner_image_id, 'image'); ?>
        <?php else: ?>
            <img class="lozad" data-src="<?php echo esc_url($banner_image_url); ?>" alt="<?php echo esc_attr($page_title); ?>" />
        <?php endif; ?>
    </div>
    <div class="content">
        <div class="global-breadcrumb">
            <div class="container">
                <?php 
                // Display breadcrumb (Rank Math or default)
                if (function_exists('rank_math_the_breadcrumbs')) {
                    rank_math_the_breadcrumbs();
                } else {
                    // Fallback breadcrumb
                    ?>
                    <nav class="rank-math-breadcrumb" aria-label="breadcrumbs">
                        <p>
                            <a href="<?php echo home_url(); ?>"><?php _e('Trang chủ', 'canhcamtheme'); ?></a>
                            <span class="separator"> /</span>
                            <span class="last"><?php echo esc_html($page_title); ?></span>
                        </p>
                    </nav>
                    <?php
                }
                ?>
                <div class="title-page heading-1 text-white font-bold mt-2"><?php echo esc_html($page_title); ?></div>
            </div>
        </div>
    </div>
</section>