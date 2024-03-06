(function( $ ) {
	'use strict';

	/**
	 * All of the code for your admin-facing JavaScript source
	 * should reside in this file.
	 *
	 * Note: It has been assumed you will write jQuery code here, so the
	 * $ function reference has been prepared for usage within the scope
	 * of this function.
	 *
	 * This enables you to define handlers, for when the DOM is ready:
	 *
	 * $(function() {
	 *
	 * });
	 *
	 * When the window is loaded:
	 *
	 * $( window ).load(function() {
	 *
	 * });
	 *
	 * ...and/or other possibilities.
	 *
	 * Ideally, it is not considered best practise to attach more than a
	 * single DOM-ready or window-load handler for a particular page.
	 * Although scripts in the WordPress core, Plugins and Themes may be
	 * practising this, we should strive to set a better example in our own work.
	 */

})( jQuery );

let countdownInterval;

function stopAndResetTimer() {
    clearInterval(countdownInterval);
    document.getElementById('resultatTimerClient').innerText = 'Timer arrêté';

    // Supprime la valeur de targetTime du stockage local
    localStorage.removeItem('targetTime');
}

function formatTime(time) {
    return time < 10 ? '0' + time : time;
}

function scheduleTimerForAdmin() {
    let title = document.getElementById('timerTitle').value;
    let date = document.getElementById('timerDate').value;
    let time = document.getElementById('timerTime').value;
    let dateTime = date + ' ' + time;
    let targetTime = new Date(dateTime).getTime();

    // Enregistre la valeur de targetTime dans le stockage local
    localStorage.setItem('targetTime', targetTime);

    // Réinitialise le contenu de resultatTimerClient
    document.getElementById('resultatTimerClient').innerText = '';

    // Arrête le timer actuel s'il existe
    if (countdownInterval) {
        clearInterval(countdownInterval);
    }

    scheduleTimer(targetTime, 'resultatTimerClient');
}

function scheduleTimer(targetTime, displayId) {
    countdownInterval = setInterval(function () {
        let now = new Date().getTime();
        let timeRemaining = targetTime - now;

        if (timeRemaining > 0) {
            let days = Math.floor(timeRemaining / (3600 * 24 * 1000));
            let hours = Math.floor((timeRemaining % (3600 * 24 * 1000)) / (3600 * 1000));
            let minutes = Math.floor((timeRemaining % (3600 * 1000)) / (60 * 1000));
            let seconds = Math.floor((timeRemaining % (60 * 1000)) / 1000);

            let countdownDisplay = days + 'j ' + hours + 'h ' + minutes + 'm ' + seconds + 's';
            document.getElementById(displayId).innerText = countdownDisplay;
        } else {
            clearInterval(countdownInterval);
            document.getElementById(displayId).innerText = 'Temps écoulé!';
        }
    }, 1000);
}

// Code pour exécuter le timer côté client
document.addEventListener('DOMContentLoaded', function () {
    let resultatContainer = document.getElementById('resultatTimerClient');
    if (resultatContainer) {
        // Vérifie si targetTime est présent dans le stockage local
        let storedTargetTime = localStorage.getItem('targetTime');
        if (storedTargetTime) {
            // Si présent, démarre le timer avec la valeur stockée
            scheduleTimer(storedTargetTime, 'resultatTimerClient');
        }
    }
});