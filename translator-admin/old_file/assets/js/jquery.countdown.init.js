$(document).ready(function() {
  $(function() {
    var endDate = "January 17, 2017 20:39:00";
    $('.lj-countdown .row').countdown({
      date: endDate,
      render: function(data) {
        $(this.el).html('<div><div><span>' + (parseInt(this.leadingZeros(data.years, 2) * 365) + parseInt(this.leadingZeros(data.days, 2))) + '</span><span>days</span></div><div><span>' + this.leadingZeros(data.hours, 2) + '</span><span>hours</span></div></div><div class="lj-countdown-ms"><div><span>' + this.leadingZeros(data.min, 2) + '</span><span>minutes</span></div><div><span>' + this.leadingZeros(data.sec, 2) + '</span><span>seconds</span></div></div>');
      }
    });
  });
});
$(document).ready(function() {
  $(".home-text .rotate").textrotator({
    animation: "fade",
    speed: 2000
  });
});