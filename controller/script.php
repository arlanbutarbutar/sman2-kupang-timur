<?php if (!isset($_SESSION[''])) {
  session_start();
}
require_once("db_connect.php");
require_once("time.php");
require_once("functions.php");

if (isset($_SESSION['time-message'])) {
  if ((time() - $_SESSION['time-message']) > 2) {
    if (isset($_SESSION['message-success'])) {
      unset($_SESSION['message-success']);
    }
    if (isset($_SESSION['message-info'])) {
      unset($_SESSION['message-info']);
    }
    if (isset($_SESSION['message-warning'])) {
      unset($_SESSION['message-warning']);
    }
    if (isset($_SESSION['message-danger'])) {
      unset($_SESSION['message-danger']);
    }
    if (isset($_SESSION['message-dark'])) {
      unset($_SESSION['message-dark']);
    }
    unset($_SESSION['time-alert']);
  }
}

$baseURL = "http://$_SERVER[HTTP_HOST]/apps/sman2-kupang-timur/";

// if (!isset($_SESSION['data-user'])) {
if (isset($_POST['masuk'])) {
  if (masuk($_POST) > 0) {
    header("Location: ../views/");
    exit();
  }
}

$nama_sekolah = mysqli_query($conn, "SELECT judul FROM profil_sekolah");
$profil = mysqli_query($conn, "SELECT * FROM profil_sekolah");
$count_guru = mysqli_query($conn, "SELECT * FROM guru");
$count_guru = mysqli_num_rows($count_guru);
$count_siswa = mysqli_query($conn, "SELECT * FROM siswa");
$count_siswa = mysqli_num_rows($count_siswa);
$jadwal_belajar = mysqli_query($conn, "SELECT * FROM jadwal");
$jadwal_pdf = mysqli_query($conn, "SELECT * FROM jadwal ORDER BY id_jadwal DESC LIMIT 1");
$data_guru = mysqli_query($conn, "SELECT * FROM guru ORDER BY id_guru DESC");
$data_siswa = mysqli_query($conn, "SELECT * FROM siswa ORDER BY id_siswa DESC");
// }

