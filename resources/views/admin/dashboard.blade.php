@extends('admin.layouts.admin')

@section('content')
    <!-- page content -->
    <!-- top tiles -->
    @if(auth()->user()->hasRole('administrator'))
        <div class="row tile_count">
            <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
                <span class="count_top"><i class="fa fa-users"></i> {{ __('views.admin.dashboard.count_0') }}</span>
                <div class="count green">{{ $counts['users'] }}</div>
            </div>
            <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
                <span class="count_top"><i
                            class="fa fa-address-card"></i> {{ __('views.admin.dashboard.count_1') }}</span>
                <div>
                    <span class="count green">{{  ($counts['users'] - $counts['users_unconfirmed'])*-1 }}</span>
                    <span class="count">/</span>
                    <span class="count red">{{ $counts['users_unconfirmed'] }}</span>
                </div>
            </div>
            <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
                <span class="count_top"><i
                            class="fa fa-user-times "></i> {{ __('views.admin.dashboard.count_2') }}</span>
                <div>
                    <span class="count green">{{  $counts['users'] - $counts['users_inactive'] }}</span>
                    <span class="count">/</span>
                    <span class="count red">{{ $counts['users_inactive'] }}</span>
                </div>
            </div>
            <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
                <span class="count_top"><i class="fa fa-lock"></i> {{ __('views.admin.dashboard.count_3') }}</span>
                <div>
                    <span class="count green">{{  $counts['protected_pages'] }}</span>
                </div>
            </div>
        </div>
    @endif
    <!-- /top tiles -->


    <br/>

    @if(auth()->user()->hasRole('administrator'))
    <div class="row">
        @foreach($apartments as $apartment)
            <canvas id="myChart{{$apartment->id}}" width="400" height="400"></canvas>
            <script>
                var ctx = document.getElementById("myChart{{$apartment->id}}");
                var myChart = new Chart(ctx, {
                    type: 'line',
                    data: {
                        labels: ["Red", "Blue", "Yellow", "Green", "Purple", "Orange"],
                        datasets: [{
                            label: '# of Votes',
                            data: [12, 19, 3, 5, 2, 3],
                            backgroundColor: [
                                'rgba(255, 99, 132, 0.2)',
                                'rgba(54, 162, 235, 0.2)',
                                'rgba(255, 206, 86, 0.2)',
                                'rgba(75, 192, 192, 0.2)',
                                'rgba(153, 102, 255, 0.2)',
                                'rgba(255, 159, 64, 0.2)'
                            ],
                            borderColor: [
                                'rgba(255,99,132,1)',
                                'rgba(54, 162, 235, 1)',
                                'rgba(255, 206, 86, 1)',
                                'rgba(75, 192, 192, 1)',
                                'rgba(153, 102, 255, 1)',
                                'rgba(255, 159, 64, 1)'
                            ],
                            borderWidth: 1
                        }]
                    },
                    options: {
                        scales: {
                            yAxes: [{
                                ticks: {
                                    beginAtZero:true
                                }
                            }]
                        }
                    }
                });
            </script>
            <div class="col-md-4 col-sm-4 col-xs-12">
                <div id="registration_usage" class="x_panel tile fixed_height_320 overflow_hidden">
                    <div class="x_title">
                        <h2>{{$apartment->name}}</h2>
                        <ul class="nav navbar-right panel_toolbox">
                            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                            </li>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                                   aria-expanded="false">
                                    <i class="fa fa-wrench"></i>
                                </a>
                            </li>
                            <li><a class="close-link"><i class="fa fa-close"></i></a>
                            </li>
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <table class="" style="width:100%">
                            <tr>
                                <th></th>
                                <th>
                                    <div class="col-lg-7 col-md-7 col-sm-7 col-xs-7">
                                        <p class="">{{  __('views.admin.dashboard.sub_title_3') }}</p>
                                    </div>
                                    <div class="col-lg-5 col-md-5 col-sm-5 col-xs-5">
                                        <p class="">{{  __('views.admin.dashboard.sub_title_4') }}</p>
                                    </div>
                                </th>
                            </tr>
                            <tr>
                                <td>
                                    <canvas id="{{$apartment->id}}" class="canvasChart {{$apartment->id}}" height="140"
                                            width="140" style="margin: 15px 10px 10px 0">
                                    </canvas>

                                </td>
                                <td>
                                    <table class="tile_info">
                                        <tr>
                                            <td>
                                                <p><i class="fa fa-square aero"></i>
                                                    <span class="tile_label">
                                                     Empty Houses
                                                </span>
                                                </p>
                                            </td>
                                            <td>{{$apartment->vacant}}</td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <p><i class="fa fa-square red"></i>
                                                    <span class="tile_label">
                                                    Occupied Houses
                                                </span>
                                                </p>
                                            </td>
                                            <td>{{$apartment->occupied}}</td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <p><i class="fa fa-square blue"></i>
                                                    <span class="tile_label">
                                                    Total Houses
                                                </span>
                                                </p>
                                            </td>
                                            <td>{{$apartment->total_houses}}</td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    @endif






@endsection

@section('scripts')
    @parent
    {{ Html::script(mix('assets/admin/js/dashboard.js')) }}
@endsection

@section('styles')
    @parent
    {{ Html::style(mix('assets/admin/css/dashboard.css')) }}
@endsection
