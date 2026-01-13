<?php
/**
 * Single Post Template
 */
get_header();

// Breadcrumb Section is in the body of single.php usually, or part of header. 
// In the HTML it's a section 'global-breadcrumb' inside main.
?>

<main>
    <section class="global-breadcrumb">
        <div class="container">
            <?php 
            if (function_exists('rank_math_the_breadcrumbs')) {
                rank_math_the_breadcrumbs();
            } else {
                ?>
                <nav class="rank-math-breadcrumb" aria-label="breadcrumbs">
                    <p>
                        <a href="<?php echo home_url(); ?>"><?php _e('Trang chủ', 'canhcamtheme'); ?></a>
                        <span class="separator"> /</span>
                        <span class="last"><?php the_title(); ?></span>
                    </p>
                </nav>
                <?php
            }
            ?>
        </div>
    </section>

    <?php while (have_posts()) : the_post(); ?>
    <section class="news-detail section-py">
        <div class="container">
            <h1 class="heading-2 font-extrabold mb-6"><?php the_title(); ?></h1>
            <time class="body-4 mb-base text-Utility-gray-500 font-normal"><?php echo get_the_date('d-m-Y'); ?></time>
            
            <!-- Gallery / Featured Image Swiper -->
            <div class="swiper-column-auto mt-base">
                <div class="swiper">
                    <div class="swiper-wrapper">
                        <?php 
                        // Check for ACF Gallery if available (assuming field name 'news_gallery')
                        // OR just use Featured Image if no gallery
                        // Since we didn't define a specific JSON for single post, let's look for standard WP gallery or Featured Image
                        if (has_post_thumbnail()) {
                            $thumb_id = get_post_thumbnail_id();
                            echo '<div class="swiper-slide">';
                            echo '<div class="img">';
                            echo '<a class="img-ratio ratio:pt-[788_1400] rounded-5 zoom-img" href="'.get_the_post_thumbnail_url(get_the_ID(), 'full').'" data-fancybox="gallery">';
                            echo get_image_attrachment($thumb_id, 'image'); 
                            echo '</a>';
                            echo '</div>';
                            echo '</div>';
                        }
                        ?>
                    </div>
                </div>
            </div>

            <div class="wrap-content rem:max-w-[1050px] w-full mx-auto mt-base">
                <div class="format-content font-normal">
                    <?php the_content(); ?>
                </div>
            </div>
        </div>
    </section>
    <?php endwhile; ?>

    <!-- Related Posts -->
    <?php
    $categories = get_the_category();
    if ($categories) {
        $category_ids = array();
        foreach ($categories as $individual_category) {
            $category_ids[] = $individual_category->term_id;
        }

        $args = array(
            'category__in' => $category_ids,
            'post__not_in' => array(get_the_ID()),
            'posts_per_page' => -1,
            'ignore_sticky_posts' => 1
        );

        $related_query = new WP_Query($args);

        if ($related_query->have_posts()) :
    ?>
    <section class="news-other section-py bg-Utility-gray-50">
        <div class="container">
            <h2 class="title heading-2 font-bold text-Primary-2 mb-base text-center"><?php _e('Bài viết liên quan', 'canhcamtheme'); ?></h2>
            <div class="swiper-column-auto relative swiper-loop autoplay">
                <div class="swiper">
                    <div class="swiper-wrapper">
                        <?php while ($related_query->have_posts()) : $related_query->the_post(); ?>
                        <div class="swiper-slide">
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
                                            // Show primary category
                                            $cats = get_the_category();
                                            if ($cats) {
                                                echo '<div class="category text-Primary-1">'.esc_html($cats[0]->name).'</div>';
                                            }
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
                        </div>
                        <?php endwhile; ?>
                    </div>
                </div>
                <!-- Navigation Buttons -->
                <div class="wrap-button-slide"> 
                    <div class="btn btn-sw-1 btn-prev"></div>
                    <div class="btn btn-sw-1 btn-next"></div>
                </div>
            </div>
        </div>
    </section>
    <?php 
        endif; 
        wp_reset_postdata();
    }
    ?>

</main>

<?php get_footer(); ?>