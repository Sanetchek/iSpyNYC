'use strict';
(function ($) {
    $.fn.showParagraph = function (options) {
        options = $.extend({

            wrapper: '.paragraph-wrap',
            readMore: '.read-more',
            paragHeight: 42,
            toggleSpeed: 500
        }, options);
        return this.each(function () {
            // variables
            var parag = $(this);
            var paragWrap = parag.find(options.wrapper);
            var readMore = parag.siblings(options.readMore);

            if (readMore.length > 0) {
                if ( paragWrap.height() > options.paragHeight ) {
                    readMore.show();
                }
            }

            readMore.click(function(e) {
                e.preventDefault();
                if ( parag.height() === options.paragHeight ) {
                    parag.stop().animate({maxHeight: paragWrap.height()}, options.toggleSpeed);
                    readMore.text('read less');
                } else {
                    parag.stop().animate({maxHeight: options.paragHeight}, options.toggleSpeed);
                    readMore.text('read more');
                }
            });
        });
    };
})(jQuery);

jQuery(document).ready(function ($){

    /*
     =====================================================
     Ajax Popup
     =====================================================
     */
    $(document).on('click', '.preloader', function(){  // click on button with class = ispy-popup

        var page = $(this).data('page'); // take from .ispy-popup, data-page = value
        var ajaxurl = $(this).data('url'); // take from .ispy-popup, data-url = value
        var showPreload = $(this).find('.content-preload');

        showPreload.show();

        $.ajax({
            url : ajaxurl, // var ajaxurl
            type : 'post', // method = get/post
            data : {
                page : page, // var page
                action : 'ispy_popup'
            },
            error : function( response ) {
                showPreload.delay(5000).hide();
                console.log( 'error - ' + response ); // if error consol.log error
            },
            success : function( response ){
                showPreload.delay(5000).hide();

                $( '#content' ).append( response ); // if success append everything what contain ajax.php to post-ID

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

