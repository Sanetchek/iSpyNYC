'use strict';

var parag = document.querySelectorAll(".paragraph");
var paragWrap = document.querySelectorAll(".paragraph-wrap");
var readMore = document.getElementsByClassName("read-more");
var comStyle = "";
var maxHeight = 0;
if (readMore.length > 0) {
    if (readMore != "") {
        for (var i = 0; i < parag.length; i++) {
            comStyle = window.getComputedStyle(paragWrap[i]);
            maxHeight = parseInt(comStyle.height);

            if (maxHeight > 42) {
                readMore[i].style.display = "inline";
            }
        }
    }
}

var content = document.getElementById("content");
var selectedMore;

function showContent(node) {
    selectedMore = node;
    if (selectedMore.previousElementSibling.style.maxHeight == "42px") {
        selectedMore.previousElementSibling.style.maxHeight = "";
        selectedMore.innerHTML = "read less";
    } else {
        selectedMore.previousElementSibling.style.maxHeight = "42px";
        selectedMore.innerHTML = "read more";
    }
}

content.onclick = function (event) {
    var target = event.target || event.srcElement;
    if (target.className !== 'read-more') {
        return;
    }
    showContent(target);
};

$(document).ready(function (){

    /*
     =====================================================
     Slider
     =====================================================
     */

    alSlider(  );

    function alSlider( getSliderClass, getSlideClass, getPrevSlide, getNextSlide ) {

        // check all classes
        getSliderClass = ( !getSliderClass ) ? getSliderClass = '.al-slider' : getSliderClass;
        getSlideClass = ( !getSlideClass ) ? getSlideClass = '.slide' : getSlideClass;
        getPrevSlide = ( !getPrevSlide ) ? getPrevSlide = '.prev-slide' : getPrevSlide;
        getNextSlide = ( !getNextSlide ) ? getNextSlide = '.next-slide' : getNextSlide;

        // variables
        var slider = $( getSliderClass );
        var slide = slider.find( getSlideClass );
        var countSlides = slide.length;

        var lastSlideIndex = countSlides - 1;
        var prevSlideBtn = slider.find( getPrevSlide );
        var nextSlideBtn = slider.find( getNextSlide );



        activateSlide();

        function activateSlide() {
            var slideIndex = slider.find('.active').index();
            slideIndex = ( slideIndex < 0 ) ? 0 : slideIndex;
            var currentSlide = slide[slideIndex];
            currentSlide.classList.add('active');

            previousSlide( currentSlide, slideIndex );
            nextSlide( currentSlide, slideIndex );
        }

        function previousSlide( curSlide, index ) {
            prevSlideBtn.on('click', function(){

                switch (index) {
                    case 0:
                        curSlide.classList.remove('active');
                        curSlide = slide[lastSlideIndex]; // current Slide takes index of last Slide
                        curSlide.classList.add('active');
                        index = slider.find('.active').index();
                        console.log(index);

                        break;
                    case lastSlideIndex:
                        curSlide.classList.remove('active');
                        curSlide = slide[lastSlideIndex - 1];
                        curSlide.classList.add('active');
                        index = slider.find('.active').index();
                        console.log(index);

                        break;
                    default:
                        curSlide.classList.remove('active');
                        curSlide = slide[index - 1];
                        curSlide.classList.add('active');
                        index = slider.find('.active').index();
                        console.log(index);

                        break;
                }
            });
        }

        function nextSlide( curSlide, index ) {
            nextSlideBtn.on('click', function(){
                curSlide.classList.remove('active');
                curSlide = slide[index + 1];
                curSlide.classList.add('active');
                index = slider.find('.active').index();
            });
        }
    }
    /*
     =====================================================
     Ajax Popup
     =====================================================
     */
    $(document).on('click', '.ispy-popup', function(){  // click on button with class = ispy-popup

        var page = $(this).data('page'); // take from .ispy-popup, data-page = value
        var ajaxurl = $(this).data('url'); // take from .ispy-popup, data-url = value

        $.ajax({
            url : ajaxurl, // var ajaxurl
            type : 'post', // method = get/post
            data : {
                page : page, // var page
                action : 'ispy-popup' // class .ispy-popup
            },
            error : function( response ) {
                console.log( response ); // if error consol.log error
            },
            success : function( response ){
                $( '#post-' + page ).append( response ); // if success append everything what contain ajax.php to post-ID

                var ispyModal = document.getElementById('ispy-modal');
                var close = $('.close');
                close.on('click', function(){
                    ispyModal.remove();
                });

                var modal = $('.modal');
                modal.on('click', function(){
                    ispyModal.remove();
                });
            }
        });

    });

   
});