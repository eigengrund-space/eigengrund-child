<?php
/**
 * eigengrund-child functions.php
 * v3.0
 */

// ── STYLES & SCRIPTS LADEN ──────────────────────────────────

add_action( 'wp_enqueue_scripts', 'eigengrund_enqueue' );
function eigengrund_enqueue() {
    wp_enqueue_style( 'eigengrund-fonts',
        get_stylesheet_directory_uri() . '/fonts/fonts.css',
        array(), '1.0.0' );
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
        get_stylesheet_directory_uri() . '/fonts/fonts.css',
        array(), '1.0.0' );
}


// ── KADENCE DEFAULTS ────────────────────────────────────────

add_filter( 'kadence_theme_options_defaults', 'eigengrund_kadence_defaults' );
function eigengrund_kadence_defaults( $defaults ) {
    $defaults['palette'] = json_encode( array(
        array( 'color' => '#A85D42', 'slug' => 'palette1', 'name' => 'Amber' ),
        array( 'color' => '#4A4038', 'slug' => 'palette2', 'name' => 'Dunkelbraun' ),
        array( 'color' => '#1C1B19', 'slug' => 'palette3', 'name' => 'Fast-Schwarz' ),
        array( 'color' => '#3A3428', 'slug' => 'palette4', 'name' => 'Dunkelbraun Hover' ),
        array( 'color' => '#6B6456', 'slug' => 'palette5', 'name' => 'Text gedimmt' ),
        array( 'color' => '#9A8E82', 'slug' => 'palette6', 'name' => 'Text faint' ),
        array( 'color' => '#F0E8D8', 'slug' => 'palette7', 'name' => 'Creme hell' ),
        array( 'color' => '#F2F0EB', 'slug' => 'palette8', 'name' => 'Creme' ),
        array( 'color' => '#FFFFFF', 'slug' => 'palette9', 'name' => 'Weiß' ),
    ) );
    $defaults['background_color']         = '#F2F0EB';
    $defaults['content_background_color'] = '#FFFFFF';
    $defaults['link_color']               = '#4A4038';
    $defaults['link_color_hover']         = '#A85D42';
    return $defaults;
}


// ── THEME SETUP ─────────────────────────────────────────────

