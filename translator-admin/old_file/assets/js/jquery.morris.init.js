!function ($) {
  "use strict";
  var MorrisCharts = function () {};
  MorrisCharts.prototype.createLineChart = function (element, data, xkey, ykeys, labels, lineColors) {
    Morris.Line({
      element: element,
      data: data,
      xkey: xkey,
      ykeys: ykeys,
      labels: labels,
      resize: true,
      lineColors: lineColors
    });
  },
    MorrisCharts.prototype.createAreaChart = function (element, pointSize, lineWidth, data, xkey, ykeys, labels, lineColors) {
      Morris.Area({
        element: element,
        pointSize: 0,
        lineWidth: 0,
        data: data,
        xkey: xkey,
        ykeys: ykeys,
        labels: labels,
        resize: true,
        lineColors: lineColors
      });
    },
    MorrisCharts.prototype.createBarChart = function (element, data, xkey, ykeys, labels, lineColors) {
      Morris.Bar({
        element: element,
        data: data,
        xkey: xkey,
        ykeys: ykeys,
        labels: labels,
        barColors: lineColors
      });
    },
    MorrisCharts.prototype.createDonutChart = function (element, data, colors) {
      Morris.Donut({
        element: element,
        data: data,
        colors: colors
      });
    },
    MorrisCharts.prototype.init = function () {
      var $data = [
        {y: '2009', a: 100, b: 90},
        {y: '2010', a: 75, b: 65},
        {y: '2011', a: 50, b: 40},
        {y: '2012', a: 75, b: 65},
        {y: '2013', a: 50, b: 40},
        {y: '2014', a: 75, b: 65},
        {y: '2015', a: 100, b: 90}
      ];
      this.createLineChart('morris-line-example', $data, 'y', ['a', 'b'], ['Series A', 'Series B'], ['#ff8080', '#66ff99']);
      var $areaData = [
        {y: '2009', a: 10, b: 20},
        {y: '2010', a: 75, b: 65},
        {y: '2011', a: 50, b: 40},
        {y: '2012', a: 75, b: 65},
        {y: '2013', a: 50, b: 40},
        {y: '2014', a: 75, b: 65},
        {y: '2015', a: 90, b: 60}
      ];
      this.createAreaChart('morris-area-example', 0, 0, $areaData, 'y', ['a', 'b'], ['Series A', 'Series B'], ['#ff8080', '#66ccff']);
      var $barData = [
        {y: '2009', a: 100, b: 90},
        {y: '2010', a: 75, b: 65},
        {y: '2011', a: 50, b: 40},
        {y: '2012', a: 75, b: 65},
        {y: '2013', a: 50, b: 40},
        {y: '2014', a: 75, b: 65},
        {y: '2015', a: 100, b: 90}
      ];
      this.createBarChart('morris-bar-example', $barData, 'y', ['a', 'b'], ['Series A', 'Series B'], ['#cc6600', '#66ccff']);
      var $donutData = [
        {label: "Samsung", value: 40},
        {label: "Apple", value: 30},
        {label: "Microsoft", value: 20},
        {label: "Other", value: 10}
      ];
      this.createDonutChart('morris-donut-example', $donutData, ['#cc6600', '#ff8080', '#66ccff', "#66ff99"]);
    },
    $.MorrisCharts = new MorrisCharts, $.MorrisCharts.Constructor = MorrisCharts
}(window.jQuery),

  function ($) {
    "use strict";
    $.MorrisCharts.init();
  }(window.jQuery);