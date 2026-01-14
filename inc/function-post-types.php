<?php
/**
 * Custom Post Types for Micco Quang Ninh
 * 
 * Post Types:
 * - san-pham (Sản phẩm / Products)
 * - dich-vu (Dịch vụ / Services)
 * - tuyen-dung (Tuyển dụng / Recruitment)
 */

// ============================================================================
// REGISTER SẢN PHẨM (PRODUCTS) POST TYPE
// ============================================================================
function create_san_pham_post_type() {
    $labels = array(
        'name'                  => 'Sản Phẩm',
        'singular_name'         => 'Sản Phẩm',
        'menu_name'             => 'Sản Phẩm',
        'name_admin_bar'        => 'Sản Phẩm',
        'archives'              => 'Danh sách Sản Phẩm',
        'attributes'            => 'Thuộc tính Sản Phẩm',
        'parent_item_colon'     => 'Sản Phẩm cha:',
        'all_items'             => 'Tất cả Sản Phẩm',
        'add_new_item'          => 'Thêm Sản Phẩm mới',
        'add_new'               => 'Thêm mới',
        'new_item'              => 'Sản Phẩm mới',
        'edit_item'             => 'Sửa Sản Phẩm',
        'update_item'           => 'Cập nhật Sản Phẩm',
        'view_item'             => 'Xem Sản Phẩm',
        'view_items'            => 'Xem các Sản Phẩm',
        'search_items'          => 'Tìm kiếm Sản Phẩm',
        'not_found'             => 'Không tìm thấy',
        'not_found_in_trash'    => 'Không tìm thấy trong thùng rác',
        'featured_image'        => 'Ảnh đại diện',
        'set_featured_image'    => 'Đặt ảnh đại diện',
        'remove_featured_image' => 'Xóa ảnh đại diện',
        'use_featured_image'    => 'Sử dụng làm ảnh đại diện',
        'insert_into_item'      => 'Chèn vào Sản Phẩm',
        'uploaded_to_this_item' => 'Đã tải lên cho Sản Phẩm này',
        'items_list'            => 'Danh sách Sản Phẩm',
        'items_list_navigation' => 'Điều hướng danh sách Sản Phẩm',
        'filter_items_list'     => 'Lọc danh sách Sản Phẩm',
    );
    
    $args = array(
        'labels'              => $labels,
        'public'              => true,
        'publicly_queryable'  => true,
        'show_ui'             => true,
        'show_in_menu'        => true,
        'query_var'           => true,
        'rewrite'             => array('slug' => 'san-pham', 'with_front' => false),
        'capability_type'     => 'post',
        'has_archive'         => true,
        'hierarchical'        => false,
        'menu_position'       => 5,
        'supports'            => array('title', 'editor', 'thumbnail', 'excerpt'),
        'menu_icon'           => 'dashicons-products',
        'show_in_rest'        => true,
    );

    register_post_type('san-pham', $args);
}
add_action('init', 'create_san_pham_post_type');

// Register Danh Mục Sản Phẩm Taxonomy
function create_san_pham_taxonomy() {
    $labels = array(
        'name'                       => 'Danh Mục Sản Phẩm',
        'singular_name'              => 'Danh Mục Sản Phẩm',
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
        'menu_name'                  => 'Danh Mục Sản Phẩm',
    );

    $args = array(
        'hierarchical'          => true,
        'labels'                => $labels,
        'show_ui'               => true,
        'show_admin_column'     => true,
        'query_var'             => true,
        'rewrite'               => array('slug' => 'danh-muc-san-pham'),
        'show_in_rest'          => true,
    );

    register_taxonomy('danh-muc-san-pham', array('san-pham'), $args);
}
add_action('init', 'create_san_pham_taxonomy');

