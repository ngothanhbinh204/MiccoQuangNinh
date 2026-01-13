<?php
$background = get_sub_field('background');
$title = get_sub_field('title');
$button = get_sub_field('button');
$items = get_sub_field('items');
?>
<section class="home-recruit nav-blue" setBackground="<?php echo $background['url']; ?>">
    <div class="container">
        <div class="title-wrap md:flex-between mb-10">
            <?php if($title) : ?>
                <h2 class="heading-1-up text-center " data-aos="fade-right" data-aos-easing="ease-in-out-back" data-aos-delay="0" data-aos-duration="900"><?php echo $title; ?></h2>
            <?php endif; ?>
            <?php if($button) : ?>
                <div class="btn-wrap max-md:hidden" data-aos="fade-left" data-aos-easing="ease-in-out-back" data-aos-delay="0" data-aos-duration="900">
                    <a class="btn btn-primary" href="<?php echo $button['url']; ?>" target="<?php echo $button['target']; ?>"><span><?php echo $button['title']; ?></span><em class="fa-regular fa-plus"></em></a>
                </div>
            <?php endif; ?>
        </div>
        <div class="row"> 
            <div class="col w-full">
                <?php foreach($items as $item) : ?>
                    <div class="recruit-news bg-white p-5 group">
                        <div class="img zoom-in overflow-hidden"><a><img class="lozad" src="<?php echo $item['image']['url']; ?>" alt="<?php echo $item['image']['alt']; ?>" loading="lazy"/></a></div>
                        <div class="txt sm:ml-10 max-sm:pt-6">
                            <h3><a class="heading-2 text-primary-1 mb-2 flex-start group-hover:text-primary-2"><?php echo $item['title']; ?></a></h3>
                            <div class="desc body-1 line-clamp-3"><?php echo $item['description']; ?></div>
                        </div>
                    </div>
                <?php endforeach; ?>

            </div>
            <div class="col w-full">
                <div class="block-wrap bg-primary-1 h-full p-6">
                    <h4 class="heading-2 uppercase text-white mb-6 uppercase"><?php _e('TIN TUYỂN DỤNG MỚI NHẤT', 'canhcamtheme'); ?></h4>
                    <div class="scrollbar-wrap white grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-1">
                        <?php
                        $args = array(
                            'post_type' => 'tuyen-dung',
                            'posts_per_page' => 8,
                            'orderby' => 'date',
                            'order' => 'DESC'
                        );
                        
                        $query = new WP_Query($args);
                        
                        if ($query->have_posts()) :
                            while ($query->have_posts()) : $query->the_post();
                            $career_information = get_field('career_information');
                            $application_deadline = $career_information['application_deadline'];
                            ?>
                            <div class="recruit-item relative p-4 group lg:py-3 border-t border-white border-opacity-50 transition hover:bg-secondary-bg">
                                <div class="text">
                                    <h3><a href="<?php the_permalink(); ?>" class="heading-4 text-white group-hover:text-primary-1 transition"><?php the_title(); ?></a></h3>
                                    <time class="text-white mt-2 group-hover:text-primary-1 transition"><?php echo $application_deadline; ?></time>
                                </div>
                            </div>
                        <?php
                            endwhile;
                            wp_reset_postdata();
                        endif;
                        ?>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>