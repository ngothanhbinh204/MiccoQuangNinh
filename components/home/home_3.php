<?php
$home_3_enable = get_field('home_3_enable');
if (!$home_3_enable) return;

$background_image = get_field('home_3_background_image');
$title = get_field('home_3_title');
$products = get_field('home_3_products');

if (!$products) return;
?>

<section class="home-3 section-py" <?php if ($background_image): ?>setBackground="<?php echo get_image_attrachment($background_image, 'url'); ?>"<?php endif; ?>>
	<div class="container">
		<?php if ($title): ?>
			<h2 class="title text-center block-title mb-base text-white"><?php echo $title; ?></h2>
		<?php endif; ?>
		
		<div class="swiper-column-auto relative">
			<div class="swiper">
				<div class="swiper-wrapper">
					<?php 
					$delay = 0;
					foreach ($products as $product): 
						$product_image = get_post_thumbnail_id($product->ID);
						$product_title = get_the_title($product->ID);
						$product_link = get_permalink($product->ID);
						$img = get_image_attrachment($product_image);
					?>
						<div class="swiper-slide">
							<div class="item relative group rem:h-[520px] overflow-hidden" data-aos="fade-up" data-aos-duration="800" data-aos-delay="<?php echo $delay; ?>">
								<div class="image-wrapper relative rem:h-[404px] group-hover:rem:h-[330px] transition-all duration-500 ease-in-out overflow-hidden rounded-lg">
									<a class="block h-full" href="<?php echo $product_link; ?>">
										<img class="w-full h-full object-cover object-bottom transition-all duration-300" src="<?php echo get_image_post($product->ID, 'url'); ?>" alt="<?php echo esc_attr($product_title); ?>">
									</a>
								</div>
								<div class="content text-center lg:px-2 lg:py-5 py-3 relative wrap-item-height">
									<h3 class="text-xl font-bold">
										<a href="<?php echo $product_link; ?>"><?php echo $product_title; ?></a>
									</h3>
									<div class="desc">
										<a class="btn btn-primary" href="<?php echo $product_link; ?>">
											<span>Chi tiết</span>
											<div class="icon"></div>
										</a>
									</div>
								</div>
							</div>
						</div>
					<?php 
						$delay += 200;
					endforeach; ?>
				</div>
			</div>
			<div class="wrap-button-slide">
				<div class="btn btn-sw-1 btn-prev white"></div>
				<div class="btn btn-sw-1 btn-next white"></div>
			</div>
		</div>
	</div>
</section>
