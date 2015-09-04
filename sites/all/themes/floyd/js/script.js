/*----------------------------- Navigation --------------------------*/
jQuery(window).on('scroll', function (){
    "use strict";

    // main menu
    if (jQuery(document).scrollTop() >= 500) {
      jQuery('.navbar').addClass('navbar-fixed-top');
      jQuery('html').addClass('has-fixed-nav');
    } else {
      jQuery('.navbar').removeClass('navbar-fixed-top');
      jQuery('html').removeClass('has-fixed-nav');
    }

    // Single page Nav
    if (jQuery(this).scrollTop() > 400) {
        jQuery('.post-navigation').fadeIn('slow');
      } else {
        jQuery('.post-navigation').fadeOut('slow');
      }
});





(function($) {
  "use strict";
  jQuery(document).ready(function() {       
    // video background
    if (jQuery('.player').length > 0) {
      jQuery(".player").mb_YTPlayer();   
      jQuery('#bgndVideo').on("YTPStart",function(e){
        jQuery('#home').css("background-image", "none");      
      });
    }    

    if (!jQuery('.page-node-72').hasClass('front')) {
      jQuery('.page-node-72').removeClass('not-front');
      jQuery('.page-node-72').addClass('front');
    }

    if (!jQuery('.page-node-73').hasClass('front')) {
      jQuery('.page-node-73').removeClass('not-front');
      jQuery('.page-node-73').addClass('front');
    }

    /*---------------------- Current Menu Item -------------------------*/
    if (jQuery('body').hasClass('front')) {
      if (window.location.hash == "") {
        jQuery('ul li.first').addClass('current');
      }
      jQuery('#nav.navbar-nav').onePageNav({
        currentClass: 'current',
        changeHash: false,
        scrollSpeed: 750,
        scrollThreshold: 0.5,
        scrollOffset: 160,
        filter: '#nav li a[href*="/#"]',
        easing: 'swing'
      });
    }        

   /*----------- Scroll to Feature Section ----------*/ 
    jQuery('.view-intro-slideshow .view-footer a').click(function(e) {
      e.preventDefault();
      jQuery('html,body').animate({scrollTop:jQuery('#about').offset().top - 150}, 1000);
    });    

    /*------------------- Parallax ------------------*/
    jQuery(window).load(function(){
      jQuery("#numbers").parallax("50%", 0.2); 
      jQuery("#testimonials").parallax("50%", 0.2);     
    });   

    /*-------------------  Counter -----------------*/
    jQuery('.counter .value').counterUp({
      delay: 10,
      time: 1000
    });


    /*-----------  Boxer Video and image Gallery  --------*/
        jQuery(".boxer").boxer(); 
  });  

})(jQuery);



/*-------------------------- Portfolio Item Filter -----------------------*/
(function ($) {
  "use strict";
  jQuery(document).ready(function() {    
    var winDow = jQuery(window);
    // Needed variables
    var $container=jQuery('#isotope-container');
    var $filter=jQuery('#filters');

    try{
      $container.imagesLoaded( function(){
        $container.trigger('resize');
        $container.isotope({
          filter:'*',
          layoutMode:'masonry',
          animationOptions:{
            duration:750,
            easing:'linear'
          }
        });
      });
    } catch(err) {
    }

    //Portfolio project slider
    function initProjectSlider() {
       $(".owlcarousel-fields-37").owlCarousel({
 
          navigation : true, // Show next and prev buttons
          slideSpeed : 300,
          paginationSpeed : 400,
          singleItem:true
     
          // "singleItem:true" is a shortcut for:
          // items : 1, 
          // itemsDesktop : false,
          // itemsDesktopSmall : false,
          // itemsTablet: false,
          // itemsMobile : false
     
      });
    };

    //Portfolio Project Loading
    jQuery('.project-overlay').click(function(){         
      var projectUrl = jQuery(this).find('.open-project').attr("href");            
      jQuery('#project-content').animate({opacity:0}, 400,function(){
        jQuery("#project-content").load(projectUrl, function() {
          if (jQuery('.owlcarousel-fields-37').length > 0) {
            initProjectSlider();
          } 
        });                   
        jQuery('#project-content').delay(400).animate({opacity:1}, 400);
      });  
      
      //Project Page Open
      jQuery('#project-extended').slideUp(600, function(){
        jQuery('#project-extended').addClass('open');
        jQuery('html, body').animate({ scrollTop: jQuery(".portfolio-bottom").offset().top }, 900);
      }).delay(500).slideDown(600,function(){          
          jQuery('#project-content').fadeIn('slow')
      });

      return false;       
    
    });
   
    //Project Page Close
    jQuery('#close-project').click(function(event) {
      jQuery('#project-content').animate({opacity:0}, 400,function(){
        jQuery('#project-extended').delay(400).slideUp(400).removeClass('open');
        jQuery('html, body').animate({ scrollTop: jQuery("#portfolio").offset().top -60}, 900);
      });
      return false;
    });

    winDow.bind('resize', function(){
      var selector = $filter.find('a.selected').attr('data-filter');

      try {
        jQuery("#numbers").parallax("50%", 0.2);        
        jQuery("#testimonials").parallax("50%", 0.2);
        
        $container.isotope({ 
          filter  : selector,
          animationOptions: {
            duration: 750,
            easing  : 'linear',
            queue : false,
          }
        });
      } catch(err) {
      }
      return false;
    });
  });  
 
}(jQuery)
);




