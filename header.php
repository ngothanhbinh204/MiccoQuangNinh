<!DOCTYPE html>
<html <?= language_attributes() ?>>

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

	<?php if (stripos($_SERVER['HTTP_USER_AGENT'], 'Chrome-Lighthouse') === false): ?>
	<?php endif; ?>
	<?php wp_head(); ?>
	<?= get_field('field_config_head', 'options') ?>
		<?php



	$header_options = get_field('header_options', 'option');

	$header_social = isset($header_options['header_social']) ? $header_options['header_social'] : '';



	?>


</head>

<body <?php body_class(get_field('add_class_body', get_the_ID())) ?>>
	<header class="fixed z-999 top-0 left-0 right-0 w-full transition max-xl:bg-white " id="header">
		<div class="container relative flex-between z-50 h-full">
			<div class="header-left relative z-40 flex-start">
				<div class="site-menu-toggle relative z-100" tabindex="-1" aria-label="Toggle Site Menu">
					<div class="hamburger hamburger--elastic relative z-50">
						<div class="hamburger-box">
							<div class="hamburger-inner"></div>
						</div>
					</div>
					<div class="menu-overlay"></div>
				</div>
				<div class="search-wrap relative z-50 ml-6">
					<div class="search-toggle"></div>
				</div>
			</div>
			<div class="nav-brand z-50 pointer-events-auto z-50">
				<?php echo get_custom_logo(); ?>
			</div>
			<div class="header-right relative z-40">
				<div class="language-wrap">
					<div class="wpml-ls wpml-ls-legacy-list-horizontal wpml-ls-statics-shortcode_actions">
						<?php echo do_shortcode('[wpml_language_selector_widget]'); ?>
					</div>
				</div>
			</div>
		</div>
	</header>



	<form class="searchbox" action="<?php bloginfo('url') ?>/" method="GET" role="form">
		<div class="search-overlay">
			<div class="container">
				<input class="w-full" name="s" class="form-control" type="text"
					placeholder="<?php _e('Tìm kiếm', 'canhcamtheme'); ?>">



				<button type="submit" tabindex="-1" aria-label="Search Button"><em
						class="fa-regular fa-magnifying-glass"></em></button>

			</div>
		</div>
	</form>

	<div class="mobile-nav-wrap">
		<div class="block-wrap">
			<div class="scrollbar-wrap white">
				<nav class="nav-primary-menu">
					<?php
					wp_nav_menu(array(
						'theme_location' => 'header-menu',
						'menu_id' => 'menu-site-menu',
						'container' => false,
						'menu_class' => 'nav',
					));
					?>
				</nav>
			</div>
			<div class="header-social">
				<div class="social pt-10 lg:pt-15">
					<div class="wrap flex-center  lg:flex-start rem:gap-[12px]">

						<?php foreach ($header_social as $item): 
							
							
							?>



							<a rel="noopener noreferrer" target="_blank" <?php if (!empty($item['link']))
								echo 'href="' . $item['link'] . '"'; ?>>
								<?php if (!empty($item['icon'])): ?>
									<?= $item['icon'] ?>
								<?php elseif (!empty($item['image'])): ?>

									<?php echo wp_get_attachment_image($item['image'], 'full', array('class' => 'img-wp')); ?>

								<?php endif; ?>
							</a>
						<?php endforeach; ?>

					</div>
				</div>
			</div>
		</div>
	</div>
	<main>