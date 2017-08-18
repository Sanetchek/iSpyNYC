'use strict';

var parag = document.querySelectorAll(".paragraph");
var readMore = document.getElementsByClassName("read-more");
var comStyle = "", h = 0;

if (readMore != "") {
    for (var i = 0; i < parag.length; i++) {
        comStyle = window.getComputedStyle(parag[i]);
        h = parseInt(comStyle.height);

        if (h > 36) {
            readMore[i].style.display = "inline";
        }
    }
}

var content = document.getElementById("content");
var selectedMore;

function showContent(node) {
    selectedMore = node;
    if (selectedMore.previousElementSibling.style.maxHeight == "37px") {
        selectedMore.previousElementSibling.style.maxHeight = "";
        selectedMore.innerHTML = "read less";
    } else {
        selectedMore.previousElementSibling.style.maxHeight = "37px";
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