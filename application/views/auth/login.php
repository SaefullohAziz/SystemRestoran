  <div class="container">

    <!-- Outer Row -->
    <div class="row justify-content-center">
      <div class="col-lg-10">
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
          <div class="card-body p-0">
              <?= $this->session->flashdata('message'); ?>
            <div class="row">
              <div class="col">
                <div class="p-5">
                  <h5 class="text-center text-dark mb-5">Silahkan pilih no meja anda!</h5>
                  <form method="post" action="<?= base_url('auth/login'); ?>">
                    <div class="row justify-content-center">
                    <?php foreach ($meja as $m): ?>
                      <div class="col-lg-3 col-md-6 mb-4">
                        <div class="card shadow-sm text-center p-0" >
                          <div class="card-img-top jumbotron-fluid text-white" style="background-color: rgb(40 , 35 , 35);">
                            <h1 class="display-2"><?= $m['no_meja'] ?></h1>
                          </div>
                            <button type="submit" class="card-body py-2 btn btn-white font-weight-bold" value="<?= $m['no_meja']; ?>" name="no_meja" <?php if ($m['status'] == 1){ echo 'disabled'; } ?>>
                              Meja <?= $m['no_meja']; ?>
                            </button>
                        </div>
                      </div>
                    <?php endforeach ?>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
          <div class="card-footer bg-dark text-light py-0">
            <p class="text-center my-3">&copy; 2019 Saefulloh Aziz</p>
          </div>
        </div>

      </div>

    </div>

  </div>