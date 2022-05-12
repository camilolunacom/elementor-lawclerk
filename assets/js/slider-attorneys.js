"use strict";

class SliderAttorneysHandlerClass extends elementorModules.frontend.handlers.Base {
  getDefaultSettings() {
    return {
      selectors: {
        slider: '.swiper.attorneys',
        wrapper: '.attorneys__wrapper'
      }
    };
  }

  getDefaultElements() {
    const selectors = this.getSettings('selectors');
    const elements = {
      $slider: this.$element.find(selectors.slider)
    };
    elements.$wrapper = elements.$slider.find(selectors.wrapper);
    return elements;
  }

  async onInit() {
    elementorModules.frontend.handlers.Base.prototype.onInit.apply(this, arguments);
    const {
      $slider
    } = this.elements;
    const {
      $wrapper
    } = this.elements;

    if (!$wrapper.length) {
      return;
    }

    this.settings = {
      direction: 'vertical',
      centeredSlides: true,
      slidesPerView: 1,
      autoplay: {
        delay: 4000,
        disableOnInteraction: false
      },
      navigation: {
        nextEl: '.attorneys__button--next',
        prevEl: '.attorneys__button--prev'
      },
      breakpoints: {
        1025: {
          slidesPerView: 3
        }
      }
    };
    const Swiper = elementorFrontend.utils.swiper;
    this.swiper = await new Swiper($slider, this.settings); // Expose the swiper instance in the frontend
  }

}

jQuery(window).on('elementor/frontend/init', () => {
  const addHandler = $element => {
    elementorFrontend.elementsHandler.addHandler(SliderAttorneysHandlerClass, {
      $element
    });
  };

  elementorFrontend.hooks.addAction('frontend/element_ready/slider_attorneys.default', addHandler);
});