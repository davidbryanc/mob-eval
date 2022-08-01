@extends('layouts.main')

@section('title_bar')
	Students
@endsection

@section('title_header')
	Students
@endsection

@section('content')
<div class="row">
	<div class="col-12 mb-4">
		<div class="row">
			<div class="col-md-5 col-sm-12 mb-3">
				<small class="text-muted">Jadwal</small>
				<select name="hari" id="hari" class="form-control">
					<option value="0" disabled selected>--Pilih jadwal hari--</option>
					@if (count($jadwalHari) > 0)
						@foreach ($jadwalHari as $jadwal)
							<option value="{{$jadwal->idjadwal}}">{{$jadwal->namajadwal}} - {{date('D, j M Y', strtotime($jadwal->tanggal))}}</option>
						@endforeach
					@endif
				</select>
			</div>
			<div class="col-md-5 col-sm-12 mb-3 text-center align-self-center">
				<img src="{{asset('assets/img/loading.gif')}}" class="loading" id="loading1" width="36px" alt="">
				<div id="container-sesi">
					<div class="text-left"><small class="text-muted text-left">Sesi</small></div>
					<select name="sesi" id="sesi" class="form-control">
						<option value="0" disabled selected>--Silahkan pilih jadwal terlebih dahulu--</option>
					</select>
				</div>
			</div>
			<div class="col-md-2 col-sm-12 mb-3 d-flex align-items-end justify-content-center">
				<button class="btn btn-primary" type="button" onclick="get_mahasiswa()">Tampilkan Data</button>
			</div>
		</div>
	</div>
	<div class="col-12 text-center">
		<img src="{{asset('assets/img/loading.gif')}}" class="loading" id="loading2" width="72px" alt="">
		<div class="row">
			<div class="col-12 text-center" id="container-tabel">
		
			</div>
		</div>
	</div>
</div>
@endsection

@section('modal')
	<div class="modal fade" id="modal_pelanggaran" tabindex="-1" role="dialog" aria-labelledby="modal_pelanggaran" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered" role="document">
			<div class="modal-content">
				<div class="text-center">
					<img src="{{asset('assets/img/loading.gif')}}" class="loading" id="loading3" width="36px" alt="">
				</div>
				<div id="content_modal_pelanggaran">

				</div>
			</div>
		</div>
	</div>

	<div class="modal fade" id="modal_ijin" tabindex="-1" role="dialog" aria-labelledby="modal_ijin" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered" role="document">
			<div class="modal-content">
				<div class="text-center">
					<img src="{{asset('assets/img/loading.gif')}}" class="loading" id="loading4" width="36px" alt="">
				</div>
				<div id="content_modal_ijin">

				</div>
			</div>
		</div>
	</div>
@endsection

@section('script')
<script>
	$('#hari').on('change', function(){
		$('#container-sesi').hide();
		$('#loading1').show();
		$.ajax({
			type:'POST',
			url:'{{route("students.get_sesi")}}',
			data:{'_token':'{{csrf_token()}}',
				'tanggal':$(this).val()
				},
			success: function(data){
				$('#loading1').hide();
				$('#container-sesi').show();
				$('#sesi').html(data.msg);
			},
			error: function(xhr) {
				console.log(xhr);
			}
		});
	});

	function openModalIjin(nrp) {
		$('#content_modal_ijin').html("");
		$('#loading4').show();
		var idsesi = $('#sesi').val();
		$.ajax({
			type:'POST',
			url:'{{route("students.get_modal_izin")}}',
			data:{'_token':'{{csrf_token()}}',
				'nrp':nrp,
				'idsesi':idsesi,
				},
			success: function(data){
				$('#loading4').hide();
				$('#content_modal_ijin').html(data.msg);
			},
			error: function(xhr) {
				console.log(xhr);
			}
		});
	}

	function openModalPelanggaran(nrp, hari) {
		$('#content_modal_pelanggaran').html("");
		$('#loading3').show();
		$.ajax({
			type:'POST',
			url:'{{route("students.get_modal_pelanggaran")}}',
			data:{'_token':'{{csrf_token()}}',
				'nrp':nrp,
				'hari':hari,
				},
			success: function(data){
				$('#loading3').hide();
				$('#content_modal_pelanggaran').html(data.msg);
			},
			error: function(xhr) {
				console.log(xhr);
			}
		});
	}

	function get_mahasiswa() {
		var idsesi = $('#sesi').val();
		var hari = $('#hari').val();
		$('#container-tabel').html("");
		$('#loading2').show();
		if (idsesi != 0 && idsesi != null){
			$.ajax({
				type:'POST',
				url:'{{route("students.get_mhs")}}',
				data:{'_token':'{{csrf_token()}}',
					'idsesi':idsesi,
					'hari':hari,
					},
				success: function(data){
					$('#loading2').hide();
					$('#container-tabel').html(data.msg);
				},
				error: function(xhr) {
					console.log(xhr);
				}
			});
		} else {
			alert("Pilihlah sesi terlebih dahulu !");
		}
	}

	String.prototype.trim = function() {
		return this.replace(/^\s+|\s+$/g,"");
	}

	$.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

	function send_absensi(nrp, absen){
		if (!confirm("Are you sure?")) return
		var idsesi = $('#sesi').val();
		$('#status_'+nrp).html("<img src=\"{{asset('assets/img/loading.gif')}}\" width=\"18px\" alt=\"\">");
		$.ajax({
			type:'POST',
			url:'{{route("students.set_absensi2")}}',
			data:{
				'_token':'<?php echo csrf_token() ?>',
				'nrp':nrp,
				'absen':absen,
				'idsesi':idsesi,
				},
			success: function(data){
				$('#status_'+nrp).html(data.msg);
			},
			error: function(xhr) {
				console.log(xhr);
			}
		});
	}

	function send_pelanggaran(violation, nrp, hari, jenis) {
		if (violation != "0") {
			$('#loading5').show();
			$.ajax({
				type:'POST',
				url:'{{route("students.set_pelanggaran")}}',
				data:{'_token':'{{csrf_token()}}',
					'nrp':nrp,
					'violation':violation,
					'hari':hari,
					'jenis':jenis,
					},
				success: function(data){
					$('#loading5').hide();
					var count = parseInt(document.getElementById("count_pelanggaran_"+nrp).getAttribute('value'));
					if (jenis == "plus") {
						count = count + 1;
					} else {
						count = count - 1;
					}
					document.getElementById("count_pelanggaran_"+nrp).setAttribute('value', count);
					document.getElementById("count_pelanggaran_"+nrp).innerText = count;
					if (data.status == "new") {
						document.querySelector("#tabel-data-pelanggaran").innerHTML += data.msg;
					} else if (data.status == "update") {
						count = parseInt(document.getElementById("count_detail_"+nrp+"_"+violation).getAttribute('value'));
						if (jenis == "plus") {
							count = count + 1;
						} else {
							count = count - 1;
						}
						document.getElementById("count_detail_"+nrp+"_"+violation).setAttribute('value', count);
						document.getElementById("count_detail_"+nrp+"_"+violation).innerText = count + " x";
					} else if (data.status == "delete") {
						document.getElementById("baris_"+nrp+"_"+violation).remove();
					}
				},
				error: function(xhr) {
					console.log(xhr);
				}
			});
		} else {
			alert("Pilihlah jenis pelanggaran terlebih dahulu !");
		}
	}
</script>
@endsection