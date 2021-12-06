import MobileMenu from "./modules/mobile-menu/mobile-menu.js";
import CampusSlider from "./modules/slider/campus-slider.js";

new MobileMenu({
    buttonSelector: '#menu-btn-mobile',
    navigationSelector: '#navigation-menu'
})

new CampusSlider('.campus-slider', {
    navigation: true,
    loop: true,
    slidesPerView: 3,
    breakpoints: {
        360: {
            slidesPerView: 1
        },
        '480': {
            slidesPerView: 2,
            navigation: false
        },
        768: {
            slidesPerView: 3,
            navigation: true
        }
    }
})