<?php require_once("../controller/script.php");
require_once("redirect.php");
$_SESSION['page-name'] = "Profil Sekolah";
$_SESSION['page-url'] = "profil-sekolah";
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <?php require_once("../resources/dash-header.php") ?>
  <script src="../assets/ckeditor/ckeditor.js"></script>
</head>

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
                </div>
                <div class="card rounded-0 mt-3">
                  <div class="card-body">
                    <?php if (mysqli_num_rows($profil_sekolah) == 0) { ?>
                      <form action="" method="post">
                        <div class="mb-3">
                          <label for="judul" class="form-label">Judul <small class="text-danger">*</small></label>
                          <input type="text" name="judul" class="form-control" id="judul" placeholder="Judul" minlength="5" required>
                        </div>
                        <div class="row">
                          <div class="col-lg-4">
                            <div class="d-flex flex-wrap mb-3">
                              <label for="rombel-ipa10" class="form-label">Rombel Kelas 10 IPA <small class="text-danger">*</small></label>
                              <input type="number" name="rombel-ipa10" class="form-control" id="rombel-ipa10" placeholder="Rombel Kelas 10" required>
                            </div>
                            <div class="d-flex flex-wrap mb-3">
                              <label for="rombel-10" class="form-label">Rombel Kelas 10 IPS <small class="text-danger">*</small></label>
                              <input type="number" name="rombel-ips10" class="form-control" id="rombel-10" placeholder="Rombel Kelas 10 IPS" required>
                            </div>
                          </div>
                          <div class="col-lg-4">
                            <div class="d-flex flex-wrap mb-3">
                              <label for="rombel-ipa11" class="form-label">Rombel Kelas 11 IPA<small class="text-danger">*</small></label>
                              <input type="number" name="rombel-ipa11" class="form-control" id="rombel-ipa11" placeholder="Rombel Kelas 11 IPA" required>
                            </div>
                            <div class="d-flex flex-wrap mb-3">
                              <label for="rombel-ips11" class="form-label">Rombel Kelas 11 IPS<small class="text-danger">*</small></label>
                              <input type="number" name="rombel-ips11" class="form-control" id="rombel-ips11" placeholder="Rombel Kelas 11 IPS" required>
                            </div>
                          </div>
                          <div class="col-lg-4">
                            <div class="d-flex flex-wrap mb-3">
                              <label for="rombel-ipa12" class="form-label">Rombel Kelas 12 IPA<small class="text-danger">*</small></label>
                              <input type="number" name="rombel-ipa12" class="form-control" id="rombel-ipa12" placeholder="Rombel Kelas 12 IPA" required>
                            </div>
                            <div class="d-flex flex-wrap mb-3">
                              <label for="rombel-ips12" class="form-label">Rombel Kelas 12 IPS<small class="text-danger">*</small></label>
                              <input type="number" name="rombel-ips12" class="form-control" id="rombel-ips12" placeholder="Rombel Kelas 12 IPS" required>
                            </div>
                          </div>
                        </div>
                        <div class="mb-3">
                          <label for="fasilitas" class="form-label">Fasilitas <small class="text-danger">*</small></label>
                          <input type="text" name="fasilitas" class="form-control" id="fasilitas" placeholder="Fasilitas" minlength="5" required>
                        </div>
                        <div class="mb-3">
                          <label for="deskripsi">Deskripsi <small class="text-danger">*</small></label>
                          <textarea name="deskripsi" id="deskripsi" cols="30" rows="25" style="line-height: 20px;" class="form-control shadow" required></textarea>
                        </div>
                        <button type="submit" name="tambah-prosek" class="btn btn-primary text-white me-0">Tambah</button>
                      </form>
                      <?php } else if (mysqli_num_rows($profil_sekolah) > 0) {
                      while ($row = mysqli_fetch_assoc($profil_sekolah)) { ?>
                        <form action="" method="post">
                          <div class="mb-3">
                            <label for="judul" class="form-label">Judul <small class="text-danger">*</small></label>
                            <input type="text" name="judul" value="<?= $row['judul'] ?>" class="form-control" id="judul" placeholder="Judul" minlength="5" required>
                          </div>
                        <div class="row">
                          <div class="col-lg-4">
                            <div class="d-flex flex-wrap mb-3">
                              <label for="rombel-ipa10" class="form-label">Rombel Kelas 10 IPA <small class="text-danger">*</small></label>
                              <input type="number" name="rombel-ipa10" value="<?= $row['rombel_ipa10'] ?>" class="form-control" id="rombel-ipa10" placeholder="Rombel Kelas 10" required>
                            </div>
                            <div class="d-flex flex-wrap mb-3">
                              <label for="rombel-10" class="form-label">Rombel Kelas 10 IPS <small class="text-danger">*</small></label>
                              <input type="number" name="rombel-ips10" value="<?= $row['rombel_ips10'] ?>" class="form-control" id="rombel-10" placeholder="Rombel Kelas 10 IPS" required>
                            </div>
                          </div>
                          <div class="col-lg-4">
                            <div class="d-flex flex-wrap mb-3">
                              <label for="rombel-ipa11" class="form-label">Rombel Kelas 11 IPA<small class="text-danger">*</small></label>
                              <input type="number" name="rombel-ipa11" value="<?= $row['rombel_ipa11'] ?>" class="form-control" id="rombel-ipa11" placeholder="Rombel Kelas 11 IPA" required>
                            </div>
                            <div class="d-flex flex-wrap mb-3">
                              <label for="rombel-ips11" class="form-label">Rombel Kelas 11 IPS<small class="text-danger">*</small></label>
                              <input type="number" name="rombel-ips11" value="<?= $row['rombel_ips11'] ?>" class="form-control" id="rombel-ips11" placeholder="Rombel Kelas 11 IPS" required>
                            </div>
                          </div>
                          <div class="col-lg-4">
                            <div class="d-flex flex-wrap mb-3">
                              <label for="rombel-ipa12" class="form-label">Rombel Kelas 12 IPA<small class="text-danger">*</small></label>
                              <input type="number" name="rombel-ipa12" value="<?= $row['rombel_ipa12'] ?>" class="form-control" id="rombel-ipa12" placeholder="Rombel Kelas 12 IPA" required>
                            </div>
                            <div class="d-flex flex-wrap mb-3">
                              <label for="rombel-ips12" class="form-label">Rombel Kelas 12 IPS<small class="text-danger">*</small></label>
                              <input type="number" name="rombel-ips12" value="<?= $row['rombel_ips12'] ?>" class="form-control" id="rombel-ips12" placeholder="Rombel Kelas 12 IPS" required>
                            </div>
                          </div>
                        </div>
                          <div class="mb-3">
                            <label for="fasilitas" class="form-label">Fasilitas <small class="text-danger">*</small></label>
                            <input type="text" name="fasilitas" value="<?= $row['fasilitas'] ?>" class="form-control" id="fasilitas" placeholder="Fasilitas" minlength="5" required>
                          </div>
                          <div class="mb-3">
                            <label for="deskripsi">Deskripsi <small class="text-danger">*</small></label>
                            <textarea name="deskripsi" id="deskripsi" cols="30" rows="25" style="line-height: 20px;" class="form-control shadow" required><?= $row['isi'] ?></textarea>
                          </div>
                          <input type="hidden" name="id-profil" value="<?= $row['id_profil'] ?>">
                          <button type="submit" name="ubah-prosek" class="btn btn-warning text-white me-0">Ubah</button>
                          <button type="submit" name="hapus-prosek" class="btn btn-danger text-white me-0">Hapus</button>
                        </form>
                    <?php }
                    } ?>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <script>
          CKEDITOR.replace('deskripsi');
        </script>
        <?php require_once("../resources/dash-footer.php") ?>
</body>

</html>