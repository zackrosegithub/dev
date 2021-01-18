
window.Popper = require('popper.js').default;
window.$ = window.jQuery = require('jquery');

require('bootstrap');
require ('./ajax_posts_load');

$(function(){

  $("#Burgerbutton").click(function(){
    $("div#navbar").toggle();
  });



  /* IE 11 Fix */

  window.isIE11 = !!window.MSInputMethodContext && !!document.documentMode;

  if( isIE11 )
  {
    $('.hero > video').each(function () {
      var position = function () {
        var $hero = $(this).parents('.hero:first'),
            width_multiplier = window.innerWidth / this.videoWidth,
            height_multiplier = window.innerHeight / this.videoHeight ,
            multiplier = Math.max(width_multiplier, height_multiplier),

            width = multiplier * this.videoWidth,
            height = multiplier * this.videoHeight;

        $(this).css({
          'width': width,
          'height': height,
          position: 'absolute',
          top: - (height - $hero.height()) / 2,
          left: - (width - $hero.width()) / 2,
        });
      };

      if(this.readyState <= 0)
      {
        this.onloadedmetadata = position.bind(this);
      }
      else
      {
        position.call(this);
      }

      $(window).resize(position.bind(this));
    });

    $('.hero > span > img').each(function () {
      var position = function () {
        var $hero = $(this).parents('.hero:first'),
            width_multiplier = window.innerWidth / this.naturalWidth,
            height_multiplier = window.innerHeight / this.naturalHeight ,
            multiplier = Math.max(width_multiplier, height_multiplier),

            width = multiplier * this.naturalWidth,
            height = multiplier * this.naturalHeight;

        $(this).css({
          'width': width,
          'height': height,
          position: 'absolute',
          top: - (height - $hero.height()) / 2,
          left: - (width - $hero.width()) / 2,
        });
      };

      position.call(this);

      $(window).resize(position.bind(this));
    });
  }

});


// $(window).on('load', function () {
//   $('.hero > video + picture').each(function () {
//     var $image = $(this);

//     $(this).prev().each(function () {
//       this.oncanplaythrough = function () {
//         $image.addClass('d-none');
//         $(this).removeClass('d-none');
//         this.play();
//       };

//       this.load();
//     });
//   })
// })


//ajax buttons

// $(document).on('click', '.filter-btn', function () {
//   $(this).siblings('.filter-btn').removeClass('btn-primary').addClass('btn-outline-secondary');
//   $(this).addClass('btn-primary').removeClass('btn-outline-secondary');
// });

// $(document).on('click', '.ajax-posts-load a[data-query]', function () {
//   var $this = $(this),
//       $parent = $this.parents('.ajax-posts-load:first'),
//       url = $parent.data('ajax'),
//       query = $parent.data('query') || {},
//       old,
//       content = $this.html();

//       console.log($this.data('query'));

  // if(isEqual($this.data('query') || {}, query))
  // {
  //   return;
  // }

//   $this.css('width', $this[0].clientWidth);
//   $this.html('<i class="fa fa-spin fa-refresh" />');

//   delete query.paged;

//   old = Object.assign({}, query);

//   query = $.extend(query, $this.data('query') || {});

//   $.get(url + '&' + $.param(query)).then(function (html) {
//     delete query.paged;

//     var load_more = isEqual(old, query);

//     html = $('<div>' + html + '</div>').find('.ajax-posts').html();

//     if(load_more)
//     {
//       $parent.find('.ajax-load-more').remove()
//       $parent.find('.ajax-posts').append(html);
//     }
//     else
//     {
//       $parent.find('.ajax-posts').html(html);
//     }

//     $this.css('width', '');
//     $this.html(content);
//   });

//   $parent.data('query', query);
// });


$(window).scroll(function () {
 var scroll = window.scrollY || window.pageYOffset;
 $('header').toggleClass('scrolled-to-top', scroll == 0);
});

$( "li.project" ).click(function() {
  let arrow = $("li.project");
  (arrow).addClass('active');
});

$( ".navbar-toggler" ).click(function() {
  $(".single-project-gradient").toggleClass( "single-project-gradient-top" );
});

$(document).ready(function(){
  $(".second-service-button").parent().css({"width": "100%"});
});

//  ||  $('.mega > .block-sticky-nav').length > 0) && $('.mega > div:first-child > .hero').length > 0