// ============================================================================
// REGISTER DỊCH VỤ (SERVICES) POST TYPE
// ============================================================================
function create_dich_vu_post_type() {
    $labels = array(
        'name'                  => 'Dịch Vụ',
        'singular_name'         => 'Dịch Vụ',
        'menu_name'             => 'Dịch Vụ',
        'name_admin_bar'        => 'Dịch Vụ',
        'archives'              => 'Danh sách Dịch Vụ',
        'attributes'            => 'Thuộc tính Dịch Vụ',
        'parent_item_colon'     => 'Dịch Vụ cha:',
        'all_items'             => 'Tất cả Dịch Vụ',
        'add_new_item'          => 'Thêm Dịch Vụ mới',
        'add_new'               => 'Thêm mới',
        'new_item'              => 'Dịch Vụ mới',
        'edit_item'             => 'Sửa Dịch Vụ',
        'update_item'           => 'Cập nhật Dịch Vụ',
        'view_item'             => 'Xem Dịch Vụ',
        'view_items'            => 'Xem các Dịch Vụ',
        'search_items'          => 'Tìm kiếm Dịch Vụ',
        'not_found'             => 'Không tìm thấy',
        'not_found_in_trash'    => 'Không tìm thấy trong thùng rác',
        'featured_image'        => 'Ảnh đại diện',
        'set_featured_image'    => 'Đặt ảnh đại diện',
        'remove_featured_image' => 'Xóa ảnh đại diện',
        'use_featured_image'    => 'Sử dụng làm ảnh đại diện',
        'insert_into_item'      => 'Chèn vào Dịch Vụ',
        'uploaded_to_this_item' => 'Đã tải lên cho Dịch Vụ này',
        'items_list'            => 'Danh sách Dịch Vụ',
        'items_list_navigation' => 'Điều hướng danh sách Dịch Vụ',
        'filter_items_list'     => 'Lọc danh sách Dịch Vụ',
    );
    
    $args = array(
        'labels'              => $labels,
        'public'              => true,
        'publicly_queryable'  => true,
        'show_ui'             => true,
        'show_in_menu'        => true,
        'query_var'           => true,
        'rewrite'             => array('slug' => 'dich-vu', 'with_front' => false),
        'capability_type'     => 'post',
        'has_archive'         => true,
        'hierarchical'        => false,
        'menu_position'       => 6,
        'supports'            => array('title', 'editor', 'thumbnail', 'excerpt'),
        'menu_icon'           => 'dashicons-admin-tools',
        'show_in_rest'        => true,
    );

    register_post_type('dich-vu', $args);
}
add_action('init', 'create_dich_vu_post_type');

// Register Danh Mục Dịch Vụ Taxonomy
function create_dich_vu_taxonomy() {
    $labels = array(
        'name'                       => 'Danh Mục Dịch Vụ',
        'singular_name'              => 'Danh Mục Dịch Vụ',
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
        'menu_name'                  => 'Danh Mục Dịch Vụ',
    );

    $args = array(
        'hierarchical'          => true,
        'labels'                => $labels,
        'show_ui'               => true,
        'show_admin_column'     => true,
        'query_var'             => true,
        'rewrite'               => array('slug' => 'danh-muc-dich-vu'),
        'show_in_rest'          => true,
    );

    register_taxonomy('danh-muc-dich-vu', array('dich-vu'), $args);
}
add_action('init', 'create_dich_vu_taxonomy');

// ============================================================================
// REGISTER TUYỂN DỤNG (RECRUITMENT) POST TYPE
// ============================================================================
// function create_tuyen_dung_post_type() {
//     $labels = array(
//         'name'                  => 'Tuyển Dụng',
//         'singular_name'         => 'Tuyển Dụng',
//         'menu_name'             => 'Tuyển Dụng',
//         'name_admin_bar'        => 'Tuyển Dụng',
//         'archives'              => 'Lưu trữ Tuyển Dụng',
//         'attributes'            => 'Thuộc tính Tuyển Dụng',
//         'parent_item_colon'     => 'Tuyển Dụng cha:',
//         'all_items'             => 'Tất cả Tuyển Dụng',
//         'add_new_item'          => 'Thêm Tuyển Dụng mới',
//         'add_new'               => 'Thêm mới',
//         'new_item'              => 'Tuyển Dụng mới',
//         'edit_item'             => 'Sửa Tuyển Dụng',
//         'update_item'           => 'Cập nhật Tuyển Dụng',
//         'view_item'             => 'Xem Tuyển Dụng',
//         'view_items'            => 'Xem các Tuyển Dụng',
//         'search_items'          => 'Tìm kiếm Tuyển Dụng',
//         'not_found'             => 'Không tìm thấy',
//         'not_found_in_trash'    => 'Không tìm thấy trong thùng rác',
//         'featured_image'        => 'Ảnh đại diện',
//         'set_featured_image'    => 'Đặt ảnh đại diện',
//         'remove_featured_image' => 'Xóa ảnh đại diện',
//         'use_featured_image'    => 'Sử dụng làm ảnh đại diện',
//         'insert_into_item'      => 'Chèn vào Tuyển Dụng',
//         'uploaded_to_this_item' => 'Đã tải lên cho Tuyển Dụng này',
//         'items_list'            => 'Danh sách Tuyển Dụng',
//         'items_list_navigation' => 'Điều hướng danh sách Tuyển Dụng',
//         'filter_items_list'     => 'Lọc danh sách Tuyển Dụng',
//     );
    
