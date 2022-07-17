@extends('layouts.main')

@section('title_bar')
	Setting
@endsection

@section('title_header')
	Setting
@endsection

@section('content')
<div class="container">
	<div class="row">
		@if (session('success'))
			<div class="col-12">
				<div class="alert alert-success alert-dismissible fade show" role="alert">
					{{session('success')}}
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
			</div>
		@elseif (session('error'))
		<div class="col-12">
			<div class="alert alert-danger alert-dismissible fade show" role="alert">
				{{session('error')}}
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
		</div>
		@endif
		<div class="col">
			<form method="POST" action="{{route('setting.change_password')}}">
				@csrf
				<div class="mb-3">
					<label class="form-label">Password Lama</label>
					<input type="password" class="form-control" name="password_old">
				</div>
				<div class="mb-3">
					<label class="form-label">Password Baru</label>
					<input type="password" class="form-control" name="password_new">
				</div>
				<button type="submit" class="btn btn-primary">Ubah Password</button>
			</form>
		</div>
	</div>
</div>
@endsection