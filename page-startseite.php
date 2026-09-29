<?php
/**
 * Template Name: Startseite
 * Template Post Type: page
 *
 * Hybrid-Template: Hero fix im PHP, Body-Inhalt aus dem WordPress-Editor.
 * Seite anlegen → Template: "Startseite" → Shortcodes im Editor eintragen.
 */
get_header();
?>

<style>
/* Header-Transparenz: siehe Customizer → Zusätzliches CSS */

/* ── HERO ── */
.egs-hero {
    background: var(--eg-hero-gradient);
    padding: 10rem 6% 5rem;
    position: relative;
    overflow: hidden;
    min-height: 95vh;
    display: flex;
    align-items: center;
}
.egs-hero-bg {
    position: absolute; right: -1rem; bottom: -2rem;
    font-family: var(--eg-font-serif);
    font-size: 22vw; font-weight: 300; font-style: italic;
    color: rgba(28,27,25,.02); line-height: 1;
    pointer-events: none; user-select: none;
}
.egs-hero-inner {
    max-width: 1100px;
    margin: 0 auto;
    position: relative;
    z-index: 1;
    width: 100%;
}

.egs-h1 {
    font-family: var(--eg-font-serif); font-weight: 300;
    font-size: clamp(42px, 7vw, 86px); line-height: 1.08;
    color: var(--eg-hero-text); margin-bottom: 1.25rem; max-width: 700px;
}
.egs-h1 em { font-style: italic; color: var(--eg-hero-accent); }
.egs-lead {
    font-family: var(--eg-font-serif); font-weight: 300;
    font-style: italic; font-size: clamp(18px, 2.5vw, 26px);
    line-height: 1.55; color: var(--eg-hero-muted);
    margin: 0; max-width: 560px;
}
/* Sanfter Einstieg: baut auf .eg-btn--ghost auf (Kontur, Touch-Target,
   bekanntes Hover-Verhalten) und stellt nur zwei Dinge um:
   1. Farben auf die Hero-Tokens, weil --eg-btn-ghost-txt im Nacht-Modus
      hell wird, der Hero-Verlauf aber immer hell bleibt.
   2. Keine Versalien - im stillen Hero waere das der falsche Ton. */
.egs-cta {
    margin-top: 1.75rem;
    font-size: 14px;
    letter-spacing: .01em;
    text-transform: none;
    color: var(--eg-hero-text);
    border-color: var(--eg-hero-accent);
}
.egs-cta:hover {
    background: rgba(255,255,255,.35);
    color: var(--eg-hero-text);
    box-shadow: none;
}
.egs-cta:focus-visible {
    outline: 1.5px solid var(--eg-hero-accent);
    outline-offset: 4px;
}
.egs-cta-pfeil { transition: transform var(--eg-transition); }
.egs-cta:hover .egs-cta-pfeil { transform: translateY(2px); }
@media (prefers-reduced-motion: reduce) {
    .egs-cta:hover { transform: none; }
    .egs-cta-pfeil { transition: none; }
    .egs-cta:hover .egs-cta-pfeil { transform: none; }
}

/* ── BODY: Editor-Inhalt ── */
.egs-body {
    max-width: 1100px;
    margin: 0 auto;
}

/* ── RESPONSIVE ── */
@media (max-width: 680px) {
    .egs-hero { padding: 0 6%; min-height: 100svh; }

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
<section class="egs-hero">
    <div aria-hidden="true" class="egs-hero-bg">eg</div>

    <div class="egs-hero-inner">
        <h1 class="egs-h1">
            Vielleicht bist du<br>gar nicht <em>falsch.</em>
        </h1>

        <p class="egs-lead">
            Vielleicht hast du bisher nur in die falsche Richtung geguckt.
        </p>

        <a class="eg-btn eg-btn--ghost egs-cta" href="#eg-wege-titel">
            Ein Stück mitgehen
            <span aria-hidden="true" class="egs-cta-pfeil">&darr;</span>
        </a>
    </div>
</section>

<!-- ═══ BODY: aus dem WordPress-Editor ═══ -->
<div class="egs-body">
    <?php while ( have_posts() ) : the_post(); the_content(); endwhile; ?>
</div>

<!-- Header: via Kadence Customizer → Oben gehaltener Header -->
<!-- Transparenz auf Startseite: via Customizer → Zusätzliches CSS -->

<?php get_footer(); ?>