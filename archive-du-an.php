<?php get_header(); ?>

<?php
$banner = get_field('banner_du_an','option');
$background = $banner['background'];
$title = $banner['title'];
$description = $banner['description'];
?>
<section class="top-banner relative overflow-hidden">
    <div class="img-bg overflow-hidden max-lg:relative lg:absolute z-20 lg:right-0 lg:bottom-0">
        <a>
            <?php echo get_image_attrachment($background, 'image'); ?>
        </a>
    </div>
    <div class="container relative z-50">
        <div class="row"> 
            <div class="col w-full lg:w-1/2">
                <div class="txt-wrap lg:pr-18 ">

                    <?php get_template_part('modules/common/breadcrumb'); ?>

                    <h2 class="heading-1-up pt-8 mb-6 lg:pt-12 max-lg:text-center"><?php echo $title ? $title : __('Dự án', 'canhcamtheme'); ?></h2>
                    <?php if($description): ?>
                        <div class="zone-desc body-1">
                            <?php echo $description; ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
            <div class="col w-full lg:w-1/2"></div>
        </div>
    </div>
</section>


<section class="project-list relative overflow-hidden pad-8">
    <div class="container relative z-50">
        <div class="zone-nav mb-10 lg:mb-15 2xl:mb-20"> 
            <ul class="gap-2">
                <?php
                // Get all parent categories
                $parent_terms = get_terms(array(
                    'taxonomy' => 'du-an-category',
                    'parent' => 0,
                    'hide_empty' => false,
                ));
                
                // Get current term if we're on a taxonomy page
                $current_term_id = 0;
                if (is_tax('du-an-category')) {
                    $current_term = get_queried_object();
                    $current_term_id = $current_term->term_id;
                }
                
                foreach ($parent_terms as $parent_term) {
                    // Check if this parent term has children
                    $child_terms = get_terms(array(
                        'taxonomy' => 'du-an-category',
                        'parent' => $parent_term->term_id,
                        'hide_empty' => false,
                    ));
                    
                    // If it has children, display them
                    if (!empty($child_terms)) {
                        foreach ($child_terms as $child_term) {
                            $active_class = ($current_term_id == $child_term->term_id) ? 'active' : '';
                            ?>
                            <li class="<?php echo $active_class; ?>">
                                <a class="flex-center uppercase font-bold text-primary-1 py-3 px-5 transition hover:text-white hover:bg-primary-2" 
                                   href="<?php echo get_term_link($child_term); ?>">
                                    <?php echo $child_term->name; ?>
                                </a>
                            </li>
                            <?php
                        }
                    } else {
                        // If no children, display the parent
                        $active_class = ($current_term_id == $parent_term->term_id) ? 'active' : '';
                        ?>
                        <li class="<?php echo $active_class; ?>">
                            <a class="flex-center uppercase font-bold text-primary-1 py-3 px-5 transition hover:text-white hover:bg-primary-2" 
                               href="<?php echo get_term_link($parent_term); ?>">
                                <?php echo $parent_term->name; ?>
                            </a>
                        </li>
                        <?php
                    }
                }
                ?>
            </ul>
        </div>
        <?php if(have_posts()): ?>
            <?php 
            // Store posts for later use
            $posts_array = array();
            $featured_posts = array(); // Track posts used in the slider
            $count = 0;
            ?>
            <div class="single init-swiper block-swiper">
                <div class="swiper">
                    <div class="swiper-wrapper">
                    <?php
                    while(have_posts()): the_post();
                        $posts_array[] = get_the_ID();
                        $count++;
                        
                        // Only get the first 4 posts for the slider
                        if($count <= 4):
                            // Add this post ID to featured posts array
                            $featured_posts[] = get_the_ID();
                            
                            // If it's the first post, add it to the slider
                            ?>

                            <div class="swiper-slide">
                                <?php 
                                // Get post data
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
                                <div class="row item bg-grey-10">
                                    <div class="col w-full lg:w-4/12">
                                        <div class="txt p-8 lg:py-10">
                                            <div class="title text-primary-2 text-base mb-3"><?php echo $bid_package['name']; ?></div>
                                            <h3 class="mb-6"><a href="<?php the_permalink(); ?>" class="heading-2 text-primary-1 hover:underline line-clamp-4"><?php the_title(); ?></a></h3>
                                            <div class="scrollbar-wrap">
                                                <div class="list">
                                                    <ul>
                                                        <?php if($investor): ?>
                                                            <li class="y-start">
                                                                <div class="icon w-[24px] h-[24px] min-w-[24px] lg:w-6 lg:min-w-6 lg:h-6">
                                                                    <i class="fa-light fa-user"></i>
                                                                </div>
                                                                <div class="text-wrap ml-3">
                                                                    <div class="body-3 font-bold mb-1"><?php _e('Chủ đầu tư:', 'canhcamtheme'); ?></div>
                                                                    <div class="body-3"><?php echo $investor; ?></div>
                                                                </div>
                                                            </li>
                                                        <?php endif; ?>
                                                        <?php if($contract_value): ?>
                                                            <li class="y-start">
                                                                <div class="icon w-[24px] h-[24px] min-w-[24px] lg:w-6 lg:min-w-6 lg:h-6">
                                                                    <i class="fa-light fa-money-bill"></i>
                                                                </div>
                                                                <div class="text-wrap ml-3">
                                                                    <div class="body-3 font-bold mb-1"><?php _e('Giá trị hợp đồng:', 'canhcamtheme'); ?></div>
                                                                    <div class="body-3"><?php echo $contract_value; ?></div>
                                                                </div>
                                                            </li>
                                                        <?php endif; ?>
                                                        <?php if($end_date): ?>
                                                            <li class="y-start">
                                                                <div class="icon w-[24px] h-[24px] min-w-[24px] lg:w-6 lg:min-w-6 lg:h-6">
                                                                    <i class="fa-light fa-clock"></i>
                                                                </div>
                                                                <div class="text-wrap ml-3">
                                                                    <div class="body-3 font-bold mb-1"><?php _e('Ngày hoàn thành:', 'canhcamtheme'); ?></div>
                                                                    <div class="body-3"><?php echo $end_date; ?></div>
                                                                </div>
                                                            </li>
                                                        <?php endif; ?>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="btn-wrap pt-6">
                                                <a href="<?php the_permalink(); ?>" class="btn btn-primary">
                                                    <span><?php _e('Xem thêm', 'canhcamtheme'); ?></span>
                                                    <em class="fa-regular fa-plus"></em>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col w-full lg:w-8/12">
                                        <div class="img zoom-in overflow-hidden">
                                            <a href="<?php the_permalink(); ?>" class="img-ratio ratio:pt-[506_920]">
                                                <?php echo get_image_post(get_the_ID(), 'image'); ?>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                                        
                            <?php 
                        endif;
                    endwhile; 
                    ?>
                    </div>
                </div>
                <div class="desktop-pagination mt-5 lg:hidden">
                    <div class="swiper-pagination"></div>
                </div>
            </div>
            <div class="row pt-10">
                <?php 
                // Reset post data
                wp_reset_postdata();
                
                // Display posts in the row, excluding those already shown in the slider
                foreach($posts_array as $post_id):
                    // Skip posts that were featured in the slider
                    if(!in_array($post_id, $featured_posts)):
                        // Setup this post
                        setup_postdata(get_post($post_id));
                        ?>
                        <div class="col w-full sm:w-1/2 md:w-1/3 mb-6">
                            <?php get_template_part('template-parts/du-an/du-an-item'); ?>
                        </div>
                        <?php
                    endif;
                endforeach;
                wp_reset_postdata();
                ?>
            </div>
            
            <div class="pages">
                <div class="modulepager">
                    <?php the_posts_pagination(array(
                        'mid_size' => 2,
                        'prev_text' => __('Previous', 'canhcamtheme'),
                        'next_text' => __('Next', 'canhcamtheme'),
                        'screen_reader_text' => ' ',
                    )); ?>
                </div>
            </div>
        <?php endif; ?>
        
    </div>
</section>

<?php get_footer(); ?>