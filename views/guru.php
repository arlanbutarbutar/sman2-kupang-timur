<?php require_once("../controller/script.php");
require_once("redirect.php");
$_SESSION['page-name'] = "Guru";
$_SESSION['page-url'] = "guru";
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
                      <a href="#" class="btn btn-primary text-white me-0" data-bs-toggle="modal" data-bs-target="#tambah-guru">Tambah</a>
                      <!-- <a href="#" class="btn btn-outline-primary text-white me-0" data-bs-toggle="modal" data-bs-target="#import-guru">Import</a> -->
                      <a style="cursor: pointer;" onclick="window.location.href='export-guru'" class="btn btn-outline-primary text-white me-0">Export</a>
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
                          <th scope="col">TTL</th>
                          <th scope="col">Golongan</th>
                          <th scope="col">TMT <small>(Terhitung Mulai Tanggal)</small></th>
                          <th scope="col">Jabatan</th>
                          <th scope="col">Gelar</th>
                          <th scope="col">Tahun Lulus</th>
                          <th scope="col">Tgl Buat</th>
                          <th scope="col">Tgl Ubah</th>
                          <th scope="col" colspan="3">Aksi</th>
                        </tr>
                      </thead>
                      <tbody id="search-page">
                        <?php if (mysqli_num_rows($guru) == 0) { ?>
                          <tr>
                            <th scope="row" colspan="14">belum ada data guru</th>
                          </tr>
                          <?php } else if (mysqli_num_rows($guru) > 0) {
                          $no = 1;
                          while ($row = mysqli_fetch_assoc($guru)) { ?>
                            <tr>
                              <th scope="row"><?= $no; ?></th>
                              <td><?= $row['nip'] ?></td>
                              <td><?= $row['nama'] ?></td>
                              <td><?= $row['tempat_lahir'] . ", " . $row['tgl_lahir'] ?></td>
                              <td><?= $row['gol'] ?></td>
                              <td>
                                <?php $tmt = date_create($row['tmt']);
                                echo date_format($tmt, "l, d M Y"); ?>
                              </td>
                              <td><?= $row['jabatan'] ?></td>
                              <td><?= $row['gelar'] ?></td>
                              <td><?= $row['thn_lulus'] ?></td>
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
                                <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#info-ijasah<?= $row['id_guru'] ?>">
                                  <i class="bi bi-info-square"></i> Ijasah
                                </button>
                                <div class="modal fade" id="info-ijasah<?= $row['id_guru'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                  <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                      <div class="modal-header border-bottom-0 shadow">
                                        <h5 class="modal-title" id="exampleModalLabel">Ijasah <?= $row['nama'] ?></h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                      </div>
                                      <div class="modal-body text-center">
                                        <embed type="application/pdf" src="../assets/file/ijasah/<?= $row['ijasah'] ?>" style="width: 100%;height: 450px;"></embed>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </td>
                              <td>
                                <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#ubah<?= $row['id_guru'] ?>">
                                  <i class="bi bi-pencil-square"></i>
                                </button>
                                <div class="modal fade" id="ubah<?= $row['id_guru'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                  <div class="modal-dialog">
                                    <div class="modal-content">
                                      <div class="modal-header border-bottom-0 shadow">
                                        <h5 class="modal-title" id="exampleModalLabel">Ubah data <?= $row['nama'] ?></h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                      </div>
                                      <form action="" method="POST">
                                        <div class="modal-body">
                                          <div class="mb-3">
                                            <label for="nip" class="form-label">NIP <small class="text-danger">*</small></label>
                                            <input type="number" name="nip" value="<?= $row['nip'] ?>" class="form-control" id="nip" minlength="5" placeholder="NIP" required>
                                          </div>
                                          <div class="mb-3">
                                            <label for="nama" class="form-label">Nama <small class="text-danger">*</small></label>
                                            <input type="text" name="nama" value="<?= $row['nama'] ?>" class="form-control" id="nama" minlength="3" placeholder="Nama" required>
                                          </div>
                                          <div class="mb-3">
                                            <label for="tempat-lahir" class="form-label">Tempat Lahir <small class="text-danger">*</small></label>
                                            <input type="text" name="tempat-lahir" value="<?= $row['tempat_lahir'] ?>" class="form-control" id="tempat-lahir" minlength="3" placeholder="Tempat Lahir" required>
                                          </div>
                                          <div class="mb-3">
                                            <label for="tgl-lahir" class="form-label">Tgl Lahir <small class="text-danger">*</small></label>
                                            <input type="date" name="tgl-lahir" value="<?= $row['tgl_lahir'] ?>" class="form-control" id="tgl-lahir" placeholder="Tgl Lahir" required>
                                          </div>
                                          <div class="mb-3">
                                            <label for="gol" class="form-label">Golongan <small class="text-danger">*</small></label>
                                            <input type="text" name="gol" value="<?= $row['gol'] ?>" class="form-control" id="gol" placeholder="Golongan" required>
                                          </div>
                                          <div class="mb-3">
                                            <label for="tmt" class="form-label">Terhitung mulai tanggal <small class="text-danger">*</small></label>
                                            <input type="date" name="tmt" value="<?= $row['tmt'] ?>" class="form-control" id="tmt" placeholder="" required>
                                          </div>
                                          <div class="mb-3">
                                            <label for="jabatan" class="form-label">Jabatan <small class="text-danger">*</small></label>
                                            <input type="text" name="jabatan" value="<?= $row['jabatan'] ?>" class="form-control" id="jabatan" minlength="3" placeholder="Jabatan" required>
                                          </div>
                                          <div class="mb-3">
                                            <label for="gelar" class="form-label">Gelar <small class="text-danger">*</small></label>
                                            <input type="text" name="gelar" value="<?= $row['gelar'] ?>" class="form-control" id="gelar" minlength="3" placeholder="Gelar" required>
                                          </div>
                                          <div class="mb-3">
                                            <label for="thn-lulus" class="form-label">Tahun Lulus <small class="text-danger">*</small></label>
                                            <input type="month" name="thn-lulus" class="form-control" id="thn-lulus" minlength="3" placeholder="Tahun Lulus" required>
                                            <small class="text-danger">Input yang di ambil hanya tahun!</small>
                                          </div>
                                          <div class="mb-3">
                                            <label for="ijasah" class="form-label">Upload Ijasah <small class="text-danger">*</small></label>
                                            <input type="file" name="ijasah" class="form-control mb-2" id="ijasah" minlength="3" placeholder="Ijasah">
                                            <small class="text-danger"><span class="badge bg-danger text-dark rounded-1">Perhatian!</span> File jadwal dalam bentuk pdf.</small>
                                          </div>
                                        </div>
                                        <div class="modal-footer justify-content-center border-top-0">
                                          <input type="hidden" name="id-guru" value="<?= $row['id_guru'] ?>">
                                          <input type="hidden" name="nama" value="<?= $row['nama'] ?>">
                                          <input type="hidden" name="nipOld" value="<?= $row['nip'] ?>">
                                          <input type="hidden" name="fileOld" value="<?= $row['ijasah'] ?>">
                                          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                          <button type="submit" name="ubah-guru" class="btn btn-warning">Ubah</button>
                                        </div>
                                      </form>
                                    </div>
                                  </div>
                                </div>
                              </td>
                              <td>
                                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#hapus<?= $row['id_guru'] ?>">
                                  <i class="bi bi-trash3"></i>
                                </button>
                                <div class="modal fade" id="hapus<?= $row['id_guru'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                  <div class="modal-dialog">
                                    <div class="modal-content">
                                      <div class="modal-header border-bottom-0 shadow">
                                        <h5 class="modal-title" id="exampleModalLabel">Hapus data <?= $row['nama'] ?></h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                      </div>
                                      <div class="modal-body">
                                        Anda yakin ingin menghapus data <?= $row['nama'] ?> ini?
                                      </div>
                                      <div class="modal-footer justify-content-center border-top-0">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                        <form action="" method="POST">
                                          <input type="hidden" name="id-guru" value="<?= $row['id_guru'] ?>">
                                          <input type="hidden" name="nama" value="<?= $row['nama'] ?>">
                                          <input type="hidden" name="fileOld" value="<?= $row['ijasah'] ?>">
                                          <button type="submit" name="hapus-guru" class="btn btn-danger">Hapus</button>
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
                    <?php if ($total_role3 > $data_role3) { ?>
                      <div class="d-flex justify-content-between mt-4 flex-wrap">
                        <p class="text-muted">Showing 1 to <?= $data_role3 ?> of <?= $total_role3 ?> entries</p>
                        <nav class="ml-auto">
                          <ul class="pagination separated pagination-info">
                            <?php if (isset($page_role3)) {
                              if (isset($total_page_role3)) {
                                if ($page_role3 > 1) : ?>
                                  <li class="page-item">
                                    <a href="<?= $_SESSION['page-url'] ?>?page=<?= $page_role3 - 1; ?>/" class="btn btn-primary btn-sm rounded-0"><i class="bi bi-arrow-bar-left text-white"></i></a>
                                  </li>
                                  <?php endif;
                                for ($i = 1; $i <= $total_page_role3; $i++) : if ($i <= 4) : if ($i == $page_role3) : ?>
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
                                if ($total_page_role3 >= 4) : ?>
                                  <li class="page-item">
                                    <a href="<?= $_SESSION['page-url'] ?>?page=<?php if ($page_role3 > 4) {
                                                                                  echo $page_role3;
                                                                                } else if ($page_role3 <= 4) {
                                                                                  echo '5';
                                                                                } ?>/" class="btn btn-<?php if ($page_role3 <= 4) {
                                                                                                        echo 'outline-';
                                                                                                      } ?>primary btn-sm rounded-0"><?php if ($page_role3 > 4) {
                                                                                                                                      echo $page_role3;
                                                                                                                                    } else if ($page_role3 <= 4) {
                                                                                                                                      echo '5';
                                                                                                                                    } ?></a>
                                  </li>
                                <?php endif;
                                if ($page_role3 < $total_page_role3 && $total_page_role3 >= 4) : ?>
                                  <li class="page-item">
                                    <a href="<?= $_SESSION['page-url'] ?>?page=<?= $page_role3 + 1; ?>/" class="btn btn-primary btn-sm rounded-0"><i class="bi bi-arrow-bar-right"></i></a>
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

        <div class="modal fade" id="tambah-guru" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header border-bottom-0 shadow">
                <h5 class="modal-title" id="exampleModalLabel">Tambah guru</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <form action="" method="post" enctype="multipart/form-data">
                <div class="modal-body text-center">
                  <div class="mb-3">
                    <label for="nip" class="form-label">NIP <small class="text-danger">*</small></label>
                    <input type="number" name="nip" class="form-control" id="nip" minlength="5" placeholder="NIP" required>
                  </div>
                  <div class="mb-3">
                    <label for="nama" class="form-label">Nama <small class="text-danger">*</small></label>
                    <input type="text" name="nama" class="form-control" id="nama" minlength="3" placeholder="Nama" required>
                  </div>
                  <div class="mb-3">
                    <label for="tempat-lahir" class="form-label">Tempat Lahir <small class="text-danger">*</small></label>
                    <input type="text" name="tempat-lahir" class="form-control" id="tempat-lahir" minlength="3" placeholder="Tempat Lahir" required>
                  </div>
                  <div class="mb-3">
                    <label for="tgl-lahir" class="form-label">Tgl Lahir <small class="text-danger">*</small></label>
                    <input type="date" name="tgl-lahir" class="form-control" id="tgl-lahir" placeholder="Tgl Lahir" required>
                  </div>
                  <div class="mb-3">
                    <label for="gol" class="form-label">Golongan <small class="text-danger">*</small></label>
                    <input type="text" name="gol" class="form-control" id="gol" placeholder="Golongan" required>
                  </div>
                  <div class="mb-3">
                    <label for="tmt" class="form-label">Terhitung mulai tanggal <small class="text-danger">*</small></label>
                    <input type="date" name="tmt" class="form-control" id="tmt" placeholder="" required>
                  </div>
                  <div class="mb-3">
                    <label for="jabatan" class="form-label">Jabatan <small class="text-danger">*</small></label>
                    <input type="text" name="jabatan" class="form-control" id="jabatan" minlength="3" placeholder="Jabatan" required>
                  </div>
                  <div class="mb-3">
                    <label for="gelar" class="form-label">Gelar <small class="text-danger">*</small></label>
                    <input type="text" name="gelar" class="form-control" id="gelar" minlength="3" placeholder="Gelar" required>
                  </div>
                  <div class="mb-3">
                    <label for="thn-lulus" class="form-label">Tahun Lulus <small class="text-danger">*</small></label>
                    <input type="month" name="thn-lulus" class="form-control" id="thn-lulus" minlength="3" placeholder="Tahun Lulus" required>
                    <small class="text-danger">Input yang di ambil hanya tahun!</small>
                  </div>
                  <div class="mb-3">
                    <label for="ijasah" class="form-label">Upload Ijasah <small class="text-danger">*</small></label>
                    <input type="file" name="ijasah" class="form-control mb-2" id="ijasah" minlength="3" placeholder="Ijasah" required>
                    <small class="text-danger"><span class="badge bg-danger text-dark rounded-1">Perhatian!</span> File jadwal dalam bentuk pdf.</small>
                  </div>
                </div>
                <div class="modal-footer border-top-0 justify-content-center">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                  <button type="submit" name="tambah-guru" class="btn btn-primary">Simpan</button>
                </div>
              </form>
            </div>
          </div>
        </div>
        <div class="modal fade" id="import-guru" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header border-bottom-0 shadow">
                <h5 class="modal-title" id="exampleModalLabel">Import data guru</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <form action="" method="POST" enctype="multipart/form-data">
                <div class="modal-body">
                  <div class="mb-3">
                    <label for="import" class="form-label">Upload data guru</label>
                    <input class="form-control" type="file" name="import" id="import">
                    <small class="text-danger">Hanya dapat mengimport file excel!</small><br>
                    <small class="text-info">Pastikan tiap nama kolom yang ada pada excel sama dengan yang ada pada form inputan guru di website! *Kecuali file Ijasah.</small>
                  </div>
                </div>
                <div class="modal-footer justify-content-center border-top-0">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                  <button type="submit" name="import-guru" class="btn btn-primary">Simpan</button>
                </div>
              </form>
            </div>
          </div>
        </div>
        <?php require_once("../resources/dash-footer.php") ?>
</body>

</html>