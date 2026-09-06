# eigengrund-child

Öffentlicher Theme-Teil von [eigengrund.space](https://eigengrund.space) – einer
deutschsprachigen Plattform für emotionale Selbsterfahrung und
Persönlichkeitsentwicklung. Auf [eigengrund.space](https://eigengrund.space)
begleiten strukturierte Pfade durch einzelne Emotionen; dieses Repository
enthält davon nur die sichtbare Hülle: das WordPress-Child-Theme mit
Design-System, Templates und Frontend-Logik.

Inhalte, Datenmodell und die Plugins der Plattform liegen bewusst nicht hier.

## Tech-Stack

- **WordPress** (PHP 8.4)
- **Kadence** als Parent-Theme, dieses Repo ist das Child-Theme
- reines CSS mit Design-Tokens (Custom Properties), kein Build-Schritt
- selbst gehostete Schriften: Newsreader (Serif) und Inter (Sans), als woff2
- Vanilla JavaScript, kein Framework

## Struktur

```
functions.php              Enqueue, Kadence-Defaults, Shortcodes,
                           Block-Patterns, Open Graph, Meta-Description
style.css                  Design-System in 24 nummerierten Abschnitten
fonts/                     woff2-Dateien + fonts.css
js/toggle.js               Tag-/Nacht-Umschaltung (localStorage)
page-startseite.php        Template: Startseite
page-erfahrungsbericht.php Template: Erfahrungsbericht
templates/                 weitere Seiten-Templates
```

`style.css` ist nach Themen gegliedert (Design Tokens, Dark Mode, Typografie,
Karten, Layout, Kadence-Overrides …); das Inhaltsverzeichnis steht oben in
der Datei.

## Hinweis

Dies ist ein **Spiegel**. Der Stand wird automatisch aus dem privaten
Entwicklungs-Repository übernommen – Pull Requests und direkte Commits hier
werden beim nächsten Sync überschrieben.

Das Theme ist auf die konkrete Installation von eigengrund.space zugeschnitten
(Kadence-Palette, PMPro-Integration, projekteigene Shortcodes) und nicht als
allgemein einsetzbares Theme gedacht. Als Referenz und zum Nachlesen gerne.

## Lizenz

GPL-2.0-or-later – siehe [LICENSE](LICENSE).
