// Set new default font family and font color to mimic Bootstrap's default styling
Chart.defaults.global.defaultFontFamily = 'Nunito', '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
Chart.defaults.global.defaultFontColor = '#858796';

function number_format(number, decimals, dec_point, thousands_sep) {
  // *     example: number_format(1234.56, 2, ',', ' ');
  // *     return: '1 234,56'
  number = (number + '').replace(',', '').replace(' ', '');
  var n = !isFinite(+number) ? 0 : +number,
    prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
    sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
    dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
    s = '',
    toFixedFix = function(n, prec) {
      var k = Math.pow(10, prec);
      return '' + Math.round(n * k) / k;
    };
  // Fix for IE parseFloat(0.55).toFixed(0) = 0;
  s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.');
  if (s[0].length > 3) {
    s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
  }
  if ((s[1] || '').length < prec) {
    s[1] = s[1] || '';
    s[1] += new Array(prec - s[1].length + 1).join('0');
  }
  return s.join(dec);
}

// Function to fetch and display popular destinations
function fetchPopularDestinations() {
  $.ajax({
    url: "/popular-destinations",
    type: "GET",
    success: function (data) {

      var labels = [];
      var dataValues = [];

      data.forEach(function (destination) {
        labels.push(destination.destination);
        dataValues.push(destination.bookings_count);
      });

      var ctx = document.getElementById("myAreaChart").getContext('2d');
      var myLineChart = new Chart(ctx, {
        type: 'bar', // Change chart type to bar for popular destinations
        data: {
          labels: labels,
          datasets: [{
            label: "Bookings",
            backgroundColor: "rgba(78, 115, 223, 0.5)",
            hoverBackgroundColor: "rgba(78, 115, 223, 0.8)",
            borderColor: "rgba(78, 115, 223, 1)",
            borderWidth: 1,
            data: dataValues,
          }],
        },
        options: {
          maintainAspectRatio: false,
          layout: {
            padding: {
              left: 10,
              right: 25,
              top: 25,
              bottom: 0
            }
          },
          scales: {
            xAxes: [{
              time: {
                unit: 'destination'
              },
              gridLines: {
                display: false,
                drawBorder: false
              },
              ticks: {
                maxTicksLimit: 7
              }
            }],
            yAxes: [{
              ticks: {
                beginAtZero: true, // Ensure y-axis starts from 0
                maxTicksLimit: 5,
                padding: 10,
                // Include a number in the ticks
                callback: function(value, index, values) {
                  return number_format(value);
                }
              },
              gridLines: {
                color: "rgb(234, 236, 244)",
                zeroLineColor: "rgb(234, 236, 244)",
                drawBorder: false,
                borderDash: [2],
                zeroLineBorderDash: [2]
              }
            }],
          },
          legend: {
            display: false
          },
          tooltips: {
            backgroundColor: "rgb(255,255,255)",
            bodyFontColor: "#858796",
            titleMarginBottom: 10,
            titleFontColor: '#6e707e',
            titleFontSize: 14,
            borderColor: '#dddfeb',
            borderWidth: 1,
            xPadding: 15,
            yPadding: 15,
            displayColors: false,
            intersect: false,
            mode: 'index',
            caretPadding: 10,
            callbacks: {
              label: function(tooltipItem, chart) {
                var datasetLabel = chart.datasets[tooltipItem.datasetIndex].label || '';
                return datasetLabel + ': ' + number_format(tooltipItem.yLabel);
              }
            }
          }
        }
      });
    },
    error: function (error) {
      console.log(error);
    }
  });
}

// Call the function to fetch and display popular destinations
if (document.getElementById("myAreaChart")) {
  fetchPopularDestinations();
}

// Fetch data from backend and render the chart
function fetchBookingStatusDistribution() {
  $.ajax({
      url: "/booking-status-distribution",
      type: "GET",
      success: function (data) {
          var labels = [];
          var statusCounts = [];

          data.forEach(function (item) {
              labels.push(item.status);
              statusCounts.push(item.status_count);
          });

          var ctx = document.getElementById("myPieChart").getContext('2d');
          var bookingStatusChart = new Chart(ctx, {
              type: 'pie',
              data: {
                  labels: labels,
                  datasets: [{
                      data: statusCounts,
                      backgroundColor: ['#4e73df', '#1cc88a', '#e74a3b'],
                      hoverBackgroundColor: ['#2e59d9', '#17a673', '#c0392b'],
                      hoverBorderColor: "rgba(234, 236, 244, 1)",
                  }]
              },
              options: {
                  maintainAspectRatio: false,
                  tooltips: {
                      backgroundColor: "rgb(255,255,255)",
                      bodyFontColor: "#858796",
                      borderColor: '#dddfeb',
                      borderWidth: 1,
                      xPadding: 15,
                      yPadding: 15,
                      displayColors: false,
                      caretPadding: 10,
                  },
                  legend: {
                      display: false
                  },
                  cutoutPercentage: 80,
              }
          });
      },
      error: function (error) {
          console.log(error);
      }
  });
}

// Call the function to fetch and render the chart
if (document.getElementById("myPieChart")) {
  fetchBookingStatusDistribution();
}