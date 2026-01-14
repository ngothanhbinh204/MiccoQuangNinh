<?php
/**
 * Single Template for Sản Phẩm (Product Detail)
 */

get_header();

// Get ACF fields for product
$gallery = get_field('product_gallery'); // Repeater: images for slider
$tabs = get_field('product_tabs'); // Repeater: tab title + content

// Get related products (same category)
$terms = wp_get_post_terms(get_the_ID(), 'danh-muc-san-pham');
$related_args = array(
	'post_type' => 'san-pham',
	'posts_per_page' => 8,
	'post__not_in' => array(get_the_ID()),
	'orderby' => 'rand',
);
if (!empty($terms) && !is_wp_error($terms)) {
	$related_args['tax_query'] = array(
		array(
			'taxonomy' => 'danh-muc-san-pham',
			'field' => 'term_id',
			'terms' => wp_list_pluck($terms, 'term_id'),
		),
	);
}
$related_products = new WP_Query($related_args);
?>

<!-- Breadcrumb Section -->
<section class="global-breadcrumb">
	<div class="container">
		<?php 
		if (function_exists('rank_math_the_breadcrumbs')) {
			rank_math_the_breadcrumbs();
		} else { ?>
			<nav class="rank-math-breadcrumb" aria-label="breadcrumbs">
				<p>
					<a href="<?php echo home_url(); ?>"><?php _e('Trang chủ', 'canhcamtheme'); ?></a>
					<span class="separator"> /</span>
					<a href="<?php echo get_post_type_archive_link('san-pham'); ?>"><?php _e('Sản phẩm', 'canhcamtheme'); ?></a>
					<span class="separator"> /</span>
					<span class="last"><?php the_title(); ?></span>
				</p>
			</nav>
		<?php } ?>
	</div>
</section>

<!-- Section 1: Product Gallery -->
<section class="section-ProductDetail-1">
	<div class="container">
		<div class="section-py">
			<div class="block-ProductDetail-1">
				<h1 class="heading-1 text-Primary-2 mb-base"><?php the_title(); ?></h1>
				
				<div class="product-detail-1">
					<!-- Main Swiper -->
					<div class="swiper swiper-main">
						<div class="swiper-wrapper">
							<?php if (!empty($gallery) && is_array($gallery)): ?>
								<?php foreach ($gallery as $image): 
									$image_url = is_array($image)
												? $image['url']
												: wp_get_attachment_url($image);
										?>
											<div class="swiper-slide">
												<a
													class="img img-ratio ratio:pt-[600_1400] -lg:ratio:pt-[70%] zoom-img rounded-4"
													href="<?php echo esc_url($image_url); ?>"
													data-fancybox="gallery"
												>
													<?php if (is_array($image)): ?>
														<img
															class="lozad"
															data-src="<?php echo esc_url($image['url']); ?>"
															alt="<?php echo esc_attr($image['alt'] ?: get_the_title()); ?>"
														/>
													<?php else: ?>
														<?php echo get_image_attrachment($image, 'image'); ?>
													<?php endif; ?>
												</a>
											</div>
										<?php endforeach; ?>

									<?php elseif (has_post_thumbnail()): ?>

										<div class="swiper-slide">
											<a
												class="img img-ratio ratio:pt-[600_1400] -lg:ratio:pt-[70%] zoom-img rounded-4"
												href="<?php echo esc_url(get_the_post_thumbnail_url(get_the_ID(), 'full')); ?>"
												data-fancybox="gallery"
											>
												<?php echo get_image_attrachment(get_post_thumbnail_id(), 'image'); ?>
											</a>
										</div>

									<?php endif; ?>

								</div>
							</div>


					<!-- Thumbs Swiper -->
					<?php if ($gallery && count($gallery) > 1): ?>
						<div class="thumbs-wrapper relative">
							<div class="swiper swiper-thumbs">
								<div class="swiper-wrapper">
									<?php foreach ($gallery as $image): ?>
									<div class="swiper-slide">
										<div class="img img-ratio ratio:pt-[112_200] rounded-4">
											<?php if (is_array($image)): ?>
												<img
													class="lozad"
													data-src="<?php echo esc_url($image['url']); ?>"
													alt="<?php echo esc_attr($image['alt'] ?: get_the_title()); ?>"
												/>
											<?php else: ?>
												<?php echo get_image_attrachment($image, 'image'); ?>
											<?php endif; ?>
										</div>
									</div>
								<?php endforeach; ?>
								</div>
							</div>
							<div class="wrap-button-slide">
								<div class="btn btn-prev btn-sw-1"></div>
								<div class="btn btn-next btn-sw-1"></div>
							</div>
						</div>
					<?php endif; ?>
				</div>
			</div>
		</div>
	</div>
</section>

<!-- Section 2: Product Tabs -->
<?php if ($tabs && is_array($tabs) && count($tabs) > 0): ?>
<section class="section-ProductDetail-2">
	<div class="product-detail-2-list">
		<div class="wrap" data-toggle="tabslet">
			<ul class="tabslet-tab">
				<?php foreach ($tabs as $index => $tab): ?>
					<li><a href="#Tab-<?php echo $index; ?>"><?php echo esc_html($tab['tab_title']); ?></a></li>
				<?php endforeach; ?>
			</ul>
			<div class="item-tablet">
				<div class="item-content">
					<div class="container">
						<?php foreach ($tabs as $index => $tab): ?>
							<div class="tabslet-content" id="Tab-<?php echo $index; ?>">
								<div class="format-content">
									<?php echo wp_kses_post($tab['tab_content']); ?>
								</div>
							</div>
						<?php endforeach; ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<?php elseif (get_the_content()): ?>
<section class="section-ProductDetail-2">
	<div class="product-detail-2-list">
		<div class="wrap" data-toggle="tabslet">
			<ul class="tabslet-tab">
				<li><a href="#Tab-0"><?php _e('Mô tả', 'canhcamtheme'); ?></a></li>
			</ul>
			<div class="item-tablet">
				<div class="item-content">
					<div class="container">
						<div class="tabslet-content" id="Tab-0">
							<div class="format-content">
								<?php the_content(); ?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<?php endif; ?>

<!-- Section 3: Related Products -->
<?php if ($related_products->have_posts()): ?>
<section class="section-ProductDetail-3">
	<div class="product-detail-3">
		<div class="container">
			<div class="section-py">
				<h2 class="heading-1 text-Primary-2 mb-base block text-center leading-[1.4] font-bold">
					<?php _e('Sản phẩm liên quan', 'canhcamtheme'); ?>
				</h2>
				<div class="swiper-column-auto auto-4-column swiper-loop autoplay">
					<div class="swiper">
						<div class="swiper-wrapper">
							<?php while ($related_products->have_posts()): $related_products->the_post(); ?>
								<div class="swiper-slide">
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
								</div>
							<?php endwhile; ?>
						</div>
					</div>
					<div class="wrap-button-slide">
						<div class="btn btn-prev btn-sw-1"></div>
						<div class="btn btn-next btn-sw-1"></div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<?php endif; wp_reset_postdata(); ?>

<?php get_footer(); ?>
