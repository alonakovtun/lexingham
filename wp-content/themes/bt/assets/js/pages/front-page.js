// jQuery(".catalog-wrapper a").hover(
//   function () {
//     var ce = jQuery(this),
//       ce_height = ce.height(),
//       category_desc_wrapper = ce.find(".category-desc-wrapper")
//   },
//   function () {
//     var ce = jQuery(this),
//       ce_height = ce.height(),
//       category_desc_wrapper = ce.find(".category-desc-wrapper"),
//       visible_screen_height = jQuery(window.top).height();

//     if (visible_screen_height > 670) {
//       category_desc_wrapper.css("top", ce_height - 130);
//     } else if (visible_screen_height <= 670) {
//       category_desc_wrapper.css("top", ce_height - 60);
//     }
//   }
// );

if (screen.width <= 1000) {
  new Swiper(".catalog-wrapper-mobile .swiper-container", {
    speed: 300,
    loop: true,
    navigation: {
      nextEl: ".catalog-wrapper-mobile .cwmn-btn-right",
      prevEl: ".catalog-wrapper-mobile .cwmn-btn-left",
    },
  });
}

new Swiper(".home-top-slider", {
  speed: 500,
  effect: "fade",
  direction: "horizontal",
  loop: true,
  autoplay: {
    delay: 4000,
  },

  // If we need pagination
  pagination: {
    el: ".swiper-pagination",
    clickable: true,
  },
});
