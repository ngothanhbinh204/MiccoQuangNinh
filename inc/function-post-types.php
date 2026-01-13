<?php
// Register Tuyển Dụng Custom Post Type
function create_tuyen_dung_post_type() {
    $labels = array(
        'name'                  => 'Tuyển Dụng',
        'singular_name'         => 'Tuyển Dụng',
        'menu_name'             => 'Tuyển Dụng',
        'name_admin_bar'        => 'Tuyển Dụng',
        'archives'              => 'Lưu trữ Tuyển Dụng',
        'attributes'            => 'Thuộc tính Tuyển Dụng',
        'parent_item_colon'     => 'Tuyển Dụng cha:',
        'all_items'             => 'Tất cả Tuyển Dụng',
        'add_new_item'          => 'Thêm Tuyển Dụng mới',
        'add_new'               => 'Thêm mới',
        'new_item'              => 'Tuyển Dụng mới',
        'edit_item'             => 'Sửa Tuyển Dụng',
        'update_item'           => 'Cập nhật Tuyển Dụng',
        'view_item'             => 'Xem Tuyển Dụng',
        'view_items'            => 'Xem các Tuyển Dụng',
        'search_items'          => 'Tìm kiếm Tuyển Dụng',
        'not_found'             => 'Không tìm thấy',
        'not_found_in_trash'    => 'Không tìm thấy trong thùng rác',
        'featured_image'        => 'Ảnh đại diện',
        'set_featured_image'    => 'Đặt ảnh đại diện',
        'remove_featured_image' => 'Xóa ảnh đại diện',
        'use_featured_image'    => 'Sử dụng làm ảnh đại diện',
        'insert_into_item'      => 'Chèn vào Tuyển Dụng',
        'uploaded_to_this_item' => 'Đã tải lên cho Tuyển Dụng này',
        'items_list'            => 'Danh sách Tuyển Dụng',
        'items_list_navigation' => 'Điều hướng danh sách Tuyển Dụng',
        'filter_items_list'     => 'Lọc danh sách Tuyển Dụng',
    );
    
    $args = array(
        'labels'              => $labels,
        'public'              => true,
        'publicly_queryable'  => true,
        'show_ui'             => true,
        'show_in_menu'        => true,
        'query_var'           => true,
        'rewrite'             => array('slug' => 'tuyen-dung'),
        'capability_type'     => 'post',
        'has_archive'         => false,
        'hierarchical'        => false,
        'menu_position'       => null,
        'supports'            => array('title', 'thumbnail', 'excerpt'),
        'menu_icon'           => 'dashicons-businessman',
    );

    register_post_type('tuyen-dung', $args);
}
add_action('init', 'create_tuyen_dung_post_type');

// Register Danh Mục Tuyển Dụng Taxonomy
function create_danh_muc_tuyen_dung_taxonomy() {
    $labels = array(
        'name'                       => 'Danh Mục Tuyển Dụng',
        'singular_name'              => 'Danh Mục Tuyển Dụng',
        'search_items'               => 'Tìm kiếm Danh Mục',
        'popular_items'              => 'Danh Mục phổ biến',
        'all_items'                  => 'Tất cả Danh Mục',
        'parent_item'                => 'Danh Mục cha',
        'parent_item_colon'          => 'Danh Mục cha:',
        'edit_item'                  => 'Sửa Danh Mục',
        'update_item'                => 'Cập nhật Danh Mục',
        'add_new_item'               => 'Thêm Danh Mục mới',
        'new_item_name'              => 'Tên Danh Mục mới',
        'separate_items_with_commas' => 'Phân tách các Danh Mục bằng dấu phẩy',
        'add_or_remove_items'        => 'Thêm hoặc xóa Danh Mục',
        'choose_from_most_used'      => 'Chọn từ các Danh Mục được sử dụng nhiều nhất',
        'not_found'                  => 'Không tìm thấy Danh Mục',
        'menu_name'                  => 'Danh Mục Tuyển Dụng',
    );

    $args = array(
        'hierarchical'          => true,
        'labels'                => $labels,
        'show_ui'               => true,
        'show_admin_column'     => true,
        'query_var'             => true,
        'rewrite'               => array('slug' => 'tuyen-dung-category'),
        'show_in_rest'          => true,
    );

    register_taxonomy('tuyen-dung-category', array('tuyen-dung'), $args);
}
add_action('init', 'create_danh_muc_tuyen_dung_taxonomy');

