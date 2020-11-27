<footer class="primary-footer">
  <div class="container">
    <div class="row">
      <div class="col-md-6 col-lg-3">
        <nav class="nav-primary">
        <?php
        if (has_nav_menu('primary_navigation')) :
          wp_nav_menu(['theme_location' => 'primary_navigation', 'menu_class' => 'nav']);
        endif;
        ?>
        </nav>
      </div>
      <div class="col-md-6 col-lg-3 address">
        <p>
          València Clima i Energia<br>
          C/ Joan Verdeguer, 16. València
        </p>
        <p>
          961 061 588<br>
          canviclimatic@canviclimatic.org
        </p>
      </div>
      <div class="col-md-12 col-lg-6 logos-footer">
        <div class="image img-ajuntament">
          <img class="img-fluid" src="<?= get_template_directory_uri(); ?>/dist/images/logo-ajuntament.svg" alt="">
      </div>
        <div class="image img-v">
          <img class="img-fluid" src="<?= get_template_directory_uri(); ?>/dist/images/logo-v.svg" alt="">
        </div>
        
      </div>
    </div>
  </div>
</footer>
