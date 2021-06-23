/* ========================================================================
 * DOM-based Routing
 * Based on http://goo.gl/EUTi53 by Paul Irish
 *
 * Only fires on body classes that match. If a body class contains a dash,
 * replace the dash with an underscore when adding it to the object below.
 *
 * .noConflict()
 * The routing is enclosed within an anonymous function so that you can
 * always reference jQuery with $, even when in .noConflict() mode.
 * ======================================================================== */

(function($) {

  // Use this variable to set up the common and page specific functions. If you
  // rename this variable, you will also need to rename the namespace below.
  var Sage = {
    // All pages
    'common': {
      init: function() {

        setTimeout(function() {
          $('#loader').removeClass("visible");
        },1000);

        //Mouse behaviour
          var $circle = $('.circle'),
          $follow = $('.circle-follow');

          function moveCircle(e) {
            TweenLite.to($circle, 0.3, {
                  x: e.clientX,
                  y: e.clientY
              });
            TweenLite.to($follow, 2, {
                  x: e.clientX,
                  y: e.clientY
              });  
            }

          $(window).on('mousemove', moveCircle);

          
      },
      finalize: function() {
        // JavaScript to be fired on all pages, after page specific JS is fired
      }
    },
    // Home page
    'home': {
      init: function() {
        
        
        function drawWeather( d ) {
          var celsius = Math.round(parseFloat(d.main.temp)-273.15);
          var fahrenheit = Math.round(((parseFloat(d.main.temp)-273.15)*1.8)+32); 
          var description = d.weather[0].description;
          var humidity = d.main.humidity;
          var icon = d.weather[0].icon;
          var iconUrl = "https://dev.pablodols.com/valenciasostenible/wp-content/themes/atlas/dist/images/wicons/" + icon + ".svg";
        
          function pad(num) { 
            return ("0"+num).slice(-2);
          }
          function getTimeFromDate(timestamp) {
            var date = new Date(timestamp * 1000);
            var hours = date.getHours();
            var minutes = date.getMinutes();
            var seconds = date.getSeconds();
            return pad(hours)+":"+pad(minutes)+":"+pad(seconds);
          }
          document.getElementById('temp').innerHTML = celsius + '&deg;';
          document.getElementById('humidity').innerHTML = humidity + '<sub>%</sub>';
          $('#wicon').attr('src', iconUrl);
        
          
    
        }
      
        function weatherBalloon( cityID ) {
          var key = '5ae5dc2aa1362553c7bc6bd20726631e';
          fetch('https://api.openweathermap.org/data/2.5/weather?id=' + cityID + '&appid=' + key + '&lang=es')  
          .then(function(resp) { return resp.json(); }) // Convert data to json
          .then(function(data) {
            drawWeather(data);
            getTimeFromDate();
          })
          .catch(function() {
            // catch any errors
          });
        }
        
        window.onload = function() {
          weatherBalloon( 2509954 );
        };
        
        



        
      var currentTime = new Date();
      var hour = currentTime.getHours();
      var minutes = currentTime.getMinutes();
      var seconds = currentTime.getSeconds();
      
      
      if (hour < 10 ) {
        formattedHour = '0' + hour;
        formattedSeconds = '0' + seconds;
        } else {
          formattedHour = hour;
          formattedSeconds = seconds;
      }
      if (seconds < 10 ) {
            formattedSeconds = '0' + seconds;
          } else {
          formattedSeconds = seconds;
      }
      if (minutes < 10 ) {
        formattedMinutes = '0' + minutes;
      } else {
      formattedMinutes = minutes;
      }
      
      var timeString = formattedHour + ":" + formattedMinutes;
      console.log(timeString);
      
      function paintTime() {
      
        document.getElementById('time').innerHTML = timeString;
    
      }
      paintTime();
      




      },
      finalize: function() {
        // JavaScript to be fired on the home page, after the init JS
      }
    },
    // About us page, note the change from about-us to about_us.
    'about_us': {
      init: function() {
        // JavaScript to be fired on the about us page
      }
    },
    'single_lugar':{
      init: function(){
        const swiper = new Swiper('.swiper-container', {
          // Optional parameters
          direction: 'horizontal',
          loop: true,
        
          // If we need pagination
          pagination: {
            el: '.swiper-pagination',
          },
        
          // Navigation arrows
          navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
          },
        
        });
        if($(".swiper-pagination-bullet").length == 1) {
          $('.swiper-wrapper').addClass( "disabled" );
          $('.swiper-pagination').addClass( "disabled" );
          $('.swiper-button-prev').addClass( "disabled" );
          $('.swiper-button-next').addClass( "disabled" );
      }
      }
    } 
  };

  // The routing fires all common scripts, followed by the page specific scripts.
  // Add additional events for more control over timing e.g. a finalize event
  var UTIL = {
    fire: function(func, funcname, args) {
      var fire;
      var namespace = Sage;
      funcname = (funcname === undefined) ? 'init' : funcname;
      fire = func !== '';
      fire = fire && namespace[func];
      fire = fire && typeof namespace[func][funcname] === 'function';

      if (fire) {
        namespace[func][funcname](args);
      }
    },
    loadEvents: function() {
      // Fire common init JS
      UTIL.fire('common');

      // Fire page-specific init JS, and then finalize JS
      $.each(document.body.className.replace(/-/g, '_').split(/\s+/), function(i, classnm) {
        UTIL.fire(classnm);
        UTIL.fire(classnm, 'finalize');
      });

      // Fire common finalize JS
      UTIL.fire('common', 'finalize');
    }
  };

  // Load Events
  $(document).ready(UTIL.loadEvents);

})(jQuery); // Fully reference jQuery after this point.
