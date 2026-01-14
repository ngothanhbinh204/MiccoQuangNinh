<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
	<meta charset="<?php bloginfo('charset'); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link href="https://fonts.googleapis.com/css2?family=Inter+Tight:ital,wght@0,100..900;1,100..900&amp;display=swap" rel="stylesheet">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

	<?php if (stripos($_SERVER['HTTP_USER_AGENT'], 'Chrome-Lighthouse') === false): ?>
	<?php endif; ?>
	<?php wp_head(); ?>
	<?php echo get_field('field_config_head', 'options'); ?>
</head>

<body <?php body_class(get_field('add_class_body', get_the_ID())); ?>>
	<header class="header">
		<div class="container">
			<div class="header-wrapper">
				<div class="header-logo">
					<?php
					if (has_custom_logo()) {
						the_custom_logo();
					} else {
						echo '<a href="' . home_url() . '" alt="logo"><img src="' . get_template_directory_uri() . '/img/logo.png" alt="' . get_bloginfo('name') . '" /></a>';
					}
					?>
				</div>
				<div class="header-right">
					<div class="header-menu">
						<?php
						wp_nav_menu(array(
							'theme_location' => 'header-menu',
							'container'      => false,
							'menu_class'     => 'header-nav',
							'items_wrap'     => '<ul id="%1$s" class="%2$s"><li><a href="' . home_url() . '"><i class="fa-solid fa-house"></i></a></li>%3$s</ul>',
							'fallback_cb'    => false,
						));
						?>
					</div>
					<div class="header-right-inner">
						<div class="header-language">
							<?php echo do_shortcode('[wpml_language_selector_widget]'); ?>
						</div>
						<div class="header-search"> <img class="img-svg"
								src="<?php echo get_template_directory_uri(); ?>/img/search.svg" alt="search"></div>
						<div class="header-bar"><i class="fa-solid fa-bars"></i></div>
					</div>
				</div>
			</div>
		</div>
	</header>
	<div class="header-overlay"></div>
	<div class="header-search-form">
		<div
			class="close flex items-center justify-center absolute top-0 right-0 bg-white text-3xl cursor-pointer w-12.5 h-12.5">
			<i class="fa-light fa-xmark"></i>
		</div>
		<div class="container">
			<div class="wrap-form-search-product">
				<form action="<?php echo home_url(); ?>/" method="GET" role="form">
					<div class="productsearchbox">
						<input type="text" name="s" placeholder="<?php _e('Tìm kiếm thông tin', 'canhcamtheme'); ?>">
						<button type="submit"><i class="fa-light fa-magnifying-glass"></i></button>
					</div>
				</form>
			</div>
		</div>
	</div>
	<main>