<div class="container">

    <!-- Outer Row -->
    <div class="row justify-content-center">
      <div class="col-lg-12">
        <div class="card shadow-lg my-5">
          <div class="card-header" style="
                                    background: url('<?= base_url('assets/img/'); ?>bg1.jpg');
                                    background-size: 100%;
                                    background-position: center;
                                    min-height: 200px;
                                    ">
            <!-- https://www.freepik.com/free-photo/high-angle-view-fresh-ingredients-raw-italian-pasta_4085702.htm#index=29 -->
            <div class="text-center text-white">
              <h1 class="display-3 font-weight-bold my-4">~ Lesehan Sheila ~</h1>
              <p class="lead">Tempat nongkrong paling santai!</p>
            </div>
          </div>

		<div class="card-body px-0 py-0">
			<div class="alert alert-dark text-center rounded-0 font mt-2" role="alert">
			  <h4>Menu kami hari ini!</h4>
			</div>
		    <?= 
		      $this->session->flashdata('message');
			?> 
            
			<div class="row mx-3">
				<?php foreach ($masakan as $m): ?>
					<form action="<?= base_url('user/beli'); ?>" method="post" class="col-lg-4 col-md-6 mb-4">
					  	<div class="card shadow-sm">
						  <img class="card-img-top" src="<?= base_url('assets/img/masakan/'); ?><?= $m['foto']; ?>" style="height: 220px;">
						  <div class="card-body pb-1">
						    <h4 class="card-title"><?= $m['nama_masakan']; ?></h4>
						    <div class="form-group row px-3">
						      <p class="card-text col-6">Rp. <?= $m['harga']; ?>,-</p>
							  <input type="number" class="form-control form-control-sm col-6" value="1" name="jumlah">
						    </div>
						    <div class="form-group">
							  <input type="text" class="form-control form-control-sm" placeholder="Keterangan Pesanan" name="ket">
						    </div>
						  </div>
						  <button type="submit" name="id_makanan" value="<?= $m['id_masakan']; ?>" class="card-footer btn">Pesan</button>
						</div>
					</form>
				<?php endforeach ?>
			</div>
			<div class="row justify-content-center my-5">
				<button class="btn btn-success col-5" data-toggle="modal" data-target="#exampleModal"> Selesai </button>
			</div>
		</div>
		<div class="card-footer bg-dark text-light py-0">
          <p class="text-center my-3">&copy; 2019 Saefulloh Aziz</p>
        </div>





<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Konfirmasi Pembayaran</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
	      <h4 class="lead text-center my-4">id order anda adalah : <span class="font-weight-bold"><?= $this->session->userdata('id_order'); ?></span></h4>
	      <p class="text-center">Terimakasih telah mengunjungi restoran kami. Silahkan lakukan transaksi di kasir.</span></p>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Kembali</button>
        <a href="<?= base_url('user/finish'); ?>" class="btn btn-primary">Selesai</a>
      </div>
    </div>
  </div>
</div>