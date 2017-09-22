"use strict";
var day = new Date();
var header = document.querySelector("#head-wrap");
if (header) {
    var active = header.querySelector("#left li.current-menu-item > a");
}
var btn = document.getElementsByClassName("btn");
var bgColor = "#0409c3";

switch (day.getDay()) {
case 0:
    bgColor = "#663399"; // SUNDAY rebeccapurple
    break;
case 1:
    bgColor = "#ed3706"; // MONDAY red
    break;
case 2:
    bgColor = "#f28c09"; // TUESDAY orange
    break;
case 3:
    bgColor = "#fccf34"; // WEDNESDAY yellow
    break;
case 4:
    bgColor = "#069f1f"; // THURSDAY green
    break;
case 5:
    bgColor = "#91c2f4"; // FRIDAY light blue
    break;
case 6:
    bgColor = "#2349ce"; // SUNDAY blue
    break;
}
for(var i = 0; i < btn.length; i++) {
    btn[i].style.backgroundColor = bgColor;
}

header.style.backgroundColor = bgColor;

if (active) {
    active.style.backgroundColor = bgColor;
}

function menuOver(event) {
    var $target = $(event.target);
    if( $target.is("a") ) {
        $target.css({"background-color" : bgColor, "color" : "white"});
    }
}
function menuLeave(event) {
    var $target = $(event.target);
    if( $target.is("a") ) {
        $target.css({"background-color" : "", "color" : "#2d1b88"});
    }
    if (active) {
        active.style.backgroundColor = bgColor;
    }
}

$("#left a").mouseover(menuOver).mouseleave(menuLeave);