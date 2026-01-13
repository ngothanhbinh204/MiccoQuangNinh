<?php
/**
 * Template Name: Trang Giới Thiệu
 */
get_header();

// Banner Section
get_template_part('modules/common/banner'); 

// ===========================
// SECTION 1: Về Chúng Tôi
// ===========================
$about_1_title = get_field('about_1_title');
$about_1_content = get_field('about_1_content');
$about_1_profile = get_field('about_1_profile'); // URL
$about_1_video = get_field('about_1_video'); // URL
$about_1_images = get_field('about_1_images'); // Gallery array
?>
<?php if ($about_1_content): ?>
<section class="about-1 section-py">
    <div class="container">
        <div class="wrapper grid md:grid-cols-[42.86%_1fr] grid-cols-1 xl:rem:gap-[120px] gap-base">
            <div class="col-left">
                <?php if ($about_1_title): ?>
                    <h2 class="title font-bold text-Primary-2 mb-base"><?php echo esc_html($about_1_title); ?></h2>
                <?php endif; ?>
                
                <div class="format-content body-1 text-justify font-normal space-y-5">
                    <?php echo $about_1_content; ?>
                </div>

                <div class="wrap-button mt-5 flex items-center gap-5">
                    <?php if ($about_1_profile): ?>
                    <a class="btn btn-primary" href="<?php echo esc_url($about_1_profile); ?>" target="_blank">
                        <div class="icon"><i class="fa-regular fa-download"></i></div>
                        <span><?php _e('Tải hồ sơ năng lực', 'canhcamtheme'); ?></span>
                    </a>
                    <?php endif; ?>
                    
                    <?php if ($about_1_video): ?>
                    <a class="btn btn-primary" href="<?php echo esc_url($about_1_video); ?>" data-fancybox>
                        <div class="icon"><i class="fa-regular fa-play"></i></div>
                        <span><?php _e('Xem video', 'canhcamtheme'); ?></span>
                    </a>
                    <?php endif; ?>
                </div>
            </div>
            <div class="col-right">
                <?php if ($about_1_images): ?>
                <div class="wrap-img grid grid-cols-2 gap-base">
                    <?php foreach ($about_1_images as $index => $img): 
                        if ($index > 1) break; // Limit to 2
                    ?>
                    <div class="img img-ratio ratio:pt-[500_320] rounded-5">
                        <?php echo get_image_attrachment($img, 'image'); ?>
                    </div>
                    <?php endforeach; ?>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>
<?php endif; ?>

<?php
// ===========================
// SECTION 2: Tầm Nhìn
// ===========================
$about_2_bg = get_field('about_2_bg'); // URL
$about_2_title = get_field('about_2_title');
$about_2_desc = get_field('about_2_desc');
?>
<?php if ($about_2_desc): ?>
<section class="about-2 section-py" <?php if($about_2_bg) echo 'setBackground="'.esc_url($about_2_bg).'"'; ?>>
    <div class="container">
        <div class="wrapper rem:max-w-[1171px] w-full text-center mx-auto">
            <?php if ($about_2_title): ?>
                <h2 class="title mb-base"><?php echo esc_html($about_2_title); ?></h2>
            <?php endif; ?>
            <div class="desc body-1 font-normal">
                <p><?php echo nl2br(esc_html($about_2_desc)); ?></p>
            </div>
        </div>
    </div>
</section>
<?php endif; ?>

<?php
// ===========================
// SECTION 3: Sứ Mệnh
// ===========================
$about_3_image = get_field('about_3_image');
$about_3_title = get_field('about_3_title');
$about_3_content = get_field('about_3_content');
?>
<?php if ($about_3_content): ?>
<section class="about-3 section-py">
    <div class="container">
        <div class="wrapper grid lg:grid-cols-[49.29%_1fr] grid-cols-1 items-center xl:gap-20 gap-base">
            <div class="col-left">
                <?php if ($about_3_image): ?>
                <div class="img">
                    <a class="img-ratio ratio:pt-[388_690] rounded-5" href="javascript:void(0);">
                        <?php echo get_image_attrachment($about_3_image, 'image'); ?>
                    </a>
                </div>
                <?php endif; ?>
            </div>
            <div class="col-right">
                <?php if ($about_3_title): ?>
                    <h3 class="title heading-1 font-bold text-Primary-2 mb-base"><?php echo esc_html($about_3_title); ?></h3>
                <?php endif; ?>
                <div class="format-content body-1 font-normal">
                    <?php echo $about_3_content; ?>
                </div>
            </div>
        </div>
    </div>
