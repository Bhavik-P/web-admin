!function ($) {
  "use strict";
  var ChartJs = function () {};
  ChartJs.prototype.respChart = function respChart(selector, type, data, options) {
    var ctx = selector.get(0).getContext("2d");
    var container = $(selector).parent();
    $(window).resize(generateChart);
    function generateChart() {
      var ww = selector.attr('width', $(container).width());
      switch (type) {
        case 'Line':
          new Chart(ctx).Line(data, options);
          break;
        case 'Doughnut':
          new Chart(ctx).Doughnut(data, options);
          break;
        case 'Pie':
          new Chart(ctx).Pie(data, options);
          break;
        case 'Bar':
          new Chart(ctx).Bar(data, options);
          break;
        case 'Radar':
          new Chart(ctx).Radar(data, options);
          break;
        case 'PolarArea':
          new Chart(ctx).PolarArea(data, options);
          break;
      }
    };
    generateChart();
  },
    ChartJs.prototype.init = function () {
      var data = {
        labels: ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"],
        datasets: [{
            fillColor: "#cc6600",
            strokeColor: "#fff",
            pointColor: "#cc6600",
            pointStrokeColor: "rgba(49, 126, 235, 0.75)",
            data: [120, 150, 100, 90, 99, 101, 110, 88, 99, 92, 95, 96]
          }, {
            fillColor: "#66ccff",
            strokeColor: "#fff",
            pointColor: "#66ccff",
            pointStrokeColor: "#dcdcdc",
            data: [80, 30, 40, 65, 32, 9, 33, 54, 26, 25, 28, 35]
          }]
      };

      this.respChart($("#lineChart"), 'Line', data);
      var data1 = [{
          value: 80,
          color: "#60b1cc"
        }, {
          value: 50,
          color: "#bac3d2"
        }, {
          value: 80,
          color: "#4697ce"
        }, {
          value: 50,
          color: "#6c85bd"
        }]
      this.respChart($("#doughnut"), 'Doughnut', data1);
      var data2 = [{
          label: "Apple",
          value: 30,
          color: "#dcdcdc"
        }, {
          label: "Samsung",
          value: 50,
          color: "#0b4d81"
        }, {
          label: "Other",
          value: 20,
          color: "#999999"
        }]
      this.respChart($("#pie"), 'Pie', data2);
      var data3 = {
        labels: ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"],
        datasets: [
          {
            fillColor: "#ff8080",
            strokeColor: "#ff8080",
            data: [65, 59, 90, 81, 56, 55, 40, 44, 67, 56, 58, 38]
          },
          {
            fillColor: "#66ccff",
            strokeColor: "#66ccff",
            data: [28, 48, 40, 19, 96, 27, 100, 81, 56, 55, 40, 44]
          }
        ]
      }
      this.respChart($("#bar"), 'Bar', data3);
      var data4 = {
        labels: ["Eating", "Drinking", "Sleeping", "Designing", "Coding", "Partying", "Running"],
        datasets: [
          {
            fillColor: "rgba(49, 126, 235, 0.5)",
            strokeColor: "rgba(49, 126, 235, 0.75)",
            pointColor: "rgba(49, 126, 235, 1)",
            pointStrokeColor: "#fff",
            data: [65, 59, 90, 81, 56, 55, 40]
          },
          {
            fillColor: "rgba(220, 220, 220, 0.5)",
            strokeColor: "rgba(220, 220, 220, 0.75)",
            pointColor: "rgba(220, 220, 220,1)",
            pointStrokeColor: "#fff",
            data: [28, 48, 40, 19, 96, 27, 100]
          }
        ]
      }
      this.respChart($("#radar"), 'Radar', data4);
      var data5 = [{
          value: 30,
          color: "#60b1cc"
        }, {
          value: 90,
          color: "#bac3d2"
        }, {
          value: 24,
          color: "#4697ce"
        }, {
          value: 58,
          color: "#6c85bd"
        }, {
          value: 82,
          color: "#0b4d81"
        }, {
          value: 8,
          color: "#1ca8dd"
        }]
      this.respChart($("#polarArea"), 'PolarArea', data5);
    },
    $.ChartJs = new ChartJs, $.ChartJs.Constructor = ChartJs

}(window.jQuery),
  function ($) {
    "use strict";
    $.ChartJs.init()
  }(window.jQuery);