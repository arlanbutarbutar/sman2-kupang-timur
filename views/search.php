<?php require_once('../controller/script.php');
if ($_SESSION['page-url'] == "users") {
  if (isset($_GET['key']) && $_GET['key'] != "") {
    $key = addslashes(trim($_GET['key']));
    $keys = explode(" ", $key);
    $quer = "";
    foreach ($keys as $no => $data) {
      $data = strtolower($data);
      $quer .= "username LIKE '%$data%' OR id_user!='$idUser' AND email LIKE '%$data%'";
      if ($no + 1 < count($keys)) {
        $quer .= " OR ";
      }
    }
    $query = "SELECT * FROM users WHERE id_user!='$idUser' AND $quer ORDER BY id_user DESC LIMIT 100";
    $users = mysqli_query($conn, $query);
  }
  if (mysqli_num_rows($users) == 0) { ?>
    <tr>
      <th scope="row" colspan="7">belum ada data pengguna</th>
    </tr>
    <?php } else if (mysqli_num_rows($users) > 0) {
    $no = 1;
    while ($row = mysqli_fetch_assoc($users)) { ?>
      <tr>
        <th scope="row"><?= $no; ?></th>
        <td><?= $row['username'] ?></td>
        <td><?= $row['email'] ?></td>
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
          <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#hapus<?= $row['id_user'] ?>">
            <i class="bi bi-pencil-square"></i>
          </button>
          <div class="modal fade" id="hapus<?= $row['id_user'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header border-bottom-0 shadow">
                  <h5 class="modal-title" id="exampleModalLabel">Ubah data <?= $row['username'] ?></h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="" method="POST">
                  <div class="modal-body">
                    <div class="mb-3">
                      <label for="username" class="form-label">Nama</label>
                      <input type="text" name="username" value="<?= $row['username'] ?>" class="form-control" id="username" minlength="3" placeholder="Nama" required>
                    </div>
                    <div class="mb-3">
                      <label for="email" class="form-label">Email</label>
                      <input type="email" name="email" value="<?= $row['email'] ?>" class="form-control" id="email" placeholder="Email" required>
                    </div>
                  </div>
                  <div class="modal-footer justify-content-center border-top-0">
                    <input type="hidden" name="id-user" value="<?= $row['id_user'] ?>">
                    <input type="hidden" name="username" value="<?= $row['username'] ?>">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" name="ubah-user" class="btn btn-warning">Ubah</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </td>
        <td>
          <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#ubah<?= $row['id_user'] ?>">
            <i class="bi bi-trash3"></i>
          </button>
          <div class="modal fade" id="ubah<?= $row['id_user'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header border-bottom-0 shadow">
                  <h5 class="modal-title" id="exampleModalLabel">Hapus data <?= $row['username'] ?></h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  Anda yakin ingin menghapus <?= $row['username'] ?> ini?
                </div>
                <div class="modal-footer justify-content-center border-top-0">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                  <form action="" method="POST">
                    <input type="hidden" name="id-user" value="<?= $row['id_user'] ?>">
                    <input type="hidden" name="username" value="<?= $row['username'] ?>">
                    <button type="submit" name="hapus-user" class="btn btn-danger">Hapus</button>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </td>
      </tr>
    <?php $no++;
    }
  }
}
if ($_SESSION['page-url'] == "jadwal") {
  if (isset($_GET['key']) && $_GET['key'] != "") {
    $key = addslashes(trim($_GET['key']));
    $keys = explode(" ", $key);
    $quer = "";
    foreach ($keys as $no => $data) {
      $data = strtolower($data);
      $quer .= "rombel LIKE '%$data%' OR tahun LIKE '%$data%'";
      if ($no + 1 < count($keys)) {
        $quer .= " OR ";
      }
    }
    $query = "SELECT * FROM jadwal WHERE $quer ORDER BY id_jadwal DESC LIMIT 100";
    $jadwal = mysqli_query($conn, $query);
  }
  if (mysqli_num_rows($jadwal) == 0) { ?>
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
            <i class="bi bi-info-square"></i>
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
                      <label for="rombel" class="form-label">Rombel <small>(Rombongan Belajar)</small></label>
                      <input type="number" name="rombel" value="<?= $row['rombel'] ?>" class="form-control" id="rombel" minlength="3" placeholder="Rombel" required>
                    </div>
                    <div class="mb-3">
                      <label for="tahun" class="form-label">Tahun</label>
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
  }
}
if ($_SESSION['page-url'] == "guru") {
  if (isset($_GET['key']) && $_GET['key'] != "") {
    $key = addslashes(trim($_GET['key']));
    $keys = explode(" ", $key);
    $quer = "";
    foreach ($keys as $no => $data) {
      $data = strtolower($data);
      $quer .= "nip LIKE '%$data%'";
      if ($no + 1 < count($keys)) {
        $quer .= " OR ";
      }
    }
    $query = "SELECT * FROM guru WHERE $quer ORDER BY id_guru DESC LIMIT 100";
    $guru = mysqli_query($conn, $query);
  }
  if (mysqli_num_rows($guru) == 0) { ?>
    <tr>
      <th scope="row" colspan="14">belum ada data pengguna</th>
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
  }
}
if ($_SESSION['page-url'] == "siswa") {
  if (isset($_GET['key']) && $_GET['key'] != "") {
    $key = addslashes(trim($_GET['key']));
    $keys = explode(" ", $key);
    $quer = "";
    foreach ($keys as $no => $data) {
      $data = strtolower($data);
      $quer .= "nis LIKE '%$data%'";
      if ($no + 1 < count($keys)) {
        $quer .= " OR ";
      }
    }
    $query = "SELECT * FROM siswa WHERE $quer ORDER BY id_siswa DESC LIMIT 100";
    $siswa = mysqli_query($conn, $query);
  }
  if (mysqli_num_rows($siswa) == 0) { ?>
    <tr>
      <th scope="row" colspan="11">belum ada data siswa</th>
    </tr>
    <?php } else if (mysqli_num_rows($siswa) > 0) {
    $no = 1;
    while ($row = mysqli_fetch_assoc($siswa)) {
      $tgl_lahir = date_create($row['tgl_lahir']);
      $tgl_lahir = date_format($tgl_lahir, "d M Y"); ?>
      <tr>
        <th scope="row"><?= $no; ?></th>
        <td><?= $row['nis'] ?></td>
        <td><?= $row['nama'] ?></td>
        <td><?= $row['kelas'] ?></td>
        <td><?= $row['alamat'] ?></td>
        <td><?= $row['tempat_lahir'] . ", " . $tgl_lahir ?></td>
        <td><?= $row['agama'] ?></td>
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
          <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#ubah<?= $row['id_siswa'] ?>">
            <i class="bi bi-pencil-square"></i>
          </button>
          <div class="modal fade" id="ubah<?= $row['id_siswa'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header border-bottom-0 shadow">
                  <h5 class="modal-title" id="exampleModalLabel">Ubah data <?= $row['nama'] ?></h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="" method="POST">
                  <div class="modal-body">
                    <div class="mb-3">
                      <label for="nis" class="form-label">NIS <small class="text-danger">*</small></label>
                      <input type="number" name="nis" value="<?= $row['nis'] ?>" class="form-control" id="nis" minlength="5" placeholder="NIS" required>
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
                      <label for="alamat" class="form-label">Alamat <small class="text-danger">*</small></label>
                      <input type="text" name="alamat" value="<?= $row['alamat'] ?>" class="form-control" id="alamat" minlength="5" placeholder="Alamat" required>
                    </div>
                    <div class="mb-3">
                      <label for="agama" class="form-label">Agama <small class="text-danger">*</small></label>
                      <input type="text" name="agama" value="<?= $row['agama'] ?>" class="form-control" id="agama" minlength="4" placeholder="Agama" required>
                    </div>
                    <div class="mb-3">
                      <label for="kelas" class="form-label">Kelas <small class="text-danger">*</small></label>
                      <input type="number" name="kelas" value="<?= $row['kelas'] ?>" class="form-control" id="kelas" minlength="2" placeholder="Kelas" required>
                    </div>
                  </div>
                  <div class="modal-footer justify-content-center border-top-0">
                    <input type="hidden" name="id-siswa" value="<?= $row['id_siswa'] ?>">
                    <input type="hidden" name="nama" value="<?= $row['nama'] ?>">
                    <input type="hidden" name="nisOld" value="<?= $row['nis'] ?>">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" name="ubah-siswa" class="btn btn-warning">Ubah</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </td>
        <td>
          <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#hapus<?= $row['id_siswa'] ?>">
            <i class="bi bi-trash3"></i>
          </button>
          <div class="modal fade" id="hapus<?= $row['id_siswa'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                    <input type="hidden" name="id-siswa" value="<?= $row['id_siswa'] ?>">
                    <input type="hidden" name="nama" value="<?= $row['nama'] ?>">
                    <button type="submit" name="hapus-siswa" class="btn btn-danger">Hapus</button>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </td>
      </tr>
<?php $no++;
    }
  }
} ?>