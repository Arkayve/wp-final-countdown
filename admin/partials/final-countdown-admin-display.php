<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       https://aurelien.net
 * @since      1.0.0
 *
 * @package    Final_Countdown
 * @subpackage Final_Countdown/admin/partials
 */
?>

<!-- This file should primarily consist of HTML with a little bit of PHP. -->
<div class="update-nag notice notice-success inline plugin-container">
    <h1>Programmer un nouveau bandeau</h1>
    <form id="timerForm" method="POST" action="?action=save-headband">
        <div>
            <label for="title">Titre du bandeau :</label>
            <input type="text" id="title" name="title" rows="1" cols="50" required>
            <label for="titleColor">Couleur du titre :</label>
            <input type="color" id="titleColor" name="titleColor" value="#000000">
        </div>
        <div>
            <label for="text">Texte :</label>
            <input type="text" id="text" name="text" rows="1" cols="50"></input>
            <label for="textColor">Couleur du texte :</label>
            <input type="color" id="textColor" name="textColor" value="#000000">
        </div>
        <div>
            <label for="bg-color">Ajouter une couleur de fond au bandeau :</label>
            <input type="color" id="bg-color" name="bg-color" value="#ffffff">
        </div>
        <div>
            <label for="bg-img">Ajouter une image de fond au bandeau :</label>
            <input name="bg-img" type="file" id="bg-img" accept="png, jpg">
        </div>
        <div>
            <label for="startTimer">Date de début :</label>
            <input type="datetime-local" id="startTimer" name="startTimer" required>
            <label for="endTimer">Date de fin :</label>
            <input type="datetime-local" id="endTimer" name="endTimer" required>
        </div>
        <input id="create" type="submit" value="Créer le bandeau">
    </form>
</div>

<?php
// var_dump($_POST);

$resultForModify = isset($_POST['modifyHeadband']) ? getAnnouncementForModify() : array();
foreach ($resultForModify as $row) {
    // var_dump($resultForModify);
?>
    <div class="update-nag notice notice-success inline plugin-container">
        <h2>Modifier un bandeau</h2>
        <form id="timerForm" method="POST">
        <input type="hidden" name="id_headband" value="<?= $row->id_headband ?>">
            <div>
                <label for="title">Titre du bandeau :</label>
                <input type="text" id="title" name="title" rows="1" cols="50" value="<?= $row->title ?>" required>
                <label for="titleColor">Couleur du titre :</label>
                <input type="color" id="titleColor" name="titleColor" value="<?= $row->title_color ?>">
            </div>
            <div>
                <label for="text">Texte :</label>
                <input type="text" id="text" name="text" rows="1" cols="50" value="<?= $row->text ?>">
                <label for="textColor">Couleur du texte :</label>
                <input type="color" id="textColor" name="textColor" value="<?= $row->text_color ?>">
            </div>
            <div>
                <label for="bg-color">Ajouter une couleur de fond au bandeau :</label>
                <input type="color" id="bg-color" name="bg-color" value="<?= $row->bg_color ?>">
            </div>
            <div>
                <label for="bg-img">Ajouter une image de fond au bandeau :</label>
                <input name="bg-img" type="file" id="bg-img" accept="png, jpg" value="">
            </div>
            <div>
                <label for="startTimer">Date de début :</label>
                <input type="datetime-local" id="startTimer" name="startTimer" value="<?= DateTime::createFromFormat('d/m/Y à H:i', $row->start_timer)->format('Y-m-d\TH:i') ?>" required>
                <label for="endTimer">Date de fin :</label>
                <input type="datetime-local" id="endTimer" name="endTimer" value="<?= DateTime::createFromFormat('d/m/Y à H:i', $row->end_timer)->format('Y-m-d\TH:i') ?>" required>
            </div>
            <button type="submit" name="updateHeadband">Modifier</button>
        </form>
    </div>
<?php
}
?>


<?php
include('announcement_in_progress.php');
