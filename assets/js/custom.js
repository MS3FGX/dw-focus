jQuery(function($) {
    // Accordion
    $('.accordion').on('show', function (e) {
    $(e.target).prev('.accordion-heading').find('.accordion-toggle').addClass('active');
    });
    $('.accordion').on('hide', function (e) {
    $(this).find('.accordion-toggle').not($(e.target)).removeClass('active');
    }); 

    //Slide init
    $('.carousel').on('slid',function(e){
        var t = $(this);
        var index = t.find('.item.active').index(),
            navs = [ t.closest('.news-slider').find('.carousel-nav ul'),
                      t.find('.carousel-nav ul') ];

        for( var key in navs ){
          if( navs[key].length > 0 ){
              navs[key].find('li').each(function(){
                  $(this).removeClass('active');
              });
              navs[key].find('li').eq(index).addClass('active');
          }
        }

        if( t.closest('.news-slider').length > 0 ) {
            var slider = t.closest('.news-slider');
            slider.find('.other-entry li').each(function(){
                $(this).removeClass('active');
            });
            slider.find('.other-entry li').eq(index).addClass('active');
        }
    });
    // Slide controls
    $('.news-slider .other-entry li').on('click',function(e){
        e.preventDefault();
        var t = $(this);
        t.closest('.news-slider').find('.carousel').carousel( t.find('a').data('slice') );
    });
    

    //Init carousel control nav
    $('.carousel').each(function(){
        var t = $(this),
            nav = [ t.find('.carousel-nav ul'),
                    t.closest('.news-slider').find('.carousel-nav ul') ];

        for( var key in nav ){
          if( nav[key].length > 0 ) {
            t.find('.carousel-inner .item').each(function(i,j){
                var clss = (i==0)?'active':'';
                nav[key].append('<li class="'+clss+'"><a href="#'+i+'">'+i+'</a></li> ');
            });
          }
        }
    });

    //Bind event for carousel nav control
    $('.carousel').each(function(){
        var t = $(this),
            nav = [ t, t.closest('.news-slider') ];
        for( var key in nav ) {
            if( nav[key].length > 0 ) {
                nav[key].find('.carousel-nav ul').delegate('li','click',function(e){
                    e.preventDefault();
                    var idx = t.find('.carousel-nav ul li').index($(this));
                    t.carousel(idx);
                });
            }
            nav[key].find('.carousel-nav ul').delegate('li','click',function(e){
                e.preventDefault();
                var idx = nav[key].find('.carousel-nav ul li').index($(this));
                t.carousel(idx);
            });
        }
        
    });


    //Init twitter boostrap tabs
    //With ul list
    $('.news-tab .nav-tabs a').click(function (e) {
        e.preventDefault();
        $(this).tab('show');
    });
    //With select box
    $('.nav-tabs-by-select').change(function (e) {
        e.preventDefault();
        var target =  $(this).val();
        $('.news-tab .nav-tabs a[href="'+target+'"]').tab('show');
    });

    $('#primary .content-inner').infinitescroll({
      loading: {
        finished: undefined,
        finishedMsg: "",
        msgText: "",
        speed: 0,
        img: 'http://i.imgur.com/qWbgI.gif'
      },
      navSelector  : "div.navigation-inner",            
      nextSelector : "div.navigation-inner a",    
      itemSelector : "#primary .content-inner .hentry",
      donetext : "test",
      errorCallback: function(){
        $('div.navigation-inner').addClass('end');
        $('div.navigation a').addClass('disabled').text('No More News');
      }
    }, function(newElements, data, url){
      $('div.navigation-inner').css( 'display', 'block');
      var i = $(this).find('.post').length;
      i -= newElements.length - 1;
      for( var key in newElements ) {
        $( newElements[key] ).removeClass('first');
        if( i % 3 == 0 ) {
          $( newElements[key] ).addClass('first');
        }
        i++;
      }

    });
    $(window).unbind('.infscr');
    $('div.navigation-inner a').click(function(){
      $('#primary .content-inner').infinitescroll('retrieve');
      return false;
    });


    // Scroll to top button
     var scrollTimeout;
    
    $('a.scroll-top').click(function(){
        $('html,body').animate({scrollTop:0},500);
        return false;
    });

    $(window).scroll(function(){
        clearTimeout(scrollTimeout);
        if($(window).scrollTop()>400){
            scrollTimeout = setTimeout(function(){$('a.scroll-top:hidden').fadeIn()},100);
        }
        else{
            scrollTimeout = setTimeout(function(){$('a.scroll-top:visible').fadeOut()},100);    
    }
    });

    // Set cookie 
    function setCookie(c_name,value,exdays) {
        var exdate=new Date();
        exdate.setDate(exdate.getDate() + exdays);
        var c_value=escape(value) + ((exdays==null) ? "" : "; expires="+exdate.toUTCString());
        document.cookie=c_name + "=" + c_value;
    }

    // Get cookie
    function getCookie(c_name) {
        var i,x,y,ARRcookies=document.cookie.split(";");
        for (i=0;i<ARRcookies.length;i++) {
            x=ARRcookies[i].substr(0,ARRcookies[i].indexOf("="));
            y=ARRcookies[i].substr(ARRcookies[i].indexOf("=")+1);
            x=x.replace(/^\s+|\s+$/g,"");
            if (x==c_name) {
                return unescape(y);
            }
        }
    }

    $('.post-layout a').click(function(e){
        e.preventDefault();
        if($(this).hasClass('active')) return
        $this = $(this);
        var layout = $this.attr('class');
        setCookie("cat_listing",$.trim(layout.split('-')[1]),365);
            $('.content-inner').fadeOut(function(){
                $('.content-inner').attr('class','content-inner').addClass($this.attr("class")).fadeIn();
            });
        $('.post-layout a').removeClass('active');
        $(this).addClass('active');
    });

     $('.footer-toggle').click(function(e){
        e.preventDefault();
        var footer_toggle = getCookie('footer_toggle');
        if( footer_toggle == null || footer_toggle != 'collapsed' ) {
            setCookie('footer_toggle','collapsed');
        } else {
            setCookie('footer_toggle','expanded');
        }
        $(this).toggleClass('collapsed');
        $('#sidebar-footer').stop().slideToggle();

     });

    // Headlines flash
    var headline_count;
    var headline_interval;
    var old_headline = 0;
    var current_headline = 0;

    headline_count = $(".headlines li").size();

    current_headline = headline_count;
    var timmer = $('.headlines').data('interval');
    
    if(timmer){
          headline_interval = setInterval(headline_rotate,timmer); //time in milliseconds
          $('.headlines').hover(function() {
            clearInterval(headline_interval);
          }, function() {
            headline_interval = setInterval(headline_rotate,timmer); //time in milliseconds
            headline_rotate();
          });
    }

    function headline_rotate() {
        current_headline--;

        if(current_headline == 0 ){
            $(".headlines li:first").animate({marginTop:"0px"},"slow");
            current_headline = headline_count;
            return false;
        }

       $(".headlines li:first").animate({marginTop:((current_headline-headline_count)*20)+"px"},"slow");
       
     }
     

     var change_category_tab = function(obj,catid){
         var widget = obj.closest('.news-category');
         widget.find('.tab_title').removeClass('active');
         obj.addClass('active');

         widget.find('.row-fluid.active').hide().removeClass('active').end()
           .find('.cat-'+catid).fadeIn('slow').addClass('active');
     }
    /**
    * Categories widget tabs
    */
    $('.news-category a.tab_title').click(function(e){
        if($(this).hasClass('active')) return;
        e.preventDefault();
        var catid= $(this).data('catid');
        change_category_tab( $(this),catid );
    });
    // Categories widget tabs in mobile devices
    $('.child-category-select').on('change',function(e){
        var catid = $(this).val();
        change_category_tab( $(this),catid );
    });

    // Mega menu scriptd
    $('.nav .sub-menu > li').hover(function(){
        var menuid= this.id.split('-')[2];
        var mparent = $(this).closest('.sub-mega-wrap')
        mparent.find('.sub-menu > li').removeClass('active');
        $(this).addClass('active');
        mparent.find('.subcat > div').removeClass('active');
        mparent.find('#mn-latest-'+menuid).addClass('active');
    });

    $('.nav .sub-menu-collapse').on('click',function(event){
        var submenu = $(this).closest('li').find('.sub-mega-wrap');

        if( submenu.length <= 0 ) {
            submenu = $(this).closest('li').find('.sub-menu');
        }
        submenu.toggleClass('active');

    });

    $(document).ready(function($) {
        // Check cookie for footer collapse and auto hide footer 
        var footer_toggle = getCookie('footer_toggle');
        if( footer_toggle != null && footer_toggle == 'collapsed' ) {
            $('#sidebar-footer').stop().hide();
        }

        // Slide gallery on handheld device
        $('.carousel .item').each(function(){
            disableDraggingFor( this );
        });
        $('.carousel').on('swipeleft',function(event){
            var t = $(this);
            $(this).carousel('next');
        });
        $('.carousel').on('swiperight',function(event){
            var t = $(this);
            $(this).carousel('prev');
        });//End swipe 

        if( 'ontouchstart' in document.documentElement ) {
          var clickable = null;
          $('.nav .menu-item').each(function(){
            var $this = $(this);

            if( $this.find('ul.sub-menu').length > 0 ) {
              $this.find('a:first').unbind('click').bind('touchstart',function(event){
                if( clickable != this ) {
                    clickable = this;
                    event.preventDefault();
                    var submenu = $this.find('.sub-mega-wrap');

                    if( submenu.length <= 0 ) {
                        submenu = $this.find('.sub-menu');
                    }
                    submenu.toggleClass('active');
                  return false;
                } else {
                    clickable = null;
                }
              });
            }
          });
        }

        //Submenu auto align
        $('.nav .menu-item').on('hover',function(event){
            var t = $(this),
                submenu = t.find('.sub-mega-wrap');
            if( submenu.length > 0 ) {
                var offset = submenu.offset(),
                    w = submenu.width();
                if( offset.left + w > $(window).width() ) {
                    t.addClass('sub-menu-left');
                } else {
                    t.removeClass('sub-menu-left');
                }
            }
        });// End submenu auto align

        function disableDraggingFor(element) {
          // this works for FireFox and WebKit in future according to http://help.dottoro.com/lhqsqbtn.php
          element.draggable = false;
          // this works for older web layout engines
          element.onmousedown = function(event) {
            event.preventDefault();
            return false;
          };
        }

    });
});

