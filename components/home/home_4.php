<?php
$home_4_enable = get_field('home_4_enable');
if (!$home_4_enable) return;

$title = get_field('home_4_title');
$services = get_field('home_4_services');

if (!$services) return;
?>

<section class="home-4 section-py relative">
	<div class="container">
		<?php if ($title): ?>
			<h2 class="text-center block-title mb-base text-Primary-2"><?php echo $title; ?></h2>
		<?php endif; ?>
		
		<div class="slide relative" data-aos="fade-up" data-aos-duration="800" data-aos-delay="400">
			<div class="swiper">
				<div class="swiper-wrapper">
					<?php foreach ($services as $service): 
						$service_image = get_post_thumbnail_id($service->ID);
						$service_title = get_the_title($service->ID);
						$service_excerpt = get_the_excerpt($service->ID);
						$service_link = get_permalink($service->ID);
						$img = get_image_attrachment($service_image);
					?>
						<div class="swiper-slide">
							<div class="service-item">
								<div class="img img-ratio ratio:pt-[640_680] zoom-img rounded-5">
									<img class="lozad undefined" data-src="<?php echo $img; ?>" alt="<?php echo esc_attr($service_title); ?>" />
								</div>
								<div class="content flex flex-col justify-end text-white">
									<div class="title heading-3 font-bold">
										<a href="<?php echo $service_link; ?>"><?php echo $service_title; ?></a>
									</div>
									<div class="content-inner mt-5">
										<?php if ($service_excerpt): ?>
											<div class="desc body-1 font-normal mb-5">
												<p><?php echo $service_excerpt; ?></p>
											</div>
										<?php endif; ?>
										<a class="btn btn-more" href="<?php echo $service_link; ?>">
											<span>Xem chi tiết</span>
										</a>
									</div>
								</div>
							</div>
						</div>
					<?php endforeach; ?>
				</div>
			</div>
			<div class="scroll mt-base flex items-center rem:gap-[25px]">
				<div class="swiper-scrollbar"></div>
				<div class="indicator-swipe active">
					<img class="arrow" src="<?php echo get_template_directory_uri(); ?>/img/CaretLeft.svg" alt="">
					<img class="hand" src="<?php echo get_template_directory_uri(); ?>/img/Finger.svg" alt="">
					<img class="arrow" src="<?php echo get_template_directory_uri(); ?>/img/CaretRight.svg" alt="">
				</div>
			</div>
		</div>
	</div>
</section>
