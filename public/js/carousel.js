var swiper = new Swiper(".progress-slide-carousel", {
  loop: true,
  fraction: true,
  autoplay: {
    delay: 1800,
    disableOnInteraction: false,
  },
  pagination: {
    el: ".progress-slide-carousel .swiper-pagination",
    type: "progressbar",
  },
  });