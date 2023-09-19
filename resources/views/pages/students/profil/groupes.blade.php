<div class="tab-pane fade" id="groups" role="tabpanel" aria-labelledby="groups-tab">
    <div class="tab-widget mt-5">
        <div class="row mb-2">
            <div class="col-xl-10">
                <div class="media widget-media p-3 bg-white border">
                    <div class="icon rounded-circle mr-3 bg-primary">
                        <i class="mdi mdi-account-outline text-white "></i>
                    </div>

                    <div class="media-body align-self-center">
                        <h4 class="text-primary mb-2">
                            {{ $studentGroups->count() }}
                        </h4>
                        <p>Groupes Assigné</p>
                    </div>
                </div>
            </div>

            <div class="col-xl-2">
                <button class="add2GroupBtn btn btn-outline-success" value="{{ $student->idStudent }}"
                    data-bs-toggle="modal" data-bs-target="#add2Group" id="tab-widget-addBtn">
                    <i class="bi bi-plus-lg"></i>
                </button>
            </div>
        </div>

        {{-- Groups --}}
        <div class="card card-default mb-24px">
            <div class="card-header justify-content-between mb-1">
                <h2>Groupes</h2>
            </div>

            <div class="card-body compact-notifications" data-simplebar style="height: auto;">
                @foreach ($studentGroups as $group)
                <div class="media pb-3 align-items-center justify-content-between">
                    <div
                        class="d-flex rounded-circle align-items-center justify-content-center mr-3 media-icon iconbox-45 bg-primary text-white">
                        {{$group->shortForm}}
                    </div>
                    <div class="media-body pr-3 ">
                        <a class="mt-0 mb-1 font-size-15 text-dark" href="{{route('groups.profil', ['idGroup' => $group->idGroup])}}" target="_blank">Groupe: {{$group->designation}}</a> <span  class="badge badge-dark">{{$group->nbElements}}/{{$group->capacity}}</span>

                        <p>{{$group->prenom}} {{$group->nom}}</p>
                    </div>
                    <span class=" font-size-12 d-inline-block">
                        <button class="btn btn-outline-danger" onclick="cancelAssignment({{$group->idElement}});"><span class="mdi mdi-delete"></span></button>
                    </span>
                </div>
                @endforeach
    
            </div>
            <div class="mt-3"></div>
        </div>

    </div>
</div>

<script>
    function cancelAssignment(idElement){
        var id = idElement;
        Swal.fire({
            icon: "error",
            title: "Voulez-vous retirer cet étudiant de ce groupe ?",
            showCancelButton: true,
            confirmButtonText: 'Oui',
            cancelButtonText: `Annuler`,
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = "/classrooms/remove/"+id;
            }
        })
    }
</script>
