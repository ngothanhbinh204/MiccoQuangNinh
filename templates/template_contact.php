<?php
/**
 * Template Name: Liên hệ
 */
?>

<?php get_header(); ?>

<?php 
$banner = get_field('banner');
$background = $banner['background'];
$title = $banner['title'];
?>
<section class="top-banner relative overflow-hidden">
    <div class="img-bg overflow-hidden max-lg:relative lg:absolute z-20 lg:right-0 lg:bottom-0"><a><?php echo get_image_attrachment($background, 'image'); ?></a></div>
    <div class="container relative z-50">
        <div class="row"> 
            <div class="col w-full lg:w-1/2">
                <div class="txt-wrap lg:pr-18 ">
                    <?php get_template_part('modules/common/breadcrumb'); ?>
                    <h2 class="heading-1-up pt-8 mb-6 lg:pt-12 max-lg:text-center"><?php echo $title ? $title : get_the_title(); ?></h2>
                </div>
            </div>
            <div class="col w-full lg:w-1/2"></div>
        </div>
    </div>
</section>
<section class="contact-us pad-8 overflow-hidden">
    <div class="container">
        <div class="row">
            <?php if(get_field('form_column')): ?>
                <?php
                $form_column = get_field('form_column');
                $title = $form_column['title'];
                $description = $form_column['description'];
                $form = $form_column['form'];
                ?>
                <div class="col w-full lg:w-6/12">
                    <div class="txt lg:pr-10">
                        <h2 class="heading-1-up mb-4 text-grey-950"><?php echo $title; ?></h2>
                        <div class="fmr-msg mb-5"><?php echo $description; ?></div>
                        <?php if($form): 
                            echo do_shortcode($form);
                        endif; ?>
                    </div>
                </div>
            <?php endif; ?>
            <?php if(get_field('contact_column')): ?>
                <?php
                $contact_column = get_field('contact_column');
                $title = $contact_column['title'];
                $contacts = $contact_column['contacts'];
                ?>
                <div class="col w-full lg:w-5/12">
                    <div class="block-wrap lg:pl-8">
                        <h2 class="heading-1-up mb-10"><?php echo $title; ?></h2>
                        <address>
                            <ul>
                                <?php foreach($contacts as $contact): ?>
                                <li>
                                    <div class="icon"><em class="fa-regular fa-<?php echo $contact['icon']; ?>"></em></div>
                                    <div>
                                        <?php echo $contact['content']; ?>
                                    </div>
                                </li>
                                <?php endforeach; ?>
                            </ul>
                        </address>
                    </div>
                </div>
            <?php endif; ?>
        </div>
        <?php if(get_field('map')): ?>
            <div class="map-wrap mt-10 h-full lg:mt-15">
                <a class="overflow-hidden ">
                    <?php echo get_field('map'); ?>
                </a>
            </div>
        <?php endif; ?>
    </div>
</section>

<?php get_footer(); ?>