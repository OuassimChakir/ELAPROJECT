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
                                        <div
                                            class="d-flex rounded-circle align-items-center justify-content-center mr-3 media-icon iconbox-45 bg-danger text-white">
                                            <span class="mdi mdi-receipt"></span>
                                        </div>
                                        <div class="media-body pr-3 ">
                                            Facture: {{ $item->description }} <span class="badge badge-danger">{{$item->amount - $item->amountPaid}} DH</span>

                                            <p>{{ $item->note }}</p>
                                        </div>
                                        @staff
                                        <span class=" font-size-12 d-inline-block">
                                                <button class="btn btn-outline-success payInvoiceBtn"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#invoicePaiment"
                                                        value="{{$item->idPayment}}">
                                                    <span class="mdi mdi-check"></span>
                                                </button>
                                            </span>
                                        @endstaff
                                    </div>
                                @else
                                    @if ($item->etat == 2)
                                        <div class="media pb-3 align-items-center justify-content-between">
                                            <div
                                                class="d-flex rounded-circle align-items-center justify-content-center mr-3 media-icon iconbox-45 bg-dark text-white">
                                                <span class="mdi mdi-receipt"></span>
                                            </div>
                                            <div class="media-body pr-3 ">
                                                <a class="mt-0 mb-1 font-size-15 text-dark"
                                                   href="{{route('groups.profil',['idGroup' => $item->idGroup ])}}">Facture: {{ $item->designation }}</a>
                                                <span
                                                    class="badge badge-dark">{{$item->amount - $item->amountPaid}} DH</span>

                                                <p>{{ $item->note }}</p>
                                            </div>
                                            @staff
                                            <span class=" font-size-12 d-inline-block">
                                                    <button class="btn btn-outline-warning activateInvoice"
                                                            value="{{$item->idPayment}}"><span
                                                            class="mdi mdi-lock-open-outline"></span></button>
                                                </span>
                                            @endstaff
                                        </div>
                                    @else
                                        <div class="media pb-3 align-items-center justify-content-between">
                                            <div
                                                class="d-flex rounded-circle align-items-center justify-content-center mr-3 media-icon iconbox-45 bg-danger text-white">
                                                <span class="mdi mdi-receipt"></span>
                                            </div>
                                            <div class="media-body pr-3 ">
                                                <a class="mt-0 mb-1 font-size-15 text-dark"
                                                   href="{{route('groups.profil',['idGroup' => $item->idGroup ])}}">Facture: {{ $item->designation }}</a>
                                                <span class="badge badge-danger">{{$item->amount - $item->amountPaid}} DH</span>

                                                <p>{{ $item->note }}</p>
                                            </div>
                                            @staff
                                            <span class=" font-size-12 d-inline-block">
                                                        <button class="btn btn-outline-success payInvoiceBtn"
                                                                data-bs-toggle="modal"
                                                                data-bs-target="#invoicePaiment"
                                                                value="{{$item->idPayment}}"><span
                                                                class="mdi mdi-check"></span></button>
                                                </span>
                                            @endstaff
                                        </div>
                                    @endif
                                @endif
                            @endforeach
                        @endif

                    </div>
                    <div class="mt-3"></div>
                </div>

                <div class="card card-default mb-24px">
                    <div class="card-header justify-content-between mb-1">
                        <h2>Remarques</h2>
                    </div>
                    <div class="card-body compact-notifications" data-simplebar style="height: auto;">
                        @if (isset($notes))
                            @foreach ($notes as $note)
                                @php
                                    $date = date_create($note->created_at)
                                @endphp
                                <div class="media pb-3 align-items-center justify-content-between">
                                    <div class="media-body pr-3 ">
                                        <a class="mt-0 mb-1 font-size-15 text-dark">Note du
                                            Group: {{ $note->designation }}</a> <span class="badge badge-primary"><i
                                                class="mdi mdi-clock-outline"></i> {{date_format($note->created_at,'d-m-Y')}}</span>

                                        <p>{{ $note->note }}</p>
                                    </div>
                                    @staff
                                    <span class=" font-size-12 d-inline-block">
                                            <button class="deleteNote btn btn-outline-danger" value="{{$note->idNote}}"><span
                                                    class="mdi mdi-delete"></span></button>
                                        </span>
                                    @endstaff
                                </div>
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
