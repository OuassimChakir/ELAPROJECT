<div class="tab-pane fade show" id="paiements" role="tabpanel" aria-labelledby="paiements-tab">
    <div class="tab-widget mt-5">
        <h3>Génération des Paiements</h3>
        <form action="{{route('generatePayments')}}" method="post">
            @csrf
            <table class="mt-4 table table-bordered table-hover">
                <thead>
                @php
                    $date1 = date_create($group->debutFormation);
                    $date2 = date_create($group->finFormation);
                    $interval = (int)date_diff($date1, $date2)->format('%m');
                    $interval++;
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
                    @php
                        $existedMonths = explode('|',$student->existedMonths);
                    @endphp
                    <tr>
                        <th>
                            <a href="{{route('student.profil', ['idStudent' => $student->idStudent])}}" target="_blank">
                                {{$student->prenom_ar}} {{$student->nom_ar}}
                            </a>
                        </th>
                        @php
                            $debut = (int)explode('-', $group->debutFormation)[1];
                            $year = (int)explode('-', $group->debutFormation)[0];
                            $fin = (int)explode('-', $group->finFormation)[1];
                            $breakpoint = $fin + 13;
                        @endphp
                        @for($i = $debut; $i <= $breakpoint; $i++)
                            @php
                                $flag = 0;
                                if($i<10)
                                    $currentDate = $year.'-0'.$i;
                                else
                                    $currentDate = $year.'-'.$i;
                            @endphp
                            @if($student->payments == $interval)
                                <td class="text-center bg-primary"><input type="checkbox" class="form-check-input" name="payments[]" value="{{$student->idStudent}}|{{$i}}|{{$year}}" checked disabled></td>
                            @else
                                @foreach($existedMonths as $existedMonth)
                                    @if($existedMonth == $i)
                                        <td class="text-center bg-primary"><input type="checkbox" class="form-check-input" name="payments[]" value="{{$student->idStudent}}|{{$i}}|{{$year}}" checked disabled></td>
                                        @php $flag = 1; @endphp
                                    @endif
                                @endforeach
                                @if($flag == 0)
                                    @if(date('Y-m') > $currentDate)
                                        <td class="text-center"><input type="checkbox" class="form-check-input" name="payments[]" value="{{$student->idStudent}}|{{$i}}|{{$year}}"></td>
                                    @else
                                        <td class="text-center"><input type="checkbox" class="form-check-input" name="payments[]" value="{{$student->idStudent}}|{{$i}}|{{$year}}" checked></td>
                                    @endif
                                @endif
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
                @endforeach
            </table>
            <div class="btn-group">
                <button type="submit" class="btn btn-primary" name="generatePayments">Generate</button>
            </div>
            <input type="hidden" name="idGroup" value="{{$group->idGroup}}">
        </form>
    </div>
</div>

