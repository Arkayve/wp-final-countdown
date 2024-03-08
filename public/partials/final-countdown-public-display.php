<?php

/**
 * Provide a public-facing view for the plugin
 *
 * This file is used to markup the public-facing aspects of the plugin.
 *
 * @link       https://aurelien.net
 * @since      1.0.0
 *
 * @package    Final_Countdown
 * @subpackage Final_Countdown/public/partials
 */
?>

<!-- This file should primarily consist of HTML with a little bit of PHP. -->
<?php
 
$result = getAnnouncementInProgress(true);

foreach ($result as $row) {
    if ($row->file_name) {
?>
        <div data-id="<?= $row->id_headband ?>" style="background-image:url('http://wp-plugin.local/wp-content/plugins/final-countdown/admin/uploads/<?= $row->file_name ?>');height:<?= $row->height ?>px" class="update-nag notice notice-success inline hb_container">
<?php
    } else {
?>
        <div data-id="<?= $row->id_headband ?>" style="background-color:<?= $row->bg_color ?>;height:<?= $row->height ?>px" class="update-nag notice notice-success inline hb_container">
<?php
    };
    if (intval($row->display_text) === 1) {
?>
        <h2 style="color:<?= $row->title_color ?>" class="hb_ttl"><?= $row->title ?></h2>
        <h3 style="color:<?= $row->text_color ?>" class="hb_text"><?= $row->text ?></h3>
        <p>Du <?= $row->start_timer ?> au <?= $row->end_timer ?>.</p>
<?php        
    };
?>
        </div>

<?php
};