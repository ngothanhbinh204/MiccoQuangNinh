<?php
$home_5_enable = get_field('home_5_enable');
if (!$home_5_enable) return;

$title = get_field('home_5_title');
$categories = get_field('home_5_categories');
$posts_per_category = get_field('home_5_posts_per_category') ?: 5;
$button = get_field('home_5_button');

if (!$categories) return;
?>

<section class="home-5 section-py !pt-0 relative">
	<div class="container">
		<div class="wrap-tabslet" data-toggle="tabslet">
			<div class="wrap-heading text-center mb-base">
				<?php if ($title): ?>
					<h2 class="title text-Primary-2 mb-base block-title"><?php echo $title; ?></h2>
				<?php endif; ?>
				
				<ul class="tabslet-tab nav-primary" data-aos="fade-up" data-aos-duration="800" data-aos-delay="400">
					<?php 
					$first = true;
					foreach ($categories as $cat_id): 
						$category = get_category($cat_id);
						if (!$category) continue;
					?>
						<li <?php echo $first ? 'class="active"' : ''; ?>>
							<a href="#tab-<?php echo $cat_id; ?>"><?php echo $category->name; ?></a>
						</li>
					<?php 
						$first = false;
					endforeach; ?>
				</ul>
			</div>
			
			<?php 
			$first_tab = true;
			foreach ($categories as $cat_id): 
				$category = get_category($cat_id);
				if (!$category) continue;
				
				// Query posts for this category
				$args = array(
					'cat' => $cat_id,
					'posts_per_page' => $posts_per_category,
					'orderby' => 'date',
					'order' => 'DESC'
				);
				$query = new WP_Query($args);
				
				if (!$query->have_posts()) continue;
				
				$posts = $query->posts;
			?>
				<div class="tabslet-content <?php echo $first_tab ? 'active' : ''; ?>" id="tab-<?php echo $cat_id; ?>">
					<div class="home-5-list grid md:grid-cols-[3fr_6fr_3fr] grid-cols-1 gap-base">
						<!-- Left Column -->
						<div class="col-left flex flex-col rem:gap-[46px]" data-aos="fade-right" data-aos-duration="800">
							<?php 
							$left_posts = array_slice($posts, 0, 2);
							foreach ($left_posts as $post): 
								setup_postdata($post);
								$img = get_image_post($post->ID);
							?>
								<div class="news-item group">
									<div class="img">
										<a class="img-ratio ratio:pt-[240_320] rounded-5 zoom-img" href="<?php echo get_permalink($post->ID); ?>">
											<img class="lozad undefined" data-src="<?php echo $img; ?>" alt="<?php echo esc_attr(get_the_title($post->ID)); ?>" />
										</a>
									</div>
									<div class="content pt-5">
										<div class="top-content flex items-center gap-2 font-normal body-4">
											<div class="day text-Utility-gray-500"><?php echo get_the_date('d.m.Y', $post->ID); ?></div>
											<div class="category text-Primary-2"><?php echo $category->name; ?></div>
										</div>
										<h3 class="body-2 font-bold mt-2 group-hover:text-Primary-2">
											<a href="<?php echo get_permalink($post->ID); ?>"><?php echo get_the_title($post->ID); ?></a>
										</h3>
									</div>
								</div>
							<?php endforeach; ?>
						</div>
						
						<!-- Middle Column (Featured) -->
						<div class="col-mid" data-aos="fade-up" data-aos-duration="800" data-aos-delay="200">
							<?php 
							if (isset($posts[2])) {
								$post = $posts[2];
								setup_postdata($post);
								$img = get_image_post($post->ID);
							?>
								<div class="news-item group">
									<div class="img">
										<a class="img-ratio ratio:pt-[510_680] rounded-5 zoom-img" href="<?php echo get_permalink($post->ID); ?>">
											<img class="lozad undefined" data-src="<?php echo $img; ?>" alt="<?php echo esc_attr(get_the_title($post->ID)); ?>" />
										</a>
									</div>
									<div class="content py-6">
										<div class="top-content flex items-center gap-2 font-normal body-4">
											<div class="day text-Utility-gray-500"><?php echo get_the_date('d.m.Y', $post->ID); ?></div>
											<div class="category text-Primary-2"><?php echo $category->name; ?></div>
										</div>
										<h3 class="heading-3 font-bold mt-2 group-hover:text-Primary-2 line-clamp-3">
											<a href="<?php echo get_permalink($post->ID); ?>"><?php echo get_the_title($post->ID); ?></a>
										</h3>
										<div class="desc line-clamp-2 body-2 text-Utility-gray-800 mt-2">
											<p><?php echo get_the_excerpt($post->ID); ?></p>
										</div>
									</div>
								</div>
							<?php } ?>
						</div>
						
						<!-- Right Column -->
						<div class="col-right flex flex-col rem:gap-[46px]" data-aos="fade-left" data-aos-duration="800">
							<?php 
							$right_posts = array_slice($posts, 3, 2);
							foreach ($right_posts as $post): 
								setup_postdata($post);
								$post_image = get_post_thumbnail_id($post->ID);
								$img = get_image_attrachment($post_image);
							?>
								<div class="news-item group">
									<div class="img">
										<a class="img-ratio ratio:pt-[240_320] rounded-5 zoom-img" href="<?php echo get_permalink($post->ID); ?>">
											<img class="lozad undefined" data-src="<?php echo $img; ?>" alt="<?php echo esc_attr(get_the_title($post->ID)); ?>" />
										</a>
									</div>
									<div class="content pt-5">
										<div class="top-content flex items-center gap-2 font-normal body-4">
											<div class="day text-Utility-gray-500"><?php echo get_the_date('d.m.Y', $post->ID); ?></div>
											<div class="category text-Primary-2"><?php echo $category->name; ?></div>
										</div>
										<h3 class="body-2 font-bold mt-2 group-hover:text-Primary-2 line-clamp-2">
											<a href="<?php echo get_permalink($post->ID); ?>"><?php echo get_the_title($post->ID); ?></a>
										</h3>
									</div>
								</div>
							<?php endforeach; ?>
						</div>
					</div>
				</div>
			<?php 
				wp_reset_postdata();
				$first_tab = false;
			endforeach; ?>
		</div>
		
		<?php if ($button): ?>
			<div class="button-more flex-center mt-base" data-aos="fade-up" data-aos-duration="800" data-aos-delay="600">
				<a class="btn btn-primary" href="<?php echo $button['url']; ?>" target="<?php echo $button['target']; ?>">
					<span><?php echo $button['title']; ?></span>
				</a>
			</div>
		<?php endif; ?>
	</div>
</section>
