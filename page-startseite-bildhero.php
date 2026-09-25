<?php
/**
 * Template Name: Startseite (Bildhero)
 * Template Post Type: page
 *
 * Zweite Variante von page-startseite.php. Gleicher Aufbau – Hero fix im PHP,
 * Body-Inhalt aus dem WordPress-Editor – aber statt des Verlauf-Heros ein Hero
 * mit Foto, Unterzeile, Einleitungssatz und Button.
 *
 * Umschalten zwischen beiden Varianten: Seite bearbeiten → Seiten-Attribute →
 * Template. Der Editor-Inhalt bleibt dabei unangetastet.
 *
 * Das Herobild liegt als fester Pfad im Markup (verifiziert 2026-09-25:
 * beide Dateien HTTP 200, 1600x1200 und 900x675, gleiches Seitenverhaeltnis).
 * Beim Bildwechsel hier anfassen – oder auf das Beitragsbild der Seite
 * umstellen, dann baut WordPress srcset/sizes selbst.
 */
get_header();
?>

<style>
/* Header-Transparenz: siehe Customizer → Zusätzliches CSS */

/* ── HERO (Bildvariante) ──
   Kein 100vw-Ausbruch wie im HTML-Block-Entwurf: In diesem Template liegt der
   Hero nicht im Inhaltscontainer, sondern direkt unter <body> – er ist also
   ohnehin volle Breite. Der Ausbruch würde auf Windows nur die Scrollbar-
   Breite als horizontales Scrollen hinzufügen. */
.eg-hero {
    position: relative;
    background: var(--eg-sec-b);
    overflow: hidden;
}

.eg-hero__text {
    position: relative;
    z-index: 2;
    max-width: 52rem;
    margin: 0 auto;
    padding: clamp(3.5rem, 9vw, 7rem) var(--eg-space-md) 0;
    text-align: center;
}
.eg-hero__titel {
    font-family: var(--eg-font-serif);
    font-weight: 300;
    font-size: clamp(2.6rem, 6.2vw, 5rem);
    line-height: 1.08;
    letter-spacing: -.01em;
    color: var(--eg-text);
    margin: 0 0 1.1rem;
}
.eg-hero__titel em { color: var(--eg-amber); font-style: italic; }

.eg-hero__unterzeile {
    font-family: var(--eg-font-serif);
    font-style: italic;
    font-weight: 300;
    font-size: clamp(1.2rem, 2.2vw, 1.6rem);
    line-height: 1.45;
    color: var(--eg-text-muted);
    margin: 0 auto 1.1rem;
    max-width: 36rem;
}
.eg-hero__satz {
    font-family: var(--eg-font-serif);
    font-size: clamp(1.05rem, 1.6vw, 1.2rem);
    line-height: 1.6;
    color: var(--eg-text-muted);
    margin: 0 auto 2rem;
    max-width: 32rem;
}

.eg-hero__button {
    display: inline-block;
    font-family: var(--eg-font-sans);
    font-size: 1rem;
    font-weight: 500;
    color: var(--eg-btn-txt);
    background: var(--eg-accent);
    text-decoration: none;
    border-radius: 999px;
    padding: .95rem 1.9rem;
    transition: background .2s;
}
.eg-hero__button:hover,
.eg-hero__button:focus-visible { background: var(--eg-amber); color: var(--eg-btn-txt); }
.eg-hero__button:focus-visible { outline: 2px solid var(--eg-border-focus); outline-offset: 3px; }

.eg-hero__bild {
    position: relative;
    z-index: 1;
    height: clamp(380px, 62vh, 680px);
    margin-top: clamp(-11rem, -12vw, -6rem);
}
.eg-hero__bild img {
    display: block;
    width: 100%;
    height: 100%;
    object-fit: cover;
    object-position: 42% 28%;
}

/* Übergänge: oben aus dem Hintergrund heraus, unten sanft in den nächsten
   Abschnitt. Erste color-mix()-Verwendung im Theme – der @supports-Block
   darunter hält den Verlauf auch ohne Unterstützung brauchbar. */
.eg-hero__bild::after {
    content: "";
    position: absolute;
    inset: 0;
    pointer-events: none;
    background: linear-gradient(to bottom,
        var(--eg-sec-b) 0%,
        transparent 52%,
        transparent 82%,
        var(--eg-sec-b) 100%);
}
@supports (background: color-mix(in srgb, red 50%, transparent)) {
    .eg-hero__bild::after {
        background: linear-gradient(to bottom,
            var(--eg-sec-b) 0%,
            color-mix(in srgb, var(--eg-sec-b) 85%, transparent) 14%,
            color-mix(in srgb, var(--eg-sec-b) 45%, transparent) 32%,
            transparent 52%,
            transparent 82%,
            var(--eg-sec-b) 100%);
    }
}

body.eg-dark .eg-hero__bild img { filter: brightness(.62) saturate(.85); }

/* ── BODY: Editor-Inhalt ── */
.egs-body {
    max-width: 1100px;
    margin: 0 auto;
}

/* ── RESPONSIVE ── */
@media (max-width: 640px) {
    .eg-hero__bild { height: 58vh; margin-top: -4.5rem; }
    .eg-hero__bild img { object-position: 40% 30%; }
}

@media (max-width: 680px) {
    .egs-body {
        padding-left: 1.25rem;
        padding-right: 1.25rem;
    }
    .egs-body > section {
        margin-left: -1.25rem;
        margin-right: -1.25rem;
    }
}
</style>

<!-- ═══ HERO ═══ -->
<section class="eg-hero" aria-labelledby="eg-hero-titel">
    <div class="eg-hero__text">
        <h1 id="eg-hero-titel" class="eg-hero__titel">
            Vielleicht bist du gar nicht <em>falsch.</em>
        </h1>

        <p class="eg-hero__unterzeile">
            Vielleicht hast du bisher nur in die falsche Richtung geguckt.
        </p>

        <p class="eg-hero__satz">
            Ein ruhiger Ort, um deinen Gefühlen zu begegnen – in deinem Tempo,
            ohne dass an dir etwas repariert werden muss.
        </p>

        <!-- Sprungziel: Der Anker #options muss im Editor-Inhalt der Seite
             existieren (Block → Erweitert → HTML-Anker). -->
        <a class="eg-hero__button" href="#options">Hier anfangen&nbsp;↓</a>
    </div>

    <div class="eg-hero__bild">
        <img src="/wp-content/uploads/2026/09/hero-nebelmorgen-1600.webp"
             srcset="/wp-content/uploads/2026/09/hero-nebelmorgen-900.webp 900w,
                     /wp-content/uploads/2026/09/hero-nebelmorgen-1600.webp 1600w"
             sizes="100vw"
             width="1600" height="1200"
             fetchpriority="high" decoding="async"
             alt="Ein Feldweg an einem nebligen Wintermorgen, die Sonne scheint weich durch den Dunst">
    </div>
</section>

<!-- ═══ BODY: aus dem WordPress-Editor ═══ -->
<div class="egs-body">
    <?php while ( have_posts() ) : the_post(); the_content(); endwhile; ?>
</div>

<!-- Header: via Kadence Customizer → Oben gehaltener Header -->
<!-- Transparenz auf Startseite: via Customizer → Zusätzliches CSS -->

<?php get_footer(); ?>
