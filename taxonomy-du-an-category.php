<?php get_header(); ?>

<?php
$term = get_queried_object();
$banner = get_field('banner', $term);
$background = $banner['background'];
$title = $banner['title'];
$description = $banner['description'];
?>
<div class="top-nav bg-white sticky-nav project-list-nav">
	<div class="container">
		<div class="zone-nav">
			<ul class="gap-2">
				<?php
				// Get current term if we're on a taxonomy page
				$current_term_id = 0;
				$current_term = null;
				if (is_tax('du-an-category')) {
					$current_term = get_queried_object();
					$current_term_id = $current_term->term_id;
				}

				// Check if current term has a parent
				$parent_id = 0;
				if ($current_term && $current_term->parent) {
					// If current term has a parent, we'll show siblings (children of that parent)
					$parent_id = $current_term->parent;
					
					// Get children of the parent (siblings of current term)
					$sibling_terms = get_terms(array(
						'taxonomy' => 'du-an-category',
						'parent' => $parent_id,
						'hide_empty' => false,
					));
					
					foreach ($sibling_terms as $term) {
						$active_class = ($current_term_id == $term->term_id) ? 'active' : '';
						?>
						<li class="<?php echo $active_class; ?>">
							<a class="flex-center uppercase font-bold text-primary-1 py-3 px-5 transition hover:text-white hover:bg-primary-2"
								href="<?php echo get_term_link($term); ?>">
								<?php echo $term->name; ?>
							</a>
						</li>
						<?php
					}
				} else {
					// If current term is a parent or has no parent, check if it has children
					$child_terms = get_terms(array(
						'taxonomy' => 'du-an-category',
						'parent' => $current_term_id,
						'hide_empty' => false,
					));
					
					if (!empty($child_terms)) {
						// Show children of current term
						foreach ($child_terms as $child_term) {
							?>
							<li>
								<a class="flex-center uppercase font-bold text-primary-1 py-3 px-5 transition hover:text-white hover:bg-primary-2"
									href="<?php echo get_term_link($child_term); ?>">
									<?php echo $child_term->name; ?>
								</a>
							</li>
							<?php
						}
					} else {
						// If no children and no parent, show all top-level categories
						$parent_terms = get_terms(array(
							'taxonomy' => 'du-an-category',
							'parent' => 0,
							'hide_empty' => false,
						));
						
						foreach ($parent_terms as $parent_term) {
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
				}
				?>
			</ul>
		</div>
	</div>

</div>
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

                    <h2 class="heading-1-up pt-8 mb-6 lg:pt-12 max-lg:text-center"><?php echo $title ? $title : $term->name; ?></h2>
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
        <?php 
        // Get current term
        $term = get_queried_object();
        $highlight_projects = get_field('highlight_project', $term);
        $slider_limit = 3; // Default slider limit
        $posts_per_page = 6; // Number of posts per page
        
        // Get current page number
        $paged = get_query_var('paged') ? get_query_var('paged') : 1;
        
        // Initialize array to store post IDs to exclude
        $exclude_ids = array();
        
        // If we have highlight projects, exclude them from the main query
        if($highlight_projects && !empty($highlight_projects)) {
            foreach($highlight_projects as $highlight_post) {
                $exclude_ids[] = $highlight_post->ID;
            }
        } else {
            // If no highlight projects, get slider posts to exclude them from main query
            $slider_args = array(
                'post_type' => 'du-an',
                'posts_per_page' => $slider_limit,
                'fields' => 'ids',
                'tax_query' => array(
                    array(
                        'taxonomy' => 'du-an-category',
                        'field' => 'term_id',
                        'terms' => $term->term_id,
                    ),
                ),
            );
            $slider_query = new WP_Query($slider_args);
            $exclude_ids = $slider_query->posts;
            wp_reset_postdata();
        }
        
        // Create custom query arguments
        $args = array(
            'post_type' => 'du-an',
            'posts_per_page' => $posts_per_page,
            'paged' => $paged,
            'tax_query' => array(
                array(
                    'taxonomy' => 'du-an-category',
                    'field' => 'term_id',
                    'terms' => $term->term_id,
                ),
            ),
        );
        
        // Exclude highlighted or slider posts from the main query
        if(!empty($exclude_ids)) {
            $args['post__not_in'] = $exclude_ids;
        }
        
        // Run the custom query
        $custom_query = new WP_Query($args);
        
        // Count total posts for pagination
        $count_args = $args;
        $count_args['posts_per_page'] = -1;
        $count_args['fields'] = 'ids';
        $count_query = new WP_Query($count_args);
        $total_posts = count($count_query->posts);
        $total_pages = ceil($total_posts / $posts_per_page);
        
        // Check if we have posts or highlight projects
        if($custom_query->have_posts() || ($highlight_projects && !empty($highlight_projects))): ?>
            <?php 
            // If we have highlight projects, display them in the slider
            if($highlight_projects && !empty($highlight_projects)): ?>
                <div class="single init-swiper block-swiper">
                    <div class="swiper">
                        <div class="swiper-wrapper">
                        <?php
                        foreach($highlight_projects as $highlight_post):
                            // Setup post data
                            global $post;
                            $post = get_post($highlight_post->ID);
                            setup_postdata($post);
                            
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
                            <div class="swiper-slide">
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
                        endforeach;
                        wp_reset_postdata();
                        ?>
                        </div>
                    </div>
                    <div class="desktop-pagination mt-5 lg:hidden">
                        <div class="swiper-pagination"></div>
                    </div>
                </div>
            <?php else: ?>
                <?php 
                // If no highlight projects, use regular posts for slider
                // Re-query the slider posts (already got IDs earlier)
                $slider_display_args = array(
                    'post_type' => 'du-an',
                    'posts_per_page' => $slider_limit,
                    'post__in' => $exclude_ids,
                    'orderby' => 'post__in',
                );
                $slider_display_query = new WP_Query($slider_display_args);
                
                if($slider_display_query->have_posts()): ?>
                    <div class="single init-swiper block-swiper">
                        <div class="swiper">
                            <div class="swiper-wrapper">
                            <?php
                            while($slider_display_query->have_posts()): $slider_display_query->the_post();
                                
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
                                <div class="swiper-slide">
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
                            endwhile;
                            wp_reset_postdata();
                            ?>
                            </div>
                        </div>
                        <div class="desktop-pagination mt-5 lg:hidden">
                            <div class="swiper-pagination"></div>
                        </div>
                    </div>
                <?php endif; ?>
            <?php endif; ?>
            
            <div class="row pt-10">
                <?php 
                // Display posts from our custom query
                if($custom_query->have_posts()):
                    while($custom_query->have_posts()): $custom_query->the_post();
                        ?>
                        <div class="col w-full sm:w-1/2 md:w-1/3 mb-6">
                            <?php get_template_part('template-parts/du-an/du-an-item'); ?>
                        </div>
                        <?php
                    endwhile;
                    wp_reset_postdata();
                endif;
                ?>
            </div>
            
            <div class="pages">
                <div class="modulepager">
                    <?php 
                    // Get the term link for proper pagination base URL
                    $term_link = get_term_link($term);
                    if (is_wp_error($term_link)) {
                        $term_link = '';
                    }
                    
                    // Remove trailing slash for consistency
                    $term_link = untrailingslashit($term_link);
                    
                    // Get pagination base from rewrite rules
                    global $wp_rewrite;
                    $pagination_base = $wp_rewrite->pagination_base;
                    
                    // Build the pagination base URL
                    // Format: /term-slug/page/2/ or /term-slug/?paged=2
                    if ($wp_rewrite->using_permalinks()) {
                        // For permalinks: /du-an-category/term-slug/page/2/
                        $base = user_trailingslashit($term_link . '/' . $pagination_base . '/%#%/', 'paged');
                    } else {
                        // For non-permalinks: /du-an-category/term-slug/?paged=2
                        $base = add_query_arg('paged', '%#%', $term_link);
                    }
                    
                    $pagination = paginate_links(array(
                        'base' => $base,
                        'format' => '',
                        'current' => max(1, $paged),
                        'total' => $total_pages,
                        'prev_text' => '',
                        'next_text' => '',
                        'type' => 'list',
                        'mid_size' => 2,
                        'end_size' => 1,
                        'prev_next' => false
                    ));
                    
                    // Add active class to current page item
                    $pagination = preg_replace('/class="page-numbers current"/', 'class="page-numbers current active"', $pagination);
                    echo $pagination;
                    ?>
                </div>
            </div>
        <?php endif; ?>
        
    </div>
</section>

<?php get_footer(); ?>