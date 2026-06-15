<?php
/**
 * eigengrund-child functions.php
 * v3.0
 */

// ── STYLES & SCRIPTS LADEN ──────────────────────────────────

add_action( 'wp_enqueue_scripts', 'eigengrund_enqueue' );
function eigengrund_enqueue() {
    wp_enqueue_style( 'eigengrund-fonts',
        'https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,400;1,300;1,400&family=Lato:wght@300;400&display=swap',
        array(), null );
    wp_enqueue_style( 'kadence-style',
        get_template_directory_uri() . '/style.css',
        array(), wp_get_theme( 'kadence' )->get( 'Version' ) );
    wp_enqueue_style( 'eigengrund-child-style',
        get_stylesheet_directory_uri() . '/style.css',
        array( 'kadence-style' ), wp_get_theme()->get( 'Version' ) );
    wp_enqueue_script( 'eigengrund-toggle',
        get_stylesheet_directory_uri() . '/js/toggle.js',
        array(), '1.0.0', true );
}

add_action( 'enqueue_block_editor_assets', 'eigengrund_editor_fonts' );
function eigengrund_editor_fonts() {
    wp_enqueue_style( 'eigengrund-fonts-editor',
        'https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,400;1,300;1,400&family=Lato:wght@300;400&display=swap',
        array(), null );
}


// ── KADENCE DEFAULTS ────────────────────────────────────────

add_filter( 'kadence_theme_options_defaults', 'eigengrund_kadence_defaults' );
function eigengrund_kadence_defaults( $defaults ) {
    $defaults['palette'] = json_encode( array(
        array( 'color' => '#D4956A', 'slug' => 'palette1', 'name' => 'Amber' ),
        array( 'color' => '#8B4513', 'slug' => 'palette2', 'name' => 'Dunkelbraun' ),
        array( 'color' => '#1E1B14', 'slug' => 'palette3', 'name' => 'Fast-Schwarz' ),
        array( 'color' => '#3A3428', 'slug' => 'palette4', 'name' => 'Dunkelbraun Hover' ),
        array( 'color' => '#6B6456', 'slug' => 'palette5', 'name' => 'Text gedimmt' ),
        array( 'color' => '#9A8E82', 'slug' => 'palette6', 'name' => 'Text faint' ),
        array( 'color' => '#F0E8D8', 'slug' => 'palette7', 'name' => 'Creme hell' ),
        array( 'color' => '#F7F0E6', 'slug' => 'palette8', 'name' => 'Creme' ),
        array( 'color' => '#FFFFFF', 'slug' => 'palette9', 'name' => 'Weiß' ),
    ) );
    $defaults['background_color']         = '#F7F0E6';
    $defaults['content_background_color'] = '#FFFFFF';
    $defaults['link_color']               = '#8B4513';
    $defaults['link_color_hover']         = '#D4956A';
    return $defaults;
}


// ── THEME SETUP ─────────────────────────────────────────────

add_action( 'after_setup_theme', 'eigengrund_setup' );
function eigengrund_setup() {
    add_theme_support( 'post-thumbnails' );
    add_theme_support( 'title-tag' );
    add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption' ) );
    add_theme_support( 'editor-color-palette', array(
        array( 'name' => 'Amber',       'slug' => 'eg-amber',   'color' => '#D4956A' ),
        array( 'name' => 'Dunkelbraun', 'slug' => 'eg-dark',    'color' => '#8B4513' ),
        array( 'name' => 'Fast-Schwarz','slug' => 'eg-black',   'color' => '#1E1B14' ),
        array( 'name' => 'Creme',       'slug' => 'eg-creme',   'color' => '#F7F0E6' ),
        array( 'name' => 'Creme hell',  'slug' => 'eg-creme-l', 'color' => '#F0E8D8' ),
        array( 'name' => 'Weiß',        'slug' => 'eg-white',   'color' => '#FFFFFF' ),
    ) );
    add_theme_support( 'editor-font-sizes', array(
        array( 'name' => 'Klein',  'size' => 12, 'slug' => 'small' ),
        array( 'name' => 'Normal', 'size' => 15, 'slug' => 'normal' ),
        array( 'name' => 'Groß',   'size' => 20, 'slug' => 'large' ),
    ) );
}

add_action( 'after_setup_theme', 'eigengrund_editor_styles' );
function eigengrund_editor_styles() {
    add_editor_style( array(
        'https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,400;1,300;1,400&family=Lato:wght@300;400&display=swap',
        get_stylesheet_directory_uri() . '/style.css',
    ) );
}


// ── MENÜS ───────────────────────────────────────────────────

add_action( 'init', 'eigengrund_menus' );
function eigengrund_menus() {
    register_nav_menus( array(
        'primary' => 'Hauptnavigation',
        'footer'  => 'Footer-Navigation',
    ) );
}


// ── SICHERHEIT ──────────────────────────────────────────────

remove_action( 'wp_head', 'wp_generator' );
add_filter( 'xmlrpc_enabled', '__return_false' );


// ── BLOCK PATTERNS ──────────────────────────────────────────