// Register Dự Án Custom Post Type
function create_du_an_post_type() {
    $labels = array(
        'name'                  => 'Dự Án',
        'singular_name'         => 'Dự Án',
        'menu_name'             => 'Dự Án',
        'name_admin_bar'        => 'Dự Án',
        'archives'              => 'Lưu trữ Dự Án',
        'attributes'            => 'Thuộc tính Dự Án',
        'parent_item_colon'     => 'Dự Án cha:',
        'all_items'             => 'Tất cả Dự Án',
        'add_new_item'          => 'Thêm Dự Án mới',
        'add_new'               => 'Thêm mới',
        'new_item'              => 'Dự Án mới',
        'edit_item'             => 'Sửa Dự Án',
        'update_item'           => 'Cập nhật Dự Án',
        'view_item'             => 'Xem Dự Án',
        'view_items'            => 'Xem các Dự Án',
        'search_items'          => 'Tìm kiếm Dự Án',
        'not_found'             => 'Không tìm thấy',
        'not_found_in_trash'    => 'Không tìm thấy trong thùng rác',
        'featured_image'        => 'Ảnh đại diện',
        'set_featured_image'    => 'Đặt ảnh đại diện',
        'remove_featured_image' => 'Xóa ảnh đại diện',
        'use_featured_image'    => 'Sử dụng làm ảnh đại diện',
        'insert_into_item'      => 'Chèn vào Dự Án',
        'uploaded_to_this_item' => 'Đã tải lên cho Dự Án này',
        'items_list'            => 'Danh sách Dự Án',
        'items_list_navigation' => 'Điều hướng danh sách Dự Án',
        'filter_items_list'     => 'Lọc danh sách Dự Án',
    );
    
    $args = array(
        'labels'              => $labels,
        'public'              => true,
        'publicly_queryable'  => true,
        'show_ui'             => true,
        'show_in_menu'        => true,
        'query_var'           => true,
        'rewrite'             => array('slug' => 'du-an'),
        'capability_type'     => 'post',
        'has_archive'         => false,
        'hierarchical'        => false,
        'menu_position'       => null,
        'supports'            => array('title', 'editor', 'thumbnail', 'excerpt'),
        'menu_icon'           => 'dashicons-portfolio',
    );

    register_post_type('du-an', $args);
}
add_action('init', 'create_du_an_post_type');

/**
 * Register taxonomy for Dự Án
 */
function create_du_an_taxonomy() {
    $labels = array(
        'name'              => 'Danh mục Dự Án',
        'singular_name'     => 'Danh mục Dự Án',
        'search_items'      => 'Tìm kiếm danh mục',
        'all_items'         => 'Tất cả danh mục',
        'parent_item'       => 'Danh mục cha',
        'parent_item_colon' => 'Danh mục cha:',
        'edit_item'         => 'Sửa danh mục',
        'update_item'       => 'Cập nhật danh mục',
        'add_new_item'      => 'Thêm danh mục mới',
        'new_item_name'     => 'Tên danh mục mới',
        'menu_name'         => 'Danh mục Dự Án',
    );

    $args = array(
        'labels'            => $labels,
        'hierarchical'      => true,
        'public'            => true,
        'show_ui'           => true,
        'show_admin_column' => true,
        'show_in_nav_menus' => true,
        'query_var'         => true,
        'rewrite'           => array('slug' => 'du-an-category'),
    );

    register_taxonomy('du-an-category', array('du-an'), $args);
}
add_action('init', 'create_du_an_taxonomy');

