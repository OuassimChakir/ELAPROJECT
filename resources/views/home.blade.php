@extends('layouts.layout')
@section('title')
    Acceuil
@endsection
@section('content')
	<!--  WRAPPER  -->
    <div class="ec-content-wrapper">
        <div class="content">
            <!-- Top Statistics -->
            <div class="row">
                <div class="col-xl-3 col-sm-6 p-b-15 lbl-card">
                    <div class="card card-mini dash-card card-1">
                        <div class="card-body">
                            <h2 class="mb-1">{{$students}}</h2>
                            <p>Les étudiants</p>
                            <span class="mdi mdi-account-arrow-left"></span>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-sm-6 p-b-15 lbl-card">
                    <div class="card card-mini dash-card card-2">
                        <div class="card-body">
                            <h2 class="mb-1">{{$NumGroups}}</h2>
                            <p>Les groups</p>
                            <span class="mdi mdi-content-paste"></span>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-sm-6 p-b-15 lbl-card">
                    <div class="card card-mini dash-card card-3">
                        <div class="card-body">
                            <h2 class="mb-1">{{$Factures}} DH</h2>
                            <p>Les dépenses</p>
                            <span><i class="bi bi-wallet2"></i></span>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-sm-6 p-b-15 lbl-card">
                    <div class="card card-mini dash-card card-4">
                        <div class="card-body">
                            <h2 class="mb-1">{{$Payments}} DH</h2>
                            <p>Les revenus</p>
                            <span class="mdi mdi-currency-usd"></span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-xl-8 col-md-12 p-b-15">
                    <!-- Sales Graph -->
                    <div id="user-acquisition" class="card card-default">
                        <div class="card-header">
                            <h2>Rapport des dépense et revenus</h2>
                        </div>
                        <div class="card-body">
                            <ul class="nav nav-tabs nav-style-border justify-content-between justify-content-lg-start border-bottom"
                                role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" data-bs-toggle="tab" href="#todays" role="tab"
                                        aria-selected="true">{{$scolareYears[0]}} - {{$scolareYears[1]}}</a>
                                </li>
                            </ul>
                            <div class="tab-content pt-4" id="salesReport">
                                <div class="tab-pane fade show active" id="source-medium" role="tabpanel">
                                    <div class="mb-6" style="max-height:247px">
                                        <canvas id="salesChart" class="chartjs2"></canvas>
                                        <div id="salesLegend" class="customLegend mb-2"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-4 col-md-12 p-b-15">
                    <!-- Doughnut Chart -->
                    <div class="card card-default">
                        <div class="card-header justify-content-center">
                            <h2>Orders Overview</h2>
                        </div>
                        <div class="card-body">
                            <canvas id="doChart"></canvas>
                        </div>
                        <a href="#" class="pb-5 d-block text-center text-muted"><i
                                class="mdi mdi-download mr-2"></i> Download overall report</a>
                        <div class="card-footer d-flex flex-wrap bg-white p-0">
                            <div class="col-6">
                                <div class="p-20">
                                    <ul class="d-flex flex-column justify-content-between">
                                        <li class="mb-2"><i class="mdi mdi-checkbox-blank-circle-outline mr-2"
                                                style="color: #4c84ff"></i>Order Completed</li>
                                        <li class="mb-2"><i class="mdi mdi-checkbox-blank-circle-outline mr-2"
                                                style="color: #80e1c1 "></i>Order Unpaid</li>
                                        <li><i class="mdi mdi-checkbox-blank-circle-outline mr-2"
                                                style="color: #ff7b7b "></i>Order returned</li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-6 border-left">
                                <div class="p-20">
                                    <ul class="d-flex flex-column justify-content-between">
                                        <li class="mb-2"><i class="mdi mdi-checkbox-blank-circle-outline mr-2"
                                                style="color: #8061ef"></i>Order Pending</li>
                                        <li class="mb-2"><i class="mdi mdi-checkbox-blank-circle-outline mr-2"
                                                style="color: #ffa128"></i>Order Canceled</li>
                                        <li><i class="mdi mdi-checkbox-blank-circle-outline mr-2"
                                                style="color: #7be6ff"></i>Order Broken</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-xl-8 col-md-12 p-b-15">
                    <!-- User activity statistics -->
                    <div class="card card-default" id="user-activity">
                        <div class="no-gutters">
                            <div>
                                <div class="card-header justify-content-between">
                                    <h2>User Activity</h2>
                                    <div class="date-range-report ">
                                        <span></span>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="tab-content" id="userActivityContent"> 
                                        <div class="tab-pane fade show active" id="user" role="tabpanel">
                                            <canvas id="activity" class="chartjs"></canvas>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer d-flex flex-wrap bg-white border-top">
                                    <a href="#" class="text-uppercase py-3">In-Detail Overview</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-md-12 p-b-15">
                    <div class="card card-default">
                        <div class="card-header flex-column align-items-start">
                            <h2>Current Users</h2>
                        </div>
                        <div class="card-body">
                            <canvas id="currentUser" class="chartjs"></canvas>
                        </div>
                        <div class="card-footer d-flex flex-wrap bg-white border-top">
                            <a href="#" class="text-uppercase py-3">In-Detail Overview</a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12 p-b-15">
                    <!-- Recent Order Table -->
                    <div class="card card-table-border-none card-default recent-orders" id="recent-orders">
                        <div class="card-header justify-content-between">
                            <h2>Recent Orders</h2>
                            <div class="date-range-report">
                                <span></span>
                            </div>
                        </div>
                        <div class="card-body pt-0 pb-5">
                            <table class="table card-table table-responsive table-responsive-large"
                                style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Order ID</th>
                                        <th>Product Name</th>
                                        <th class="d-none d-lg-table-cell">Units</th>
                                        <th class="d-none d-lg-table-cell">Order Date</th>
                                        <th class="d-none d-lg-table-cell">Order Cost</th>
                                        <th>Status</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>24541</td>
                                        <td>
                                            <a class="text-dark" href=""> Coach Swagger</a>
                                        </td>
                                        <td class="d-none d-lg-table-cell">1 Unit</td>
                                        <td class="d-none d-lg-table-cell">Oct 20, 2018</td>
                                        <td class="d-none d-lg-table-cell">$230</td>
                                        <td>
                                            <span class="badge badge-success">Completed</span>
                                        </td>
                                        <td class="text-right">
                                            <div class="dropdown show d-inline-block widget-dropdown">
                                                <a class="dropdown-toggle icon-burger-mini" href=""
                                                    role="button" id="dropdown-recent-order1"
                                                    data-bs-toggle="dropdown" aria-haspopup="true"
                                                    aria-expanded="false" data-display="static"></a>
                                                <ul class="dropdown-menu dropdown-menu-right">
                                                    <li class="dropdown-item">
                                                        <a href="#">View</a>
                                                    </li>
                                                    <li class="dropdown-item">
                                                        <a href="#">Remove</a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>24541</td>
                                        <td>
                                            <a class="text-dark" href=""> Toddler Shoes, Gucci Watch</a>
                                        </td>
                                        <td class="d-none d-lg-table-cell">2 Units</td>
                                        <td class="d-none d-lg-table-cell">Nov 15, 2018</td>
                                        <td class="d-none d-lg-table-cell">$550</td>
                                        <td>
                                            <span class="badge badge-primary">Delayed</span>
                                        </td>
                                        <td class="text-right">
                                            <div class="dropdown show d-inline-block widget-dropdown">
                                                <a class="dropdown-toggle icon-burger-mini" href="#"
                                                    role="button" id="dropdown-recent-order2"
                                                    data-bs-toggle="dropdown" aria-haspopup="true"
                                                    aria-expanded="false" data-display="static"></a>
                                                <ul class="dropdown-menu dropdown-menu-right">
                                                    <li class="dropdown-item">
                                                        <a href="#">View</a>
                                                    </li>
                                                    <li class="dropdown-item">
                                                        <a href="#">Remove</a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>24541</td>
                                        <td>
                                            <a class="text-dark" href=""> Hat Black Suits</a>
                                        </td>
                                        <td class="d-none d-lg-table-cell">1 Unit</td>
                                        <td class="d-none d-lg-table-cell">Nov 18, 2018</td>
                                        <td class="d-none d-lg-table-cell">$325</td>
                                        <td>
                                            <span class="badge badge-warning">On Hold</span>
                                        </td>
                                        <td class="text-right">
                                            <div class="dropdown show d-inline-block widget-dropdown">
                                                <a class="dropdown-toggle icon-burger-mini" href="#"
                                                    role="button" id="dropdown-recent-order3"
                                                    data-bs-toggle="dropdown" aria-haspopup="true"
                                                    aria-expanded="false" data-display="static"></a>
                                                <ul class="dropdown-menu dropdown-menu-right">
                                                    <li class="dropdown-item">
                                                        <a href="#">View</a>
                                                    </li>
                                                    <li class="dropdown-item">
                                                        <a href="#">Remove</a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>24541</td>
                                        <td>
                                            <a class="text-dark" href=""> Backpack Gents, Swimming Cap Slin</a>
                                        </td>
                                        <td class="d-none d-lg-table-cell">5 Units</td>
                                        <td class="d-none d-lg-table-cell">Dec 13, 2018</td>
                                        <td class="d-none d-lg-table-cell">$200</td>
                                        <td>
                                            <span class="badge badge-success">Completed</span>
                                        </td>
                                        <td class="text-right">
                                            <div class="dropdown show d-inline-block widget-dropdown">
                                                <a class="dropdown-toggle icon-burger-mini" href="#"
                                                    role="button" id="dropdown-recent-order4"
                                                    data-bs-toggle="dropdown" aria-haspopup="true"
                                                    aria-expanded="false" data-display="static"></a>
                                                <ul class="dropdown-menu dropdown-menu-right">
                                                    <li class="dropdown-item">
                                                        <a href="#">View</a>
                                                    </li>
                                                    <li class="dropdown-item">
                                                        <a href="#">Remove</a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>24541</td>
                                        <td>
                                            <a class="text-dark" href=""> Speed 500 Ignite</a>
                                        </td>
                                        <td class="d-none d-lg-table-cell">1 Unit</td>
                                        <td class="d-none d-lg-table-cell">Dec 23, 2018</td>
                                        <td class="d-none d-lg-table-cell">$150</td>
                                        <td>
                                            <span class="badge badge-danger">Cancelled</span>
                                        </td>
                                        <td class="text-right">
                                            <div class="dropdown show d-inline-block widget-dropdown">
                                                <a class="dropdown-toggle icon-burger-mini" href="#"
                                                    role="button" id="dropdown-recent-order5"
                                                    data-bs-toggle="dropdown" aria-haspopup="true"
                                                    aria-expanded="false" data-display="static"></a>
                                                <ul class="dropdown-menu dropdown-menu-right">
                                                    <li class="dropdown-item">
                                                        <a href="#">View</a>
                                                    </li>
                                                    <li class="dropdown-item">
                                                        <a href="#">Remove</a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div> <!-- End Content -->
    </div> <!-- End Content Wrapper -->
    <script src="{{asset('assets/plugins/charts/Chart.min.js')}}"></script>
    <script src="{{asset('assets/js/chart.js')}}"></script>
    <script>
        
        var acquisition = document.getElementById("salesChart");
        if (acquisition !== null) {
            var acqData = [
            {
                first: [{{implode(',',$depenses)}}],
                second: [{{implode(',',$inconespayment)}}]
            }
            ];

            var configAcq = {
            // The type of chart we want to create
            type: "line",

            // The data for our dataset
            data: {
                labels: [
                "Sept",
                "Oct",
                "Nov",
                "Déc",
                "Janv",
                "Févr",
                "Mars",
                "Avr",
                "Mai",
                "Juin",
                "juill",
                "Août"
                ],
                datasets: [
                {
                    label: "Dépenses",
                    backgroundColor: "rgba(52, 116, 212, .2)",
                    borderColor: "rgba(52, 116, 212, .7)",
                    data: acqData[0].first,
                    lineTension: 0.3,
                    pointBackgroundColor: "rgba(52, 116, 212,0)",
                    pointHoverBackgroundColor: "rgba(52, 116, 212,1)",
                    pointHoverRadius: 3,
                    pointHitRadius: 30,
                    pointBorderWidth: 2,
                    pointStyle: "rectRounded"
                },
                {
                    label: "Revenus",
                    backgroundColor: "rgba(255, 192, 203, .3)",
                    borderColor: "rgba(255, 192, 203, .7)",
                    data: acqData[0].second,
                    lineTension: 0.3,
                    pointBackgroundColor: "rgba(255, 192, 203, 0)",
                    pointHoverBackgroundColor: "rgba(255, 192, 203, 1)",
                    pointHoverRadius: 3,
                    pointHitRadius: 30,
                    pointBorderWidth: 2,
                    pointStyle: "rectRounded"
                }
                ]
            },

            // Configuration options go here
            options: {
                responsive: true,
                maintainAspectRatio: false,
                legend: {
                display: false
                },
                scales: {
                xAxes: [
                    {
                    gridLines: {
                        display: false
                    }
                    }
                ],
                yAxes: [
                    {
                    gridLines: {
                        display: true,
                        color: "#eee",
                        zeroLineColor: "#eee"
                    },
                    ticks: {
                        beginAtZero: true,
                        stepSize: 100,
                        max: {{ $max }},
                    }
                    }
                ]
                },
                tooltips: {
                mode: "index",
                titleFontColor: "#888",
                bodyFontColor: "#555",
                titleFontSize: 12,
                bodyFontSize: 15,
                backgroundColor: "rgba(256,256,256,0.95)",
                displayColors: true,
                xPadding: 20,
                yPadding: 10,
                borderColor: "rgba(220, 220, 220, 0.9)",
                borderWidth: 2,
                caretSize: 10,
                caretPadding: 15
                }
            }
            };

            var ctx = document.getElementById("salesChart").getContext("2d");
            var lineAcq = new Chart(ctx, configAcq);
            document.getElementById("salesLegend").innerHTML = lineAcq.generateLegend();

            var items = document.querySelectorAll(
            "#user-acquisition .nav-tabs .nav-item"
            );
            items.forEach(function (item, index) {
            item.addEventListener("click", function() {
                configAcq.data.datasets[0].data = acqData[index].first;
                configAcq.data.datasets[1].data = acqData[index].second;
                configAcq.data.datasets[2].data = acqData[index].third;
                lineAcq.update();
            });
            });
        }
    </script>
@endsection