<?php
/**
 * Archive Template for Sản Phẩm (Products)
 * 
 * Lấy dữ liệu ACF từ Page có slug 'san-pham'
 * Sử dụng WordPress main query để hiển thị danh sách sản phẩm
 */

get_header();

// Get ACF data from the associated page
$page_id = 0;

$pages = get_pages([
    'meta_key'   => '_wp_page_template',
    'meta_value' => 'templates/template_san_pham.php',
    'number'     => 1,
]);

if (!empty($pages)) {
    $page_id = $pages[0]->ID;
}

// Get ACF fields
$page_title = get_field('page_title', $page_id) ?: __('Sản phẩm', 'canhcamtheme');
$page_description = get_field('page_description', $page_id);
$intro_image = get_field('intro_image', $page_id);

// Get all product categories
$product_categories = get_terms(array(
    'taxonomy' => 'danh-muc-san-pham',
    'hide_empty' => true,
    'parent' => 0,
));

// Current category filter
$current_cat = get_query_var('danh-muc-san-pham') ?: '';
?>

<!-- Breadcrumb Section -->
<section class="global-breadcrumb">
    <div class="container">
        <?php 
        if (function_exists('rank_math_the_breadcrumbs')) {
            rank_math_the_breadcrumbs();
        } else { ?>
            <nav class="rank-math-breadcrumb" aria-label="breadcrumbs">
                <p>
                    <a href="<?php echo home_url(); ?>"><?php _e('Trang chủ', 'canhcamtheme'); ?></a>
                    <span class="separator"> /</span>
                    <span class="last"><?php echo esc_html($page_title); ?></span>
                </p>
            </nav>
        <?php } ?>
    </div>
</section>

<!-- Section 1: Hero Section -->
<section class="section-ProductList-1">
    <div class="bg-ProductList-1">
        <div class="container">
            <div class="section-py">
                <div class="block-ProductList-1">
                    <div class="block-left">
                        <h1 class="heading-1 text-Primary-2 leading-[1.4] font-bold"><?php echo esc_html($page_title); ?></h1>
                        <?php if ($page_description): ?>
                            <div class="content-product">
                                <?php echo wp_kses_post($page_description); ?>
                            </div>
                        <?php endif; ?>
                    </div>
                    <div class="block-right">
                        <?php if ($intro_image): ?>
                            <div class="img img-ratio ratio:pt-[388_690] zoom-img rounded-4">
                                <?php echo get_image_attrachment($intro_image['id']); ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Section 2: Product List with Sidebar -->
<section class="section-ProductList-2">
    <div class="container">
        <div class="section-py">
            <div class="block-ProductList-2">
                <!-- Mobile Filter Button -->
                <div class="filter-product lg:hidden mb-6 sticky rem:top-[calc(var(--header-height))] left-2 z-50">
                    <div class="btn-filter inline-flex items-center gap-2 border border-Utility-gray-200 rounded-1 px-4 py-2 cursor-pointer bg-white border-Primary-1">
                        <span class="text-Primary-1 font-bold"><?php _e('Danh mục sản phẩm', 'canhcamtheme'); ?></span>
                        <i class="fa-regular fa-filter text-Primary-1"></i>
                    </div>
                </div>

                <!-- Sidebar -->
                <div class="block-side-bar-sticky">
                    <div class="block-side-bar">
                        <div class="close-sidebar lg:hidden absolute top-2 right-4 cursor-pointer">
                            <i class="fa-solid fa-xmark text-2xl text-Primary-1"></i>
                        </div>
                        <ul>
                            <?php if ($product_categories && !is_wp_error($product_categories)): ?>
                                <?php foreach ($product_categories as $category): ?>
                                    <li class="<?php echo ($current_cat === $category->slug) ? 'active' : ''; ?>">
                                        <a href="<?php echo get_term_link($category); ?>"><?php echo esc_html($category->name); ?></a>
                                    </li>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </ul>
                    </div>
                    <div class="overlay-sidebar fixed inset-0 bg-black bg-opacity-50 z-40 hidden"></div>
                </div>

                <!-- Products Grid -->
                <div class="block-products">
                    <?php 
                    // Get first category info for display
                    $first_category = !empty($product_categories) ? $product_categories[0] : null;
                    $category_title = $first_category ? $first_category->name : $page_title;
                    $category_desc = $first_category ? $first_category->description : $page_description;
                    ?>
                    
                    <div class="content-products">
                        <h2><?php echo esc_html($category_title); ?></h2>
                        <?php if ($category_desc): ?>
                            <div class="body-1">
                                <?php echo wp_kses_post($category_desc); ?>
                            </div>
                        <?php endif; ?>
                    </div>

                    <div class="block-card-products">
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
                            <div class="no-products">
                                <p><?php _e('Chưa có sản phẩm nào.', 'canhcamtheme'); ?></p>
                            </div>
                        <?php endif; ?>
                    </div>

                    <!-- Pagination -->
                    <?php micco_pagination(); ?>
                </div>
            </div>
        </div>
    </div>
</section>

<?php get_footer(); ?>
