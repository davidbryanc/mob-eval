@extends('layouts.main')

@section('title_bar')
	Enroll
@endsection

@section('title_header')
	Enroll
@endsection

@section('content')
<div class="row" id="status">

</div>
<div class="row">
	<div class="col">
		<div class="input-group mb-3">
			<input type="text" class="form-control" id="nrp" placeholder="Masukkan NRP" onclick="clear_alert()">
			<div class="input-group-append">
				<button class="btn btn-outline-secondary" type="button" id="button-addon2" onclick="req_student()"><span class="iconify" data-icon="mdi:account-search" data-inline="false"></span></button>
			</div>
		</div>
	</div>
</div>
<div class="row" id="students">

</div>
@endsection

@section('script')
<script>
	function req_student(){
		$.ajax({
			type:'POST',
			url:'{{route("enroll.get_student")}}',
			data:{'_token':'{{csrf_token()}}',
				'nrp':$('#nrp').val()
				},
			success: function(data){
				$('#students').html(data.msg);
			},
			error: function(xhr) {
				console.log(xhr);
			}
		});
	}

	function enroll(nrp){
		$.ajax({
			type:'POST',
			url:'{{route("enroll.set_kelompok")}}',
			data:{'_token':'{{csrf_token()}}',
				'nrp':nrp
				},
			success: function(data){
				if (data.msg == "ok")
					$('#status').html("<div class='alert alert-success col-12'>Berhasil mengubah kelompok mahasiswa</div>");
				else
					$('#status').html("<div class='alert alert-danger col-12'>Gagal mgubah kelompok mahasiswa</div>");
				$('#students').html("");
			},
			error: function(xhr) {
				console.log(xhr);
			}
		});
	}

	function clear_alert() {
		$('#status').html("");
	}
</script>
@endsection