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
    background: linear-gradient(150deg, #FAF0D8 0%, #F0C88A 40%, #D4956A 80%, #C07850 100%);
    padding: 10rem 6% 5rem;
    position: relative;
    overflow: hidden;
    min-height: 95vh;
    display: flex;
    align-items: center;
}
.egs-hero-bg {
    position: absolute; right: -1rem; bottom: -2rem;
    font-family: 'Cormorant Garamond', serif;
    font-size: 22vw; font-weight: 300; font-style: italic;
    color: rgba(30,27,20,.02); line-height: 1;
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
    font-family: 'Cormorant Garamond', serif; font-weight: 300;
    font-size: clamp(42px, 7vw, 86px); line-height: 1.08;
    color: #1E1B14; margin-bottom: 1.25rem; max-width: 700px;
}
.egs-h1 em { font-style: italic; color: #6B3A1F; }
.egs-lead {
    font-family: 'Cormorant Garamond', serif; font-weight: 300;
    font-style: italic; font-size: clamp(18px, 2.5vw, 26px);
    line-height: 1.55; color: rgba(30,27,20,.78);
    margin: 0; max-width: 560px;
}

/* ── BODY: Editor-Inhalt ── */
.egs-body {
    max-width: 1100px;
    margin: 0 auto;
}

/* ── RESPONSIVE ── */
@media (max-width: 680px) {
    .egs-hero { padding: 0 6%; min-height: 100svh; }
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
    </div>
</section>

<!-- ═══ BODY: aus dem WordPress-Editor ═══ -->
<div class="egs-body">
    <?php while ( have_posts() ) : the_post(); the_content(); endwhile; ?>
</div>

<!-- Header: via Kadence Customizer → Oben gehaltener Header -->
<!-- Transparenz auf Startseite: via Customizer → Zusätzliches CSS -->

<?php get_footer(); ?>