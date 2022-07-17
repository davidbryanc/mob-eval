<h6><b>{{$sesi->namasesi}}, {{$sesi->jadwal->namajadwal}} - {{date('D, j M Y', strtotime($sesi->jadwal->tanggal))}}</b></h6>
<div class="table-responsive">
	<table class="table table-striped table-sm">
		<thead>
			<tr class="text-center">
				<th style="min-width: 140px" class="text-left">Nama / NRP</th>
				<th style="min-width: 10px"></th>
				<th style="min-width: 40px"><span class="text-success">H</span></th>
				<th style="min-width: 40px"><span class="text-danger">A</span></th>
				<th style="min-width: 40px"><span class="text-warning">I</span></th>
				<th>Pelanggaran</th>
			</tr>
		</thead>
		<tbody>
			@if (count($mahasiswa) > 0)
				@foreach ($mahasiswa as $mhs)
					<tr class="text-center">
						<td class="text-left" style="font-size: 80%">{{$mhs->nama}}<br><small class="text-muted">{{$mhs->nrp}}</small></td>
						<td id="status_{{$mhs->nrp}}">
							@if ($status_absen[$mhs->nrp] == 1)
								<span class="iconify text-success" data-icon="mdi:check-bold" data-inline="false"></span>
							@elseif($status_absen[$mhs->nrp] == 0)
								<span class="iconify text-danger" data-icon="mdi:check-bold" data-inline="false"></span>
							@elseif($status_absen[$mhs->nrp] == 2)
								<span class="iconify text-warning" data-icon="mdi:check-bold" data-inline="false"></span>
							@endif
						</td>
						<td class="align-middle">
							<input type="radio" style="transform: scale(1.5);" name="absensi_{{$mhs->nrp}}" onclick="send_absensi({{$mhs->nrp}},1)" @if($status_absen[$mhs->nrp] == 1) checked @endif>
						</td>
						<td class="align-middle">
							<input type="radio" style="transform: scale(1.5);" name="absensi_{{$mhs->nrp}}" onclick="send_absensi({{$mhs->nrp}},0)" @if($status_absen[$mhs->nrp] == 0) checked @endif>
						</td>
						<td class="align-middle">
							<input type="radio" style="transform: scale(1.5);" name="absensi_{{$mhs->nrp}}" onclick="openModalIjin({{$mhs->nrp}})" @if($status_absen[$mhs->nrp] == 2) checked @endif data-toggle="modal" data-target="#modal_ijin">
						</td>
						<td class="align-middle"><span id="count_pelanggaran_{{$mhs->nrp}}" value="{{$count_pelanggaran[$mhs->nrp]}}">{{$count_pelanggaran[$mhs->nrp]}}</span> &nbsp;&nbsp;&nbsp; <button class="btn btn-sm btn-warning font-weight-bold py-0 px-2" data-toggle="modal" data-target="#modal_pelanggaran" onclick="openModalPelanggaran({{$mhs->nrp}}, {{$idhari}})"><span style="font-size: 1.25em"><span class="iconify" data-icon="mdi:square-edit-outline" data-inline="false"></span></span></button></td>
					</tr>
				@endforeach
			@endif
		</tbody>
	</table>
</div>