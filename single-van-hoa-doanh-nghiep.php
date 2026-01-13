<?php get_header(); ?>

<?php get_template_part('modules/common/breadcrumb'); ?>

<section class="culture-detail relative z-50 pad-b-8">
    <div class="container-fluid">
        <div class="row"> 
            <div class="col w-full lg:w-5/12">
                <div class="txt ml-auto max-lg:px-4  max-lg:py-10 rem:lg:max-w-[580px] rem:xl:max-w-[600px] rem:2xl:max-w-[520px] h-full col-left">
                    <h2 class="heading-1 mb-4 text-primary-1"><?php the_title(); ?></h2>
                    <time class="mb-9">01.5.2024</time>
                    <div class="scrollbar-wrap">
                        <div class="fullcontent">
                            <?php the_excerpt(); ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col w-full lg:w-6/12">
                <div class="img zoom-in overflow-hidden flex-center w-full">
                    <a class="overflow-hidden w-full img-ratio ratio:pt-[480_960]">
                        <?= get_image_post(get_the_ID(), "image"); ?>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="container pt-10 lg:pt-15 2xl:pt-20 overflow-hidden">
        <div class="w-full lg:w-10/12 xl:w-10/12 2xl:w-8/12 mx-auto relative block-wrap">
            <div class="fullcontent">
                <?php the_content(); ?>
            </div>
        </div>
    </div>
</section>
<section class="culture-other relative z-50 pad-8 bg-grey-50">
    <div class="container"> 
        <h2 class="heading-1 text-primary-1 text-center mb-10"><?php _e('Bài viết liên quan', 'canhcamtheme'); ?></h2>
        <?php 
        $args = array(
            'post_type' => 'van-hoa-doanh-nghiep',
            'posts_per_page' => 6,
            'post__not_in' => array(get_the_ID()),
            'orderby' => 'date',
            'order' => 'DESC',
        );
        $query = new WP_Query($args);
        if ($query->have_posts()) : ?>
            <div class="auto-3 init-swiper relative z-50">
                <div class="swiper max-lg:mb-10">
                    <div class="swiper-wrapper"> 
                        <?php
                            while ($query->have_posts()) {
                                $query->the_post();
                                ?>
                                <div class="swiper-slide"> 
                                    <div class="news-item h-full group">
                                        <div class="img zoom-in overflow-hidden">
                                            <a href="<?php the_permalink(); ?>" class="img-ratio ratio:pt-[248_440]"><?php echo get_image_post(get_the_ID(), "image"); ?></a></div>
                                        <div class="txt p-4 lg:pt-4 lg:pb-6">
                                            <time class="text-grey-950"><?php echo get_the_date('d.m.Y'); ?></time>
                                            <h3 class="mb-2 pb-2 border-b border-grey-100"><a href="<?php the_permalink(); ?>" class="uppercase flex-start font-bold title transition group-hover:text-primary-1"><?php the_title(); ?></a></h3>
                                            <div class="desc"><?php the_excerpt(); ?></div>
                                        </div>
                                    </div>
                                </div>
                                <?php
                            }
                            wp_reset_postdata();
                        ?>                
                    </div>
                </div>
                <div class="swiper-nav">
                    <div class="prev"> </div>
                    <div class="next"></div>
                </div>
            </div>
        <?php  endif; ?>
    </div>
</section>

<?php get_footer(); ?>