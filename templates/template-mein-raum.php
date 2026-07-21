<?php
/**
 * Template Name: Mein Raum
 */
get_header(); ?>

<style>
.eg-mr-wrap {
    max-width: 1200px;
    margin: 0 auto;
    padding: 2rem 2.5rem;
    padding-top: 100px;
}
.eg-mr-layout {
    display: flex;
    gap: 2.5rem;
    margin-top: 2rem;
}
.eg-mr-nav {
    flex: 0 0 220px;
}
.eg-mr-nav-list {
    display: flex;
    flex-direction: column;
    gap: 2px;
}
.eg-mr-nav-label {
    font-size: 10px;
    letter-spacing: .12em;
    text-transform: uppercase;
    color: var(--eg-muted);
    padding: .4rem .6rem;
}
.eg-mr-nav-link {
    font-size: 13px;
    text-decoration: none;
    padding: .55rem .6rem;
    border-radius: 4px;
    border-left: 2px solid transparent;
    white-space: nowrap;
}
.eg-mr-content {
    flex: 1;
    min-width: 0;
}
.eg-mr-divider {
    height: .5px;
    background: var(--eg-border);
    margin: .5rem 0;
}
.eg-mr-logout {
    font-size: 13px;
    color: var(--eg-muted);
    text-decoration: none;
    padding: .55rem .6rem;
}

@media (max-width: 768px) {
    .eg-mr-wrap {
        padding: 1.5rem 1.25rem;
    }
    .eg-mr-layout {
        flex-direction: column;
        gap: 1rem;
    }
    .eg-mr-nav {
        flex: none;
        width: 100%;
        border-bottom: 1px solid var(--eg-border);
        padding-bottom: .5rem;
    }
    .eg-mr-nav-list {
        flex-direction: row;
        gap: .25rem;
        overflow-x: auto;
        -webkit-overflow-scrolling: touch;
        scrollbar-width: none;
    }
    .eg-mr-nav-list::-webkit-scrollbar {
        display: none;
    }
    .eg-mr-nav-label {
        display: none;
    }
    .eg-mr-nav-link {
        border-left: none;
        border-bottom: 2px solid transparent;
        flex-shrink: 0;
    }
    .eg-mr-divider {
        display: none;
    }
    .eg-mr-logout {
        margin-left: auto;
        flex-shrink: 0;
    }
}
</style>

<div class="eg-mr-wrap entry-content">

  <div class="eg-tag">Mein Raum</div>

  <h1 class="wp-block-heading">Willkommen, <em style="color:var(--eg-amber);"><?php echo do_shortcode('[pmpro_member field="first_name"]'); ?></em></h1>

  <div style="width:36px;height:.5px;background:var(--eg-amber);margin:1.25rem 0 1.5rem;"></div>

  <div style="font-size:13px;color:var(--eg-muted);margin-bottom:2rem;">
    Mitglied seit <?php echo do_shortcode('[eg_mein_raum_seit]'); ?>
  </div>

  <div class="eg-mr-layout">

    <nav class="eg-mr-nav">
      <div class="eg-mr-nav-list">
        <div class="eg-mr-nav-label">Konto</div>
        <?php
        $nav_items = [
          ['label' => 'Mein Raum',         'path' => '/mein-raum/'],
          ['label' => 'Profil bearbeiten',  'path' => '/kontodaten/your-profile/'],
          ['label' => 'Buchung ändern',     'path' => '/pakete/'],
        ];
        $current_path = trailingslashit(parse_url(home_url($_SERVER['REQUEST_URI']), PHP_URL_PATH));

        foreach ($nav_items as $item) :
            $item_path = trailingslashit($item['path']);
            $is_active = ($current_path === $item_path);
        ?>
          <a href="<?php echo esc_url($item['path']); ?>"
             class="eg-mr-nav-link"
             style="color:<?php echo $is_active ? 'var(--eg-accent)' : 'var(--eg-text)'; ?>;
                    border-left-color:<?php echo $is_active ? 'var(--eg-amber)' : 'transparent'; ?>;
                    border-bottom-color:<?php echo $is_active ? 'var(--eg-amber)' : 'transparent'; ?>;">
            <?php echo esc_html($item['label']); ?>
          </a>
        <?php endforeach; ?>

        <a href="<?php echo wp_logout_url(home_url()); ?>" class="eg-mr-logout">Abmelden</a>
      </div>
      <div class="eg-mr-divider"></div>
    </nav>

    <div class="eg-mr-content">
      <?php while (have_posts()) : the_post(); the_content(); endwhile; ?>
    </div>

  </div>
</div>

<?php get_footer(); ?>
