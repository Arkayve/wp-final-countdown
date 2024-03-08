<?php

deleteAnnouncement();

$result = getAnnouncementInProgress();
foreach ($result as $row) {
    // var_dump($result);
?>
    <div data-id="<?= $row->id_headband ?>" style="background-color:<?= $row->bg_color ?>" class="update-nag notice notice-success inline hb_container">
        <h2 style="color:<?= $row->title_color ?>" class="hb_ttl"><?= $row->title ?></h2>
        <h3 style="color:<?= $row->text_color ?>" class="hb_text"><?= $row->text ?></h3>
        <p>Du <?= $row->start_timer ?> au <?= $row->end_timer ?>.</p>
        <div>
            <form method="POST">
                <input type="hidden" name="id_headband" value="<?= $row->id_headband ?>">
                <button type="submit" name="modifyHeadband">Modifier le bandeau</button>
                <button type="submit" name="deleteHeadband">Supprimer le bandeau</button>
            </form>
        </div>
    </div>
<?php
};