add_action( 'init', 'eigengrund_register_patterns' );
function eigengrund_register_patterns() {

    register_block_pattern_category( 'eigengrund', array( 'label' => 'eigengrund.space' ) );

    // 1. Amber Trennlinie
    register_block_pattern( 'eigengrund/trennlinie', array(
        'title'      => 'eigengrund – Amber Trennlinie',
        'categories' => array( 'eigengrund' ),
        'content'    => '<!-- wp:html --><div style="width:36px;height:.5px;background:#D4956A;margin:1.25rem 0;"></div><!-- /wp:html -->',
    ) );

    // 2. Tag/Label
    register_block_pattern( 'eigengrund/tag', array(
        'title'      => 'eigengrund – Tag/Label',
        'categories' => array( 'eigengrund' ),
        'content'    => '<!-- wp:html --><div class="eg-tag">Thema</div><!-- /wp:html -->',
    ) );

    // 3. Seiten-Header
    register_block_pattern( 'eigengrund/seiten-header', array(
        'title'      => 'eigengrund – Seiten-Header',
        'categories' => array( 'eigengrund' ),
        'content'    => '<!-- wp:html --><div class="eg-tag">Thema</div><!-- /wp:html -->
<!-- wp:heading {"level":1} --><h1 class="wp-block-heading">Überschrift der Seite</h1><!-- /wp:heading -->
<!-- wp:html --><div style="width:36px;height:.5px;background:#D4956A;margin:1.25rem 0 1.5rem;"></div><!-- /wp:html -->
<!-- wp:paragraph --><p>Einleitungstext – ruhig, kursiv, ein bis zwei Sätze.</p><!-- /wp:paragraph -->',
    ) );

    // 4. Pull Quote
    register_block_pattern( 'eigengrund/pull-quote', array(
        'title'      => 'eigengrund – Pull Quote',
        'categories' => array( 'eigengrund' ),
        'content'    => '<!-- wp:quote --><blockquote class="wp-block-quote"><p>Hier kommt ein Satz der besonders trägt.</p></blockquote><!-- /wp:quote -->',
    ) );

    // 5. Disclaimer
    register_block_pattern( 'eigengrund/disclaimer', array(
        'title'      => 'eigengrund – Disclaimer',
        'categories' => array( 'eigengrund' ),
        'content'    => '<!-- wp:html --><div class="eg-disclaimer"><strong>Hinweis.</strong> Diese Seite ersetzt keine psychotherapeutische oder ärztliche Behandlung. Bei akuten Krisen: Telefonseelsorge <strong>0800 111 0 111</strong> (kostenlos, 24/7).</div><!-- /wp:html -->',
    ) );

    // 6. Fragen-Box
    register_block_pattern( 'eigengrund/fragen-box', array(
        'title'      => 'eigengrund – Fragen-Box',
        'categories' => array( 'eigengrund' ),
        'content'    => '<!-- wp:html --><div class="eg-fragen"><div class="eg-fragen-label">Fragen, die viele in dieser Situation kennen</div><ul class="eg-fragen-list"><li>Erste Frage?</li><li>Zweite Frage?</li><li>Dritte Frage?</li></ul></div><!-- /wp:html -->',
    ) );

    // 7. Über uns
    register_block_pattern( 'eigengrund/ueber-uns', array(
        'title'      => 'eigengrund – Über uns (zwei Personen)',
        'categories' => array( 'eigengrund' ),
        'content'    => '<!-- wp:html --><div style="display:grid;grid-template-columns:1fr 1fr;gap:3rem;margin:3rem 0;"><div><div class="eg-label" style="margin-bottom:1rem;">Malte</div><div style="width:36px;height:.5px;background:#D4956A;margin-bottom:1.25rem;"></div><p style="font-size:15px;line-height:1.9;color:rgba(30,27,20,.82);">Text über Malte.</p></div><div><div class="eg-label" style="margin-bottom:1rem;">Sandra</div><div style="width:36px;height:.5px;background:#D4956A;margin-bottom:1.25rem;"></div><p style="font-size:15px;line-height:1.9;color:rgba(30,27,20,.82);">Text über Sandra.</p></div></div><!-- /wp:html -->',
    ) );

    // 8. Stilles Archiv Eintrag
    register_block_pattern( 'eigengrund/archiv-eintrag', array(
        'title'      => 'eigengrund – Stilles Archiv Eintrag',
        'categories' => array( 'eigengrund' ),
        'content'    => '<!-- wp:html --><div class="eg-archiv-entry"><div class="eg-label" style="margin-bottom:1.1rem;">April 2026 · Malte</div><p class="eg-archiv-text">Archiv-Text hier – 80–120 Wörter.</p><a href="/stilles-archiv" style="display:inline-flex;align-items:center;gap:.4rem;font-size:11px;letter-spacing:.1em;text-transform:uppercase;color:#8B4513;text-decoration:none;margin-top:1.5rem;">Ältere Einträge lesen →</a></div><!-- /wp:html -->',
    ) );

    // 9. Verwandte Themen
    register_block_pattern( 'eigengrund/verwandte-themen', array(
        'title'      => 'eigengrund – Verwandte Themen',
        'categories' => array( 'eigengrund' ),
        'content'    => '<!-- wp:html --><div class="eg-sidebar-card"><div class="eg-label" style="margin-bottom:.9rem;">Verwandte Themen</div><ul style="list-style:none;padding:0;margin:0;"><li style="padding:.6rem 0;border-bottom:.5px solid rgba(30,27,20,.07);font-size:13px;"><a href="/themen/orientierung" style="color:rgba(30,27,20,.65);text-decoration:none;display:flex;gap:.5rem;"><span style="color:#D4956A;">→</span> Ich weiß nicht, was ich will</a></li><li style="padding:.6rem 0;font-size:13px;"><a href="/themen/tiefe-klarheit" style="color:rgba(30,27,20,.65);text-decoration:none;display:flex;gap:.5rem;"><span style="color:#D4956A;">→</span> Sehnsucht nach Tiefe und Ganzheit</a></li></ul></div><!-- /wp:html -->',
    ) );

    // ── STARTSEITEN-PATTERNS ─────────────────────────────────
    // Diese nutzen PHP im Content – nur im page-startseite.php Template wirksam

    // 10. Start: Erfahrungsberichte (zeigt automatisch die 3 neuesten)
    register_block_pattern( 'eigengrund/start-erfahrungsberichte', array(
        'title'      => 'eigengrund – Start: Erfahrungsberichte',
        'categories' => array( 'eigengrund' ),
        'content'    => '<!-- wp:html --><div id="eg-start-eb"></div><!-- /wp:html -->',
    ) );

    // 11. Start: Bericht einreichen CTA
    register_block_pattern( 'eigengrund/start-cta-einreichen', array(
        'title'      => 'eigengrund – Start: Bericht einreichen',
        'categories' => array( 'eigengrund' ),
        'content'    => '<!-- wp:html --><div id="eg-start-cta"></div><!-- /wp:html -->',
    ) );

    // 12. Start: Mitgliederbereich Teaser
    register_block_pattern( 'eigengrund/start-mitglieder-teaser', array(
        'title'      => 'eigengrund – Start: Mitgliederbereich Teaser',
        'categories' => array( 'eigengrund' ),
        'content'    => '<!-- wp:html --><div id="eg-start-mitglieder"></div><!-- /wp:html -->',
    ) );

    // 13. Start: Prozess Ausblick
    register_block_pattern( 'eigengrund/start-prozess-ausblick', array(
        'title'      => 'eigengrund – Start: Prozess Ausblick',
        'categories' => array( 'eigengrund' ),
        'content'    => '<!-- wp:html --><div id="eg-start-prozess"></div><!-- /wp:html -->',
    ) );
}


