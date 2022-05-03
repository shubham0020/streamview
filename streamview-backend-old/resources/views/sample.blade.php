@extends('layouts.admin')

@section('content')
	
    <div class="row">

    <div class="col-md-10">

            <form action="{{route('sample')}}" method="POST" enctype="multipart/form-data" role="form">
                <div class="form-group">
                    <input type="file" name="subtitle" class="form-control">
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-success">Submit</button>
                </div>
            </form>

        </div>

	</div>

@endsection