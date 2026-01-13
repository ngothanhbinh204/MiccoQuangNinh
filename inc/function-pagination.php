<?php

/**
 * WordPress Bootstrap Pagination
 *
 * <?php echo wp_bootstrap_pagination(array('custom_query' => $the_query)) ?>
 *
 * Thêm tham số sau vào WP_Query
 * $paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
 * 'paged' => $paged
 */
function wp_bootstrap_pagination($args = array())
{

	$defaults = array(
		'range' => 4,
		'custom_query' => FALSE,
		'previous_string' => __('Trước', 'text-domain'),
		'next_string' => __('Sau', 'text-domain'),
		'before_output' => '<div class="post-nav">
	<ul class="pager">',
		'after_output' => '</ul>
</div>'
	);

	$args = wp_parse_args(
		$args,
		apply_filters('wp_bootstrap_pagination_defaults', $defaults)
	);

	$args['range'] = (int) $args['range'] - 1;
	if (!$args['custom_query'])
		$args['custom_query'] = @$GLOBALS['wp_query'];
	$count = (int) $args['custom_query']->max_num_pages;
	$page = intval(get_query_var('paged'));
	$ceil = ceil($args['range'] / 2);

	if ($count <= 1) return FALSE;
	if (!$page) $page = 1;
	if ($count > $args['range']) {
		if ($page <= $args['range']) {
			$min = 1;
			$max = $args['range'] + 1;
		} elseif ($page >= ($count - $ceil)) {
			$min = $count - $args['range'];
			$max = $count;
		} elseif ($page >= $args['range'] && $page < ($count - $ceil)) {
			$min = $page - $ceil;
			$max = $page + $ceil;
		}
	} else {
		$min = 1;
		$max = $count;
	}
	$echo = '';
	$previous = intval($page) - 1;
	$previous = esc_attr(get_pagenum_link($previous));
	$firstpage = esc_attr(get_pagenum_link(1));
	if ($firstpage && (1 != $page)) $echo .= '<li class="previous hidden"><a href="' . $firstpage . '">' . __('Đầu tiên', 'text-domain') . '</a></li>';
	if ($previous && (1 != $page)) $echo .= '<li class="hidden"><a href="' . $previous . '" title="' . __('Trước', 'text-domain') . '">' . $args['previous_string'] . '</a></li>';
	if (!empty($min) && !empty($max)) {
		for ($i = $min; $i <= $max; $i++) {
			if ($page == $i) {
				$echo .= '<li class="active"><span class="active">' . str_pad((int)$i, 2, '0', STR_PAD_LEFT) . '</span></li>';
			} else {
				$echo .= sprintf('<li><a href="%s">%002d</a></li>', esc_attr(get_pagenum_link($i)), $i);
			}
		}
	}
	$next = intval($page) + 1;
	$next = esc_attr(get_pagenum_link($next));
	if ($next && ($count != $page)) $echo .= '<li class="hidden"><a href="' . $next . '" title="' . __('Kế tiếp', 'text-domain') . '">' . $args['next_string'] . '</a></li>';
	$lastpage = esc_attr(get_pagenum_link($count));
	if ($lastpage) {
		$echo .= '<li class="next hidden"><a href="' . $lastpage . '">' . __('Cuối cùng', 'text-domain') . '</a></li>';
	}
	if (isset($echo)) echo $args['before_output'] . $echo . $args['after_output'];
}

/**
 * Micco Custom Pagination
 * 
 * Output HTML structure:
 * <div class="pagination flex-center">
 *     <ul>
 *         <li><a href="#">1</a></li>
 *         <li class="active"><span>2</span></li>
 *         <li><a href="#">3</a></li>
 *     </ul>
 * </div>
 * 
 * Usage: <?php micco_pagination(); ?> or <?php micco_pagination($custom_query); ?>
 * 
 * @param WP_Query|null $custom_query Optional custom WP_Query object
 * @param array $args Optional arguments
 */
