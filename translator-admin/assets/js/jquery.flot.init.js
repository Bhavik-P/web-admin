!function ($) {
  "use strict";
  var FlotChart = function () {
    this.$body = $("body")
    this.$realData = []
  };
  FlotChart.prototype.createPlotGraph = function (selector, data1, data2, labels, colors, borderColor, bgColor) {
    function showTooltip(x, y, contents) {
      $('<div id="tooltip" class="tooltipflot">' + contents + '</div>').css({
        position: 'absolute',
        top: y + 5,
        left: x + 5
      }).appendTo("body").fadeIn(200);
    }
    $.plot($(selector),
      [{
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
              colors: [{opacity: 0.5},
                {opacity: 0.5}
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
          borderWidth: 1,
          labelMargin: 10,
          backgroundColor: bgColor
        },
        yaxis: {
          min: 0,
          max: 15,
          color: 'rgba(0,0,0,0.1)'
        },
        xaxis: {
          color: 'rgba(0,0,0,0.1)'
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

    FlotChart.prototype.createPieGraph = function (selector, labels, datas, colors) {
      var data = [{
        label: labels[0],
        data: datas[0]
      }, {
        label: labels[1],
        data: datas[1]
      }, {
        label: labels[2],
        data: datas[2]
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

    FlotChart.prototype.randomData = function () {
      var totalPoints = 300;
      if (this.$realData.length > 0) {
        this.$realData = this.$realData.slice(1);
      }
      while (this.$realData.length < totalPoints) {
        var prev = this.$realData.length > 0 ? this.$realData[this.$realData.length - 1] : 50, y = prev + Math.random() * 10 - 5;
        if (y < 0) {
          y = 0;
        } else if (y > 100) {
          y = 100;
        }
        this.$realData.push(y);
      }

      var res = [];
      for (var i = 0; i < this.$realData.length; ++i) {
        res.push([i, this.$realData[i]])
      }
      return res;
    },

    FlotChart.prototype.createRealTimeGraph = function (selector, data, colors) {
      var plot = $.plot(selector, [data], {
        colors: colors,
        series: {
          lines: {
            show: true,
            fill: true,
            lineWidth: 1,
            fillColor: {
              colors: [{
                opacity: 0.45
              }, {
                opacity: 0.45
              }]
            }
          },
          points: {
            show: false
          },
          shadowSize: 0
        },
        grid: {
          borderColor: 'rgba(0,0,0,0.1)',
          borderWidth: 1,
          labelMargin: 15,
          backgroundColor: 'transparent'
        },
        yaxis: {
          min: 0,
          max: 100,
          color: 'rgba(0,0,0,0.1)'
        },
        xaxis: {
          show: false
        }
      });

      return plot;
    },
    FlotChart.prototype.createDonutGraph = function (selector, labels, datas, colors) {
      var data = [{
        label: labels[0],
        data: datas[0]
      }, {
        label: labels[1],
        data: datas[1]
      }, {
        label: labels[2],
        data: datas[2]
      },
        {
          label: labels[3],
          data: datas[3]
        }, {
          label: labels[4],
          data: datas[4]
        }
      ];
      var options = {
        series: {
          pie: {
            show: true,
            innerRadius: 0.5
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
    FlotChart.prototype.createCombineGraph = function (selector, ticks, labels, datas) {
      var data = [{
        label: labels[0],
        data: datas[0],
        lines: {
          show: true,
          fill: true
        },
        points: {
          show: true
        }
      }, {
        label: labels[1],
        data: datas[1],
        lines: {
          show: true
        },
        points: {
          show: true
        }
      }, {
        label: labels[2],
        data: datas[2],
        bars: {
          show: true
        }
      }];
      var options = {
        xaxis: {
          ticks: ticks
        },
        series: {
          shadowSize: 0
        },
        grid: {
          hoverable: true,
          clickable: true,
          tickColor: "#f9f9f9",
          borderWidth: 1,
          borderColor: "#eeeeee"
        },
        colors: ["#0b4d81", "#1a2942", "#60b1cc"],
        tooltip: true,
        tooltipOpts: {
          defaultTheme: false
        },
        legend: {
          position: 'nw'
        }
      };
      $.plot($(selector), data, options);
    },

    FlotChart.prototype.init = function () {
      var uploads = [[0, 9], [1, 8], [2, 5], [3, 8], [4, 5], [5, 14], [6, 10]];
      var downloads = [[0, 5], [1, 12], [2, 4], [3, 3], [4, 12], [5, 11], [6, 14]];
      var plabels = ["Visits", "Pages"];
      var pcolors = ['#0b4d81', '#1a2942'];
      var borderColor = '#efefef';
      var bgColor = '#fff';
      this.createPlotGraph("#website-stats", uploads, downloads, plabels, pcolors, borderColor, bgColor);
      var pielabels = ["Series 1", "Series 2", "Series 3"];
      var datas = [20, 30, 15];
      var colors = ["#60b1cc", "#6c85bd", "#1ca8dd"];
      this.createPieGraph("#pie-chart #pie-chart-container", pielabels, datas, colors);
      var plot = this.createRealTimeGraph('#flotRealTime', this.randomData(), ['#0b4d81']);
      plot.draw();
      var $this = this;

      function updatePlot() {
        plot.setData([$this.randomData()]);
        plot.draw();
        setTimeout(updatePlot, $('html').hasClass('mobile-device') ? 1000 : 30);
      }

      updatePlot();
      var donutlabels = ["Series 1", "Series 2", "Series 3", "Series 4", "Series 5"];
      var donutdatas = [35, 20, 10, 15, 20];
      var donutcolors = ["#60b1cc", "#bac3d2", "#4697ce", "#6c85bd", "#0b4d81"];
      this.createDonutGraph("#donut-chart #donut-chart-container", donutlabels, donutdatas, donutcolors);

      var data24Hours = [
        [0, 201],
        [1, 520],
        [2, 337],
        [3, 261],
        [4, 157],
        [5, 95],
        [6, 200],
        [7, 250],
        [8, 320],
        [9, 500],
        [10, 152],
        [11, 214],
        [12, 364],
        [13, 449],
        [14, 558],
        [15, 282],
        [16, 379],
        [17, 429],
        [18, 518],
        [19, 470],
        [20, 330],
        [21, 245],
        [22, 358],
        [23, 74]
      ];
      var data48Hours = [
        [0, 245],
        [1, 492],
        [2, 538],
        [3, 332],
        [4, 234],
        [5, 143],
        [6, 147],
        [7, 63],
        [8, 64],
        [9, 43],
        [10, 486],
        [11, 201],
        [12, 315],
        [13, 397],
        [14, 612],
        [15, 281],
        [16, 370],
        [17, 279],
        [18, 425],
        [19, 53],
        [20, 122],
        [21, 355],
        [22, 340],
        [23, 801]
      ];
      var dataDifference = [
        [23, 727],
        [22, 128],
        [21, 110],
        [20, 92],
        [19, 172],
        [18, 63],
        [17, 150],
        [16, 592],
        [15, 12],
        [14, 246],
        [13, 52],
        [12, 149],
        [11, 123],
        [10, 2],
        [9, 325],
        [8, 10],
        [7, 15],
        [6, 89],
        [5, 65],
        [4, 77],
        [3, 600],
        [2, 200],
        [1, 385],
        [0, 200]
      ];
      var ticks = [
        [0, "22h"],
        [1, ""],
        [2, "00h"],
        [3, ""],
        [4, "02h"],
        [5, ""],
        [6, "04h"],
        [7, ""],
        [8, "06h"],
        [9, ""],
        [10, "08h"],
        [11, ""],
        [12, "10h"],
        [13, ""],
        [14, "12h"],
        [15, ""],
        [16, "14h"],
        [17, ""],
        [18, "16h"],
        [19, ""],
        [20, "18h"],
        [21, ""],
        [22, "20h"],
        [23, ""]
      ];
      var combinelabels = ["Last 24 Hours", "Last 48 Hours", "Difference"];
      var combinedatas = [data24Hours, data48Hours, dataDifference];

      this.createCombineGraph("#combine-chart #combine-chart-container", ticks, combinelabels, combinedatas);
    },
    $.FlotChart = new FlotChart, $.FlotChart.Constructor = FlotChart

}(window.jQuery),

  function ($) {
    "use strict";
    $.FlotChart.init()
  }(window.jQuery);



