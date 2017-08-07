/*var alert = document.getElementsByClassName('cat-item-1');
if(alert[0]) {
    var label = alert[0].getElementsByTagName('label');
}
var newImg = document.createElement("img");
newImg.setAttribute("src","http://localhost/ispynyc.org/wp-content/themes/iSpyNYC/images/sign.png");
newImg.setAttribute("width","12px");
newImg.setAttribute("alt","Alert");
newImg.innerHTML = " Alert";

if(label) {
    for (var i = 0; i < label.length; i++) {
        label[i].appendChild(newImg);
    }
}*/

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

jQuery(".mylightbox").html5lightbox();