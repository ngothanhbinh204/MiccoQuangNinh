<?php
define('GENERATE_VERSION', '1.1.0');
require get_template_directory() . '/inc/function-root.php';
require get_template_directory() . '/inc/function-custom.php';
require get_template_directory() . '/inc/function-field.php';
require get_template_directory() . '/inc/function-pagination.php';
require get_template_directory() . '/inc/function-setup.php';
require get_template_directory() . '/inc/function-post-types.php';

/**
 * Validate phone number field in Contact Form 7
 * Ensures the phone number contains only digits and is between 10-12 characters
 */
function custom_tel_validation_filter($result, $tag) {
    $tag = new WPCF7_FormTag($tag);
    
    if ('tel' == $tag->basetype || 'tel*' == $tag->basetype) {
        $tel = isset($_POST[$tag->name]) ? trim($_POST[$tag->name]) : '';
        
        if ($tel) {
            // Check if the phone number contains only digits
            if (!preg_match('/^[0-9]+$/', $tel)) {
                $result->invalidate($tag, __('Vui lòng chỉ nhập số điện thoại.', 'canhcamtheme'));
            }
            
            // Check if the phone number is between 10 and 12 digits
            $length = strlen($tel);
            if ($length < 10 || $length > 12) {
                $result->invalidate($tag, __('Số điện thoại phải từ 10 đến 12 số.', 'canhcamtheme'));
            }
        }
    }
    
    return $result;
}
add_filter('wpcf7_validate_tel', 'custom_tel_validation_filter', 10, 2);
add_filter('wpcf7_validate_tel*', 'custom_tel_validation_filter', 10, 2);

/**
 * Add 'single-post' class to body for all singular posts
 */
function add_single_post_class_to_body($classes) {
    if (is_singular() && !is_page()) {
        $classes[] = 'single-post';
    }
    return $classes;
}
add_filter('body_class', 'add_single_post_class_to_body');

/**
 * Enqueue AJAX scripts and localize data for specific templates
 */
add_action('wp_enqueue_scripts', function() {
    global $post;

    // Common AJAX URL for all scripts
    $ajax_url = admin_url('admin-ajax.php');
    
    // Career archive page scripts
    if(is_post_type_archive('tuyen-dung') || is_archive('tuyen-dung')) {
        wp_enqueue_script('career-ajax', get_template_directory_uri() . '/scripts/career-ajax.js', ['jquery'], GENERATE_VERSION, true);
        wp_localize_script('career-ajax', 'ajax_object', [
            'ajax_url' => $ajax_url,
            'nonce'    => wp_create_nonce('career_filter_nonce'),
        ]);
    }

});

function load_more_careers() {
    // Verify nonce for security
    if (!wp_verify_nonce($_POST['nonce'], 'career_filter_nonce')) {
        wp_die('Security check failed');
    }
    
    $page = intval($_POST['page']);
    $start_count = intval($_POST['count']);
    $per_page = intval($_POST['per_page']);
    $taxonomy = $_POST['taxonomy'];
    $term_id = $_POST['term_id'];
    // Ensure per_page has a valid value
    if ($per_page <= 0) {
        $per_page = 4; // Default fallback
    }
    
    $args = array(
        'post_type' => 'tuyen-dung',
        'posts_per_page' => $per_page,
        'post_status' => 'publish',
        'paged' => $page,
        'tax_query' => array(
            array(
                'taxonomy' => $taxonomy,
                'field' => 'term_id',
                'terms' => $term_id,
            ),
        ),
    );
    
    $query = new WP_Query($args);
    $count = $start_count + 1;
    $posts_returned = 0;
    
    if ($query->have_posts()) {
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
            $posts_returned++;
        endwhile;
        wp_reset_postdata();
        
        // If we returned less than the expected per_page posts, it means we've reached the end
        if ($posts_returned < $per_page) {
            echo '<script>jQuery("#load-more-container").hide();</script>';
        }
    } else {
        // No posts found, hide the button
        echo '<script>jQuery("#load-more-container").hide();</script>';
    }
    wp_die();
}
add_action('wp_ajax_load_more_careers', 'load_more_careers');
add_action('wp_ajax_nopriv_load_more_careers', 'load_more_careers');


/* ----------------------------
 * WPML: register strings (admin only)
 * ---------------------------- */
function my_register_pagination_and_slugs_with_wpml() {
    if ( ! is_admin() ) {
        return; // register strings only in admin to avoid front-end overhead
    }

    if ( empty( $GLOBALS['wp_rewrite'] ) ) {
        return;
    }

    $wp_rewrite = $GLOBALS['wp_rewrite'];
    $pagination_base = $wp_rewrite->pagination_base;

    // Register pagination base
    if ( function_exists( 'icl_register_string' ) || did_action( 'wpml_loaded' ) || has_action( 'wpml_register_single_string' ) ) {
        do_action( 'wpml_register_single_string', 'Pagination', 'pagination_base', $pagination_base );
    }

    // Register CPT/taxonomy slugs for translation (so user can translate CPT archive slug and taxonomy slugs)
    $post_types = get_post_types( array( 'public' => true, 'has_archive' => true ), 'objects' );
    foreach ( $post_types as $pt ) {
        if ( ! empty( $pt->rewrite['slug'] ) ) {
            do_action( 'wpml_register_single_string', 'CPT Slugs', "post_type_{$pt->name}_slug", $pt->rewrite['slug'] );
        }
        // register associated taxonomies' slugs (public)
        $taxes = get_object_taxonomies( $pt->name, 'objects' );
        foreach ( $taxes as $tax ) {
            if ( ! empty( $tax->rewrite['slug'] ) ) {
                do_action( 'wpml_register_single_string', 'Taxonomy Slugs', "taxonomy_{$tax->name}_slug", $tax->rewrite['slug'] );
            }
        }
    }
}
// add_action( 'admin_init', 'my_register_pagination_and_slugs_with_wpml', 20 );


