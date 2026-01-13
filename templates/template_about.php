<?php
/**
 * Template Name: Giới thiệu
 */
?>

<?php get_header(); ?>

<?php if (get_field('banner')): ?>
	<?php
	$banner = get_field('banner');
	$background = $banner['background'];
	$title = $banner['title'];
	$subtitle = $banner['subtitle'];
	$description = $banner['description'];
	$items = $banner['items'];
	?>
	<section class="about-1 overflow-hidden relative pad-8" id="section-block-1">
		<div class="img-bg overflow-hidden lg:absolute lg:right-0 lg:bottom-0">
			<a><?php echo get_image_attrachment($background, 'image'); ?></a>
		</div>
		<div class="container">
			<div class="row">
				<div class="col w-full lg:w-1/2">
					<div class="txt-wrap lg:pr-10">

						<?php get_template_part('modules/common/breadcrumb'); ?>

						<h2 class="heading-1-up pt-6"><?php echo $title; ?></h2>

						<?php if ($subtitle): ?>
							<h3 class="heading-4 text-primary-2 py-2 px-4 w-full border-l-2 border-primary-2 my-6">
								<?php echo $subtitle; ?>
							</h3>
						<?php endif; ?>

						<?php if ($description): ?>
							<div class="zone-desc body-1 mb-7 lg:mb-10">
								<?php echo $description; ?>
							</div>
						<?php endif; ?>

						<?php if ($items): ?>
							<div class="grid gap-6 grid-cols-2 lg:gap-y-10">
								<?php foreach ($items as $item): ?>
									<div class="item max-sm:col-center max-sm:gap-2 max-sm:text-center sm:flex-start">
										<div
											class="icon w-[64px] h-[64px] min-w-[64px] flex-center 2xl:min-w-16 2xl:w-16 2xl:h-16 overflow-hidden rounded-full p-4 bg-grey-100">
											<?php echo get_image_attrachment($item['icon'], 'image'); ?>
										</div>
										<div class="txt ml-6">
											<div class="counter text-primary-1 heading-1 mb-2"><?php echo $item['counter']; ?></div>
											<div class="desc body-4"><?php echo $item['description']; ?></div>
										</div>
									</div>
								<?php endforeach; ?>
							</div>
						<?php endif; ?>
					</div>
				</div>
				<div class="col w-full lg:w-1/2"></div>
			</div>
		</div>
	</section>
<?php endif; ?>

<?php if (get_field('message')): ?>
	<?php
	$message = get_field('message');
	$image = $message['image'];
	$title = $message['title'];
	$description = $message['description'];
	$name = $message['name'];
	$position = $message['position'];
	?>
	<section class="about-2 overflow-hidden relative pt-15 max-lg:pb-20" id="section-block-2">
		<div class="container relative z-50">
			<div class="row no-gutter relative z-50">
				<div class="col w-full lg:w-5/12 relative">
					<div class="img overflow-hidden img-contain lg:absolute-x lg:-bottom-1 w-full h-full">
						<?php echo get_image_attrachment($image, 'image'); ?>
					</div>
				</div>
				<div class="col w-full lg:w-7/12">
					<div class="block-wrap pt-10 lg:pb-25">
						<h2 class="heading-1-up mb-10"><?php echo $title; ?></h2>
						<div class="quotes-txt relative">
							<div class="bg-wrap overflow-hidden rounded-7 p-10 relative">
								<div class="heading-4 mb-3 relative z-50"><?php echo $description['title']; ?></div>
								<div class="desc fullcontent relative z-50">
									<?php echo $description['content']; ?>
								</div>
							</div>
							<div class="info mt-10 relative">
								<div
									class="name text-6xl font-normal text-primary-1 relative z-100 text-right leading-140 sm:text-7xl">
									<?php echo $name; ?>
								</div>
								<div class="title body-4 font-bold text-primary-1 relative z-50 text-right mt-2">
									<?php echo $position; ?>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
<?php endif; ?>

