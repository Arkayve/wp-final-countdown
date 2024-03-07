<?php
 
$result = getAnnouncementInProgress();

foreach ($result as $row) {
    if (!is_null($row->file_name)) {
?>
        <div data-id="<?= $row->id_headband ?>" style="background-image:url('http://wp-plugin.local/wp-content/plugins/final-countdown/admin/uploads/<?= $row->file_name ?>')" class="update-nag notice notice-success inline hb_container">
<?php
    } else {
?>
        <div data-id="<?= $row->id_headband ?>" style="background-color:<?= $row->bg_color ?>" class="update-nag notice notice-success inline hb_container">
<?php
    };
?>
            <h2 style="color:<?= $row->title_color ?>" class="hb_ttl"><?= $row->title ?></h2>
            <h3 style="color:<?= $row->text_color ?>" class="hb_text"><?= $row->text ?></h3>
            <p>Du <?= $row->start_timer ?> au <?= $row->end_timer ?>.</p>
        </div>
<?php
};