/* ----------------------------
 * Apply WPML translations to pagination & slugs (front & admin safe)
 * ---------------------------- */
function my_apply_wpml_translated_slugs() {
    global $wp_rewrite;
    if ( empty( $wp_rewrite ) ) {
        return;
    }

    $original_pagination = $wp_rewrite->pagination_base;
    $translated_pagination = $original_pagination;

    if ( function_exists( 'icl_t' ) ) {
        $translated_pagination = icl_t( 'Pagination', 'pagination_base', $original_pagination );
    } elseif ( has_filter( 'wpml_translate_single_string' ) ) {
        $translated_pagination = apply_filters( 'wpml_translate_single_string', $original_pagination, 'Pagination', 'pagination_base' );
    }

    if ( ! empty( $translated_pagination ) ) {
        $wp_rewrite->pagination_base = sanitize_title( $translated_pagination );
    }

    // Also translate registered CPT/taxonomy slugs so our rules use translated slugs:
    $post_types = get_post_types( array( 'public' => true, 'has_archive' => true ), 'objects' );
    foreach ( $post_types as $pt ) {
        if ( ! empty( $pt->rewrite['slug'] ) ) {
            $orig = $pt->rewrite['slug'];
            $translated = ( function_exists( 'icl_t' ) ) ? icl_t( 'CPT Slugs', "post_type_{$pt->name}_slug", $orig ) : ( has_filter( 'wpml_translate_single_string' ) ? apply_filters( 'wpml_translate_single_string', $orig, 'CPT Slugs', "post_type_{$pt->name}_slug" ) : $orig );
            if ( ! empty( $translated ) ) {
                // replace rewrite slug in object so later rules use translated slug
                $pt->rewrite['slug'] = sanitize_title( $translated );
                // update global registry so other code can read it if needed
                global $wp_post_types;
                if ( isset( $wp_post_types[ $pt->name ] ) ) {
                    $wp_post_types[ $pt->name ]->rewrite['slug'] = $pt->rewrite['slug'];
                }
            }
        }

        $taxes = get_object_taxonomies( $pt->name, 'objects' );
        foreach ( $taxes as $tax ) {
            if ( ! empty( $tax->rewrite['slug'] ) ) {
                $orig = $tax->rewrite['slug'];
                $translated = ( function_exists( 'icl_t' ) ) ? icl_t( 'Taxonomy Slugs', "taxonomy_{$tax->name}_slug", $orig ) : ( has_filter( 'wpml_translate_single_string' ) ? apply_filters( 'wpml_translate_single_string', $orig, 'Taxonomy Slugs', "taxonomy_{$tax->name}_slug" ) : $orig );
                if ( ! empty( $translated ) ) {
                    $tax->rewrite['slug'] = sanitize_title( $translated );
                    global $wp_taxonomies;
                    if ( isset( $wp_taxonomies[ $tax->name ] ) ) {
                        $wp_taxonomies[ $tax->name ]->rewrite['slug'] = $tax->rewrite['slug'];
                    }
                }
            }
        }
    }
}
// Run early enough that WP uses the translated slug for building rules
// add_action( 'init', 'my_apply_wpml_translated_slugs', 15 );


/* ----------------------------
 * Add rewrite rules for CPT archives + CPT taxonomies pagination
 * ---------------------------- */
