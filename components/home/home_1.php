<?php
$home_1_enable = get_field('home_1_enable');
if (!$home_1_enable) return;

$slides = get_field('home_1_slides');
if (!$slides) return;
?>

<section class="home-1">
	<div class="slide relative">
		<div class="swiper">
			<div class="swiper-wrapper">
				<?php foreach ($slides as $slide): 
					$image = $slide['image'];
					$title = $slide['title'];
					$link = $slide['link'];
					$img = get_image_attrachment($image);
				?>
					<div class="swiper-slide">
						<div class="home-1-banner relative">
							<?php if ($link): ?>
								<a class="img-ratio ratio:pt-[880_1920]" href="<?php echo $link['url']; ?>" target="<?php echo $link['target']; ?>">
									<img class="lozad undefined" data-src="<?php echo $img; ?>" alt="<?php echo esc_attr($image['alt']); ?>" />
								</a>
							<?php else: ?>
								<div class="img-ratio ratio:pt-[880_1920]">
									<img class="lozad undefined" data-src="<?php echo $img; ?>" alt="<?php echo esc_attr($image['alt']); ?>" />
								</div>
							<?php endif; ?>
							<?php if ($title): ?>
								<div class="home-1-content text-center">
									<div class="title heading-1 block-title text-white font-bold"><?php echo $title; ?></div>
								</div>
							<?php endif; ?>
						</div>
					</div>
				<?php endforeach; ?>
			</div>
		</div>
		<div class="arrow-button flex-center gap-4">
			<div class="btn btn-sw-1 btn-prev white"></div>
			<div class="btn btn-sw-1 btn-next white"></div>
		</div>
	</div>
</section>
