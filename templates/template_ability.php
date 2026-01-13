<?php
/**
 * Template Name: Năng lực
 */
?>

<?php get_header(); ?>

<?php if (get_field('banner')): ?>
	<?php
	$banner = get_field('banner');
	$background = $banner['background'];
	$title = $banner['title'];
	$description = $banner['description'];
	$items = $banner['items'];
	?>
	<section class="ability-1 overflow-hidden relative pad-t-8"
		setBackground="<?php echo get_image_attrachment($background, 'url'); ?>">
		<div class="container">
			<div class="row">
				<div class="col w-full lg:w-5/12 xl:w-4/12">
					<div class="txt-wrap lg:pr-10">
						<h2 class="heading-1-up"><?php echo $title; ?></h2>
						<?php if ($description): ?>
							<div class="zone-desc body-1 mt-7 lg:mt-10">
								<?php echo $description; ?>
							</div>
						<?php endif; ?>
					</div>
				</div>
				<div class="col w-full lg:w-7/12 xl:w-8/12"></div>
			</div>
		</div>
		<?php if ($items): ?>
			<div class="block-wrap bg-primary-1 bg-opacity-50">
				<div class="container">
					<div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5">
						<?php foreach ($items as $item): ?>
							<div class="item col-center border-r border-white border-opacity-20 gap-2 py-6 text-center ">
								<div
									class="icon w-[64px] h-[64px] min-w-[64px] mb-7 flex-center 2xl:min-w-16 2xl:w-16 2xl:h-16 overflow-hidden ">
									<?php echo get_image_attrachment($item['icon'], 'image'); ?>
								</div>
								<div class="txt">
									<div class="heading-5 text-white font-bold mb-2"><?php echo $item['title']; ?></div>
									<div class="body-1 text-white"><?php echo $item['description']; ?></div>
								</div>
							</div>
						<?php endforeach; ?>
					</div>
				</div>
			</div>
		<?php endif; ?>
	</section>
<?php endif; ?>

<?php if (get_field('employee')): ?>
	<?php
	$employee = get_field('employee');
	$background = $employee['background'];
	$title = $employee['title'];
	$description = $employee['description'];
	$total_staff = $employee['total_staff'];
	$items = $employee['items'];
	?>
	<section class="ability-2 overflow-hidden relative pad-t-8"
		setBackground="<?php echo get_image_attrachment($background, 'url'); ?>">
		<div class="container">
			<h2 class="heading-1-up mb-4 text-center"><?php echo $title; ?></h2>
			<?php if ($description): ?>
				<div class="zone-desc body-1 mb-10 text-center">
					<?php echo $description; ?>
				</div>
			<?php endif; ?>
			<div class="row">
				<?php if ($total_staff): ?>
					<div class="col w-full lg:w-4/12">
						<div class="txt-wrap border-r border-primary-1 border-opacity-10 h-full max-lg:col-center">
							<h3 class="heading-4 uppercase text-primary-1 mb-4"><?php echo $total_staff['title']; ?></h3>
							<div class="title-grad text-gradient-2 lg:text-7xl uppercase text-6xl font-extrabold">
								<?php echo $total_staff['value']; ?>
							</div>
						</div>
					</div>
				<?php endif; ?>
				<?php if ($items): ?>
					<div class="col w-full lg:w-8/12">
						<div class="grid gap-6 grid-cols-2 md:grid-cols-3 lg:gap-y-10">
							<?php foreach ($items as $item): ?>
								<div class="item border-r border-primary-1 border-opacity-10 col-center text-center ">
									<div class="icon w-[64px] h-[64px] min-w-[64px] flex-center 2xl:min-w-16 2xl:w-16 2xl:h-16 ">
										<?php echo get_image_attrachment($item['icon'], 'image'); ?>
									</div>
									<div class="txt">
										<h3 class="body-1 uppercase text-primary-1 my-2 font-bold"><?php echo $item['title']; ?>
										</h3>
										<div class="counter text-primary-1 heading-1-up mb-2 leading-130 font-extrabold">
											<?php echo $item['value']; ?>
										</div>
										<div class="desc body-4"><?php echo $item['description']; ?></div>
									</div>
								</div>
							<?php endforeach; ?>
						</div>
					</div>
				<?php endif; ?>
			</div>
		</div>
	</section>
<?php endif; ?>

