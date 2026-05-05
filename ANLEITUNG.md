# ANLEITUNG – eigengrund.space Child Theme
## Schritt-für-Schritt Installation auf IONOS

---

## ÜBERBLICK: Was du am Ende hast

- WordPress auf eigengrund.space mit eurem Design
- Startseite mit Eingangsbereich, Themen-Grid, Archiv, CTA
- Erfahrungsberichte-Formular mit Contact Form 7
- E-Mail-Versand direkt über euren IONOS-Mailserver (kein Formspree)
- Tag/Nacht-Toggle mit gespeicherter Präferenz
- Alle Design-Tokens an einer Stelle (style.css)

**Zeitaufwand:** ca. 2–3 Stunden

---

## SCHRITT 1: WordPress auf IONOS installieren

1. IONOS-Dashboard öffnen: https://my.ionos.de
2. → "Hosting" → eure Domain "eigengrund.space"
3. → "WordPress" → "1-Klick-Installation"
4. Sprache: Deutsch
5. Verzeichnis: leer lassen (direkt im Hauptverzeichnis)
6. Admin-Benutzername und Passwort notieren (sicher aufbewahren!)
7. Installation starten → dauert ca. 2–5 Minuten

**Nach der Installation:**
- WordPress-Admin: https://eigengrund.space/wp-admin
- Mit euren Zugangsdaten einloggen

---

## SCHRITT 2: Kadence Theme installieren

1. Im WordPress-Admin: **Design → Themes → Neues Theme hinzufügen**
2. Suche: "Kadence"
3. Kadence (von Kadence WP) → **Installieren → Aktivieren**

---

## SCHRITT 3: eigengrund Child Theme hochladen

1. Im WordPress-Admin: **Design → Themes → Theme hochladen**
2. Die Datei `eigengrund-child.zip` auswählen
3. **Installieren → Aktivieren**

Das Child Theme ist jetzt aktiv. Die Seite sieht noch nach Standard-WordPress aus
– das wird sich ändern wenn wir Seiten mit den richtigen Templates anlegen.

---

## SCHRITT 4: SMTP konfigurieren (E-Mail über IONOS)

Damit WordPress E-Mails verschicken kann, müssen wir die
IONOS-Zugangsdaten in der `functions.php` eintragen.

**IONOS-Zugangsdaten finden:**
1. IONOS-Dashboard → E-Mail → eure E-Mail-Adresse → "Einstellungen"
2. Notiert: SMTP-Server (smtp.ionos.de), Port (587), E-Mail-Adresse, Passwort

**In WordPress:**
1. Im WordPress-Admin: **Design → Theme-Editor**
2. Rechts: "Child Theme: functions.php" auswählen
3. Diese zwei Zeilen finden und anpassen:
   ```php
   $phpmailer->Username = 'info@eigengrund.space'; // ← eure E-Mail
   $phpmailer->Password = 'EUER_IONOS_PASSWORT';   // ← euer Passwort
   ```
4. "Datei aktualisieren"

**Test:**
1. Im WordPress-Admin: **Werkzeuge → Website-Integrität → E-Mail-Test senden**
   (Alternativ: Plugin "WP Mail Log" installieren für Test)

---

## SCHRITT 5: Plugins installieren

Im WordPress-Admin: **Plugins → Neues Plugin**

**Pflicht:**
- **Contact Form 7** (von Takayuki Miyoshi) – für das Einreichungsformular
- **WP Mail SMTP** (optional, als Alternative zur functions.php SMTP-Config)

**Empfohlen:**
- **Wordfence Security** – Sicherheit
- **UpdraftPlus** – automatische Backups
- **Yoast SEO** – SEO-Optimierung

---

## SCHRITT 6: Startseite anlegen

1. Im WordPress-Admin: **Seiten → Neu erstellen**
2. Titel: "Startseite"
3. Rechts unter "Seitenattribute" → "Template": **Startseite** wählen
4. Inhalt: leer lassen (das Template hat alles)
5. **Veröffentlichen**

6. Im WordPress-Admin: **Einstellungen → Lesen**
7. "Startseite zeigt" → "Eine statische Seite"
8. Startseite: "Startseite" auswählen
9. **Speichern**

---

## SCHRITT 7: Contact Form 7 Formular erstellen

1. Im WordPress-Admin: **Kontakt → Formulare → Neu erstellen**
2. Titel: "Erfahrungsbericht einreichen"
3. Den Inhalt der Datei `inc/cf7-formular.md` öffnen
4. Den Code unter "FORMULAR-CODE" in den CF7 "Formular"-Tab kopieren
5. Den E-Mail-Template-Code in den "E-Mail"-Tab kopieren
6. **Speichern**
7. Die Formular-ID notieren (steht in der URL: `post=123`)

