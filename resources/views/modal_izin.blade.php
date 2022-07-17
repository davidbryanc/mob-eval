<div class="modal-header py-2">
	<h6 class="modal-title" id="exampleModalCenterTitle">{{$mahasiswa->nama}} - <small>{{$mahasiswa->nrp}}</small></h6>
	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
		<span aria-hidden="true">&times;</span>
	</button>
</div>
<div class="modal-body">
	<div class="row">
		<div class="col">
			<label for="">Alasan Izin</label>
			<textarea id="alasan_{{$mahasiswa->nrp}}" rows="5" class="form-control">{{$alasan}}</textarea>
		</div>
	</div>
</div>
<div class="modal-footer p-1">
	<button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Close</button>
	<button type="button" class="btn btn-sm btn-primary" onclick="send_absensi({{$mahasiswa->nrp}},2)">Save</button>
</div>