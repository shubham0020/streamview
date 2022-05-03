@extends('layouts.admin')

@section('title', tr('view_video'))


@section('content-header') 

{{tr('analytics')}} 

@endsection


@section('styles')

<style>
    dt {
        padding: 4px !important; 
    }

    dd {
        padding: 4px !important;
    }

    table {
        font-family: arial, sans-serif;
        border-collapse: collapse;
        width: 100%;
    }

    td, th {
        border: 1px solid #dddddd;
        text-align: left;
        padding: 8px;
    }

    tr:nth-child(even) {
        background-color: #f1f1f1;
    }

    td:nth-child(odd) {
        color:#0000008a;
    }

    .rv-desc {
        line-height: 1.6;
        letter-spacing: 0.6px;
        font-size: 14px;
    }

</style>
@endsection
@section('breadcrumb')
    <li><a href="{{route('admin.dashboard')}}"><i class="fa fa-dashboard"></i>{{tr('home')}}</a></li>
    <li><a href="{{route('admin.videos')}}"><i class="fa fa-video-camera"></i> {{tr('videos')}}</a></li>
    <li class="active">{{tr('video')}}</li>
@endsection 

@section('content')

<div class="row">

  <div class="col-lg-12">

      <div class="box">

          <div class="box-header">

              <div class='pull-left'>

                  <h3 class="box-title">
                      <b>{{$data->video_details->title}}</b>
                  </h3>

                  <br>

                  <span style="margin-left:0px" class="description text-uppercase">
                     
                      {{tr('created_at')}} :

                      {{common_date($data->video_details->created_at, Auth::guard('admin')->user()->timezone, 'd-m-Y h:i A')}}
                  </span>

                  <br>
                  <span style="margin-left:0px" class="description text-uppercase">
                     
                      {{tr('uploaded_by')}} :

                      @if(is_numeric($data->video_details->uploaded_by))

                        <a href="{{route('admin.moderators.view', ['moderator_id' => $data->video_details->uploaded_by] )}}">{{$data->video_details->moderator ? $data->video_details->moderator->name : ''}}</a>

                    @else 
                        <span class="text-uppercase">{{$data->video_details->uploaded_by}}</span>

                    @endif

                  </span>   

              </div>
          </div>

          <div class="box-body">
            
            <div class="row">

              <div class="col-lg-4">

                <table>

                    <tr>
                        <td>
                          <strong class="text-red">{{ tr('today_views') }}</strong>
                          <span class="pull-right text-red">
                              {{$data->todays_watch_count}}
                          </span>
                        </td>
                    </tr>

                    <tr>
                        <td>
                          <strong class="text-green">{{ tr('total_views') }}</strong>
                          <span class="pull-right text-green">
                              {{$data->video_details->watch_count}}
                          </span>
                        </td>
                    </tr>

                </table>
              </div>

              <div class="col-lg-4">

                <table>

                    <tr>
                        <td>
                          <strong class="text-red">{{ tr('today_earnings') }}</strong>
                          <span class="pull-right text-red">
                              {{formatted_amount($data->todays_video_amount)}}
                          </span>
                        </td>
                    </tr>

                    <tr>
                        <td>
                          <strong class="text-green">{{ tr('overall_earnings') }}</strong>
                          <span class="pull-right text-green">
                            {{formatted_amount($data->video_details->admin_amount + $data->video_details->user_amount)}}
                          </span>
                        </td>
                    </tr>

                </table>
              </div>

              <div class="col-lg-4">

                <table>

                    <tr>
                        <td>
                          <strong class="text-red">{{ tr('admin_amount') }}</strong>
                          <span class="pull-right text-red">
                              {{formatted_amount($data->video_details->admin_amount ? $data->video_details->admin_amount : 0.00)}}
                          </span>
                        </td>
                    </tr>

                    <tr>
                        <td>
                          <strong class="text-green">{{ tr('moderator_amount') }}</strong>
                          <span class="pull-right text-green">
                              {{formatted_amount($data->video_details->user_amount ? $data->video_details->user_amount : 0.00)}}
                          </span>
                        </td>
                    </tr>

                </table>
              </div>

            </div>
          
          </div>

      </div>

    </div>

    <div class="col-md-12">

        <div class="box box-warning">

            <div class="box-header bg-warning">
                
                <h3 class="box-title text-uppercase">{{ tr('daily_video_watch_count') }}</h3>

                <div class="box-tools pull-right">
                    
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button>
                </div>
            </div>

            <!-- /.box-header -->

            <div class="box-body">
                <div class="row">

                    <div class="col-md-12">
                        <p class="text-center">
                            <strong>{{ tr('last_10_days_watch_count') }}</strong>
                        </p>

                        <div class="chart">
                            <!-- Sales Chart Canvas -->
                            <canvas id="dailyChart" style="height: 300px;"></canvas>
                        </div>
                    </div>

                </div>
                <!-- /.row -->
            
            </div>
            <!-- ./box-body -->
           
            <!-- /.box-footer -->
        </div>
        <!-- /.box -->
    </div>

    <div class="col-md-12">

        <div class="box box-warning">

            <div class="box-header bg-warning">
                
                <h3 class="box-title text-uppercase">{{ tr('video_earnings') }}</h3>

                <div class="box-tools pull-right">
                    
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button>
                </div>
            </div>

            <!-- /.box-header -->

            <div class="box-body">
                <div class="row">

                    <div class="col-md-12">
                        <p class="text-center">
                            <strong>{{ tr('last_10_days_earnings') }}</strong>
                        </p>

                        <div class="chart">
                            <!-- Sales Chart Canvas -->
                            <canvas id="revenueChart" style="height: 300px;"></canvas>
                        </div>
                    </div>

                </div>
                <!-- /.row -->
            
            </div>
            <!-- ./box-body -->
           
            <!-- /.box-footer -->
        </div>
        <!-- /.box -->
    </div>

    <!-- /.col -->