<?php if (get_field('equipment')): ?>
	<?php
	$equipment = get_field('equipment');
	$background = $equipment['background'];
	$title = $equipment['title'];
	$tabs = $equipment['tabs'];
	?>
	<section class="ability-3 overflow-hidden relative pad-8"
		setBackground="<?php echo get_image_attrachment($background, 'url'); ?>">
		<div class="container">
			<div class="row">
				<div class="col w-full lg:w-3/12">
					<div class="txt">
						<h2 class="heading-1-up text-white mb-10 max-lg:text-center"><?php echo $title; ?></h2>
						<?php if ($tabs): ?>
							<div class="tab-nav">
								<ul>
									<?php foreach ($tabs as $key => $tab): ?>
										<li class="<?php echo $key == 0 ? 'active' : ''; ?>">
											<a class="hover:text-opacity-100 hover:border-opacity-100 flex-start transition text-base py-4 border-b border-white border-opacity-20 text-white uppercase text-opacity-50"
												href="javascript:;"
												data-type="tab-block-<?php echo $key + 1; ?>"><?php echo $tab['name']; ?></a>
										</li>
									<?php endforeach; ?>
								</ul>
							</div>
						<?php endif; ?>
					</div>
				</div>
				<div class="col w-full lg:w-9/12">
					<?php if ($tabs): ?>
						<?php foreach ($tabs as $key => $tab): ?>
							<div class="tab-item <?php echo $key == 0 ? 'active' : ''; ?>" id="tab-block-<?php echo $key + 1; ?>">
								<div class="single-swiper init-swiper">
									<div class="swiper">
										<div class="swiper-wrapper">
											<?php if ($tab['items']): ?>
												<?php foreach ($tab['items'] as $item): ?>
													<div class="swiper-slide">
														<div class="item bg-primary-1 md:flex-start">
															<div class="img zoom-in overflow-hidden">
																<a class="img-ratio ratio:pt-[450_600]">
																	<?php echo get_image_attrachment($item['image'], 'image'); ?>
																</a>
															</div>
															<div class="txt col-left p-8 lg:p-10">
																<h2 class="heading-1 text-white mb-2"><?php echo $item['title']; ?></h2>
																<div class="scrollbar-wrap white w-full">
																	<div class="body-1 text-white mb-5 text-opacity-50">
																		<?php echo $item['description']; ?>
																	</div>
																	<?php if ($item['info']): ?>
																		<table>
																			<tbody>
																				<?php foreach ($item['info'] as $info): ?>
																					<tr>
																						<td><?php echo $info['label']; ?></td>
																						<td><?php echo $info['value']; ?></td>
																					</tr>
																				<?php endforeach; ?>
																			</tbody>
																		</table>
																	<?php endif; ?>
																</div>
															</div>
														</div>
													</div>
												<?php endforeach;
											endif;
											?>
										</div>
									</div>
									<div class="nav-wrap mt-10">
										<div class="swiper-nav white normal">
											<div class="prev"> </div>
											<div class="next"></div>
										</div>
									</div>
								</div>
							</div>
						<?php endforeach; ?>
					<?php endif; ?>
				</div>
			</div>
		</div>
	</section>
<?php endif; ?>

<?php if (get_field('technology')): ?>
	<?php
	$technology = get_field('technology');
	$title = $technology['title'];
	$tabs = $technology['tabs'];
	?>
	<section class="ability-4 overflow-hidden relative bg-grey-50">
		<div class="container-fluid">
			<div class="row">
				<div class="col w-full lg:w-1/2">
					<?php if ($tabs): ?>
						<?php foreach ($tabs as $index => $tab): ?>
							<div class="tab-item <?php echo $index == 0 ? 'is-active' : ''; ?>"
								id="tab-block-<?php echo $index + 1; ?>">
								<?php if ($tab['gallery']): ?>
									<div class="single-swiper init-swiper h-full">
										<div class="swiper h-full">
											<div class="swiper-wrapper">
												<?php foreach ($tab['gallery'] as $item): ?>
													<div class="swiper-slide">
														<div class="img zoom-in">
															<a>
																<?php echo get_image_attrachment($item, 'image'); ?>
															</a>
														</div>
													</div>
												<?php endforeach; ?>
											</div>
										</div>
										<div class="mobile-pagination mt-8 lg:hidden">
											<div class="swiper-pagination"></div>
										</div>
									</div>
								<?php endif; ?>
							</div>
						<?php endforeach; ?>
					<?php endif; ?>
				</div>
				<div class="col w-full lg:w-1/2">
					<div class="block-wrapper lg:pl-6 pad-8">
						<h2 class="heading-1-up mb-6"><?php echo $title; ?></h2>
						<?php if ($tabs): ?>
							<div class="toggle-wrap">
								<?php foreach ($tabs as $index => $tab): ?>
									<li class="toggle-item <?php echo $index == 0 ? 'is-toggle' : ''; ?>">
										<div class="wrap">
											<div class="title flex-between py-5  border-t border-grey-200 relative"
												data-type="tab-block-<?php echo $index + 1; ?>">
												<span
													class="heading-2 text-grey-500 uppercase leading-135"><?php echo $tab['title']; ?></span>
												<em class="fa-regular fa-chevron-down"></em>
											</div>
											<div class="article">
												<div class="desc body-1 text-grey-800 scrollbar-wrap">
													<?php echo $tab['description']; ?>
												</div>
												<?php if ($tab['button']): ?>
													<a class="btn btn-primary mt-5" href="<?php echo $tab['button']['url']; ?>"
														target="_blank"><span><?php echo $tab['button']['title']; ?></span><em
															class="fa-regular fa-plus"></em></a>
												<?php endif; ?>
											</div>
										</div>
									</li>
								<?php endforeach; ?>
							</div>
						<?php endif; ?>
					</div>
				</div>
			</div>
		</div>
	</section>