// Register Văn Hóa Doanh Nghiệp Custom Post Type
function create_van_hoa_doanh_nghiep_post_type() {
    $labels = array(
        'name'                  => 'Văn Hóa Doanh Nghiệp',
        'singular_name'         => 'Văn Hóa Doanh Nghiệp',
        'menu_name'             => 'Văn Hóa Doanh Nghiệp',
        'name_admin_bar'        => 'Văn Hóa Doanh Nghiệp',
        'archives'              => 'Lưu trữ Văn Hóa Doanh Nghiệp',
        'attributes'            => 'Thuộc tính Văn Hóa Doanh Nghiệp',
        'parent_item_colon'     => 'Văn Hóa Doanh Nghiệp cha:',
        'all_items'             => 'Tất cả Văn Hóa Doanh Nghiệp',
        'add_new_item'          => 'Thêm Văn Hóa Doanh Nghiệp mới',
        'add_new'               => 'Thêm mới',
        'new_item'              => 'Văn Hóa Doanh Nghiệp mới',
        'edit_item'             => 'Sửa Văn Hóa Doanh Nghiệp',
        'update_item'           => 'Cập nhật Văn Hóa Doanh Nghiệp',
        'view_item'             => 'Xem Văn Hóa Doanh Nghiệp',
        'view_items'            => 'Xem các Văn Hóa Doanh Nghiệp',
        'search_items'          => 'Tìm kiếm Văn Hóa Doanh Nghiệp',
        'not_found'             => 'Không tìm thấy',
        'not_found_in_trash'    => 'Không tìm thấy trong thùng rác',
        'featured_image'        => 'Ảnh đại diện',
        'set_featured_image'    => 'Đặt ảnh đại diện',
        'remove_featured_image' => 'Xóa ảnh đại diện',
        'use_featured_image'    => 'Sử dụng làm ảnh đại diện',
        'insert_into_item'      => 'Chèn vào Văn Hóa Doanh Nghiệp',
        'uploaded_to_this_item' => 'Đã tải lên cho Văn Hóa Doanh Nghiệp này',
        'items_list'            => 'Danh sách Văn Hóa Doanh Nghiệp',
        'items_list_navigation' => 'Điều hướng danh sách Văn Hóa Doanh Nghiệp',
        'filter_items_list'     => 'Lọc danh sách Văn Hóa Doanh Nghiệp',
    );
    
    $args = array(
        'labels'              => $labels,
        'public'              => true,
        'publicly_queryable'  => true,
        'show_ui'             => true,
        'show_in_menu'        => true,
        'query_var'           => true,
        'rewrite'             => array('slug' => 'van-hoa-doanh-nghiep'),
        'capability_type'     => 'post',
        'has_archive'         => false,
        'hierarchical'        => false,
        'menu_position'       => null,
        'supports'            => array('title', 'thumbnail', 'excerpt', 'editor'),
        'menu_icon'           => 'dashicons-groups',
    );

    register_post_type('van-hoa-doanh-nghiep', $args);
}
add_action('init', 'create_van_hoa_doanh_nghiep_post_type');

/**
 * Register taxonomy for Văn Hóa Doanh Nghiệp
 */
function create_van_hoa_doanh_nghiep_taxonomy() {
    $labels = array(
        'name'              => 'Danh mục Văn Hóa Doanh Nghiệp',
        'singular_name'     => 'Danh mục Văn Hóa Doanh Nghiệp',
        'search_items'      => 'Tìm kiếm danh mục',
        'all_items'         => 'Tất cả danh mục',
        'parent_item'       => 'Danh mục cha',
        'parent_item_colon' => 'Danh mục cha:',
        'edit_item'         => 'Sửa danh mục',
        'update_item'       => 'Cập nhật danh mục',
        'add_new_item'      => 'Thêm danh mục mới',
        'new_item_name'     => 'Tên danh mục mới',
        'menu_name'         => 'Danh mục Văn Hóa DN',
    );

    $args = array(
        'labels'            => $labels,
        'hierarchical'      => true,
        'public'            => true,
        'show_ui'           => true,
        'show_admin_column' => true,
        'show_in_nav_menus' => true,
        'query_var'         => true,
        'rewrite'           => array('slug' => 'van-hoa-doanh-nghiep-category'),
    );

    register_taxonomy('van-hoa-doanh-nghiep-category', array('van-hoa-doanh-nghiep'), $args);
}
add_action('init', 'create_van_hoa_doanh_nghiep_taxonomy');

