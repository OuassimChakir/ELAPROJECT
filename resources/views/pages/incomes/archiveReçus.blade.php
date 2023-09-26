@extends('layouts.layout')
@section('title')
    Archive Reçus de Paiement
@endsection
@section('content')
    <div class="breadcrumb-wrapper breadcrumb-contacts">
        <div>
            <h1>Archive Reçus de Paiement</h1>
            <p class="breadcrumbs">
                <span><a href="{{ route('acceuil') }}">Acceuil</a></span>
                <span><i class="mdi mdi-chevron-right"></i></span>Archive Reçus de Paiement
            </p>
        </div>
    </div>

    <div class="row">
        <div class="col-xl-12 col-lg-12">
            <div class="ec-cat-list card card-default">

                <div class="card-body">
                    <form action="{{ route('incomePayment.archive.multiple') }}" method="post">
                        @csrf
                        @method('post')
                        <table id="responsive-data-table" class="table">
                            <thead>
                                <tr>
                                    <th><input type="checkbox" class="form-check-input" id="selectAllArchived"></th>
                                    <th>#</th>
                                    <th>Numéro</th>
                                    <th>Detail</th>
                                    <th>Etudiant</th>
                                    <th>Prix</th>
                                    <th>Etat</th>
                                    <th>Date de Reçus</th>
                                    <th>Action</th>
                                </tr>
                            </thead>

                            <tbody>
                                @if (isset($incomePayment))

                                   
                                            @php
                                                $i = 0;
                                            @endphp
                                            @foreach ($incomePayment as $Payment)
                                                <tr>
                                                    <td><input type="checkbox" name="archivedPayment[]" value="{{$Payment->idPayment}}" class="form-check-input archivedPayment"></td>
                                                    <td>{{ ++$i }}</td>
                                                    @if (is_null($Payment->numeroRecu))
                                                        <td>BMA-N°-</td>
                                                    @else
                                                        <td>BMA-N°{{ $Payment->numeroRecu }}</td>
                                                    @endif
                                                    <td>
                                                        <p>{{ $Payment->note }}</p>
                                                    </td>
                                                    <td>
                                                        @if (!is_null($Payment->idStudent))
                                                            <a
                                                                href="{{ route('student.profil', ['idStudent' => $Payment->idStudent]) }}">
                                                                {{ $Payment->prenom_ar }} {{ strtoupper($Payment->nom_fr) }}
                                                            </a>
                                                        @else
                                                            -
                                                        @endif

                                                    </td>
                                                    <td><span class="badge badge-dark">{{ $Payment->amount }} DH</span></td>
                                                    <td>
                                                        @if ($Payment->etat == 0)
                                                            <span class="badge badge-warning">Impayée</span>
                                                        @elseif($Payment->etat == 1)
                                                            <span class="badge badge-success">Réglée</span>
                                                        @endif
                                                    </td>
                                                    <td>{{ $Payment->datePayment }}</td>
                                                    <td>
                                                        <div class="btn-group-spaced">
                                                            <a
                                                                href="{{ route('incomePayment.archive.restore', ['idPayment' => $Payment->idPayment]) }}">
                                                                <button type="button" name="show"
                                                                    class="btn btn-outline-success"
                                                                    value="{{ $Payment->idPayment }}"
                                                                    onclick="return confirm('Vous êtes sûr?');">
                                                                    <i class="bi bi-arrow-repeat"></i>
                                                                </button>
                                                            </a>
                                                            <a
                                                                href="{{ route('incomePayment.archive.delete', ['idPayment' => $Payment->idPayment]) }}">
                                                                <button type="button" class="btn btn-outline-danger"
                                                                    name="delete" value="{{ $Payment->idPayment }}"
                                                                    onclick="return confirm('Voulez-vous supprimer définitivement cet reçus?');">
                                                                    <i class="bi bi-trash-fill"></i>
                                                                </button>
                                                            </a>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @endif
                            </tbody>
                        </table>
                        <div class="row">
                            <div class="col btns">
                                <button type="submit" name="restoreAll" class="btn btn-outline-success"
                                    onclick="return confirm('Vous êtes sûr?');">
                                    <i class="bi bi-arrow-repeat"></i> Restaurer la Sélection
                                </button>
                                <button type="submit" name="deleteAll" class="btn btn-outline-danger"
                                    onclick="return confirm('Voulez-vous supprimer définitivement ces Reçus?');">
                                    <i class="bi bi-trash-fill"></i> Supprimer la Sélection
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('JS/jquery.min.js') }}"></script>
    <script src="{{ asset('Bootstrap/js/bootstrap.min.js') }}"></script>
    <script>
        // Listen for click on toggle checkbox
        $('#selectAllArchived').click(function(event) {
            if (this.checked) {
                // Iterate each checkbox
                $(':checkbox').each(function() {
                    this.checked = true;
                });
            } else {
                $(':checkbox').each(function() {
                    this.checked = false;
                });
            }
        });
        $(document).ready(function() {
            $('#responsive-data-table tr').click(function(event) {
                if (event.target.type !== 'checkbox') {
                    $(':checkbox', this).trigger('click');
                }
            });
        });

        $(".btns").hide();
        $(":checkbox").click(function() {
            if ($(this).is(":checked")) {
                $(".btns").show();
            } else {
                $(".btns").hide();
            }
        });
    </script>
@endsection
