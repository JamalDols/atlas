<?php /* Template Name: Home */ ?>

<div id="loader" class="visible"></div>
<div id="emptymodal">
  <div class="modal-content"></div>
</div>

<div id="map"></div>



<?php 
get_template_part('templates/header');
?>

<section class="home--info">
  <div class="container">
    <div class="row">

      <div class="col-md-12 col-lg-3">
      <h1 class="title--home"><?= the_field('title_1')?></h1>
      </div>
      <div class="col-md-12 col-lg-9">
        <span class="text__big">València Clima i Energia és una fundació municipal de l’Ajuntament de València, i que
          depén de la Regidoria d’Emergència Climàtica i Transició Energètica. Els eixos fonamentals del seu treball són
          la informació i formació sobre canvi climàtic.</span>
      </div>
    </div>
    <div class="row">
      <div class="col-md-12 col-lg-3">
        <h1 class="title--home"><?= the_field('title_2')?></h1>
      </div>
      <div class="col-md-12 col-lg-9 weather-info">
        <div class="weather-info--col">
          <span id="time"></span>
        </div>
        <div class="weather-info--col">
          <span id="temp"></span>
        </div>
        <div class="weather-info--col">
          <span id="humidity"></span>
        </div>
        <div class="weather-info--col">
          <div id="icon"><img id="wicon" src="" alt=""></div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-12 col-lg-3">
        <h1 class="title--home"><?= the_field('title_3')?></h1>
      </div>
      <div class="col-md-12 col-lg-3 card--poi">
        <a class="permalink" href="https://geoportal.valencia.es" target="_blank"></a>
        <div class="box-color">
          <div class="item--poi">
            <div class="image" style="background-image: url(<?= get_template_directory_uri(); ?>/dist/images/icon-poi-1.svg);">
              
            </div>
            <span class="text">
            <?php if(ICL_LANGUAGE_CODE=='ca'): ?>
              Fonts Públiques
            <?php elseif(ICL_LANGUAGE_CODE=='es'): ?>
              Fuentes públicas
            <?php endif;?>  
            </span>
          </div>
        </div>
      </div>
      <div class="col-md-12 col-lg-3 card--poi">
        <a class="permalink" href="http://www.valenbisi.es/Todas-las-estaciones/Mapa" target="_blank"></a>
        <div class="box-color">
          <div class="item--poi">
            <div class="image" style="background-image: url(<?= get_template_directory_uri(); ?>/dist/images/icon-poi-2.svg);">
              
            </div>
            <span class="text">ValenbiSi</span>
          </div>
        </div>
      </div>
      <div class="col-md-12 col-lg-3 card--poi">
        <a class="permalink" href="https://geoportal.valencia.es/portal/apps/webappviewer/index.html?id=377b3e9faafb451c89f6c3daf70a2fcc&extent=-44252.6496%2C4788101.6802%2C-39604.3228%2C4790425.8436%2C102100" target="_blank"></a>
        <div class="box-color">
          <div class="item--poi">
            <div class="image" style="background-image: url(<?= get_template_directory_uri(); ?>/dist/images/icon-poi-3.svg);">
              
            </div>
            <span class="text">
            <?php if(ICL_LANGUAGE_CODE=='ca'): ?>
              Arbres Monumentals
            <?php elseif(ICL_LANGUAGE_CODE=='es'): ?>
              Árboles monumentales
            <?php endif;?>  
            </span>
          </div>
        </div>
      </div>
    </div>



    <div class="row">
      <div class="col-md-12 col-lg-3">
        <h1 class="title--home"><?= the_field('title_4')?></h1>
      </div>


      <?php
        include_once("lib/getfeed.php");
      ?>
      
      
      
        <?php 
        if (ICL_LANGUAGE_CODE=='ca') {

              output_rss_feed('https://climaienergia.com/feed', 3, true, true, 200);

        } 
        elseif (ICL_LANGUAGE_CODE=='es') {

              output_rss_feed('https://climaienergia.com/es/feed', 3, true, true, 200);
        }
        ?> 

    
    </div>
  </div>
  </div>
</section>


<?php get_template_part('templates/map', 'main'); ?>

