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


    jQuery(document).on('click', '#adaptor-submit-button' ,function(e) {
			e.preventDefault();

			if((jQuery('#2pin').is(":checked") || jQuery('#3pin').is(":checked"))&&(jQuery('#need_usb1').is(":checked") || jQuery('#need_usb2').is(":checked"))) {
				jQuery(this).closest('form').submit();
			}

			if(!jQuery('#2pin').is(":checked") && !jQuery('#3pin').is(":checked")) {
				jQuery('.checkbox-item-pins .item-tooltip').addClass('active');
				setTimeout(function() {
					jQuery('.checkbox-item-pins .item-tooltip').removeClass('active');
				}, 5000);
			}

			if(!jQuery('#need_usb1').is(":checked") && !jQuery('#need_usb2').is(":checked")) {
				jQuery('.checkbox-item-usb .item-tooltip').addClass('active');
				setTimeout(function() {
					jQuery('.checkbox-item-usb .item-tooltip').removeClass('active');
				}, 5000);
			}

			
		})

		jQuery(document).on('click', '.adaptor-tabs-wrap .tab:not(.active)' ,function(e) {
			e.preventDefault();
			
			var resId = jQuery(this).data('id');
			jQuery('input[name="tab"]').attr('value', resId);
			jQuery(this).addClass('active');
			jQuery('.adaptor-tabs-wrap .tab:not([data-id="' + resId + '"])').removeClass('active');
			jQuery('.tab-content.active:not(#' + resId + ')').removeClass('active');
			jQuery('#' + resId + '.tab-content').toggleClass('active');
		});

		//jQuery('#country_from, #country_to').selectric();
		if(jQuery('#country_from').length) {
			var choices_country_from = new Choices(jQuery('#country_from')[0], {
				itemSelectText: '',
			});
		}
		if(jQuery('#country_to').length) {
			var choices_country_to = new Choices(jQuery('#country_to')[0], {
				itemSelectText: '',
			});
		}
		

		jQuery('.adaptor-item .countries-list-wrap ul li').click(function(e){
			e.preventDefault();
			var ths = jQuery(this);
			var slug = jQuery(this).data('slug');
			choices_country_from.setValueByChoice([slug]);
			if(jQuery(this).attr('data-pin') == 1) {
				jQuery('#3pin').attr('checked', true);
				jQuery('#2pin').attr('checked', false);
			} else {
				jQuery('#2pin').attr('checked', true);
				jQuery('#3pin').attr('checked', false);
			}

			setTimeout(function() {
				ths.closest('form').submit();
			}, 100)
		});	



})();
