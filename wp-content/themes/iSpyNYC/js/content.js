'use strict';

var parag = document.querySelectorAll(".paragraph");
var paragWrap = document.querySelectorAll(".paragraph-wrap");
var readMore = document.getElementsByClassName("read-more");
var comStyle = "";
var maxHeight = 0;

if (readMore != "") {
    for (var i = 0; i < parag.length; i++) {
        comStyle = window.getComputedStyle(paragWrap[i]);
        maxHeight = parseInt(comStyle.height);

        if (maxHeight > 42) {
            readMore[i].style.display = "inline";
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

/*
 =====================================================
     Ajax Popup
 =====================================================
*/

jQuery(document).ready(function ($){
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