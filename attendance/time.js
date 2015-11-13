var time = new Date();
var dd = time.getHours();
var mm = time.getMinutes(); //January is 0!
var yyyy = time.getSeconds();

var period = "AM";
if (dd > 12) {
    period = "PM"
}
else {
   period = "AM";
}

time = dd+':'+mm+':'+yyyy;
document.write(time);