// ── STARTSEITEN-ABSCHNITTE ALS SHORTCODES ───────────────────
// Diese Shortcodes werden im page-startseite.php Template genutzt
// und können auch direkt im Editor auf der Startseite verwendet werden.

// [eg_start_erfahrungsberichte]
add_shortcode( 'eg_start_erfahrungsberichte', 'eg_start_erfahrungsberichte_sc' );
function eg_start_erfahrungsberichte_sc() {
    $args = array(
        'post_type'      => 'eg_erfahrung',
        'posts_per_page' => 3,
        'post_status'    => 'publish',
        'orderby'        => 'date',
        'order'          => 'DESC',
        'meta_query'     => array( array( 'key' => 'eb_status', 'value' => 'freigegeben' ) ),
    );
    $q = new WP_Query( $args );
    ob_start();
    ?>
    <section class="eg-start-eb-section">
        <?php if ( $q->have_posts() ) : ?>
        <div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(260px,1fr));gap:1px;background:rgba(30,27,20,.08);border-radius:2px;overflow:hidden;margin-bottom:2rem;">
            <?php while ( $q->have_posts() ) : $q->the_post();
                $vn = get_post_meta(get_the_ID(),'eb_vorname',true);
                $al = get_post_meta(get_the_ID(),'eb_alter',true);
                $ab = get_post_meta(get_the_ID(),'eb_abschluss',true);
                $si = get_post_meta(get_the_ID(),'eb_sichtbar',true);
                $gesperrt = ($si==='mitglieder' && !current_user_can('eg_mitglied')) || ($si==='angemeldet' && !is_user_logged_in());
            ?>
            <div style="background:#fff;padding:1.5rem;display:flex;flex-direction:column;gap:.75rem;">
                <div style="font-size:11px;letter-spacing:.1em;text-transform:uppercase;color:rgba(30,27,20,.5);font-family:'Lato',sans-serif;font-weight:300;"><?php echo esc_html($vn.($al?' · '.$al:'')); ?></div>
                <?php if($ab): ?><div style="font-family:'Cormorant Garamond',serif;font-style:italic;font-size:clamp(15px,1.8vw,17px);line-height:1.6;color:rgba(30,27,20,.75);">&bdquo;<?php echo esc_html($ab); ?>&ldquo;</div><?php endif; ?>
                <?php if($gesperrt): ?>
                <a href="<?php echo esc_url(home_url('/anmelden')); ?>" style="font-size:11px;color:#8B4513;text-decoration:none;letter-spacing:.08em;text-transform:uppercase;font-family:'Lato',sans-serif;margin-top:auto;">🔒 Kostenlos anmelden</a>
                <?php else: ?>
                <a href="<?php the_permalink(); ?>" style="font-size:11px;letter-spacing:.1em;text-transform:uppercase;color:#8B4513;text-decoration:none;margin-top:auto;font-family:'Lato',sans-serif;">Bericht lesen →</a>
                <?php endif; ?>
            </div>
            <?php endwhile; wp_reset_postdata(); ?>
        </div>
        <?php else : ?>
        <p style="color:rgba(30,27,20,.55);font-style:italic;">Noch keine Berichte vorhanden.</p>
        <?php endif; ?>
    </section>
    <?php
    return ob_get_clean();
}

// [eg_start_cta_einreichen]
add_shortcode( 'eg_start_cta_einreichen', 'eg_start_cta_einreichen_sc' );
function eg_start_cta_einreichen_sc() {
    ob_start(); ?>
    <section style="padding:4rem 2.5rem;background:#F0E8D8;">
        <div style="max-width:680px;display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:2rem;">
            <div>
                <div style="font-size:10px;letter-spacing:.14em;text-transform:uppercase;color:#8B4513;margin-bottom:.75rem;font-family:'Lato',sans-serif;">Mitmachen</div>
                <h2 style="font-family:'Cormorant Garamond',serif;font-weight:300;font-size:clamp(20px,3vw,30px);color:#1E1B14;margin-bottom:.75rem;">Dein Prozess &ndash; <em style="color:#8B4513;">in deinen Worten.</em></h2>
                <p style="font-size:14px;line-height:1.75;color:rgba(30,27,20,.75);font-family:'Lato',sans-serif;font-weight:300;max-width:420px;">Kein perfekter Text, keine Auflösung nötig. Nur deine ehrliche Beschreibung &ndash; für andere, die vielleicht gerade dort sind, wo du warst.</p>
            </div>
            <a href="<?php echo esc_url(home_url('/einreichen')); ?>" style="display:inline-block;font-family:'Lato',sans-serif;font-weight:400;font-size:12px;letter-spacing:.08em;text-transform:uppercase;background:#1E1B14;color:#F7F0E6;padding:.85rem 2rem;border-radius:2px;text-decoration:none;white-space:nowrap;flex-shrink:0;">Bericht einreichen</a>
        </div>
    </section>
    <?php
    return ob_get_clean();
}

