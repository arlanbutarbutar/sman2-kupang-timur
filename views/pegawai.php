<?php require_once("../controller/script.php");
require_once("redirect.php");
$_SESSION['page-name'] = "Pegawai";
$_SESSION['page-url'] = "pegawai";
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
                      <a href="#" class="btn btn-primary text-white me-0" data-bs-toggle="modal" data-bs-target="#tambah-pegawai">Tambah</a>
                      <a style="cursor: pointer;" class="btn btn-outline-primary me-0" data-bs-toggle="modal" data-bs-target="#exampleModal">Export</a>
                      <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                          <div class="modal-content">
                            <div class="modal-header border-bottom-0">
                              <h5 class="modal-title" id="exampleModalLabel"></h5>
                              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                              <div class="row">
                                <div class="col-lg-6">
                                  <a style="cursor: pointer;" onclick="window.location.href='export-pegawai-excel'">
                                    <div class="card card-body text-center rounded-0">
                                      <i class="bi bi-file-earmark-excel" style="font-size: 60px;"></i>
                                      <h4>Export Excel</h4>
                                    </div>
                                  </a>
                                </div>
                                <div class="col-lg-6">
                                  <a style="cursor: pointer;" onclick="window.open('export-pegawai-pdf', 'blank')">
                                    <div class="card card-body text-center rounded-0">
                                      <i class="bi bi-filetype-pdf" style="font-size: 60px;"></i>
                                      <h4>Export PDF</h4>
                                    </div>
                                  </a>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="card rounded-0 mt-3">
                  <div class="card-body table-responsive">
                    <table class="table table-striped table-hover table-borderless table-sm text-center">
                      <thead>
                        <tr>
                          <th scope="col">#</th>
                          <th scope="col">NIP</th>
                          <th scope="col">Nama</th>
                          <th scope="col">Alamat</th>
                          <th scope="col">Jabatan</th>
                          <th scope="col">Jenis Kelamin</th>
                          <th scope="col">Tgl Buat</th>
                          <th scope="col">Tgl Ubah</th>
                          <th scope="col" colspan="2">Aksi</th>
                        </tr>
                      </thead>
                      <tbody id="search-page">
                        <?php if (mysqli_num_rows($pegawai) == 0) { ?>
                          <tr>
                            <th scope="row" colspan="10">belum ada data pegawai</th>
                          </tr>
                          <?php } else if (mysqli_num_rows($pegawai) > 0) {
                          $no = 1;
                          while ($row = mysqli_fetch_assoc($pegawai)) { ?>
                            <tr>
                              <th scope="row"><?= $no; ?></th>
                              <td><?php if ($row['nip'] == "") {
                                    echo "-";
                                  } else if ($row['nip'] != "") {
                                    echo $row['nip'];
                                  } ?></td>
                              <td><?= $row['nama_pegawai'] ?></td>
                              <td><?= $row['alamat_pegawai'] ?></td>
                              <td><?= $row['jabatan_pegawai'] ?></td>
                              <td><?= $row['jk_pegawai'] ?></td>
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
                                <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#ubah<?= $row['id_pegawai'] ?>">
                                  <i class="bi bi-pencil-square"></i>
                                </button>
                                <div class="modal fade" id="ubah<?= $row['id_pegawai'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                  <div class="modal-dialog">
                                    <div class="modal-content">
                                      <div class="modal-header border-bottom-0 shadow">
                                        <h5 class="modal-title" id="exampleModalLabel">Ubah data <?= $row['nama_pegawai'] ?></h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                      </div>
                                      <form action="" method="POST">
                                        <div class="modal-body">
                                          <div class="mb-3">
                                            <label for="nip" class="form-label">NIP</label>
                                            <input type="number" name="nip" value="<?= $row['nip'] ?>" class="form-control" id="nip" minlength="5" placeholder="NIP">
                                          </div>
                                          <div class="mb-3">
                                            <label for="nama" class="form-label">Nama <small class="text-danger">*</small></label>
                                            <input type="text" name="nama" value="<?= $row['nama_pegawai'] ?>" class="form-control" id="nama" minlength="3" placeholder="Nama" required>
                                          </div>
                                          <div class="mb-3">
                                            <label for="alamat" class="form-label">Alamat <small class="text-danger">*</small></label>
                                            <input type="text" name="alamat" value="<?= $row['alamat_pegawai'] ?>" class="form-control" id="alamat" minlength="3" placeholder="Alamat" required>
                                          </div>
                                          <div class="mb-3">
                                            <label for="jabatan" class="form-label">Jabatan <small class="text-danger">*</small></label>
                                            <input type="text" name="jabatan" value="<?= $row['jabatan_pegawai'] ?>" class="form-control" id="jabatan" placeholder="Jabatan" required>
                                          </div>
                                          <div class="mb-3">
                                            <label for="jenis-kelamin" class="form-label">Jenis Kelamin <small class="text-danger">*</small></label>
                                            <select name="jk" id="jenis-kelamin" class="form-select" aria-label="Default select example" required>
                                              <option selected value="">Pilih Jenis Kelamin</option>
                                              <option value="Laki-Laki">Laki-Laki</option>
                                              <option value="Perempuan">Perempuan</option>
                                            </select>
                                          </div>
                                        </div>
                                        <div class="modal-footer justify-content-center border-top-0">
                                          <input type="hidden" name="id-pegawai" value="<?= $row['id_pegawai'] ?>">
                                          <input type="hidden" name="namaOld" value="<?= $row['nama_pegawai'] ?>">
                                          <input type="hidden" name="nipOld" value="<?= $row['nip'] ?>">
                                          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                          <button type="submit" name="ubah-pegawai" class="btn btn-warning">Ubah</button>
                                        </div>
                                      </form>
                                    </div>
                                  </div>
                                </div>
                              </td>
                              <td>
                                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#hapus<?= $row['id_pegawai'] ?>">
                                  <i class="bi bi-trash3"></i>
                                </button>
                                <div class="modal fade" id="hapus<?= $row['id_pegawai'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                  <div class="modal-dialog">
                                    <div class="modal-content">
                                      <div class="modal-header border-bottom-0 shadow">
                                        <h5 class="modal-title" id="exampleModalLabel">Hapus data <?= $row['nama_pegawai'] ?></h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                      </div>
                                      <div class="modal-body">
                                        Anda yakin ingin menghapus data <?= $row['nama_pegawai'] ?> ini?
                                      </div>
                                      <div class="modal-footer justify-content-center border-top-0">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                        <form action="" method="POST">
                                          <input type="hidden" name="id-pegawai" value="<?= $row['id_pegawai'] ?>">
                                          <input type="hidden" name="nama" value="<?= $row['nama_pegawai'] ?>">
                                          <button type="submit" name="hapus-pegawai" class="btn btn-danger">Hapus</button>
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
                    <?php if ($total_role5 > $data_role5) { ?>
                      <div class="d-flex justify-content-between mt-4 flex-wrap">
                        <p class="text-muted">Showing 1 to <?= $data_role5 ?> of <?= $total_role5 ?> entries</p>
                        <nav class="ml-auto">
                          <ul class="pagination separated pagination-info">
                            <?php if (isset($page_role5)) {
                              if (isset($total_page_role5)) {
                                if ($page_role5 > 1) : ?>
                                  <li class="page-item">
                                    <a href="<?= $_SESSION['page-url'] ?>?page=<?= $page_role5 - 1; ?>/" class="btn btn-primary btn-sm rounded-0"><i class="bi bi-arrow-bar-left text-white"></i></a>
                                  </li>
                                  <?php endif;
                                for ($i = 1; $i <= $total_page_role5; $i++) : if ($i <= 4) : if ($i == $page_role5) : ?>
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
                                if ($total_page_role5 >= 4) : ?>
                                  <li class="page-item">
                                    <a href="<?= $_SESSION['page-url'] ?>?page=<?php if ($page_role5 > 4) {
                                                                                  echo $page_role5;
                                                                                } else if ($page_role5 <= 4) {
                                                                                  echo '5';
                                                                                } ?>/" class="btn btn-<?php if ($page_role5 <= 4) {
                                                                                                        echo 'outline-';
                                                                                                      } ?>primary btn-sm rounded-0"><?php if ($page_role5 > 4) {
                                                                                                                                      echo $page_role5;
                                                                                                                                    } else if ($page_role5 <= 4) {
                                                                                                                                      echo '5';
                                                                                                                                    } ?></a>
                                  </li>
                                <?php endif;
                                if ($page_role5 < $total_page_role5 && $total_page_role5 >= 4) : ?>
                                  <li class="page-item">
                                    <a href="<?= $_SESSION['page-url'] ?>?page=<?= $page_role5 + 1; ?>/" class="btn btn-primary btn-sm rounded-0"><i class="bi bi-arrow-bar-right"></i></a>
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

        <div class="modal fade" id="tambah-pegawai" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header border-bottom-0 shadow">
                <h5 class="modal-title" id="exampleModalLabel">Tambah pegawai</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <form action="" method="post">
                <div class="modal-body text-center">
                  <div class="mb-3">
                    <label for="nip" class="form-label">NIP</label>
                    <input type="number" name="nip" class="form-control" id="nip" minlength="5" placeholder="NIP">
                  </div>
                  <div class="mb-3">
                    <label for="nama" class="form-label">Nama <small class="text-danger">*</small></label>
                    <input type="text" name="nama" class="form-control" id="nama" minlength="3" placeholder="Nama" required>
                  </div>
                  <div class="mb-3">
                    <label for="alamat" class="form-label">Alamat <small class="text-danger">*</small></label>
                    <input type="text" name="alamat" class="form-control" id="alamat" minlength="3" placeholder="Alamat" required>
                  </div>
                  <div class="mb-3">
                    <label for="jabatan" class="form-label">Jabatan <small class="text-danger">*</small></label>
                    <input type="text" name="jabatan" class="form-control" id="jabatan" placeholder="Jabatan" required>
                  </div>
                  <div class="mb-3">
                    <label for="jenis-kelamin" class="form-label">Jenis Kelamin <small class="text-danger">*</small></label>
                    <select name="jk" id="jenis-kelamin" class="form-select" aria-label="Default select example" required>
                      <option selected value="">Pilih Jenis Kelamin</option>
                      <option value="Laki-Laki">Laki-Laki</option>
                      <option value="Perempuan">Perempuan</option>
                    </select>
                  </div>
                </div>
                <div class="modal-footer border-top-0 justify-content-center">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                  <button type="submit" name="tambah-pegawai" class="btn btn-primary">Simpan</button>
                </div>
              </form>
            </div>
          </div>
        </div>
        <?php require_once("../resources/dash-footer.php") ?>
</body>

</html>