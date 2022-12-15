<?php require_once("../controller/script.php");
require_once("redirect.php");
$_SESSION['page-name'] = "Pengumuman";
$_SESSION['page-url'] = "pengumuman";
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
                  <div class="card-body table-responsive">
                    <h4>Tambah Pengumuman</h4>
                    <form action="" method="POST">
                      <textarea name="isi" class="form-control" id="isi" rows="3"></textarea>
                      <button type="submit" name="tambah-pengumuman" class="btn btn-primary text-white rounded-0 mt-3">Submit</button>
                    </form>
                  </div>
                </div>
                <?php if (mysqli_num_rows($pengumuman) > 0) { ?>
                  <hr>
                  <h4>Data Pengumuman</h4>
                  <?php while ($row = mysqli_fetch_assoc($pengumuman)) { ?>
                    <div class="card rounded-0 mt-3">
                      <div class="card-body">
                        <blockquote class="blockquote mb-0">
                          <form action="" method="post">
                            <textarea name="isi" class="form-control" id="isi<?= $row['id_pengumuman'] ?>" rows="3"><?= $row['isi'] ?></textarea>
                            <input type="hidden" name="id-pengumuman" value="<?= $row['id_pengumuman'] ?>">
                            <button type="submit" name="ubah-pengumuman" class="btn btn-warning text-white rounded-0 mt-3">Ubah</button>
                            <button type="submit" name="hapus-pengumuman" class="btn btn-danger text-white rounded-0 mt-3">Hapus</button>
                          </form>
                          <script>
                            CKEDITOR.replace('isi<?= $row['id_pengumuman'] ?>');
                          </script>
                          <p class="mt-3"><?php $dateCreate = date_create($row['created_at']);
                                          echo date_format($dateCreate, "l, d M Y h:i a"); ?></p>
                        </blockquote>
                      </div>
                    </div>
                <?php }
                } ?>
              </div>
            </div>
          </div>
        </div>
        <script>
          CKEDITOR.replace('isi');
        </script>
        <?php require_once("../resources/dash-footer.php") ?>
</body>

</html>