/**
 * Enable Rank Math metabox and sitemap settings for our custom taxonomies (single, robust block)
 */
add_action('plugins_loaded', function() {

    // Bail if Rank Math isn't active
    if ( ! ( defined( 'RANK_MATH_VERSION' ) || function_exists( 'rank_math' ) || class_exists( 'RankMath' ) ) ) {
        return;
    }

    $custom_taxonomies = array(
        'tuyen-dung-category',
        'du-an-category',
        'van-hoa-doanh-nghiep-category',
    );

    // add taxonomies to Rank Math lists
    add_filter( 'rank_math/sitemap/taxonomies', function( $taxonomies ) use ( $custom_taxonomies ) {
        return array_merge( (array) $taxonomies, $custom_taxonomies );
    }, 20 );

    add_filter( 'rank_math/metabox/taxonomies', function( $taxonomies ) use ( $custom_taxonomies ) {
        return array_merge( (array) $taxonomies, $custom_taxonomies );
    }, 20 );

    // ensure metabox appears on each taxonomy term editor
    foreach ( $custom_taxonomies as $taxonomy ) {
        add_filter( "rank_math/metabox/taxonomy/{$taxonomy}", '__return_true' );
    }

    // optional: ensure taxonomy included in sitemap
    add_filter( 'rank_math/sitemap/include_taxonomy', function( $include, $taxonomy ) use ( $custom_taxonomies ) {
        if ( in_array( $taxonomy, $custom_taxonomies, true ) ) {
            return true;
        }
        return $include;
    }, 20, 2 );
});

/**
 * Insert custom taxonomy term into Rank Math breadcrumbs for single CPTs.
 */
add_filter( 'rank_math/frontend/breadcrumb/items', function( $crumbs, $class ) {

    if ( ! is_singular() ) {
        return $crumbs;
    }

    // Map CPT => taxonomy
    $map = array(
        'tuyen-dung'       => 'tuyen-dung-category',
        'du-an'       => 'du-an-category',
        'van-hoa-doanh-nghiep'       => 'van-hoa-doanh-nghiep-category',
    );

    $post = get_queried_object();
    if ( ! $post || ! isset( $post->post_type ) ) {
        return $crumbs;
    }

    $post_type = $post->post_type;
    if ( empty( $map[ $post_type ] ) ) {
        return $crumbs;
    }

    $taxonomy = $map[ $post_type ];

    // Get terms assigned to the post for that taxonomy
    $terms = wp_get_post_terms( $post->ID, $taxonomy );

    if ( empty( $terms ) || is_wp_error( $terms ) ) {
        return $crumbs;
    }

    // Choose a term — currently: first in the returned array.
    // If you need a different selection strategy (primary term), replace this block.
    $term = $terms[0];

    // Build breadcrumb item: [ label, url ]
    $term_item = array( $term->name, get_term_link( $term ) );

    // Avoid duplicates: check if already present
    foreach ( $crumbs as $c ) {
        if ( isset( $c[1] ) && untrailingslashit( $c[1] ) === untrailingslashit( $term_item[1] ) ) {
            // term already in crumbs
            return $crumbs;
        }
    }

    // Insert before last item (which is usually the post title)
    $insert_at = max( 0, count( $crumbs ) - 1 );
    array_splice( $crumbs, $insert_at, 0, array( $term_item ) );

    // Re-index to keep numeric keys continuous
    $crumbs = array_values( $crumbs );

    return $crumbs;
}, 15, 2 );


