<?php
/**
 * Template Name: Themen-Seite
 * Template Post Type: page
 *
 * Custom Fields (unter "Benutzerdefinierte Felder" im Editor):
 *   thema_tag        → z.B. "Thema" oder "Neu"
 *   audio_titel      → z.B. "Wenn Erfolg nicht reicht"
 *   audio_dauer      → z.B. "ca. 4 Minuten"
 *   audio_person     → z.B. "Malte" oder "Sandra"
 *   fragen_box       → Fragen mit Zeilenumbruch trennen, z.B.:
 *                      "Warum reicht mir das alles nicht?
 *                       Bin ich undankbar?
 *                       Was fehlt mir eigentlich?"
 *   verwandte_seiten → URLs mit Komma trennen, z.B.:
 *                      /themen/orientierung, /themen/tiefe-klarheit
 *   verwandte_titel  → Titel mit Komma trennen (in gleicher Reihenfolge wie URLs):
 *                      Ich weiß nicht was ich will, Sehnsucht nach Tiefe
 */
get_header();

$thema_tag        = get_post_meta(get_the_ID(),'thema_tag',true)?:'Thema';
$audio_titel      = get_post_meta(get_the_ID(),'audio_titel',true);
$audio_dauer      = get_post_meta(get_the_ID(),'audio_dauer',true)?:'ca. 4 Minuten';
$audio_person     = get_post_meta(get_the_ID(),'audio_person',true)?:'Malte';
$fragen_raw       = get_post_meta(get_the_ID(),'fragen_box',true);
$verwandte_urls   = get_post_meta(get_the_ID(),'verwandte_seiten',true);
$verwandte_titel  = get_post_meta(get_the_ID(),'verwandte_titel',true);

// Fragen aufbereiten
$fragen = array();
if($fragen_raw){
    $fragen = array_filter(array_map('trim', explode("\n", $fragen_raw)));
}