add_action( 'after_setup_theme', 'eigengrund_setup' );
function eigengrund_setup() {
    add_theme_support( 'post-thumbnails' );
    add_theme_support( 'title-tag' );
    add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption' ) );
    add_theme_support( 'editor-color-palette', array(
        array( 'name' => 'Amber',       'slug' => 'eg-amber',   'color' => '#A85D42' ),
        array( 'name' => 'Dunkelbraun', 'slug' => 'eg-dark',    'color' => '#4A4038' ),
        array( 'name' => 'Fast-Schwarz','slug' => 'eg-black',   'color' => '#1C1B19' ),
        array( 'name' => 'Creme',       'slug' => 'eg-creme',   'color' => '#F2F0EB' ),
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
        get_stylesheet_directory_uri() . '/fonts/fonts.css',
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
        <div class="eg-sc-eb-grid">
            <?php while ( $q->have_posts() ) : $q->the_post();
                $vn = get_post_meta(get_the_ID(),'eb_vorname',true);
                $al = get_post_meta(get_the_ID(),'eb_alter',true);
                $ab = get_post_meta(get_the_ID(),'eb_abschluss',true);
                $si = get_post_meta(get_the_ID(),'eb_sichtbar',true);
                $gesperrt = ($si==='mitglieder' && !in_array('eg_mitglied', (array) wp_get_current_user()->roles)) || ($si==='angemeldet' && !is_user_logged_in());
            ?>
            <div class="eg-sc-eb-card">
                <div class="eg-sc-eb-person"><?php echo esc_html($vn.($al?' · '.$al:'')); ?></div>
                <?php if($ab): ?><div class="eg-sc-eb-quote">&bdquo;<?php echo esc_html($ab); ?>&ldquo;</div><?php endif; ?>
                <?php if($gesperrt): ?>
                <a href="<?php echo esc_url(home_url('/anmelden')); ?>" class="eg-sc-eb-link">🔒 Kostenlos anmelden</a>
                <?php else: ?>
                <a href="<?php the_permalink(); ?>" class="eg-sc-eb-link">Bericht lesen →</a>
                <?php endif; ?>
            </div>
            <?php endwhile; wp_reset_postdata(); ?>
        </div>
        <?php else : ?>
        <p class="eg-sc-eb-empty">Noch keine Berichte vorhanden.</p>
        <?php endif; ?>
    </section>
    <?php
    return ob_get_clean();
}

// [eg_start_cta_einreichen]
add_shortcode( 'eg_start_cta_einreichen', 'eg_start_cta_einreichen_sc' );
function eg_start_cta_einreichen_sc() {
    ob_start(); ?>
    <section class="eg-sc-cta">
        <div class="eg-sc-cta-inner">
            <div>
                <div class="eg-sc-cta-label">Mitmachen</div>
                <h2 class="eg-sc-cta-h2">Dein Prozess &ndash; <em>in deinen Worten.</em></h2>
                <p class="eg-sc-cta-body">Kein perfekter Text, keine Auflösung nötig. Nur deine ehrliche Beschreibung &ndash; für andere, die vielleicht gerade dort sind, wo du warst.</p>
            </div>
            <a href="<?php echo esc_url(home_url('/einreichen')); ?>" class="eg-btn eg-btn--primary">Bericht einreichen</a>
        </div>
    </section>
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

    <script>
    function egNlSubmit(uid) {
        var email = document.getElementById(uid+'Email').value.trim();
        if(!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)){
            document.getElementById(uid+'Email').classList.add('eg-input--error');
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
        get_stylesheet_directory_uri() . '/fonts/Newsreader_24pt-Regular.woff2',
        get_stylesheet_directory_uri() . '/fonts/Inter_18pt-Regular.woff2',
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

// ── SHARE-BUTTON: WIEDERVERWENDBARE FUNKTIONEN ──────────────────────
// Generisch nutzbar auf jeder Seite/jedem Post-Type. Wird aktuell von
// eigengrund-erfahrungsberichte.php automatisch um jeden Bericht gewickelt;
// kann später auch manuell in Themen-/Prozess-Seiten-Templates eingesetzt
// werden über: echo eg_share_button_markup();

function eg_share_button_markup() {
    return <<<'HTML'
<div class="eg-share">

  <button type="button" class="eg-share-btn" aria-haspopup="true" aria-expanded="false">
    <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="18" cy="5" r="3"></circle><circle cx="6" cy="12" r="3"></circle><circle cx="18" cy="19" r="3"></circle><line x1="8.6" y1="13.5" x2="15.4" y2="17.5"></line><line x1="15.4" y1="6.5" x2="8.6" y2="10.5"></line></svg>
    Teilen
  </button>

  <div class="eg-share-menu" role="menu">
    <button class="eg-share-opt" data-platform="whatsapp" role="menuitem">
      <span class="eg-share-icon">
        <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor"><path d="M12.04 2C6.58 2 2.13 6.45 2.13 11.91c0 1.75.46 3.45 1.32 4.95L2.05 22l5.3-1.39a9.9 9.9 0 0 0 4.69 1.19h.01c5.46 0 9.9-4.45 9.9-9.91 0-2.65-1.03-5.14-2.9-7.01A9.87 9.87 0 0 0 12.04 2zm5.8 14.16c-.24.68-1.4 1.3-1.93 1.38-.49.08-1.1.11-1.78-.11-.41-.13-.94-.31-1.62-.6-2.85-1.23-4.71-4.1-4.85-4.29-.14-.19-1.16-1.54-1.16-2.94 0-1.4.73-2.09.99-2.38.26-.28.56-.35.75-.35.19 0 .37 0 .53.01.17.01.4-.06.62.48.24.58.81 2 .88 2.14.07.14.12.31.02.5-.09.19-.14.31-.28.48-.14.17-.29.37-.42.5-.14.14-.28.29-.12.57.16.28.71 1.18 1.53 1.91 1.05.94 1.94 1.23 2.22 1.37.28.14.44.12.6-.07.17-.19.71-.83.9-1.11.19-.28.38-.24.63-.14.26.09 1.63.77 1.91.91.28.14.47.21.53.33.07.12.07.68-.17 1.36z"/></svg>
      </span>
      WhatsApp
    </button>

    <button class="eg-share-opt" data-platform="telegram" role="menuitem">
      <span class="eg-share-icon">
        <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor"><path d="M21.94 3.94a1.5 1.5 0 0 0-1.53-.26L2.6 10.36c-1.06.4-1.05 1.94.02 2.32l4.5 1.6 1.72 5.53c.28.9 1.42 1.15 2.05.46l2.44-2.66 4.53 3.34c.83.61 2.02.15 2.22-.86l3.14-15.4a1.5 1.5 0 0 0-.58-1.55zM9.3 14.55l-.02 3.2-1.4-4.5 10.8-6.9-9.38 8.2z"/></svg>
      </span>
      Telegram
    </button>

    <button class="eg-share-opt" data-platform="email" role="menuitem">
      <span class="eg-share-icon">
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6"><rect x="2" y="4" width="20" height="16" rx="2"></rect><path d="M2 6l10 7 10-7"></path></svg>
      </span>
      E-Mail
    </button>

    <button class="eg-share-opt" data-platform="native" role="menuitem" style="display:none;">
      <span class="eg-share-icon">
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6"><path d="M4 12v7a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2v-7"></path><polyline points="16 6 12 2 8 6"></polyline><line x1="12" y1="2" x2="12" y2="15"></line></svg>
      </span>
      Andere App …
    </button>

    <div class="eg-share-divider"></div>

    <button class="eg-share-opt" data-platform="copy" role="menuitem">
      <span class="eg-share-icon">
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6"><rect x="9" y="9" width="12" height="12" rx="2"></rect><path d="M5 15H4a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2h9a2 2 0 0 1 2 2v1"></path></svg>
      </span>
      <span class="eg-share-copy-label">Link kopieren</span>
    </button>
  </div>
</div>
HTML;
}

/**
 * Style + Script einmal pro Seitenaufruf, im Footer. Site-weit — kein
 * is_singular-Filter mehr, damit der Button auch auf künftigen
 * Themen-/Prozess-Seiten ohne weitere Anpassung funktioniert.
 */
add_action( 'wp_footer', 'eg_share_button_assets' );
function eg_share_button_assets() {
    static $printed = false;
    if ( $printed ) {
        return;
    }
    $printed = true;
    ?>
    <script>
    (function(){
      document.querySelectorAll('.eg-share').forEach(function(root){
        var btn  = root.querySelector('.eg-share-btn');
        var menu = root.querySelector('.eg-share-menu');
        if (!btn || !menu) return;

        var nativeOpt = root.querySelector('[data-platform="native"]');
        if (navigator.share) { nativeOpt.style.display = 'flex'; }

        function taggedUrl(platform){
          var base = window.location.origin + window.location.pathname;
          var params = new URLSearchParams();
          params.set('mtm_campaign', 'teilen');
          params.set('mtm_source', platform);
          params.set('mtm_medium', 'share');
          params.set('mtm_content', window.location.pathname.split('/').filter(Boolean).pop() || 'startseite');
          return base + '?' + params.toString();
        }

        function closeMenu(){
          menu.style.display = 'none';
          btn.setAttribute('aria-expanded', 'false');
        }

        btn.addEventListener('click', function(e){
          e.stopPropagation();
          var isOpen = menu.style.display === 'block';
          document.querySelectorAll('.eg-share-menu').forEach(function(m){ m.style.display = 'none'; });
          menu.style.display = isOpen ? 'none' : 'block';
          btn.setAttribute('aria-expanded', isOpen ? 'false' : 'true');
        });

        document.addEventListener('click', function(e){
          if (!root.contains(e.target)) closeMenu();
        });
        document.addEventListener('keydown', function(e){
          if (e.key === 'Escape') closeMenu();
        });

        root.querySelectorAll('.eg-share-opt').forEach(function(opt){
          opt.addEventListener('click', function(){
            var platform = opt.getAttribute('data-platform');
            var title = document.title.split('–')[0].split('|')[0].trim();
            var url = taggedUrl(platform);

            if (platform === 'whatsapp') {
              window.open('https://wa.me/?text=' + encodeURIComponent(title + ' — ' + url), '_blank');
            } else if (platform === 'telegram') {
              window.open('https://t.me/share/url?url=' + encodeURIComponent(url) + '&text=' + encodeURIComponent(title), '_blank');
            } else if (platform === 'email') {
              window.location.href = 'mailto:?subject=' + encodeURIComponent(title) + '&body=' + encodeURIComponent(url);
            } else if (platform === 'native' && navigator.share) {
              navigator.share({ title: title, url: url }).catch(function(){});
            } else if (platform === 'copy') {
              navigator.clipboard.writeText(url).then(function(){
                var label = root.querySelector('.eg-share-copy-label');
                var original = label.textContent;
                label.textContent = 'Kopiert ✓';
                setTimeout(function(){ label.textContent = original; }, 1800);
              });
            }
            closeMenu();
          });
        });
      });
    })();
    </script>
    <?php
}

// ── PMPRO: ROLLEN-SYNC FÜR EBENE 3 (JAHRESRAUM) ─────────────────────
// Vergibt/entzieht die Rolle 'eg_mitglied' automatisch, sobald sich der
// PMPro-Mitgliedsstatus für Level 3 ändert. Nutzt pmpro_hasMembershipLevel()
// statt nur den übergebenen $level_id zu vergleichen — bleibt so auch
// korrekt, falls später mehrere Level gleichzeitig möglich sind oder ein
// Level gekündigt statt gewechselt wird.

define( 'EG_JAHRESRAUM_LEVEL_ID', 3 );

add_action( 'pmpro_after_change_membership_level', 'eg_sync_mitglied_rolle', 10, 3 );
function eg_sync_mitglied_rolle( $level_id, $user_id, $cancel_level = null ) {
    if ( ! function_exists( 'pmpro_hasMembershipLevel' ) ) {
        return;
    }

    $user = get_user_by( 'id', $user_id );
    if ( ! $user ) {
        return;
    }

    if ( pmpro_hasMembershipLevel( EG_JAHRESRAUM_LEVEL_ID, $user_id ) ) {
        $user->add_role( 'eg_mitglied' );
    } else {
        $user->remove_role( 'eg_mitglied' );
    }
}

// ── EXTERNE GOOGLE-FONTS-REQUESTS SYSTEMWEIT BLOCKIEREN ─────────────
// Fängt jede Stylesheet-Registrierung ab, die auf fonts.googleapis.com
// zeigt — unabhängig davon, ob sie aus dem Theme, aus Kadence Blocks
// oder aus einem Plugin kommt. Läuft mit später Priorität, nachdem
// alle anderen Enqueues bereits registriert haben.

add_action( 'wp_enqueue_scripts', 'eg_remove_external_google_fonts', 100 );
function eg_remove_external_google_fonts() {
    global $wp_styles;

    if ( empty( $wp_styles->registered ) ) {
        return;
    }

    foreach ( $wp_styles->registered as $handle => $dep ) {
        if ( isset( $dep->src ) && is_string( $dep->src ) && strpos( $dep->src, 'fonts.googleapis.com' ) !== false ) {
            wp_dequeue_style( $handle );
            wp_deregister_style( $handle );
        }
    }
}

// ── MEIN-RAUM: DYNAMISCHE DASHBOARD-DATEN ───────────────────────────

add_shortcode( 'eg_mein_raum_name', 'eg_mein_raum_name_sc' );
function eg_mein_raum_name_sc() {
    if ( ! is_user_logged_in() ) return '';
    $user = wp_get_current_user();
    return esc_html( $user->first_name ?: $user->display_name );
}

add_shortcode( 'eg_mein_raum_seit', 'eg_mein_raum_seit_sc' );
function eg_mein_raum_seit_sc() {
    if ( ! is_user_logged_in() ) return '';
    $user_id = get_current_user_id();

    // PMPro-Startdatum der aktuell aktiven Mitgliedschaft holen
    if ( function_exists( 'pmpro_getMembershipLevelForUser' ) ) {
        $level = pmpro_getMembershipLevelForUser( $user_id );
        if ( $level && ! empty( $level->startdate ) ) {
            return date_i18n( 'F Y', $level->startdate );
        }
    }

    // Fallback: WordPress-Registrierungsdatum
    $user = get_userdata( $user_id );
    return $user ? date_i18n( 'F Y', strtotime( $user->user_registered ) ) : '';
}

add_shortcode( 'eg_mein_raum_fortschritt', 'eg_mein_raum_fortschritt_sc' );
function eg_mein_raum_fortschritt_sc( $atts ) {
    if ( ! is_user_logged_in() ) return '';
    $atts    = shortcode_atts( array( 'raum' => 'scham' ), $atts );
    $user_id = get_current_user_id();

    global $wpdb;

    // Fortschritt liegt in ytyw_eg_user_fortschritt (nicht in User-Meta):
    // eine Zeile pro user_id + raum_id, einheit_nummer = zuletzt
    // abgeschlossene Einheit. Raum wird über den Slug in
    // eg_emotionsraeume aufgelöst.
    $raum = $wpdb->get_row( $wpdb->prepare(
        "SELECT id FROM {$wpdb->prefix}eg_emotionsraeume WHERE slug = %s AND status = 'live'",
        sanitize_title( $atts['raum'] )
    ) );
    if ( ! $raum ) return 'Noch nicht begonnen';

    $fortschritt = $wpdb->get_row( $wpdb->prepare(
        "SELECT einheit_nummer FROM {$wpdb->prefix}eg_user_fortschritt WHERE user_id = %d AND raum_id = %d",
        $user_id, $raum->id
    ) );
    if ( ! $fortschritt ) return 'Noch nicht begonnen';

    // einheit_nummer speichert die zuletzt ABGESCHLOSSENE Einheit, nicht die
    // aktuelle — gleiche Berechnung wie render_raum() in class-frontend.php
    // ($aktuelle = min($abgeschlossen_bis + 1, EG_MAX_EINHEITEN)).
    $max_einheiten = defined( 'EG_MAX_EINHEITEN' ) ? EG_MAX_EINHEITEN : 21;
    $tag           = min( (int) $fortschritt->einheit_nummer + 1, $max_einheiten );

    return sprintf( 'Einheit %d von %d', $tag, $max_einheiten );
}