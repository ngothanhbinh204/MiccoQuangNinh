<?php get_header(); ?>

<?php if(get_field('intro')): ?>
    <?php
    $intro = get_field('intro');
    $title = $intro['title'];
    $image = $intro['image'];
    $items = $intro['items'];
    ?>
    <section class="culture-1 relative overflow-hidden">
        <div class="row relative z-50">
            <div class="col w-full">
                <div class="img zoom-in overflow-hidden"><a><?php echo get_image_attrachment($image, 'image'); ?></a></div>
            </div>
            <div class="col w-full">
                <div class="block-wrap xl:rem:max-w-[1110px] 2xl:rem:max-w-[1020px]">
                    <?php if($title): ?>
                        <h2 class="heading-1-up mb-10 max-lg:text-center"><?php echo $title; ?></h2>
                    <?php endif; ?>

                    <div class="grid gap-6 sm:grid-cols-2">
                        <?php foreach($items as $item): ?>
                            <div class="item overflow-hidden rounded-6 p-6 bg-secondary-bg bg-opacity-50 y-start" data-fancybox="" href="#culture-modal-1">
                                <div class="icon w-[48px] h-[48px] min-w-[48px] lg:w-12 lg:min-w-12 lg:h-12"><?php echo get_image_attrachment($item['icon'], 'image'); ?></div>
                                <div class="text-wrap ml-6">
                                    <div class="title heading-2-up text-primary-1 mb-2"><?php echo $item['title']; ?></div>
                                    <div class="desc body-1"><?php echo substr($item['description'], 0, 15); ?>...</div>
                                    <div class="btn-wrap pt-5"><a class="btn btn-tertiary"><span><?php _e('Xem thêm', 'canhcamtheme'); ?></span><em class="fa-light fa-chevron-right"></em></a>
                                    </div>
                                </div>
                                <div class="popup-modal culture-modal hidden" id="culture-modal-1">
                                    <div class="modal-wrap relative z-50 gap-8 lg:gap-16 md:x-start">
                                        <div class="img zoom-in overflow-hidden rounded-4 w-full"><?php echo get_image_attrachment($item['image'], 'image'); ?></div>
                                        <div class="txt col-left">
                                            <div class="icon flex-start w-[64px] min-w-[64px] h-[64px] lg:w-16 lg:min-w-16 lg:h-16"><img src="<?php echo $item['icon']['url']; ?>" alt="<?php echo $item['icon']['alt']; ?>" loading="lazy"></div>
                                            <div class="scrollbar-wrap">
                                                <h3 class="heading-2 uppercase my-5 text-primary-1"><?php echo $item['title']; ?></h3>
                                                <div class="desc body-1"><?php echo $item['description']; ?></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php endif; ?>

<?php if(get_field('trip')): ?>
    <?php
    $trip = get_field('trip');
    $title = $trip['title'];
    $items = $trip['items'];
    ?>
    <section class="culture-2 relative overflow-hidden bg-grey-50 pad-8">
        <div class="container">
            <?php if($title): ?>
                <h2 class="heading-1-up mb-10 text-center"><?php echo $title; ?></h2>
            <?php endif; ?>

            <div class="auto-4 init-swiper">
                <div class="swiper max-lg:mb-10">
                    <div class="swiper-wrapper">
                        <?php foreach($items as $item): ?>
                            <div class="swiper-slide bg-white">
                                <div class="item p-4">
                                    <div class="img zoom-in overflow-hidden img-contain">
                                        <a class="img-ratio ratio:pt-[336_288]" href="<?php echo $item['link']; ?>"><?php echo get_image_attrachment($item['image'], 'image'); ?></a>
                                    </div>
                                    <div class="txt pt-5">
                                        <div class="heading-2 text-primary-1 text-center"><?php echo $item['title']; ?></div>
                                        <div class="body-1 text-grey-500 text-center line-clamp-2"><?php echo $item['description']; ?></div>
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
    </section>
<?php endif; ?>

