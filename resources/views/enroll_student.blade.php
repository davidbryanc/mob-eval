@if (count($mahasiswa) > 0)
<div class="col-12">
	<h6>Hasil Pencarian :</h6>
</div>
<div class="col-12">
	<div class="row">
		@foreach ($mahasiswa as $mhs)
		<div class="col-sm-12 col-md-6 col-lg-4">
			<div class="card mt-3">
				<div class="card-body">
					<small>
						<div class="row">
							<div class="col-4"><b>NRP :</b></div><div class="col">{{$mhs['nrp']}}</div>
						</div>
						<div class="row">
							<div class="col-4"><b>Nama :</b></div><div class="col">{{$mhs['nama']}}</div>
						</div>
						<div class="row">
							<div class="col-4"><b>Fakultas :</b></div><div class="col">{{$mhs['fakultas']}}</div>
						</div>
					</div>
				</small>
				<div class="row mt-3">
					<div class="col"><button class="btn btn-sm btn-block btn-primary" onclick="enroll('{{$mhs['nrp']}}')">Enroll</button></div>
				</div>
			</div>
		</div>
		@endforeach
	</div>
</div>
@else
<div class="col-12">
	<h6>Hasil Pencarian : Hasil tidak ditemukan</h6>
</div>
@endif