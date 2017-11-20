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
                animation: 'slide-in', //slide-in, fade-in
                videoControls: true

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

                // Video
                var videoContainer = slide.find('video');
                videoContainer.wrap('<div class="video-wrapper"></div>');
                var videoWrap = slide.find( '.video-wrapper' );
                var firstVideo = videoWrap.find('video').get(0);
                if (options.videoControls) {
                   firstVideo.removeAttribute("controls");
                }

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
                        $(window).resize( function() {
                            setTimeout(function () {
                                centeredContent(videoWrap, slide);
                            }, 600);
                        });
                        setTimeout(function () {
                            centeredContent(videoWrap, slide);
                        }, 600);
                        playVideo();
                        videoPlayPause();
                    } else {
                        pauseVideo();
                    }
                }

                function videoPlayPause() {
                    videoContainer.on('click', function(){
                        playPauseClassToggle();
                        if(firstVideo.paused) {
                            playVideo();
                        } else {
                            pauseVideo();
                        }
                    });
                }

                function playVideo() {
                    firstVideo.play();
                }

                function pauseVideo() {
                    firstVideo.pause();
                }

                function centeredContent( block, wrapper ) {
                    $(window).resize( function(){
                        if( windowWidth() >= 1021 ) {
                            block.css({
                                position: 'absolute',
                                left: (wrapper.width() - block.outerWidth())/2,
                                top: (wrapper.height() - block.outerHeight())/2,
                                height: 'auto',
                                maxHeight: '100%',
                                width: '100%'
                            });
                        }  else {
                            block.css({
                                position: 'absolute',
                                left: (wrapper.width() - block.outerWidth())/2,
                                top: '0',
                                height: '100%',
                                maxHeight: '100%',
                                width: '100%'
                            });
                        }
                    });

                    if( windowWidth() >= 1021 ) {
                        block.css({
                            position: 'absolute',
                            left: (wrapper.width() - block.outerWidth())/2,
                            top: (wrapper.height() - block.outerHeight())/2,
                            height: 'auto',
                            maxHeight: '100%',
                            width: '100%'
                        });
                    }  else {
                        block.css({
                            position: 'absolute',
                            left: (wrapper.width() - block.outerWidth())/2,
                            top: '0',
                            height: '100%',
                            maxHeight: '100%',
                            width: '100%'
                        });
                    }
                }

                function sliderHeight() {
                    $(window).resize( function(){
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
                    } else if( windowWidth() >= 480 ) {
                        slider.css( 'height', (windowHeight() * 0.5) + 'px' );
                    } else {
                        slider.css( 'height', (windowHeight() * 0.35) + 'px' );
                    }
                }

                function windowWidth() { return $(window).width() }
                function windowHeight() { return $(window).height() }

                /* Video Controls */
                videoContainer.after(
                    '<div class="video-controls">\n' +
                    '    <span class="play-pause"><span class="fa fa-pause"></span></span>\n' +
                    '    <span class="current">00:00</span>\n' +
                    '    <span class="seek-container"><input type="range" class="seek-bar" value="0"></span>\n' +
                    '    <span class="duration">00:00</span>\n' +
                    '    <span class="mute"><span class="fa fa-volume-up"></span></span>\n' +
                    '    <span class="volume-container"><input type="range" class="volume-bar" min="0" max="100" step="1" value="100"></span>\n' +
                    '    <span class="full-screen"><span class="fa fa-expand"></span></span>\n' +
                    '</div>'
                );
                
                var playPauseBtn = videoWrap.find('.play-pause > span');
                var muteBtn = videoWrap.find('.mute > span');
                var fullScreen = videoWrap.find( '.full-screen > span' );
                var currentTime = videoWrap.find('.current');

                var seekBar = videoWrap.find( '.seek-bar' );
                var volumeBar = videoWrap.find( '.volume-bar' );

                playPauseBtn.on('click', function() {
                    playPauseClassToggle();
                    if(firstVideo.paused) {
                        playVideo();
                    } else {
                        pauseVideo();
                    }
                });

                muteBtn.on('click', function() {
                    muteClassToggle();
                    if(firstVideo.muted) {
                        firstVideo.muted = false;
                    } else {
                        firstVideo.muted = true;
                    }
                });

                fullScreen.on('click', function() {
                    if (!document.fullscreenElement &&    // alternative standard method
                        !document.mozFullScreenElement && !document.webkitFullscreenElement && !document.msFullscreenElement ) {  // current working methods

                        if (firstVideo.msRequestFullscreen) {
                            console.log(1);
                            firstVideo.msRequestFullscreen();
                        } else if (firstVideo.mozRequestFullScreen) {
                            console.log(2);
                            firstVideo.mozRequestFullScreen();
                        } else if (firstVideo.webkitRequestFullscreen) {
                            console.log(3);
                            firstVideo.webkitRequestFullscreen();
                        } else {
                            console.log(4);
                            firstVideo.requestFullscreen();
                        }
                    } else {
                        if (document.exitFullscreen) {
                            document.exitFullscreen();
                        } else if (document.msExitFullscreen) {
                            document.msExitFullscreen();
                        } else if (document.mozCancelFullScreen) {
                            document.mozCancelFullScreen();
                        } else if (document.webkitExitFullscreen) {
                            document.webkitExitFullscreen();
                        }
                    }

                    fullScreenClassToggle();
                });

                // seek bar options
                seekBar.on("change", function() {
                    // Calculate the new time
                    var videoTime = firstVideo.duration * (seekBar.val() / 100);
                    
                    // Update the video time
                    firstVideo.currentTime = videoTime;

                    seekBar.mousedown(function() {pauseVideo();}).mouseup(function() {playVideo();});
                });
                videoContainer.on("timeupdate", function () {
                    var value = (100 / firstVideo.duration) * firstVideo.currentTime;
                    seekBar.val(value);

                    currentTime.text(currentVideoTime(firstVideo.currentTime));
                });

                videoContainer.on('loadedmetadata', function() {
                    $('.duration').text(currentVideoTime(firstVideo.duration));
                });
                

                // Event listener for the volume bar
                volumeBar.on("change", function() {
                    firstVideo.volume = volumeBar.val();
                });
                

                function playPauseClassToggle() {
                    playPauseBtn.toggleClass('fa-play');
                    playPauseBtn.toggleClass('fa-pause');
                }
                function muteClassToggle() {
                    muteBtn.toggleClass('fa-volume-up');
                    muteBtn.toggleClass('fa-volume-off');
                }

                function fullScreenClassToggle() {
                    fullScreen.toggleClass('fa-expand');
                    fullScreen.toggleClass('fa-compress');
                }

                function currentVideoTime(whereYouAt) {
                    var minutes = Math.floor(whereYouAt / 60);
                    var seconds = Math.floor(whereYouAt - minutes * 60);
                    var x = minutes < 10 ? "0" + minutes : minutes;
                    var y = seconds < 10 ? "0" + seconds : seconds;

                    return x + ':' + y;
                }
            });
        };
    })(jQuery);
}