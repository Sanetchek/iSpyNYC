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
                nextSlide: '.next-slide',
                animation: 'slide-in' //slide-in, fade-in

            }, options);
            return this.each(function () {
                // variables
                var slider = $(this);
                sliderHeight();

                var slide = slider.find(options.slideClass);
                var countSlides = slide.length;

                var lastSlideIndex = countSlides - 1;
                var prevSlideBtn = slider.find(options.prevSlide);
                var nextSlideBtn = slider.find(options.nextSlide);
                
                var video = slide.find('video');

                // Check if SlideIndex is undefined
                var slideIndex = slider.find('.active').index();
                if (slideIndex < 0) {
                    slideIndex = 0;
                } else {
                    slideIndex = slider.find('.active').index();
                }

                // Activate first slide
                var currentSlide = slide[slideIndex];
                currentSlide.classList.add('active', options.animation);

                // Check if slides more than 1
                if( countSlides > 1 ) {
                    prevNextSlide();
                } else {
                    currentSlideVideo();
                    hidePrevNextSlideBtn();
                }

                function hidePrevNextSlideBtn() {
                    prevSlideBtn.hide();
                    nextSlideBtn.hide();
                }

                function prevNextSlide() {
                   var firstSlide, lastSlide, defaultSlide;
                    
                    
                    prevSlideBtn.on('click', function () {
                        slideTo ( firstSlide = lastSlideIndex, lastSlide = lastSlideIndex - 1, defaultSlide = slideIndex - 1 );                             
                        currentSlideVideo();
                    });

                    nextSlideBtn.on('click', function () {
                        slideTo ( firstSlide = slideIndex + 1, lastSlide = 0, defaultSlide = slideIndex + 1 );
                        currentSlideVideo();
                    });
                }

                function slideTo ( firstSlide, lastSlide, defaultSlide ){
                    currentSlide.classList.remove('active', options.animation);
                    switch (slideIndex) {
                        case 0:
                            currentSlide = slide[firstSlide];
                            break;
                        case lastSlideIndex:
                            currentSlide = slide[lastSlide];
                            break;
                        default:
                            currentSlide = slide[defaultSlide];
                    }
                    currentSlide.classList.add('active', options.animation);
                    slideIndex = slider.find('.active').index();
                }

                function currentSlideVideo() {
                    var currentSlideVideo = currentSlide.querySelectorAll('video').length;
                    
                    if ( currentSlideVideo > 0 ) {
                        playVideo();
                        videoPlayPause();
                        centeredContent( video, slider );
                    } else {
                        pauseVideo();
                    }
                }

                function videoPlayPause() {
                    video.on('click', function(){
                        if(video[0].paused) {
                            playVideo();
                        } else {
                            pauseVideo();
                        }
                    });
                }

                function playVideo() {
                    video[0].play();
                }

                function pauseVideo() {
                    video[0].pause();
                }

                function centeredContent( block, wrapper ) {
                    $(window).resize( function(){
                        resizeCenterStyle();
                    });
                    resizeCenterStyle();

                    function resizeCenterStyle() {
                        block.css({
                            position: 'absolute',
                            left: (wrapper.width() - block.outerWidth())/2,
                            top: (wrapper.height() - block.outerHeight())/2
                        });
                    }
                    
                }

                function sliderHeight() {
                    $(window).resize( function(){
                        console.log(windowWidth());
                        if( windowWidth() >= 1021 ) {
                            slider.css( 'height', (windowHeight() * 0.9) + 'px' );
                        } else if( windowWidth() >= 480 ) {
                            slider.css( 'height', (windowHeight() * 0.5) + 'px' );
                        } else {
                            slider.css( 'height', (windowHeight() * 0.35) + 'px' );
                        }
                    });

                    if( windowWidth() >= 1021 ) {
                        slider.css( 'height', (windowHeight() * 0.9) + 'px' );
                    }
                }


                function windowWidth() { return $(window).width() }
                function windowHeight() { return $(window).height() }
            });
        };
    })(jQuery);
}