<?php 
    $banner = get_sub_field('banner');
?>
<section class="primary-banner relative z-10 overflow-hidden nav-white">
    <div class="banner-container">
        <div class="swiper"> 
            <div class="swiper-wrapper">
                <?php foreach ($banner as $item) : ?>
                    <div class="swiper-slide">
                        <div class="wrap relative">
                            <?php if($item['banner_style'] == 'video') : ?>
                                <?php 
                                    $video = $item['video']; 
                                    $desktop_video_url = $video['desktop']['url'];
                                    $mobile_video_url = $video['mobile']['url'];
                                    $desktop_video_type = wp_check_filetype($desktop_video_url)['type'] ?: 'video/mp4';
                                    $mobile_video_type = wp_check_filetype($mobile_video_url)['type'] ?: 'video/mp4';
                                ?>
                                <div class="img video">
                                    <a>
                                        <video class="primary-banner-video desktop" muted playsinline>
                                            <source src="<?php echo $desktop_video_url; ?>" type="<?php echo $desktop_video_type; ?>">
                                        </video>
                                        <video class="primary-banner-video mobile" muted playsinline>
                                            <source src="<?php echo $mobile_video_url; ?>" type="<?php echo $mobile_video_type; ?>">
                                        </video>
                                    </a>
                                </div>
                            <?php elseif($item['banner_style'] == 'image') : ?>
                                <?php $image = $item['image']; ?>
                                <div class="img">
                                    <a>
                                        <picture>
                                            <source media="(max-width: 767px)" srcset="<?php echo $image['mobile']['url']; ?>">
                                            <source media="(min-width: 768px)" srcset="<?php echo $image['desktop']['url']; ?>"><img src="<?php echo $image['desktop']['url']; ?>" alt="<?php echo $image['desktop']['alt']; ?>" fetchpriority="high">
                                        </picture>
                                    </a>
                                </div>
                            <?php endif; ?>
                            <div class="container absolute-x z-50 bottom-0 txt-wrap">
                                <div class="block-wrap max-lg:text-center">
                                    <div class="header-48 text-white uppercase font-extrabold text-3xl leading-125 lg:text-48"><?php echo $item['name']; ?></div>
                                    <div class="heading-40 text-white uppercase font-extrabold text-3xl leading-120 lg:text-40 leadin"><?php echo $item['title']; ?></div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
        <div class="pagination-wrap container absolute-x z-50 bottom-0 flex-end">
            <div class="swiper-pagination"></div>
        </div>
        <div class="container absolute-center z-50 nav-wrap">
            <div class="swiper-nav center">
                <div class="prev"> </div>
                <div class="next"></div>
            </div>
        </div>
    </div>
</section>