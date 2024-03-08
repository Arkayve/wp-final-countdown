<?php
 
$result = getAnnouncementInProgress(false);

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
    $checked = $row->display_headband ? '🟢' : '🔴';
    $text = $row->display_text ? '☑️' : '➖';
    if (intval($row->display_text) === 1) {
?>
        <h2 style="color:<?= $row->title_color ?>" class="hb_ttl"><?= $row->title ?></h2>
        <h3 style="color:<?= $row->text_color ?>" class="hb_text"><?= $row->text ?></h3>
        <p>Du <?= $row->start_timer ?> au <?= $row->end_timer ?>.</p>
<?php        
    };
?>
        </div>
        <div class='headband_utilities'>
            <form action="?id=<?= $row->id_headband ?>&action=display-text" method="POST">
                <input type="hidden" name="display-text" value=<?= $text ===  '☑️' ? true : false ?>>
                <div class="util">
                    <input type="submit" value=<?= $text ?>>
                    <p>Textes</p>
                </div>
            </form>
            <form action="?id=<?= $row->id_headband ?>&action=display-headband" method="POST">
                <input type="hidden" name="display-headband" value=<?= $checked ===  '🟢' ? true : false ?>>
                <div class="util">
                    <input type="submit" value=<?= $checked ?>>
                    <p>Afficher</p>
                </div>
            </form>
            <form action="?id=<?= $row->id_headband ?>&action=mod-headband" method="POST">
                <div class="util">
                    <input type="submit" value="⚙️">
                    <p>Modifier</p>
                </div>
            </form>
            <form action="?id=<?= $row->id_headband ?>&action=del-headband" method="POST">
                <div class="util">
                    <input type="submit" value="❌">
                    <p>Supprimer</p>
                </div>
            </form>
        </div>
<?php
};
