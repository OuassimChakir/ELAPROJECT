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
                            <span><i class="bi bi-cash"></i></span>
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
                            <h2>Sales Report</h2>
                        </div>
                        <div class="card-body">
                            <ul class="nav nav-tabs nav-style-border justify-content-between justify-content-lg-start border-bottom"
                                role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" data-bs-toggle="tab" href="#todays" role="tab"
                                        aria-selected="true">Today's</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-bs-toggle="tab" href="#monthly" role="tab"
                                        aria-selected="false">Monthly </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-bs-toggle="tab" href="#yearly" role="tab"
                                        aria-selected="false">Yearly</a>
                                </li>
                            </ul>
                            <div class="tab-content pt-4" id="salesReport">
                                <div class="tab-pane fade show active" id="source-medium" role="tabpanel">
                                    <div class="mb-6" style="max-height:247px">
                                        <canvas id="acquisition" class="chartjs2"></canvas>
                                        <div id="acqLegend" class="customLegend mb-2"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> <!-- End Content -->
    </div> <!-- End Content Wrapper -->

@endsection