function micco_pagination($custom_query = null, $args = array()) {
    // Default arguments
    $defaults = array(
        'range'           => 5,        // Number of page links to show
        'show_prev_next'  => true,     // Show prev/next arrows
        'prev_text'       => '<i class="fa-solid fa-chevron-left"></i>',
        'next_text'       => '<i class="fa-solid fa-chevron-right"></i>',
        'wrapper_class'   => 'pagination flex-center mt-base',
    );
    
    $args = wp_parse_args($args, $defaults);
    
    // Get the query object
    if ($custom_query === null) {
        global $wp_query;
        $custom_query = $wp_query;
    }
    
    // Get total pages
    $total_pages = (int) $custom_query->max_num_pages;
    
    // Don't show pagination if only 1 page
    if ($total_pages <= 1) {
        return;
    }
    
    // Get current page
    $current_page = max(1, get_query_var('paged'));
    
    // Calculate range
    $range = (int) $args['range'];
    $half_range = floor($range / 2);
    
    // Calculate start and end page numbers
    $start_page = max(1, $current_page - $half_range);
    $end_page = min($total_pages, $current_page + $half_range);
    
    // Adjust if we're near the beginning or end
    if ($current_page <= $half_range) {
        $end_page = min($total_pages, $range);
    }
    if ($current_page > $total_pages - $half_range) {
        $start_page = max(1, $total_pages - $range + 1);
    }
    
    // Start output
    $output = '<div class="' . esc_attr($args['wrapper_class']) . '">';
    $output .= '<ul>';
    
    // Previous page link
    if ($args['show_prev_next'] && $current_page > 1) {
        $prev_link = get_pagenum_link($current_page - 1);
        $output .= '<li class="prev"><a href="' . esc_url($prev_link) . '" aria-label="' . esc_attr__('Trang trước', 'canhcamtheme') . '">' . $args['prev_text'] . '</a></li>';
    }
    
    // First page + dots
    if ($start_page > 1) {
        $output .= '<li><a href="' . esc_url(get_pagenum_link(1)) . '">1</a></li>';
        if ($start_page > 2) {
            $output .= '<li class="dots"><span>...</span></li>';
        }
    }
    
    // Page number links
    for ($i = $start_page; $i <= $end_page; $i++) {
        if ($i == $current_page) {
            $output .= '<li class="active"><span>' . $i . '</span></li>';
        } else {
            $output .= '<li><a href="' . esc_url(get_pagenum_link($i)) . '">' . $i . '</a></li>';
        }
    }
    
    // Last page + dots
    if ($end_page < $total_pages) {
        if ($end_page < $total_pages - 1) {
            $output .= '<li class="dots"><span>...</span></li>';
        }
        $output .= '<li><a href="' . esc_url(get_pagenum_link($total_pages)) . '">' . $total_pages . '</a></li>';
    }
    
    // Next page link
    if ($args['show_prev_next'] && $current_page < $total_pages) {
        $next_link = get_pagenum_link($current_page + 1);
        $output .= '<li class="next"><a href="' . esc_url($next_link) . '" aria-label="' . esc_attr__('Trang sau', 'canhcamtheme') . '">' . $args['next_text'] . '</a></li>';
    }
    
    $output .= '</ul>';
    $output .= '</div>';
    
    echo $output;
}

/**
 * Simple Micco Pagination (no prev/next, no dots)
 * 
 * Output exactly like the HTML structure provided:
 * <div class="pagination flex-center">
 *     <ul>
 *         <li><a href="#">1</a></li>
 *         <li><a href="#">2</a></li>
 *     </ul>
 * </div>
 * 
 * @param WP_Query|null $custom_query Optional custom WP_Query object
 */
function micco_pagination_simple($custom_query = null) {
    // Get the query object
    if ($custom_query === null) {
        global $wp_query;
        $custom_query = $wp_query;
    }
    
    // Get total pages
    $total_pages = (int) $custom_query->max_num_pages;
    
    // Don't show pagination if only 1 page
    if ($total_pages <= 1) {
        return;
    }
    
    // Get current page
    $current_page = max(1, get_query_var('paged'));
    
    // Start output
    $output = '<div class="pagination flex-center mt-base">';
    $output .= '<ul>';
    
    // Page number links
    for ($i = 1; $i <= $total_pages; $i++) {
        if ($i == $current_page) {
            $output .= '<li class="active"><span>' . $i . '</span></li>';
        } else {
            $output .= '<li><a href="' . esc_url(get_pagenum_link($i)) . '">' . $i . '</a></li>';
        }
    }
    
    $output .= '</ul>';
    $output .= '</div>';
    
    echo $output;
}
