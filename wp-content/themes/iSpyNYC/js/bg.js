"use strict";
var day = new Date();
var header = document.querySelector("#head-wrap");
var active = header.querySelector("#left li.current-menu-item > a");
var btn = document.getElementsByClassName("btn");
var bgColor = "#0409c3";

switch (day.getDay()) {
case 0:
    bgColor = "#0409c3";
    break;
case 1:
    bgColor = "#fa3717";
    break;
case 2:
    bgColor = "rebeccapurple";
    break;
case 3:
    bgColor = "green";
    break;
case 4:
    bgColor = "rgb(255,214,100)";
    break;
case 5:
    bgColor = "#e37507";
    break;
case 6:
    bgColor = "#91c2f4";
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