<div class="tab-pane fade show active" id="profile" role="tabpanel" aria-labelledby="profile-tab">
    <div class="tab-widget mt-5">
        <div class="row">
            <div class="col-xl-6">
                <div class="media widget-media p-3 bg-white border">
                    <div class="icon rounded-circle mr-3 bg-primary">
                        <i class="mdi mdi-account-outline text-white "></i>
                    </div>

                    <div class="media-body align-self-center">
                        <h4 class="text-primary mb-2">546</h4>
                        <p>Bought</p>
                    </div>
                </div>
            </div>

            <div class="col-xl-6">
                <div class="media widget-media p-3 bg-white border">
                    <div class="icon rounded-circle mr-3 bg-success">
                        <i class="mdi mdi-ticket-percent text-white "></i>
                    </div>

                    <div class="media-body align-self-center">
                        <h4 class="text-primary mb-2">02</h4>
                        <p>Voucher</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-xl-12">

                <div class="card card-default mb-24px">
                    <div class="card-header justify-content-between mb-1">
                        <h2>Factures</h2>
                        <div>
                            <button class="text-black-50 mr-2 font-size-20"><i class="mdi mdi-cached"></i></button>
                        </div>

                    </div>
                        <div class="card-body compact-notifications" data-simplebar style="height: auto;">
                            @if (isset($pendingPaiment))
                                @foreach ($pendingPaiment as $item)
                                    <div class="media pb-3 align-items-center justify-content-between">
                                        <div class="d-flex rounded-circle align-items-center justify-content-center mr-3 media-icon iconbox-45 bg-danger text-white">
                                            <span class="mdi mdi-receipt"></span>
                                        </div>
                                        <div class="media-body pr-3 ">
                                            <a class="mt-0 mb-1 font-size-15 text-dark" href="{{route('groups.profil',['idGroup' => $item->idGroup ])}}">Facture: {{ $item->designation }}</a> <span class="badge badge-danger">{{$item->amount - $item->amountPaid}} DH</span>

                                            <p>{{ $item->note }}</p>
                                        </div>
                                        <span class=" font-size-12 d-inline-block">
                                            <a href="{{route('paiment', ['idPayment' => $item->idPayment])}}">
                                                <button class="btn btn-outline-success"><span class="mdi mdi-check"></span></button>
                                            </a>
                                        </span>
                                    </div>
                                @endforeach
                            @endif

                        </div>
                    <div class="mt-3"></div>
                </div>

            </div>

            <div class="col-12">
                <!-- Recent Order Table -->
                <div class="card card-default card-table-border-none ec-tbl" id="recent-orders">
                    <div class="card-header justify-content-between">
                        <h2>Présence</h2>

                        <div class="date-range-report">
                            <span></span>
                        </div>
                    </div>

                    <div class="card-body pt-0 pb-0 table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Order_ID</th>
                                    <th>Product_Name</th>
                                    <th>Units</th>
                                    <th>Order_Date</th>
                                    <th>Order_Cost</th>
                                    <th>Status</th>
                                    <th></th>
                                </tr>
                            </thead>

                            <tbody>
                                <tr>
                                    <td>24541</td>
                                    <td>
                                        <a class="text-dark" href=""> Coach
                                            Swagger</a>
                                    </td>
                                    <td>1 Unit</td>
                                    <td>Oct 20, 2018</td>
                                    <td>$230</td>
                                    <td>
                                        <span class="badge badge-success">Completed</span>
                                    </td>
                                    <td class="text-right">
                                        <div class="dropdown show d-inline-block widget-dropdown">
                                            <a class="dropdown-toggle icon-burger-mini" href="" role="button"
                                                id="dropdown-recent-order1" data-bs-toggle="dropdown"
                                                aria-haspopup="true" aria-expanded="false" data-display="static"></a>

                                            <ul class="dropdown-menu dropdown-menu-right"
                                                aria-labelledby="dropdown-recent-order1">
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
                                        <a class="text-dark" href=""> Toddler
                                            Shoes, Gucci Watch</a>
                                    </td>
                                    <td>2 Units</td>
                                    <td>Nov 15, 2018</td>
                                    <td>$550</td>
                                    <td>
                                        <span class="badge badge-warning">Delayed</span>
                                    </td>
                                    <td class="text-right">
                                        <div class="dropdown show d-inline-block widget-dropdown">
                                            <a class="dropdown-toggle icon-burger-mini" href="#" role="button"
                                                id="dropdown-recent-order2" data-bs-toggle="dropdown"
                                                aria-haspopup="true" aria-expanded="false" data-display="static"></a>

                                            <ul class="dropdown-menu dropdown-menu-right"
                                                aria-labelledby="dropdown-recent-order2">
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
                                        <a class="text-dark" href=""> Hat Black
                                            Suits</a>
                                    </td>
                                    <td>1 Unit</td>
                                    <td>Nov 18, 2018</td>
                                    <td>$325</td>
                                    <td>
                                        <span class="badge badge-warning">On
                                            Hold</span>
                                    </td>
                                    <td class="text-right">
                                        <div class="dropdown show d-inline-block widget-dropdown">
                                            <a class="dropdown-toggle icon-burger-mini" href="#" role="button"
                                                id="dropdown-recent-order3" data-bs-toggle="dropdown"
                                                aria-haspopup="true" aria-expanded="false" data-display="static"></a>

                                            <ul class="dropdown-menu dropdown-menu-right"
                                                aria-labelledby="dropdown-recent-order3">
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
                                        <a class="text-dark" href=""> Backpack
                                            Gents, Swimming Cap Slin</a>
                                    </td>
                                    <td>5 Units</td>
                                    <td>Dec 13, 2018</td>
                                    <td>$200</td>
                                    <td>
                                        <span class="badge badge-success">Completed</span>
                                    </td>
                                    <td class="text-right">
                                        <div class="dropdown show d-inline-block widget-dropdown">
                                            <a class="dropdown-toggle icon-burger-mini" href="#" role="button"
                                                id="dropdown-recent-order4" data-bs-toggle="dropdown"
                                                aria-haspopup="true" aria-expanded="false" data-display="static"></a>

                                            <ul class="dropdown-menu dropdown-menu-right"
                                                aria-labelledby="dropdown-recent-order4">
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
                                        <a class="text-dark" href=""> Speed 500
                                            Ignite</a>
                                    </td>
                                    <td>1 Unit</td>
                                    <td>Dec 23, 2018</td>
                                    <td>$150</td>
                                    <td>
                                        <span class="badge badge-danger">Cancelled</span>
                                    </td>
                                    <td class="text-right">
                                        <div class="dropdown show d-inline-block widget-dropdown">
                                            <a class="dropdown-toggle icon-burger-mini" href="#" role="button"
                                                id="dropdown-recent-order5" data-bs-toggle="dropdown"
                                                aria-haspopup="true" aria-expanded="false" data-display="static"></a>
                                            <ul class="dropdown-menu dropdown-menu-right"
                                                aria-labelledby="dropdown-recent-order5">
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
    </div>
</div>
