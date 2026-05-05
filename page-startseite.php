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
    background: linear-gradient(160deg, #EEC98A 0%, #D4956A 55%, #B8613A 100%);
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
    color: rgba(30,27,20,.05); line-height: 1;
    pointer-events: none; user-select: none;
}
.egs-hero-inner {
    max-width: 1100px;
    margin: 0 auto;
    position: relative;
    z-index: 1;
    width: 100%;
}

.egs-tag {
    display: inline-block; font-size: 10px; letter-spacing: .14em;
    text-transform: uppercase; color: rgba(30,27,20,.65);
    border: .5px solid rgba(30,27,20,.2); padding: .28rem .7rem;
    border-radius: 2px; margin-bottom: 1.75rem;
    font-family: 'Lato', sans-serif; font-weight: 300;
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
    margin-bottom: 3rem; max-width: 560px;
}

/* ── BESCHREIBUNGSTEXT ── */
.egs-beschreibung {
    font-family: 'Cormorant Garamond', serif;
    font-weight: 300;
    font-style: italic;
    font-size: clamp(18px, 2.5vw, 22px);
    line-height: 1.8;
    color: rgba(30,27,20,.78);
    max-width: 640px;
    margin: 40px 0 60px;
}

/* ── BODY: Editor-Inhalt ── */
.egs-body {
    max-width: 1100px;
    margin: 0 auto;
}

/* ── SCROLL HINT ── */
.egs-scroll-hint {
    display: block;
    text-align: center;
    margin-top: 2.5rem;
    font-family: 'Lato', sans-serif;
    font-weight: 300;
    font-size: 11px;
    letter-spacing: .08em;
    color: rgba(30,27,20,.45);
    text-decoration: none;
    transition: color .2s;
}
.egs-scroll-hint:hover { color: rgba(30,27,20,.72); }

/* ── RESPONSIVE ── */
@media (max-width: 680px) {
    .egs-hero { padding: 7rem 6% 3rem; min-height: auto; }
}
</style>

<!-- ═══ HERO ═══ -->
<section class="egs-hero">
    <div aria-hidden="true" class="egs-hero-bg">eg</div>

    <div class="egs-hero-inner">
        <div class="egs-tag">Persönlichkeitsentwicklung &middot; Selbstfindung &middot; Potenzialentfaltung</div>

        <h1 class="egs-h1">
            Vielleicht bist du<br>gar nicht <em>falsch.</em>
        </h1>

        <p class="egs-lead">
            Vielleicht hast du bisher nur in die falsche Richtung geguckt.
        </p>

        <p class="egs-beschreibung">Für Menschen, die viel versucht haben. Die gelesen, analysiert, verstanden haben – und merken, dass der nächste Schritt kein neuer Ansatz ist.

eigengrund begleitet – ohne Methode, ohne Versprechen, ohne dass du etwas leisten musst.</p>

        <a href="#was-ist-das" class="egs-scroll-hint">&#8595; Was dich hier erwartet</a>
    </div>
</section>

<!-- ═══ BODY: aus dem WordPress-Editor ═══ -->
<div class="egs-body">
    <?php while ( have_posts() ) : the_post(); the_content(); endwhile; ?>
</div>

<script>
(function(){
  var header = document.querySelector('#masthead, .site-header');
  if(!header) return;
  var threshold = 60;
  function onScroll(){
    if(window.scrollY > threshold){
      header.classList.add('eg-scrolled');
      header.style.transform = 'translateY(0)';
    } else {
      header.classList.remove('eg-scrolled');
    }
  }
  // Sicherstellen dass Header sichtbar bleibt
  header.style.position = 'fixed';
  header.style.top = '0';
  header.style.left = '0';
  header.style.right = '0';
  header.style.width = '100%';
  header.style.zIndex = '9999';
  window.addEventListener('scroll', onScroll, {passive:true});
  onScroll();
})();
</script>

<?php get_footer(); ?>
