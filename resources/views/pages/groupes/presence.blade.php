@extends('layouts.layout')
@section('title')
    Absence
@endsection
@section('content')

    <div class="breadcrumb-wrapper breadcrumb-contacts">
        <div>
            <h1>Presence</h1>
            <p class="breadcrumbs">
                <span><a href="{{ route('acceuil') }}">Acceuil</a></span>
                <span><i class="mdi mdi-chevron-right"></i></span><a href="{{ route('groups') }}">Groupes</a>
            </p>
        </div>
    </div>


    <div class="card bg-white profile-content">
        <div class="row">
            <div class="col-lg-12 col-xl-12">
                <div class="profile-content-right profile-right-spacing py-5">
                    <div class="tab-content px-3 px-xl-5" id="myTabContent">
                        <div class="modal-body px-2">
                            <form action="{{ route('getAttendance') }}" method="post">
                                @csrf
                                @method('post')
                                <div class="row">
                                    <div class="col-lg-5">
                                        <div class="form-group ">
                                            <label for="form-label">Groupes</label>
                                            <select name="idGroup" id="id-Group" class="form-select" required>
                                                <option disabled selected>-- Choisir un Groupe --</option>
                                                @foreach ($groups as $group)
                                                    @if (isset($idGroup))
                                                        @if ($group->idGroup == $idGroup)
                                                        <option value="{{ $group->idGroup }}" selected>{{ $group->designation }}</option>
                                                        @else
                                                        <option value="{{ $group->idGroup }}">{{ $group->designation }}</option>
                                                        @endif
                                                    @else
                                                    <option value="{{ $group->idGroup }}">{{ $group->designation }}</option>
                                                    @endif
                                                @endforeach
                                                
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-5">
                                        <div class="form-group">
                                            <label for="form-label">Date</label>
                                            @if (isset($dateAbsence))
                                            <input type="month" name="dateAbsence" class="form-control" value="{{$dateAbsence[0]}}-{{$dateAbsence[1]}}">
                                            @else
                                            <input type="month" name="dateAbsence" class="form-control" value="{{ date('Y-m') }}">
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-lg-2 mt-5">
                                        <button type="submit" name="getAttendance" class="btn btn-secondary btn-pill">Recherche</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                </div>
                @if (isset($studentsAttendance))
                    <div id="attendanceCalendier" style="overflow-x:auto;">
                        <table class="table table-bordered table-hover">
                            <tbody>
                                <tr>
                                    <td></td>
                                    @for ($i = 1; $i <= cal_days_in_month(CAL_GREGORIAN, date('m'), date('Y')); $i++)
                                        <td>{{ $i }}</td>
                                    @endfor
                                </tr>
                                @foreach ($studentsAttendance as $student)
                                    <tr>
                                        <th>{{ ucfirst($student->prenom_fr) }} {{ ucfirst($student->nom_fr) }}</th>
                                        @for ($i = 1; $i <= cal_days_in_month(CAL_GREGORIAN, $dateAbsence[1], $dateAbsence[0]); $i++)
                                            @if (is_null($student->attendance))
                                                <td></td>
                                            @else
                                                @php $flag = 0; @endphp
                                                @foreach ($student->attendance as $item)
                                                    @if ($item->day == $i)
                                                        @if ($item->absence == 0)
                                                            <td class="bg-success"></td>
                                                        @elseif($item->absence == 1)
                                                            <td class="bg-danger"></td>
                                                        @else
                                                            <td class="bg-warning"></td>
                                                        @endif
                                                        @php $flag = 1; @endphp
                                                        @break;
                                                    @endif
                                                @endforeach
                                                @if ($flag == 0)
                                                    <td></td>
                                                @endif
                                            @endif
                                        @endfor
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @elseif(isset($student))
                <div id="attendanceCalendier" style="overflow-x:auto;">
                    <table class="table table-bordered table-hover">
                        <tbody>
                            <tr>
                                <td></td>
                                @for ($i = 1; $i <= cal_days_in_month(CAL_GREGORIAN, date('m'), date('Y')); $i++)
                                    <td>{{ $i }}</td>
                                @endfor
                            </tr>
                                <tr>
                                    <th>{{ ucfirst($student->prenom_fr) }} {{ ucfirst($student->nom_fr) }}</th>
                                    @for ($i = 1; $i <= cal_days_in_month(CAL_GREGORIAN, $dateAbsence[1], $dateAbsence[0]); $i++)
                                        @if (is_null($student->attendance))
                                            <td></td>
                                        @else
                                            @php $flag = 0; @endphp
                                            @foreach ($student->attendance as $item)
                                                @if ($item->day == $i)
                                                    @if ($item->absence == 0)
                                                        <td class="bg-success"></td>
                                                    @elseif($item->absence == 1)
                                                        <td class="bg-danger"></td>
                                                    @else
                                                        <td class="bg-warning"></td>
                                                    @endif
                                                    @php $flag = 1; @endphp
                                                    @break;
                                                @endif
                                            @endforeach
                                            @if ($flag == 0)
                                                <td></td>
                                            @endif
                                        @endif
                                    @endfor
                                </tr>
                        </tbody>
                    </table>
                </div>
                @endif
        </div>
    </div>
</div>
</div>
</div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

</script>
<script>
    $('.add2GroupBtn').click(function() {
        $('#idStudent').val($(this).val());
        $('#idGroup').val($(this).val());
    });
    $('#saveButton').hide();
    $(document).ready(function() {

        $('.editAbsence').click(function() {
            var absence = $(this).val().split('|')[1];
            $(this).closest('tr').find('.absenceStatue').empty();
            var htmlOut = '<select name="absence" class="absenceState form-select form-control">';

            var option1 = option2 = option3 = '';
            if (absence == 0)
                option1 = 'selected';
            if (absence == 1)
                option2 = 'selected';
            if (absence == 2)
                option3 = 'selected';

            htmlOut += '<option value="0" ' + option1 + '>Présent</option>';
            htmlOut += '<option value="1" ' + option2 + '>Absent(e)</option>';
            htmlOut += '<option value="2" ' + option3 + '>Justifiée</option>';
            htmlOut += '</select>';
            $(this).closest('tr').find('.absenceStatue').append(htmlOut);
            $(this).prop('disabled', true);
            $(document).ready(function() {
                $('.absenceState').change(function() {
                    $('#saveButton').show();
                    var editButton = $(this).closest('tr').find('.editAbsence');
                    editButton.removeClass();
                    editButton.attr('class', 'cancelEditAbsence btn btn-warning');
                    editButton.empty();
                    editButton.append('<i class="bi bi-arrow-clockwise"></i>');
                    var etatAbsence = $(this).val();
                    var idAttendance = $(this).closest('tr').find('.btn').val().split(
                        '|')[0];
                    // AJAX request 
                    $.ajax({
                        url: '/absence/update/' + idAttendance + '-' +
                            etatAbsence,
                        type: 'get',
                        dataType: 'json',
                        success: function(response) {
                            editButton.removeClass();
                            editButton.attr('class',
                                'cancelEditAbsence btn btn-success');
                            editButton.empty();
                            editButton.append(
                                '<i class="bi bi-check-lg"></i>');
                        },
                        fail: function(msg) {
                            alert('fail');
                        },
                    });
                });
            });

        });



        $('.cancelEditAbsence').click(function() {

        });

    });
</script>


@endsection
