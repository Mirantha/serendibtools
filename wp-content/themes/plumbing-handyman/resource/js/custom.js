jQuery(function($) {

    /* -----------------------------------------
    Preloader
    ----------------------------------------- */
    $('#preloader').delay(1000).fadeOut();
    $('#loader').delay(1000).fadeOut("slow");

    /* -----------------------------------------
    Navigation
    ----------------------------------------- */
    $('.menu-toggle').click(function() {
        $(this).toggleClass('open');
    });

    /* -----------------------------------------
    Keyboard Navigation
    ----------------------------------------- */
    $(window).on('load resize', plumbing_handyman_navigation)

    function plumbing_handyman_navigation(event) {
        if ($(window).width() < 1200) {
            $('.main-navigation').find("li").last().bind('keydown', function(e) {
                if (e.shiftKey && e.which === 9) {
                    if ($(this).hasClass('focus')) {
                    }

                } else if (e.which === 9) {
                    e.preventDefault();
                    $('#masthead').find('.menu-toggle').focus();
                }                
            })
        } else {
            $('.main-navigation').find("li").unbind('keydown')
        }
    }

    plumbing_handyman_navigation()

    var plumbing_handyman_primary_menu_toggle = $('#masthead .menu-toggle');
    plumbing_handyman_primary_menu_toggle.on('keydown', function(e) {
        var tabKey = e.keyCode === 9;
        var shiftKey = e.shiftKey;

        if (plumbing_handyman_primary_menu_toggle.hasClass('open')) {
            if (shiftKey && tabKey) {
                e.preventDefault();
                const $the_last_li = $('.main-navigation').find("li").last()
                $the_last_li.find('a').focus()
                if (!$the_last_li.hasClass('focus')) {

                    const $is_parent_on_top = true
                    let $the_parent_ul = $the_last_li.closest('ul.sub-menu')

                    let count = 0

                    while (!!$the_parent_ul.length) {
                        ++count

                        const $the_parent_li = $the_parent_ul.closest('li')

                        if (!!$the_parent_li.length) {
                            $the_parent_li.addClass('focus')
                            $the_parent_ul = $the_parent_li.closest('ul.sub-menu')

                            // Blur the cross
                            $(this).blur()
                            $the_last_li.addClass('focus')
                        }

                        if (!$the_parent_ul.length) {
                            break;
                        }
                    }

                }

            };
        }
    })

    // Determine if the document is RTL
    var isRtl = $('html').attr('dir') === 'rtl';
    
  /* -----------------------------------------
  Slider Section
  ----------------------------------------- */

  jQuery(document).ready(function($){
    var $plumbing_handyman_carousel = $(".slider-section .owl-carousel");
  
    $plumbing_handyman_carousel.owlCarousel({
      items: 1,
      loop: true,
      autoplay: true,
      autoplayTimeout: 5000,
      nav: true,
      dots: false,
      navText : ['<i class="fas fa-arrow-left-long"></i>','<i class="fas fa-arrow-right-long"></i> '],
    });
  });
    
    /* -----------------------------------------
    Scroll Top
    ----------------------------------------- */
    var plumbing_handyman_scrollToTopBtn = $('.plumbing-handyman-scroll-to-top');

    $(window).scroll(function() {
        if ($(window).scrollTop() > 400) {
            plumbing_handyman_scrollToTopBtn.addClass('show');
        } else {
            plumbing_handyman_scrollToTopBtn.removeClass('show');
        }
    });

    plumbing_handyman_scrollToTopBtn.on('click', function(e) {
        e.preventDefault();
        $('html, body').animate({
            scrollTop: 0
        }, '300');
    }); 
    
});

document.addEventListener('DOMContentLoaded', function() {
  const header = document.querySelector('.sticky-header');
  if (header) { // Check if header exists
    window.addEventListener('scroll', function() {
      if (window.scrollY > 0) {
        header.classList.add('is-sticky');
      } else {
        header.classList.remove('is-sticky');
      }
    });
  }
});