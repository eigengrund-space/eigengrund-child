<?php
/**
 * Template Name: Erfahrungsbericht
 * Template Post Type: page
 */

// ── ZUGRIFFSKONTROLLE ────────────────────────────────────────
// Prüft ob der Besucher diesen Bericht sehen darf.
// Falls nicht → Weiterleitung zur Anmelden-Seite.
$eb_sichtbar_check = get_post_meta(get_the_ID(), 'eb_sichtbar', true) ?: 'oeffentlich';
$eb_status_check   = get_post_meta(get_the_ID(), 'eb_status',   true) ?: 'eingereicht';

// Nicht freigegebene Berichte: niemand darf sie sehen (außer Admins)
if ( $eb_status_check !== 'freigegeben' && ! current_user_can('edit_posts') ) {
    wp_redirect( home_url('/alle-berichte') );
    exit;
}

// Sichtbarkeit prüfen
if ( $eb_sichtbar_check === 'mitglieder' && ! current_user_can('eg_mitglied') && ! current_user_can('administrator') ) {
    wp_redirect( home_url('/anmelden') );
    exit;
}
if ( $eb_sichtbar_check === 'angemeldet' && ! is_user_logged_in() ) {
    wp_redirect( home_url('/anmelden') );
    exit;
}

get_header();
$vorname   = get_post_meta(get_the_ID(),'eb_vorname',true)?:'';
$alter     = get_post_meta(get_the_ID(),'eb_alter',true)?:'';
$beruf     = get_post_meta(get_the_ID(),'eb_beruf',true)?:'';
$sichtbar  = get_post_meta(get_the_ID(),'eb_sichtbar',true)?:'oeffentlich';
$abschluss = get_post_meta(get_the_ID(),'eb_abschluss',true)?:'';
$sicht_labels = array('oeffentlich'=>'Öffentlich','angemeldet'=>'Für Angemeldete','mitglieder'=>'Nur für Mitglieder');
$sicht_label = $sicht_labels[$sichtbar]??'Öffentlich';

