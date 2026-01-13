<?php get_header(); ?>

<?php get_template_part('modules/common/breadcrumb'); ?>

<section class="recruit-detail pad-8">
    <div class="container"> 
        <div class="grid grid-cols-12 gap-10">
            <div class="col-span-12 lg:col-span-8">
                <div class="info-wrap block  lg:p-10 bg-grey-50 p-6 mb-10">
                    <h2 class="heading-1 mb-6 lg:mb-10 text-primary-1"><?php the_title(); ?></h2>
                    <div class="row"> 
                        <div class="col w-full">
                            <div class="img zoom-in overflow-hidden"><a class="img-ratio ratio:pt-[300_360]"><img class="lozad" src="<?php echo get_image_post(get_the_ID(),"url"); ?>" alt="<?php the_title(); ?>" loading="lazy"/></a></div>
                        </div>
                        <div class="col w-full">
                            <?php $career_information = get_field('career_information'); ?>
                            <div class="table-wrap">
                                <table> 
                                    <tbody>
                                        <?php if($career_information['other_information']): ?>
                                            <?php foreach($career_information['other_information'] as $item): ?>
                                                <tr>
                                                    <td><?php echo $item['label']; ?></td>
                                                    <td><?php echo $item['text']; ?></td>
                                                </tr>
                                            <?php endforeach; ?>
                                        <?php endif; ?>
                                        <?php if($career_information['application_deadline']): ?>
                                            <tr>
                                                <td><?php _e('Hạn nộp hồ sơ', 'canhcamtheme'); ?></td>
                                                <td><?php echo $career_information['application_deadline']; ?></td>
                                            </tr>
                                        <?php endif; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <?php if(get_field('block_content')): ?>
                    <?php foreach(get_field('block_content') as $block_content): ?>
                        <div class="block-wrap bg-grey-50 p-6 lg:p-10 mb-10 last:mb-0">
                            <h3 class="heading-2 mb-5 text-primary-1"><?php echo $block_content['title']; ?></h3>
                            <div class="fullcontent">
                                <?php echo $block_content['content']; ?>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
            <div class="col-span-12 lg:col-span-4">
                <?php if(get_field('career_setting','option')): ?>
                    <?php
                    $career_setting = get_field('career_setting','option');
                    $career_form = $career_setting['career_form'];
                    $career_file = $career_setting['career_file'];
                    ?>
                    <div class="btn-group bg-grey-50 p-6 w-full mb-10">
                        <?php if($career_form): ?>
                            <a class="btn w-full btn-primary mb-3" href="#recruit-modal" data-fancybox>
                                <span><?php _e('Ứng tuyển', 'canhcamtheme'); ?></span>
                                <em class="fa-regular fa-plus"></em>
                            </a>
                        <?php endif; ?>
                        <?php if($career_file): ?>
                            <a class="btn w-full btn-primary white" href="<?php echo $career_file['url']; ?>" download>
                                <span><?php _e('Tải hồ sơ ứng tuyển', 'canhcamtheme'); ?></span>
                                <em class="fa-regular fa-file-download"></em>
                            </a>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>
                <div class="other-recruit">
                    <div class="tilte-wrap bg-primary-1 p-5">
                        <h3 class="heading-2 text-white"><?php _e('Các vị trí khác', 'canhcamtheme'); ?></h3>
                    </div>
                    <div class="wrap bg-grey-50">
                        <?php
                        $args = array(
                            'post_type' => 'tuyen-dung',
                            'posts_per_page' => 4,
                            'post__not_in' => array(get_the_ID()),
                            'orderby' => 'date',
                            'order' => 'DESC'
                        );
                        $related_jobs = new WP_Query($args);
                        if ($related_jobs->have_posts()) :
                            while ($related_jobs->have_posts()) : $related_jobs->the_post();
                                $application_deadline = get_field('career_information')['application_deadline'];
                        ?>
                        <div class="recruit-item group border-b overflow-hidden p-6">
                            <div class="txt col-hor">
                                <h3 class="mb-3"><a href="<?php the_permalink(); ?>" class="body-1 group-hover:underline"><?php the_title(); ?></a></h3>
                                <?php if($application_deadline): ?>
                                <div class="timeline text-lg text-grey-500"><em class="fa-regular fa-calendar-star"></em><span>Hạn nộp hồ sơ:</span><strong class="inline-block text-primary-1"><?php echo $application_deadline; ?></strong></div>
                                <?php endif; ?>
                            </div>
                        </div>
                        <?php
                            endwhile;
                            wp_reset_postdata();
                        else:
                        ?>
                        <div class="p-6 text-center">
                            <p><?php _e('Không có vị trí tuyển dụng khác', 'canhcamtheme'); ?></p>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php if(get_field('career_setting','option')): ?>
    <?php
    $career_setting = get_field('career_setting','option');
    $career_form = $career_setting['career_form'];
    ?>
    <?php if($career_form): ?>
        <div class="popup-modal recruit-modal hidden" id="recruit-modal">
            <div class="popup-modal-wrap">
                <h2 class="form-title text-center text-primary-1 font-bold"><?php the_title(); ?></h2>
                <div class="desc my-4 text-center body-1"><?php _e('Vui lòng điền thông tin vào form dưới đây để nhận tư vấn nhanh chóng. Chúng tôi sẽ liên hệ lại với bạn trong thời gian sớm nhất để hỗ trợ giải đáp thắc mắc.', 'canhcamtheme'); ?></div>
                <?php echo do_shortcode($career_form); ?>
            </div>
        </div>
    <?php endif; ?>

<?php endif; ?>


<?php get_footer(); ?>