</div>

@endsection

@section('scripts')

<script type="text/javascript">

  //-----------------------
  //- MONTHLY SALES CHART -
  //-----------------------

  // Get context with jQuery - using jQuery's .get() method.
  var salesChartCanvas = $("#dailyChart").get(0).getContext("2d");
  // This will get the first returned node in the jQuery collection.
  var salesChart = new Chart(salesChartCanvas);

  var salesChartData = {
    labels: [<?php foreach($watch_count as $date) { echo '"'.date('d M', strtotime($date->date)).'",';} ?>],
    datasets: [
      {
        label: "Electronics",
        fillColor: "rgb(210, 214, 222)",
        strokeColor: "rgb(210, 214, 222)",
        pointColor: "rgb(210, 214, 222)",
        pointStrokeColor: "#c1c7d1",
        pointHighlightFill: "#fff",
        pointHighlightStroke: "rgb(220,220,220)",
        data: [<?php foreach($watch_count as $count) { echo $count->total_views.',';} ?>]
      }
    ]
  };

  var salesChartOptions = {
    //Boolean - If we should show the scale at all
    showScale: true,
    //Boolean - Whether grid lines are shown across the chart
    scaleShowGridLines: false,
    //String - Colour of the grid lines
    scaleGridLineColor: "rgba(0,0,0,.05)",
    //Number - Width of the grid lines
    scaleGridLineWidth: 1,
    //Boolean - Whether to show horizontal lines (except X axis)
    scaleShowHorizontalLines: true,
    //Boolean - Whether to show vertical lines (except Y axis)
    scaleShowVerticalLines: true,
    //Boolean - Whether the line is curved between points
    bezierCurve: true,
    //Number - Tension of the bezier curve between points
    bezierCurveTension: 0.3,
    //Boolean - Whether to show a dot for each point
    pointDot: false,
    //Number - Radius of each point dot in pixels
    pointDotRadius: 4,
    //Number - Pixel width of point dot stroke
    pointDotStrokeWidth: 1,
    //Number - amount extra to add to the radius to cater for hit detection outside the drawn point
    pointHitDetectionRadius: 20,
    //Boolean - Whether to show a stroke for datasets
    datasetStroke: true,
    //Number - Pixel width of dataset stroke
    datasetStrokeWidth: 2,
    //Boolean - Whether to fill the dataset with a color
    datasetFill: true,
    //String - A legend template
    legendTemplate: "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<datasets.length; i++){%><li><span style=\"background-color:<%=datasets[i].lineColor%>\"></span><%=datasets[i].label%></li><%}%></ul>",
    //Boolean - whether to maintain the starting aspect ratio or not when responsive, if set to false, will take up entire container
    maintainAspectRatio: true,
    //Boolean - whether to make the chart responsive to window resizing
    responsive: true
  };

  //Create the line chart
  salesChart.Line(salesChartData, salesChartOptions);

  //---------------------------
  //- END MONTHLY SALES CHART -
  //---------------------------


  // Get context with jQuery - using jQuery's .get() method.
  var revenueChart = $("#revenueChart").get(0).getContext("2d");
  // This will get the first returned node in the jQuery collection.
  var initChart = new Chart(revenueChart);

  var revenueChartData = {
    labels: [<?php foreach($earnings_count as $date) { echo '"'.date('d M', strtotime($date->date)).'",';} ?>],
    datasets: [
      {
        label: "Electronics",
        fillColor: "rgb(210, 214, 222)",
        strokeColor: "rgb(210, 214, 222)",
        pointColor: "rgb(210, 214, 222)",
        pointStrokeColor: "#c1c7d1",
        pointHighlightFill: "#fff",
        pointHighlightStroke: "rgb(220,220,220)",
        data: [<?php foreach($earnings_count as $count) { echo $count->total_amount.',';} ?>]
      }
    ]
  };

  var revenueChartOptions = {
    //Boolean - If we should show the scale at all
    showScale: true,
    //Boolean - Whether grid lines are shown across the chart
    scaleShowGridLines: false,
    //String - Colour of the grid lines
    scaleGridLineColor: "rgba(0,0,0,.05)",
    //Number - Width of the grid lines
    scaleGridLineWidth: 1,
    //Boolean - Whether to show horizontal lines (except X axis)
    scaleShowHorizontalLines: true,
    //Boolean - Whether to show vertical lines (except Y axis)
    scaleShowVerticalLines: true,
    //Boolean - Whether the line is curved between points
    bezierCurve: true,
    //Number - Tension of the bezier curve between points
    bezierCurveTension: 0.3,
    //Boolean - Whether to show a dot for each point
    pointDot: false,
    //Number - Radius of each point dot in pixels
    pointDotRadius: 4,
    //Number - Pixel width of point dot stroke
    pointDotStrokeWidth: 1,
    //Number - amount extra to add to the radius to cater for hit detection outside the drawn point
    pointHitDetectionRadius: 20,
    //Boolean - Whether to show a stroke for datasets
    datasetStroke: true,
    //Number - Pixel width of dataset stroke
    datasetStrokeWidth: 2,
    //Boolean - Whether to fill the dataset with a color
    datasetFill: true,
    //String - A legend template
    legendTemplate: "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<datasets.length; i++){%><li><span style=\"background-color:<%=datasets[i].lineColor%>\"></span><%=datasets[i].label%></li><%}%></ul>",
    //Boolean - whether to maintain the starting aspect ratio or not when responsive, if set to false, will take up entire container
    maintainAspectRatio: true,
    //Boolean - whether to make the chart responsive to window resizing
    responsive: true
  };

  //Create the line chart
  initChart.Line(revenueChartData, revenueChartOptions);
</script>

@endsection