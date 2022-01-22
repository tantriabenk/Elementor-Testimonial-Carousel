class ETCCarouselElementorHandler extends elementorModules.frontend.handlers.Base {
	
    getDefaultSettings() {
        return {
            selectors: {
                wrapper: '.etc-slides__container',
                prev: '.etc-arrow__prev',
                next: '.etc-arrow__next',
            },
        };
    }

    getDefaultElements() {
        const selectors = ( this.getSettings('selectors') );

        return {
            $wrapper: this.$element.find(selectors.wrapper),
            $prev: this.$element.find(selectors.prev),
            $next: this.$element.find(selectors.next),
        };
    }

    bindEvents() {
        var setting = this.elements.$wrapper.data("settings");
        var dots = ( setting.dots == "yes" ) ? true : false; 
        var arrows = ( setting.arrows == "yes" ) ? true : false; 
        var autoplay = ( setting.autoplay == "yes" ) ? true : false;
        var autoplaySpeed = Number(setting.autoplay_speed);
        var infinite_loop = ( setting.infinite_loop == "yes" ) ? true : false;
        var pause_on_hover = ( setting.pause_on_hover == "yes" ) ? true : false;

        this.elements.$wrapper.slick({
			variableWidth: false,
			slidesToShow: Number(setting.slides_to_show),
			slidesToScroll: Number(setting.slides_to_scroll),
			autoplay: autoplay,
			centerMode: false,
			focusOnSelect: true,
			autoplaySpeed: autoplaySpeed,
			arrows: arrows,
            pauseOnHover: pause_on_hover,
			dots: dots,
			infinite: infinite_loop,
            prevArrow: this.elements.$prev,
            nextArrow: this.elements.$next,
        });
    }
	
}

jQuery(window).on('elementor/frontend/init', () => {
    const addHandler = ($element) => {
        elementorFrontend.elementsHandler.addHandler(ETCCarouselElementorHandler, {
            $element,
        });
    };

    elementorFrontend.hooks.addAction('frontend/element_ready/testimonial_carousel.default', addHandler);
})