// [eg_start_mitglieder_teaser]
add_shortcode( 'eg_start_mitglieder_teaser', 'eg_start_mitglieder_teaser_sc' );
function eg_start_mitglieder_teaser_sc() {
    ob_start(); ?>
    <section style="padding:4.5rem 2.5rem;background:#F7F0E6;">
        <div style="max-width:560px;">
            <div style="font-size:10px;letter-spacing:.14em;text-transform:uppercase;color:#8B4513;margin-bottom:1rem;font-family:'Lato',sans-serif;">Intim</div>
            <div style="width:32px;height:.5px;background:#D4956A;margin-bottom:1.5rem;"></div>
            <h2 style="font-family:'Cormorant Garamond',serif;font-weight:300;font-size:clamp(22px,3.5vw,36px);color:#1E1B14;margin-bottom:1.25rem;">Ein persönlicher Raum &ndash;<br><em style="color:#8B4513;">in deinem eigenen Tempo.</em></h2>
            <p style="font-size:15px;line-height:1.9;color:rgba(30,27,20,.82);margin-bottom:2rem;font-family:'Lato',sans-serif;font-weight:300;">Ein Bereich für Menschen, die sich weiter begleiten möchten &ndash; mit Werkzeugen zur Selbstreflexion, ohne dass jemand mitliest. Er entsteht gerade.</p>
            <div style="background:rgba(212,149,106,.08);border:.5px solid rgba(139,69,19,.2);border-radius:2px;padding:1.5rem;">
                <div style="font-size:10px;letter-spacing:.14em;text-transform:uppercase;color:#8B4513;margin-bottom:.75rem;font-family:'Lato',sans-serif;">Benachrichtigung wenn er startet</div>
                <div style="display:flex;max-width:380px;" id="egMtNlRow">
                    <input type="email" id="egMtNlEmail" placeholder="deine@email.de"
                        style="flex:1;font-family:'Lato',sans-serif;font-size:13px;padding:.75rem 1rem;border:.5px solid rgba(30,27,20,.22);border-right:none;border-radius:2px 0 0 2px;background:#fff;color:#1E1B14;outline:none;">
                    <button onclick="egMtNlSubmit()" style="font-family:'Lato',sans-serif;font-size:11px;letter-spacing:.08em;text-transform:uppercase;background:#1E1B14;color:#F7F0E6;border:none;padding:.75rem 1.25rem;border-radius:0 2px 2px 0;cursor:pointer;white-space:nowrap;">Informiert werden</button>
                </div>
                <div id="egMtNlOk" style="display:none;font-family:'Cormorant Garamond',serif;font-style:italic;font-size:17px;color:rgba(30,27,20,.85);padding:.5rem 0;">Gut. Wir melden uns &ndash; wenn es soweit ist.</div>
                <p style="font-size:11px;color:rgba(30,27,20,.55);margin-top:.6rem;font-family:'Lato',sans-serif;">Einmalig. Kein Newsletter.</p>
            </div>
        </div>
    </section>
    <script>
    async function egMtNlSubmit(){
        var email=document.getElementById('egMtNlEmail').value.trim();
        if(!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)){
            document.getElementById('egMtNlEmail').style.borderColor='rgba(107,58,31,0.6)'; return;
        }
        try{
            var res=await fetch('<?php echo esc_url(home_url('/')); ?>brevo-proxy.php',{
                method:'POST',headers:{'Content-Type':'application/json'},
                body:JSON.stringify({email:email,hp:''})
            });
            var d=await res.json();
            if(res.ok&&d.ok){
                document.getElementById('egMtNlRow').style.display='none';
                document.getElementById('egMtNlOk').style.display='block';
            }
        }catch(e){}
    }
    document.addEventListener('DOMContentLoaded',function(){
        var i=document.getElementById('egMtNlEmail');
        if(i)i.addEventListener('keydown',function(e){if(e.key==='Enter')egMtNlSubmit();});
    });
    </script>
    <?php
    return ob_get_clean();
}

// [eg_start_prozess_ausblick]
add_shortcode( 'eg_start_prozess_ausblick', 'eg_start_prozess_ausblick_sc' );
function eg_start_prozess_ausblick_sc() {
    ob_start(); ?>
    <section style="padding:4rem 2.5rem;background:#F0E8D8;">
        <div style="max-width:560px;background:#fff;border:.5px solid rgba(30,27,20,.10);border-radius:2px;padding:2rem 2.25rem;transition:background .2s ease,border-color .2s ease;"
             onmouseover="this.style.background='rgba(30,27,20,.025)';this.style.borderColor='rgba(30,27,20,.18)'"
             onmouseout="this.style.background='#fff';this.style.borderColor='rgba(30,27,20,.10)'">
            <h2 style="font-family:'Cormorant Garamond',serif;font-weight:300;font-size:clamp(22px,3vw,34px);color:#1E1B14;margin:0 0 .9rem;">Orientierung im Prozess</h2>
            <div style="width:32px;height:.5px;background:#D4956A;margin-bottom:1.5rem;"></div>
            <p style="font-size:15px;line-height:1.9;color:rgba(30,27,20,.82);margin:0 0 1.75rem;font-family:'Lato',sans-serif;font-weight:300;">Was passiert eigentlich &ndash; und wie geht das? Fragen die im Prozess auftauchen, ehrlich beantwortet.</p>
            <a href="<?php echo esc_url( home_url( '/prozess/' ) ); ?>"
               style="display:inline-flex;align-items:center;gap:.45rem;font-family:'Lato',sans-serif;font-size:11px;letter-spacing:.1em;text-transform:uppercase;color:#8B4513;text-decoration:none;">
                Alle Seiten entdecken <span style="color:#D4956A;font-size:13px;">&rarr;</span>
            </a>
        </div>
    </section>
    <?php
    return ob_get_clean();
}


// ── SHORTCODE: ANMELDEN / NUR FÜR MITGLIEDER ────────────────

