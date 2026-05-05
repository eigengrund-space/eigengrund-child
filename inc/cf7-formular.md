# Contact Form 7 – Formular für Erfahrungsberichte

## So verwendest du diese Datei

1. In WordPress: **Kontakt → Formulare → Neu erstellen**
2. Titel: "Erfahrungsbericht einreichen"
3. Den Inhalt unter "Formular" komplett ersetzen durch den Code unten
4. Die Formular-ID (oben in der URL: post=XXX) in `page-einreichen.php` eintragen
5. Unter "E-Mail" die Empfängeradresse einstellen

---

## Formular-Code (in CF7 "Formular"-Tab einfügen)

```
<div class="eg-step">
  <div class="eg-step-header">
    <div class="eg-step-num">1</div>
    <span class="eg-step-label">Ein paar Angaben zur Person</span>
  </div>

  <div class="eg-field eg-field-row-3">
    <div>
      <label class="eg-label" for="vorname">Vorname oder Pseudonym <span style="color:var(--eg-accent);">*</span></label>
      <span class="eg-sublabel">„Name geändert" ist auch möglich.</span>
      [text* vorname id:vorname placeholder "z. B. Claudia" autocomplete:off]
    </div>
    <div>
      <label class="eg-label" for="alter">Alter <span style="color:var(--eg-accent);">*</span></label>
      <span class="eg-sublabel">Ungefähr genügt.</span>
      [text* alter id:alter placeholder "z. B. 47" autocomplete:off]
    </div>
    <div>
      <label class="eg-label" for="beruf">Beruf oder Lebensbereich <span class="eg-optional">optional</span></label>
      <span class="eg-sublabel">Wird so angezeigt, wie du es schreibst.</span>
      [text beruf id:beruf placeholder "z. B. Ärztin, in Elternzeit" autocomplete:off]
    </div>
  </div>

  <div class="eg-field">
    <label class="eg-label" for="thema">Dein Thema <span style="color:var(--eg-accent);">*</span></label>
    <span class="eg-sublabel">In deinen eigenen Worten. Wir ordnen das redaktionell zu.</span>
    [text* thema id:thema placeholder "z. B. Das Gefühl, dass trotz allem etwas fehlt" autocomplete:off]
  </div>

  <div class="eg-field">
    <label class="eg-label" for="email">E-Mail-Adresse <span class="eg-optional">optional</span></label>
    <span class="eg-sublabel">Nur für Rückfragen. Wird nicht veröffentlicht.</span>
    [email email id:email placeholder "deine@email.de" autocomplete:off]
  </div>
</div>

<div class="eg-step">
  <div class="eg-step-header">
    <div class="eg-step-num">2</div>
    <span class="eg-step-label">Dein Bericht</span>
  </div>

  <div class="eg-hint">
    <div class="eg-hint-label">Bevor du anfängst</div>
    <div class="eg-hint-text">
      <p>Schreib so, wie du sprechen würdest – nicht wie ein Artikel. Was hast du erlebt? Was hat sich verändert? Was ist noch offen?</p>
      <p>Kein Happy End nötig. Manchmal ist das Ehrlichste: <em>Es ist noch nicht fertig – aber es ist anders als vorher.</em></p>
      <p>Konkrete Methoden oder Namen werden auf Wunsch anonymisiert.</p>
    </div>
  </div>

  <div class="eg-impulse-grid">
    <div class="eg-impulse-card">
      <div class="eg-impulse-title">Körper &amp; Geist</div>
      <ul class="eg-impulse-list">
        <li>Wie hat sich das körperlich angefühlt?</li>
        <li>Was ist mit Energie, Schlaf, Konzentration passiert?</li>
        <li>Wie klar oder chaotisch war dein Denken?</li>
      </ul>
    </div>
    <div class="eg-impulse-card">
      <div class="eg-impulse-title">Inneres Erleben</div>
      <ul class="eg-impulse-list">
        <li>Was hast du gefühlt – auch wenn du es nicht benennen konntest?</li>
        <li>Wie war dein Zugang zu dir selbst?</li>
        <li>Gab es einen Moment, der sich anders angefühlt hat?</li>
      </ul>
    </div>
    <div class="eg-impulse-card">
      <div class="eg-impulse-title">Beziehungen &amp; Umfeld</div>
      <ul class="eg-impulse-list">
        <li>Wie hat sich das auf deine Beziehungen ausgewirkt?</li>
        <li>Konntest du darüber sprechen – oder nicht?</li>
        <li>Was hat dir jemand gegeben, das du dir nicht selbst geben konntest?</li>
      </ul>
    </div>
    <div class="eg-impulse-card">
      <div class="eg-impulse-title">Veränderung &amp; heute</div>
      <ul class="eg-impulse-list">
        <li>Was ist heute anders – auch wenn es klein ist?</li>
        <li>Was ist noch offen, noch in Bewegung?</li>
        <li>Was würdest du jemandem sagen, der gerade dort ist, wo du warst?</li>
      </ul>
    </div>
  </div>

  <div class="eg-field">
    <label class="eg-label" for="bericht">Dein Bericht <span style="color:var(--eg-accent);">*</span></label>
    <span class="eg-sublabel">Die Impulse oben sind Einladungen – kein Schema.</span>
    [textarea* bericht id:bericht rows:14 placeholder "Schreib hier deinen Bericht …"]
  </div>
</div>

<div class="eg-step">
  <div class="eg-step-header">
    <div class="eg-step-num">3</div>
    <span class="eg-step-label">Ein letzter Satz</span>
  </div>
  <div class="eg-abschluss">
    <div class="eg-abschluss-frage">Wenn du deine Entwicklung in einem einzigen Satz beschreiben würdest – wie würde er lauten?</div>
    <div class="eg-abschluss-note">Manchmal ergibt sich dieser Satz erst, wenn man fertig geschrieben hat. Es muss kein perfekter Satz sein – nur ein ehrlicher.</div>
    [textarea abschluss_satz id:abschluss rows:2 placeholder "z. B. „Es ist nicht fertig – aber es ist anders als vorher.""]
  </div>
</div>

<div class="eg-sicht-group">
  <span class="eg-sicht-label">Wie soll dein Bericht erscheinen? <span style="color:var(--eg-accent);">*</span></span>
  <span class="eg-sicht-sublabel">Du kannst deine Wahl nach Veröffentlichung jederzeit ändern.</span>
  [radio sichtbarkeit default:1 "Für alle sichtbar" "Für Angemeldete (kostenlose Registrierung)" "Nur für Mitglieder (aktive Mitgliedschaft)"]
</div>

<div class="eg-hinweis">
  <strong>Redaktioneller Hinweis.</strong> Alle Berichte werden vor Veröffentlichung gelesen. Namen und Methoden werden auf Wunsch anonymisiert.
</div>

[acceptance check1] Ich bin damit einverstanden, dass mein Bericht nach redaktioneller Prüfung veröffentlicht werden darf. [/acceptance]

[acceptance check2] Ich habe verstanden, dass erkennbare Details anonymisiert werden können. [/acceptance]

[submit "Bericht einsenden"]
```

