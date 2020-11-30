<header class="banner">
  <div class="container-fluid">
    <a class="brand" href="<?= esc_url(home_url('/')); ?>">
      <img class="img-fluid" src="<?= get_template_directory_uri(); ?>/dist/images/logo-valencia-sostenible.svg" alt="">
    </a>
    <nav class="nav-primary">
      <?php
      if (has_nav_menu('primary_navigation')) :
        wp_nav_menu(['theme_location' => 'primary_navigation', 'menu_class' => 'nav']);
      endif;
      ?>
    </nav>
  </div>
</header>
