<?php
/**
 * Template Name: Trang Dịch Vụ
 * Description: Template cho trang danh sách dịch vụ với ACF fields
 * 
 * Note: Trang này chỉ dùng để nhập dữ liệu ACF.
 * Danh sách dịch vụ thực tế được render từ archive-dich-vu.php
 */

get_header();

// Redirect to archive if this page is accessed directly
$archive_link = get_post_type_archive_link('dich-vu');
if ($archive_link && !is_admin()) {
    wp_redirect($archive_link);
    exit;
}

get_footer();
