<?php
$home_6_enable = get_field('home_6_enable');
if (!$home_6_enable) return;

$background_image = get_field('home_6_background_image');
$title = get_field('home_6_title');
$content = get_field('home_6_content');
$button = get_field('home_6_button');
?>

<section class="home-6 section-py" <?php if ($background_image): ?>setBackground="<?php echo get_image_attrachment($background_image, 'url'); ?>"<?php endif; ?>>
	<div class="container">
		<div class="wrap-content rem:max-w-[656px] w-full">
			<?php if ($title): ?>
				<div class="title" data-aos="fade-right" data-aos-duration="800" data-aos-delay="200">
					<?php echo $title; ?>
				</div>
			<?php endif; ?>
			
			<?php if ($content): ?>
				<div class="format-content space-y-6 body-1 font-normal" data-aos="fade-right" data-aos-duration="800" data-aos-delay="400">
					<?php echo $content; ?>
				</div>
			<?php endif; ?>
			
			<?php if ($button): ?>
				<div class="button-more mt-base" data-aos="fade-right" data-aos-duration="800" data-aos-delay="600">
					<a class="btn btn-primary" href="<?php echo $button['url']; ?>" target="<?php echo $button['target']; ?>">
						<span><?php echo $button['title']; ?></span>
					</a>
				</div>
			<?php endif; ?>
		</div>
	</div>
</section>
