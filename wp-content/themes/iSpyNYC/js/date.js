var d = new Date();

var month=new Array("January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "Novembr", "Decembr");

document.write("<div class=\"month\">" + month[d.getMonth()] + "</div><div class=\"day\">" + d.getDate() + "</div>");