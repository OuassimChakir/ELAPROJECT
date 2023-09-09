<div class="tab-pane fade" id="groups" role="tabpanel" aria-labelledby="groups-tab">
    <div class="tab-widget mt-5">
        <div class="row">
            <div class="col-xl-10">
                <div class="media widget-media p-3 bg-white border">
                    <div class="icon rounded-circle mr-3 bg-primary">
                        <i class="mdi mdi-account-outline text-white "></i>
                    </div>

                    {{-- <div class="media-body align-self-center">
                        <h4 class="text-primary mb-2">
                            @if (is_null($groupes))
                                0
                            @else
                                {{ count($groupes) }}
                            @endif
                        </h4>
                        <p>Groupes Assigné</p>
                    </div> --}}
                </div>
            </div>

            <div class="col-xl-2">
                <button class="add2GroupBtn btn btn-outline-success"
                    value="{{ $student->idStudent }}" data-bs-toggle="modal"
                    data-bs-target="#add2Group" id="tab-widget-addBtn">
                    <i class="bi bi-plus-lg"></i>
                </button>
            </div>
        </div>

    </div>
</div>