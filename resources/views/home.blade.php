@extends('layouts.main')

@section('title_bar')
	Home
@endsection

@section('title_header')
	Welcome, {{Auth::user()->panitia->kelompok_idKelompok}}!
@endsection

@section('content')
<div class="row">
	<div class="col-md-4 col-12 mb-3">
		<div class="card card-home-option" onclick="location.href = '{{route('students')}}'">
			<div class="card-body text-center">
				<span class="iconify" data-icon="mdi:account-check" data-inline="false" style="font-size: 5em"></span><br>
				<h5>Absensi</h5>
			</div>
		</div>
	</div>
	<div class="col-md-4 col-12 mb-3">
		<div class="card card-home-option" onclick="location.href = '{{route('enroll')}}'">
			<div class="card-body text-center">
				<span class="iconify" data-icon="mdi:account-multiple-plus" data-inline="false" style="font-size: 5em"></span><br>
				<h5>Enroll</h5>
			</div>
		</div>
	</div>
	<div class="col-md-4 col-12 mb-3">
		<div class="card card-home-option" onclick="location.href = '{{route('setting')}}'">
			<div class="card-body text-center">
				<span class="iconify" data-icon="mdi:cog" data-inline="false" style="font-size: 5em"></span><br>
				<h5>Setting</h5>
			</div>
		</div>
	</div>
</div>
@endsection