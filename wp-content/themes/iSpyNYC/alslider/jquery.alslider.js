/*
 =====================================================
 Slider
 =====================================================
 */

(function ($) {
    var scripts = document.getElementsByTagName("script");
    var jsFolder = "";
    for (var i = 0; i < scripts.length; i++)
        if (scripts[i].src && scripts[i].src.match(/jquery.alslider\.js/i))jsFolder = scripts[i].src.substr(0, scripts[i].src.lastIndexOf("/") + 1);

    var loadjQuery = false;
    if (typeof jQuery == "undefined")loadjQuery = true; else {
        var jVersion = jQuery.fn.jquery.split(".");
        if (jVersion[0] < 1 || jVersion[0] == 1 && jVersion[1] < 6)loadjQuery = true
    }
    if (loadjQuery) {
        var head = document.getElementsByTagName("head")[0];
        var script = document.createElement("script");
        script.setAttribute("type", "text/javascript");
        if (script.readyState)script.onreadystatechange = function () {
            if (script.readyState == "loaded" || script.readyState == "complete") {
                script.onreadystatechange = null;
                loadAlSlider(jsFolder)
            }
        }; else script.onload = function () {
            loadAlSlider(jsFolder)
        };
        script.setAttribute("src", jsFolder + "jquery.js");
        head.appendChild(script)
    } else loadAlSlider(jsFolder)
})(jQuery);
function loadAlSlider(jsFolder) {
    (function ($) {
        $.fn.alSlider = function (options) {
            options = $.extend({

                slideClass: '.slide',
                prevSlide: '.prev-slide',
                nextSlide: '.next-slide'

            }, options);
            return this.each(function () {
                // variables
                var slider = $(this);
                var slide = slider.find(options.slideClass);
                var countSlides = slide.length;

                var lastSlideIndex = countSlides - 1;
                var prevSlideBtn = slider.find(options.prevSlide);
                var nextSlideBtn = slider.find(options.nextSlide);

                var slideIndex = slider.find('.active').index();
                if (slideIndex < 0) {
                    slideIndex = 0;
                } else {
                    slideIndex = slider.find('.active').index();
                }

                var currentSlide = slide[slideIndex];
                currentSlide.classList.add('active');

                if( countSlides > 1 ) {
                    prevNextSlide();
                } else {
                    prevSlideBtn.hide();
                    nextSlideBtn.hide();
                }


                function prevNextSlide() {
                    prevSlideBtn.on('click', function () {
                        currentSlide.classList.remove('active');

                        switch (slideIndex) {
                            case 0:
                                currentSlide = slide[lastSlideIndex];
                                break;
                            case lastSlideIndex:
                                currentSlide = slide[lastSlideIndex - 1];
                                break;
                            default:
                                currentSlide = slide[slideIndex - 1];
                        }

                        currentSlide.classList.add('active');
                        slideIndex = slider.find('.active').index();
                    });

                    nextSlideBtn.on('click', function () {
                        currentSlide.classList.remove('active');
                        switch (slideIndex) {
                            case 0:
                                currentSlide = slide[slideIndex + 1];
                                break;
                            case lastSlideIndex:
                                currentSlide = slide[0];
                                break;
                            default:
                                currentSlide = slide[slideIndex + 1];
                        }

                        currentSlide.classList.add('active');
                        slideIndex = slider.find('.active').index();
                    });
                }
            });
        };
    })(jQuery);
}