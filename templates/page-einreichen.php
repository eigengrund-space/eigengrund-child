<?php
/**
 * Template Name: Erfahrungsbericht einreichen
 * Template Post Type: page
 *
 * Formular-Template für Erfahrungsberichte.
 * Setzt Contact Form 7 voraus (Plugin installieren).
 * CF7-Formular-ID unten eintragen (nach dem Erstellen des Formulars).
 */
get_header();

// ── CF7-FORMULAR-ID ──────────────────────────────────────────
// Nach dem Erstellen des Formulars in WordPress → Kontakt → Formulare
// die ID hier eintragen:
$cf7_form_id = 0; // ← HIER DIE ID EINTRAGEN (z.B. 123)
?>

<!– NAV –>
<nav class="eg-nav">
    <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="eg-logo">eigen<em>grund</em>.space</a>
    <div class="eg-nav-right">
        <a href="<?php echo esc_url( home_url( '/' ) ); ?>"
           style="font-size:11px;letter-spacing:.08em;text-transform:uppercase;color:var(--eg-text-muted);text-decoration:none;font-weight:300;">
            ← Zur Startseite
        </a>
        <button class="eg-toggle" onclick="egToggleMode()" aria-label="Tag/Nacht wechseln">
            <span class="eg-toggle-icon" aria-hidden="true">&#9728;</span>
            <div class="eg-toggle-track"><div class="eg-toggle-thumb"></div></div>
            <span class="eg-toggle-icon" aria-hidden="true">&#9789;</span>
            <span class="eg-toggle-lbl" id="eg-toggle-lbl">Tag</span>
        </button>
    </div>
</nav>

<!– HERO –>
<div style="padding: 4rem 2.5rem 3rem; max-width: 760px;">
    <div style="font-size:11px;letter-spacing:.14em;text-transform:uppercase;color:var(--eg-text-faint);margin-bottom:1.75rem;">
        eigengrund.space <span style="color:var(--eg-text-muted);">/ Erfahrungsbericht einreichen</span>
    </div>
    <div class="eg-tag" style="margin-bottom:1.5rem;">Mitmachen</div>
    <h1 class="eg-h1" style="margin-bottom:1.25rem;">
        Dein Prozess –<br><em>in deinen Worten.</em>
    </h1>
    <div class="eg-rule"></div>
    <p class="eg-lead" style="margin-bottom:1.25rem;">
        Entwicklungsprozesse sehen von außen selten so aus, wie sie sich anfühlen.
        Wer hier schreibt, hilft anderen zu wissen: Das, was ich erlebe, hat einen Namen –
        und ich bin damit nicht allein.
    </p>
    <p class="eg-body">
        Kein perfekter Text, keine Auflösung, keine Erfolgsgeschichte nötig. Es reicht,
        ehrlich zu beschreiben, wo du warst – und wo du jetzt bist. Alles wird vor
        Veröffentlichung von uns gelesen. Namen und konkrete Methoden werden auf Wunsch
        geändert oder anonymisiert.
    </p>
</div>

<!– BEISPIELE –>
<div style="display:flex;gap:.75rem;flex-wrap:wrap;align-items:center;padding:0 2.5rem 2.5rem;">
    <span style="font-size:13px;color:var(--eg-text-faint);">Orientierung gefällig?</span>
    <?php
    $beispiele = array(
        array( 'id' => 'claudia', 'label' => 'Claudia, 47' ),
        array( 'id' => 'thomas',  'label' => 'Thomas, 52' ),
        array( 'id' => 'anonym',  'label' => 'Anonym, 38' ),
    );
    foreach ( $beispiele as $b ) : ?>
        <button onclick="egOpenModal('<?php echo esc_attr( $b['id'] ); ?>')"
                style="display:inline-flex;align-items:center;gap:.5rem;
                       font-size:12px;letter-spacing:.05em;
                       color:var(--eg-text-muted);
                       border:.5px solid var(--eg-border-mid);
                       padding:.55rem 1rem;border-radius:2px;cursor:pointer;
                       background:var(--eg-bg-card);
                       transition:border-color .2s,color .2s;
                       font-family:var(--eg-font-sans);">
            <span style="color:var(--eg-amber);">↗</span>
            <?php echo esc_html( $b['label'] ); ?>
        </button>
    <?php endforeach; ?>
