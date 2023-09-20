<div class="tab-pane fade show active" id="profile" role="tabpanel" aria-labelledby="profile-tab">
    <div class="tab-widget mt-5">
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
                                    @if (is_null($item->idGroup))
                                    <div class="media pb-3 align-items-center justify-content-between">
                                        <div class="d-flex rounded-circle align-items-center justify-content-center mr-3 media-icon iconbox-45 bg-danger text-white">
                                            <span class="mdi mdi-receipt"></span>
                                        </div>
                                        <div class="media-body pr-3 ">
                                            <a class="mt-0 mb-1 font-size-15 text-dark" href="#">Facture: {{ $item->description }}</a> <span class="badge badge-danger">{{$item->amount - $item->amountPaid}} DH</span>

                                            <p>{{ $item->note }}</p>
                                        </div>
                                        <span class=" font-size-12 d-inline-block">
                                            <button class="btn btn-outline-success payInvoiceBtn" data-bs-toggle="modal"
                                            data-bs-target="#invoicePaiment" value="{{$item->idPayment}}"><span class="mdi mdi-check"></span></button>
                                        </span>
                                    </div>
                                    @else
                                    <div class="media pb-3 align-items-center justify-content-between">
                                        <div class="d-flex rounded-circle align-items-center justify-content-center mr-3 media-icon iconbox-45 bg-danger text-white">
                                            <span class="mdi mdi-receipt"></span>
                                        </div>
                                        <div class="media-body pr-3 ">
                                            <a class="mt-0 mb-1 font-size-15 text-dark" href="{{route('groups.profil',['idGroup' => $item->idGroup ])}}">Facture: {{ $item->designation }}</a> <span class="badge badge-danger">{{$item->amount - $item->amountPaid}} DH</span>

                                            <p>{{ $item->note }}</p>
                                        </div>
                                        <span class=" font-size-12 d-inline-block">
                                                <button class="btn btn-outline-success payInvoiceBtn" data-bs-toggle="modal"
                                                data-bs-target="#invoicePaiment" value="{{$item->idPayment}}"><span class="mdi mdi-check"></span></button>
                                        </span>
                                    </div>
                                    @endif 
                                @endforeach
                            @endif

                        </div>
                    <div class="mt-3"></div>
                </div>

            </div>
        </div>
    </div>
</div>
@include('pages.incomes.paimentModal')