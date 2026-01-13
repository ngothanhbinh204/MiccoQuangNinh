<?php
$title = get_sub_field('title');
$highlight = get_sub_field('highlight');
$description = get_sub_field('description');
$button = get_sub_field('button');
$items = get_sub_field('items');
?>
<section class="home-about bg-secondary-bg overflow-hidden relative nav-white">
    <div class="block-wrap-center relatie z-50">
        <div class="container h-full">
            <div class="grid h-full xl:grid-cols-2 xl:gap-10">
                <div class="col-span-1 h-full">
                    <div class="txt-wrap col-left h-full">
                        <?php if($title) : ?>
                            <h2 class="heading-1-up mb-10" data-aos="fade-down" data-aos-easing="ease-in-out-back" data-aos-delay="0" data-aos-duration="900"><?= $title; ?></h2>
                        <?php endif; ?>
                        <div class="scrollbar-wrap" data-aos="fade-up" data-aos-easing="ease-in-out-back" data-aos-delay="200" data-aos-duration="900"> 
                            <?php if($highlight) : ?>
                                <div class="briefcontent body-4 font-bold"><?= $highlight; ?></div>
                            <?php endif; ?>
                            <?php if($description) : ?>
                                <div class="desc body-4 my-6 lg:my-10"><?= $description; ?></div>
                            <?php endif; ?>
                        </div>
                        <div class="wrap-left pt-5 xl:pt-8" data-aos="fade-in" data-aos-easing="ease-in-out-back" data-aos-delay="400" data-aos-duration="900"><a class="btn btn-primary" href="<?= $button['url']; ?>"><span><?= $button['title']; ?></span><em class="fa-regular fa-plus"></em></a></div>
                    </div>
                </div>
                <div class="col-span-1 h-full"></div>
            </div>
            <div class="auto-2 init-swiper no-gap max-xl:pt-8 h-full xl:absolute-y xl:right-0  xl:w-1/2 m-0 p-0">
                <?php if($items) : ?>
                    <div class="swiper"> 
                        <div class="swiper-wrapper"> 
                            <?php foreach ($items as $item) : ?>
                                <div class="swiper-slide">
                                    <div class="item" data-aos="fade-up" data-aos-easing="ease-in-out-back" data-aos-delay="0" data-aos-duration="850">
                                        <div class="img-wrap zoom-in"><a href="<?php echo $item['link']; ?>"><img class="lozad" src="<?= $item['image']['url']; ?>" alt="<?= $item['image']['alt']; ?>" loading="lazy"/></a></div>
                                        <div class="txt">
                                            <div class="icon mb-6 w-15 h-15 min-w-15 flex-center"><img src="<?= $item['icon']['url']; ?>" alt="<?= $item['icon']['alt']; ?>" loading="lazy"></div>
                                            <h3 class="headline text-white"><strong class="heading-3 uppercase mb-2"><?= $item['title']; ?></strong><span class="heading-3 font-normal uppercase"><?= $item['subtitle']; ?></span></h3>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>