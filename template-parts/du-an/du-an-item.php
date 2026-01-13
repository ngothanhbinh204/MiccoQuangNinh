<?php
global $post;
$short_title = get_field('short_title');
$gallery = get_field('gallery');
$project_information = get_field('project_information');
$location = $project_information['location'];
$bid_package = $project_information['bid_package'];
$investor = $project_information['investor'];
$contract_value = $project_information['contract_value'];
$start_date = $project_information['start_date'];
$end_date = $project_information['end_date'];
?>
<div class="project-item overflow-hidden bg-grey-50 transition">
    <div class="img zoom-in overflow-hidden">
        <a class="img-ratio ratio:pt-[247_440]" href="<?php the_permalink(); ?>">
            <?php echo get_image_post(get_the_ID(), 'image'); ?>
        </a>
    </div>
    <div class="txt p-4">
        <div class="title text-primary-2 text-xs mb-1 transition"><?php echo $bid_package['name']; ?></div>
        <h3 class="mb-4"><a class="heading-2 hover:underline  line-clamp-2 transition" href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
        <div class="scrollbar-wrap">
            <div class="list">
                <ul>
                    <?php if($investor): ?>
                        <li class="y-start">
                            <div class="icon w-[24px] h-[24px] min-w-[24px] lg:w-6 lg:min-w-6 lg:h-6">
                                <i class="fa-light fa-user"></i>
                            </div>
                            <div class="body-3 ml-2 transition"><?php echo $investor; ?></div>
                        </li>
                    <?php endif; ?>
                    <?php if($end_date): ?>
                        <li class="y-start">
                            <div class="icon w-[24px] h-[24px] min-w-[24px] lg:w-6 lg:min-w-6 lg:h-6">
                                <i class="fa-light fa-clock"></i>
                            </div>
                            <div class="body-3 ml-2 transition"><?php echo $end_date; ?></div>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </div>
</div>