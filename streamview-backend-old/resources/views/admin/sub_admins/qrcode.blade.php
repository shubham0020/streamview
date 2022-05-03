@extends('layouts.admin')

@section('title', 'View Users Payment')

@section('content-header', 'View Users Payment')

@section('breadcrumb')
    <li><a href="{{route('admin.dashboard')}}"><i class="fa fa-dashboard"></i>{{tr('home')}}</a></li>
    <li><a href="{{route('admin.sub_admins.index')}}"><i class="fa fa-user"></i>Users <!--{{tr('sub_admins')}}--></a></li>
    <li class="active"><i class="fa fa-support"></i> View Users <!--{{tr('sub_admin_view')}}--></li>
@endsection

@section('content')

	<style type="text/css">
		.timeline::before {
		    content: '';
		    position: absolute;
		    top: 0;
		    bottom: 0;
		    width: 0;
		    background: #fff;
		    left: 0px;
		    margin: 0;
		    border-radius: 0px;
		}
	</style>

	
    
    <div class="container mt-4">
        <div class="card">
            <div class="card-header">
                <h3>Payment Verified <i class="fa fa-check btn-success"></i></h3>
            </div>
            <div class="card-body">
                <table>
                    <thead>
                        <th></th>
                        <th></th>
                        <th></th>
                    </thead>
                    <tbody>    
                        <tr>
                            <td>Email : {{ $user_email }}</td>
                        </tr>
                        <tr>
                            <td>Transaction id : {{ $Transactionid }}</td>
                        </tr>
                        <tr>
                            <td>Amount : {{ $amount }}</td>
                        </tr>
                    </tbody>     
                </table>
                <!-- {!! QrCode::size(300)->generate($user_email) !!} -->
            </div>
        </div>
        <!-- <div class="card">
            <div class="card-header">
                <h2>Color QR Code</h2>
            </div>
            <div class="card-body">
                {!! QrCode::size(300)->backgroundColor(255,90,0)->generate('RemoteStack') !!}
            </div>
        </div> -->
    </div>




    

    


@endsection