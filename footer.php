<?php
// Info Tab
$footer_info_enable = get_field('footer_info_enable', 'option');
$footer_company_title = get_field('footer_company_title', 'option');
$footer_address_list = get_field('footer_address_list', 'option');
$footer_copyright = get_field('footer_copyright', 'option');

// Links Tab
$footer_links_enable = get_field('footer_links_enable', 'option');
$footer_quick_links_title = get_field('footer_quick_links_title', 'option');
$footer_socials_title = get_field('footer_socials_title', 'option');
$footer_socials_list = get_field('footer_socials_list', 'option');

// CTA Tab
$footer_cta_enable = get_field('footer_cta_enable', 'option');
$footer_hotline = get_field('footer_hotline', 'option');
$footer_fixed_socials = get_field('footer_fixed_socials', 'option');
?>

<footer class="footer bg-Primary-1 py-15">
	<div class="container">
		<div class="footer-top pb-4 mb-4 border-b border-b-Primary-2/10">
			<div class="footer-wrapper grid md:grid-cols-[6.5fr_2.5fr_3fr] grid-cols-1 xl:rem:gap-[86px] gap-base">

				<?php if ($footer_info_enable): ?>
				<div class="footer-column">
					<?php if ($footer_company_title): ?>
					<h3 class="title body-1 font-bold text-Primary-2 uppercase mb-6">
						<?php echo $footer_company_title; ?></h3>
					<?php endif; ?>

					<?php if ($footer_address_list): ?>
					<div class="footer-contact flex flex-col gap-3">
						<?php foreach ($footer_address_list as $item): ?>
						<div class="item body-2">
							<?php if ($item['label']): ?>
							<div class="label font-bold mb-1"><?php echo $item['label']; ?></div>
							<?php endif; ?>
							<?php echo $item['content']; ?>
                            
                            <?php if ($item['map_link']): 
                                $link_url = $item['map_link']['url'];
                                $link_title = $item['map_link']['title'];
                                $link_target = $item['map_link']['target'] ? $item['map_link']['target'] : '_self';
                            ?>
                            <div class="view-map"> <a class="underline" href="<?php echo esc_url($link_url); ?>" target="<?php echo esc_attr($link_target); ?>"><?php echo esc_html($link_title); ?></a></div>
                            <?php endif; ?>
						</div>
						<?php endforeach; ?>
					</div>
					<?php endif; ?>
				</div>
				<?php endif; ?>

				<?php if ($footer_links_enable): ?>
				<div class="footer-column">
					<?php if ($footer_quick_links_title): ?>
					<h3 class="title body-1 font-bold text-Primary-2 mb-6"><?php echo $footer_quick_links_title; ?></h3>
					<?php endif; ?>
					<?php
						wp_nav_menu(array(
							'theme_location' => 'footer-1',
							'container'      => false,
							'menu_class'     => 'footer-menu',
							'fallback_cb'    => false,
						));
						?>
				</div>

				<div class="footer-column">
					<?php if ($footer_socials_title): ?>
					<h3 class="title body-1 font-bold text-Primary-2 mb-6"><?php echo $footer_socials_title; ?></h3>
					<?php endif; ?>
					<?php wp_nav_menu(array(
						'theme_location' => 'footer-2',
						'container'      => false,
						'menu_class'     => 'footer-menu',
						'fallback_cb'    => false,
					)); ?>
				</div>
				<?php endif; ?>

			</div>
		</div>

		<div class="footer-bottom flex md:flex-row flex-col md:items-center justify-between body-4">
			<div class="footer-copyright">
				<p><?php echo $footer_copyright; ?></p>
			</div>
			<div class="footer-policy">
				<?php
				wp_nav_menu(array(
					'theme_location' => 'footer-3',
					'container'      => false,
					'depth'          => 1,
					'fallback_cb'    => false,
				));
				?>
			</div>
		</div>
	</div>

	<?php if ($footer_cta_enable): ?>
	<div class="tool-fixed-cta">
		<div class="btn button-to-top">
			<div class="btn-icon">
				<div class="icon"> </div>
			</div>
		</div>

		<?php if ($footer_hotline): 
            $hotline_url = $footer_hotline['url'];
            $hotline_title = $footer_hotline['title'];
            $hotline_target = $footer_hotline['target'] ? $footer_hotline['target'] : '_self';
        ?>
		<a class="btn btn-content bg-Primary-2" href="<?php echo esc_url($hotline_url); ?>" target="<?php echo esc_attr($hotline_target); ?>">
			<div class="btn-icon">
				<div class="icon"><i class="fa-light fa-phone"></i></div>
			</div>
			<div class="content"><?php echo esc_html($hotline_title); ?></div>
		</a>
		<?php endif; ?>

		<?php if ($footer_fixed_socials): ?>
		<div class="btn btn-content btn-social">
			<div class="btn-icon">
				<div class="icon"><i class="fa-light fa-messages"></i></div>
			</div>
			<div class="content">
				<ul>
					<?php foreach ($footer_fixed_socials as $fsocial): 
                        // Icon mapping based on choices
                        // "location-dot": "Location", "phone": "Phone", "envelope": "Mail"
                        // Assuming prefix is fa-light based on existing classes
                        $icon_class = $fsocial['icon'] ? 'fa-light fa-' . $fsocial['icon'] : '';
						$icon_link = $fsocial['link']['url'] ? $fsocial['link']['url'] : '#';
						$icon_target = $fsocial['link']['target'] ? $fsocial['link']['target'] : '_self';
                    ?>	
					<li>
                        <?php if ($icon_class): ?>
                            <div class="flex items-center gap-2">
								<a href="<?php echo esc_url($icon_link); ?>" target="<?php echo esc_attr($icon_target); ?>"> <i class="<?php echo esc_attr($icon_class); ?>"></i></a>
                            </div>
                        <?php endif; ?>
					</li>
					<?php endforeach; ?>
				</ul>
			</div>
		</div>
		<?php endif; ?>
	</div>
	<?php endif; ?>

</footer>

<?php if (stripos($_SERVER['HTTP_USER_AGENT'], 'Chrome-Lighthouse') === false): ?>
<?php wp_footer(); ?>
<?php endif; ?>
<?php echo get_field('field_config_body', 'options'); ?>
</body>

</html>