</section>
<?php endif; ?>

<?php
// ===========================
// SECTION 4: Triết Lý Kinh Doanh
// ===========================
$about_4_bg = get_field('about_4_bg'); // URL
$about_4_title = get_field('about_4_title');
$about_4_subtitle = get_field('about_4_subtitle');
$about_4_items = get_field('about_4_items');
?>
<?php if ($about_4_items): ?>
<section class="about-4 xl:rem:pb-[58px] xl:rem:pt-[80px] py-10" <?php if($about_4_bg) echo 'setBackground="'.esc_url($about_4_bg).'"'; ?>>
    <div class="container">
        <div class="wrap-title">
            <div class="title heading-1 text-white font-bold mb-6"><?php echo esc_html($about_4_title); ?></div>
            <div class="title-linear"><?php echo esc_html($about_4_title); ?></div>
        </div>
        <?php if ($about_4_subtitle): ?>
            <div class="sub-title text-white font-bold"><?php echo esc_html($about_4_subtitle); ?></div>
        <?php endif; ?>
        
        <div class="wrapper grid lg:grid-cols-5 md:grid-cols-3 grid-cols-2 gap-base xl:rem:mt-[180px] mt-base">
            <?php foreach ($about_4_items as $item): ?>
            <div class="item text-white">
                <div class="number rem:text-[60px] font-bold mb-4"><?php echo esc_html($item['number']); ?></div>
                <h3 class="title heading-3 mb-4 font-bold"><?php echo esc_html($item['title']); ?></h3>
                <div class="desc body-1 font-normal text-justify">
                    <p><?php echo nl2br(esc_html($item['desc'])); ?></p>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<?php endif; ?>

<?php
// ===========================
// SECTION 5: Lịch sử hình thành
// ===========================
$about_5_title = get_field('about_5_title');
$about_5_items = get_field('about_5_items');
?>
<?php if ($about_5_items): ?>
<section class="about-5 section-py !pb-0">
    <div class="wrapper">
        <div class="container">
            <?php if ($about_5_title): ?>
                <h2 class="title heading-1 text-Primary-2 font-bold mb-base text-center"><?php echo esc_html($about_5_title); ?></h2>
            <?php endif; ?>
            
            <div class="thumb mb-base">
                <div class="wrap-slide-years">
                    <div class="relative">
                        <div class="swiper history-swiper">
                            <div class="swiper-wrapper">
                                <?php foreach ($about_5_items as $item): ?>
                                <div class="swiper-slide">
                                    <div class="item-history flex flex-col items-center gap-8">
                                        <div class="wrap">
                                            <div class="line-year">
                                                <div class="circle rem:w-[32px] rem:h-[32px] rounded-full border border-transparent">
                                                    <div class="dot"></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="content">
                                            <div class="number"><?php echo esc_html($item['year']); ?></div>
                                        </div>
                                    </div>
                                </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="main relative mt-base">
                <div class="swiper">
                    <div class="swiper-wrapper">
                        <?php foreach ($about_5_items as $item): ?>
                        <div class="swiper-slide">
                            <div class="box xl:p-10 p-4 bg-white">
                                <div class="item grid lg:grid-cols-[42.42%_57.58%] xl:gap-12 gap-base">
                                    <div class="col-left">
                                        <?php if ($item['image']): ?>
                                        <div class="img">
                                            <a class="img-ratio ratio:pt-[373_560] rounded-5" href="javascript:void(0);">
                                                <?php echo get_image_attrachment($item['image'], 'image'); ?>
                                            </a>
                                        </div>
                                        <?php endif; ?>
                                    </div>
                                    <div class="col-right">
                                        <div class="format-content body-1">
                                            <div class="year heading-2 text-Primary-2 font-bold mb-3"><?php echo esc_html($item['year']); ?></div>
                                            <?php echo $item['content']; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
                <div class="wrap-button-slide drop">
                    <div class="btn btn-prev btn-sw-1"></div>
                    <div class="btn btn-next btn-sw-1"></div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php endif; ?>

<?php
// ===========================
// SECTION 6: Công Trình KH-KT
// ===========================
$about_6_bg = get_field('about_6_bg'); // URL
$about_6_title = get_field('about_6_title');
$about_6_table = get_field('about_6_table');

