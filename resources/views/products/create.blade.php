@extends('layouts.app')

@section('content')
	<div class="row justify-content-center">
		<div class="col-md-8">
			<div class="card">
				<div class="card-header">{{ __('Create Product') }}</div>

				<div class="card-body">
					@if (session('status'))
						<div class="alert alert-success" role="alert">
							{{ session('status') }}
						</div>
					@endif

					@if($errors->any())
						<div class="alert alert-danger">
							@foreach ($errors->all() as $error)
								{{ $error }} <br>
							@endforeach
						</div>
					@endif

					{!! Form::open(['route' => 'products.store']) !!}

						<div class="mb-3">
							<img style="height: 200px; width:auto; position:relative;  left: 50%; transform: translate(-50%)" src="https://developers.elementor.com/docs/assets/img/elementor-placeholder-image.png"/>
						</div>

						<div class="mb-3">
							{{ Form::label('Status', 'Status', ['class'=>'form-label']) }}
							{{ Form::select('status', array(1 => 'In-stock', 2 => 'Out-of-stock'), array('class' => 'btn btn-primary dropdown-toggle', 'required' => 'required')) }}
						</div>

						<div class="mb-3">
							{{ Form::label('Name', 'Name', ['class'=>'form-label']) }}
							{{ Form::text('name', null, array('class' => 'form-control', 'required' => 'required')) }}
						</div>
						
						<div class="mb-3">
							{{ Form::label('Price', 'Price', ['class'=>'form-label']) }}
							{{ Form::text('price', null, array('class' => 'form-control')) }}
						</div>			

						<div class="mb-3">
							{{ Form::label('Description', 'Description', ['class'=>'form-label']) }}
							{{ Form::textarea('description', null, array('class' => 'form-control')) }}
						</div>


						</div>

						{{ Form::submit('Create', array('class' => 'btn btn-primary')) }}

					{{ Form::close() }}
				</div>
			</div>
		</div>
	</div>
@stop