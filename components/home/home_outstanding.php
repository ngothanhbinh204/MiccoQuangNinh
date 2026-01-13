<?php
$background = get_sub_field('background');
$title = get_sub_field('title');
$description = get_sub_field('description');
$items = get_sub_field('items');
?>
<section class="home-number relative overflow-hidden nav-blue" setBackground="<?= $background['url']; ?>"> 
    <div class="container relative z-50">
        <div class="row"> 
            <div class="col w-full lg:w-5/12">
                <div class="txt-wrap col-left h-full">
                    <?php if($title) : ?>
                        <h2 class="heading-1-up mb-10" data-aos="fade-down" data-aos-easing="ease-in-out-back" data-aos-delay="0" data-aos-duration="900"><?= $title; ?></h2>
                    <?php endif; ?>
                    <?php if($description) : ?>
                        <div class="scrollbar-wrap" data-aos="fade-up" data-aos-easing="ease-in-out-back" data-aos-delay="300" data-aos-duration="900"> 
                            <div class="briefcontent body-4 font-bold"><?= $description; ?></div>
                        </div>
                    <?php endif; ?>
                    <?php if($items) : ?>
                    <div class="grid grid-cols-2 number-wrap border-opacity-20 gap-6 w-full lg:grid-cols-2 2xl:gap-y-6 mt-7 2xl:mt-10">
                        <?php foreach($items as $item) : ?>
                            <div class="item-counter relative border-b border-grey-300" data-aos="fade-up" data-aos-easing="ease-in-out-back" data-aos-delay="500" data-aos-duration="700">
                                <div class="counter text-5xl leading-135 text-primary-1 font-extrabold lg:text-7xl lg:leading-125"><?= $item['number']; ?></div>
                                <div class="desc body-2 text-dark leading-140 py-4 lg:py-6"><?= $item['title']; ?></div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
            <div class="col w-full lg:w-7/12"></div>
        </div>
    </div>
</section>