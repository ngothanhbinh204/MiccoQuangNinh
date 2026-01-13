<?php get_header(); ?>

<?php get_template_part('modules/common/breadcrumb'); ?>

<?php
$short_title = get_field('short_title');
$gallery = get_field('gallery');
$project_information = get_field('project_information');
$location = $project_information['location'];
$bid_package = $project_information['bid_package'];
$investor = $project_information['investor'];
$contract_value = $project_information['contract_value'];
$start_date = $project_information['start_date'];
$end_date = $project_information['end_date'];
?>

<section class="project-detail pad-8">
    <div class="container">
        <div class="title text-primary-2 text-base"><?php echo $bid_package['name'] ?>: <?php echo $bid_package['description']; ?></div>
        <h2 class="heading-1 text-primary-1 my-6"><?php the_title(); ?></h2>
        <div class="product-main">
            <div class="swiper">
                <div class="swiper-wrapper">
                    <div class="swiper-slide">
                        <div class="img zoom-in overflow-hidden">
                            <a class="img-ratio ratio:pt-[768_1400]">
                                <?php echo get_image_post(get_the_ID(), 'image'); ?>
                            </a>
                        </div>
                    </div>
                    <?php foreach($gallery as $image): ?>
                        <div class="swiper-slide">
                            <div class="img zoom-in overflow-hidden">
                                <a class="img-ratio ratio:pt-[768_1400]">
                                    <?php echo get_image_attrachment($image, 'image'); ?>
                                </a>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
        <div class="product-thumb relative mt-6 mb-8 lg:mb-12">
            <div class="swiper">
                <div class="swiper-wrapper">
                    <div class="swiper-slide"> 
                        <div class="img zoom-in overflow-hidden  border-2 border-transparent">
                            <a>
                                <?php echo get_image_post(get_the_ID(), 'image'); ?>
                            </a>
                        </div>
                    </div>
                    <?php foreach($gallery as $image): ?>
                        <div class="swiper-slide"> 
                            <div class="img zoom-in overflow-hidden  border-2 border-transparent">
                                <a>
                                    <?php echo get_image_attrachment($image, 'image'); ?>
                                </a>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
            <div class="swiper-nav">
                <div class="prev"> </div>
                <div class="next"></div>
            </div>
        </div>
        <div class="row row-order-detail"> 
            <div class="col w-full lg:w-8/12">
                <div class="fullcontent">
                    <?php the_content(); ?>
                </div>
            </div>
            <div class="col w-full lg:w-4/12">
                <div class="bg-wrap p-8 bg-primary-1 text-white">
                    <h3 class="heading-2 mb-2"><?php _e('Tổng quan dự án', 'canhcamtheme'); ?></h3>
                    <ul class="text-base">
                        <li class="py-5 border-b border-white border-opacity-20 last:border-0">
                            <p><span class="block mb-2"><?php _e('Chủ đầu tư:', 'canhcamtheme'); ?></span><strong><?php echo $investor; ?></strong></p>
                        </li>
                        <li class="py-5 border-b border-white border-opacity-20 last:border-0">
                            <p><span class="block mb-2"><?php _e('Giá trị hợp đồng:', 'canhcamtheme'); ?></span><strong><?php echo $contract_value; ?></strong></p>
                        </li>
                        <li class="py-5 border-b border-white border-opacity-20 last:border-0">
                            <p><span class="block mb-2"><?php _e('Ngày khởi công:', 'canhcamtheme'); ?></span><strong><?php echo $start_date; ?></strong></p>
                        </li>
                        <li class="py-5 border-b border-white border-opacity-20 last:border-0">
                            <p><span class="block mb-2"><?php _e('Ngày hoàn thành:', 'canhcamtheme'); ?></span><strong><?php echo $end_date; ?></strong></p>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="project-other overflow-hidden pad-8 bg-grey-50">
    <div class="container"> 
        <h2 class="heading-1 text-center mb-10"><?php _e('Dự án liên quan', 'canhcamtheme'); ?></h2>
        <div class="auto-3 init-swiper relative">
            <div class="swiper max-lg:mb-7">
                <div class="swiper-wrapper">
                    <?php
                    // Get current post categories/terms
                    $current_post_id = get_the_ID();
                    $project_terms = wp_get_post_terms($current_post_id, 'du-an-category', array('fields' => 'ids'));
                    
                    // Set up arguments for related projects query
                    $args = array(
                        'post_type' => 'du-an',
                        'posts_per_page' => 5,
                        'post__not_in' => array($current_post_id),
                        'orderby' => 'date',
                        'order' => 'DESC'
                    );
                    
                    // If we have categories, use them to find related projects
                    if (!empty($project_terms) && !is_wp_error($project_terms)) {
                        $args['tax_query'] = array(
                            array(
                                'taxonomy' => 'du-an-category',
                                'field' => 'id',
                                'terms' => $project_terms
                            )
                        );
                    }
                    
                    $query = new WP_Query($args);
                    if($query->have_posts()):
                        while($query->have_posts()):
                            $query->the_post();
                            ?>
                            <div class="swiper-slide">
                                <?php get_template_part('template-parts/du-an/du-an-item'); ?>
                            </div>
                        <?php endwhile; ?>
                        <?php wp_reset_postdata(); ?>
                    <?php endif; ?>
                </div>
            </div>
            <div class="swiper-nav">
                <div class="prev"> </div>
                <div class="next"></div>
            </div>
        </div>
    </div>
</section>

<?php get_footer(); ?>