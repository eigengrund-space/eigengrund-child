<?php
/**
 * Template Name: Startseite
 * Template Post Type: page
 *
 * Startseiten-Template für eigengrund.space
 * In WordPress: Seite anlegen → Seitenattribute → Template: "Startseite"
 */
get_header();
?>

<!– ═══ NAVIGATION ═══ –>
<nav class="eg-nav" role="navigation" aria-label="Hauptnavigation">
    <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="eg-logo">
        eigen<em>grund</em>.space
    </a>

    <ul class="eg-nav-links">
        <li><a href="<?php echo esc_url( home_url( '/themen' ) ); ?>">Themen</a></li>
        <li><a href="<?php echo esc_url( home_url( '/im-prozess' ) ); ?>">Im Prozess</a></li>
        <li><a href="<?php echo esc_url( home_url( '/ueber-uns' ) ); ?>">Über uns</a></li>
        <li><a href="<?php echo esc_url( home_url( '/events' ) ); ?>">Events</a></li>
    </ul>

    <div class="eg-nav-right">
        <button class="eg-toggle"
                onclick="egToggleMode()"
                aria-label="Tag/Nacht-Modus wechseln"
                title="Tag/Nacht wechseln">
            <span class="eg-toggle-icon" aria-hidden="true">&#9728;</span>
            <div class="eg-toggle-track">
                <div class="eg-toggle-thumb"></div>
            </div>
            <span class="eg-toggle-icon" aria-hidden="true">&#9789;</span>
            <span class="eg-toggle-lbl" id="eg-toggle-lbl">Tag</span>
        </button>
        <a href="<?php echo esc_url( home_url( '/anmelden' ) ); ?>"
           class="eg-btn eg-btn--primary eg-btn--sm">
            Anmelden
        </a>
    </div>
</nav>

