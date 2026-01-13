<?php get_header(); ?>

<?php $term = get_queried_object(); ?>

<?php 
$banner = get_field('banner_tuyen_dung', $term);
$background = $banner['background'];
$title = $banner['title'];
$description = $banner['description'];
$highlight_text = $banner['highlight_text'];
?>
<section class="top-banner relative overflow-hidden">
    <div class="img-bg overflow-hidden max-lg:relative lg:absolute z-20 lg:right-0 lg:bottom-0">
        <a><?php echo get_image_attrachment($background, 'image'); ?></a>
    </div>
    <div class="container relative z-50">
        <div class="row"> 
            <div class="col w-full lg:w-1/2">
                <div class="txt-wrap lg:pr-18 ">
                    <?php get_template_part('modules/common/breadcrumb'); ?>
                    <h2 class="heading-1-up pt-8 mb-6 lg:pt-12 max-lg:text-center"><?php echo $title ? $title : $term->name; ?></h2>
                    <?php if($description): ?>
                        <div class="zone-desc body-1">
                            <?php echo $description; ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
            <div class="col w-full lg:w-1/2"></div>
        </div>
    </div>
</section>

<?php if($highlight_text): ?>
    <section class="recruit-banner pad-6 bg-primary-1 relative overflow-hidden">
        <h2 class="heading-2 italic text-white text-center"><?php echo $highlight_text; ?></h2>
    </section>
<?php endif; ?>

<?php if(get_field('block_content_tuyen_dung',$term)): ?>
    <?php
    $block_content = get_field('block_content_tuyen_dung',$term);
    ?>
    <section class="recruit-1 relative overflow-hidden">
        <?php foreach($block_content as $item): ?>
            <?php
            $image = $item['image'];
            $title = $item['title'];
            $description = $item['description'];
            ?>
            <div class="container-fluid bg-grey-50">
                <div class="row"> 
                    <div class="col w-full lg:w-1/2">
                        <div class="img zoom-in overflow-hidden flex-center w-full">
                            <a class="overflow-hidden w-full">
                                <?php echo get_image_attrachment($image, 'image'); ?>
                            </a>
                        </div>
                    </div>
                    <div class="col w-full lg:w-1/2">
                        <div class="txt lg:pl-10 2xl:pl-20  rem:lg:max-w-[760px] rem:xl:max-w-[790px] rem:2xl:max-w-[700px] h-full col-left">
                            <h2 class="heading-1-up mb-10 text-primary-1"><?php echo $title; ?></h2>
                            <div class="scrollbar-wrap">
                                <div class="fullcontent">
                                    <?php echo $description; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </section>
<?php endif; ?>

<?php if(get_field('training_tuyen_dung',$term)): ?>
    <?php 
    $training = get_field('training_tuyen_dung',$term);
    $title = $training['title'];
    $items = $training['items'];
    ?>
    <section class="recruit-2 relative overflow-hidden pad-8">
        <div class="container">
            <h2 class="heading-1-up mb-10 text-primary-1 text-center"><?php echo $title; ?></h2>
            <div class="auto-3 init-swiper">
                <div class="swiper">
                    <div class="swiper-wrapper max-lg:mb-10">
                        <?php foreach($items as $item): ?>
                            <div class="swiper-slide">
                                <div class="item overflow-hidden bg-grey-50">
                                    <div class="img zoom-in overflow-hidden">
                                        <a class="img-ratio ratio:pt-[248_440]">
                                            <?php echo get_image_attrachment($item['image'], 'image'); ?>
                                        </a>
                                    </div>
                                    <div class="txt p-6 text-center lg:py-10">
                                        <h2 class="heading-2 uppercase text-primary-1"><?php echo $item['title']; ?></h2>
                                        <div class="desc my-6 desc-content"><?php echo $item['description']; ?></div>
                                        <div class="btn-wrap flex-center">
                                            <a class="btn btn-tertiary toggle-desc">
                                                <span class="read-more-text"><?php _e('Xem thêm', 'canhcamtheme'); ?></span>
                                                <span class="read-less-text hidden"><?php _e('Thu gọn', 'canhcamtheme'); ?></span>
                                                <em class="fa-light fa-chevron-right"></em>
                                            </a>
                                        </div>
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
    
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const toggleButtons = document.querySelectorAll('.toggle-desc');
        
        toggleButtons.forEach(button => {
            button.addEventListener('click', function() {
                const descContainer = this.closest('.txt').querySelector('.desc');
                const readMoreText = this.querySelector('.read-more-text');
                const readLessText = this.querySelector('.read-less-text');
                
                if (descContainer.classList.contains('desc-expanded')) {
                    // Collapse
                    descContainer.classList.remove('desc-expanded');
                    readMoreText.classList.remove('hidden');
                    readLessText.classList.add('hidden');
                } else {
                    // Expand
                    descContainer.classList.add('desc-expanded');
                    readMoreText.classList.add('hidden');
                    readLessText.classList.remove('hidden');
                }
            });
        });
    });
    </script>
    
    <style>
    
    .recruit-2 .desc.desc-expanded {
        display: block;
        height: auto;
        -webkit-line-clamp: unset;
    }
    
    .hidden {
        display: none;
    }
    </style>
