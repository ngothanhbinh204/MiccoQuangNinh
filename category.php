<?php
/**
 * Category Template
 */
get_header();

// Banner Section
get_template_part('modules/common/banner'); 

// Get current category
$current_term = get_queried_object();
$current_term_id = $current_term->term_id;
$parent_term_id = $current_term->parent;

// ✅ Xác định category gốc hiện tại
if ($parent_term_id != 0) {
    // Đang ở category con → tìm category cha gốc
    $current_root_id = $parent_term_id;
    $temp_cat = get_category($parent_term_id);
    while ($temp_cat->parent != 0) {
        $current_root_id = $temp_cat->parent;
        $temp_cat = get_category($current_root_id);
    }
} else {
    // Đang ở category gốc
    $current_root_id = $current_term_id;
}

// ✅ Lấy TẤT CẢ danh mục gốc (parent = 0)
$root_categories = get_categories(array(
    'parent' => 0,
    'hide_empty' => false,
    'orderby' => 'name',
    'order' => 'ASC',
));

// ✅ Build danh sách tab để hiển thị
$tabs_to_display = array();

foreach ($root_categories as $root_cat) {
    // Kiểm tra category gốc có danh mục con không
    $children = get_categories(array(
        'parent' => $root_cat->term_id,
        'hide_empty' => false,
        'orderby' => 'name',
        'order' => 'ASC',
    ));
    
    $has_children = !empty($children);
    
    // ✅ FIX: Nếu category có con, luôn hiển thị "Tất cả" + các con
    if ($has_children) {
        // Thêm tab "Tất cả" (đại diện cho category cha)
        $tabs_to_display[] = array(
            'id' => $root_cat->term_id,
            'name' => __('Tất cả', 'canhcamtheme'),
            'url' => get_category_link($root_cat->term_id),
            'is_active' => ($current_root_id == $root_cat->term_id && $current_term_id == $root_cat->term_id),
        );
        
        // Thêm các danh mục con
        foreach ($children as $child) {
            $tabs_to_display[] = array(
                'id' => $child->term_id,
                'name' => $child->name,
                'url' => get_category_link($child->term_id),
                'is_active' => ($current_term_id == $child->term_id),
            );
        }
    } else {
        // Danh mục gốc không có con - hiển thị bình thường
        $tabs_to_display[] = array(
            'id' => $root_cat->term_id,
            'name' => $root_cat->name,
            'url' => get_category_link($root_cat->term_id),
            'is_active' => ($current_term_id == $root_cat->term_id),
        );
    }
}
?>

<section class="section-news section-py">
    <div class="container">
        <div class="news flex flex-col gap-base">
            
            <!-- Category Filter -->
            <div class="news-heading-and-tab flex-center flex-wrap gap-4">
                <ul class="nav-primary">
                    <?php foreach ($tabs_to_display as $tab): ?>
                    <li class="<?php echo $tab['is_active'] ? 'active' : ''; ?>">
                        <a href="<?php echo esc_url($tab['url']); ?>">
                            <?php echo esc_html($tab['name']); ?>
                        </a>
                    </li>
                    <?php endforeach; ?>
                </ul>
            </div>

            <?php if (have_posts()): ?>
                <?php 
                $count = 0;
                ob_start(); 
                ?>
                
                <ul class="list-news grid grid-cols-2 md:grid-cols-3 gap-base">
                <?php while (have_posts()) : the_post(); $count++; ?>
                    
                    <?php if ($count === 1): 
                        $feat_title = get_the_title();
                        $feat_link = get_permalink();
                        $feat_date = get_the_date('d/m/Y');
                        $feat_excerpt = get_the_excerpt();
                        $feat_img = get_the_post_thumbnail(get_the_ID(), 'full', array('class' => 'lozad')); 
                        if (!$feat_img) {
                             $feat_img = '<img class="lozad" data-src="'.get_template_directory_uri().'/img/placeholder.jpg" alt="'.esc_attr($feat_title).'">';
                        }
                        $feat_img_id = get_post_thumbnail_id();
                        
                        continue;
                    endif; 
                    ?>

                    <!-- Grid Items (2nd onwards) -->
                    <div class="news-item group">
                        <div class="img">
                            <a class="img-ratio ratio:pt-[293_440] rounded-4 zoom-img" href="<?php the_permalink(); ?>">
                                <?php if (has_post_thumbnail()): ?>
                                    <?php echo get_image_post(get_the_ID()); ?>
                                <?php else: ?>
                                     <img class="lozad" data-src="<?php echo get_template_directory_uri(); ?>/img/placeholder.jpg" alt="<?php the_title_attribute(); ?>">
                                <?php endif; ?>
                            </a>
                        </div>
                        <div class="content py-6">
                            <div class="top-content flex items-center gap-2 font-normal body-4">
                                <div class="day"><?php echo get_the_date('d.m.Y'); ?></div>
                                <?php 
                                    $cats = get_the_category();
                                    if ($cats) :
                                        $cat_name = $cats[0]->name;
                                        echo '<div class="category text-Primary-1">'.esc_html($cat_name).'</div>';
                                    endif;
                                ?>
                            </div>
                            <h3 class="heading-6 font-semibold my-2 group-hover:text-Primary-2">
                                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                            </h3>
                            <div class="desc line-clamp-2">
                                <p><?php echo wp_trim_words(get_the_excerpt(), 20); ?></p>
                            </div>
                        </div>
                    </div>

                <?php endwhile; ?>
                </ul>
                <?php 
                $grid_html = ob_get_clean(); 
                ?>

                <!-- 1. Render Featured Post -->
                <?php if ($count > 0): ?>
                <div class="tab-news-item flex -lg:flex-col items-stretch rounded-5 overflow-hidden">
                    <div class="img-thumb w-full lg:shrink-0 lg:w-[calc(1184/1600*100%)]">
                        <a class="img-ratio ratio:pt-[652_1184]" href="<?php echo esc_url($feat_link); ?>">
                            <?php 
                            if (isset($feat_img_id) && $feat_img_id) {
                                echo get_image_attrachment($feat_img_id, 'image'); 
                            } else {
                                echo $feat_img;
                            }
                            ?>
                        </a>
                    </div>
                    <div class="block-info flex flex-col justify-center p-10 bg-Primary-1">
                        <span class="date body-4 text-white"><?php echo esc_html($feat_date); ?></span>
                        <h3 class="title heading-3 mt-2 text-white -xl:line-clamp-3 line-clamp-4"><?php echo esc_html($feat_title); ?></h3>
                        <div class="desc body-1 mt-6 text-white -xl:line-clamp-4 line-clamp-7">
                            <?php echo $feat_excerpt; ?>
                        </div>
                        <a class="inline-block body-1 text-Primary-1 mt-10" href="<?php echo esc_url($feat_link); ?>"><?php _e('Xem chi tiết', 'canhcamtheme'); ?></a>
                    </div>
                </div>
                <?php endif; ?>

                <!-- 2. Render Grid List -->
                <?php echo $grid_html; ?>

                <!-- 3. Pagination -->
                <div class="pagination flex-center">
                    <?php if (function_exists('micco_pagination')) { micco_pagination(); } ?>
                </div>

            <?php else: ?>
                <div class="text-center py-10"><?php _e('Không có bài viết nào.', 'canhcamtheme'); ?></div>
            <?php endif; ?>
        </div>
    </div>
</section>

<?php get_footer(); ?>