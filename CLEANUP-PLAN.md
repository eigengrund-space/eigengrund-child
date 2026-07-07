# CLEANUP-PLAN – eigengrund-child

Status: **alle drei geplanten Schritte erledigt.** Diese Datei dient nur noch
als Nachweis, was gemacht wurde und warum – kein offener Arbeitsauftrag mehr.

## Vorgeschichte

Ursprüngliche Analyse deckte `style.css`, `functions.php` und alle
`page-*.php`-Templates ab. Nach Prüfung der WP-Seiten-Zuordnung wurden fünf
ungenutzte Dateien gelöscht: `page-thema.php`, `page-prozess.php`,
`templates/page-startseite.php`, `templates/page-einreichen.php`,
`page-coming-soon.php`. Damit waren mehrere ursprünglich geplante Punkte
(Farbmigration Thema/Prozess/Einreichen/Coming-Soon, Google-Fonts-Fix,
Modal-Dopplung, Startseiten-Duplikat) hinfällig.

## Erledigt

1. **Share-Button konsolidiert** – `eg_share_button_markup()` /
   `eg_share_button_assets()` in `functions.php` hatten Farb-/Layout-Styles
   inline bzw. in einem eigenen `<style>`-Block im `wp_footer`-Hook. Beides
   nach `style.css` Abschnitt 23 verschoben (`.eg-share`, `.eg-share-btn`,
   `.eg-share-menu`, `.eg-share-divider`, `.eg-share-opt`, `.eg-share-icon`).
   Reiner Ortswechsel, keine Wertänderung.
   *(Bekannter, bewusst nicht mitgefixter Nebenbefund: `.eg-share-menu` hat
   `background: #fff` fest verdrahtet statt `var(--eg-bg-card)` – dadurch
   bleibt das Menü im Nacht-Modus weiß. War schon im Original so.)*

2. **`page-startseite.php` (Root) auf Marken-Farben/Fonts umgestellt.**
   Korrektur gegenüber der ursprünglichen Einschätzung: nicht nur der
   Hero-Verlauf war hartcodiert, der komplette `<style>`-Block
   (`.egs-hero`, `.egs-hero-bg`, `.egs-h1`, `.egs-lead`) nutzte noch die alte
   Palette (`#FAF0D8`/`#1E1B14`/`#6B3A1F`) und `'Cormorant Garamond'` statt
   `var(--eg-font-serif)`. Migriert auf:
   - `--eg-hero-gradient` (neue Variable in `style.css`, exakt der
     bisherige Verlauf, nur zentralisiert)
   - `--eg-hero-text` / `--eg-hero-accent` / `--eg-hero-muted` (neue,
     **absichtlich nicht Dark-Mode-reaktive** Tokens, da die Hero-Sektion
     immer einen hellen Verlauf-Hintergrund hat – `var(--eg-text)`/
     `var(--eg-amber)` hätten im Nacht-Modus zu hellem Text auf hellem
     Hintergrund geführt)
   - `var(--eg-font-serif)` statt `'Cormorant Garamond'`

3. **`page-erfahrungsbericht.php` farblich/typografisch migriert** –
   alle `rgba(30,27,20,…)`, `#D4956A`, `#1E1B14`, `#8B4513`, `#6B3A1F`,
   `#F7F0E6`, `#3A3428`, `'Cormorant Garamond'`, `'Lato'` ersetzt durch die
   bestehenden Design-Tokens. Bemerkenswerte Zuordnungen:
   - `.egeb-sicht--angemeldet` / `--mitglieder` (Sichtbarkeits-Badges)
     nutzen jetzt dieselben Tokens wie die bereits vorhandenen
     `.eg-badge--member` / `.eg-badge--premium` – dadurch reagieren sie
     jetzt korrekt auf den Tag/Nacht-Toggle (vorher fix, unabhängig vom
     Modus).
   - `.egeb-rule` nutzt `var(--eg-rule)` statt `var(--eg-amber)` – das ist
     der dedizierte, im Nacht-Modus bewusst gedämpfte Token für
     Trennlinien (`--eg-rule` ≠ `--eg-amber` im Dark Mode).
   - `.egeb-cta a:hover` von hartem Hintergrundwechsel (`#3A3428`) auf
     `opacity:.88` umgestellt – entspricht dem Hover-Verhalten von
     `.eg-btn--primary` überall sonst auf der Seite.
   - Einzelne Opazitätswerte (z. B. `.45` statt `.75` bei
     `--eg-text-faint`) wurden auf den nächstliegenden bestehenden Token
     gemappt statt neue Ein-Zweck-Variablen anzulegen – kleine, kaum
     wahrnehmbare Gewichtsunterschiede, dafür ein einheitliches System.

Alle drei Commits liegen auf `staging` und wurden gepusht (Auto-Deploy
via GitHub Actions).

## Weiterhin offen, aber nicht dateigebunden

Die beiden leeren "Start:"-Block-Patterns
(`eigengrund/start-erfahrungsberichte`, `eigengrund/start-cta-einreichen`,
erzeugen nur `<div id="eg-start-eb">`/`<div id="eg-start-cta">` ohne
erkennbaren Füll-Mechanismus) – Status ungeklärt. Falls sie in der
Startseiten-Redaktion nicht verwendet werden, Kandidat für eine spätere
Löschung, aber erst nach Rückfrage.

**Nicht anfassen ohne Rücksprache:** Bogen-/Emotionsraum-CSS-Abschnitte
(22 + 23 Ende) in `style.css` – an die Plugin-Datenstruktur gekoppelt, siehe
`CLAUDE.md`-Architektur-Checkliste.