// Verwandte Seiten aufbereiten
$verwandte = array();
if($verwandte_urls){
    $urls   = array_filter(array_map('trim', explode(',', $verwandte_urls)));
    $titel  = $verwandte_titel ? array_map('trim', explode(',', $verwandte_titel)) : array();
    foreach($urls as $i => $url){
        $verwandte[] = array(
            'url'   => $url,
            'titel' => isset($titel[$i]) ? $titel[$i] : basename($url),
        );
    }
}
?>
<style>
.eg-wrap{max-width:1100px;margin:0 auto;padding:0 2.5rem;}
.eg-hero{padding:4rem 0 3rem;max-width:760px;}
.eg-breadcrumb{font-size:11px;letter-spacing:.14em;text-transform:uppercase;color:rgba(30,27,20,.45);margin-bottom:1.75rem;font-family:'Lato',sans-serif;font-weight:300;}
.eg-breadcrumb a{color:rgba(30,27,20,.55);text-decoration:none;}
.eg-breadcrumb a:hover{color:rgba(30,27,20,.8);}
.eg-page-tag{display:inline-block;font-size:10px;letter-spacing:.14em;text-transform:uppercase;color:#8B4513;border:.5px solid rgba(139,69,19,.25);padding:.28rem .7rem;border-radius:2px;margin-bottom:1.5rem;font-family:'Lato',sans-serif;font-weight:300;}
.eg-hero h1{font-family:'Cormorant Garamond',serif;font-weight:300;font-size:clamp(34px,5vw,58px);line-height:1.1;color:#1E1B14;margin-bottom:1.25rem;font-style:italic;}
.eg-hero h1 em{font-style:italic;color:#8B4513;}
.eg-rule{width:32px;height:.5px;background:#D4956A;margin-bottom:1.5rem;}
.eg-lead{font-family:'Cormorant Garamond',serif;font-weight:300;font-style:italic;font-size:clamp(17px,2.2vw,22px);line-height:1.7;color:rgba(30,27,20,.75);max-width:620px;margin-bottom:2.5rem;}
.eg-audio{display:inline-flex;align-items:center;gap:.9rem;background:#fff;border:.5px solid rgba(30,27,20,.12);padding:.75rem 1.25rem;border-radius:2px;margin-bottom:3.5rem;cursor:pointer;transition:border-color .2s;text-decoration:none;}
.eg-audio:hover{border-color:#D4956A;}
.eg-audio-play{width:32px;height:32px;background:#D4956A;border-radius:50%;display:flex;align-items:center;justify-content:center;flex-shrink:0;}
.eg-audio-txt{font-size:13px;color:rgba(30,27,20,.7);line-height:1.5;font-family:'Lato',sans-serif;}
.eg-audio-txt strong{font-weight:400;color:#1E1B14;font-size:14px;display:block;}
.eg-layout{display:grid;grid-template-columns:1fr 280px;gap:4rem;padding-bottom:5rem;align-items:start;}
.eg-content{min-width:0;}
.eg-sc{background:#fff;border:.5px solid rgba(30,27,20,.1);padding:1.35rem;border-radius:2px;margin-bottom:1.25rem;}
.eg-sc--a{background:rgba(212,149,106,.08);border-color:rgba(139,69,19,.2);}
.eg-sl{font-size:10px;letter-spacing:.16em;text-transform:uppercase;color:rgba(30,27,20,.45);margin-bottom:.9rem;font-family:'Lato',sans-serif;font-weight:300;}
.eg-st{font-family:'Cormorant Garamond',serif;font-weight:400;font-size:16px;line-height:1.35;color:#1E1B14;margin-bottom:.45rem;}
.eg-sp{font-size:13px;line-height:1.7;color:rgba(30,27,20,.65);margin-bottom:1.1rem;font-family:'Lato',sans-serif;}
.eg-si{font-family:'Cormorant Garamond',serif;font-style:italic;font-size:15px;line-height:1.6;color:rgba(30,27,20,.7);margin-bottom:1.1rem;}
.eg-ul{list-style:none;padding:0;margin:0;}
.eg-ul li{padding:.6rem 0;border-bottom:.5px solid rgba(30,27,20,.07);font-size:13px;font-family:'Lato',sans-serif;}
.eg-ul li:last-child{border-bottom:none;}
.eg-ul li a{color:rgba(30,27,20,.65);text-decoration:none;display:flex;gap:.5rem;}
.eg-ul li a:hover{color:#1E1B14;}
.eg-ul .arr{color:#D4956A;flex-shrink:0;}
.eg-btn-s{display:block;text-align:center;font-size:11px;letter-spacing:.08em;text-transform:uppercase;padding:.65rem;border:.5px solid rgba(30,27,20,.2);border-radius:2px;color:#1E1B14;text-decoration:none;font-family:'Lato',sans-serif;transition:background .2s;margin-bottom:.5rem;}
.eg-btn-s:hover{background:rgba(30,27,20,.04);color:#1E1B14;}
.eg-btn-sf{background:#1E1B14;color:#F7F0E6;border-color:#1E1B14;}
.eg-btn-sf:hover{background:#3A3428;color:#F7F0E6;}
/* Fragen-Box */
.eg-fragen{background:rgba(30,27,20,.03);border:.5px solid rgba(30,27,20,.1);border-radius:2px;padding:1.5rem 1.75rem;margin:2.5rem 0;}
.eg-fragen-label{font-size:10px;letter-spacing:.14em;text-transform:uppercase;color:rgba(30,27,20,.45);margin-bottom:1rem;font-family:'Lato',sans-serif;font-weight:300;}
.eg-fragen-list{list-style:none;padding:0;margin:0;}
.eg-fragen-list li{font-family:'Cormorant Garamond',serif;font-style:italic;font-size:clamp(15px,1.8vw,18px);line-height:1.7;color:rgba(30,27,20,.72);padding:.35rem 0;border-bottom:.5px solid rgba(30,27,20,.06);}
.eg-fragen-list li:last-child{border-bottom:none;}
.eg-fragen-list li::before{content:'\201E';color:#D4956A;margin-right:.3rem;}
/* Disclaimer */
.eg-disc{background:rgba(30,27,20,.04);border:.5px solid rgba(30,27,20,.1);border-radius:2px;padding:1.1rem 1.4rem;font-size:12.5px;line-height:1.75;color:rgba(30,27,20,.65);margin-top:2.5rem;font-family:'Lato',sans-serif;}
.eg-disc strong{font-weight:400;color:rgba(30,27,20,.8);}
@media(max-width:900px){.eg-layout{grid-template-columns:1fr;}.eg-sidebar{order:-1;}}
@media(max-width:680px){.eg-wrap{padding:0 1.25rem;}.eg-hero{padding:2.5rem 0 2rem;}}
</style>

<div class="eg-wrap">
<?php while(have_posts()):the_post();?>

<div class="eg-hero">
    <div class="eg-breadcrumb">
        <a href="<?php echo esc_url(home_url('/'));?>">eigengrund.space</a> /
        <a href="<?php echo esc_url(home_url('/themen'));?>">Themen</a> /
        <?php the_title();?>
    </div>
    <div class="eg-page-tag"><?php echo esc_html($thema_tag);?></div>
    <h1><?php the_title();?></h1>
    <div class="eg-rule"></div>
    <?php if(has_excerpt()):?><p class="eg-lead"><?php the_excerpt();?></p><?php endif;?>
    <?php if($audio_titel):?>
    <div class="eg-audio">
        <div class="eg-audio-play">
            <svg width="11" height="13" viewBox="0 0 11 13" fill="none"><path d="M1 1L10 6.5L1 12V1Z" fill="#fff"/></svg>
        </div>
        <div class="eg-audio-txt">
            <strong>Audio-Impuls von <?php echo esc_html($audio_person);?></strong>
            <?php echo esc_html($audio_titel);?> &middot; <?php echo esc_html($audio_dauer);?>
        </div>
    </div>
    <?php endif;?>
</div>

<div class="eg-layout">
    <main class="eg-content">

        <?php the_content();?>

        <?php if(!empty($fragen)):?>
        <div class="eg-fragen">
            <div class="eg-fragen-label">Fragen, die viele in dieser Situation kennen</div>
            <ul class="eg-fragen-list">
                <?php foreach($fragen as $frage):?>
                    <li><?php echo esc_html(trim($frage,'"„"\''));?></li>
                <?php endforeach;?>
            </ul>
        </div>
        <?php endif;?>

        <div class="eg-disc">
            <strong>Hinweis.</strong> Diese Seite ersetzt keine psychotherapeutische oder &auml;rztliche Behandlung. Wenn du merkst, dass du schon l&auml;nger feststeckst und nicht mehr alleine weiterkommst &ndash; professionelle Begleitung in Anspruch zu nehmen ist keine Schw&auml;che. Bei akuten Krisen: Telefonseelsorge <strong>0800 111 0 111</strong> (kostenlos, 24/7).
        </div>
    </main>

    <aside class="eg-sidebar">
        <div class="eg-sc">
            <div class="eg-sl">Kostenlos &middot; Kein Druck</div>
            <div class="eg-st">Werkzeuge zur Selbstreflexion</div>
            <div class="eg-sp">Traum-Tracker, Prozess-Tagebuch, Lebensrad &ndash; in deinem eigenen Tempo, ohne dass jemand mitliest.</div>
            <a href="<?php echo esc_url(home_url('/anmelden'));?>" class="eg-btn-s eg-btn-sf">Kostenlos anmelden</a>
            <a href="<?php echo esc_url(home_url('/mitgliedschaft'));?>" class="eg-btn-s">Mehr erfahren</a>
        </div>

        <div class="eg-sc">
            <div class="eg-sl">Verwandte Themen</div>
            <ul class="eg-ul">
                <?php if(!empty($verwandte)):
                    foreach($verwandte as $v):?>
                        <li><a href="<?php echo esc_url(home_url($v['url']));?>"><span class="arr">→</span><?php echo esc_html($v['titel']);?></a></li>
                    <?php endforeach;
                else:
                    // Fallback: automatisch andere Themen-Seiten
                    $auto=get_pages(array('parent'=>wp_get_post_parent_id(get_the_ID())?:0,'exclude'=>array(get_the_ID()),'number'=>3,'sort_column'=>'menu_order'));
                    if($auto){foreach($auto as $a){
                        echo '<li><a href="'.esc_url(get_permalink($a->ID)).'"><span class="arr">→</span>'.esc_html($a->post_title).'</a></li>';
                    }}else{
                        echo '<li><a href="'.esc_url(home_url('/themen')).'"><span class="arr">→</span>Alle Themen ansehen</a></li>';
                    }
                endif;?>
            </ul>
        </div>

        <div class="eg-sc">
            <div class="eg-sl">Im Prozess</div>
            <ul class="eg-ul">
                <li><a href="<?php echo esc_url(home_url('/im-prozess/veraenderung-zeit'));?>"><span class="arr">→</span>Warum Ver&auml;nderung Zeit braucht</a></li>
                <li><a href="<?php echo esc_url(home_url('/im-prozess/erst-schwerer'));?>"><span class="arr">→</span>Warum es manchmal erst schwerer wird</a></li>
                <li><a href="<?php echo esc_url(home_url('/im-prozess/integration'));?>"><span class="arr">→</span>Wie du deine Integration unterst&uuml;tzen kannst</a></li>
            </ul>
        </div>

        <div class="eg-sc eg-sc--a">
            <div class="eg-sl">Malte &amp; Sandra &middot; K&ouml;ln</div>
            <div class="eg-si">&bdquo;Wir erkl&auml;ren nicht. Wir sind dabei.&ldquo;</div>
            <a href="<?php echo esc_url(home_url('/ueber-uns'));?>" class="eg-btn-s">&Uuml;ber uns</a>
        </div>
    </aside>
</div>

<?php endwhile;?>
</div>
<?php get_footer();?>
