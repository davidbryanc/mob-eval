<tr id="baris_{{$pelanggaranMhs->mahasiswa_nrp}}_{{$pelanggaranMhs->pelanggaran_idPelanggaran}}">
	<td><small>{{$pelanggaranMhs->pelanggaran->jenisPelanggaran}}</small></td>
	<td class="align-middle" style="min-width:30px"><small id="count_detail_{{$pelanggaranMhs->mahasiswa_nrp}}_{{$pelanggaranMhs->pelanggaran_idPelanggaran}}" value="{{$pelanggaranMhs->jumlah}}">{{$pelanggaranMhs->jumlah}} x</small></td>
	<td class="align-middle"><span class="btn badge badge-danger" onclick="send_pelanggaran({{$pelanggaranMhs->pelanggaran_idPelanggaran}}, {{$pelanggaranMhs->mahasiswa_nrp}}, {{$pelanggaranMhs->jadwalhari_idjadwal}}, 'minus')"><span class="iconify" data-icon="mdi:minus" data-inline="false"></span></span></td>
</tr>