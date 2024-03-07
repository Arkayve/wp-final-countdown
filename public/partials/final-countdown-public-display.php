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
 
$result = getAnnouncementInProgress();
foreach ($result as $row) {
?>
    <div data-id="<?= $row->id_headband ?>" style="background-color:<?= $row->bg_color ?>" class="update-nag notice notice-success inline hb_container">
        <h2 style="color:<?= $row->title_color ?>" class="hb_ttl"><?= $row->title ?></h2>
        <h3 style="color:<?= $row->text_color ?>" class="hb_text"><?= $row->text ?></h3>
        <p>Du <?= $row->start_timer ?> au <?= $row->end_timer ?>.</p>
    </div>
<?php
};