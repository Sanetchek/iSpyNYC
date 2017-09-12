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