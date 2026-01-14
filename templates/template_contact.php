<?php
/**
 * Template Name: Liên hệ
 */
get_header();

$banner = get_field('banner');
$background = $banner['background'] ?? null;
$title = $banner['title'] ?? get_the_title();

get_template_part('modules/common/banner'); 

?>

<main>
    <section class="contact section-py">
        <div class="container">
            <div class="contact-main flex flex-col lg:flex-row xl:gap-20 gap-base">

                <!-- Left: Form -->
                <?php if ($form_column = get_field('form_column')): ?>
                    <div class="col-left lg:rem:w-[680px] w-full">
                        <div class="title heading-2 font-extrabold mb-2">
                            <?php echo esc_html($form_column['title']); ?>
                        </div>

                        <div class="sub-title mb-5">
                            <?php echo wp_kses_post($form_column['description']); ?>
                        </div>

                        <?php
                        if (!empty($form_column['form'])) {
                            echo do_shortcode($form_column['form']);
                        }
                        ?>
                    </div>
                <?php endif; ?>

                <!-- Right: Contact info -->
                <?php if ($contact_column = get_field('contact_column')): ?>
                    <div class="col-right flex-1 lg:p-12 p-5 bg-Utility-50 w-full">
                        <h2 class="heading-2 text-Primary-2 font-extrabold mb-base uppercase">
                            <?php echo esc_html($contact_column['title']); ?>
                        </h2>

                        <?php if (!empty($contact_column['contacts'])): ?>
                            <div class="contact-box">
                                <div class="contact-list flex flex-col gap-5">
                                    <?php foreach ($contact_column['contacts'] as $contact): ?>
                                        <div class="contact-item">
                                            <span class="text-xl text-Primary-2">
                                                <i class="fa-solid fa-<?php echo esc_attr($contact['icon']); ?>"></i>
                                            </span>

                                            <div class="contact-wrap flex flex-col gap-2">
                                                <?php echo wp_kses_post($contact['content']); ?>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>

            </div>

            <!-- Map -->
            <?php if ($map = get_field('map')): ?>
                <div class="map-wrap">
                    <div class="map">
                        <?php echo $map; ?>
                    </div>
                </div>
            <?php endif; ?>

        </div>
    </section>

</main>

<?php get_footer(); ?>