//     $args = array(
//         'labels'              => $labels,
//         'public'              => true,
//         'publicly_queryable'  => true,
//         'show_ui'             => true,
//         'show_in_menu'        => true,
//         'query_var'           => true,
//         'rewrite'             => array('slug' => 'tuyen-dung'),
//         'capability_type'     => 'post',
//         'has_archive'         => false,
//         'hierarchical'        => false,
//         'menu_position'       => null,
//         'supports'            => array('title', 'thumbnail', 'excerpt'),
//         'menu_icon'           => 'dashicons-businessman',
//     );

//     register_post_type('tuyen-dung', $args);
// }
// add_action('init', 'create_tuyen_dung_post_type');

// function create_danh_muc_tuyen_dung_taxonomy() {
//     $labels = array(
//         'name'                       => 'Danh Mục Tuyển Dụng',
//         'singular_name'              => 'Danh Mục Tuyển Dụng',
//         'search_items'               => 'Tìm kiếm Danh Mục',
//         'popular_items'              => 'Danh Mục phổ biến',
//         'all_items'                  => 'Tất cả Danh Mục',
//         'parent_item'                => 'Danh Mục cha',
//         'parent_item_colon'          => 'Danh Mục cha:',
//         'edit_item'                  => 'Sửa Danh Mục',
//         'update_item'                => 'Cập nhật Danh Mục',
//         'add_new_item'               => 'Thêm Danh Mục mới',
//         'new_item_name'              => 'Tên Danh Mục mới',
//         'separate_items_with_commas' => 'Phân tách các Danh Mục bằng dấu phẩy',
//         'add_or_remove_items'        => 'Thêm hoặc xóa Danh Mục',
//         'choose_from_most_used'      => 'Chọn từ các Danh Mục được sử dụng nhiều nhất',
//         'not_found'                  => 'Không tìm thấy Danh Mục',
//         'menu_name'                  => 'Danh Mục Tuyển Dụng',
//     );

//     $args = array(
//         'hierarchical'          => true,
//         'labels'                => $labels,
//         'show_ui'               => true,
//         'show_admin_column'     => true,
//         'query_var'             => true,
//         'rewrite'               => array('slug' => 'tuyen-dung-category'),
//         'show_in_rest'          => true,
//     );

//     register_taxonomy('tuyen-dung-category', array('tuyen-dung'), $args);
// }
// add_action('init', 'create_danh_muc_tuyen_dung_taxonomy');

// ============================================================================
// RANK MATH SEO INTEGRATION
// ============================================================================
add_action('plugins_loaded', function() {
    // Bail if Rank Math isn't active
    if ( ! ( defined( 'RANK_MATH_VERSION' ) || function_exists( 'rank_math' ) || class_exists( 'RankMath' ) ) ) {
        return;
    }

    $custom_taxonomies = array(
        'danh-muc-san-pham',
        'danh-muc-dich-vu',
        'tuyen-dung-category',
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

// ============================================================================
// BREADCRUMB INTEGRATION FOR CUSTOM POST TYPES
// ============================================================================
add_filter( 'rank_math/frontend/breadcrumb/items', function( $crumbs, $class ) {

    if ( ! is_singular() ) {
        return $crumbs;
    }

    // Map CPT => taxonomy
    $map = array(
        'san-pham'    => 'danh-muc-san-pham',
        'dich-vu'     => 'danh-muc-dich-vu',
        'tuyen-dung'  => 'tuyen-dung-category',
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
    $term = $terms[0];

    // Build breadcrumb item: [ label, url ]
    $term_item = array( $term->name, get_term_link( $term ) );

    // Avoid duplicates: check if already present
    foreach ( $crumbs as $c ) {
        if ( isset( $c[1] ) && untrailingslashit( $c[1] ) === untrailingslashit( $term_item[1] ) ) {
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
