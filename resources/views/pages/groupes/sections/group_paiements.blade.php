<div class="tab-pane fade show" id="paiements" role="tabpanel" aria-labelledby="paiements-tab">
    <div class="tab-widget mt-5">
        <h3>Génération des Paiements</h3>
        <form action="{{route('generatePayments')}}" method="post">
            @csrf
            <table class="mt-4 table table-bordered table-hover">
                <thead>
                @php
                    $debut = (int)explode('-', $group->debutFormation)[1];
                    $year = (int)explode('-', $group->debutFormation)[0];
                    $fin = (int)explode('-', $group->finFormation)[1];
                    $breakpoint = $fin + 13;
                @endphp
                <tr>
                    <th></th>
                    @for($i = $debut; $i <= $breakpoint; $i++)
                        @if($i<10)
                            <th>0{{$i}}-{{$year}}</th>
                        @else
                            <th>{{$i}}-{{$year}}</th>
                        @endif
                        @php
                            if ($i == 12) {
                                $i = 0;
                                $breakpoint = $fin;
                                $year++;
                            }
                        @endphp
                    @endfor
                </tr>
                </thead>
                @foreach($paimentStudents as $student)
                    <tr>
                        <th>{{$student->prenom_ar}} {{$student->nom_ar}}</th>
                        @if($student->payments == 0)
                            @php
                                $debut = (int)explode('-', $group->debutFormation)[1];
                                $year = (int)explode('-', $group->debutFormation)[0];
                                $fin = (int)explode('-', $group->finFormation)[1];
                                $breakpoint = $fin + 13;
                            @endphp
                            @for($i = $debut; $i <= $breakpoint; $i++)
                                @php
                                    if($i<10)
                                        $currentDate = $year.'-0'.$i;
                                    else
                                        $currentDate = $year.'-'.$i;
                                @endphp
                                @if(date('Y-m') > $currentDate)
                                    <td class="text-center"><input type="checkbox" class="form-check-input" name="payments[]" value="{{$student->idStudent}}|{{$i}}|{{$year}}"></td>
                                @else
                                    <td class="text-center"><input type="checkbox" class="form-check-input" name="payments[]" value="{{$student->idStudent}}|{{$i}}|{{$year}}" checked></td>
                                @endif
                                @php
                                    if ($i == 12) {
                                        $i = 0;
                                        $breakpoint = $fin;
                                        $year++;
                                    }
                                @endphp
                            @endfor
                        @else
                            @php
                                $date1 = date_create($group->debutFormation);
                                $date2 = date_create($group->finFormation);
                                $interval = (int)date_diff($date1, $date2)->format('%m');
                            @endphp
                            <td colspan="{{$interval+1}}" class="text-center">
                                Les paiements sont déjà ajoutés pour cet(te) étudiant(e) !
                            </td>
                        @endif
                    </tr>
                @endforeach
            </table>
            <div class="btn-group">
                <button type="submit" class="btn btn-primary" name="generatePayments">Generate</button>
            </div>
            <input type="hidden" name="idGroup" value="{{$group->idGroup}}">
        </form>
    </div>
</div>

