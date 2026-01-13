<?php
/**
 * Template Name: Năng lực chi tiết
 */
?>

<?php get_header(); ?>

<?php get_template_part('modules/common/breadcrumb'); ?>

<section class="news-detail relative z-50 pad-8">
    <div class="container"> 
        <h2 class="heading-1 mb-5"><?php the_title(); ?></h2>
        <time class="relative z-50 mb-10"><?php the_date('d.m.Y'); ?></time>
        <?php if(has_post_thumbnail()): ?>
            <div class="single-swiper init-swiper mb-10">
                <div class="swiper">
                    <div class="swiper-wrapper">
                        <div class="swiper-slide">
                            <div class="img zoom-in overflow-hidden">
                                <a class="img-ratio ratio:pt-[788_1400]">
                                    <?= get_image_post(get_the_ID(),"image"); ?>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>
        <div class="w-full lg:w-10/12 xl:w-9/12 mx-auto">
            <!-- <div class="briefcontent font-bold body-1 border-t border-grey-200 py-5">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</div> -->
            <div class="fullcontent">
                <?php the_content(); ?>
            </div>
        </div>
    </div>
</section>

<?php
    // Get current page's parent ID
    $parent_id = wp_get_post_parent_id(get_the_ID());
    
    // If no parent, use current page ID as parent to find siblings
    if (!$parent_id) {
        $parent_id = get_the_ID();
    }
    
    // Find pages with the same parent
    $args = array(
        'post_type'      => 'page',
        'posts_per_page' => 5,
        'post_status'    => 'publish',
        'post_parent'    => $parent_id,
        'post__not_in'   => array(get_the_ID()), // Exclude current page
        'orderby'        => 'date',
        'order'          => 'DESC',
    );
    
    $related_pages = new WP_Query($args);

    if ($related_pages->have_posts()) :
?>
<section class="news-other relative z-50 pad-8 bg-grey-50">
    <div class="container"> 
        <h2 class="heading-1 text-primary-1 text-center mb-10"><?php _e('Bài viết liên quan', 'canhcamtheme'); ?></h2>
        <div class="auto-3 init-swiper relative z-50">
            <div class="swiper max-lg:mb-10">
                <div class="swiper-wrapper"> 
                    <?php while ($related_pages->have_posts()) : $related_pages->the_post(); ?>
                    <div class="swiper-slide">
                        <?php get_template_part('template-parts/posts/post-item'); ?>
                    </div>
                    <?php 
                    endwhile;
                    wp_reset_postdata(); ?>
                </div>
            </div>
            <div class="swiper-nav">
                <div class="prev"> </div>
                <div class="next"></div>
            </div>
        </div>
    </div>
</section>
<?php endif; ?>

<?php get_footer(); ?>