add_shortcode( 'eigengrund_anmelden', 'eigengrund_anmelden_shortcode' );
function eigengrund_anmelden_shortcode() {
    ob_start(); ?>
    <style>
    .ega-wrap{max-width:600px;margin:0 auto;padding:3rem 0 5rem;}
    .ega-tag{display:inline-block;font-size:10px;letter-spacing:.14em;text-transform:uppercase;color:#8B4513;border:.5px solid rgba(139,69,19,.25);padding:.28rem .7rem;border-radius:2px;margin-bottom:1.5rem;font-family:'Lato',sans-serif;font-weight:300;}
    .ega-h1{font-family:'Cormorant Garamond',serif;font-weight:300;font-size:clamp(28px,4vw,46px);line-height:1.15;color:#1E1B14;margin-bottom:1.25rem;}
    .ega-h1 em{font-style:italic;color:#8B4513;}
    .ega-rule{width:32px;height:.5px;background:#D4956A;margin-bottom:1.5rem;}
    .ega-lead{font-family:'Cormorant Garamond',serif;font-style:italic;font-size:clamp(16px,2vw,20px);line-height:1.7;color:rgba(30,27,20,.75);margin-bottom:2rem;}
    .ega-body{font-size:15px;line-height:1.9;color:rgba(30,27,20,.82);margin-bottom:2.5rem;font-family:'Lato',sans-serif;font-weight:300;}
    .ega-features{list-style:none;padding:0;margin:0 0 2.5rem;}
    .ega-features li{display:flex;gap:.75rem;font-size:14px;line-height:1.7;color:rgba(30,27,20,.82);padding:.5rem 0;border-bottom:.5px solid rgba(30,27,20,.07);font-family:'Lato',sans-serif;}
    .ega-features li:last-child{border-bottom:none;}
    .ega-features li::before{content:'→';color:#D4956A;flex-shrink:0;}
    .ega-newsletter{background:rgba(212,149,106,.08);border:.5px solid rgba(139,69,19,.2);border-radius:2px;padding:1.75rem;margin-bottom:2rem;}
    .ega-newsletter-label{font-size:10px;letter-spacing:.14em;text-transform:uppercase;color:#8B4513;margin-bottom:.75rem;font-family:'Lato',sans-serif;}
    .ega-newsletter-title{font-family:'Cormorant Garamond',serif;font-size:clamp(17px,2.2vw,22px);color:#1E1B14;margin-bottom:.5rem;}
    .ega-newsletter-row{display:flex;max-width:420px;}
    .ega-newsletter-input{flex:1;font-family:'Lato',sans-serif;font-size:14px;font-weight:300;padding:.8rem 1rem;border:.5px solid rgba(30,27,20,.22);border-right:none;border-radius:2px 0 0 2px;background:#fff;color:#1E1B14;outline:none;}
    .ega-newsletter-btn{font-family:'Lato',sans-serif;font-weight:400;font-size:12px;letter-spacing:.08em;text-transform:uppercase;background:#1E1B14;color:#F7F0E6;border:none;padding:.8rem 1.5rem;border-radius:0 2px 2px 0;cursor:pointer;white-space:nowrap;}
    .ega-newsletter-success{font-family:'Cormorant Garamond',serif;font-style:italic;font-size:18px;color:rgba(30,27,20,.85);padding:.5rem 0;display:none;}
    .ega-disc{font-size:12px;color:rgba(30,27,20,.55);line-height:1.75;font-family:'Lato',sans-serif;}
    .ega-back{display:inline-block;margin-top:2.5rem;font-size:11px;letter-spacing:.1em;text-transform:uppercase;color:#8B4513;text-decoration:none;font-family:'Lato',sans-serif;}
    </style>

    <div class="ega-wrap">
        <div class="ega-tag">Mitgliederbereich</div>
        <h1 class="ega-h1">Dieser Inhalt ist<br>nur f&uuml;r <em>Mitglieder.</em></h1>
        <div class="ega-rule"></div>
        <p class="ega-lead">Der Mitgliederbereich von eigengrund.space befindet sich gerade im Aufbau und wird in K&uuml;rze starten.</p>
        <p class="ega-body">Wer Mitglied wird, bekommt Zugang zu Werkzeugen f&uuml;r die eigene Selbstreflexion &ndash; Traum-Tracker, Prozess-Tagebuch, Lebensrad und mehr. In deinem eigenen Tempo. Ohne dass jemand mitliest.</p>
        <ul class="ega-features">
            <li>Traum-Tracker &ndash; Eintr&auml;ge, Tags, pers&ouml;nliche Mustererkennung</li>
            <li>Prozess-Tagebuch &ndash; freies Journal, vollst&auml;ndig privat</li>
            <li>Lebensrad &ndash; Lebensbereiche einsch&auml;tzen und &uuml;ber Zeit vergleichen</li>
            <li>Brief an dich selbst &ndash; wird in 6 oder 12 Monaten zugestellt</li>
            <li>Alle Erfahrungsberichte &ndash; auch die nur f&uuml;r Mitglieder freigegebenen</li>
        </ul>
        <div class="ega-newsletter">
            <div class="ega-newsletter-label">Benachrichtigung</div>
            <div class="ega-newsletter-title">Informiert werden wenn der Mitgliederbereich startet</div>
            <div class="ega-newsletter-row" id="agaFormRow">
                <input class="ega-newsletter-input" type="email" id="agaEmail" placeholder="deine@email.de" autocomplete="email">
                <button class="ega-newsletter-btn" onclick="agaSubmit()">Informiert werden</button>
            </div>
            <div class="ega-newsletter-success" id="agaSuccess">Gut. Wir melden uns &ndash; wenn es soweit ist.</div>
        </div>
        <p class="ega-disc">Keine weiteren E-Mails. Kein Tracking. Deine Adresse wird ausschlie&szlig;lich f&uuml;r diese eine Benachrichtigung verwendet.</p>
        <a href="<?php echo esc_url( home_url('/') ); ?>" class="ega-back">&larr; Zur&uuml;ck zur Startseite</a>
    </div>

    <script>
    async function agaSubmit() {
        var email = document.getElementById('agaEmail').value.trim();
        if(!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)){
            document.getElementById('agaEmail').style.borderColor='rgba(107,58,31,0.6)'; return;
        }
        try{
            var res=await fetch('<?php echo esc_url(home_url("/")); ?>brevo-proxy.php',{
                method:'POST',headers:{'Content-Type':'application/json'},
                body:JSON.stringify({email:email,hp:''})
            });
            var d=await res.json();
            if(res.ok&&d.ok){
                document.getElementById('agaFormRow').style.display='none';
                document.getElementById('agaSuccess').style.display='block';
            }
        }catch(e){}
    }
    document.addEventListener('DOMContentLoaded',function(){
        var i=document.getElementById('agaEmail');
        if(i)i.addEventListener('keydown',function(e){if(e.key==='Enter')agaSubmit();});
    });
    </script>
    <?php
    return ob_get_clean();
}


// ── SHORTCODE: NEWSLETTER BOX (klein) ───────────────────────
// Nur die Benachrichtigungs-Box, ohne die ganze Mitglieder-Seite.
// Einbinden mit: [eg_newsletter_box]
// Optional: [eg_newsletter_box titel="Eigener Titel" note="Eigene Notiz"]

add_shortcode( 'eg_newsletter_box', 'eg_newsletter_box_shortcode' );
function eg_newsletter_box_shortcode( $atts ) {
    $atts = shortcode_atts( array(
        'titel' => 'Informiert werden wenn der Mitgliederbereich startet',
        'note'  => 'Einmalig. Kein Newsletter.',
    ), $atts );

    // Eindeutige ID damit mehrere Boxen auf einer Seite funktionieren
    $uid = 'egnl' . substr( md5( uniqid() ), 0, 6 );

    ob_start(); ?>
    <div class="eg-nl-box">
        <div class="eg-nl-label">Benachrichtigung</div>
        <div class="eg-nl-titel"><?php echo esc_html( $atts['titel'] ); ?></div>
        <div class="eg-nl-row" id="<?php echo $uid; ?>Row">
            <input type="email"
                   id="<?php echo $uid; ?>Email"
                   class="eg-nl-input"
                   placeholder="deine@email.de"
                   autocomplete="email">
            <button class="eg-nl-btn"
                    onclick="egNlSubmit('<?php echo $uid; ?>')">
                Informiert werden
            </button>
        </div>
        <div id="<?php echo $uid; ?>Ok"
             class="eg-nl-ok"
             style="display:none;">
            Gut. Wir melden uns &ndash; wenn es soweit ist.
        </div>
        <p class="eg-nl-note"><?php echo esc_html( $atts['note'] ); ?></p>
    </div>

    <style>
    .eg-nl-box{background:rgba(212,149,106,.08);border:.5px solid rgba(139,69,19,.2);border-radius:2px;padding:1.5rem 1.75rem;}
    .eg-nl-label{font-size:10px;letter-spacing:.14em;text-transform:uppercase;color:#8B4513;margin-bottom:.6rem;font-family:'Lato',sans-serif;}
    .eg-nl-titel{font-family:'Cormorant Garamond',serif;font-size:clamp(17px,2.2vw,22px);color:#1E1B14;margin-bottom:1rem;line-height:1.3;}
    .eg-nl-row{display:flex;max-width:420px;}
    .eg-nl-input{flex:1;font-family:'Lato',sans-serif;font-size:14px;padding:.75rem 1rem;border:.5px solid rgba(30,27,20,.22);border-right:none;border-radius:2px 0 0 2px;background:#fff;color:#1E1B14;outline:none;transition:border-color .2s;}
    .eg-nl-input:focus{border-color:#D4956A;}
    .eg-nl-input::placeholder{color:rgba(30,27,20,.4);}
    .eg-nl-btn{font-family:'Lato',sans-serif;font-size:11px;letter-spacing:.08em;text-transform:uppercase;background:#1E1B14;color:#F7F0E6;border:none;padding:.75rem 1.25rem;border-radius:0 2px 2px 0;cursor:pointer;white-space:nowrap;transition:background .2s;}
    .eg-nl-btn:hover{background:#3A3428;}
    .eg-nl-ok{font-family:'Cormorant Garamond',serif;font-style:italic;font-size:18px;color:rgba(30,27,20,.85);padding:.4rem 0;}
    .eg-nl-note{font-size:11px;color:rgba(30,27,20,.55);margin-top:.6rem;font-family:'Lato',sans-serif;}
    @media(max-width:560px){
        .eg-nl-row{flex-direction:column;}
        .eg-nl-input{border-right:.5px solid rgba(30,27,20,.22);border-bottom:none;border-radius:2px 2px 0 0;}
        .eg-nl-btn{border-radius:0 0 2px 2px;text-align:center;}
    }
    </style>

    <script>
    function egNlSubmit(uid) {
        var email = document.getElementById(uid+'Email').value.trim();
        if(!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)){
            document.getElementById(uid+'Email').style.borderColor='rgba(107,58,31,0.6)';
            return;
        }
        fetch('<?php echo esc_url( home_url('/') ); ?>brevo-proxy.php', {
            method:'POST',
            headers:{'Content-Type':'application/json'},
            body:JSON.stringify({email:email,hp:''})
        }).then(function(r){return r.json();}).then(function(d){
            if(d.ok){
                document.getElementById(uid+'Row').style.display='none';
                document.getElementById(uid+'Ok').style.display='block';
            }
        }).catch(function(){});
    }
    document.addEventListener('DOMContentLoaded',function(){
        var inputs = document.querySelectorAll('.eg-nl-input');
        inputs.forEach(function(inp){
            inp.addEventListener('keydown',function(e){
                if(e.key==='Enter'){
                    var uid = inp.id.replace('Email','');
                    egNlSubmit(uid);
                }
            });
        });
    });
    </script>
    <?php
    return ob_get_clean();
}


// ── BLOCK PATTERN: PFEIL-LISTE ───────────────────────────────
// Im Editor: + → Muster → eigengrund.space → Pfeil-Liste

add_action( 'init', function() {
    register_block_pattern( 'eigengrund/pfeil-liste', array(
        'title'      => 'eigengrund – Pfeil-Liste',
        'categories' => array( 'eigengrund' ),
        'content'    => '<!-- wp:html -->
<ul class="eg-pfeil-liste">
  <li>Erster Punkt – Beschreibung hier</li>
  <li>Zweiter Punkt – Beschreibung hier</li>
  <li>Dritter Punkt – Beschreibung hier</li>
  <li>Vierter Punkt – Beschreibung hier</li>
  <li>Fünfter Punkt – Beschreibung hier</li>
</ul>
<style>
.eg-pfeil-liste{list-style:none;padding:0;margin:0;}
.eg-pfeil-liste li{display:flex;gap:.75rem;font-size:14px;line-height:1.75;color:rgba(30,27,20,.82);padding:.55rem 0;border-bottom:.5px solid rgba(30,27,20,.07);font-family:"Lato",sans-serif;font-weight:300;}
.eg-pfeil-liste li:last-child{border-bottom:none;}
.eg-pfeil-liste li::before{content:"→";color:#D4956A;flex-shrink:0;margin-top:.05em;}
</style>
<!-- /wp:html -->',
    ) );
} );


// ============================================================
// SEO & AUTOMATISIERUNGEN
// Hinzugefügt: April 2026
// Enthält: B3 Open Graph · B4 Canonical · E1 Auto-Meta-Description
//          E3 FAQPage Schema · E4 Article Schema · E5 Font-Preload
// ============================================================


// ── E5: FONT-PRELOAD ─────────────────────────────────────────
// Lädt die wichtigsten Schriftschnitte vor dem CSS-Parsing —
// verhindert "Flash of Unstyled Text" beim ersten Rendering.

add_action( 'wp_head', 'eigengrund_font_preload', 1 );
function eigengrund_font_preload() {
    $fonts = array(
        'https://fonts.gstatic.com/s/cormorantgaramond/v22/BXRlvF3Pi-DLmw0iBFJQCdsAKPM-gCzBtl2I.woff2',
        'https://fonts.gstatic.com/s/lato/v24/S6uyw4BMUTPHjxAwXjeu.woff2',
    );
    foreach ( $fonts as $url ) {
        echo '<link rel="preload" href="' . esc_url( $url ) . '" as="font" type="font/woff2" crossorigin="anonymous">' . "\n";
    }
}


// ── B4: CANONICAL-URL ────────────────────────────────────────
// Setzt für jede Seite einen kanonischen Link-Tag.
// Verhindert Duplicate-Content bei Query-Parametern (?sort=, ?ebseite=)
// und schützt vor zukünftigen URL-Dopplungen.

add_action( 'wp_head', 'eigengrund_canonical', 2 );
function eigengrund_canonical() {
    // Rank Math und Yoast setzen eigene Canonicals — nicht überschreiben
    if ( defined( 'RANK_MATH_VERSION' ) || defined( 'WPSEO_VERSION' ) ) {
        return;
    }
    $canonical = '';
    if ( is_singular() ) {
        $canonical = get_permalink();
    } elseif ( is_front_page() || is_home() ) {
        $canonical = home_url( '/' );
    } elseif ( is_archive() ) {
        $canonical = get_post_type_archive_link( get_post_type() ) ?: '';
    }
    // Spezialfall: /alle-berichte/ immer ohne Query-Parameter kanonisieren
    if ( isset( $_SERVER['REQUEST_URI'] ) && strpos( $_SERVER['REQUEST_URI'], '/alle-berichte' ) !== false ) {
        $canonical = home_url( '/alle-berichte/' );
    }
    if ( $canonical ) {
        echo '<link rel="canonical" href="' . esc_url( $canonical ) . '">' . "\n";
    }
}


// ── B3: OPEN GRAPH TAGS ──────────────────────────────────────
// Steuert wie eigengrund.space aussieht wenn ein Link geteilt wird:
// WhatsApp, LinkedIn, Twitter/X, Slack, Facebook.
// Erkennt automatisch den Seiten-Typ und gibt passende Tags aus.

add_action( 'wp_head', 'eigengrund_open_graph', 3 );
function eigengrund_open_graph() {
    // Rank Math und Yoast haben eigenes OG — nur als Fallback
    if ( defined( 'RANK_MATH_VERSION' ) || defined( 'WPSEO_VERSION' ) ) {
        // Für eg_erfahrung-CPT trotzdem eigene Tags setzen, da Plugins
        // Custom Post Types oft nicht vollständig abdecken
        if ( ! is_singular( 'eg_erfahrung' ) ) return;
    }

    $og_title       = get_bloginfo( 'name' );
    $og_description = get_bloginfo( 'description' );
    $og_url         = home_url( '/' );
    $og_type        = 'website';
    // Default-Bild: im WP-Admin → Einstellungen → Allgemein oder hier direkt eintragen
    // Sobald ein Bild unter /wp-content/uploads/ vorhanden ist, diese URL anpassen:
    $og_image       = home_url( '/wp-content/uploads/2026/04/eigengrund-og-default.jpg' );

    if ( is_singular( 'eg_erfahrung' ) ) {
        $og_type        = 'article';
        $og_url         = get_permalink();
        $vorname        = get_post_meta( get_the_ID(), 'eb_vorname', true );
        $alter          = get_post_meta( get_the_ID(), 'eb_alter', true );
        $abschluss      = get_post_meta( get_the_ID(), 'eb_abschluss', true );
        $og_title       = 'Erfahrungsbericht'
            . ( $vorname ? ' · ' . $vorname : '' )
            . ( $alter   ? ', ' . $alter    : '' )
            . ' – eigengrund.space';
        if ( $abschluss ) {
            $og_description = '„' . mb_substr( $abschluss, 0, 120 ) . '"';
        } else {
            $excerpt = get_post_field( 'post_excerpt', get_the_ID() );
            if ( $excerpt ) {
                $og_description = wp_strip_all_tags( $excerpt );
            }
        }
    } elseif ( is_singular() ) {
        $og_type        = 'article';
        $og_url         = get_permalink();
        $og_title       = get_the_title() . ' – eigengrund.space';
        $excerpt        = get_post_field( 'post_excerpt', get_the_ID() );
        if ( $excerpt ) {
            $og_description = wp_strip_all_tags( $excerpt );
        }
        // Für Themen-Seiten: Cluster-Tag ergänzen
        $thema_tag = get_post_meta( get_the_ID(), 'thema_tag', true );
        if ( $thema_tag ) {
            $og_title = $thema_tag . ': ' . get_the_title() . ' – eigengrund.space';
        }
    } elseif ( is_front_page() ) {
        $og_title       = 'eigengrund.space – Persönlichkeitsentwicklung · Selbstfindung · Potenzialentfaltung';
        $og_description = 'Vielleicht bist du gar nicht falsch. Vielleicht hast du bisher nur in die falsche Richtung geguckt. Ein Ort für Menschen, die schon viel gesucht haben.';
        $og_url         = home_url( '/' );
    }

    // Beschreibung säubern und kürzen
    $og_description = mb_substr( wp_strip_all_tags( $og_description ), 0, 200 );

    // Tags ausgeben
    echo "\n<!-- Open Graph – eigengrund.space (B3) -->\n";
    echo '<meta property="og:type"        content="' . esc_attr( $og_type )        . '">' . "\n";
    echo '<meta property="og:url"         content="' . esc_url(  $og_url )         . '">' . "\n";
    echo '<meta property="og:title"       content="' . esc_attr( $og_title )       . '">' . "\n";
    echo '<meta property="og:description" content="' . esc_attr( $og_description ) . '">' . "\n";
    echo '<meta property="og:image"       content="' . esc_url(  $og_image )       . '">' . "\n";
    echo '<meta property="og:site_name"   content="eigengrund.space">'               . "\n";
    echo '<meta property="og:locale"      content="de_DE">'                          . "\n";
    echo '<meta name="twitter:card"       content="summary_large_image">'            . "\n";
    echo '<meta name="twitter:title"      content="' . esc_attr( $og_title )       . '">' . "\n";
    echo '<meta name="twitter:description" content="' . esc_attr( $og_description ) . '">' . "\n";
    echo '<meta name="twitter:image"      content="' . esc_url(  $og_image )       . '">' . "\n";
    echo "<!-- /Open Graph -->\n\n";
}


// ── E1: AUTO-META-DESCRIPTION ────────────────────────────────
// Generiert Meta-Descriptions für Themen- und Prozess-Seiten automatisch
// aus dem WordPress-Excerpt. Wenn kein Excerpt: erste 155 Zeichen des Content.
// Erfahrungsberichte: bereits im Plugin geregelt (Zeilen 1548ff).

add_filter( 'rank_math/frontend/description', 'eigengrund_auto_meta_description' );
add_filter( 'wpseo_metadesc',                 'eigengrund_auto_meta_description' );
function eigengrund_auto_meta_description( $description ) {
    // Nur auf Seiten-Templates aktiv, nicht auf Posts oder CPTs
    if ( ! is_page() ) return $description;
    // Wenn Rank Math / Yoast schon eine Description hat, nicht überschreiben
    if ( ! empty( $description ) ) return $description;

    $template = get_page_template_slug( get_the_ID() );
    $relevant = array( 'page-thema.php', 'page-prozess.php', 'page-startseite.php' );
    if ( ! in_array( $template, $relevant, true ) ) return $description;

    // Aus Excerpt
    $excerpt = get_the_excerpt( get_the_ID() );
    if ( $excerpt ) {
        return mb_substr( wp_strip_all_tags( $excerpt ), 0, 155 );
    }
    // Fallback: erste 155 Zeichen des Content
    $content = get_post_field( 'post_content', get_the_ID() );
    if ( $content ) {
        $text = wp_strip_all_tags( strip_shortcodes( $content ) );
        $text = preg_replace( '/\s+/', ' ', trim( $text ) );
        return mb_substr( $text, 0, 155 );
    }
    return $description;
}

// Fallback ohne SEO-Plugin
add_action( 'wp_head', 'eigengrund_auto_meta_description_fallback', 2 );
function eigengrund_auto_meta_description_fallback() {
    if ( ! is_page() ) return;
    if ( defined( 'RANK_MATH_VERSION' ) || defined( 'WPSEO_VERSION' ) ) return;

    $template = get_page_template_slug( get_the_ID() );
    $relevant = array( 'page-thema.php', 'page-prozess.php', 'page-startseite.php' );
    if ( ! in_array( $template, $relevant, true ) ) return;

    $desc = get_the_excerpt( get_the_ID() );
    if ( ! $desc ) {
        $content = get_post_field( 'post_content', get_the_ID() );
        $desc    = mb_substr( wp_strip_all_tags( strip_shortcodes( $content ) ), 0, 155 );
    }
    if ( $desc ) {
        echo '<meta name="description" content="' . esc_attr( mb_substr( wp_strip_all_tags( $desc ), 0, 155 ) ) . '">' . "\n";
    }
}


// ── E3: FAQPAGE SCHEMA.ORG ───────────────────────────────────
// Generiert JSON-LD FAQPage-Schema automatisch aus dem Custom Field
// "fragen_box" auf Themen-Seiten. Google zeigt diese als Rich Results
// in den Suchergebnissen an (vergrößerter Eintrag mit aufklappbaren Fragen).
// Voraussetzung: Themen-Seite hat Custom Field "fragen_box" befüllt.

add_action( 'wp_head', 'eigengrund_faqpage_schema', 5 );
function eigengrund_faqpage_schema() {
    if ( ! is_page() ) return;
    if ( get_page_template_slug() !== 'page-thema.php' ) return;

    $fragen_raw = get_post_meta( get_the_ID(), 'fragen_box', true );
    if ( ! $fragen_raw ) return;

    $fragen = array_filter( array_map( 'trim', explode( "\n", $fragen_raw ) ) );
    if ( empty( $fragen ) ) return;

    // Für FAQPage braucht jede Frage eine Antwort.
    // Wir nutzen den Seiten-Excerpt oder den Seiten-Titel als generische Antwort,
    // da die echten Antworten im Seiteninhalt stehen (LLMs lesen den Inhalt).
    $seiten_titel = get_the_title();
    $seiten_url   = get_permalink();
    $excerpt      = wp_strip_all_tags( get_the_excerpt() );
    $antwort_basis = $excerpt
        ? $excerpt
        : 'Mehr dazu auf dieser Seite: ' . $seiten_titel . '.';

    $items = array();
    foreach ( $fragen as $frage ) {
        $frage = trim( $frage, '"„"\'–' );
        if ( ! $frage ) continue;
        $items[] = array(
            '@type'          => 'Question',
            'name'           => $frage,
            'acceptedAnswer' => array(
                '@type' => 'Answer',
                'text'  => $antwort_basis . ' Weiterlesen: ' . $seiten_url,
            ),
        );
    }

    if ( empty( $items ) ) return;

    $schema = array(
        '@context'   => 'https://schema.org',
        '@type'      => 'FAQPage',
        'mainEntity' => $items,
    );

    echo "\n" . '<script type="application/ld+json">'
        . wp_json_encode( $schema, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES )
        . '</script>' . "\n";
}


// ── E4: ARTICLE SCHEMA.ORG ───────────────────────────────────
// Generiert Article-Schema für Themen-Seiten und Prozess-Seiten.
// Signalisiert Suchmaschinen und LLMs: "Das ist redaktionell geprüfter
// Originalinhalt von identifizierbaren Autoren, kein automatisch
// generierter Text."
// Erfahrungsberichte: das Plugin regelt das separat.

add_action( 'wp_head', 'eigengrund_article_schema', 6 );
function eigengrund_article_schema() {
    if ( ! is_page() ) return;

    $template = get_page_template_slug( get_the_ID() );
    $relevant = array( 'page-thema.php', 'page-prozess.php' );
    if ( ! in_array( $template, $relevant, true ) ) return;

    $cluster = get_post_meta( get_the_ID(), 'prozess_cluster', true ) ?: '';
    $thema   = get_post_meta( get_the_ID(), 'thema_tag',       true ) ?: 'Thema';

    $schema = array(
        '@context'        => 'https://schema.org',
        '@type'           => 'Article',
        'headline'        => get_the_title(),
        'description'     => mb_substr( wp_strip_all_tags( get_the_excerpt() ), 0, 155 ),
        'url'             => get_permalink(),
        'dateModified'    => get_the_modified_date( 'c' ),
        'datePublished'   => get_the_date( 'c' ),
        'inLanguage'      => 'de-DE',
        'author'          => array(
            array( '@type' => 'Person', 'name' => 'Malte Röhrig',  'url' => home_url( '/ueber-uns' ) ),
            array( '@type' => 'Person', 'name' => 'Sandra',        'url' => home_url( '/ueber-uns' ) ),
        ),
        'publisher'       => array(
            '@type' => 'Organization',
            'name'  => 'eigengrund.space',
            'url'   => home_url( '/' ),
        ),
        'about'           => array(
            '@type' => 'Thing',
            'name'  => $cluster ?: $thema,
        ),
        'isPartOf'        => array(
            '@type' => 'WebSite',
            'name'  => 'eigengrund.space',
            'url'   => home_url( '/' ),
        ),
    );

    echo "\n" . '<script type="application/ld+json">'
        . wp_json_encode( $schema, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES )
        . '</script>' . "\n";
}

// ── PMPRO COOKIES DEAKTIVIEREN ───────────────────────────────
add_filter( 'pmpro_set_cookie', '__return_false' );