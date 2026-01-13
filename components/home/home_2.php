<?php
$home_2_enable = get_field('home_2_enable');
if (!$home_2_enable) return;

$title = get_field('home_2_title');
$content = get_field('home_2_content');
$button = get_field('home_2_button');
$stats = get_field('home_2_stats');
?>

<section class="home-2 section-py">
	<div class="container">
		<div class="wrap-heading rem:max-w-[920px] w-full mx-auto">
			<?php if ($title): ?>
				<h2 class="title text-center mb-base block-title"><?php echo $title; ?></h2>
			<?php endif; ?>
			
			<?php if ($content): ?>
				<div class="format-content body-1 text-center" data-aos="fade-up" data-aos-duration="800" data-aos-delay="400">
					<?php echo $content; ?>
				</div>
			<?php endif; ?>
			
			<?php if ($button): ?>
				<div class="button-more flex-center mt-base" data-aos="fade-up" data-aos-duration="800" data-aos-delay="600">
					<a class="btn btn-primary" href="<?php echo $button['url']; ?>" target="<?php echo $button['target']; ?>">
						<span><?php echo $button['title']; ?></span>
					</a>
				</div>
			<?php endif; ?>
		</div>
		
		<?php if ($stats): ?>
			<div class="wrap-list grid lg:grid-cols-4 md:grid-cols-3 grid-cols-2 md:gap-base gap-3 rem:max-w-[1144px] w-full mx-auto mt-base">
				<?php 
				$delay = 0;
				foreach ($stats as $stat): 
					$icon = $stat['icon'];
					$number = $stat['number'];
					$suffix = $stat['suffix'];
					$stat_title = $stat['title'];
					$img = get_image_attrachment($icon, 'url');
				?>
					<div class="item" data-aos="fade-up" data-aos-duration="800" data-aos-delay="<?php echo $delay; ?>">
						<?php if ($icon): ?>
							<div class="circle img-ratio">
								<img src="<?php echo $img; ?>" alt="<?php echo esc_attr($icon['alt']); ?>">
							</div>
						<?php endif; ?>
						<div class="content">
							<?php if ($number): ?>
								<div class="number countup" data-number="<?php echo $number; ?>">
									<span class="count-value"></span>
									<?php if ($suffix): ?>
										<span class="suffix"><?php echo $suffix; ?></span>
									<?php endif; ?>
								</div>
							<?php endif; ?>
							<?php if ($stat_title): ?>
								<div class="title body-2 text-Primary-2 font-normal"><?php echo $stat_title; ?></div>
							<?php endif; ?>
						</div>
					</div>
				<?php 
					$delay += 200;
				endforeach; ?>
			</div>
		<?php endif; ?>
	</div>
</section>
