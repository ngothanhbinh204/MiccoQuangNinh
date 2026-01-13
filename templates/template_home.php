<?php
/**
 * Template Name: Trang chủ
 */
?>

<?php get_header(); ?>

<main>
	<?php if (get_field('home_1_enable')): ?>
		<?php get_template_part('components/home/home_1'); ?>
	<?php endif; ?>

	<?php if (get_field('home_2_enable')): ?>
		<?php get_template_part('components/home/home_2'); ?>
	<?php endif; ?>

	<?php if (get_field('home_3_enable')): ?>
		<?php get_template_part('components/home/home_3'); ?>
	<?php endif; ?>

	<?php if (get_field('home_4_enable')): ?>
		<?php get_template_part('components/home/home_4'); ?>
	<?php endif; ?>

	<?php if (get_field('home_5_enable')): ?>
		<?php get_template_part('components/home/home_5'); ?>
	<?php endif; ?>

	<?php if (get_field('home_6_enable')): ?>
		<?php get_template_part('components/home/home_6'); ?>
	<?php endif; ?>
</main>

<?php get_footer(); ?>