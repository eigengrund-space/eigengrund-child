<?php
/**
 * Template Name: Prozess-Seite
 * Template Post Type: page
 *
 * Custom Fields:
 *   prozess_cluster  → "Verstehen", "Unterstützen" oder "Orientieren"
 *   verwandte_seiten → URLs mit Komma trennen:
 *                      /im-prozess/integration, /im-prozess/erst-schwerer
 *   verwandte_titel  → Titel mit Komma trennen (gleiche Reihenfolge):
 *                      Integration unterstützen, Warum es erst schwerer wird
 */
get_header();

$cluster         = get_post_meta(get_the_ID(),'prozess_cluster',true)?:'Verstehen';
$verwandte_urls  = get_post_meta(get_the_ID(),'verwandte_seiten',true);
$verwandte_titel = get_post_meta(get_the_ID(),'verwandte_titel',true);

// Verwandte Seiten aufbereiten
$verwandte = array();
if($verwandte_urls){
    $urls  = array_filter(array_map('trim', explode(',', $verwandte_urls)));
    $titel = $verwandte_titel ? array_map('trim', explode(',', $verwandte_titel)) : array();
    foreach($urls as $i => $url){
        $verwandte[] = array(
            'url'   => $url,
            'titel' => isset($titel[$i]) ? $titel[$i] : basename($url),
        );
    }
}
?>
<style>
.egp-wrap{max-width:860px;margin:0 auto;padding:0 2.5rem;}
.egp-bc{font-size:11px;letter-spacing:.14em;text-transform:uppercase;color:rgba(30,27,20,.45);margin-bottom:1.75rem;font-family:'Lato',sans-serif;font-weight:300;padding-top:3rem;}
.egp-bc a{color:rgba(30,27,20,.55);text-decoration:none;}
.egp-bc a:hover{color:rgba(30,27,20,.8);}
.egp-cluster{font-size:10px;letter-spacing:.14em;text-transform:uppercase;color:#8B4513;border:.5px solid rgba(139,69,19,.25);padding:.28rem .7rem;border-radius:2px;margin-bottom:1.5rem;display:inline-block;font-family:'Lato',sans-serif;font-weight:300;}
.egp-h1{font-family:'Cormorant Garamond',serif;font-weight:300;font-size:clamp(28px,4vw,48px);line-height:1.15;color:#1E1B14;margin-bottom:1.25rem;}
.egp-rule{width:32px;height:.5px;background:#D4956A;margin-bottom:1.5rem;}
.egp-lead{font-family:'Cormorant Garamond',serif;font-weight:300;font-style:italic;font-size:clamp(16px,2vw,20px);line-height:1.7;color:rgba(30,27,20,.75);margin-bottom:2.5rem;}
.egp-content{padding-bottom:5rem;}
.egp-verwandte{margin-top:3rem;padding-top:2rem;border-top:.5px solid rgba(30,27,20,.1);}
.egp-vl{font-size:10px;letter-spacing:.14em;text-transform:uppercase;color:rgba(30,27,20,.45);margin-bottom:1rem;font-family:'Lato',sans-serif;font-weight:300;}
.egp-vgrid{display:grid;grid-template-columns:1fr 1fr;gap:.75rem;}
.egp-vlink{background:#fff;border:.5px solid rgba(30,27,20,.1);border-radius:2px;padding:1rem 1.1rem;text-decoration:none;display:block;font-family:'Lato',sans-serif;font-size:13px;color:rgba(30,27,20,.65);transition:background .2s;}
.egp-vlink:hover{background:rgba(30,27,20,.025);color:#1E1B14;}
.egp-vlink-cluster{font-size:10px;letter-spacing:.12em;text-transform:uppercase;color:rgba(30,27,20,.4);display:block;margin-bottom:.35rem;}
.egp-nav{display:flex;justify-content:space-between;border-top:.5px solid rgba(30,27,20,.1);padding-top:2rem;margin-top:2rem;}
.egp-navlink{font-size:13px;color:rgba(30,27,20,.65);text-decoration:none;font-family:'Lato',sans-serif;}
.egp-navlink:hover{color:#1E1B14;}
.egp-disc{background:rgba(30,27,20,.04);border:.5px solid rgba(30,27,20,.1);border-radius:2px;padding:1.1rem 1.4rem;font-size:12.5px;line-height:1.75;color:rgba(30,27,20,.65);margin-top:2.5rem;font-family:'Lato',sans-serif;}
.egp-disc strong{font-weight:400;color:rgba(30,27,20,.8);}
@media(max-width:680px){.egp-wrap{padding:0 1.25rem;}.egp-vgrid{grid-template-columns:1fr;}}
</style>

<div class="egp-wrap">
<?php while(have_posts()):the_post();?>

<div class="egp-bc">
    <a href="<?php echo esc_url(home_url('/'));?>">eigengrund.space</a> /
    <a href="<?php echo esc_url(home_url('/im-prozess'));?>">Im Prozess</a> /
    <?php the_title();?>
</div>

<div class="egp-cluster"><?php echo esc_html($cluster);?></div>
<h1 class="egp-h1"><?php the_title();?></h1>
<div class="egp-rule"></div>
<?php if(has_excerpt()):?><p class="egp-lead"><?php the_excerpt();?></p><?php endif;?>

<div class="egp-content">
    <?php the_content();?>

    <div class="egp-verwandte">
        <div class="egp-vl">Weitere Seiten im Prozess</div>
        <div class="egp-vgrid">
            <?php if(!empty($verwandte)):
                foreach($verwandte as $v):?>
                    <a href="<?php echo esc_url(home_url($v['url']));?>" class="egp-vlink">
                        <?php echo esc_html($v['titel']);?>
                    </a>
                <?php endforeach;
            else:
                // Fallback: automatisch andere Prozess-Seiten
                $auto=get_pages(array('parent'=>wp_get_post_parent_id(get_the_ID())?:0,'exclude'=>array(get_the_ID()),'number'=>4,'sort_column'=>'menu_order'));
                if($auto){
                    foreach($auto as $p){
                        $pc=get_post_meta($p->ID,'prozess_cluster',true)?:'';
                        echo '<a href="'.esc_url(get_permalink($p->ID)).'" class="egp-vlink">';
                        if($pc) echo '<span class="egp-vlink-cluster">'.esc_html($pc).'</span>';
                        echo esc_html($p->post_title).'</a>';
                    }
                }else{
                    echo '<a href="'.esc_url(home_url('/im-prozess')).'" class="egp-vlink">Alle Prozess-Seiten ansehen</a>';
                }
            endif;?>
        </div>
    </div>

    <div class="egp-disc">
        <strong>Hinweis.</strong> Diese Seite ersetzt keine psychotherapeutische oder &auml;rztliche Behandlung. Wenn du merkst, dass du schon l&auml;nger feststeckst &ndash; professionelle Begleitung in Anspruch zu nehmen ist keine Schw&auml;che. Bei akuten Krisen: Telefonseelsorge <strong>0800 111 0 111</strong> (kostenlos, 24/7).
    </div>

    <div class="egp-nav">
        <?php
        $prev=get_previous_post(); $next=get_next_post();
        if($prev) echo '<a href="'.esc_url(get_permalink($prev->ID)).'" class="egp-navlink">&larr; '.esc_html($prev->post_title).'</a>';
        else echo '<span></span>';
        if($next) echo '<a href="'.esc_url(get_permalink($next->ID)).'" class="egp-navlink">'.esc_html($next->post_title).' &rarr;</a>';
        ?>
    </div>
</div>

<?php endwhile;?>
</div>
<?php get_footer();?>
