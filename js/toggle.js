/**
 * eigengrund.space – Tag/Nacht Toggle
 * Speichert die Präferenz des Nutzers im localStorage.
 * Lädt beim nächsten Besuch sofort den gespeicherten Modus
 * (kein Flackern, weil das Script im Footer läuft).
 */

(function () {
    'use strict';

    var STORAGE_KEY = 'eg-theme';
    var DARK_CLASS  = 'eg-dark';

    // Gespeicherten Modus beim Laden wiederherstellen
    function restoreTheme() {
        try {
            if ( localStorage.getItem( STORAGE_KEY ) === 'dark' ) {
                document.body.classList.add( DARK_CLASS );
                updateToggleLabel( false );
            }
        } catch (e) {}
    }

    // Label im Toggle aktualisieren
    function updateToggleLabel( isLight ) {
        var lbl = document.getElementById( 'eg-toggle-lbl' );
        if ( lbl ) lbl.textContent = isLight ? 'Tag' : 'Nacht';
    }

    // Toggle-Funktion – wird vom onclick aufgerufen
    window.egToggleMode = function () {
        var isNowDark = document.body.classList.toggle( DARK_CLASS );
        updateToggleLabel( ! isNowDark );
        try {
            localStorage.setItem( STORAGE_KEY, isNowDark ? 'dark' : 'light' );
        } catch (e) {}
    };

    // Beim Laden ausführen
    document.addEventListener( 'DOMContentLoaded', restoreTheme );

}());
