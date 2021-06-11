// set the date we're counting down to
var auction_end = document.querySelector(".auction-time-row").textContent;
var target_date = new Date(auction_end).getTime();

// variables for time units
var days, hours, minutes, seconds;

// get tag element
var countdown = document.getElementById('deal-countdown');

// update the tag with id "countdown" every 1 second
setInterval(function () {

    // find the section of "seconds" between now and target
    var current_date = new Date().getTime();
    var seconds_left = (target_date - current_date) / 1000;

    // do some time calculations
    days = parseInt(seconds_left / 86400);
    seconds_left = seconds_left % 86400;

    hours = parseInt(seconds_left / 3600);
    seconds_left = seconds_left % 3600;

    minutes = parseInt(seconds_left / 60);
    seconds = parseInt(seconds_left % 60);

    // format countdown string + set tag value
    countdown.innerHTML = '<div class="auction-timer"><span data-value="' + days + '" class="date-section"><span class="countdown-amount">' + days + '</span><br>Day</span><span class="date-section"><span class="countdown-amount">' + hours + '</span><br>Hours</span><span class="date-section"><span class="countdown-amount">'+ minutes + '</span><br>Minutes</span><span class="date-section"><span class="countdown-amount">' + seconds + '</span><br>Seconds</span></div>';

}, 1000);