<?php
/**
 * Template Name: Trang chủ
 */
?>

<?php get_header(); ?>

<div id="fullpage">

	<?php
	if (have_rows('home_sections')):
		// Loop through rows.
		while (have_rows('home_sections')):
			the_row();

			get_template_part('components/home/' . get_row_layout());

		endwhile;

	endif;
	?>


	<?php
	$footer = get_field('footer', 'option');
	$title = $footer['title'];
	$address_infomation = $footer['address_infomation'];
	$contact = $footer['contact'];
	$socials = $footer['socials'];
	$copyright = $footer['copyright'];
	$image = $footer['image'];
	?>
	<section class="footer relative overflow-hidden text-white pad-8 section-blue nav-white">
		<div class="img-wrap zoom-in overflow-hidden absolute bottom-0 right-4 z-100" data-aos="fade-left"
			data-aos-easing="ease-in-out-back" data-aos-delay="0" data-aos-duration="700"><a><img
					src="<?= $image['url']; ?>" alt="<?= $image['alt']; ?>"></a></div>
		<div class="container relative z-50">
			<div class="row">
				<div class="col w-full lg:w-5/12">
					<h2 class="heading-1-up uppercase mb-7 text-white lg:mb-11" data-aos="fade-down"
						data-aos-easing="ease-in-out-back" data-aos-delay="0" data-aos-duration="700"><?= $title; ?>
					</h2>
					<div class="network">
						<ol data-aos="fade-up" data-aos-easing="ease-in-out-back" data-aos-delay="200"
							data-aos-duration="700">
							<?php foreach ($address_infomation as $item): ?>
								<li class="mb-6">
									<div class="item">
										<div class="title mb-2 flex-start"><em class="fa-regular fa-location-dot"></em>
											<div class="heading-5 uppercase"><?= $item['name']; ?></div>
										</div>
										<div class="text body-1">
											<?= $item['address']; ?>
										</div>
									</div>
								</li>
							<?php endforeach; ?>
						</ol>
					</div>
					<h4 class="heading-5 contact-title uppercase mb-4" data-aos="fade-up"
						data-aos-easing="ease-in-out-back" data-aos-delay="400" data-aos-duration="700">
						<?= $contact['title']; ?></h4>
					<address class="not-italic" data-aos="fade-up" data-aos-easing="ease-in-out-back"
						data-aos-delay="600" data-aos-duration="700">
						<ul>
							<?php foreach ($contact['infor'] as $item): ?>
								<li>
									<div class="label mr-2"><?= $item['label']; ?></div>
									<div class="txt">
										<?= $item['text']; ?>
									</div>
								</li>
							<?php endforeach; ?>
						</ul>
					</address>
					<div class="social py-6 lg:py-8" data-aos="fade-up" data-aos-easing="ease-in-out-back"
						data-aos-delay="600" data-aos-duration="800">
						<div class="wrap flex-center  lg:flex-start rem:gap-[10px]">
							<?php foreach ($socials as $item): ?>
								<a href="<?= $item['link']; ?>" target="_blank"> <em class="fa-brands fa-<?= $item['icon']; ?>"></em></a>
							<?php endforeach; ?>
						</div>
					</div>
					<div class="copyright body-1 text-white text-opacity-50 max-lg:text-center" data-aos="fade-right"
						data-aos-easing="ease-in-out-back" data-aos-delay="0" data-aos-duration="700">
						<?= $copyright; ?>
					</div>
				</div>
			</div>
		</div>
	</section>

</div>
<?php if (have_rows('home_sections')): ?>
	<ul id="menu-parallax">
		<?php
		$section_count = 0;
		while (have_rows('home_sections')):
			the_row();
			$section_count++;
			$row_index = get_row_index();
			$formatted_row_index = ($row_index < 10) ? '0' . $row_index : $row_index;
			?>
			<li data-menuanchor="<?= get_row_layout(); ?>"><a href="#<?= get_row_layout(); ?>"><span
						class="number"><?= $formatted_row_index; ?></span><span
						class="txt"><?= get_sub_field('anchor_text'); ?></span></a></li>
		<?php endwhile; ?>
		<li data-menuanchor="footer"><a href="#footer"><span
					class="number"><?= ($section_count + 1 < 10) ? '0' . ($section_count + 1) : $section_count + 1; ?></span><span
					class="txt"><?php _e('Liên hệ', 'canhcamtheme'); ?></span></a></li>
	</ul>
<?php endif; ?>




<?php get_footer(); ?>