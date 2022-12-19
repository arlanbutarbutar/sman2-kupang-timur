<?php require_once("../controller/script.php");
require_once("redirect.php");
$_SESSION['page-name'] = "Jadwal";
if (isset($_GET['guru'])) {
  $idguru = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $_GET['guru']))));
  $_SESSION['page-url'] = "jadwal?guru=$idguru";
} else if (!isset($_GET['guru'])) {
  $_SESSION['page-url'] = "jadwal";
}
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
                          <th scope="col">Guru</th>
                          <th scope="col">Kelas</th>
                          <th scope="col">Mata Pelajaran</th>
                          <th scope="col">Jam Mulai - Selesai</th>
                          <th scope="col">Hari</th>
                          <th scope="col">Tgl Buat</th>
                          <th scope="col">Tgl Ubah</th>
                          <?php if ($_SESSION['data-user']['role'] == 1) { ?>
                            <th scope="col" colspan="2">Aksi</th>
                          <?php } ?>
                        </tr>
                      </thead>
                      <tbody id="search-page">
                        <?php if (mysqli_num_rows($jadwal) == 0) { ?>
                          <tr>
                            <th scope="row" colspan="9">belum ada data jadwal</th>
                          </tr>
                          <?php } else if (mysqli_num_rows($jadwal) > 0) {
                          $no = 1;
                          while ($row = mysqli_fetch_assoc($jadwal)) { ?>
                            <tr>
                              <th scope="row"><?= $no; ?></th>
                              <td><?= $row['nama'] . ", " . $row['gelar'] ?></td>
                              <td><?= $row['kelas'] ?></td>
                              <td><?= $row['mapel'] ?></td>
                              <td><?= $row['jam_mulai'] . " - " . $row['jam_selesai'] ?></td>
                              <td><?= $row['hari'] ?></td>
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
                              <?php if ($_SESSION['data-user']['role'] == 1) { ?>
                                <td>
                                  <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#ubah<?= $row['id_jadwal'] ?>">
                                    <i class="bi bi-pencil-square"></i>
                                  </button>
                                  <div class="modal fade" id="ubah<?= $row['id_jadwal'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                      <div class="modal-content">
                                        <div class="modal-header border-bottom-0 shadow">
                                          <h5 class="modal-title" id="exampleModalLabel">Ubah <?= $row['mapel'] ?></h5>
                                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <form action="" method="POST">
                                          <div class="modal-body">
                                            <div class="mb-3">
                                              <label for="kelas" class="form-label">Kelas <small class="text-danger">*</small></label>
                                              <select name="kelas" class="form-select" aria-label="Default select example" required>
                                                <option selected value="">Pilih kelas</option>
                                                <?php if (mysqli_num_rows($ubah_ipa10) > 0) {
                                                  while ($row_ipa10 = mysqli_fetch_assoc($ubah_ipa10)) {
                                                    for ($xipa10 = 1; $xipa10 <= $row_ipa10['rombel_ipa10']; $xipa10++) { ?>
                                                      <option value="10 IPA <?= $xipa10; ?>">10 IPA <?= $xipa10; ?></option>
                                                    <?php }
                                                  }
                                                }
                                                if (mysqli_num_rows($ubah_ips10) > 0) {
                                                  while ($row_ips10 = mysqli_fetch_assoc($ubah_ips10)) {
                                                    for ($xips10 = 1; $xips10 <= $row_ips10['rombel_ips10']; $xips10++) { ?>
                                                      <option value="10 IPS <?= $xips10; ?>">10 IPS <?= $xips10; ?></option>
                                                    <?php }
                                                  }
                                                }
                                                if (mysqli_num_rows($ubah_ipa11) > 0) {
                                                  while ($row_ipa11 = mysqli_fetch_assoc($ubah_ipa11)) {
                                                    for ($xipa11 = 1; $xipa11 <= $row_ipa11['rombel_ipa11']; $xipa11++) { ?>
                                                      <option value="11 IPA <?= $xipa11; ?>">11 IPA <?= $xipa11; ?></option>
                                                    <?php }
                                                  }
                                                }
                                                if (mysqli_num_rows($ubah_ips11) > 0) {
                                                  while ($row_ips11 = mysqli_fetch_assoc($ubah_ips11)) {
                                                    for ($xips11 = 1; $xips11 <= $row_ips11['rombel_ips11']; $xips11++) { ?>
                                                      <option value="11 IPS <?= $xips11; ?>">11 IPS <?= $xips11; ?></option>
                                                    <?php }
                                                  }
                                                }
                                                if (mysqli_num_rows($ubah_ipa12) > 0) {
                                                  while ($row_ipa12 = mysqli_fetch_assoc($ubah_ipa12)) {
                                                    for ($xipa12 = 1; $xipa12 <= $row_ipa12['rombel_ipa12']; $xipa12++) { ?>
                                                      <option value="12 IPA <?= $xipa12; ?>">12 IPA <?= $xipa12; ?></option>
                                                    <?php }
                                                  }
                                                }
                                                if (mysqli_num_rows($ubah_ips12) > 0) {
                                                  while ($row_ips12 = mysqli_fetch_assoc($ubah_ips12)) {
                                                    for ($xips12 = 1; $xips12 <= $row_ips12['rombel_ips12']; $xips12++) { ?>
                                                      <option value="12 IPS <?= $xips12; ?>">12 IPS <?= $xips12; ?></option>
                                                <?php }
                                                  }
                                                } ?>
                                              </select>
                                            </div>
                                            <div class="mb-3">
                                              <label for="guru" class="form-label">Guru <small class="text-danger">*</small></label>
                                              <select name="id-guru" class="form-select" aria-label="" required>
                                                <option selected value="<?= $row['id_guru'] ?>"><?= $row['nama'] . ", " . $row['gelar'] ?></option>
                                                <?php $guruID = $row['id_guru'];
                                                $selectEditJadwal = mysqli_query($conn, "SELECT * FROM guru WHERE id_guru!='$guruID'");
                                                foreach ($selectEditJadwal as $data_ej) : ?>
                                                  <option value="<?= $data_ej['id_guru'] ?>"><?= $data_ej['nama'] . ", " . $data_ej['gelar'] ?></option>
                                                <?php endforeach; ?>
                                              </select>
                                            </div>
                                            <div class="mb-3">
                                              <label for="jam-mulai" class="form-label">Jam Mulai <small class="text-danger">*</small></label>
                                              <input type="time" name="jam-mulai" value="
                                              <?php $jam_mulai = date_create($row['jam_mulai']);
                                              echo date_format($jam_mulai, "h.i"); ?>" class="form-control" id="jam-mulai" placeholder="Jam Mulai" required>
                                            </div>
                                            <div class="mb-3">
                                              <label for="jam-selesai" class="form-label">Jam Selesai <small class="text-danger">*</small></label>
                                              <input type="time" name="jam-selesai" value="
                                              <?php $jam_mulai = date_create($row['jam_selesai']);
                                              echo date_format($jam_mulai, "h.i"); ?>" class="form-control" id="jam-selesai" placeholder="Jam Selesai" required>
                                            </div>
                                            <div class="mb-3">
                                              <label for="tgl" class="form-label">Hari <small class="text-danger">*</small></label>
                                              <input type="date" name="tgl" value="
                                              <?php $hari = date_create($row['created_at']);
                                              echo date_format($hari, "d/m/Y"); ?>" class="form-control" id="tgl" placeholder="Tanggal" required>
                                            </div>
                                          </div>
                                          <div class="modal-footer justify-content-center border-top-0">
                                            <input type="hidden" name="id-jadwal" value="<?= $row['id_jadwal'] ?>">
                                            <input type="hidden" name="nama-jadwal" value="<?= $row['mapel'] ?>">
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
                                          <h5 class="modal-title" id="exampleModalLabel">Hapus <?= $row['mapel'] ?></h5>
                                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                          Anda yakin ingin menghapus mapel <?= $row['mapel'] ?>?
                                        </div>
                                        <div class="modal-footer justify-content-center border-top-0">
                                          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                          <form action="" method="POST">
                                            <input type="hidden" name="id-jadwal" value="<?= $row['id_jadwal'] ?>">
                                            <input type="hidden" name="nama-jadwal" value="<?= $row['mapel'] ?>">
                                            <button type="submit" name="hapus-jadwal" class="btn btn-danger">Hapus</button>
                                          </form>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                </td>
                              <?php } ?>
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
              <form action="" method="post" name="random_form">
                <div class="modal-body text-center">
                  <div class="mb-3">
                    <label for="kelas" class="form-label">Kelas <small class="text-danger">*</small></label>
                    <select name="kelas" class="form-select" aria-label="Default select example" required>
                      <option selected value="">Pilih kelas</option>
                      <?php if (mysqli_num_rows($ipa10) > 0) {
                        while ($row_ipa10 = mysqli_fetch_assoc($ipa10)) {
                          for ($xipa10 = 1; $xipa10 <= $row_ipa10['rombel_ipa10']; $xipa10++) { ?>
                            <option value="10 IPA <?= $xipa10; ?>">10 IPA <?= $xipa10; ?></option>
                          <?php }
                        }
                      }
                      if (mysqli_num_rows($ips10) > 0) {
                        while ($row_ips10 = mysqli_fetch_assoc($ips10)) {
                          for ($xips10 = 1; $xips10 <= $row_ips10['rombel_ips10']; $xips10++) { ?>
                            <option value="10 IPS <?= $xips10; ?>">10 IPS <?= $xips10; ?></option>
                          <?php }
                        }
                      }
                      if (mysqli_num_rows($ipa11) > 0) {
                        while ($row_ipa11 = mysqli_fetch_assoc($ipa11)) {
                          for ($xipa11 = 1; $xipa11 <= $row_ipa11['rombel_ipa11']; $xipa11++) { ?>
                            <option value="11 IPA <?= $xipa11; ?>">11 IPA <?= $xipa11; ?></option>
                          <?php }
                        }
                      }
                      if (mysqli_num_rows($ips11) > 0) {
                        while ($row_ips11 = mysqli_fetch_assoc($ips11)) {
                          for ($xips11 = 1; $xips11 <= $row_ips11['rombel_ips11']; $xips11++) { ?>
                            <option value="11 IPS <?= $xips11; ?>">11 IPS <?= $xips11; ?></option>
                          <?php }
                        }
                      }
                      if (mysqli_num_rows($ipa12) > 0) {
                        while ($row_ipa12 = mysqli_fetch_assoc($ipa12)) {
                          for ($xipa12 = 1; $xipa12 <= $row_ipa12['rombel_ipa12']; $xipa12++) { ?>
                            <option value="12 IPA <?= $xipa12; ?>">12 IPA <?= $xipa12; ?></option>
                          <?php }
                        }
                      }
                      if (mysqli_num_rows($ips12) > 0) {
                        while ($row_ips12 = mysqli_fetch_assoc($ips12)) {
                          for ($xips12 = 1; $xips12 <= $row_ips12['rombel_ips12']; $xips12++) { ?>
                            <option value="12 IPS <?= $xips12; ?>">12 IPS <?= $xips12; ?></option>
                      <?php }
                        }
                      } ?>
                    </select>
                  </div>
                  <div class="mb-3">
                    <label for="guru" class="form-label">Guru <small class="text-danger">*</small></label>
                    <select name="id-guru" class="form-select" aria-label="" required>
                      <option selected value="">Pilih Guru</option>
                      <?php foreach ($selectGuru as $data_guru) : ?>
                        <option value="<?= $data_guru['id_guru'] ?>"><?= $data_guru['nama'] . ", " . $data_guru['gelar'] ?></option>
                      <?php endforeach; ?>
                    </select>
                  </div>
                  <div class="mb-3">
                    <label for="jam-mulai" class="form-label">Jam Mulai <small class="text-danger">*</small></label>
                    <input type="time" name="jam-mulai" class="form-control" id="jam-mulai" placeholder="Jam Mulai" required>
                  </div>
                  <div class="mb-3">
                    <label for="jam-selesai" class="form-label">Jam Selesai <small class="text-danger">*</small></label>
                    <input type="time" name="jam-selesai" class="form-control" id="jam-selesai" placeholder="Jam Selesai" required>
                  </div>
                  <div class="mb-3">
                    <label for="tgl" class="form-label">Hari <small class="text-danger">*</small></label>
                    <input type="date" name="tgl" class="form-control" id="tgl" placeholder="Tanggal" required>
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