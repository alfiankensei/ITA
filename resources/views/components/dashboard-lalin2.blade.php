<div class="row mt-0">
    <div class="col-lg-9 mb-lg-0 mb-4">
        <div class="card z-index-2 h-100">
            <div class="card-header pb-0 pt-3 bg-transparent">
                <h3 class="text-capitalize">Lalin Per Jam (Jalur {{$jenisLalin}} {{request()->tanggal}} {{request()->lokasi}} )</h3>
            </div>
            <div class="card mb-3">
              <div class="card-body p-3">
                <div class="chart">
                  <canvas id="chart-line-{{$jenisLalin}}" class="chart-canvas py-2" height="400"></canvas>
                </div>
              </div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 mb-lg-0 mb-0">
        <div class="row mt-3    ">
            <div class="col-xl-12 col-sm-6 mb-xl-1 mb-4">
                <div class="card">
                    <div class="card-body p-3">
                        <div class="row">
                            <div class="col-8">
                                <div class="numbers">
                                    <p class="text-sm mb-0 text-uppercase font-weight-bold">Car</p>
                                    <h5 class="font-weight-bolder">{{$datacounter['car']}}
                                    </h5>
                                </div>
                            </div>
                            <div class="col-4 text-end">
                                <div class="icon icon-shape bg-gradient-primary shadow-primary text-center rounded-circle">
                                    <x-fas-car class="h-100 w-60"/>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-12 col-sm-6 mb-xl-1 mb-4">
                <div class="card">
                    <div class="card-body p-3">
                        <div class="row">
                            <div class="col-8">
                                <div class="numbers">
                                    <p class="text-sm mb-0 text-uppercase font-weight-bold">Bus</p>
                                    <h5 class="font-weight-bolder">{{$datacounter['bus']}}
                                    </h5>
                                </div>
                            </div>
                            <div class="col-4 text-end">
                                <div class="icon icon-shape bg-gradient-danger shadow-danger text-center rounded-circle">
                                    <x-fas-bus class="h-100 w-60"/>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-12 col-sm-6 mb-xl-1 mb-4">
                <div class="card">
                    <div class="card-body p-3">
                        <div class="row">
                            <div class="col-8">
                                <div class="numbers">
                                    <p class="text-sm mb-0 text-uppercase font-weight-bold">Truck</p>
                                    <h5 class="font-weight-bolder">
                                        {{$datacounter['truck']}}
                                    </h5>
                                </div>
                            </div>
                            <div class="col-4 text-end">
                                <div class="icon icon-shape bg-gradient-success shadow-success text-center rounded-circle">
                                    <x-fas-truck class="h-100 w-60"/>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-12 col-sm-6 mb-xl-1 mb-4">
                <div class="card">
                    <div class="card-body p-3">
                        <div class="row">
                            <div class="col-8">
                                <div class="numbers">
                                    <p class="text-sm mb-0 text-uppercase font-weight-bold">Total</p>
                                    <h5 class="font-weight-bolder">
                                        {{$datacounter['all']}}
                                    </h5>
                                </div>
                            </div>
                            <div class="col-4 text-end">
                                <div class="icon icon-shape bg-gradient-warning shadow-warning text-center rounded-circle">
                                    <x-tabler-sum class="h-100 w-60"/>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push("js-chart")
<script>
    function setChart{{$jenisLalin}}(label, data) {

        var ctx1 = document.getElementById("chart-line-{{$jenisLalin}}").getContext("2d");

        var gradientStroke1 = ctx1.createLinearGradient(35, 58, 185, 0);

        gradientStroke1.addColorStop(1, 'rgba(251, 99, 64, 0.2)');
        gradientStroke1.addColorStop(0.2, 'rgba(251, 99, 64, 0.0)');
        gradientStroke1.addColorStop(0, 'rgba(251, 99, 64, 0)');
		var bgcolors = [];
		  for (var i = 0; i <= data.length; i++) {
			console.log("data[i]", i + ': ' + data[i]);
			if (data[i]) {
			  if (parseInt(data[i]) <= 5000) {
				bgcolors.push("#008000");
			  } else if (parseInt(data[i]) <= 6600) {
				bgcolors.push("#FFC300");
			  } else {
				bgcolors.push("#800000");
			  }
			}
		  }
		new Chart(ctx1, {
        type: 'line',
        data: {
          labels: label,
          datasets: [{
            label: "Vehicles",
            data: data,
            backgroundColor: [
            'rgba(105, 0, 132, .2)',
            ],
            fill: true,
            borderColor: [
              'rgba(255, 99, 132, 0.8)',
            ],
            borderWidth: 2,
            tension: 0.4
          }],
        },
        options: {
			scales: {
            xAxes: [{
              display: true,
              scaleLabel: {
                display: true,
              }
            }],
            yAxes: [{
              display: true,
              ticks: {
                beginAtZero: true,
                steps: 100,
                stepValue: 50,
                max: 9000
              }
            }]
          },
          "hover": {
            "animationDuration": 0
          },
          "animation": {
            "duration": 1,
            "onComplete": function() {
              var chartInstance = this.chart,
                ctx = chartInstance.ctx;

              ctx.font = Chart.helpers.fontString(Chart.defaults.global.defaultFontSize, Chart.defaults.global
                .defaultFontStyle, Chart.defaults.global.defaultFontFamily);
              ctx.textAlign = 'center';
              ctx.textBaseline = 'bottom';

              this.data.datasets.forEach(function(dataset, i) {
                var meta = chartInstance.controller.getDatasetMeta(i);
                meta.data.forEach(function(bar, index) {
                  var data = dataset.data[index];
                  ctx.fillText(data, bar._model.x, bar._model.y - 5);
                });
              });
            }
          },
          responsive: true,
          maintainAspectRatio: false,
          legend: {
            "display": false
          },
          tooltips: {
            "enabled": true
          },
          plugins: {
            datalabels: {
              display: false,
            }
          },
        },
      });
        
    }

    function getChart{{$jenisLalin}}() {

        $.ajax({
                    url: "/data2/chart/{{$jenisLalin}}?tanggal={{request()->tanggal}}&lokasi={{request()->lokasi}}",
                    success: (res) => {
                        setChart{{$jenisLalin}}(res.labels, res.datasets)
                    },
                    dataType: 'json'
                });
    }
    setInterval(() => {
        console.log("Mengupdate Data /data2/{{$jenisLalin}}?tanggal={{request()->tanggal}}&lokasi={{request()->lokasi}}")
        $.ajax({
            url: "/data2/{{$jenisLalin}}?tanggal={{request()->tanggal}}&lokasi={{request()->lokasi}}",
            success: (res) => {
                $("#content-{{$jenisLalin}}").html(res)
                getChart{{$jenisLalin}}()
            },
            dataType: 'html'
        });
    }, 1000 * 60)

    getChart{{$jenisLalin}}()
    // setChart([{{implode(",", $datachart['labels'])}}], [{{implode(",", $datachart['datasets'])}}])
</script>
@endpush