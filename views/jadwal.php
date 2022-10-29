<?php require_once("../controller/script.php");
require_once("redirect.php");
$_SESSION['page-name'] = "Jadwal";
$_SESSION['page-url'] = "jadwal";
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
                      <a href="#" class="btn btn-primary text-white me-0" data-bs-toggle="modal" data-bs-target="#tambah-jadwal">Tambah</a>
                    </div>
                  </div>
                </div>
                <div class="card rounded-0 mt-3">
                  <div class="card-body table-responsive">
                    <table class="table table-striped table-hover table-borderless table-sm text-center">
                      <thead>
                        <tr>
                          <th scope="col">#</th>
                          <th scope="col">Rombel</th>
                          <th scope="col">Tahun Ajar</th>
                          <th scope="col">Tgl Buat</th>
                          <th scope="col">Tgl Ubah</th>
                          <th scope="col" colspan="3">Aksi</th>
                        </tr>
                      </thead>
                      <tbody id="search-page">
                        <?php if (mysqli_num_rows($jadwal) == 0) { ?>
                          <tr>
                            <th scope="row" colspan="6">belum ada data jadwal</th>
                          </tr>
                          <?php } else if (mysqli_num_rows($jadwal) > 0) {
                          $no = 1;
                          while ($row = mysqli_fetch_assoc($jadwal)) { ?>
                            <tr>
                              <th scope="row"><?= $no; ?></th>
                              <td><?= $row['rombel'] ?></td>
                              <td><?= $row['tahun'] ?></td>
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
                                <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#info-jadwal<?= $row['id_jadwal'] ?>">
                                  <i class="bi bi-info-square"></i> Jadwal
                                </button>
                                <?php
                                $namaFile = $row['file'];
                                $ekstensiGambarValid = ['jpg', 'png', 'jpeg', 'heic'];
                                $ekstensiGambar = explode('.', $namaFile);
                                $ekstensiGambar = strtolower(end($ekstensiGambar));
                                if (!in_array($ekstensiGambar, $ekstensiGambarValid)) {
                                ?>
                                  <div class="modal fade" id="info-jadwal<?= $row['id_jadwal'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                      <div class="modal-content">
                                        <div class="modal-header border-bottom-0 shadow">
                                          <h5 class="modal-title" id="exampleModalLabel">Jadwal rombel <?= $row['rombel'] ?> pada tahun <?= $row['tahun'] ?></h5>
                                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body text-center">
                                          <embed type="application/pdf" src="../assets/file/jadwal/<?= $row['file'] ?>" style="width: 100%;height: 450px;"></embed>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                <?php } else { ?>
                                  <div class="modal fade" id="info-jadwal<?= $row['id_jadwal'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                      <div class="modal-content">
                                        <div class="modal-header border-bottom-0 shadow">
                                          <h5 class="modal-title" id="exampleModalLabel">Jadwal rombel <?= $row['rombel'] ?> pada tahun <?= $row['tahun'] ?></h5>
                                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body text-center">
                                          <img src="../assets/file/jadwal/<?= $row['file'] ?>" class="img-fluid rounded-0" style="width: 100%;height: auto;" alt="">
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                <?php } ?>
                              </td>
                              <td>
                                <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#ubah<?= $row['id_jadwal'] ?>">
                                  <i class="bi bi-pencil-square"></i>
                                </button>
                                <div class="modal fade" id="ubah<?= $row['id_jadwal'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                  <div class="modal-dialog">
                                    <div class="modal-content">
                                      <div class="modal-header border-bottom-0 shadow">
                                        <h5 class="modal-title" id="exampleModalLabel">Ubah data rombel <?= $row['rombel'] ?> tahun <?= $row['tahun'] ?></h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                      </div>
                                      <form action="" method="POST" enctype="multipart/form-data">
                                        <div class="modal-body">
                                          <div class="mb-3">
                                            <label for="rombel" class="form-label">Rombel <small>(Rombongan Belajar)</small> <small class="text-danger">*</small></label>
                                            <input type="number" name="rombel" value="<?= $row['rombel'] ?>" class="form-control" id="rombel" minlength="3" placeholder="Rombel" required>
                                          </div>
                                          <div class="mb-3">
                                            <label for="tahun" class="form-label">Tahun <small class="text-danger">*</small></label>
                                            <input type="month" name="tahun" value="<?= $row['tahun'] ?>" class="form-control" id="tahun" minlength="3" placeholder="tahun" required>
                                            <small class="text-danger">Input yang di ambil hanya tahun!</small>
                                          </div>
                                          <div class="mb-3">
                                            <label for="jadwal" class="form-label">Upload Jadwal</label>
                                            <input class="form-control mb-2" type="file" name="jadwal" id="jadwal">
                                            <small class="text-danger"><span class="badge bg-danger text-dark rounded-1">Perhatian!</span> File jadwal dalam bentuk gambar atau pdf.</small>
                                          </div>
                                        </div>
                                        <div class="modal-footer justify-content-center border-top-0">
                                          <input type="hidden" name="id-jadwal" value="<?= $row['id_jadwal'] ?>">
                                          <input type="hidden" name="nama-jadwal" value="rombel <?= $row['rombel'] ?> pada tahun <?= $row['tahun'] ?>">
                                          <input type="hidden" name="fileOld" value="<?= $row['file'] ?>">
                                          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                          <button type="submit" name="ubah-jadwal" class="btn btn-warning">Ubah</button>
                                        </div>
                                      </form>
                                    </div>
                                  </div>
                                </div>
                              </td>
                              <td>
                                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#hapus<?= $row['id_jadwal'] ?>">
                                  <i class="bi bi-trash3"></i>
                                </button>
                                <div class="modal fade" id="hapus<?= $row['id_jadwal'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                  <div class="modal-dialog">
                                    <div class="modal-content">
                                      <div class="modal-header border-bottom-0 shadow">
                                        <h5 class="modal-title" id="exampleModalLabel">Hapus data rombel <?= $row['rombel'] ?> tahun <?= $row['tahun'] ?></h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                      </div>
                                      <div class="modal-body">
                                        Anda yakin ingin menghapus rombel <?= $row['rombel'] ?> tahun <?= $row['tahun'] ?> ini?
                                      </div>
                                      <div class="modal-footer justify-content-center border-top-0">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                        <form action="" method="POST">
                                          <input type="hidden" name="id-jadwal" value="<?= $row['id_jadwal'] ?>">
                                          <input type="hidden" name="nama-jadwal" value="rombel <?= $row['rombel'] ?> tahun <?= $row['tahun'] ?>">
                                          <input type="hidden" name="fileOld" value="<?= $row['file'] ?>">
                                          <button type="submit" name="hapus-jadwal" class="btn btn-danger">Hapus</button>
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
                    <?php if ($total_role2 > $data_role2) { ?>
                      <div class="d-flex justify-content-between mt-4 flex-wrap">
                        <p class="text-muted">Showing 1 to <?= $data_role2 ?> of <?= $total_role2 ?> entries</p>
                        <nav class="ml-auto">
                          <ul class="pagination separated pagination-info">
                            <?php if (isset($page_role2)) {
                              if (isset($total_page_role2)) {
                                if ($page_role2 > 1) : ?>
                                  <li class="page-item">
                                    <a href="<?= $_SESSION['page-url'] ?>?page=<?= $page_role2 - 1; ?>/" class="btn btn-primary btn-sm rounded-0"><i class="bi bi-arrow-bar-left text-white"></i></a>
                                  </li>
                                  <?php endif;
                                for ($i = 1; $i <= $total_page_role2; $i++) : if ($i <= 4) : if ($i == $page_role2) : ?>
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
                                if ($total_page_role2 >= 4) : ?>
                                  <li class="page-item">
                                    <a href="<?= $_SESSION['page-url'] ?>?page=<?php if ($page_role2 > 4) {
                                                                                  echo $page_role2;
                                                                                } else if ($page_role2 <= 4) {
                                                                                  echo '5';
                                                                                } ?>/" class="btn btn-<?php if ($page_role2 <= 4) {
                                                                                                        echo 'outline-';
                                                                                                      } ?>primary btn-sm rounded-0"><?php if ($page_role2 > 4) {
                                                                                                                                      echo $page_role2;
                                                                                                                                    } else if ($page_role2 <= 4) {
                                                                                                                                      echo '5';
                                                                                                                                    } ?></a>
                                  </li>
                                <?php endif;
                                if ($page_role2 < $total_page_role2 && $total_page_role2 >= 4) : ?>
                                  <li class="page-item">
                                    <a href="<?= $_SESSION['page-url'] ?>?page=<?= $page_role2 + 1; ?>/" class="btn btn-primary btn-sm rounded-0"><i class="bi bi-arrow-bar-right"></i></a>
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

        <div class="modal fade" id="tambah-jadwal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header border-bottom-0 shadow">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Jadwal</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <form action="" method="post" name="random_form" enctype="multipart/form-data">
                <div class="modal-body text-center">
                  <div class="mb-3">
                    <label for="rombel" class="form-label">Rombel <small>(Rombongan Belajar)</small> <small class="text-danger">*</small></label>
                    <input type="number" name="rombel" class="form-control" id="rombel" minlength="3" placeholder="Rombel" required>
                  </div>
                  <div class="mb-3">
                    <label for="tahun" class="form-label">Tahun <small class="text-danger">*</small></label>
                    <input type="month" name="tahun" class="form-control" id="tahun" minlength="3" placeholder="tahun" required>
                    <small class="text-danger">Input yang di ambil hanya tahun!</small>
                  </div>
                  <div class="mb-3">
                    <label for="jadwal" class="form-label">Upload Jadwal <small class="text-danger">*</small></label>
                    <input class="form-control mb-2" type="file" name="jadwal" id="jadwal" required>
                    <small class="text-danger"><span class="badge bg-danger text-dark rounded-1">Perhatian!</span> File jadwal dalam bentuk gambar atau pdf.</small>
                  </div>
                </div>
                <div class="modal-footer border-top-0 justify-content-center">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                  <button type="submit" name="tambah-jadwal" class="btn btn-primary">Simpan</button>
                </div>
              </form>
            </div>
          </div>
        </div>
        <?php require_once("../resources/dash-footer.php") ?>
</body>

</html>