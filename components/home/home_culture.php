<?php
$title = get_sub_field('title');
$button = get_sub_field('button');
$items = get_sub_field('items');
?>
<section class="home-culture overflow-hidden bg-secondary-bg">
	<div class="container">
		<div class="title-wrap md:flex-between mb-10">
			<?php if ($title): ?>
				<h2 class="heading-1-up max-md:text-center " data-aos="fade-right" data-aos-easing="ease-in-out-back"
					data-aos-delay="0" data-aos-duration="900">
					<?php echo $title; ?>
				</h2>
			<?php endif; ?>
			<?php if ($button): ?>
				<div class="btn-wrap max-md:hidden" data-aos="fade-left" data-aos-easing="ease-in-out-back"
					data-aos-delay="0" data-aos-duration="900">
					<a class="btn btn-primary"
						href="<?php echo $button['url']; ?>"><span><?php echo $button['title']; ?></span><em
							class="fa-regular fa-plus"></em></a>
				</div>
			<?php endif; ?>
		</div>
		<div class="auto-4 init-swiper">
			<div class="swiper">
				<div class="swiper-wrapper">
					<?php foreach ($items as $item): ?>
						<div class="swiper-slide">
							<div class="item bg-white relative group">
								<div class="img zoom-in overflow-hidden">
									<a class="img-ratio ratio:pt-[452_320]">
										<img class="lozad" src="<?php echo $item['image']['url']; ?>"
											alt="<?php echo $item['image']['alt']; ?>" loading="lazy" />
									</a>
								</div>
								<div class="txt text-center flex-center p-4">
									<p class="mb-0 heading-4 uppercase flex-center group-hover:text-primary-1"
										href="<?php echo $item['url']; ?>"><?php echo $item['title']; ?></p>
								</div>
							</div>
						</div>
					<?php endforeach; ?>
				</div>
			</div>
			<div class="swiper-pagination lg:hidden mt-10"></div>
		</div>
		<?php if ($button): ?>
			<div class="btn-wrap flex-center mt-8 md:hidden"><a class="btn btn-primary"
					href="<?php echo $button['url']; ?>"><span><?php echo $button['title']; ?></span><em
						class="fa-regular fa-plus"></em></a></div>
		<?php endif; ?>
	</div>
</section>