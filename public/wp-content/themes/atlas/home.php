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
        <h1 class="title--home">Què és Valencia Sostenible?</h1>
      </div>
      <div class="col-md-12 col-lg-9">
        <span class="text__big">València Clima i Energia és una fundació municipal de l’Ajuntament de València, i que
          depén de la Regidoria d’Emergència Climàtica i Transició Energètica. Els eixos fonamentals del seu treball són
          la informació i formació sobre canvi climàtic.</span>
      </div>
    </div>
    <div class="row">
      <div class="col-md-12 col-lg-3">
        <h1 class="title--home">València hui</h1>
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
        <h1 class="title--home">Altres mapes d’interés</h1>
      </div>
      <div class="col-md-12 col-lg-3 card--poi">
        <a class="permalink" href="#"></a>
        <div class="box-color">
          <div class="item--poi">
            <div class="image" style="background-image: url(<?= get_template_directory_uri(); ?>/dist/images/icon-poi-1.svg);">
              
            </div>
            <span class="text">Fonts Públiques</span>
          </div>
        </div>
      </div>
      <div class="col-md-12 col-lg-3 card--poi">
        <a class="permalink" href="#"></a>
        <div class="box-color">
          <div class="item--poi">
            <div class="image" style="background-image: url(<?= get_template_directory_uri(); ?>/dist/images/icon-poi-2.svg);">
              
            </div>
            <span class="text">ValenbiSi</span>
          </div>
        </div>
      </div>
      <div class="col-md-12 col-lg-3 card--poi">
        <a class="permalink" href="#"></a>
        <div class="box-color">
          <div class="item--poi">
            <div class="image" style="background-image: url(<?= get_template_directory_uri(); ?>/dist/images/icon-poi-3.svg);">
              
            </div>
            <span class="text">Arbres Monumentals</span>
          </div>
        </div>
      </div>
    </div>



    <div class="row">
      <div class="col-md-12 col-lg-3">
        <h1 class="title--home">Notícies</h1>
      </div>


      <?php
      

      include_once("lib/getfeed.php");
      output_rss_feed('http://canviclimatic.org/feed', 3, true, true, 200);
      ?>

    
    </div>
  </div>
  </div>
</section>


<?php get_template_part('templates/map', 'main'); ?>

