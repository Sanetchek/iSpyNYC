$(document).ready(function (){
    var d = new Date();

    var monthArray = new Array("January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "Novembr", "Decembr");

    var month = monthArray[d.getMonth()];
    var day = d.getDate();
    var divMonth = $('.month');
    var divDay = $('.day');

    if( divDay.length > 0 && divMonth.length > 0 ) {
        divMonth.text(month);
        divDay.text(day);
    }
});