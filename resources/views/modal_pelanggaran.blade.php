<div class="modal-header py-2">
	<h6 class="modal-title" id="exampleModalCenterTitle">{{$mahasiswa->nama}} - <small>{{$mahasiswa->nrp}}</small></h6>
	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
		<span aria-hidden="true">&times;</span>
	</button>
</div>
<form action="">
	<div class="modal-body">
		<div class="row">
			<div class="col">
				<select name="violation" id="violation" class="form-control">
					<option value="0" selected disabled>-- Pilih Jenis Pelanggaran --</option>
					@foreach ($pelanggaran as $plg)
						<option value="{{$plg->idPelanggaran}}">{{$plg->jenisPelanggaran}}</option>
					@endforeach
				</select>
			</div>
		</div>
		<div class="row mt-3">
			<div class="col table-responsive">
				<div class="text-center">
					<img src="{{asset('assets/img/loading.gif')}}" class="loading" id="loading5" width="36px" alt="">
				</div>
				<table class="table table-sm">
					<tbody id="tabel-data-pelanggaran">
						@foreach ($pelanggaranMhs as $item)
							<tr id="baris_{{$mahasiswa->nrp}}_{{$item->pelanggaran_idPelanggaran}}">
								<td><small>{{$item->pelanggaran->jenisPelanggaran}}</small></td>
								<td class="align-middle" style="min-width: 30px"><small id="count_detail_{{$mahasiswa->nrp}}_{{$item->pelanggaran_idPelanggaran}}" value="{{$item->jumlah}}">{{$item->jumlah}} x</small></td>
								<td class="align-middle"><span class="btn badge badge-danger" onclick="send_pelanggaran({{$item->pelanggaran_idPelanggaran}}, {{$mahasiswa->nrp}}, {{$idhari}}, 'minus')"><span class="iconify" data-icon="mdi:minus" data-inline="false"></span></span></td>
							</tr>
						@endforeach
					</tbody>
				</table>
			</div>
		</div>
	</div>
	<div class="modal-footer p-1">
		<button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Close</button>
		<button type="button" class="btn btn-sm btn-primary" onclick="send_pelanggaran(document.getElementById('violation').value, {{$mahasiswa->nrp}}, {{$idhari}}, 'plus')">Add Data</button>
	</div>
</form>