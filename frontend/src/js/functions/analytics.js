// visiter & feedback
function visiterFeedbackStats(vlist,flist,mlist){
    function sunVisiters(arr){
      let sum = 0
      for(i=0;i<arr.length;i++){
        sum+=parseInt(arr[i]);
      }
      return sum;
    }
    var options1 = {
      chart: {
        fontFamily: 'Nunito, sans-serif',
        height: 365,
        type: 'area',
        zoom: {
            enabled: false
        },
        dropShadow: {
          enabled: true,
          opacity: 0.3,
          blur: 5,
          left: -7,
          top: 22
        },
        toolbar: {
          show: false
        },
        events: {
          mounted: function(ctx, config) {
            const highest1 = ctx.getHighestValueInSeries(0);
            const highest2 = ctx.getHighestValueInSeries(1);
    
            ctx.addPointAnnotation({
              x: new Date(ctx.w.globals.seriesX[0][ctx.w.globals.series[0].indexOf(highest1)]).getTime(),
              y: highest1,
              label: {
                style: {
                  cssClass: 'd-none'
                }
              },
              customSVG: {
                  SVG: '<svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="#1b55e2" stroke="#fff" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" class="feather feather-circle"><circle cx="12" cy="12" r="10"></circle></svg>',
                  cssClass: undefined,
                  offsetX: -8,
                  offsetY: 5
              }
            })
    
            ctx.addPointAnnotation({
              x: new Date(ctx.w.globals.seriesX[1][ctx.w.globals.series[1].indexOf(highest2)]).getTime(),
              y: highest2,
              label: {
                style: {
                  cssClass: 'd-none'
                }
              },
              customSVG: {
                  SVG: '<svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="#e7515a" stroke="#fff" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" class="feather feather-circle"><circle cx="12" cy="12" r="10"></circle></svg>',
                  cssClass: undefined,
                  offsetX: -8,
                  offsetY: 5
              }
            })
          },
        }
      },
      colors: ['#1b55e2', '#e7515a'],
      dataLabels: {
          enabled: false
      },
      markers: {
        discrete: [{
        seriesIndex: 0,
        dataPointIndex: 7,
        fillColor: '#000',
        strokeColor: '#000',
        size: 5
      }, {
        seriesIndex: 2,
        dataPointIndex: 11,
        fillColor: '#000',
        strokeColor: '#000',
        size: 4
      }]
      },
      subtitle: {
        text: 'Total Visiters',
        align: 'left',
        margin: 0,
        offsetX: -10,
        offsetY: 35,
        floating: false,
        style: {
          fontSize: '14px',
          color:  '#888ea8'
        }
      },
      title: {
        text: String(sunVisiters(vlist)),
        align: 'left',
        margin: 0,
        offsetX: -10,
        offsetY: 0,
        floating: false,
        style: {
          fontSize: '25px',
          color:  '#888ea8'
        },
      },
      stroke: {
          show: true,
          curve: 'smooth',
          width: 2,
          lineCap: 'square'
      },
      series: [{
          name: 'Visiters',
          data: vlist
      }, {
          name: 'Feedbacks',
          data: flist
      }],
      labels: mlist,
      xaxis: {
        axisBorder: {
          show: false
        },
        axisTicks: {
          show: false
        },
        crosshairs: {
          show: true
        },
        labels: {
          offsetX: 0,
          offsetY: 5,
          style: {
              fontSize: '12px',
              fontFamily: 'Nunito, sans-serif',
              cssClass: 'apexcharts-xaxis-title',
          },
        }
      },
      yaxis: {
        labels: {
          formatter: function(value, index) {
            return (value)
          },
          offsetX: -22,
          offsetY: 0,
          style: {
              fontSize: '12px',
              fontFamily: 'Nunito, sans-serif',
              cssClass: 'apexcharts-yaxis-title',
          },
        }
      },
      grid: {
        borderColor: '#e0e6ed',
        strokeDashArray: 5,
        xaxis: {
            lines: {
                show: true
            }
        },   
        yaxis: {
            lines: {
                show: false,
            }
        },
        padding: {
          top: 0,
          right: 0,
          bottom: 0,
          left: -10
        }, 
      }, 
      legend: {
        position: 'top',
        horizontalAlign: 'right',
        offsetY: -50,
        fontSize: '16px',
        fontFamily: 'Nunito, sans-serif',
        markers: {
          width: 10,
          height: 10,
          strokeWidth: 0,
          strokeColor: '#fff',
          fillColors: undefined,
          radius: 12,
          onClick: undefined,
          offsetX: 0,
          offsetY: 0
        },    
        itemMargin: {
          horizontal: 0,
          vertical: 20
        }
      },
      tooltip: {
        theme: 'dark',
        marker: {
          show: true,
        },
        x: {
          show: false,
        }
      },
      fill: {
          type:"gradient",
          gradient: {
              type: "vertical",
              shadeIntensity: 1,
              inverseColors: !1,
              opacityFrom: .28,
              opacityTo: .05,
              stops: [45, 100]
          }
      },
      responsive: [{
        breakpoint: 575,
        options: {
          legend: {
              offsetY: -30,
          },
        },
      }]
    }
  /*
      ================================
          Revenue Monthly | Render
      ================================
  */
  $("#revenueMonthly").html('');
  var chart1 = new ApexCharts(
      document.querySelector("#revenueMonthly"),
      options1
  );
  
  chart1.render();
  }
// visiter by device
function visiterDeviceStats(dlist,dpers){
    for(i=0;i<dlist.length;i++){
        if(dlist[i] == "laptop"){
            let str="<h6>Laptop</h6><p class='browser-count'>"+Math.round(dpers[i])+"%</p>";
            $(".vistorsBrowser #laptopDevice").html(str);
        }else{
            let str="<h6>Mobile</h6><p class='browser-count'>"+Math.round(dpers[i])+"%</p>";
            $(".vistorsBrowser #mobileDevice").html(str);
        }
    }
}
// daily visits
function visiterWeeklyStats(day,visiter,feedbacks){
    var d_2options1 = {
        chart: {
              height: 160,
              type: 'bar',
              stacked: true,
              stackType: '100%',
              toolbar: {
                show: false,
              }
          },
          dataLabels: {
              enabled: false,
          },
          stroke: {
              show: true,
              width: 1,
          },
          colors: ['#e2a03f', '#e0e6ed'],
          responsive: [{
              breakpoint: 480,
              options: {
                  legend: {
                      position: 'bottom',
                      offsetX: -10,
                      offsetY: 0
                  }
              }
          }],
          series: [{
              name: 'Visits',
              data: visiter
          },{
              name: 'FeedBacks',
              data: feedbacks
          }],
          xaxis: {
              labels: {
                  show: false,
              },
              categories: day,
          },
          yaxis: {
              show: false
          },
          fill: {
              opacity: 1
          },
          plotOptions: {
              bar: {
                  horizontal: false,
                  endingShape: 'rounded',
                  columnWidth: '25%',
              }
          },
          legend: {
              show: false,
          },
          grid: {
              show: false,
              xaxis: {
                  lines: {
                      show: false
                  }
              },
              padding: {
                top: 10,
                right: 0,
                bottom: -40,
                left: 0
              }, 
          },
    }
    $("#daily-sales").html('');
    var d_2C_1 = new ApexCharts(document.querySelector("#daily-sales"), d_2options1);
    d_2C_1.render();
}