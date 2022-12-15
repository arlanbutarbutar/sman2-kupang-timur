<?php require_once("../controller/script.php");
require_once("redirect.php");
$_SESSION['page-name'] = "Prestasi";
$_SESSION['page-url'] = "prestasi";
?>

<!DOCTYPE html>
<html lang="en">

<head><?php require_once("../resources/dash-header.php") ?></head>

<body style="font-family: 'Montserrat', sans-serif;">
  <?php if (isset($_SESSION['message-success'])) { ?>
    <div class="message-success" data-message-success="<?= $_SESSION['message-success'] ?>"></div>
  <?php }
  if (isset($_SESSION['message-info'])) { ?>
    <div class="message-info" data-message-info="<?= $_SESSION['message-info'] ?>"></div>
  <?php }
  if (isset($_SESSION['message-warning'])) { ?>
    <div class="message-warning" data-message-warning="<?= $_SESSION['message-warning'] ?>"></div>
  <?php }
  if (isset($_SESSION['message-danger'])) { ?>
    <div class="message-danger" data-message-danger="<?= $_SESSION['message-danger'] ?>"></div>
  <?php } ?>
  <div class="container-scroller">
    <?php require_once("../resources/dash-topbar.php") ?>
    <div class="container-fluid page-body-wrapper">
      <?php require_once("../resources/dash-sidebar.php") ?>
      <div class="main-panel">
        <div class="content-wrapper">
          <div class="row">
            <div class="col-sm-12">
              <div class="home-tab">
                <div class="d-sm-flex align-items-center justify-content-between border-bottom">
                  <ul class="nav nav-tabs" role="tablist">
                    <li class="nav-item">
                      <h3><?= $_SESSION['page-name'] ?></h3>
                    </li>
                  </ul>
                  <div>
                    <div class="btn-wrapper">
                      <a href="#" class="btn btn-primary text-white me-0" data-bs-toggle="modal" data-bs-target="#tambah-prestasi">Tambah</a>
                    </div>
                  </div>
                </div>
                <div class="card rounded-0 mt-3">
                  <div class="card-body table-responsive">
                    <table class="table table-striped table-hover table-borderless table-sm text-center">
                      <thead>
                        <tr>
                          <th scope="col">#</th>
                          <th scope="col">Siswa</th>
                          <th scope="col">Guru</th>
                          <th scope="col">Lomba</th>
                          <th scope="col">Juara</th>
                          <th scope="col">Tgl Lomba</th>
                          <th scope="col">Tgl Buat</th>
                          <th scope="col">Tgl Ubah</th>
                          <th scope="col" colspan="2">Aksi</th>
                        </tr>
                      </thead>
                      <tbody id="search-page">
                        <?php if (mysqli_num_rows($prestasi) == 0) { ?>
                          <tr>
                            <th scope="row" colspan="10">belum ada data prestasi</th>
                          </tr>
                          <?php } else if (mysqli_num_rows($prestasi) > 0) {
                          $no = 1;
                          while ($row = mysqli_fetch_assoc($prestasi)) { ?>
                            <tr>
                              <th scope="row"><?= $no; ?></th>
                              <td><?php $id_siswa = $row['id_siswa'];
                                  $siswa_prestasi = mysqli_query($conn, "SELECT * FROM siswa WHERE id_siswa='$id_siswa'");
                                  $row_sp = mysqli_fetch_assoc($siswa_prestasi);
                                  echo $row_sp['nama'];
                                  ?></td>
                              <td><?= $row['nama'] ?></td>
                              <td><?= $row['lomba'] ?></td>
                              <td><?= $row['juara'] ?></td>
                              <td>
                                <div class="badge badge-opacity-success">
                                  <?php $tgl_lomba = date_create($row['tgl_lomba']);
                                  echo date_format($tgl_lomba, "l, d M Y"); ?>
                                </div>
                              </td>
                              <td>
                                <div class="badge badge-opacity-success">
                                  <?php $dateCreate = date_create($row['created_at']);
                                  echo date_format($dateCreate, "l, d M Y h:i a"); ?>
                                </div>
                              </td>
                              <td>
                                <div class="badge badge-opacity-warning">
                                  <?php $dateUpdate = date_create($row['updated_at']);
                                  echo date_format($dateUpdate, "l, d M Y h:i a"); ?>
                                </div>
                              </td>
                              <td>
                                <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#ubah<?= $row['id_prestasi'] ?>">
                                  <i class="bi bi-pencil-square"></i>
                                </button>
                                <div class="modal fade" id="ubah<?= $row['id_prestasi'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                  <div class="modal-dialog">
                                    <div class="modal-content">
                                      <div class="modal-header border-bottom-0 shadow">
                                        <h5 class="modal-title" id="exampleModalLabel">Ubah data</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                      </div>
                                      <form action="" method="POST">
                                        <div class="modal-body">
                                          <div class="mb-3">
                                            <label for="id-siswa" class="form-label">Siswa</label>
                                            <select name="id-siswa" id="id-siswa" class="form-select" aria-label="Default select example" required>
                                              <option selected value="">Pilih Siswa</option>
                                              <?php foreach ($siswa as $row_s) : ?>
                                                <option value="<?= $row_s['id_siswa'] ?>"><?= $row_s['nama'] ?></option>
                                              <?php endforeach; ?>
                                            </select>
                                          </div>
                                          <div class="mb-3">
                                            <label for="id-guru" class="form-label">Guru</label>
                                            <select name="id-guru" id="id-guru" class="form-select" aria-label="Default select example" required>
                                              <option selected value="">Pilih Guru</option>
                                              <?php foreach ($guru as $row_g) : ?>
                                                <option value="<?= $row_g['id_guru'] ?>"><?= $row_g['nama'] ?></option>
                                              <?php endforeach; ?>
                                            </select>
                                          </div>
                                          <div class="mb-3">
                                            <label for="lomba" class="form-label">Lomba <small class="text-danger">*</small></label>
                                            <input type="text" name="lomba" value="<?= $row['lomba'] ?>" class="form-control" id="lomba" minlength="3" placeholder="Lomba" required>
                                          </div>
                                          <div class="mb-3">
                                            <label for="juara" class="form-label">Juara <small class="text-danger">*</small></label>
                                            <input type="text" name="juara" value="<?= $row['juara'] ?>" class="form-control" id="juara" placeholder="Juara" required>
                                          </div>
                                          <div class="mb-3">
                                            <label for="tgl-lomba" class="form-label">Tgl-Lomba <small class="text-danger">*</small></label>
                                            <input type="date" name="tgl-lomba" value="<?= $row['tgl_lomba'] ?>" class="form-control" id="tgl-lomba" minlength="3" placeholder="Tgl-Lomba" required>
                                          </div>
                                        </div>
                                        <div class="modal-footer justify-content-center border-top-0">
                                          <input type="hidden" name="id-prestasi" value="<?= $row['id_prestasi'] ?>">
                                          <input type="hidden" name="namaOld" value="<?= $row['lomba'] ?>">
                                          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                          <button type="submit" name="ubah-prestasi" class="btn btn-warning">Ubah</button>
                                        </div>
                                      </form>
                                    </div>
                                  </div>
                                </div>
                              </td>
                              <td>
                                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#hapus<?= $row['id_prestasi'] ?>">
                                  <i class="bi bi-trash3"></i>
                                </button>
                                <div class="modal fade" id="hapus<?= $row['id_prestasi'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                  <div class="modal-dialog">
                                    <div class="modal-content">
                                      <div class="modal-header border-bottom-0 shadow">
                                        <h5 class="modal-title" id="exampleModalLabel">Hapus data</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                      </div>
                                      <div class="modal-body">
                                        Anda yakin ingin menghapus data lomba <?= $row['lomba'] ?> ini?
                                      </div>
                                      <div class="modal-footer justify-content-center border-top-0">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                        <form action="" method="POST">
                                          <input type="hidden" name="id-prestasi" value="<?= $row['id_prestasi'] ?>">
                                          <input type="hidden" name="nama" value="<?= $row['lomba'] ?>">
                                          <button type="submit" name="hapus-prestasi" class="btn btn-danger">Hapus</button>
                                        </form>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </td>
                            </tr>
                        <?php $no++;
                          }
                        } ?>
                      </tbody>
                    </table>
                    <?php if ($total_role6 > $data_role6) { ?>
                      <div class="d-flex justify-content-between mt-4 flex-wrap">
                        <p class="text-muted">Showing 1 to <?= $data_role6 ?> of <?= $total_role6 ?> entries</p>
                        <nav class="ml-auto">
                          <ul class="pagination separated pagination-info">
                            <?php if (isset($page_role6)) {
                              if (isset($total_page_role6)) {
                                if ($page_role6 > 1) : ?>
                                  <li class="page-item">
                                    <a href="<?= $_SESSION['page-url'] ?>?page=<?= $page_role6 - 1; ?>/" class="btn btn-primary btn-sm rounded-0"><i class="bi bi-arrow-bar-left text-white"></i></a>
                                  </li>
                                  <?php endif;
                                for ($i = 1; $i <= $total_page_role6; $i++) : if ($i <= 4) : if ($i == $page_role6) : ?>
                                      <li class="page-item active">
                                        <a href="<?= $_SESSION['page-url'] ?>?page=<?= $i; ?>/" class="btn btn-primary btn-sm rounded-0 text-white"><?= $i; ?></a>
                                      </li>
                                    <?php else : ?>
                                      <li class="page-item">
                                        <a href="<?= $_SESSION['page-url'] ?>?page=<?= $i; ?>/" class="btn btn-outline-primary btn-sm rounded-0"><?= $i ?></a>
                                      </li>
                                  <?php endif;
                                  endif;
                                endfor;
                                if ($total_page_role6 >= 4) : ?>
                                  <li class="page-item">
                                    <a href="<?= $_SESSION['page-url'] ?>?page=<?php if ($page_role6 > 4) {
                                                                                  echo $page_role6;
                                                                                } else if ($page_role6 <= 4) {
                                                                                  echo '5';
                                                                                } ?>/" class="btn btn-<?php if ($page_role6 <= 4) {
                                                                                                        echo 'outline-';
                                                                                                      } ?>primary btn-sm rounded-0"><?php if ($page_role6 > 4) {
                                                                                                                                      echo $page_role6;
                                                                                                                                    } else if ($page_role6 <= 4) {
                                                                                                                                      echo '5';
                                                                                                                                    } ?></a>
                                  </li>
                                <?php endif;
                                if ($page_role6 < $total_page_role6 && $total_page_role6 >= 4) : ?>
                                  <li class="page-item">
                                    <a href="<?= $_SESSION['page-url'] ?>?page=<?= $page_role6 + 1; ?>/" class="btn btn-primary btn-sm rounded-0"><i class="bi bi-arrow-bar-right"></i></a>
                                  </li>
                            <?php endif;
                              }
                            } ?>
                          </ul>
                        </nav>
                      </div>
                    <?php } ?>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="modal fade" id="tambah-prestasi" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header border-bottom-0 shadow">
                <h5 class="modal-title" id="exampleModalLabel">Tambah prestasi</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <form action="" method="post">
                <div class="modal-body text-center">
                  <div class="mb-3">
                    <label for="id-siswa" class="form-label">Siswa</label>
                    <select name="id-siswa" id="id-siswa" class="form-select" aria-label="Default select example" required>
                      <option selected value="">Pilih Siswa</option>
                      <?php foreach ($siswa as $row_s) : ?>
                        <option value="<?= $row_s['id_siswa'] ?>"><?= $row_s['nama'] ?></option>
                      <?php endforeach; ?>
                    </select>
                  </div>
                  <div class="mb-3">
                    <label for="id-guru" class="form-label">Guru</label>
                    <select name="id-guru" id="id-guru" class="form-select" aria-label="Default select example" required>
                      <option selected value="">Pilih Guru</option>
                      <?php foreach ($guru as $row_g) : ?>
                        <option value="<?= $row_g['id_guru'] ?>"><?= $row_g['nama'] ?></option>
                      <?php endforeach; ?>
                    </select>
                  </div>
                  <div class="mb-3">
                    <label for="lomba" class="form-label">Lomba <small class="text-danger">*</small></label>
                    <input type="text" name="lomba" class="form-control" id="lomba" minlength="3" placeholder="Lomba" required>
                  </div>
                  <div class="mb-3">
                    <label for="juara" class="form-label">Juara <small class="text-danger">*</small></label>
                    <input type="text" name="juara" class="form-control" id="juara" placeholder="Juara" required>
                  </div>
                  <div class="mb-3">
                    <label for="tgl-lomba" class="form-label">Tgl-Lomba <small class="text-danger">*</small></label>
                    <input type="date" name="tgl-lomba" class="form-control" id="tgl-lomba" minlength="3" placeholder="Tgl-Lomba" required>
                  </div>
                </div>
                <div class="modal-footer border-top-0 justify-content-center">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                  <button type="submit" name="tambah-prestasi" class="btn btn-primary">Simpan</button>
                </div>
              </form>
            </div>
          </div>
        </div>
        <?php require_once("../resources/dash-footer.php") ?>
</body>

</html>