<?php if (get_field('history')): ?>
	<?php
	$history = get_field('history');
	$title = $history['title'];
	$items = $history['items'];
	?>
	<section class="about-3 overflow-hidden relative pad-8" id="section-block-3">
		<div class="container">
			<h2 class="heading-1-up mb-10 text-center"><?php echo $title; ?></h2>
			<?php if ($items): ?>
				<div class="history-swiper relative">
					<div class="swiper">
						<div class="swiper-wrapper">
							<?php foreach ($items as $item): ?>
								<div class="swiper-slide">
									<div class="item">
										<div class="txt">
											<div class="year heading-2 text-grey-500"><?php echo $item['year']; ?></div>
											<div class="desc body-3"><?php echo $item['description']; ?></div>
										</div>
										<div class="img zoom-in">
											<a class="overflow-hidden rounded-3">
												<?php echo get_image_attrachment($item['image'], 'image'); ?>
											</a>
										</div>
									</div>
								</div>
							<?php endforeach; ?>
						</div>
					</div>
					<div class="swiper-nav">
						<div class="prev"> </div>
						<div class="next"></div>
					</div>
				</div>
			<?php endif; ?>
		</div>
	</section>
<?php endif; ?>

<?php if (get_field('vision_mison_core')): ?>
	<?php
	$vision_mison_core = get_field('vision_mison_core');
	$background = $vision_mison_core['background'];
	$title = $vision_mison_core['title'];
	$items = $vision_mison_core['items'];
	?>
	<section class="about-4 overflow-hidden relative pad-8" id="section-block-4"
		setBackground="<?php echo get_image_attrachment($background, 'url'); ?>">
		<div class="container">
			<h2 class="heading-1-up mb-10 text-center"><?php echo $title; ?></h2>
			<?php if ($items): ?>
				<div class="auto-3 init-swiper medium-gap-24">
					<div class="swiper">
						<div class="swiper-wrapper">
							<?php foreach ($items as $index => $item): ?>
								<div class="swiper-slide">
									<div class="item group cursor-pointer" data-fancybox="about-modal-1"
										href="#about-modal-<?php echo $index + 1; ?>">
										<div class="img zoom-in overflow-hidden">
											<div class="img-ratio ratio:pt-[300_450]">
												<?php echo get_image_attrachment($item['image'], 'image'); ?>
											</div>
										</div>
										<div class="txt p-6 text-center">
											<h3 class="heading-2 uppercase text-primary-1 group-hover:underline">
												<?php echo $item['title']; ?>
											</h3>
											<div class="desc my-4 line-clamp-2 body-1"><?php echo $item['description']; ?></div>

										</div>
										<div class="popup-modal about-modal hidden" id="about-modal-<?php echo $index + 1; ?>">
											<div class="popup-modal-wrap">
												<div class="row">
													<div class="col w-full md:w-1/2">
														<div class="img-wrap zoom-in overflow-hidden">
															<a>
																<?php echo get_image_attrachment($item['image'], 'image'); ?>
															</a>
														</div>
													</div>
													<div class="col w-full md:w-1/2">
														<div class="txt-wrap p-10 lg:px-16">
															<h2 class="heading-1-up text-primary-1 mb-6">
																<?php echo $item['content_title']; ?>
															</h2>
															<div class="scrollbar-wrap">
																<div class="desc fullcontent">
																	<?php echo $item['content']; ?>
																</div>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							<?php endforeach; ?>
						</div>
					</div>
				</div>
			<?php endif; ?>
		</div>
	</section>
<?php endif; ?>

<?php if (get_field('organization')): ?>
	<?php
	$organization = get_field('organization');
	$title = $organization['title'];
	$image = $organization['image'];
	?>
	<section class="about-5 overflow-hidden relative pad-8" id="section-block-5">
		<div class="container">
			<h2 class="heading-1-up mb-10 text-center"><?php echo $title; ?></h2>
			<div class="img  overflow-hidden img-contain">
				<a class="img-ratio ratio:pt-[605_1400]" data-fancybox=""
					href="<?php echo get_image_attrachment($image, 'url'); ?>">
					<?php echo get_image_attrachment($image, 'image'); ?>
				</a>
			</div>
		</div>
	</section>
<?php endif; ?>