function my_add_cpt_and_taxonomy_pagination_rules() {
    global $wp_rewrite;

    if ( empty( $wp_rewrite ) ) {
        return;
    }

    $pagination_base = $wp_rewrite->pagination_base; // already translated if WPML active
    $front = trim( $wp_rewrite->front, '/' );

    // Collect public post types with archive (for archive pagination only)
    $post_types_with_archive = get_post_types( array( 'public' => true, 'has_archive' => true ), 'objects' );
    
    // Process post types with archives for archive pagination
    if ( ! empty( $post_types_with_archive ) ) {
        foreach ( $post_types_with_archive as $pt ) {
            // Ensure we have a slug to match against
            $pt_slug = ! empty( $pt->rewrite['slug'] ) ? trim( $pt->rewrite['slug'], '/' ) : $pt->name;
            $pt_slug_escaped = preg_quote( $pt_slug, '/' );

            // ARCHIVE pagination rule: ^{pt_slug}/{pagination_base}/{page}/
            $pattern = "^{$pt_slug_escaped}/" . preg_quote( $pagination_base, '/' ) . "/([0-9]{1,})/?$";
            $query = 'index.php?post_type=' . $pt->name . '&paged=$matches[1]';
            add_rewrite_rule( $pattern, $query, 'top' );

            // If archive uses front, add a with_front pattern too
            if ( ! empty( $pt->rewrite['with_front'] ) && ! empty( $front ) ) {
                $front_escaped = preg_quote( $front, '/' );
                $pattern_front = "^{$front_escaped}/{$pt_slug_escaped}/" . preg_quote( $pagination_base, '/' ) . "/([0-9]{1,})/?$";
                add_rewrite_rule( $pattern_front, $query, 'top' );
            }
        }
    }

    // Collect ALL public post types (for taxonomy pagination, even if no archive)
    // This is critical for post types like 'du-an' which has has_archive => false
    $all_post_types = get_post_types( array( 'public' => true ), 'objects' );
    if ( empty( $all_post_types ) ) {
        return;
    }

    // Process ALL public post types for taxonomy pagination
    foreach ( $all_post_types as $pt ) {
        // TAXONOMIES associated to this post type: add pagination rules
        $taxonomies = get_object_taxonomies( $pt->name, 'objects' );
        if ( empty( $taxonomies ) ) {
            continue;
        }

        foreach ( $taxonomies as $tax ) {
            if ( empty( $tax->rewrite ) || empty( $tax->rewrite['slug'] ) ) {
                continue;
            }

            $tax_slug = trim( $tax->rewrite['slug'], '/' );
            $tax_slug_escaped = preg_quote( $tax_slug, '/' );

            // For taxonomy terms we must support hierarchical term slugs (parent/child): use non-greedy match up to pagination base.
            $pattern_tax = "^{$tax_slug_escaped}/(.+?)/" . preg_quote( $pagination_base, '/' ) . "/([0-9]{1,})/?$";

            // Query var: category_name for built-in 'category' taxonomy (supports parents),
            // for others use 'term' + 'taxonomy' so WP resolves the correct term by slug path.
            // This works for both flat and hierarchical taxonomies.
            if ( 'category' === $tax->name ) {
                $query_tax = 'index.php?category_name=$matches[1]&paged=$matches[2]';
            } else {
                // Use taxonomy + term for custom taxonomies (supports hierarchical slugs like parent/child)
                $query_tax = "index.php?taxonomy={$tax->name}&term=\$matches[1]&paged=\$matches[2]";
            }

            add_rewrite_rule( $pattern_tax, $query_tax, 'top' );

            // with_front for taxonomy
            if ( ! empty( $tax->rewrite['with_front'] ) && ! empty( $front ) ) {
                $pattern_tax_front = "^{$front}/{$tax_slug_escaped}/(.+?)/" . preg_quote( $pagination_base, '/' ) . "/([0-9]{1,})/?$";
                add_rewrite_rule( $pattern_tax_front, $query_tax, 'top' );
            }
        }
    }
}
// add_action( 'init', 'my_add_cpt_and_taxonomy_pagination_rules', 99 );


/* ----------------------------
 * Debug: Log rewrite rules for du-an-category (remove after testing)
 * Uncomment to see what rewrite rules are being added
 * ---------------------------- */
/*
add_action( 'init', function() {
    if ( current_user_can( 'manage_options' ) && isset( $_GET['debug_rewrite'] ) ) {
        global $wp_rewrite;
        $rules = get_option( 'rewrite_rules' );
        echo '<pre>';
        foreach ( $rules as $pattern => $query ) {
            if ( strpos( $pattern, 'du-an-category' ) !== false || strpos( $query, 'du-an-category' ) !== false ) {
                echo esc_html( $pattern ) . ' => ' . esc_html( $query ) . "\n";
            }
        }
        echo '</pre>';
        die();
    }
}, 999 );
*/

/* ----------------------------
 * Utility: flush when theme switched (or you can add plugin activation hook)
 * ---------------------------- */
add_action( 'after_switch_theme', 'flush_rewrite_rules' );

/* ----------------------------
 * TEMPORARY: Force flush rewrite rules on next page load
 * IMPORTANT: Uncomment the line below, visit ANY page on your site ONCE, then comment it back
 * This will flush and regenerate all rewrite rules
 * ---------------------------- */
// add_action( 'init', function() { flush_rewrite_rules(); delete_option('rewrite_rules_flushed'); }, 999 );

/* ----------------------------
 * Temporary: Force flush rewrite rules (remove after testing)
 * Uncomment the line below, visit any page once, then comment it back
 * ---------------------------- */
// add_action( 'init', function() { flush_rewrite_rules(); }, 999 );


add_filter('rank_math/frontend/breadcrumb/items', function ($crumbs) {

    if (is_singular('dich-vu')) {

        $crumbs = [
            [
                __('Trang chủ', 'canhcamtheme'),
                home_url('/'),
            ],
            [
                __('Dịch vụ', 'canhcamtheme'),
                get_post_type_archive_link('dich-vu'),
            ],
        ];
    }

    return $crumbs;
});

