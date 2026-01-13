<?php 
$title = get_sub_field('title');
$button = get_sub_field('button');
$highlight_post = get_sub_field('highlight_post');
$other_post = get_sub_field('other_post');
?>
<section class="home-news bg-secondary-bg nav-blue">
    <div class="container">
        <div class="title-wrap md:flex-between mb-10">
            <?php if($title): ?>
                <h2 class="heading-1-up text-center " data-aos="fade-right" data-aos-easing="ease-in-out-back" data-aos-delay="0" data-aos-duration="900"><?php echo $title; ?></h2>
            <?php endif; ?>
            <?php if($button): ?>
            <div class="btn-wrap max-md:hidden" data-aos="fade-left" data-aos-easing="ease-in-out-back" data-aos-delay="0" data-aos-duration="900">
                <a class="btn btn-primary" href="<?php echo $button['url']; ?>" target="<?php echo $button['target']; ?>"><span><?php echo $button['title']; ?></span><em class="fa-regular fa-plus"></em></a>
            </div>
            <?php endif; ?>
        </div>
        <div class="row"> 
            <div class="col w-full lg:w-9/12">
                <?php
                if($highlight_post):
                    ?>
                    <div class="news-big text-white bg-primary-1 flex-start group" data-aos="fade-right" data-aos-easing="ease-in-out-back" data-aos-delay="0" data-aos-duration="900">
                        <div class="img zoom-in overflow-hidden"><a href="<?php echo get_permalink($highlight_post[0]->ID); ?>"><img class="lozad" src="<?php echo get_the_post_thumbnail_url($highlight_post[0]->ID, 'large'); ?>" alt="<?php echo get_the_title($highlight_post[0]->ID); ?>" loading="lazy"/></a></div>
                        <div class="txt col-left h-full p-6 lg:px-7">
                            <time class="text-white mb-5"><?php echo get_the_date('d.m.Y', $highlight_post[0]->ID); ?></time>
                            <div class="title pb-5 mb-5 border-b border-white border-opacity-20"><a href="<?php echo get_permalink($highlight_post[0]->ID); ?>" class="text-lg uppercase font-bold line-clamp-3 group-hover:underline"><?php echo get_the_title($highlight_post[0]->ID); ?></a></div>
                            <div class="desc text-15 leading-140 scrollbar-wrap"><?php echo wp_trim_words(get_the_excerpt($highlight_post[0]->ID), 25, '...'); ?></div>
                        </div>
                    </div>
                <?php else :
                    $args = array(
                        'post_type' => 'post',
                        'posts_per_page' => 1,
                        'orderby' => 'date',
                        'order' => 'DESC'
                    );
                    $latest_post = new WP_Query($args);
                    if ($latest_post->have_posts()) :
                        while ($latest_post->have_posts()) : $latest_post->the_post();
                            $post_date = get_the_date('d.m.Y');
                            $post_title = get_the_title();
                            $post_excerpt = wp_trim_words(get_the_excerpt(), 25, '...');
                            $post_link = get_permalink();
                            $thumbnail = get_the_post_thumbnail_url(get_the_ID(), 'large') ?: 'https://picsum.photos/1920/1080?nature=1';
                            ?>
                            <div class="news-big text-white bg-primary-1 flex-start group" data-aos="fade-right" data-aos-easing="ease-in-out-back" data-aos-delay="0" data-aos-duration="900">
                                <div class="img zoom-in overflow-hidden"><a href="<?php echo $post_link; ?>"><img class="lozad" src="<?php echo $thumbnail; ?>" alt="<?php echo $post_title; ?>" loading="lazy"/></a></div>
                                <div class="txt col-left h-full p-6 lg:px-7">
                                    <time class="text-white mb-5"><?php echo $post_date; ?></time>
                                    <div class="title pb-5 mb-5 border-b border-white border-opacity-20"><a href="<?php echo $post_link; ?>" class="text-lg uppercase font-bold line-clamp-3 group-hover:underline"><?php echo $post_title; ?></a></div>
                                    <div class="desc text-15 leading-140 scrollbar-wrap"><?php echo $post_excerpt; ?></div>
                                </div>
                            </div>
                            <?php
                        endwhile;
                        wp_reset_postdata();
                    endif;
                endif;
                ?>
            </div>
            <div class="col w-full lg:w-3/12">
                <div class="grid grid-cols-2 lg:grid-cols-1 gap-6" data-aos="fade-left" data-aos-easing="ease-in-out-back" data-aos-delay="0" data-aos-duration="900">
                    <?php
                    if($other_post):
                        foreach($other_post as $post):
                            $post_date = get_the_date('d.m.Y', $post->ID);
                            $post_title = get_the_title($post->ID);
                            $post_link = get_permalink($post->ID);
                            $thumbnail = get_the_post_thumbnail_url($post->ID, 'full') ?: 'https://picsum.photos/1920/1080?nature=1';
                            ?>
                            <div class="side-news relative">
                                    <div class="img zoom-in overflow-hidden"><a href="<?php echo $post_link; ?>"><img class="lozad" src="<?php echo $thumbnail; ?>" alt="<?php echo $post_title; ?>" loading="lazy"/></a></div>
                                    <div class="txt absolute-x bottom-0 z-50 p-4 lg:py-6">
                                        <time class="text-white mb-2"><?php echo $post_date; ?></time>
                                        <h3 class="heading-5 text-white"><a href="<?php echo $post_link; ?>"><?php echo $post_title; ?></a></h3>
                                    </div>
                                </div>
                            <?php
                        endforeach;
                        wp_reset_postdata();
                    else :
                        $args = array(
                            'post_type' => 'post',
                            'posts_per_page' => 2,
                            'offset' => 1,
                            'orderby' => 'date',
                            'order' => 'DESC'
                        );
                        $more_posts = new WP_Query($args);
                        if ($more_posts->have_posts()) :
                            while ($more_posts->have_posts()) : $more_posts->the_post();
                                $post_date = get_the_date('d.m.Y');
                                $post_title = get_the_title();
                                $post_link = get_permalink();
                                $thumbnail = get_the_post_thumbnail_url(get_the_ID(), 'full') ?: 'https://picsum.photos/1920/1080?nature=1';
                                ?>
                                <div class="side-news relative">
                                    <div class="img zoom-in overflow-hidden"><a href="<?php echo $post_link; ?>"><img class="lozad" src="<?php echo $thumbnail; ?>" alt="<?php echo $post_title; ?>" loading="lazy"/></a></div>
                                    <div class="txt absolute-x bottom-0 z-50 p-4 lg:py-6">
                                        <time class="text-white mb-2"><?php echo $post_date; ?></time>
                                        <h3 class="heading-5 text-white"><a href="<?php echo $post_link; ?>"><?php echo $post_title; ?></a></h3>
                                    </div>
                                </div>
                            <?php
                            endwhile;
                            wp_reset_postdata();
                        endif;
                    endif;
                    ?>
                </div>
            </div>
        </div>
    </div>
</section>