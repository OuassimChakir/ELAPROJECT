@extends('layouts.layout')
@section('title')
    Statistiques des Revenus
@endsection
@section('content')
    @php
        if(isset($datePayment)){
            $date = date_create($datePayment);
        }
    @endphp
    <div class="card bg-white">
        <div class="row">
            <div class="col-sm-12">
                <div class="card-body">
                    {{-- Form --}}
                    <form action="{{route('incomes.stats.query')}}" method="post">
                        @csrf
                        @method('post')
                        <div class="row">
                            <div class="col-sm-5">
                                <div class="form-group">
                                    <select class="form-control" name="statsType" id="statsType">                                  
                                        <option value="0" {{isset($statsType) && $statsType == 0 ? "selected" : ''}}>Mensuel</option>
                                        <option value="1" {{isset($statsType) && $statsType == 1 ? "selected" : ''}}>Quotidien</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <input type="month" class="form-control" name="statsMonth" id="statsMonth" value="{{isset($datePayment) && $statsType == 0 ? $datePayment : date('Y-m')}}" {{$statsType == 0 ? '' : 'disabled'}}>
                                    <input type="date" class="form-control" name="statsDay" id="statsDay" value="{{isset($datePayment) && $statsType == 1 ? $datePayment : date('Y-m-d')}}" {{$statsType == 1 ? '' : 'disabled'}}>
                                </div>
                            </div>
                            <div class="col-sm-1">
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary" name="getStats" id="getStats">
                                        <span class="mdi mdi-magnify"></span>
                                    </button>
                                </div>
                            </div>
                        </div>
                        
                    </form>
                </div>  
            </div>
        </div>
    </div>

    @if(isset($statsType))
        <div class="card bg-white mt-4 p-2">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card-body">
                        @if ($statsType == 1)
                        <h3 class="card-title mb-4">Insciption & Assurances: {{date_format($date,'l, d M - Y')}}</h3>
                        {{-- Daily --}}
                        <div class="row">
                            <div class="col-xl-4">
                                <div class="media widget-media p-3 bg-white border">
                                    <div class="icon rounded-circle mr-3 text-white bg-dark">
                                        <i class="mdi mdi-account text-white"></i>
                                    </div>

                                    <div class="media-body align-self-center">
                                        <h4 class="text-primary mb-2">{{$inscription_stats->nbStudents}}</h4>
                                        <p>Nombre des Inscrits</p>
                                    </div>
                                </div>
                            </div>


                            <div class="col-xl-4">
                                <div class="media widget-media p-3 bg-white border">
                                    <div class="icon rounded-circle mr-3 bg-dark">
                                        <i class="mdi mdi-currency-usd text-white"></i>
                                    </div>

                                    <div class="media-body align-self-center">
                                        <h4 class="text-primary mb-2">{{is_null($inscription_stats->total) ? 0 : $inscription_stats->total}} DH</h4>
                                        <p>Total Revenu</p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-xl-4">
                                <div class="media widget-media p-3 bg-white border">
                                    <div class="icon rounded-circle mr-3 bg-dark">
                                        <i class="mdi mdi-cash text-white"></i>
                                    </div>

                                    <div class="media-body align-self-center">
                                        <h4 class="text-primary mb-2">{{is_null($inscription_stats->monthTotal) ? 0 : $inscription_stats->monthTotal}} DH</h4>
                                        <p>Total du Mois</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @elseif ($statsType == 0)
                        <h3 class="card-title mb-4">Insciption & Assurances: {{date_format($date,'F, Y')}}</h3>
                        {{-- Monthly --}}
                        <div class="row">
                            <div class="col-xl-6">
                                <div class="media widget-media p-3 bg-white border">
                                    <div class="icon rounded-circle mr-3 text-white bg-dark">
                                        <i class="mdi mdi-account text-white"></i>
                                    </div>

                                    <div class="media-body align-self-center">
                                        <h4 class="text-primary mb-2">{{$inscription_stats->nbStudents}}</h4>
                                        <p>Nombre des Inscrits</p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-xl-6">
                                <div class="media widget-media p-3 bg-white border">
                                    <div class="icon rounded-circle mr-3 bg-dark">
                                        <i class="mdi mdi-cash text-white"></i>
                                    </div>

                                    <div class="media-body align-self-center">
                                        <h4 class="text-primary mb-2">{{is_null($inscription_stats->total) ? 0 : $inscription_stats->total}} DH</h4>
                                        <p>Total du Mois</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif

                        @if ($statsType == 1)
                        {{-- Daily --}}
                        <h3 class="card-title mt-3 mb-3">Statistiques du Groupes: {{date_format($date,'l, d M - Y')}}</h3>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Groups</th>
                                    <th>Nombre des Paiements</th>
                                    <th>Montant Total du Jour</th>
                                    <th>Montant Total du Mois</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $totalJour = 0;
                                    $totalMois = 0;
                                    $i = 0;
                                @endphp
                                @foreach ($groups as $group)
                                <tr>
                                    <td class="align-middle">{{++$i}}</td>
                                    <td class="align-middle">{{$group->designation}}</td>
                                    <td class="align-middle">{{$group->stats->nbElements}}</td>
                                    <td class="align-middle">{{is_null($group->stats->totalGroup) ? 0 : $group->stats->totalGroup}} DH</td>
                                    <td class="align-middle">{{is_null($group->stats->totalMonth) ? 0 : $group->stats->totalMonth}} DH</td>
                                    <td class="align-middle">
                                        <a href="#">
                                            <button type="button" class="btn btn-outline-info btn-sm">
                                                <span class="mdi mdi-information"></span>
                                            </button>
                                        </a>
                                    </td>
                                </tr>
                                @php
                                    $totalJour += $group->stats->totalGroup;
                                    $totalMois += $group->stats->totalMonth;
                                @endphp
                                @endforeach
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td class="align-middle">{{$totalJour}} DH</td>
                                    <td class="align-middle">{{$totalMois}} DH</td>
                                    <td></td>
                                </tr>
                            </tbody>
                        </table>

                        @elseif($statsType == 0)
                        {{-- Monthly --}}
                        <h3 class="card-title mt-3 mb-3">Statistiques du Groupes: {{date_format($date,'F, Y')}}</h3>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Groups</th>
                                    <th>Nombre des Paiements</th>
                                    <th>Montant Total</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $total = 0;
                                    $i = 0;
                                @endphp
                                @foreach ($groups as $group)
                                <tr>
                                    <td class="align-middle">{{++$i}}</td>
                                    <td class="align-middle">{{$group->designation}}</td>
                                    <td class="align-middle">{{$group->stats->nbElements}}</td>
                                    
                                    <td class="align-middle">{{is_null($group->stats->totalGroup) ? 0 : $group->stats->totalGroup}} DH</td>
                                    <td class="align-middle">
                                        <a href="#">
                                            <button type="button" class="btn btn-outline-info btn-sm">
                                                <span class="mdi mdi-information"></span>
                                            </button>
                                        </a>
                                    </td>
                                </tr>
                                @php
                                    $total += $group->stats->totalGroup;
                                @endphp
                                @endforeach
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <th>Total du Mois</th>
                                    <td class="align-middle">{{$total}} DH</td>
                                    <td></td>
                                </tr>
                            </tbody>
                        </table>
                        @endif
                    </div>  
                </div>
            </div>
        </div>
    @endif
    {{-- Select Stats Type --}}
    <script src="{{ asset('JS/jquery.min.js') }}"></script>
    <script>
        $('#statsDay').hide();
    </script>
    @if ($statsType == 1)
        <script>
            $('#statsDay').show();
            $('#statsMonth').hide();
        </script>
    @endif
    <script>
        $(document).on('change','#statsType',function(){
            let value = $(this).val();
            if(value == '0'){
                $('#statsDay').prop('disabled',true);
                $('#statsDay').hide();
                $('#statsMonth').prop('disabled',false);
                $('#statsMonth').show();
            }else{
                $('#statsDay').prop('disabled',false);
                $('#statsDay').show();
                $('#statsMonth').prop('disabled',true);
                $('#statsMonth').hide();
            }
        });
    </script>
@endsection
