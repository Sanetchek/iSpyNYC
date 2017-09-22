"use strict";
var day = new Date();
var bodyLogin = document.getElementsByClassName("login");
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

bodyLogin[0].style.backgroundColor = bgColor;
