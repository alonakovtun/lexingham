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
            }
        }

        prevScrollpos = currentScrollPos;
    }
  });
})();