// Navigation wird erst NACH the_post() berechnet — siehe unten im Loop
?>
<style>
.egeb-wrap{max-width:760px;margin:0 auto;padding:0 2.5rem;}
.egeb-bc{font-size:11px;letter-spacing:.14em;text-transform:uppercase;color:rgba(30,27,20,.45);margin-bottom:1.75rem;font-family:'Lato',sans-serif;font-weight:300;padding-top:3rem;}
.egeb-bc a{color:rgba(30,27,20,.55);text-decoration:none;}
.egeb-bc a:hover{color:rgba(30,27,20,.8);}
.egeb-sicht{display:inline-block;font-size:9px;letter-spacing:.12em;text-transform:uppercase;padding:.22rem .65rem;border-radius:2px;font-family:'Lato',sans-serif;font-weight:300;white-space:nowrap;}
.egeb-sicht--oeffentlich{background:rgba(30,27,20,.05);color:rgba(30,27,20,.55);border:.5px solid rgba(30,27,20,.15);}
.egeb-sicht--angemeldet{background:rgba(212,149,106,.08);color:#8B4513;border:.5px solid rgba(139,69,19,.2);}
.egeb-sicht--mitglieder{background:rgba(139,69,19,.1);color:#6B3A1F;border:.5px solid rgba(139,69,19,.25);}
.egeb-header-top{display:flex;justify-content:space-between;align-items:flex-start;gap:1.25rem;margin-bottom:1.5rem;}
.egeb-header-copy{min-width:0;}
.egeb-rule{width:32px;height:.5px;background:#D4956A;margin-bottom:1.5rem;}
.egeb-header-person{font-family:'Cormorant Garamond',serif;font-weight:300;font-size:clamp(22px,3vw,34px);line-height:1.2;color:#1E1B14;margin-bottom:.35rem;}
.egeb-beruf{font-size:13px;color:rgba(30,27,20,.55);font-family:'Lato',sans-serif;font-weight:300;letter-spacing:.03em;}
.egeb-untertitel{font-family:'Cormorant Garamond',serif;font-style:italic;font-size:clamp(17px,2.2vw,22px);line-height:1.6;color:rgba(30,27,20,.72);max-width:560px;margin-top:2rem;}
.egeb-content{font-family:'Cormorant Garamond',serif;font-weight:300;font-size:clamp(16px,1.8vw,19px);line-height:1.9;color:rgba(30,27,20,.82);margin-bottom:2.5rem;margin-top:2rem;}
.egeb-content p{margin-bottom:1.1rem;}

/* Navigation Vorheriger / Nächster */
.egeb-nav{display:flex;justify-content:space-between;align-items:stretch;gap:1px;border-top:.5px solid rgba(30,27,20,.1);margin-top:3rem;padding-top:2rem;}
.egeb-nav-link{flex:1;text-decoration:none;padding:.85rem 0;transition:opacity .2s;}
.egeb-nav-link:hover{opacity:.7;}
.egeb-nav-link--prev{text-align:left;padding-right:1rem;}
.egeb-nav-link--next{text-align:right;padding-left:1rem;border-left:.5px solid rgba(30,27,20,.08);}
.egeb-nav-dir{font-size:10px;letter-spacing:.14em;text-transform:uppercase;color:rgba(30,27,20,.45);margin-bottom:.3rem;font-family:'Lato',sans-serif;font-weight:300;}
.egeb-nav-name{font-family:'Cormorant Garamond',serif;font-size:16px;color:#1E1B14;line-height:1.3;}

/* CTA */
.egeb-cta{margin-top:3rem;background:rgba(212,149,106,.08);border:.5px solid rgba(139,69,19,.2);border-radius:2px;padding:1.75rem;text-align:center;}
.egeb-cta p{font-size:14px;line-height:1.75;color:rgba(30,27,20,.75);margin-bottom:1rem;font-family:'Lato',sans-serif;}
.egeb-cta a{display:inline-block;font-family:'Lato',sans-serif;font-weight:400;font-size:12px;letter-spacing:.08em;text-transform:uppercase;background:#1E1B14;color:#F7F0E6;padding:.75rem 1.75rem;border-radius:2px;text-decoration:none;}
.egeb-cta a:hover{background:#3A3428;}
.egeb-back{display:block;font-size:11px;letter-spacing:.1em;text-transform:uppercase;color:#8B4513;text-decoration:none;margin-top:2rem;font-family:'Lato',sans-serif;}
.egeb-back:hover{color:#D4956A;}

/* Krisenhinweis – C1 */
.egeb-krise{margin-top:2.5rem;padding:1rem 1.35rem;background:rgba(30,27,20,.04);border:.5px solid rgba(30,27,20,.1);border-radius:2px;font-size:13px;line-height:1.75;color:rgba(30,27,20,.75);font-family:'Lato',sans-serif;}
.egeb-krise-label{display:inline-block;font-size:10px;letter-spacing:.12em;text-transform:uppercase;color:rgba(30,27,20,.5);margin-right:.6rem;font-weight:300;}
.egeb-krise strong{font-weight:400;color:#1E1B14;}

@media(max-width:680px){.egeb-wrap{padding:0 1.25rem;}.egeb-header-top{flex-direction:column;gap:.75rem;}}
</style>

<div class="egeb-wrap">
<?php while(have_posts()):the_post();

// ── NAVIGATION ───────────────────────────────────────────────
// Muss NACH the_post() stehen damit $post global korrekt gesetzt ist.
// Richtung: Übersicht zeigt Neueste zuerst (DESC).
// → "Vorheriger Bericht" (←) = nächstneuerer (weiter oben in der Liste)
// → "Nächster Bericht"  (→) = nächstälterer (weiter unten in der Liste)
$prev_post = null;
$next_post = null;
if( get_post_type() === 'eg_erfahrung' ){
    global $wpdb, $post;
    $current_date = $post->post_date; // sicher aus dem Loop-Post
    $current_id   = $post->ID;

    // Vorheriger = neuerer Bericht (höheres Datum, kleinste Differenz → ASC LIMIT 1)
    $prev_id = $wpdb->get_var( $wpdb->prepare(
        "SELECT p.ID FROM {$wpdb->posts} p
         INNER JOIN {$wpdb->postmeta} pm ON p.ID = pm.post_id
             AND pm.meta_key = 'eb_status' AND pm.meta_value = 'freigegeben'
         WHERE p.post_type = 'eg_erfahrung' AND p.post_status = 'publish'
           AND p.post_date > %s AND p.ID != %d
         ORDER BY p.post_date ASC LIMIT 1",
        $current_date, $current_id
    ) );
    $prev_post = $prev_id ? get_post( $prev_id ) : null;

    // Nächster = älterer Bericht (niedrigeres Datum, kleinste Differenz → DESC LIMIT 1)
    $next_id = $wpdb->get_var( $wpdb->prepare(
        "SELECT p.ID FROM {$wpdb->posts} p
         INNER JOIN {$wpdb->postmeta} pm ON p.ID = pm.post_id
             AND pm.meta_key = 'eb_status' AND pm.meta_value = 'freigegeben'
         WHERE p.post_type = 'eg_erfahrung' AND p.post_status = 'publish'
           AND p.post_date < %s AND p.ID != %d
         ORDER BY p.post_date DESC LIMIT 1",
        $current_date, $current_id
    ) );
    $next_post = $next_id ? get_post( $next_id ) : null;
}
?>

<div class="egeb-bc">
    <a href="<?php echo esc_url(home_url('/')); ?>">eigengrund.space</a> /
    <a href="<?php echo esc_url(home_url('/alle-berichte')); ?>">Erfahrungsberichte</a> /
    <?php echo esc_html($vorname?:the_title('','',false)); ?>
</div>

<!-- Titel: Vorname · Alter / Beruf links, Sichtbarkeit rechts -->
<div class="egeb-header-top">
    <div class="egeb-header-copy">
        <div class="egeb-header-person">
            <?php echo esc_html(implode(' · ', array_filter(array($vorname, $alter)))); ?>
        </div>
        <?php if($beruf): ?>
        <div class="egeb-beruf"><?php echo esc_html($beruf); ?></div>
        <?php endif; ?>
    </div>

    <span class="egeb-sicht egeb-sicht--<?php echo esc_attr($sichtbar);?>"><?php echo esc_html($sicht_label);?></span>
</div>

<div class="egeb-rule"></div>

<div class="egeb-content">
    <?php the_content();?>

    <?php if($abschluss): ?>
    <div class="egeb-untertitel">&bdquo;<?php echo esc_html($abschluss); ?>&ldquo;</div>
    <?php endif; ?>
</div>

<!-- Krisenhinweis: erscheint auf allen Erfahrungsberichten -->
<div class="egeb-krise">
    <span class="egeb-krise-label">Hinweis</span>
    Diese Seite ersetzt keine professionelle Begleitung. Wenn du gerade an einem Punkt bist, wo du nicht mehr weiterweißt &ndash; oder wenn du in einer Krise bist &ndash; bitte ruf an: <strong>Telefonseelsorge 0800 111 0 111</strong> (kostenlos, 24/7, anonym).
</div>

<!-- Navigation: Vorheriger / Nächster Bericht -->
<?php if($prev_post || $next_post): ?>
<div class="egeb-nav">
    <?php if($prev_post):
        $prev_name  = get_post_meta($prev_post->ID,'eb_vorname',true)?:$prev_post->post_title;
        $prev_alter = get_post_meta($prev_post->ID,'eb_alter',true)?:'';
    ?>
    <a href="<?php echo esc_url(get_permalink($prev_post->ID)); ?>" class="egeb-nav-link egeb-nav-link--prev">
        <div class="egeb-nav-dir">&larr; Vorheriger Bericht</div>
        <div class="egeb-nav-name"><?php echo esc_html($prev_name.($prev_alter?' · '.$prev_alter:'')); ?></div>
    </a>
    <?php else: ?><div class="egeb-nav-link"></div><?php endif; ?>

    <?php if($next_post):
        $next_name  = get_post_meta($next_post->ID,'eb_vorname',true)?:$next_post->post_title;
        $next_alter = get_post_meta($next_post->ID,'eb_alter',true)?:'';
    ?>
    <a href="<?php echo esc_url(get_permalink($next_post->ID)); ?>" class="egeb-nav-link egeb-nav-link--next">
        <div class="egeb-nav-dir">Nächster Bericht &rarr;</div>
        <div class="egeb-nav-name"><?php echo esc_html($next_name.($next_alter?' · '.$next_alter:'')); ?></div>
    </a>
    <?php else: ?><div class="egeb-nav-link"></div><?php endif; ?>
</div>
<?php endif; ?>

<!-- CTA: Bericht einreichen -->
<div class="egeb-cta">
    <p>Hast du selbst einen Prozess erlebt, den andere kennen sollten? Teile deine Erfahrung &ndash; anonym, in eigenen Worten, ohne Vorgaben.</p>
    <a href="<?php echo esc_url(home_url('/einreichen'));?>">Bericht einreichen</a>
</div>

<a href="<?php echo esc_url(home_url('/alle-berichte'));?>" class="egeb-back">&larr; Alle Erfahrungsberichte</a>
<br>

<?php endwhile;?>
</div>
<?php get_footer();?>
