var input = document.getElementsByClassName("postform");
if(input[0] || input[1] ) {
    input[0].placeholder = "From:";
    input[1].placeholder = "To:";
    input[0].id = "datepicker1";
    input[1].id = "datepicker2";
}

for (var i = 0; i < input.length; i++) {
    input[i].setAttribute("type", "text");
}

jQuery(function ($) {
    $(".mylightbox").html5lightbox();
    $('.paragraph').showParagraph();
});