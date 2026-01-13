<div class="news-item h-full group">
	<div class="img zoom-in overflow-hidden">
		<a class="img-ratio ratio:pt-[248_440]" href="<?php the_permalink(); ?>">
			<?php echo get_image_post(get_the_ID(), "image"); ?>
		</a>
	</div>
	<div class="txt p-4 lg:pt-4 lg:pb-6">
		<time class="text-grey-950"><?php the_date('d.m.Y'); ?></time>
		<h3 class="mb-2 pb-2 border-b border-grey-100">
			<a class="uppercase flex-start font-bold title transition  group-hover:text-primary-1"
				href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
		</h3>
		<div class="desc"><?php the_excerpt(); ?></div>
	</div>
</div>