$about_6_heritage_title = get_field('about_6_heritage_title');
$about_6_heritage_content = get_field('about_6_heritage_content');
$about_6_heritage_image = get_field('about_6_heritage_image');
?>
<?php if ($about_6_table || $about_6_heritage_content): ?>
<section class="about-6 section-py" <?php if($about_6_bg) echo 'setBackground="'.esc_url($about_6_bg).'"'; ?>>
    <div class="container">
        <?php if ($about_6_title): ?>
            <h2 class="title text-center mb-base"><?php echo esc_html($about_6_title); ?></h2>
        <?php endif; ?>
        
        <div class="infos">
            <?php if ($about_6_table): ?>
            <div class="wrap-table rounded-5 overflow-hidden">
                <div class="about-6-table table-responsive">
                    <table>
                        <thead>
                            <tr>
                                <td class="text-center rem:w-[80px]"><?php _e('STT', 'canhcamtheme'); ?></td>
                                <td class="lg:rem:w-[349px] rem:w-[260px]"><?php _e('Công trình/ Sản phẩm', 'canhcamtheme'); ?></td>
                                <td class="text-center rem:w-[149px]"><?php _e('Năm', 'canhcamtheme'); ?></td>
                                <td class="text-center"><?php _e('Ý nghĩa', 'canhcamtheme'); ?></td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($about_6_table as $index => $row): 
                                $product_obj = $row['product'];
                                $product_link = $product_obj ? get_permalink($product_obj->ID) : '#';
                                $product_title = $product_obj ? get_the_title($product_obj->ID) : '';
                            ?>
                            <tr>
                                <td class="text-center p-3"><?php echo $index + 1; ?></td>
                                <td>
                                    <?php if ($product_obj): ?>
                                        <a class="recruitment-link" href="<?php echo esc_url($product_link); ?>"><?php echo esc_html($product_title); ?></a>
                                    <?php endif; ?>
                                </td>
                                <td class="text-center"><?php echo esc_html($row['year']); ?></td>
                                <td class="text-center"><?php echo nl2br(esc_html($row['meaning'])); ?></td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <?php endif; ?>

            <div class="wrapper-main grid lg:grid-cols-2 grid-cols-1 items-center xl:gap-0 gap-base xl:mt-20 mt-base">
                <div class="col-left xl:rem:pr-[58px]">
                    <?php if ($about_6_heritage_title): ?>
                        <h2 class="title mb-base"><?php echo esc_html($about_6_heritage_title); ?></h2>
                    <?php endif; ?>
                    <div class="format-content body-1">
                        <?php echo $about_6_heritage_content; ?>
                    </div>
                </div>
                <div class="col-right xl:rem:pl-[10px]">
                    <?php if ($about_6_heritage_image): ?>
                    <div class="img img-ratio ratio:pt-[388_690] rounded-5">
                        <?php echo get_image_attrachment($about_6_heritage_image, 'image'); ?>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</section>
<?php endif; ?>

<?php
// ===========================
// SECTION 7: Nền Tảng Phát Triển Bền Vững
// ===========================
$about_7_title = get_field('about_7_title');
$about_7_content = get_field('about_7_content');
$about_7_img_1 = get_field('about_7_img_1');
$about_7_img_2 = get_field('about_7_img_2');
$about_7_img_3 = get_field('about_7_img_3');
?>
<?php if ($about_7_content): ?>
<section class="about-7 section-py">
    <div class="container">
        <div class="wrapper flex flex-col gap-base">
            <div class="wrap-top grid lg:grid-cols-2 grid-cols-1 gap-base">
                <div class="col-left">
                    <?php if ($about_7_title): ?>
                        <h2 class="title mb-base"><?php echo esc_html($about_7_title); ?></h2>
                    <?php endif; ?>
                    <div class="format-content body-1 text-justify">
                        <?php echo $about_7_content; ?>
                    </div>
                </div>
                <div class="col-right">
                    <?php if ($about_7_img_1): ?>
                    <div class="img img-ratio ratio:pt-[596_680]">
                        <?php echo get_image_attrachment($about_7_img_1, 'image'); ?>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
            <div class="wrap-bottom grid lg:grid-cols-2 grid-cols-1 gap-base">
                <div class="col-left">
                    <?php if ($about_7_img_2): ?>
                    <div class="img img-ratio ratio:pt-[616_680]">
                        <?php echo get_image_attrachment($about_7_img_2, 'image'); ?>
                    </div>
                    <?php endif; ?>
                </div>
                <div class="col-right">
                    <?php if ($about_7_img_3): ?>
                    <div class="img img-ratio ratio:pt-[616_680]">
                        <?php echo get_image_attrachment($about_7_img_3, 'image'); ?>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</section>
<?php endif; ?>

<?php get_footer(); ?>