---

## SCHRITT 8: Einreichungs-Seite anlegen

1. Im WordPress-Admin: **Seiten → Neu erstellen**
2. Titel: "Erfahrungsbericht einreichen"
3. URL/Slug: `erfahrungsbericht-einreichen`
4. Template: **Erfahrungsbericht einreichen**
5. **Veröffentlichen**

6. Die Datei `templates/page-einreichen.php` öffnen
7. Die CF7-Formular-ID eintragen:
   ```php
   $cf7_form_id = 123; // ← eure echte ID
   ```
8. Datei speichern und per FTP/Dateimanager hochladen nach:
   `/wp-content/themes/eigengrund-child/templates/page-einreichen.php`

---

## SCHRITT 9: Google Fonts lokal hosten (DSGVO)

Damit keine IP-Adressen an Google übermittelt werden:

1. Auf https://gwfh.mranftl.com/fonts gehen
2. "Cormorant Garamond" suchen → alle Schnitte (300, 400, italic) herunterladen
3. "Lato" suchen → 300, 400 herunterladen
4. Die `.woff2`-Dateien in `/wp-content/themes/eigengrund-child/fonts/` hochladen
5. In der `functions.php` den Google-Fonts-Link entfernen und stattdessen
   lokale @font-face Regeln am Anfang der `style.css` einfügen:

```css
@font-face {
    font-family: 'Cormorant Garamond';
    font-style: normal;
    font-weight: 300;
    src: url('fonts/cormorant-garamond-300.woff2') format('woff2');
    font-display: swap;
}
/* ... weitere Schnitte analog */
```

6. In der `functions.php` die Zeilen für Google Fonts auskommentieren:
```php
// wp_enqueue_style( 'eigengrund-fonts', ... );
```

---

## SCHRITT 10: Impressum & Datenschutz

1. Im WordPress-Admin: **Seiten → Neu erstellen**
2. Titel: "Impressum" → Text aus eurer bestehenden `Impressum.html` einfügen
3. Titel: "Datenschutz" → Text aus eurer bestehenden `Datenschutz.html` einfügen
4. Beide veröffentlichen
5. Die URLs in `functions.php` und den Templates anpassen

---

## DESIGN ANPASSEN – Schnellreferenz

**Farbe ändern:**
Datei: `style.css` → Abschnitt `:root { ... }`
Beispiel: `--eg-amber: #D4956A;` → andere Farbe eintragen

**Button-Animation stärker:**
Datei: `style.css`
`--eg-btn-hover-lift: translateY(-3px);` (war: -1px)

**Icon in Button:**
```html
<a class="eg-btn eg-btn--primary">
    <span class="eg-icon">🔒</span> Nur für Mitglieder
</a>
```

**Mitglieder-Badge:**
```html
<span class="eg-badge eg-badge--member">Mitglieder</span>
<span class="eg-badge eg-badge--premium">Premium</span>
```

**Kontrast erhöhen:**
`--eg-text-muted: rgba(30,27,20,.95);` (näher an 1 = dunkler)

---

## HÄUFIGE PROBLEME

**E-Mails kommen nicht an:**
→ SMTP-Zugangsdaten in `functions.php` prüfen
→ Port 587 versuchen, wenn 465 nicht funktioniert
→ IONOS-Support fragen ob SMTP aktiv ist

**Child Theme wird nicht angezeigt:**
→ Prüfen ob Kadence (Parent) aktiv ist
→ In `style.css` die erste Zeile: `Template: kadence` muss stimmen

**CF7-Formular sieht falsch aus:**
→ Den CSS-Block aus `inc/cf7-formular.md` ans Ende der `style.css` kopieren

**Seite zeigt falsches Template:**
→ In der Seite (Backend): Seitenattribute → Template prüfen
→ Cache leeren (Plugin "WP Super Cache" oder IONOS-Cache)

---

## DATEIEN-ÜBERSICHT

```
eigengrund-child/
├── style.css                    ← Design-Tokens + alle CSS-Regeln
├── functions.php                ← SMTP, Enqueues, Plugin-Config
├── js/
│   └── toggle.js               ← Tag/Nacht Toggle
├── templates/
│   ├── page-startseite.php     ← Startseiten-Template
│   └── page-einreichen.php     ← Formular-Template
├── inc/
│   └── cf7-formular.md         ← CF7-Formular-Code + Anleitung
└── ANLEITUNG.md                ← diese Datei
```

---

Fragen? Claude hilft weiter – einfach die konkrete Fehlermeldung
oder den Schritt beschreiben, bei dem es nicht weitergeht.
