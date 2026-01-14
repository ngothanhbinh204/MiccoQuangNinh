<?php
/**
 * Taxonomy Template for Danh Mục Sản Phẩm (Product Category)
 * 
 * Hiển thị danh sách sản phẩm theo danh mục
 */

get_header();

// Get current term info
$term = get_queried_object();
$term_id = $term->term_id;
$term_name = $term->name;
$term_description = $term->description;

$page_id = 0;

$pages = get_pages([
    'meta_key'   => '_wp_page_template',
    'meta_value' => 'templates/template_san_pham.php',
    'number'     => 1,
]);

if (!empty($pages)) {
    $page_id = $pages[0]->ID;
}

$page_title = get_field('page_title', $page_id) ?: __('Sản phẩm', 'canhcamtheme');
$page_description = get_field('page_description', $page_id);
$intro_image = get_field('intro_image', $page_id);

// Get all product categories for sidebar
$product_categories = get_terms(array(
    'taxonomy' => 'danh-muc-san-pham',
    'hide_empty' => true,
    'parent' => 0,
));

// Get child categories of current term
$child_categories = get_terms(array(
    'taxonomy' => 'danh-muc-san-pham',
    'hide_empty' => true,
    'parent' => $term_id,
));
?>

<!-- Breadcrumb Section -->
<section class="global-breadcrumb">
    <div class="container">
        <?php if (function_exists('rank_math_the_breadcrumbs')): ?>

            <?php rank_math_the_breadcrumbs(); ?>

        <?php else: ?>

            <?php
            $products_page = get_page_by_template('templates/template_san_pham.php');
            $products_page_id = $products_page ? $products_page->ID : 0;
            var_dump($products_page_id);

            // WPML support
            if ($products_page_id && function_exists('icl_object_id')) {
                $products_page_id = icl_object_id($products_page_id, 'page', true);
            }
            ?>

            <nav class="rank-math-breadcrumb" aria-label="breadcrumbs">
                <p>
                    <a href="<?php echo esc_url(home_url('/')); ?>">
                        <?php _e('Trang chủ', 'canhcamtheme'); ?>
                    </a>

                    <?php if ($products_page_id): ?>
                        <span class="separator"> /</span>
                        <a href="<?php echo esc_url(get_permalink($products_page_id)); ?>">
                            <?php echo esc_html(get_the_title($products_page_id)); ?>
                        </a>
                    <?php endif; ?>

                    <?php if (!empty($term_name)): ?>
                        <span class="separator"> /</span>
                        <span class="last">
                            <?php echo esc_html($term_name); ?>
                        </span>
                    <?php endif; ?>
                </p>
            </nav>

        <?php endif; ?>
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
                                <p><?php echo wp_kses_post($page_description); ?></p>
                            </div>
                        <?php endif; ?>
                    </div>
                    <div class="block-right">
                        <?php 
                        // Get category thumbnail if available (ACF field on taxonomy)
                        $category_image = get_field('category_image', 'danh-muc-san-pham_' . $term_id);
                        if ($category_image): ?>
                            <div class="img img-ratio ratio:pt-[388_690] zoom-img rounded-4">
                                <?php echo get_image_attrachment($category_image['id']); ?>
                            </div>
                        <?php elseif ($intro_image): ?>
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
                                <?php foreach ($product_categories as $category): 
                                    $is_active = ($term_id === $category->term_id) || term_is_ancestor_of($category->term_id, $term_id, 'danh-muc-san-pham');
                                    $children = get_terms(array(
                                        'taxonomy' => 'danh-muc-san-pham',
                                        'hide_empty' => true,
                                        'parent' => $category->term_id,
                                    ));
                                ?>
                                    <li class="<?php echo $is_active ? 'active' : ''; ?>">
                                        <a href="<?php echo get_term_link($category); ?>"><?php echo esc_html($category->name); ?></a>
                                        <?php if ($children && !is_wp_error($children) && $is_active): ?>
                                            <ul class="sub-menu">
                                                <?php foreach ($children as $child): ?>
                                                    <li class="<?php echo ($term_id === $child->term_id) ? 'active' : ''; ?>">
                                                        <a href="<?php echo get_term_link($child); ?>"><?php echo esc_html($child->name); ?></a>
                                                    </li>
                                                <?php endforeach; ?>
                                            </ul>
                                        <?php endif; ?>
                                    </li>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </ul>
                    </div>
                    <div class="overlay-sidebar fixed inset-0 bg-black bg-opacity-50 z-40 hidden"></div>
                </div>

                <!-- Products Grid -->
                <div class="block-products">
                    <div class="content-products">
                        <h2><?php echo esc_html($term_name); ?></h2>
                        <?php if ($term_description): ?>
                            <div class="body-1">
                                <p><?php echo wp_kses_post($term_description); ?></p>
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
                                <p><?php _e('Chưa có sản phẩm nào trong danh mục này.', 'canhcamtheme'); ?></p>
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