<!– ═══ HERO ═══ –>
<section class="eg-hero" style="
    background: linear-gradient(160deg, #EEC98A 0%, #D4956A 55%, #B8613A 100%);
    padding: 6rem 2.5rem 5rem;
    position: relative;
    overflow: hidden;
">
    <!– Hintergrund-Schriftzeichen –>
    <div aria-hidden="true" style="
        position: absolute; right: -1rem; bottom: -2rem;
        font-family: 'Cormorant Garamond', serif;
        font-size: 22vw; font-weight: 300; font-style: italic;
        color: rgba(30,27,20,.05); line-height: 1;
        pointer-events: none; user-select: none;
    ">eg</div>

    <div style="max-width: 820px; position: relative; z-index: 1;">
        <div class="eg-tag" style="margin-bottom: 1.75rem;">
            Persönlichkeitsentwicklung · Selbstfindung · Potenzialentfaltung
        </div>

        <h1 class="eg-h1" style="margin-bottom: 1.25rem; max-width: 700px;">
            Vielleicht bist du<br>gar nicht <em>falsch.</em>
        </h1>

        <p class="eg-lead" style="margin-bottom: 3rem; max-width: 560px;">
            Vielleicht hast du bisher nur in die falsche Richtung geguckt.
        </p>

        <!– EINGANGSBEREICH –>
        <div style="
            background: rgba(255,255,255,.55);
            border: .5px solid rgba(30,27,20,.18);
            border-radius: 3px;
            padding: 1.75rem 2rem;
            max-width: 580px;
            backdrop-filter: blur(6px);
        ">
            <div class="eg-label" style="margin-bottom: .85rem;">Eingangsbereich</div>
            <p style="
                font-family: 'Cormorant Garamond', serif;
                font-weight: 300; font-style: italic;
                font-size: clamp(17px, 2.2vw, 21px);
                line-height: 1.5; color: var(--eg-text);
                margin-bottom: 1.1rem;
            ">Was hat dich hierher gebracht?</p>
            <textarea
                id="eg-eingang-input"
                rows="3"
                class="eg-textarea"
                placeholder="Schreib in deinen eigenen Worten – kein Zeichenlimit, keine richtige Antwort."
                style="background: rgba(255,255,255,.85);"
            ></textarea>
            <div style="
                display: flex;
                justify-content: space-between;
                align-items: center;
                margin-top: .85rem;
                flex-wrap: wrap;
                gap: .5rem;
            ">
                <span class="eg-small">Anonym · wird nicht gespeichert</span>
                <button class="eg-btn eg-btn--primary eg-btn--sm"
                        onclick="egHandleEingang()">
                    Widerspiegeln
                </button>
            </div>
            <div id="eg-eingang-response" style="display:none; margin-top: 1.25rem; padding-top: 1.1rem; border-top: .5px solid rgba(30,27,20,.15);">
                <p id="eg-response-satz" style="
                    font-family: 'Cormorant Garamond', serif;
                    font-style: italic;
                    font-size: clamp(15px, 1.8vw, 18px);
                    line-height: 1.7;
                    color: var(--eg-text);
                    margin-bottom: 1rem;
                "></p>
                <div id="eg-response-links" style="display: flex; flex-direction: column; gap: .4rem;"></div>
            </div>
        </div>
    </div>
</section>

<!– ═══ THEMEN ═══ –>
<section style="padding: 4.5rem 2.5rem; background: var(--eg-bg); transition: background var(--eg-transition-slow);">
    <div style="display: flex; justify-content: space-between; align-items: baseline; margin-bottom: 2.5rem; flex-wrap: wrap; gap: .5rem;">
        <h2 class="eg-h2">Womit Menschen hierherkommen</h2>
        <a href="<?php echo esc_url( home_url( '/themen' ) ); ?>" style="
            font-size: 11px; letter-spacing: .1em; text-transform: uppercase;
            color: var(--eg-accent); text-decoration: none;
        ">Alle Themen →</a>
    </div>

    <div class="eg-themen-grid">
        <?php
        // Themen-Karten – später durch WordPress-Posts ersetzen
        $themen = array(
            array( 'nr' => '01', 'titel' => 'Innere Leere trotz', 'em' => 'äußerem Erfolg',        'url' => '/themen/innere-leere' ),
            array( 'nr' => '02', 'titel' => 'Ich weiß nicht,',   'em' => 'was ich will vom Leben', 'url' => '/themen/orientierung' ),
            array( 'nr' => '03', 'titel' => 'Das innere Bremsen –', 'em' => 'Selbstsabotage',      'url' => '/themen/inneres-bremsen' ),
            array( 'nr' => '04', 'titel' => 'Nähe & Distanz –',  'em' => 'Ambivalenz in Beziehungen', 'url' => '/themen/naehe-distanz' ),
            array( 'nr' => '05', 'titel' => 'Sehnsucht nach',    'em' => 'Tiefe, Klarheit und Ganzheit', 'url' => '/themen/tiefe-klarheit' ),
            array( 'nr' => '06', 'titel' => 'Ich habe alles versucht –', 'em' => 'und nichts ändert sich', 'url' => '/themen/alles-versucht' ),
        );
        foreach ( $themen as $thema ) : ?>
            <a href="<?php echo esc_url( home_url( $thema['url'] ) ); ?>" class="eg-thema-card">
                <div class="eg-thema-num"><?php echo esc_html( $thema['nr'] ); ?></div>
                <div class="eg-thema-title">
                    <?php echo esc_html( $thema['titel'] ); ?><br>
                    <em><?php echo esc_html( $thema['em'] ); ?></em>
                </div>
                <div class="eg-thema-arrow">→</div>
            </a>
        <?php endforeach; ?>
    </div>
</section>

<!– ═══ PROZESS ═══ –>
<section style="padding: 4.5rem 2.5rem; background: var(--eg-bg-section); transition: background var(--eg-transition-slow);">
    <div style="display: flex; justify-content: space-between; align-items: baseline; margin-bottom: 1.25rem; flex-wrap: wrap;">
        <h2 class="eg-h2">Orientierung im Prozess</h2>
        <a href="<?php echo esc_url( home_url( '/im-prozess' ) ); ?>" style="
            font-size: 11px; letter-spacing: .1em; text-transform: uppercase;
            color: var(--eg-accent); text-decoration: none;
        ">Alle Seiten →</a>
    </div>
    <div class="eg-rule"></div>
    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem;">
        <?php
        $prozess = array(
            array( 'cluster' => 'Verstehen',   'titel' => 'Warum Veränderung Zeit braucht',                        'url' => '/im-prozess/veraenderung-zeit' ),
            array( 'cluster' => 'Verstehen',   'titel' => 'Warum es manchmal erst schwerer wird',                  'url' => '/im-prozess/erst-schwerer' ),
            array( 'cluster' => 'Unterstützen','titel' => 'Wie du deine Integration unterstützen kannst',          'url' => '/im-prozess/integration' ),
            array( 'cluster' => 'Orientieren', 'titel' => 'Coaching oder professionelle Begleitung – was passt?',  'url' => '/im-prozess/coaching-oder-therapie' ),
        );
        foreach ( $prozess as $p ) : ?>
            <a href="<?php echo esc_url( home_url( $p['url'] ) ); ?>" class="eg-card" style="text-decoration: none; display: block;">
                <div class="eg-label" style="margin-bottom: .6rem;"><?php echo esc_html( $p['cluster'] ); ?></div>
                <div class="eg-h3" style="margin-bottom: .5rem; font-size: 16px;"><?php echo esc_html( $p['titel'] ); ?></div>
                <div style="color: var(--eg-amber); font-size: 13px;">→</div>
            </a>
        <?php endforeach; ?>
    </div>
</section>

<!– ═══ STILLES ARCHIV ═══ –>
<section style="padding: 4.5rem 2.5rem; background: var(--eg-bg); transition: background var(--eg-transition-slow);">
    <div style="display: flex; justify-content: space-between; align-items: baseline; margin-bottom: 1.25rem;">
        <h2 class="eg-h2">Stilles Archiv</h2>
        <a href="<?php echo esc_url( home_url( '/stilles-archiv' ) ); ?>" style="
            font-size: 11px; letter-spacing: .1em; text-transform: uppercase;
            color: var(--eg-accent); text-decoration: none;
        ">Alle Einträge →</a>
    </div>
    <div class="eg-rule"></div>
    <div class="eg-archiv-entry">
        <div class="eg-label" style="margin-bottom: 1.1rem;">
            <?php echo esc_html( date_i18n( 'F Y' ) ); ?> · Malte
        </div>
        <p class="eg-archiv-text">
            Heute hat jemand beschrieben, wie es sich anfühlt, wenn man merkt,
            dass man seit Jahren dieselbe Geschichte erzählt – und plötzlich spürt,
            dass man selbst nicht mehr daran glaubt. Das war kein dramatischer Moment.
            Es war sehr leise. Und sehr klar.
        </p>
        <a href="<?php echo esc_url( home_url( '/stilles-archiv' ) ); ?>" style="
            display: inline-flex; align-items: center; gap: .4rem;
            font-size: 11px; letter-spacing: .1em; text-transform: uppercase;
            color: var(--eg-accent); text-decoration: none; margin-top: 1.5rem;
        ">Ältere Einträge lesen →</a>
    </div>
</section>

<!– ═══ CTA: ANMELDUNG ═══ –>
<section style="padding: 5rem 2.5rem; background: var(--eg-bg-section); transition: background var(--eg-transition-slow);">
    <div style="max-width: 600px;">
        <div class="eg-label" style="margin-bottom: 1.25rem;">Kostenlos · Kein Druck · Jederzeit kündbar</div>
        <h2 class="eg-h2" style="margin-bottom: 1.25rem; font-weight: 300; font-size: clamp(26px,4vw,42px);">
            Ein persönlicher Raum –<br><em>in deinem eigenen Tempo.</em>
        </h2>
        <p class="eg-body" style="max-width: 480px; margin-bottom: 1.5rem;">
            Wer sich weiter begleiten möchte, findet im freien Login-Bereich Werkzeuge
            zur Selbstreflexion. Ohne dass jemand mitliest. Ohne Erwartung.
        </p>
        <div style="display: flex; flex-wrap: wrap; gap: .5rem; margin-bottom: 1.75rem;">
            <?php
            $tools = array( 'Traum-Tracker', 'Prozess-Tagebuch', 'Lebensrad', 'Brief an mich', 'Selbsttest' );
            foreach ( $tools as $tool ) : ?>
                <span class="eg-tag"><?php echo esc_html( $tool ); ?></span>
            <?php endforeach; ?>
        </div>
        <div style="display: flex; gap: .75rem; flex-wrap: wrap;">
            <a href="<?php echo esc_url( home_url( '/anmelden' ) ); ?>"
               class="eg-btn eg-btn--primary">
                Kostenlos anmelden
            </a>
            <a href="<?php echo esc_url( home_url( '/mitgliedschaft' ) ); ?>"
               class="eg-btn eg-btn--ghost">
                Mehr erfahren
            </a>
        </div>
    </div>
</section>

<!– ═══ FOOTER ═══ –>
<footer class="eg-footer">
    <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="eg-footer-logo">
        eigen<em>grund</em>.space
    </a>
    <p class="eg-footer-disc">
        Diese Seite ersetzt keine therapeutische oder ärztliche Behandlung.<br>
        Bei akuten Krisen: Telefonseelsorge <strong>0800 111 0 111</strong> (kostenlos, 24/7)
    </p>
    <div class="eg-footer-links">
        <a href="<?php echo esc_url( home_url( '/impressum' ) ); ?>">Impressum</a>
        <a href="<?php echo esc_url( home_url( '/datenschutz' ) ); ?>">Datenschutz</a>
        <a href="<?php echo esc_url( home_url( '/ueber-uns' ) ); ?>">Über uns</a>
    </div>
</footer>

<!– EINGANGSBEREICH LOGIK –>
<script>
var egResponses = [
    {
        keywords: ['leer','leere','nichts','sinn','erfolgreich','funktionier','trotzdem'],
        satz: 'Du beschreibst etwas, das viele kennen – und kaum jemand ausspricht. Das Gefühl, dass das äußere Bild nicht das innere Erleben widerspiegelt.',
        links: [
            { text: 'Innere Leere trotz äußerem Erfolg', href: '<?php echo esc_url( home_url( "/themen/innere-leere" ) ); ?>' },
            { text: 'Warum Verstehen allein nicht reicht', href: '<?php echo esc_url( home_url( "/im-prozess/verstehen" ) ); ?>' },
        ]
    },
    {
        keywords: ['beziehung','nähe','distanz','partner','allein'],
        satz: 'Was du beschreibst, klingt wie ein Spannungsfeld zwischen dem Wunsch nach Verbindung und dem Bedürfnis nach Raum. Das ist kein Widerspruch – es ist menschlich.',
        links: [
            { text: 'Nähe & Distanz', href: '<?php echo esc_url( home_url( "/themen/naehe-distanz" ) ); ?>' },
        ]
    },
    {
        keywords: ['weiß nicht','orientierung','verloren','richtung','will','ziel'],
        satz: 'Diese Orientierungslosigkeit – das Nicht-Wissen wohin – ist oft kein Zeichen von Schwäche. Manchmal ist es der erste ehrliche Moment nach langer Zeit.',
        links: [
            { text: 'Ich weiß nicht, was ich will vom Leben', href: '<?php echo esc_url( home_url( "/themen/orientierung" ) ); ?>' },
        ]
    },
    {
        keywords: ['versucht','therapie','coaching','gelesen','kreis','dreht'],
        satz: 'Du hast viel versucht. Das ist kein Versagen – es zeigt, wie ernst du das nimmst. Manchmal liegt die Lösung wirklich außerhalb des Wegs, den du bisher gegangen bist.',
        links: [
            { text: 'Ich habe alles versucht', href: '<?php echo esc_url( home_url( "/themen/alles-versucht" ) ); ?>' },
        ]
    }
];

var egDefault = {
    satz: 'Was du beschreibst, hat hier einen Platz. Schau dich um – vielleicht findest du etwas, das sich anfühlt wie eine Antwort auf das, was dich gerade beschäftigt.',
    links: [
        { text: 'Alle Themen ansehen', href: '<?php echo esc_url( home_url( "/themen" ) ); ?>' },
    ]
};

function egHandleEingang() {
    var input = document.getElementById('eg-eingang-input').value.trim().toLowerCase();
    if ( ! input || input.length < 5 ) return;

    var matched = egDefault;
    for ( var i = 0; i < egResponses.length; i++ ) {
        var r = egResponses[i];
        for ( var j = 0; j < r.keywords.length; j++ ) {
            if ( input.indexOf( r.keywords[j] ) !== -1 ) {
                matched = r;
                break;
            }
        }
        if ( matched !== egDefault ) break;
    }

    document.getElementById('eg-response-satz').textContent = matched.satz;
    var linksEl = document.getElementById('eg-response-links');
    linksEl.innerHTML = matched.links.map( function(l) {
        return '<a href="' + l.href + '" style="display:inline-flex;align-items:center;gap:.5rem;font-size:12px;color:var(--eg-accent);text-decoration:none;">→ ' + l.text + '</a>';
    }).join('');

    document.getElementById('eg-eingang-response').style.display = 'block';
}

document.getElementById('eg-eingang-input').addEventListener('keydown', function(e) {
    if ( e.key === 'Enter' && ! e.shiftKey ) { e.preventDefault(); egHandleEingang(); }
});
</script>

<?php get_footer(); ?>
