<?php include_once('_header.php');?>

      <!--  Header End -->
      <div class="container-fluid">
      <div class="row">
          <div class="col-lg-4 d-flex align-items-stretch">
            <div class="card w-100">
              <div class="card-body p-4">
                <div class="mb-4">
                  <h5 class="card-title fw-semibold">Daftar Poli</h5>
                </div>
                <form role="form" method="post" action="">
              <div class="box-body">
                <div class="form-group">
                  <label>No Rekam Medis</label>
                  <input type="text" name="no_rm" class="form-control" placeholder="No Rekam Medis " required>
                </div>
                <div class="form-group">
                  <label for="id_poli">Pilih Poli <span class="text-danger"></span></label>
                  <select class="form-control" name="id_poli" required>
                      <option value="" disabled selected>Pilih Poli</option>
                      <?php
                          $result = mysqli_query($con, "SELECT * FROM dokter");
                          while ($data = mysqli_fetch_assoc($result)) {
                              echo "<option value='" . $data['id'] . "'>" . $data['nama_poli'] . "</option>";
                          }
                      ?>
                  </select>
                </div>
                <div class="form-group">
                <label for="id_poli">Pilih Jadwal <span class="text-danger"></span></label>
                  <select class="form-control" name="id_poli" required>
                      <option value="" disabled selected>Pilih Poli</option>
                      <?php
                          $result = mysqli_query($con, "SELECT * FROM dokter");
                          while ($data = mysqli_fetch_assoc($result)) {
                              echo "<option value='" . $data['id'] . "'>" . $data['nama_poli'] . "</option>";
                          }
                      ?>
                  </select>
                </div>
                <div class="form-group">
                  <label>Keluhan</label>
                  <input type="text" name="no_hp" class="form-control" placeholder="Keluhan" required>
                </div>
              </div> <br>
              <!-- /.box-body -->
              <div class="box-footer">
                <button type="submit" class="btn btn-primary" title="Simpan Data"> <i class="glyphicon glyphicon-floppy-disk"></i> Simpan</button>
              </div>
                </div>
            </form>
            </div>
          </div>
          <div class="col-lg-8 d-flex align-items-stretch">
            <div class="card w-100">
              <div class="card-body p-4">
                <h5 class="card-title fw-semibold mb-4">Riwayat Daftar Poli</h5>
                <div class="table-responsive">
                  <table class="table text-nowrap mb-0 align-middle">
                    <thead class="text-dark fs-4">
                      <tr>
                        <th class="border-bottom-0">
                          <h6 class="fw-semibold mb-0">No</h6>
                        </th>
                        <th class="border-bottom-0">
                          <h6 class="fw-semibold mb-0">Poli</h6>
                        </th>
                        <th class="border-bottom-0">
                          <h6 class="fw-semibold mb-0">Dokter</h6>
                        </th>
                        <th class="border-bottom-0">
                          <h6 class="fw-semibold mb-0">Hari</h6>
                        </th>
                        <th class="border-bottom-0">
                          <h6 class="fw-semibold mb-0">Mulai</h6>
                        </th>
                        <th class="border-bottom-0">
                          <h6 class="fw-semibold mb-0">Selesai</h6>
                        </th>
                        <th class="border-bottom-0">
                          <h6 class="fw-semibold mb-0">Antrian</h6>
                        </th>
                        <th class="border-bottom-0">
                          <h6 class="fw-semibold mb-0">Aksi</h6>
                        </th>
                      </tr>
                    </thead>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>  <!-- row -->
      </div>
    </div>
  </div>
  <?php include_once('_footer.php');?>