import { ready } from "./utils";

(function () {
  ready(() => {
    jQuery(".wpml-ls-statics-footer").prependTo(".copyright-wrapper-right");

    var prevScrollpos = window.pageYOffset;
    var heightHeader = jQuery(".main-site-header").css("height");

    window.onscroll = function () {
        var currentScrollPos = window.pageYOffset;

        if (currentScrollPos > 120) {
            if (prevScrollpos > currentScrollPos) {
                jQuery(".main-site-header").css("top", "0");
            } else {
                jQuery(".main-site-header").css("top", "-" + heightHeader);
                jQuery(".archive .main-site-header, .page-template-page-magazine .main-site-header").css("top", "-" + ( heightHeader + 62));

            }
        }

        prevScrollpos = currentScrollPos;
    }
  });


  window.addEventListener("scroll", function (e) {
        var homePageHeight = jQuery('.site-light-gray-bg').height();
        var pageHeight = jQuery('#page').height();

        var difference = pageHeight - homePageHeight;
        jQuery(window).on('scroll', function() {
            var currentScroll = jQuery(window).scrollTop();
            if (currentScroll > (homePageHeight - difference - 50 )) {
              jQuery('.filters-wrapper').css({
                position: 'absolute'
            });
        } else {
            jQuery('.filters-wrapper').css({
                position: 'fixed'
            });
            }
        });
       
        },
        { passive: true }
    );

})();
