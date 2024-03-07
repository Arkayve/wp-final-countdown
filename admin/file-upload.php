<?php

$file = $_FILES['bg-img'];

global $wpdb;
$table_name = $wpdb->prefix . 'headband_files';
$wpdb->insert(
    $table_name,
    array(
        'file_name' => sanitize_text_field($file['name']),
        'file_full_path' => sanitize_text_field($file['full_path']),
        'file_type' => sanitize_text_field($file['type']),
        'file_tmp_name' => sanitize_text_field($file['tmp_name']),
        'file_error' => sanitize_text_field($file['error']),
        'file_size' => sanitize_text_field($file['size']),
        'id_headband' => sanitize_text_field($lastId),
    )
);

move_uploaded_file($file['tmp_name'], 'C:/Users/fwcha/Local Sites/wp-plugin/app/public/wp-content/plugins/final-countdown/admin/uploads/' . $file['name']);