(function($) {

    /**
     * Spoofs placeholders in browsers that don't support them (eg Firefox 3)
     * 
     * Copyright 2011 Dan Bentley
     * Licensed under the Apache License 2.0
     *
     * Author: Dan Bentley [github.com/danbentley]
     */

    // Return if native support is available.
    if ("placeholder" in document.createElement("input")) return;

    $(document).ready(function(){
        $(':input[placeholder]').not(':password').each(function() {
            setupPlaceholder($(this));
        });

        $(':password[placeholder]').each(function() {
            setupPasswords($(this));
        });
       
        $('form').submit(function(e) {
            clearPlaceholdersBeforeSubmit($(this));
        });
    });

    function setupPlaceholder(input) {

        var placeholderText = input.attr('placeholder');

        setPlaceholderOrFlagChanged(input, placeholderText);
        input.focus(function(e) {
            if (input.data('changed') === true) return;
            if (input.val() === placeholderText) input.val('');
        }).blur(function(e) {
            if (input.val() === '') input.val(placeholderText); 
        }).change(function(e) {
            input.data('changed', input.val() !== '');
        });
    }

    function setPlaceholderOrFlagChanged(input, text) {
        (input.val() === '') ? input.val(text) : input.data('changed', true);
    }

    function setupPasswords(input) {
        var passwordPlaceholder = createPasswordPlaceholder(input);
        input.after(passwordPlaceholder);

        (input.val() === '') ? input.hide() : passwordPlaceholder.hide();

        $(input).blur(function(e) {
            if (input.val() !== '') return;
            input.hide();
            passwordPlaceholder.show();
        });
            
        $(passwordPlaceholder).focus(function(e) {
            input.show().focus();
            passwordPlaceholder.hide();
        });
    }

    function createPasswordPlaceholder(input) {
        return $('<input>').attr({
            placeholder: input.attr('placeholder'),
            value: input.attr('placeholder'),
            id: input.attr('id'),
            readonly: true
        }).addClass(input.attr('class'));
    }

    function clearPlaceholdersBeforeSubmit(form) {
        form.find(':input[placeholder]').each(function() {
            if ($(this).data('changed') === true) return;
            if ($(this).val() === $(this).attr('placeholder')) $(this).val('');
        });
    }
})(jQuery);
