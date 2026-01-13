<?php 
/**
 * Template Name: Lĩnh vực hoạt động
 */
?>

<?php get_header(); ?>

<?php if(get_field('intro')) : ?>
    <?php
    $intro = get_field('intro');
    $title = $intro['title'];
    $description = $intro['description'];
    $items = $intro['items'];
    ?>
    <section class="field-list pad-8 relative overflow-hidden"  >
        <div class="container relative z-50">
            <h2 class="heading-1-up text-center mb-6"><?php echo $title; ?></h2>
            <?php if($description): ?>
                <div class="zone-desc text-center w-full body-1 lg:w-10/12 mx-auto mb-10"><?php echo $description; ?></div>
            <?php endif; ?>
            <?php if($items): ?>
                <div class="tablet-block">
                    <div class="auto-4 init-swiper">
                        <div class="swiper">
                            <div class="swiper-wrapper">
                                <?php foreach($items as $item): ?>
                                    <div class="swiper-slide">
                                        <div class="item relative">
                                            <div class="img zoom-in overflow-hidden">
                                                <a class="img-ratio ratio:pt-[1_1]">
                                                    <?php echo get_image_attrachment($item['image'], 'image'); ?>
                                                </a>
                                            </div>
                                            <div class="txt absolute-x bottom-0 z-30 w-full p-4  pb-10 text-center">
                                                <div class="title"><?php echo $item['title']; ?></div>
                                                <div class="body-1 text-white line-clamp-4 mt-2 xl:mt-5"><?php echo $item['description']; ?></div>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                        <div class="swiper-pagination"></div>
                    </div>
                </div>
                <div class="desktop-block">
                    <div class="w-full lg:w-10/12 block-wrap mx-auto lg:pr-15">
                        <div class="honeycomb-gird">
                            <ul class="honeycomb">
                                <?php foreach($items as $item): ?>
                                    <li class="item relative">
                                        <a class="zoom-in relative">
                                            <?php echo get_image_attrachment($item['image'], 'image'); ?>
                                        </a>
                                        <div class="txt absolute-x bottom-0 w-full pb-25 xl:pb-22 px-10 text-center">
                                            <div class="title"><?php echo $item['title']; ?></div>
                                            <div class="txt-grid">
                                                <div> 
                                                    <div class="body-1 text-white line-clamp-4 mt-2 xl:mt-5"><?php echo $item['description']; ?></div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
            
        </div>
    </section>
<?php endif; ?>

<?php if(get_field('block_content')) : ?>
    <section class="field-block-list overflow-hidden"  >
	
        <?php foreach(get_field('block_content') as $key => $item): ?>
            <div class="block-wrap relative" id="section-block-<?= $key ?>">
                <div class="container lg:absolute-center z-20">
                    <div class="row"> 
                        <div class="col w-full lg:w-1/2">
                            <div class="bg-wrap lg:pr-20">
                                <div class="txt col-left bg-primary-1 p-8 md:p-10">
                                    <h2 class="heading-1-up mb-10 text-white"><?php echo $item['title']; ?></h2>
                                    <div class="scrollbar-wrap body-1 text-white white"><?php echo $item['description']; ?></div>
                                </div>
                            </div>
                        </div>
                        <div class="col w-full lg:w-1/2"></div>
                    </div>
                </div>
                <div class="container-fluid">
                    <div class="row"> 
                        <div class="col w-full lg:w-4/12"></div>
                        <div class="col w-full lg:w-8/12">
                            <div class="img zoom-in overflow-hidden">
                                <a class="img-ratio ratio:pt-[811_1220]">
                                    <?php echo get_image_attrachment($item['image'], 'image'); ?>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
        
    </section>
<?php endif; ?>

<?php get_footer(); ?>