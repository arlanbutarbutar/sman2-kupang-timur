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
      $quer .= "kelas LIKE '%$data%' OR mapel LIKE '%$data%'";
      if ($no + 1 < count($keys)) {
        $quer .= " OR ";
      }
    }
    $query = "SELECT * FROM jadwal WHERE $quer ORDER BY id_jadwal DESC LIMIT 100";
    $jadwal = mysqli_query($conn, $query);
  }
  if (mysqli_num_rows($jadwal) == 0) { ?>
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
                        <?php $guruID=$row['id_guru'];
                        $selectEditJadwal=mysqli_query($conn, "SELECT * FROM guru WHERE id_guru!='$guruID'");
                        foreach ($selectEditJadwal as $data_ej) : ?>
                          <option value="<?= $data_ej['id_guru'] ?>"><?= $data_ej['nama'] . ", " . $data_ej['gelar'] ?></option>
                        <?php endforeach; ?>
                      </select>
                    </div>
                    <div class="mb-3">
                      <label for="mapel" class="form-label">Mapel <small class="text-danger">*</small></label>
                      <input type="text" name="mapel" value="<?= $row['mapel'] ?>" class="form-control" id="mapel" placeholder="Mapel" required>
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
      $quer .= "nama LIKE '%$data%'";
      if ($no + 1 < count($keys)) {
        $quer .= " OR ";
      }
    }
    $query = "SELECT * FROM guru WHERE $quer ORDER BY id_guru DESC LIMIT 100";
    $guru = mysqli_query($conn, $query);
  }
  if (mysqli_num_rows($guru) == 0) { ?>
    <tr>
      <th scope="row" colspan="12">belum ada data guru</th>
    </tr>
    <?php } else if (mysqli_num_rows($guru) > 0) {
    $no = 1;
    while ($row = mysqli_fetch_assoc($guru)) { ?>
      <tr>
        <th scope="row"><?= $no; ?></th>
        <td><?php if ($row['nip'] == "") {
              echo "-";
            } else if ($row['nip'] != "") {
              echo $row['nip'];
            } ?></td>
        <td><?= $row['nama'] ?></td>
        <td><?= $row['tempat_lahir'] . ", " . $row['tgl_lahir'] ?></td>
        <td><?= $row['status'] ?></td>
        <td><?= $row['jenis_kelamin'] ?></td>
        <!-- <td><?= $row['jabatan'] ?></td> -->
        <td><?= $row['gelar'] ?></td>
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
          <button onclick="window.location.href='jadwal?guru=<?= $row['id_guru'] ?>'" class="btn btn-primary text-white"><i class="bi bi-calendar-week menu-icon" style="color: #f4bd01;"></i> Jadwal</button>
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
                      <label for="nip" class="form-label">NIP</label>
                      <input type="number" name="nip" value="<?= $row['nip'] ?>" class="form-control" id="nip" minlength="5" placeholder="NIP">
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
                      <label for="status" class="form-label">Status <small class="text-danger">*</small></label>
                      <input type="text" name="status" value="<?= $row['status'] ?>" class="form-control" id="status" placeholder="Status" required>
                    </div>
                    <div class="mb-3">
                      <label for="jenis-kelamin" class="form-label">Jenis Kelamin <small class="text-danger">*</small></label>
                      <select name="jenis-kelamin" id="jenis-kelamin" class="form-select" aria-label="Default select example" required>
                        <option selected value="">Pilih Jenis Kelamin</option>
                        <option value="Laki-Laki">Laki-Laki</option>
                        <option value="Perempuan">Perempuan</option>
                      </select>
                    </div>
                    <div class="mb-3">
                      <label for="gelar" class="form-label">Gelar <small class="text-danger">*</small></label>
                      <input type="text" name="gelar" value="<?= $row['gelar'] ?>" class="form-control" id="gelar" minlength="3" placeholder="Gelar" required>
                    </div>
                  </div>
                  <div class="modal-footer justify-content-center border-top-0">
                    <input type="hidden" name="id-guru" value="<?= $row['id_guru'] ?>">
                    <input type="hidden" name="namaOld" value="<?= $row['nama'] ?>">
                    <input type="hidden" name="nipOld" value="<?= $row['nip'] ?>">
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
        <td><?= $row['no_hp_siswa'] ?></td>
        <td><?= $row['ortu'] ?></td>
        <td><?= $row['pekerjaan'] ?></td>
        <td><?= $row['no_hp_ortu'] ?></td>
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
                      <label for="no-hp-siswa" class="form-label">No HP</label>
                      <input type="number" name="no-hp-siswa" value="<?= $row['no_hp_siswa'] ?>" class="form-control" id="no-hp-siswa" minlength="11" placeholder="No HP">
                    </div>
                    <hr>
                    <div class="mb-3">
                      <label for="ortu" class="form-label">Nama Ortu/Wali <small class="text-danger">*</small></label>
                      <input type="text" name="ortu" value="<?= $row['ortu'] ?>" class="form-control" id="ortu" minlength="5" placeholder="Nama Ortu/Wali" required>
                    </div>
                    <div class="mb-3">
                      <label for="pekerjaan" class="form-label">Pekerjaan</label>
                      <input type="text" name="pekerjaan" value="<?= $row['pekerjaan'] ?>" class="form-control" id="pekerjaan" minlength="3" placeholder="Pekerjaan">
                    </div>
                    <div class="mb-3">
                      <label for="no-hp-ortu" class="form-label">No HP Ortu/Wali</label>
                      <input type="number" name="no-hp-ortu" value="<?= $row['no_hp_ortu'] ?>" class="form-control" id="no-hp-ortu" minlength="11" placeholder="No HP Ortu/Wali">
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