if (isset($_SESSION['data-user'])) {
  $idUser = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $_SESSION['data-user']['id']))));

  $count_users = mysqli_query($conn, "SELECT * FROM users WHERE id_user='$idUser'");
  $count_users = mysqli_num_rows($count_users);
  $count_gurux = mysqli_query($conn, "SELECT * FROM guru");
  $count_gurux = mysqli_num_rows($count_gurux);
  $count_siswax = mysqli_query($conn, "SELECT * FROM siswa");
  $count_siswax = mysqli_num_rows($count_siswax);

  $profile = mysqli_query($conn, "SELECT * FROM users WHERE id_user='$idUser'");
  if (isset($_POST['ubah-profile'])) {
    if (ubah_profile($_POST) > 0) {
      $_SESSION['message-success'] = "Profil akun anda berhasil di ubah.";
      $_SESSION['time-message'] = time();
      header("Location: " . $_SESSION['page-url']);
      exit();
    }
  }

  $data_role1 = 25;
  $result_role1 = mysqli_query($conn, "SELECT * FROM users WHERE id_user!='$idUser'");
  $total_role1 = mysqli_num_rows($result_role1);
  $total_page_role1 = ceil($total_role1 / $data_role1);
  $page_role1 = isset($_GET["page"]) ? (int)$_GET["page"] : 1;
  $awal_data_role1 = ($page_role1 > 1) ? ($page_role1 * $data_role1) - $data_role1 : 0;
  $users = mysqli_query($conn, "SELECT * FROM users WHERE id_user!='$idUser' ORDER BY id_user DESC LIMIT $awal_data_role1, $data_role1");
  if (isset($_POST['tambah-user'])) {
    if (tambah_user($_POST) > 0) {
      $_SESSION['message-success'] = "Pengguna " . $_POST['username'] . " berhasil ditambahkan.";
      $_SESSION['time-message'] = time();
      header("Location: " . $_SESSION['page-url']);
      exit();
    }
  }
  if (isset($_POST['ubah-user'])) {
    if (ubah_user($_POST) > 0) {
      $_SESSION['message-success'] = "Pengguna " . $_POST['username'] . " berhasil diubah.";
      $_SESSION['time-message'] = time();
      header("Location: " . $_SESSION['page-url']);
      exit();
    }
  }
  if (isset($_POST['hapus-user'])) {
    if (hapus_user($_POST) > 0) {
      $_SESSION['message-success'] = "Pengguna " . $_POST['username'] . " berhasil dihapus.";
      $_SESSION['time-message'] = time();
      header("Location: " . $_SESSION['page-url']);
      exit();
    }
  }

  $profil_sekolah = mysqli_query($conn, "SELECT * FROM profil_sekolah");
  if (isset($_POST['tambah-prosek'])) {
    if (tambah_prosek($_POST) > 0) {
      $_SESSION['message-success'] = "Profil sekolah berhasil ditambahkan.";
      $_SESSION['time-message'] = time();
      header("Location: " . $_SESSION['page-url']);
      exit();
    }
  }
  if (isset($_POST['ubah-prosek'])) {
    if (ubah_prosek($_POST) > 0) {
      $_SESSION['message-success'] = "Profil sekolah berhasil diubah.";
      $_SESSION['time-message'] = time();
      header("Location: " . $_SESSION['page-url']);
      exit();
    }
  }
  if (isset($_POST['hapus-prosek'])) {
    if (hapus_prosek($_POST) > 0) {
      $_SESSION['message-success'] = "Profil sekolah berhasil dihapus.";
      $_SESSION['time-message'] = time();
      header("Location: " . $_SESSION['page-url']);
      exit();
    }
  }

  $data_role2 = 25;
  $result_role2 = mysqli_query($conn, "SELECT * FROM jadwal");
  $total_role2 = mysqli_num_rows($result_role2);
  $total_page_role2 = ceil($total_role2 / $data_role2);
  $page_role2 = isset($_GET["page"]) ? (int)$_GET["page"] : 1;
  $awal_data_role2 = ($page_role2 > 1) ? ($page_role2 * $data_role2) - $data_role2 : 0;
  $jadwal = mysqli_query($conn, "SELECT * FROM jadwal ORDER BY id_jadwal DESC LIMIT $awal_data_role2, $data_role2");
  if (isset($_POST['tambah-jadwal'])) {
    if (tambah_jadwal($_POST) > 0) {
      $_SESSION['message-success'] = "Jadwal sekolah berhasil ditambahkan.";
      $_SESSION['time-message'] = time();
      header("Location: " . $_SESSION['page-url']);
      exit();
    }
  }
  if (isset($_POST['ubah-jadwal'])) {
    if (ubah_jadwal($_POST) > 0) {
      $_SESSION['message-success'] = "Jadwal sekolah dengan mapel " . $_POST['nama-jadwal'] . " berhasil diubah.";
      $_SESSION['time-message'] = time();
      header("Location: " . $_SESSION['page-url']);
      exit();
    }
  }
  if (isset($_POST['hapus-jadwal'])) {
    if (hapus_jadwal($_POST) > 0) {
      $_SESSION['message-success'] = "Jadwal sekolah dengan mapel " . $_POST['nama-jadwal'] . " berhasil dihapus.";
      $_SESSION['time-message'] = time();
      header("Location: " . $_SESSION['page-url']);
      exit();
    }
  }

  $data_role3 = 25;
  $result_role3 = mysqli_query($conn, "SELECT * FROM guru");
  $total_role3 = mysqli_num_rows($result_role3);
  $total_page_role3 = ceil($total_role3 / $data_role3);
  $page_role3 = isset($_GET["page"]) ? (int)$_GET["page"] : 1;
  $awal_data_role3 = ($page_role3 > 1) ? ($page_role3 * $data_role3) - $data_role3 : 0;
  $guru = mysqli_query($conn, "SELECT * FROM guru ORDER BY id_guru DESC LIMIT $awal_data_role3, $data_role3");
  if (isset($_POST['tambah-guru'])) {
    if (tambah_guru($_POST) > 0) {
      $_SESSION['message-success'] = "Data guru telah berhasil ditambahkan.";
      $_SESSION['time-message'] = time();
      header("Location: " . $_SESSION['page-url']);
      exit();
    }
  }
  if (isset($_POST['ubah-guru'])) {
    if (ubah_guru($_POST) > 0) {
      $_SESSION['message-success'] = "Data guru dengan nama " . $_POST['namaOld'] . " berhasil diubah.";
      $_SESSION['time-message'] = time();
      header("Location: " . $_SESSION['page-url']);
      exit();
    }
  }
  if (isset($_POST['hapus-guru'])) {
    if (hapus_guru($_POST) > 0) {
      $_SESSION['message-success'] = "Data guru dengan nama " . $_POST['namaOld'] . " berhasil dihapus.";
      $_SESSION['time-message'] = time();
      header("Location: " . $_SESSION['page-url']);
      exit();
    }
  }
  if (isset($_POST['import-guru'])) {
    if (import_guru($_POST) > 0) {
      $_SESSION['message-success'] = "Data guru telah berhasil ditambahkan.";
      $_SESSION['time-message'] = time();
      header("Location: " . $_SESSION['page-url']);
      exit();
    }
  }

  $data_role4 = 25;
  $result_role4 = mysqli_query($conn, "SELECT * FROM siswa");
  $total_role4 = mysqli_num_rows($result_role4);
  $total_page_role4 = ceil($total_role4 / $data_role4);
  $page_role4 = isset($_GET["page"]) ? (int)$_GET["page"] : 1;
  $awal_data_role4 = ($page_role4 > 1) ? ($page_role4 * $data_role4) - $data_role4 : 0;
  $siswa = mysqli_query($conn, "SELECT * FROM siswa ORDER BY id_siswa DESC LIMIT $awal_data_role4, $data_role4");
  if (isset($_POST['tambah-siswa'])) {
    if (tambah_siswa($_POST) > 0) {
      $_SESSION['message-success'] = "Data siswa telah berhasil ditambahkan.";
      $_SESSION['time-message'] = time();
      header("Location: " . $_SESSION['page-url']);
      exit();
    }
  }
  if (isset($_POST['ubah-siswa'])) {
    if (ubah_siswa($_POST) > 0) {
      $_SESSION['message-success'] = "Data siswa dengan nama " . $_POST['nama'] . " berhasil diubah.";
      $_SESSION['time-message'] = time();
      header("Location: " . $_SESSION['page-url']);
      exit();
    }
  }
  if (isset($_POST['hapus-siswa'])) {
    if (hapus_siswa($_POST) > 0) {
      $_SESSION['message-success'] = "Data siswa dengan nama " . $_POST['nama'] . " berhasil dihapus.";
      $_SESSION['time-message'] = time();
      header("Location: " . $_SESSION['page-url']);
      exit();
    }
  }
  if (isset($_POST['import-siswa'])) {
    if (import_siswa($_POST) > 0) {
      $_SESSION['message-success'] = "Data siswa telah berhasil ditambahkan.";
      $_SESSION['time-message'] = time();
      header("Location: " . $_SESSION['page-url']);
      exit();
    }
  }

  $ipa10=mysqli_query($conn, "SELECT rombel_ipa10 FROM profil_sekolah");
  $ubah_ipa10=mysqli_query($conn, "SELECT rombel_ipa10 FROM profil_sekolah");
  $ips10=mysqli_query($conn, "SELECT rombel_ips10 FROM profil_sekolah");
  $ubah_ips10=mysqli_query($conn, "SELECT rombel_ips10 FROM profil_sekolah");
  $ipa11=mysqli_query($conn, "SELECT rombel_ipa11 FROM profil_sekolah");
  $ubah_ipa11=mysqli_query($conn, "SELECT rombel_ipa11 FROM profil_sekolah");
  $ips11=mysqli_query($conn, "SELECT rombel_ips11 FROM profil_sekolah");
  $ubah_ips11=mysqli_query($conn, "SELECT rombel_ips11 FROM profil_sekolah");
  $ipa12=mysqli_query($conn, "SELECT rombel_ipa12 FROM profil_sekolah");
  $ubah_ipa12=mysqli_query($conn, "SELECT rombel_ipa12 FROM profil_sekolah");
  $ips12=mysqli_query($conn, "SELECT rombel_ips12 FROM profil_sekolah");
  $ubah_ips12=mysqli_query($conn, "SELECT rombel_ips12 FROM profil_sekolah");
}