</div>

<!– MODAL –>
<div id="eg-modal-overlay"
     style="display:none;position:fixed;inset:0;background:var(--eg-modal-bg);
            z-index:200;align-items:center;justify-content:center;padding:1.5rem;
            backdrop-filter:blur(4px);"
     onclick="egHandleOverlay(event)">
    <div class="eg-modal" id="eg-modal-box">
        <button class="eg-modal-close" onclick="egCloseModal()">&#x2715;</button>
        <div id="eg-modal-meta" style="font-size:11px;letter-spacing:.12em;text-transform:uppercase;color:var(--eg-text-faint);margin-bottom:.75rem;"></div>
        <div id="eg-modal-thema" class="eg-tag" style="margin-bottom:1.25rem;"></div>
        <div id="eg-modal-text" class="eg-lead" style="font-size:clamp(15px,1.8vw,18px);line-height:1.85;"></div>
        <div id="eg-modal-satz" style="margin-top:1.5rem;padding-top:1.25rem;border-top:.5px solid var(--eg-border);font-family:var(--eg-font-serif);font-style:italic;font-size:16px;color:var(--eg-text-muted);"></div>
    </div>
</div>

<!– FORMULAR –>
<div style="max-width:680px;padding:0 2.5rem 5rem;">

    <?php if ( $cf7_form_id > 0 && function_exists( 'wpcf7_get_contact_form' ) ) : ?>
        <!– CF7-Formular einbetten wenn ID gesetzt –>
        <?php echo do_shortcode( '[contact-form-7 id="' . $cf7_form_id . '" title="Erfahrungsbericht"]' ); ?>

    <?php else : ?>
        <!– Platzhalter wenn CF7 noch nicht konfiguriert –>
        <div class="eg-card eg-card--hint" style="padding:2rem;">
            <div class="eg-label" style="margin-bottom:.75rem;">⚙ Setup erforderlich</div>
            <p class="eg-body">
                Bitte Contact Form 7 installieren, ein Formular anlegen
                und die ID in <code>page-einreichen.php</code> eintragen.
                Die Anleitung findest du in <strong>ANLEITUNG.md</strong>.
            </p>
        </div>
    <?php endif; ?>

</div>

<!– FOOTER –>
<footer class="eg-footer">
    <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="eg-footer-logo">eigen<em>grund</em>.space</a>
    <p class="eg-footer-disc">
        Diese Seite ersetzt keine therapeutische oder ärztliche Behandlung.<br>
        Bei akuten Krisen: Telefonseelsorge <strong>0800 111 0 111</strong> (kostenlos, 24/7)
    </p>
    <div class="eg-footer-links">
        <a href="<?php echo esc_url( home_url( '/impressum' ) ); ?>">Impressum</a>
        <a href="<?php echo esc_url( home_url( '/datenschutz' ) ); ?>">Datenschutz</a>
    </div>
</footer>

