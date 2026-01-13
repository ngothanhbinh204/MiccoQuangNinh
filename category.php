<?php get_header(); ?>

<?php
$term = get_queried_object();
$banner = get_field('banner', $term);
$background = $banner['background'];
$title = $banner['title'];
$description = $banner['description'];
?><?php get_template_part('modules/common/breadcrumb'); ?>
<div class="top-nav bg-white sticky-nav news-list-nav">
	<div class="container">
		<div class="zone-nav ">
			<ul class="gap-2">
				<?php
				$current_term_id = $term->term_id;
				$current_term_taxonomy = $term->taxonomy;

				// Check if the current term has children
				$child_terms = get_terms(array(
					'taxonomy' => $current_term_taxonomy,
					'parent' => $current_term_id,
					'hide_empty' => false,
				));

				// If no children, get siblings (terms with the same parent)
				if (empty($child_terms) || is_wp_error($child_terms)) {
					$parent_id = $term->parent;
					$terms_to_display = get_terms(array(
						'taxonomy' => $current_term_taxonomy,
						'parent' => $parent_id,
						'hide_empty' => false,
					));
				} else {
					$terms_to_display = $child_terms;
				}

				if (!empty($terms_to_display) && !is_wp_error($terms_to_display)) {
					foreach ($terms_to_display as $cat) {
						$active_class = ($cat->term_id == $current_term_id) ? 'active' : '';
						?>
						<li class="<?php echo $active_class; ?>">
							<a class="flex-center uppercase font-bold text-primary-1 py-3 px-5 transition hover:text-white hover:bg-primary-2"
								href="<?php echo get_term_link($cat); ?>">
								<?php echo $cat->name; ?>
							</a>
						</li>
						<?php
					}
				}
				?>
			</ul>
		</div>
	</div>
</div>
<!-- <section class="top-banner relative overflow-hidden">
	<div class="img-bg overflow-hidden max-lg:relative lg:absolute z-20 lg:right-0 lg:bottom-0">
		<a><?php echo get_image_attrachment($background, 'image'); ?></a></div>
	<div class="container relative z-50">
		<div class="row">
			<div class="col w-full lg:w-1/2">
				<div class="txt-wrap lg:pr-18 ">
					<?php get_template_part('modules/common/breadcrumb'); ?>
					<h2 class="heading-1-up pt-8 mb-6 lg:pt-12 max-lg:text-center">
						<?php echo $title ? $title : $term->name; ?></h2>

					<div class="zone-desc body-1">
						<?php echo $description ? $description : $term->description; ?>
					</div>
				</div>
			</div>
			<div class="col w-full lg:w-1/2"></div>
		</div>
	</div>
</section> -->
<section class="home-news news-list pad-8">
	<div class="container">


		<?php if (have_posts()): ?>
			<?php
			// Get the first post
			$first_post = $wp_query->posts[0];
			// Setup this post for WP functions
			setup_postdata($first_post);
			$url = get_field('lock_click') ? 'javascript:void(0)' : get_permalink();
			?>
			<div class="news-big text-white bg-primary-1 flex-start group" data-aos="fade-right"
				data-aos-easing="ease-in-out-back" data-aos-delay="0" data-aos-duration="900">
				<div class="img zoom-in overflow-hidden">
					<a href="<?php echo $url; ?>">
						<?php echo get_image_post(get_the_ID(), "image"); ?>
					</a>
				</div>
				<div class="txt col-left h-full p-6 lg:px-7">
					<time class="text-white mb-5"><?php the_date('d.m.Y'); ?></time>
					<div class="title pb-5 mb-5 border-b border-white border-opacity-20">
						<a href="<?php echo $url; ?>"
							class="text-lg uppercase font-bold line-clamp-3 group-hover:underline"><?php the_title(); ?>
						</a>
					</div>
					<div class="desc text-15 leading-140 scrollbar-wrap white"><?php the_excerpt(); ?></div>
				</div>
			</div>
			<?php wp_reset_postdata(); ?>
			<div class="row pt-10">
				<?php
				// Skip the first post since it's already displayed above
				$wp_query->current_post = 0; // Reset to the first post
				while (have_posts()):
					the_post();
					// Skip the first post
					if ($wp_query->current_post === 0) {
						continue;
					} ?>
					<div class="col w-full sm:w-1/2 md:w-1/3">
						<?php get_template_part('template-parts/posts/post-item'); ?>
					</div>
				<?php endwhile; ?>
			</div>
			<div class="pages">
				<div class="modulepager">
					<?php
					$big = 999999999; // need an unlikely integer
					echo paginate_links(array(
						'base' => str_replace($big, '%#%', esc_url(get_pagenum_link($big))),
						'format' => '?paged=%#%',
						'current' => max(1, get_query_var('paged')),
						'total' => $wp_query->max_num_pages,
						'prev_text' => '&laquo;',
						'next_text' => '&raquo;',
						'type' => 'list',
						'end_size' => 1,
						'mid_size' => 2,
						'prev_next' => false
					));
					?>
				</div>
			</div>
		<?php else: ?>
			<div class="no-posts-found text-center py-10">
				<h3><?php _e('No posts found', 'canhcamtheme'); ?></h3>
			</div>
		<?php endif; ?>
	</div>
</section>

<?php get_footer(); ?>