<?php if (get_field('management')): ?>
	<?php
	$management = get_field('management');
	$background = $management['background'];
	$title = $management['title'];
	$description = $management['description'];
	$first_item = $management['first_item'];
	$staff_slides = $management['staff_slides'];
	?>
	<section class="about-6 overflow-hidden relative pad-8"
		setBackground="<?php echo get_image_attrachment($background, 'url'); ?>" id="section-block-6">
		<div class="container">
			<h2 class="heading-1-up mb-4 text-center text-white"><?php echo $title; ?></h2>
			<?php if ($description): ?>
				<div class="zone-desc body-1 text-white text-opacity-50 text-center mx-auto mb-10 lg:w-10/12">
					<?php echo $description; ?>
				</div>
			<?php endif; ?>
			<?php if ($first_item): ?>
				<div class="block-wrap">
					<div class="w-full sm:w-1/4 mx-auto">
						<div class="profile-item">
							<div class="img overflow-hidden"><a class="shine relative">
									<?php echo get_image_attrachment($first_item['image'], 'image'); ?>
								</a></div>
							<div class="txt pt-4 text-white">
								<div class="name flex-center"><span
										class="text-lg inline-block mr-2"><?php echo $first_item['title']; ?></span><strong
										class="uppercase text-lg"><?php echo $first_item['name']; ?></strong></div>
								<div class="title body-3 text-center mt-1 uppercase text-opacity-80">
									<?php echo $first_item['position']; ?>
								</div>
							</div>
						</div>
					</div>
				</div>
			<?php endif; ?>
			<?php if ($staff_slides): ?>
				<?php foreach ($staff_slides as $staff_slide): ?>
					<div class="block-wrap pt-10 relative">
						<div class="auto-center-swiper relative" slide-amount="4">
							<div class="swiper">
								<div class="swiper-wrapper">
									<?php foreach ($staff_slide['slide_items'] as $index => $slide): ?>
										<div class="swiper-slide">
											<div class="profile-item">
												<div class="img overflow-hidden">
													<a class="shine relative">
														<?php echo get_image_attrachment($slide['image'], 'image'); ?>
													</a>
												</div>
												<div class="txt pt-4 text-white">
													<div class="name flex-center"><span
															class="text-lg inline-block mr-2"><?php echo $slide['title']; ?></span><strong
															class="uppercase text-lg"><?php echo $slide['name']; ?></strong></div>
													<div class="title body-3 text-center mt-1 uppercase text-opacity-80">
														<?php echo $slide['position']; ?>
													</div>
												</div>
											</div>
										</div>
									<?php endforeach; ?>
								</div>
							</div>
							<div class="swiper-nav">
								<div class="prev"> </div>
								<div class="next"></div>
							</div>
						</div>
					</div>
				<?php endforeach; ?>
			<?php endif; ?>
		</div>
	</section>
<?php endif; ?>

<?php if (get_field('certification')): ?>
	<?php
	$certification = get_field('certification');
	$title = $certification['title'];
	$items = $certification['items'];
	?>
	<section class="about-7 overflow-hidden relative pad-8 " id="section-block-7">
		<div class="container">
			<h2 class="heading-1-up text-center max-lg:mb-10"><?php echo $title; ?></h2>
			<?php if ($items): ?>
				<div class="large-center-swiper">
					<div class="swiper">
						<div class="swiper-wrapper">
							<?php foreach ($items as $index => $item): ?>
								<div class="swiper-slide">
									<div class="item">
										<div class="wrap">
											<div class="box">
												<div class="img">
													<a>
														<?php echo get_image_attrachment($item['image'], 'image'); ?>
													</a>
												</div>
												<div class="txt pt-4 text-center">
													<h3 class="headline heading-4"><?php echo $item['title']; ?></h3>
													<?php if ($item['description']): ?>
														<div class="body-1"><?php echo $item['description']; ?></div>
													<?php endif; ?>
												</div>
											</div>
										</div>
									</div>
								</div>
							<?php endforeach; ?>

						</div>
					</div>
					<div class="swiper-nav">
						<div class="prev"> </div>
						<div class="next"></div>
					</div>
				</div>
			<?php endif; ?>
		</div>
	</section>
<?php endif; ?>

<?php get_footer(); ?>