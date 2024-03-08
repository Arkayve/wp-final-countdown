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
<?php
    $modHb = isset($_SESSION['result']) ? true : false;
?>

<div class="update-nag notice notice-success inline plugin-container">
    <h1><?= $modHb ? 'Modifier le bandeau' : 'Programmer un nouveau bandeau' ?></h1>
    <form id="timerForm" method="POST" action="?action=<?= $modHb ? 'modify' : 'save' ?>-headband<?= $modHb ? '&id=' . $_SESSION['result']->id_headband : '' ?>" enctype="multipart/form-data">
        <div class="plugin-container-row">
            <label for="title">Titre du bandeau :</label>
            <input type="text" id="title" name="title" rows="1" cols="50" value="<?= $modHb ? $_SESSION['result']->title : '' ?>">
            <label for="titleColor">Couleur du titre :</label>
            <input type="color" id="titleColor" name="titleColor" value="<?= $modHb ? $_SESSION['result']->title_color : '#000000' ?>">
        </div>
        <div class="plugin-container-row">
            <label for="text">Texte :</label>
            <input type="text" id="text" name="text" rows="1" cols="50" value="<?= $modHb ? $_SESSION['result']->text : '' ?>">
            <label for="textColor">Couleur du texte :</label>
            <input type="color" id="textColor" name="textColor" value="<?= $modHb ? $_SESSION['result']->text_color : '#000000' ?>">
        </div>
        <div class="plugin-container-row">
            <label for="bg-color">Ajouter une couleur de fond au bandeau :</label>
            <input type="color" id="bg-color" name="bg-color" value="<?= $modHb ? $_SESSION['result']->bg_color : '#FFFFFF' ?>">
        </div> 
        <div class="plugin-container-row">
            <label for="bg-img">Ajouter une image de fond au bandeau :</label>
            <input name="bg-img" type="file" id="bg-img" accept="png, jpg" value="<?= isset($_SESSION['result']->file_name) ? $_SESSION['result']->file_name : '' ?>">
        </div>
        <div class="plugin-container-row">
            <label for="startTimer">Date de début :</label>
            <input type="datetime-local" id="startTimer" name="startTimer" value="<?= $modHb ? $_SESSION['result']->start_timer : '' ?>">
            <label for="endTimer">Date de fin :</label>
            <input type="datetime-local" id="endTimer" name="endTimer" value="<?= $modHb ? $_SESSION['result']->end_timer : '' ?>">
        </div>
        <div class="plugin-container-row">
            <label for="height">Hauteur du bandeau (en pixels):</label>
            <input type="number" id="height" name="height" value="<?= $modHb ? $_SESSION['result']->height : '400' ?>">
            <input id="create" type="submit" value="<?= $modHb ? 'Modifier' : 'Créer' ?>">
        </div>
    </form>
</div>

<?php
unset($_SESSION['result']);
include ('announcement_in_progress.php');