---

## E-Mail-Template (in CF7 "E-Mail"-Tab)

**Betreff:**
```
Neuer Erfahrungsbericht – [thema]
```

**Nachrichtentext:**
```
Neuer Erfahrungsbericht eingegangen.

PERSON
Vorname: [vorname]
Alter: [alter]
Beruf: [beruf]
E-Mail: [email]

THEMA
[thema]

SICHTBARKEIT
[sichtbarkeit]

BERICHT
[bericht]

ABSCHLUSSSATZ
[abschluss_satz]

---
Eingegangen über eigengrund.space
```

---

## CF7-CSS ergänzen (in style.css oder CF7-Einstellungen)

CF7 erzeugt eigene Klassen. Diese Regeln sorgen dafür,
dass CF7-Elemente genauso aussehen wie die eigengrund-Inputs:

```css
/* CF7 Inputs ans eigengrund-Design anpassen */
.wpcf7 input[type="text"],
.wpcf7 input[type="email"],
.wpcf7 textarea {
    width: 100%;
    font-family: var(--eg-font-sans);
    font-weight: 400;
    font-size: 14px;
    color: var(--eg-text);
    background: var(--eg-bg-input);
    border: .5px solid var(--eg-border-input);
    border-radius: var(--eg-radius-sm);
    padding: .8rem 1rem;
    outline: none;
    transition: border-color .2s;
    -webkit-appearance: none;
}
.wpcf7 input:focus,
.wpcf7 textarea:focus {
    border-color: var(--eg-border-focus);
}
.wpcf7 input[type="submit"] {
    font-family: var(--eg-font-sans);
    font-weight: 400;
    font-size: 12px;
    letter-spacing: .08em;
    text-transform: uppercase;
    background: var(--eg-btn-bg);
    color: var(--eg-btn-txt);
    padding: .85rem 2rem;
    border-radius: var(--eg-radius-sm);
    border: none;
    cursor: pointer;
    min-height: 44px;
    transition: opacity .2s;
}
.wpcf7 input[type="submit"]:hover { opacity: .88; }
.wpcf7-spinner { display: none !important; } /* eigengrund hat eigene Ladelogik */
```