/*------------------------------ SmoothScroll (for Mouse Wheel) v1.2.1 ----------------------*/
(function ($) {
  var defaultOptions = {
    frameRate: 150,
    animationTime: 1200,
    stepSize: 120,
    pulseAlgorithm: !0,
    pulseScale: 8,
    pulseNormalize: 1,
    accelerationDelta: 20,
    accelerationMax: 1
  }, options = defaultOptions,
  direction = {
    x: 0,
    y: 0
  }, root = 0 <= document.compatMode.indexOf("CSS") || !document.body ? document.documentElement : document.body,
  que = [],
  pending = !1,
  lastScroll = +new Date;

  function scrollArray(a, b, c, d) {
    d || (d = 1E3);
    directionCheck(b, c);
    if (1 != options.accelerationMax) {
      var e = +new Date - lastScroll;
      e < options.accelerationDelta && (e = (1 + 30 / e) / 2, 1 < e && (e = Math.min(e, options.accelerationMax), b *= e, c *= e));
      lastScroll = +new Date
    }
    que.push({
      x: b,
      y: c,
      lastX: 0 > b ? 0.99 : -0.99,
      lastY: 0 > c ? 0.99 : -0.99,
      start: +new Date
    });
    if (!pending) {
      var q = a === document.body,
      p = function (e) {
        e = +new Date;
        for (var h = 0, k = 0, l = 0; l < que.length; l++) {
          var f = que[l],
          m = e - f.start,
          n = m >= options.animationTime,
          g = n ? 1 : m / options.animationTime;
          options.pulseAlgorithm && (g = pulse(g));
          m = f.x * g - f.lastX >> 0;
          g = f.y * g - f.lastY >> 0;
          h += m;
          k += g;
          f.lastX += m;
          f.lastY += g;
          n && (que.splice(l, 1), l--)
        }
        q ? window.scrollBy(h, k) : (h && (a.scrollLeft += h), k && (a.scrollTop += k));
        b || c || (que = []);
        que.length ? requestFrame(p, a, d / options.frameRate + 1) : pending = !1
      };
      requestFrame(p, a, 0);
      pending = !0
    }
  }

  function wheel(a) {
    var b = overflowingAncestor(a.target);
    if (!b || a.defaultPrevented) return !0;
    var c = a.wheelDeltaX || 0,
    d = a.wheelDeltaY || 0;
    c || d || (d = a.wheelDelta || 0);
    1.2 < Math.abs(c) && (c *= options.stepSize / 120);
    1.2 < Math.abs(d) && (d *= options.stepSize / 120);
    scrollArray(b, -c, -d);
    a.preventDefault()
  }
  var cache = {};
  setInterval(function () {
    cache = {}
  }, 1E4);
  var uniqueID = function () {
    var a = 0;
    return function (b) {
      return b.uniqueID || (b.uniqueID = a++)
    }
  }();

  function setCache(a, b) {
    for (var c = a.length; c--;) cache[uniqueID(a[c])] = b;
      return b
  }

  function overflowingAncestor(a) {
    var b = [],
    c = root.scrollHeight;
    do {
      var d = cache[uniqueID(a)];
      if (d) return setCache(b, d);
      b.push(a);
      if (c === a.scrollHeight) {
        if (root.clientHeight + 10 < c) return setCache(b, document.body)
      } else if (a.clientHeight + 10 < a.scrollHeight && (overflow = getComputedStyle(a, "").getPropertyValue("overflow-y"), "scroll" === overflow || "auto" === overflow)) return setCache(b, a)
  } while (a = a.parentNode)
}

function directionCheck(a, b) {
  a = 0 < a ? 1 : -1;
  b = 0 < b ? 1 : -1;
  if (direction.x !== a || direction.y !== b) direction.x = a, direction.y = b, que = [], lastScroll = 0
}
var requestFrame = function () {
  return window.requestAnimationFrame || window.webkitRequestAnimationFrame || function (a, b, c) {
    window.setTimeout(a, c || 1E3 / 60)
  }
}();

function pulse_(a) {
  var b;
  a *= options.pulseScale;
  1 > a ? b = a - (1 - Math.exp(-a)) : (b = Math.exp(-1), a = 1 - Math.exp(-(a - 1)), b += a * (1 - b));
  return b * options.pulseNormalize
}

function pulse(a) {
  if (1 <= a) return 1;
  if (0 >= a) return 0;
  1 == options.pulseNormalize && (options.pulseNormalize /= pulse_(1));
  return pulse_(a)
}
window.addEventListener("mousewheel", wheel, !1);
})(jQuery);