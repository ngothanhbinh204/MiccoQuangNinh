<?php
$title = get_sub_field('title');
$button = get_sub_field('button');
$items = get_sub_field('items');
?>
<section class="home-field flex-card-section-2 bg-secondary-bg relative">
	<div class="container">
		<div class="title-wrap md:flex-between mb-10">
			<?php if ($title): ?>
				<h2 class="heading-1-up max-mdtext-center " data-aos="fade-right" data-aos-easing="ease-in-out-back"
					data-aos-delay="0" data-aos-duration="900"><?= $title; ?></h2>
			<?php endif; ?>
			<?php if ($button): ?>
				<div class="btn-wrap max-md:hidden" data-aos="fade-left" data-aos-easing="ease-in-out-back"
					data-aos-delay="0" data-aos-duration="900"><a class="btn btn-primary"
						href="<?= $button['url']; ?>"><span><?= $button['title']; ?></span><em
							class="fa-regular fa-plus"></em></a></div>
			<?php endif; ?>
		</div>
		<div class="flex-options" data-aos="fade-in" data-aos-easing="ease-in-out-back" data-aos-delay="400"
			data-aos-duration="900">

			<?php foreach ($items as $key => $item): ?>
				<div class="card-option <?php echo $key == 0 ? 'active' : ''; ?>" style="--color-code:#1894DF">
					<div class="card-label">
						<div class="item">
							<div class="img-wrap"><a href="<?= $item['url']; ?>"><img src="<?= $item['image']['url']; ?>"
										alt="<?= $item['image']['alt']; ?>" loading="lazy"></a></div>
							<div class="txt col-end p-5">
								<h3 class="heading-5 text-white"><?= $item['title']; ?></h3>
							</div>
							<div class="text bg-white p-6 lg:p-8 mt-4">
								<a href="<?= $item['url']; ?>">
									<h4 class="heading-2"><?= $item['title']; ?></h4>
									<div class="desc body-4 mt-2 ">
										<?= $item['description']; ?>
									</div>
								</a>
							</div>
						</div>
					</div>
				</div>
			<?php endforeach; ?>
		</div>
		<div class="single-swiper init-swiper lg:hidden">
			<div class="swiper">
				<div class="swiper-wrapper">
					<?php foreach ($items as $item): ?>
						<div class="swiper-slide">
							<div class="item">
								<div class="img-wrap"><a href="<?= $item['url']; ?>"><img
											src="<?= $item['image']['url']; ?>" alt="<?= $item['image']['alt']; ?>"
											loading="lazy"></a></div>
								<div class="text bg-white p-6 lg:p-8 mt-4">
									<h4 class="heading-2 mb-5"><?= $item['title']; ?></h4>
									<div class="desc body-4">
										<?= $item['description']; ?>
									</div>
								</div>
							</div>
						</div>
					<?php endforeach; ?>
				</div>
			</div>
			<div class="nav-wrap mt-7 lg:hidden">
				<div class="swiper-nav">
					<div class="prev"> </div>
					<div class="next"></div>
				</div>
			</div>
		</div>
		<div class="btn-wrap max-md:flex-center mt-10 md:hidden" data-aos="fade-right"
			data-aos-easing="ease-in-out-back" data-aos-delay="0" data-aos-duration="900"><a
				class="btn btn-primary"><span>xem tất cả</span><em class="fa-regular fa-plus"></em></a></div>
	</div>
</section>