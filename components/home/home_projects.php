<?php
$title = get_sub_field('title');
$button = get_sub_field('button');
$projects = get_sub_field('projects');
?>
<section class="home-project-sample flex-card-section relative nav-white section-blue">
    <div class="container  max-lg:text-center absolute-x top-0 pointer-events-none z-50 transition pt-10 lg:rem:pt-[200px]">
        <div class="title-wrap max-lg:col-left">
            <?php if($title) : ?>
                <h2 class="heading-1-up max-md:text-center mb-10 text-white" data-aos="fade-down" data-aos-easing="ease-in-out-back" data-aos-delay="0" data-aos-duration="900"><?= $title; ?></h2>
            <?php endif; ?>
            <?php if($button) : ?>
                <div class="btn-wrap" data-aos="fade-up" data-aos-easing="ease-in-out-back" data-aos-delay="0" data-aos-duration="900">
                    <a class="btn btn-primary white" href="<?= $button['url']; ?>"><span><?= $button['title']; ?></span><em class="fa-regular fa-plus"></em></a>
                </div>
            <?php endif; ?>
        </div>
    </div>
    <?php if($projects) : ?>
        <div class="flex-options">
            <?php foreach($projects as $index => $project) : ?>
                <?php 
                    $thumbnail = get_the_post_thumbnail_url($project->ID, 'full');
                    $title = get_the_title($project->ID);
                    $short_title = get_field('short_title', $project->ID);
                    $project_information = get_field('project_information', $project->ID);
                    $location = $project_information['location'];
                ?>
                <div class="card-option <?php echo $index == 0 ? 'active' : ''; ?>">
                    <div class="card-label">
                        <div class="item relative">
                            <div class="img-wrap" data-aos="fade-zoom-in" data-aos-easing="ease-in-out" data-aos-delay="100" data-aos-duration="750">
                                <a href="<?php echo get_the_permalink($project->ID); ?>"><img src="<?php echo $thumbnail; ?>" alt="<?php echo $title; ?>"></a>
                            </div>
                            <div class="txt col-end">
                                <div class="headline">
                                    <div class="heading-1 text-white mb-2"><?php echo $short_title; ?></div>
                                    <?php if($location) : ?><span class="body-4 text-white sub-title"><?php echo $location; ?></span><?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        <div class="two-swiper init-swiper">
            <div class="swiper"> 
                <div class="swiper-wrapper"> 
                    <?php foreach($projects as $index => $project) : ?>
                        <?php 
                            $thumbnail = get_the_post_thumbnail_url($project->ID, 'full');
                            $title = get_the_title($project->ID);
                            $short_title = get_field('short_title', $project->ID);
                            $project_information = get_field('project_information', $project->ID);
                            $location = $project_information['location'];
                        ?>
                        <div class="swiper-slide"> 
                            <div class="item relative">
                                <div class="img-wrap zoom-in"><a href="<?php echo get_the_permalink($project->ID); ?>"><img src="<?php echo $thumbnail; ?>" alt="<?php echo $title; ?>"></a></div>
                                <div class="txt col-end">
                                    <h3 class="heading-1 text-white"><a><?php echo $short_title; ?></a><span><?php echo $location; ?></span></h3>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
            <div class="swiper-pagination normal-pagination mt-8"></div>
        </div>
    <?php endif; ?>
</section>