<!– MODAL DATEN & LOGIK –>
<script>
var egModalData = {
    claudia: {
        meta:  'Vorname: Claudia · Alter: 47 · Unternehmensberaterin',
        thema: 'Innere Leere trotz äußerem Erfolg',
        text:  '<p>Ich habe lange nicht gewusst, wie ich das nennen soll. Depression klang zu groß. Burnout passte auch nicht – ich war ja nicht erschöpft im klassischen Sinne. Ich habe einfach funktioniert. Gut sogar. Und trotzdem war da dieses Gefühl, das ich abends manchmal hatte, wenn alle im Bett waren: Ist das jetzt alles?</p><p>Ich habe das jahrelang ignoriert. Habe mir gesagt, dass ich undankbar bin. Dass andere viel größere Probleme haben. Dass ich mich zusammenreißen soll.</p><p>Was mich irgendwann zum Nachdenken gebracht hat, war ein Satz, den ich irgendwo gelesen habe: <em>Vielleicht bist du gar nicht falsch. Vielleicht hast du bisher nur in die falsche Richtung geguckt.</em> Ich weiß nicht warum, aber ich musste das dreimal lesen. Und dann noch einmal.</p><p>Ich bin seitdem in einem Prozess. Er ist nicht schnell. Er ist nicht immer angenehm. Aber er ist meiner. Das ist neu.</p>',
        satz:  '„Ich habe aufgehört, mich für das zu entschuldigen, was ich fühle."'
    },
    thomas: {
        meta:  'Vorname: Thomas · Alter: 52 · Unternehmer',
        thema: 'Nichts passt mehr – Orientierungslosigkeit im Leben',
        text:  '<p>Mit 50 hat meine Firma gut funktioniert, meine Familie war gesund, ich hatte keine echten Probleme. Und trotzdem bin ich morgens aufgewacht und habe mich gefragt, wozu ich das alles eigentlich mache.</p><p>Ich habe das meiner Frau nicht gesagt. Ich wusste nicht wie. Es klingt so... undankbar. So weich. Ich bin jemand, der Probleme löst. Und das hier war kein Problem, das man lösen konnte.</p><p>Was mich an dieser Seite überrascht hat: Es wird nicht versucht, mir etwas zu verkaufen. Nur Texte, die beschreiben, was ich erlebe. Das hat mir mehr gegeben als ich erwartet hatte.</p><p>Ich bin noch mittendrin. Aber ich bin nicht mehr allein damit.</p>',
        satz:  '„Ich löse das nicht – aber ich muss es auch nicht mehr alleine tragen."'
    },
    anonym: {
        meta:  'Name geändert · Alter: 38 · Projektmanager',
        thema: 'Das innere Bremsen – Selbstsabotage und Blockaden',
        text:  '<p>Ich weiß seit Jahren, was ich will. Ich mache Pläne, setze mir Ziele, fange an. Und dann – irgendwann, immer kurz bevor es ernst wird – passiert nichts mehr. Ich breche ab. Schiebe auf. Finde Gründe.</p><p>Ich habe das für Faulheit gehalten. Für mangelnde Disziplin. Für ein persönliches Versagen.</p><p>Der Gedanke, dass der Teil, der bremst, vielleicht nicht mein Feind ist – sondern einfach eine andere Agenda hat – das war neu für mich. Nicht weil ich eine Lösung gefunden habe. Sondern weil es das erste Mal war, dass ich aufgehört habe, gegen mich selbst zu kämpfen.</p><p>Das ist kein Durchbruch. Aber es ist anders als vorher. Und anders reicht gerade.</p>',
        satz:  '„Ich kämpfe nicht mehr gegen den Teil, der bremst – ich versuche, ihm zuzuhören."'
    }
};

function egOpenModal(id) {
    var d = egModalData[id];
    if ( ! d ) return;
    document.getElementById('eg-modal-meta').textContent  = d.meta;
    document.getElementById('eg-modal-thema').textContent = d.thema;
    document.getElementById('eg-modal-text').innerHTML    = d.text;
    document.getElementById('eg-modal-satz').innerHTML    = '<strong style="font-weight:400;color:var(--eg-text-faint);font-style:normal;font-size:10px;letter-spacing:.12em;text-transform:uppercase;display:block;margin-bottom:.5rem;">In einem Satz</strong>' + d.satz;
    var overlay = document.getElementById('eg-modal-overlay');
    overlay.style.display = 'flex';
    document.body.style.overflow = 'hidden';
}
function egCloseModal() {
    document.getElementById('eg-modal-overlay').style.display = 'none';
    document.body.style.overflow = '';
}
function egHandleOverlay(e) {
    if ( e.target === document.getElementById('eg-modal-overlay') ) egCloseModal();
}
document.addEventListener('keydown', function(e) {
    if ( e.key === 'Escape' ) egCloseModal();
});
</script>

<?php get_footer(); ?>