<?php endif; ?>

<?php
$recruit_list = get_field('career_list',$term);
$title = $recruit_list['title'];
$description = $recruit_list['description'];
?>
<section class="recruit-list pad-8 bg-grey-50">
    <div class="container">
        <h2 class="heading-1-up mb-3 text-center"><?php echo $title ? $title : __('Danh sách vị trí đang tuyển dụng', 'canhcamtheme'); ?></h2>
        <?php if($description): ?>
            <div class="body-1 text-center mb-10"><?php echo $description; ?></div>
        <?php endif; ?>
        <div class="filter-table-wrap">
            <div class="table-wrap">
                <table>
                    <thead>
                        <tr>
                            <th><?php _e('STT', 'canhcamtheme'); ?></th>
                            <th><?php _e('VỊ TRÍ ỨNG TUYỂN ', 'canhcamtheme'); ?></th>
                            <th><?php _e('KHU VỰC', 'canhcamtheme'); ?></th>
                            <th><?php _e('HẠN NỘP HỒ SƠ', 'canhcamtheme'); ?></th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody id="career-list" data-per-page="10">
                        <?php
                        $args = array(
                            'post_type' => 'tuyen-dung',
                            'posts_per_page' => -1,
                            'post_status' => 'publish',
                            'paged' => 1,
                            'tax_query' => array(
                                array(
                                    'taxonomy' => 'tuyen-dung-category',
                                    'field' => 'term_id',
                                    'terms' => $term->term_id,
                                ),
                            ),
                        );
                        $query = new WP_Query($args);
                        $count = 1;
                        if ($query->have_posts()) :
                            while ($query->have_posts()) : $query->the_post();
                                $information = get_field('career_information');
                                $location = $information['location'];
                                $deadline = $information['application_deadline'];
                                ?>
                                <tr>
                                    <td data-attr="STT "><?php echo sprintf("%02d", $count); ?></td>
                                    <td data-attr="Vị trí "><a class="title" href="<?php the_permalink(); ?>"><?php the_title(); ?></a></td>
                                    <td data-attr="NƠI LÀM VIỆC"><?php echo $location ? $location : ''; ?></td>
                                    <td data-attr="hạn nộp hồ sơ"><?php echo $deadline ? $deadline : ''; ?></td>
                                    <td>
                                        <div class="flex-center btn-wrap"> <a class="btn btn-tertiary" href="<?php the_permalink(); ?>"><em class="fa-light fa-eye"></em><span><?php _e('Xem chi tiết', 'canhcamtheme'); ?></span></a></div>
                                    </td>
                                </tr>
                                <?php
                                $count++;
                            endwhile;
                            wp_reset_postdata();
                        endif;
                        ?>

                    </tbody>
                    
                </table>
            </div>
            <?php
            // $term_posts_count = new WP_Query(array(
            //     'post_type' => 'tuyen-dung',
            //     'posts_per_page' => -1,
            //     'post_status' => 'publish',
            //     'fields' => 'ids',
            //     'tax_query' => array(
            //         array(
            //             'taxonomy' => 'tuyen-dung-category',
            //             'field' => 'term_id',
            //             'terms' => $term->term_id,
            //         ),
            //     ),
            // ));
            // $total_posts = count($term_posts_count->posts);
            // if ($total_posts > 10) :
            ?>
            <div class="ajax-btn-wrap mx-auto w-fit pt-9" id="load-more-container">
                <a class="btn btn-primary down btn-load-more" id="load-more-btn" data-taxonomy="tuyen-dung-category" data-term-id="<?php echo $term->term_id; ?>"><span><?php _e('Xem thêm', 'canhcamtheme'); ?></span><em class="fa-regular fa-chevron-down"></em></a>
            </div>
            <?php 
            // endif; 
            // ?>
            
        </div>
    </div>
</section>

<?php get_footer(); ?>
