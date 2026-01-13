<?php
$background = get_sub_field('background');
$title = get_sub_field('title');
$description = get_sub_field('description');
$gallery = get_sub_field('gallery');
$slide_text = get_sub_field('slide_text');
?>
<section class="home-partner relative z-50 overflow-hidden" style="--bg-url: url(&quot;<?php echo $background['url']; ?>&quot;);  ">
    <div class="container relative z-50">
        <div class="row"> 
            <div class="col w-full lg:w-4/12">
                <div class="txt-wrap h-full max-lg:col-center max-lg:text-center lg:col-left">
                    <?php if($title) : ?>
                        <h2 class="heading-1-up" data-aos="fade-down" data-aos-easing="ease-in-out-back" data-aos-delay="0" data-aos-duration="900">
                            <?php echo $title; ?>
                        </h2>
                    <?php endif; ?>
                    <div class="block-wrap my-6 lg:my-9">
                        <div class="desc body-1" data-aos="fade-up" data-aos-easing="ease-in-out-back" data-aos-delay="400" data-aos-duration="900">
                            <DACINCO><?php echo $description; ?></DACINCO>
                        </div>
                    </div>
                    <div class="nav-wrap" data-aos="fade-up" data-aos-easing="ease-in-out-back" data-aos-delay="400" data-aos-duration="900">
                        <div class="swiper-nav small normal">
                            <div class="prev"> </div>
                            <div class="next"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col w-full lg:w-8/12">
                <div class="block-wrap lg:pl-18" data-aos="fade-left" data-aos-easing="ease-in-out-back" data-aos-delay="400" data-aos-duration="900">
                    <div class="grid-swiper">
                        <div class="swiper">
                            <div class="swiper-wrapper">
                                <?php foreach($gallery as $image) : ?>
                                    <div class="swiper-slide">
                                        <div class="img zoom-in overflow-hidden  flex-center   w-full">
                                            <a class="flex-center bg-white p-3 w-full"><img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>"></a>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="sliding-text-swiper"> 
        <div class="swiper">
            <div class="swiper-wrapper">
                <?php foreach($slide_text as $text) : ?>
                    <div class="swiper-slide">
                        <div class="item">
                            <div class="txt relative"><span class="flex-center font-extrabold leading-none text-gradient-1 whitespace-nowrap uppercase"><?php echo $text['text']; ?></span></div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</section>