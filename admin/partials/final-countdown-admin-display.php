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
<br>
<div class="update-nag notice notice-success inline">
    <h2>Programmation du Timer</h2>

    <form id="timerForm">
        <label for="timerTitle">Titre du Timer :</label>
        <input type="text" id="timerTitle" name="timerTitle" required>

        <label for="timerDate">Date:</label>
        <input type="date" id="timerDate" name="timerDate" required>

        <label for="timerTime">Heure:</label>
        <input type="time" id="timerTime" name="timerTime" required>

        <button type="button" onclick="scheduleTimerForAdmin()">Programmer et afficher le Timer</button>

        <button type="button" onclick="stopAndResetTimer(); stopTimerForClient();">Arrêter et le Timer</button>

    </form>

    <div>
        <h3>Temps restant :</h3>

        <!-- <div id="timerTitle"></div> -->
        <div id="resultatTimerClient"></div>
    </div>

</div>