<?php
/**
 * Template Name: Trang Sản Phẩm
 * Description: Template cho trang danh sách sản phẩm với ACF fields
 * 
 * Note: Trang này chỉ dùng để nhập dữ liệu ACF.
 * Danh sách sản phẩm thực tế được render từ archive-san-pham.php
 */

get_header();

// Redirect to archive if this page is accessed directly
$archive_link = get_post_type_archive_link('san-pham');
if ($archive_link && !is_admin()) {
    wp_redirect($archive_link);
    exit;
}

get_footer();
