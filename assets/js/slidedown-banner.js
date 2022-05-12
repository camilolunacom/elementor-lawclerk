"use strict";

class SlidedownBannerHandlerClass extends elementorModules.frontend.handlers.Base {
  getDefaultSettings() {
    return {
      selectors: {
        close: '.banner__close'
      }
    };
  }

  getDefaultElements() {
    const selectors = this.getSettings('selectors');
    return {
      $close: this.$element.find(selectors.close)
    };
  }

  onInit() {
    elementorModules.frontend.handlers.Base.prototype.onInit.apply(this, arguments);
    this.bannerTimeout = setTimeout(() => jQuery(this.$element).slideDown('slow', () => clearTimeout(this.bannerTimeout)), 5000);
  }

  bindEvents() {
    this.elements.$close.on('click', this.closeBanner.bind(this));
  }

  closeBanner(event) {
    jQuery(this.$element).slideUp('slow');
  }

}

jQuery(window).on('elementor/frontend/init', () => {
  const addHandler = $element => {
    elementorFrontend.elementsHandler.addHandler(SlidedownBannerHandlerClass, {
      $element
    });
  };

  elementorFrontend.hooks.addAction('frontend/element_ready/slidedown_banner.default', addHandler);
});