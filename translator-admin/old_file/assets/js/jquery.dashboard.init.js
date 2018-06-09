!function ($) {
  "use strict";
  var Dashboard = function () {
    this.$body = $("body")
    this.$realData = []
  };
  Dashboard.prototype.createPlotGraph = function (selector, data1, data2, labels, colors, borderColor, bgColor) {
    $.plot($(selector),
      [
        {
          data: data1,
          label: labels[0],
          color: colors[0]
        },
        {
          data: data2,
          label: labels[1],
          color: colors[1]
        }
      ],
      {
        series: {
          lines: {
            show: true,
            fill: true,
            lineWidth: 1,
            fillColor: {
              colors: [{opacity: 0.2},
                {opacity: 0.8}
              ]
            }
          },
          points: {
            show: true
          },
          shadowSize: 0
        },
        legend: {
          position: 'nw'
        },
        grid: {
          hoverable: true,
          clickable: true,
          borderColor: borderColor,
          borderWidth: 0,
          labelMargin: 10,
          backgroundColor: bgColor
        },
        yaxis: {
          min: 0,
          max: 15,
          color: 'rgba(0,0,0,0)'
        },
        xaxis: {
          color: 'rgba(0,0,0,0)'
        },
        tooltip: true,
        tooltipOpts: {
          content: '%s: Value of %x is %y',
          shifts: {
            x: -60,
            y: 25
          },
          defaultTheme: false
        }
      });
    },
    Dashboard.prototype.createPieGraph = function (selector, labels, datas, colors) {
      var data = [{
        label: labels[0],
        data: datas[0]
      }, {
        label: labels[1],
        data: datas[1]
      }, {
        label: labels[2],
        data: datas[2]
      }, {
        label: labels[3],
        data: datas[3]
      }];
      var options = {
        series: {
          pie: {
            show: true
          }
        },
        legend: {
          show: false
        },
        grid: {
          hoverable: true,
          clickable: true
        },
        colors: colors,
        tooltip: true,
        tooltipOpts: {
          defaultTheme: false
        }
      };
      $.plot($(selector), data, options);
    },
    Dashboard.prototype.init = function () {
      var uploads = [[0, 9], [1, 3], [2, 12], [3, 5], [4, 15], [5, 13], [6, 5]];
      var downloads = [[0, 5], [1, 10], [2, 4], [3, 9], [4, 12], [5, 2], [6, 14]];
      var plabels = ["Visits", "Pages"];
      var pcolors = ['#e62e00', '#0b4d81'];
      var borderColor = '#fff';
      var bgColor = '#fff';
      this.createPlotGraph("#website-stats", uploads, downloads, plabels, pcolors, borderColor, bgColor);
      var pielabels = ["Android", "iOS", "Windows Phone", "Other"];
      var datas = [40, 30, 20, 10];
      var colors = ["#3399ff", "#9999ff", "#0000e6", "#1f7a1f"];
      this.createPieGraph("#pie-chart #pie-chart-container", pielabels, datas, colors);

    },
    $.Dashboard = new Dashboard, $.Dashboard.Constructor = Dashboard
}(window.jQuery),
  function ($) {
    "use strict";
    $.Dashboard.init()
  }(window.jQuery);