<?php endif; ?>

<?php if (get_field('overview')): ?>
	<?php
	$overview = get_field('overview');
	$background = $overview['background'];
	$title = $overview['title'];
	$tabs = $overview['tabs'];
	?>
	<section class="ability-5 overflow-hidden relative pad-8"
		setBackground="<?php echo get_image_attrachment($background, 'url'); ?>">
		<div class="container">
			<div class="title-wrap md:flex-between mb-10">
				<h2 class="heading-1-up max-md:text-center"><?php echo $title; ?></h2>
				<?php if ($tabs): ?>
					<div class="tab-nav w-full max-md:mt-8">
						<ul class="flex-end gap-2">
							<?php foreach ($tabs as $index => $tab): ?>
								<li class="<?php echo $index == 0 ? 'active' : ''; ?>">
									<a class="transition flex-center text-primary-1 text-base font-bold bg-grey-50 uppercase py-3 px-5"
										href="javascript:;"
										data-type="tab-block-<?php echo $index + 1; ?>"><?php echo $tab['name']; ?></a>
								</li>
							<?php endforeach; ?>
						</ul>
					</div>
				<?php endif; ?>
			</div>

			<?php if ($tabs): ?>
				<?php foreach ($tabs as $index => $tab): ?>
					<div class="tab-item <?php echo $index == 0 ? 'active' : ''; ?>" id="tab-block-<?php echo $index + 1; ?>">
						<div class="single-swiper init-swiper">
							<div class="swiper">
								<div class="swiper-wrapper">
									<div class="swiper-slide">
										<div class="item border border-grey-100 p-6 bg-white">
											<div class="img zoom-in overflow-hidden">
												<a class="img-ratio ratio:pt-[437_655]">
													<?php echo get_image_attrachment($tab['image'], 'image'); ?>
												</a>
											</div>
											<div class="txt">
												<div class="scrollbar-wrap">
													<div class="logo border border-grey-100 flex-start mb-6">
														<?php echo get_image_attrachment($tab['logo'], 'image'); ?>
													</div>
													<h2 class="heading-2 uppercase text-grey-950 hover:text-primary-1 mb-4">
														<?php echo $tab['title']; ?>
													</h2>
													<div class="body-1 mb-7 lg:mb-10"><?php echo $tab['description']; ?></div>
													<?php if ($tab['items']): ?>
														<div class="list">
															<ul>
																<?php foreach ($tab['items'] as $item): ?>
																	<li class="flex-start">
																		<div
																			class="icon w-[48px] h-[48px] min-w-[48px] lg:w-12 lg:min-w-12 lg:h-12">
																			<?php echo get_image_attrachment($item['icon'], 'image'); ?>
																		</div>
																		<div class="text-wrap ml-3">
																			<div class="body-4 font-bold mb-3"><?php echo $item['title']; ?>
																			</div>
																			<div class="body-1"><?php echo $item['description']; ?></div>
																		</div>
																	</li>
																<?php endforeach; ?>

															</ul>
														</div>
													<?php endif; ?>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				<?php endforeach; ?>
			<?php endif; ?>
		</div>
	</section>
<?php endif; ?>

<?php if (get_field('achievement')): ?>
	<?php
	$achievement = get_field('achievement');
	$title = $achievement['title'];
	$items = $achievement['items'];
	?>
	<section class="ability-7 overflow-hidden relative pad-8  lg:pb-10">
		<div class="container relative z-50">
			<h2 class="heading-1-up text-center mb-10 text-white"><?php echo $title; ?></h2>
			<?php if ($items): ?>
				<div class="block-wrap large-center-swiper relative">
					<div class="swiper">
						<div class="swiper-wrapper">
							<?php foreach ($items as $item): ?>
								<div class="swiper-slide">
									<div class="item ">
										<div class="wrap">
											<div class="box">
												<div class="img border-grey-200 border-10">
													<a><?php echo get_image_attrachment($item['image'], 'image'); ?></a>
												</div>
												<div class="txt pt-6 text-center">
													<h3 class="headline heading-4 mb-4"><?php echo $item['title']; ?></h3>
													<div class="body-1"><?php echo $item['description']; ?></div>
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