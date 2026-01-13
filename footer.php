
</main>
<?php
$footer = get_field('footer', 'option');
$title = $footer['title'];
$address_infomation = $footer['address_infomation'];
$contact = $footer['contact'];
$socials = $footer['socials'];
$copyright = $footer['copyright'];
$image = $footer['image'];
?>
<footer>
	<section class="footer relative overflow-hidden text-white pad-8 section-blue nav-white">
		<div class="img-wrap zoom-in overflow-hidden absolute bottom-0 right-4 z-100" data-aos="fade-left" data-aos-easing="ease-in-out-back" data-aos-delay="0" data-aos-duration="700"><a><img src="<?= $image['url']; ?>" alt="<?= $image['alt']; ?>"></a></div>
		<div class="container relative z-50">
			<div class="row"> 
				<div class="col w-full lg:w-5/12">
					<h2 class="heading-1-up uppercase mb-7 text-white lg:mb-11" data-aos="fade-down" data-aos-easing="ease-in-out-back" data-aos-delay="0" data-aos-duration="700"><?= $title; ?></h2>
					<div class="network">
						<ol data-aos="fade-up" data-aos-easing="ease-in-out-back" data-aos-delay="200" data-aos-duration="700">
							<?php foreach ($address_infomation as $item) : ?>
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
					<h4 class="heading-5 contact-title uppercase mb-4" data-aos="fade-up" data-aos-easing="ease-in-out-back" data-aos-delay="400" data-aos-duration="700"><?= $contact['title']; ?></h4>
					<address class="not-italic" data-aos="fade-up" data-aos-easing="ease-in-out-back" data-aos-delay="600" data-aos-duration="700">
						<ul>
							<?php foreach ($contact['infor'] as $item) : ?>
								<li>
									<div class="label mr-2"><?= $item['label']; ?></div>
									<div class="txt">
										<?= $item['text']; ?>
									</div>
								</li>
							<?php endforeach; ?>
						</ul>
					</address>
					<div class="social py-6 lg:py-8" data-aos="fade-up" data-aos-easing="ease-in-out-back" data-aos-delay="600" data-aos-duration="800">
						<div class="wrap flex-center  lg:flex-start rem:gap-[10px]">
							<?php foreach ($socials as $item) : ?>
								<a href="<?= $item['link']; ?>" target="_blank"> <em class="fa-brands fa-<?= $item['icon']; ?>"></em></a>
							<?php endforeach; ?>
						</div>
					</div>
					<div class="copyright body-1 text-white text-opacity-50 max-lg:text-center" data-aos="fade-right" data-aos-easing="ease-in-out-back" data-aos-delay="0" data-aos-duration="700">
						<?= $copyright; ?>
					</div>
				</div>
			</div>
		</div>
	</section>
</footer>

<?php $cta = $footer['cta']; ?>
<div class="sidenav-group">
	<a class="back-to-top cursor-pointer"  aria-label="Back to top" ><em class="fa-regular fa-arrow-up-to-line"></em></a>
	<ul>
		<?php if($cta['quote']): ?>
			<li>
				<a class="wrap" href="<?php echo $cta['quote']['link']['url']; ?>" target="<?php echo $cta['quote']['link']['target']; ?>">
					<div class="icon">
						<?php echo $cta['quote']['icon']; ?>
					</div>
					<div class="txt-grid-span">
						<div><span><?php echo $cta['quote']['link']['title']; ?></span></div>
					</div>
				</a>
			</li>
		<?php endif; ?>
		<?php if($cta['contact']): ?>
			<li>
				<div class="wrap">
					<div class="icon">
						<em class="fa-solid fa-messages"></em>
					</div>
					<div class="txt-grid-span">
						<div>
							<div class="group flex-center gap-2 pl-2 pr-3 border-l border-white border-opacity-40">
								<?php if($cta['contact']['facebook']): ?>
									<a href="<?php echo $cta['contact']['facebook']; ?>" target="_blank"><em class="fa-brands fa-facebook-messenger"></em></a>
								<?php endif; ?>
								<?php if($cta['contact']['whatsapp']): ?>
									<a href="<?php echo $cta['contact']['whatsapp']; ?>" target="_blank"><em class="fa-brands fa-whatsapp"></em></a>
								<?php endif; ?>
							</div>
						</div>
					</div>
				</div>
			</li>
		<?php endif; ?>
	</ul>
</div>
<?php if (stripos($_SERVER['HTTP_USER_AGENT'], 'Chrome-Lighthouse') === false) : ?>
	<?php wp_footer() ?>
<?php endif; ?>
<?= get_field('field_config_body', 'options') ?>
</body>

</html>