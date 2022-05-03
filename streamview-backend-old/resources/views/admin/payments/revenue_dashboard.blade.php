@extends('layouts.admin')

@section('title', tr('revenue_system'))

@section('content-header',tr('revenue_system'))

@section('breadcrumb')
    <li><a href="{{route('admin.dashboard')}}"><i class="fa fa-dashboard"></i>{{tr('home')}}</a></li>
    <li><a href="#"><i class="fa fa-money"></i> {{tr('payments')}}</a></li>
    <li class="active"><i class="fa fa-money"></i> {{tr('revenue_system')}}</li>
@endsection

@section('content')

<div class="row">

	<div class="col-md-3">

	    <div class="box box-warning">

	        <div class="box-header table-header-theme">	            
                 <b>{{tr('subscription_payments')}}</b>
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
	                        <strong></strong>
	                    </p>
	                    
	                    <div class="chart-responsive">
	                        <canvas id="subscribe_payments" height="200px"></canvas>
	                    </div>
	                </div>
	            </div>	        
	        </div>

	        <div class="box-footer no-padding">
	            <ul class="nav nav-pills nav-stacked">
	                <li>
	                    <a>
	                        <strong class="text-red">{{tr('total_amount')}}</strong>
	                        <span class="pull-right text-red">
	                            <i class="fa fa-angle-right"></i> {{formatted_amount($total_revenue ?? 0)}}
	                        </span>
	                    </a>
	                </li>
	            </ul>
	        </div>

	    </div>      
	    
	</div>

	<div class="col-md-6">

	    <div class="box box-warning">

        <div class="box-header table-header-theme">	            
                 <b>{{tr('video_subscribe_payments')}}</b>
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
	                        <strong></strong>
	                    </p>	                    
	                    <div class="chart-responsive">
	                        <canvas id="video_subscribe_payments" height="200px"></canvas>
	                    </div>
	                </div>
	            </div>	        
	        </div>

	        <div class="box-footer no-padding">
	            <ul class="nav nav-pills nav-stacked">
	                <li>
	                    <a>
	                        <strong class="text-red">{{tr('total_amount')}}</strong>
	                        <span class="pull-right text-red">
	                            <i class="fa fa-angle-right"></i> {{formatted_amount($video_amount ?? 0)}}
	                        </span>
	                    </a>
	                </li>

	                <li>
	                    <a>
	                        <strong class="text-green">{{tr('total_admin_amount')}} </strong>
	                        <span class="pull-right text-green">
	                            <i class="fa fa-angle-right"></i> {{formatted_amount($admin_amount ?? 0)}}
	                        </span>
	                    </a>
	                </li>

	                <li>
	                    <a>
	                        <strong class="text-yellow">{{tr('total_user_amount')}}</strong>
	                        <span class="pull-right text-yellow">
	                            <i class="fa fa-angle-right"></i> {{formatted_amount($user_amount ?? 0)}}
	                        </span>
	                    </a>
	                </li>
	            </ul>
	        </div>

	    </div>                         
	            
	</div>

</div>
@endsection

@section('scripts')

<script type="text/javascript">
   
  //-------------
  //- PIE CHART -
  //-------------
  // Get context with jQuery - using jQuery's .get() method.
  var pieChartCanvas = $("#subscribe_payments").get(0).getContext("2d");
  var pieChart = new Chart(pieChartCanvas);
  var PieData = [
    {
      value: {{$total_revenue}},
      color: "#00a65a",
      highlight: "#00a65a",
      label: "Total Subscription Amount"
    },
  ];
  var pieOptions = {
    //Boolean - Whether we should show a stroke on each segment
    segmentShowStroke: true,
    //String - The colour of each segment stroke
    segmentStrokeColor: "#fff",
    //Number - The width of each segment stroke
    segmentStrokeWidth: 1,
    //Number - The percentage of the chart that we cut out of the middle
    percentageInnerCutout: 50, // This is 0 for Pie charts
    //Number - Amount of animation steps
    animationSteps: 100,
    //String - Animation easing effect
    animationEasing: "easeOutBounce",
    //Boolean - Whether we animate the rotation of the Doughnut
    animateRotate: true,
    //Boolean - Whether we animate scaling the Doughnut from the centre
    animateScale: false,
    //Boolean - whether to make the chart responsive to window resizing
    responsive: true,
    // Boolean - whether to maintain the starting aspect ratio or not when responsive, if set to false, will take up entire container
    maintainAspectRatio: false,
    //String - A legend template
    legendTemplate: "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<segments.length; i++){%><li><span style=\"background-color:<%=segments[i].fillColor%>\"></span><%if(segments[i].label){%><%=segments[i].label%><%}%></li><%}%></ul>",
    //String - A tooltip template
    tooltipTemplate: "<%=label%> - $<%=value %>"
  };
  //Create pie or douhnut chart
  // You can switch between pie and douhnut using the method below.
  pieChart.Doughnut(PieData, pieOptions);
  //-----------------
  //- END PIE CHART -
  //-----------------

  //-----------------------
  //- MONTHLY SALES CHART -
  //-----------------------

  //-------------
  //- PIE CHART -
  //-------------
  // Get context with jQuery - using jQuery's .get() method.
  var subscribe_canvas = $("#video_subscribe_payments").get(0).getContext("2d");
  var subscribeChart = new Chart(subscribe_canvas);
  var subscribeData = [
    {
      value: {{$admin_amount}},
      color: "#00a65a",
      highlight: "#00a65a",
      label: "Admin Commission"
    },
    {
      value: {{$user_amount}},
      color: "#f39c12",
      highlight: "#f39c12",
      label: "User Commission"
    }
  ];
  var subscribeOptions = {
    //Boolean - Whether we should show a stroke on each segment
    segmentShowStroke: true,
    //String - The colour of each segment stroke
    segmentStrokeColor: "#fff",
    //Number - The width of each segment stroke
    segmentStrokeWidth: 1,
    //Number - The percentage of the chart that we cut out of the middle
    percentageInnerCutout: 50, // This is 0 for Pie charts
    //Number - Amount of animation steps
    animationSteps: 100,
    //String - Animation easing effect
    animationEasing: "easeOutBounce",
    //Boolean - Whether we animate the rotation of the Doughnut
    animateRotate: true,
    //Boolean - Whether we animate scaling the Doughnut from the centre
    animateScale: false,
    //Boolean - whether to make the chart responsive to window resizing
    responsive: true,
    // Boolean - whether to maintain the starting aspect ratio or not when responsive, if set to false, will take up entire container
    maintainAspectRatio: false,
    //String - A legend template
    legendTemplate: "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<segments.length; i++){%><li><span style=\"background-color:<%=segments[i].fillColor%>\"></span><%if(segments[i].label){%><%=segments[i].label%><%}%></li><%}%></ul>",
    //String - A tooltip template
    tooltipTemplate: "<%=label%> - $<%=value %>"
  };
  //Create pie or douhnut chart
  // You can switch between pie and douhnut using the method below.
  subscribeChart.Doughnut(subscribeData, subscribeOptions);
  //-----------------
  //- END PIE CHART -
  //-----------------

   //-----------------------
  //- MONTHLY SALES CHART -
  //-----------------------

// Get context with jQuery - using jQuery's .get() method.
 

</script>

@endsection