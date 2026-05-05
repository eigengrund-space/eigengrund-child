<?php
/**
 * Template Name: Coming Soon
 * Template Post Type: page
 */

// CF7 Formular-ID – nach Anlegen des Formulars hier eintragen:
$cs_form_id = 29; // ← z.B. 123
?><!DOCTYPE html>
<html lang="de">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>eigengrund.space – Es entsteht etwas.</title>
  <meta name="description" content="Vielleicht bist du gar nicht falsch. Vielleicht hast du bisher nur in die falsche Richtung geguckt. eigengrund.space – ein Ort für Menschen, die schon sehr viel gesucht haben.">
  <meta property="og:title" content="eigengrund.space">
  <meta property="og:description" content="Vielleicht bist du gar nicht falsch. Vielleicht hast du bisher nur in die falsche Richtung geguckt.">
  <meta property="og:type" content="website">
  <?php wp_head(); ?>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,400;1,300;1,400&family=Lato:wght@300;400&display=swap" rel="stylesheet">
  <style>
    *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

    :root {
      --warm:  #F7F0E6;
      --amber: #D4956A;
      --dark:  #1E1B14;
      --serif: 'Cormorant Garamond', serif;
      --sans:  'Lato', sans-serif;
    }

    html { scroll-behavior: smooth; }

    body {
      font-family: var(--sans);
      font-weight: 300;
      min-height: 100vh;
      overflow-x: hidden;
      background: linear-gradient(135deg, #E8C98A 0%, #D4956A 48%, #C17050 100%);
    }

    body::before {
      content: '';
      position: fixed;
      inset: 0;
      background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 200 200' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='n'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.75' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23n)' opacity='0.035'/%3E%3C/svg%3E");
      pointer-events: none;
      z-index: 0;
    }

    .bg-word {
      position: fixed;
      right: -1rem; bottom: -3rem;
      font-family: var(--serif);
      font-size: 30vw; font-weight: 300; font-style: italic;
      color: rgba(30,27,20,0.045);
      line-height: 1; pointer-events: none; z-index: 0; user-select: none;
    }

    .page {
      position: relative; z-index: 1;
      min-height: 100vh;
      display: grid; grid-template-rows: auto 1fr auto;
    }

    nav {
      padding: 2rem 3rem;
      display: flex; justify-content: space-between; align-items: center;
      opacity: 0; animation: fadeUp 0.8s ease forwards; animation-delay: 0.1s;
    }
    .logo { font-family: var(--serif); font-weight: 400; font-size: 19px; letter-spacing: 0.08em; color: var(--dark); }
    .logo em { font-style: italic; color: #6B3A1F; }
    .nav-right { font-size: 11px; letter-spacing: 0.16em; text-transform: uppercase; color: rgba(30,27,20,0.85); }

    main {
      display: flex; flex-direction: column; justify-content: center;
      padding: 3rem 3rem 2rem; max-width: 840px;
    }

    .eyebrow {
      font-size: 11px; letter-spacing: 0.16em; text-transform: uppercase;
      color: rgba(30,27,20,0.72); margin-bottom: 2.25rem;
      opacity: 0; animation: fadeUp 0.8s ease forwards; animation-delay: 0.3s;
    }

    h1 {
      font-family: var(--serif); font-weight: 400;
      font-size: clamp(52px, 8.5vw, 96px); line-height: 1.05;
      color: var(--dark); margin-bottom: 1rem;
      opacity: 0; animation: fadeUp 1s ease forwards; animation-delay: 0.5s;
    }
    h1 em { font-style: italic; color: #6B3A1F; }

    .h1-sub {
      font-family: var(--serif); font-weight: 300; font-style: italic;
      font-size: clamp(20px, 3.2vw, 36px); line-height: 1.45;
      color: rgba(30,27,20,0.78); margin-bottom: 3rem; max-width: 660px;
      opacity: 0; animation: fadeUp 0.9s ease forwards; animation-delay: 0.7s;
    }

    .subtext {
      font-size: clamp(14px, 1.8vw, 17px); line-height: 1.9;
      color: rgba(30,27,20,0.85); max-width: 490px; margin-bottom: 3.5rem;
      opacity: 0; animation: fadeUp 0.8s ease forwards; animation-delay: 0.85s;
    }
    .subtext strong { font-weight: 400; color: rgba(30,27,20,0.95); }

    /* CF7 FORMULAR STYLING */
    .notify-form {
      opacity: 0; animation: fadeUp 0.8s ease forwards; animation-delay: 1s;
      margin-bottom: 3rem; max-width: 420px;
    }
    .notify-label {
      font-size: 12px; letter-spacing: 0.05em;
      color: rgba(30,27,20,0.85); margin-bottom: 0.9rem; display: block;
    }
    .notify-note {
      font-size: 11px; color: rgba(30,27,20,0.55); margin-top: 0.75rem;
    }

    /* CF7 Elemente ans Design anpassen */
    .notify-form .wpcf7-form { margin: 0; }
    .notify-form .wpcf7-form p { margin: 0; display: flex; }
    .notify-form input[type="email"] {
      flex: 1;
      font-family: var(--sans); font-weight: 300; font-size: 14px;
      padding: 0.85rem 1.25rem;
      background: rgba(30,27,20,0.08);
      border: 0.5px solid rgba(30,27,20,0.22);
      border-right: none;
      border-radius: 4px 0 0 4px;
      color: var(--dark); outline: none;
      transition: border-color 0.2s, background 0.2s;
    }
    .notify-form input[type="email"]::placeholder { color: rgba(30,27,20,0.5); }
    .notify-form input[type="email"]:focus {
      border-color: rgba(30,27,20,0.85);
      background: rgba(30,27,20,0.12);
    }
    .notify-form input[type="submit"] {
      font-family: var(--sans); font-weight: 400; font-size: 13px;
      padding: 0.85rem 1.75rem;
      background: var(--dark); color: var(--warm);
      border: none; border-radius: 0 4px 4px 0;
      cursor: pointer; letter-spacing: 0.03em;
      transition: background 0.2s; white-space: nowrap;
    }
    .notify-form input[type="submit"]:hover { background: #3A3428; }

    /* CF7 Erfolgsmeldung */
    .notify-form .wpcf7-response-output {
      font-family: var(--serif); font-style: italic; font-size: 16px;
      color: rgba(30,27,20,0.85); margin-top: 1rem;
      border: none !important; padding: 0 !important;
      background: none !important;
    }
    .notify-form .wpcf7-not-valid-tip {
      font-size: 11px; color: rgba(107,58,31,0.8); margin-top: 0.25rem; display: block;
    }
    .notify-form .wpcf7-spinner { display: none; }

    .divider {
      width: 40px; height: 0.5px; background: rgba(30,27,20,0.3); margin-bottom: 1.75rem;
      opacity: 0; animation: fadeUp 0.8s ease forwards; animation-delay: 1.1s;
    }

    .coaches {
      font-size: 13px; color: rgba(30,27,20,0.85); letter-spacing: 0.03em;
      opacity: 0; animation: fadeUp 0.8s ease forwards; animation-delay: 1.2s;
    }

    footer {
      position: relative; z-index: 1;
      padding: 1.75rem 3rem;
      border-top: 0.5px solid rgba(30,27,20,0.1);
      display: flex; justify-content: space-between; align-items: flex-end;
      flex-wrap: wrap; gap: 1rem;
      opacity: 0; animation: fadeUp 0.8s ease forwards; animation-delay: 1.3s;
    }
    .footer-disclaimer { font-size: 11px; line-height: 1.7; color: rgba(30,27,20,0.5); max-width: 500px; }
    .footer-right { font-size: 11px; color: rgba(30,27,20,0.5); text-align: right; }
    .footer-right a { color: rgba(30,27,20,0.55); text-decoration: none; }
    .footer-right a:hover { color: rgba(30,27,20,0.75); }

    @keyframes fadeUp {
      from { opacity: 0; transform: translateY(14px); }
      to   { opacity: 1; transform: translateY(0); }
    }

    @media (max-width: 600px) {
      nav { padding: 1.5rem 1.75rem; }
      main { padding: 2.5rem 1.75rem 2rem; }
      footer { padding: 1.5rem 1.75rem; flex-direction: column; align-items: flex-start; }
      .notify-form .wpcf7-form p { flex-direction: column; }
      .notify-form input[type="email"] { border-right: 0.5px solid rgba(30,27,20,0.22); border-bottom: none; border-radius: 4px 4px 0 0; }
      .notify-form input[type="submit"] { border-radius: 0 0 4px 4px; }
      .bg-word { font-size: 45vw; }
      .footer-right { text-align: left; }
    }
  </style>
</head>
<body>

  <div class="bg-word">eg</div>

  <div class="page">

    <nav>
      <div class="logo">eigen<em>grund</em>.space</div>
      <div class="nav-right">Es entsteht etwas</div>
    </nav>

    <main>

      <div class="eyebrow">Persönlichkeitsentwicklung &middot; Selbstfindung &middot; Potenzialentfaltung</div>

      <h1>Vielleicht bist du<br>gar nicht <em>falsch.</em></h1>

      <div class="h1-sub">Vielleicht hast du bisher nur in die falsche Richtung geguckt.</div>

      <p class="subtext">
        Dieser Ort entsteht gerade. Er ist f&uuml;r Menschen gedacht, die schon sehr viel
        gesucht haben &ndash; und noch nicht gefunden haben, was sie wirklich suchen.<br><br>
        <strong>eigengrund.space</strong> wird ein Ort der Orientierung, der Tiefe
        und der ehrlichen Begleitung. Ohne Druck. Ohne Versprechen.
      </p>

      <div class="notify-form">
        <span class="notify-label">Benachrichtigung wenn wir starten &ndash; freiwillig, einmalig, kein Newsletter.</span>
        <?php
        if ( $cs_form_id > 0 && function_exists( 'wpcf7_get_contact_form' ) ) {
            echo do_shortcode( '[contact-form-7 id="' . intval( $cs_form_id ) . '"]' );
        } else {
            // Platzhalter bis die ID eingetragen ist
            echo '<p style="font-size:13px;color:rgba(30,27,20,0.6);font-style:italic;">Formular wird eingerichtet &ndash; bitte kurz warten.</p>';
        }
        ?>
        <div class="notify-note">Keine weiteren E-Mails. Kein Tracking. Nur eine Nachricht, wenn es losgeht.</div>
      </div>

      <div class="divider"></div>

      <div class="coaches">
        Ein Projekt von <span>Malte &amp; Sandra</span> &middot; K&ouml;ln
      </div>

    </main>

    <footer>
      <div class="footer-disclaimer">
        Diese Seite ersetzt keine therapeutische oder &auml;rztliche Behandlung.
        Wenn du merkst, dass du Begleitung brauchst &ndash; dann wei&szlig;t du es bereits.
        Telefonseelsorge: 0800 111 0 111 (kostenlos, 24/7)
      </div>
      <div class="footer-right">
        eigengrund.space<br>
        <span style="display:inline-flex;gap:1em;margin-top:0.4em;">
          <a href="<?php echo esc_url( home_url( '/impressum' ) ); ?>">Impressum</a>
          <a href="<?php echo esc_url( home_url( '/datenschutz' ) ); ?>">Datenschutz</a>
        </span>
      </div>
    </footer>

  </div>

  <?php wp_footer(); ?>
</body>
</html>
