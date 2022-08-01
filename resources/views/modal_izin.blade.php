<div class="modal-header py-2">
	<h6 class="modal-title" id="exampleModalCenterTitle">{{$mahasiswa->nama}} - <small>{{$mahasiswa->nrp}}</small></h6>
	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
		<span aria-hidden="true">&times;</span>
	</button>
</div>
<div class="modal-body">
	<div class="row">
		<div class="col">
			<form action="{{ route('students.set_absensi') }}" method="post" enctype="multipart/form-data" id="form_bukti">
				@csrf
				<label for="">Alasan Izin</label>
				<input id="alasan_{{$mahasiswa->nrp}}" class="form-control" value="{{$alasan}}" name="alasan">
				<input type="hidden" name="nrp" value="{{$mahasiswa->nrp}}">
				<input type="hidden" name="absen" value="2">
				<input type="hidden" name="idsesi" value="{{ $idsesi }}">
				@if ($file != null)
					<div class="mt-3">
						Bukti izin: <a href="{{ asset('files/'.$file) }}" target="_blank">Klik</a>
					</div> 
				@else
					<div class="mb-3 ms-3 mt-4">
						<label for="bukti" class="form-label">Wajib menyertakan bukti izin (PDF/IMG) maks 3MB</label>
						<input class="form-control @error('bukti') is-invalid @enderror" type="file" accept="application/pdf,image/*" id="bukti_{{$mahasiswa->nrp}}" name="bukti"/>
						@error('bukti')
							<div class="invalid-feedback text-center">
								{{ $message }}
							</div>
						@enderror
					</div>
					<button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Close</button>
					<input type="submit" class="btn btn-sm btn-primary" name="submit" value="Submit" />
				@endif
			</form>
		</div>
	</div>
</div>