<?php if(get_field('activities')): ?>
    <?php 
    $activities = get_field('activities');
    $title = $activities['title'];
    $select_activity = $activities['select_activity'];
    ?>
    <section class="culture-3 relative overflow-hidden pad-8">
        <div class="container">
            <?php if($title): ?>
                <h2 class="heading-1-up mb-10 text-center"><?php echo $title; ?></h2>
            <?php endif; ?>
            <div class="row"> 
                <?php if($select_activity): ?>
                    <div class="col w-full lg:w-8/12 lg:border-r border-grey-100">
                        <?php 
                        // Get only the first item from the array
                        $item = $select_activity[0]; 
                        if($item): 
                        ?>
                        <div class="news-figure-big group bg-grey-50">
                            <div class="txt col-left h-full p-6 lg:px-7">
                                <time class="text-sm mb-2 text-grey-950"><?php echo get_the_date('d.m.Y', $item->ID); ?></time>
                                <div class="title mb-2 pb-2 border-b border-grey-100"><a href="<?php echo get_permalink($item->ID); ?>" class="heading-2 font-bold line-clamp-2 group-hover:text-primary-1"><?php echo get_the_title($item->ID); ?></a></div>
                                <div class="desc body-1 line-clamp-3"><?php echo get_the_excerpt($item->ID); ?></div>
                            </div>
                            <div class="img zoom-in overflow-hidden"><a href="<?php echo get_permalink($item->ID); ?>"><?= get_image_post($item->ID, $type = "image"); ?></a></div>
                        </div>
                        <?php endif; ?>
                    </div>
                    <div class="col w-full lg:w-4/12">
                        <?php foreach($select_activity as $index => $item): ?>
                            <?php if($index > 0): ?>
                                <div class="side-figure overflow-hidden group">
                                    <div class="txt">
                                        <time class="mb-2 text-grey-950"><?php echo get_the_date('d.m.Y', $item->ID); ?></time>
                                        <h3 class="headline"><a class="group-hover:text-primary-1 heading-4 line-clamp-2"><?php echo get_the_title($item->ID); ?></a></h3>
                                    </div>
                                    <div class="img zoom-in overflow-hidden rounded-2 relative"><a href="<?php echo get_permalink($item->ID); ?>"><?= get_image_post($item->ID, $type = "image"); ?></a></div>
                                </div>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </section>
<?php endif; ?>

<?php if(get_field('programme')): ?>
    <?php
    $programme = get_field('programme');
    $title = $programme['title'];
    $select_programme = $programme['select_programme'];
    ?>
    <section class="culture-4 relative overflow-hidden bg-grey-50 pad-8">
        <div class="container">
            <?php if($title): ?>
                <h2 class="heading-1-up mb-10 text-center"><?php echo $title; ?></h2>
            <?php endif; ?>
            <?php if($select_programme): ?>
                <div class="auto-3 init-swiper">
                    <div class="swiper max-lg:mb-10">
                        <div class="swiper-wrapper">
                            <?php foreach($select_programme as $item): ?>
                                <div class="swiper-slide bg-white">
                                    <div class="news-figure h-full group">
                                        <div class="img zoom-in overflow-hidden"><a href="<?php echo get_permalink($item->ID); ?>" class="img-ratio ratio:pt-[248_440]"><?= get_image_post($item->ID, $type = "image"); ?></a></div>
                                        <div class="txt p-6 lg:py-6">
                                            <time class="text-grey-950"><?php echo get_the_date('d.m.Y', $item->ID); ?></time>
                                            <h3 class="mb-2 pb-2 border-b border-grey-100"><a href="<?php echo get_permalink($item->ID); ?>" class="uppercase flex-start font-bold title transition group-hover:text-primary-1"><?php echo get_the_title($item->ID); ?></a></h3>
                                            <div class="desc body-1"><?php echo get_the_excerpt($item->ID); ?></div>
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

<?php if(get_field('members')): ?>
    <?php
    $member = get_field('member');
    $title = $member['title'];
    $description = $member['description'];
    $items = $member['items'];
    ?>
    <section class="culture-5 relative overflow-hidden pad-8">
        <div class="container">
            <?php if($title): ?>
            <h2 class="heading-1-up mb-3 text-center"><?php echo $title; ?></h2>
            <?php endif; ?>
            <?php if($description): ?>
                <div class="zone-desc body-1 text-center mb-10"><?php echo $description; ?></div>
            <?php endif; ?>
            <?php if($items): ?>
                <div class="auto-4 init-swiper">
                    <div class="swiper max-lg:mb-10">
                        <div class="swiper-wrapper">
                            <?php foreach($items as $item): ?>
                                <div class="swiper-slide">
                                    <div class="box-wrap">
                                        <div class="item relative flex h-full">
                                            <div class="img relative z-50 flex  max-md:flex-col md:flex-row-reverse items-end" style="--data-url: url('<?php echo get_image_attrachment($item['image'], 'url'); ?>');">

                                                <img class="relative z-50" src="<?php echo get_image_attrachment($item['image'], 'url'); ?>" alt="alt">
                                                <div class="txt relative py-4 pl-4">
                                                    <h3 class="headline relative z-50">
                                                        <span class="text-base mb-1 text-white block"><?php echo $item['title']; ?></span>
                                                        <strong class="text-2xl uppercase font-extrabold text-white"><?php echo $item['name']; ?></strong>
                                                    </h3>
                                                    <div class="scrollbar-wrap white text-white">
                                                        <div class="desc text-sm text-white leading-140 relative z-50"><?php echo $item['achievement']; ?></div>
                                                        <div class="caption mt-3 body-1 text-center mobile-text"><?php echo $item['description']; ?></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="caption mt-3 body-1 text-center desktop-text"><?php echo $item['description']; ?></div>
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
