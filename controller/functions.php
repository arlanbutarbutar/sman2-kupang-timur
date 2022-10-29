<?php
// if (!isset($_SESSION['data-user'])) {
function masuk($data)
{
  global $conn;
  $email = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['email']))));
  $password = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['password']))));

  // check account
  $checkAccount = mysqli_query($conn, "SELECT * FROM users WHERE email='$email'");
  if (mysqli_num_rows($checkAccount) == 0) {
    $_SESSION['message-danger'] = "Maaf, akun yang anda masukan belum terdaftar.";
    $_SESSION['time-message'] = time();
    return false;
  } else if (mysqli_num_rows($checkAccount) > 0) {
    $row = mysqli_fetch_assoc($checkAccount);
    if (password_verify($password, $row['password'])) {
      $_SESSION['data-user'] = [
        'id' => $row['id_user'],
        'username' => $row['username'],
        'email' => $row['email'],
      ];
    } else {
      $_SESSION['message-danger'] = "Maaf, kata sandi yang anda masukan salah.";
      $_SESSION['time-message'] = time();
      return false;
    }
  }
}
// }

if (isset($_SESSION['data-user'])) {
  function ubah_profile($data)
  {
    global $conn, $idUser;
    $username = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['username']))));
    $password = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['password']))));
    $password = password_hash($password, PASSWORD_DEFAULT);
    mysqli_query($conn, "UPDATE users SET username='$username', password='$password' WHERE id_user='$idUser'");
    return mysqli_affected_rows($conn);
  }
  function tambah_user($data)
  {
    global $conn;
    $username = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['username']))));
    $email = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['email']))));
    $checkEmail = mysqli_query($conn, "SELECT * FROM users WHERE email='$email'");
    if (mysqli_num_rows($checkEmail) > 0) {
      $_SESSION['message-danger'] = "Maaf, email yang anda masukan sudah terdaftar.";
      $_SESSION['time-message'] = time();
      return false;
    }
    $password = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['password']))));
    $password = password_hash($password, PASSWORD_DEFAULT);
    mysqli_query($conn, "INSERT INTO users(username,email,password) VALUES('$username','$email','$password')");
    return mysqli_affected_rows($conn);
  }
  function ubah_user($data)
  {
    global $conn, $time;
    $id_user = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['id-user']))));
    $username = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['username']))));
    $email = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['email']))));
    $emailOld = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['emailOld']))));
    if ($email != $emailOld) {
      $checkEmail = mysqli_query($conn, "SELECT * FROM users WHERE email='$email'");
      if (mysqli_num_rows($checkEmail) > 0) {
        $_SESSION['message-danger'] = "Maaf, email yang anda masukan sudah terdaftar.";
        $_SESSION['time-message'] = time();
        return false;
      }
    }
    $updated_at = date("Y-m-d " . $time);
    mysqli_query($conn, "UPDATE users SET username='$username', email='$email', updated_at='$updated_at' WHERE id_user='$id_user'");
    return mysqli_affected_rows($conn);
  }
  function hapus_user($data)
  {
    global $conn;
    $id_user = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['id-user']))));
    mysqli_query($conn, "DELETE FROM users WHERE id_user='$id_user'");
    return mysqli_affected_rows($conn);
  }
  function tambah_prosek($data)
  {
    global $conn;
    $judul = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['judul']))));
    $deskripsi = $data['deskripsi'];
    mysqli_query($conn, "INSERT INTO profil_sekolah(judul,isi) VALUES('$judul','$deskripsi')");
    return mysqli_affected_rows($conn);
  }
  function ubah_prosek($data)
  {
    global $conn, $time;
    $id_profil = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['id-profil']))));
    $judul = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['judul']))));
    $deskripsi = $data['deskripsi'];
    $updated_at = date("Y-m-d " . $time);
    mysqli_query($conn, "UPDATE profil_sekolah SET judul='$judul', isi='$deskripsi', updated_at='$updated_at' WHERE id_profil='$id_profil'");
    return mysqli_affected_rows($conn);
  }
  function hapus_prosek($data)
  {
    global $conn;
    $id_profil = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['id-profil']))));
    mysqli_query($conn, "DELETE FROM profil_sekolah WHERE id_profil='$id_profil'");
    return mysqli_affected_rows($conn);
  }
  function fileJadwal()
  {
    $namaFile = $_FILES["jadwal"]["name"];
    $ukuranFile = $_FILES["jadwal"]["size"];
    $error = $_FILES["jadwal"]["error"];
    $tmpName = $_FILES["jadwal"]["tmp_name"];
    if ($error === 4) {
      $_SESSION['message-danger'] = "Pilih file terlebih dahulu!";
      $_SESSION['time-message'] = time();
      return false;
    }
    $ekstensiGambarValid = ['jpg', 'png', 'jpeg', 'heic', 'pdf'];
    $ekstensiGambar = explode('.', $namaFile);
    $ekstensiGambar = strtolower(end($ekstensiGambar));
    if (!in_array($ekstensiGambar, $ekstensiGambarValid)) {
      $_SESSION['message-danger'] = "Maaf, file kamu bukan gambar atau pdf!";
      $_SESSION['time-message'] = time();
      return false;
    }
    if ($ukuranFile > 2000000) {
      $_SESSION['message-danger'] = "Maaf, ukuran file terlalu besar! (2 MB)";
      $_SESSION['time-message'] = time();
      return false;
    }
    $namaFile_encrypt = crc32($namaFile);
    $encrypt = $namaFile_encrypt . "." . $ekstensiGambar;
    move_uploaded_file($tmpName, '../assets/file/jadwal/' . $encrypt);
    return $encrypt;
  }
  function tambah_jadwal($data)
  {
    global $conn;
    $rombel = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['rombel']))));
    $tahun = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['tahun']))));
    $tahun = date_create($tahun);
    $tahun = date_format($tahun, "Y");
    $file = fileJadwal();
    if (!$file) {
      return false;
    }
    mysqli_query($conn, "INSERT INTO jadwal(rombel,tahun,file) VALUES('$rombel','$tahun','$file')");
    return mysqli_affected_rows($conn);
  }
  function ubah_jadwal($data)
  {
    global $conn, $time;
    $id_jadwal = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['id-jadwal']))));
    $rombel = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['rombel']))));
    $tahun = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['tahun']))));
    $tahun = date_create($tahun);
    $tahun = date_format($tahun, "Y");
    $fileOld = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['fileOld']))));
    if (!empty($_FILES['jadwal']['name'])) {
      $file = fileJadwal();
      if (!$file) {
        return false;
      } else {
        unlink('../assets/file/jadwal/' . $fileOld);
      }
    } else {
      $file = $fileOld;
    }
    $updated_at = date("Y-m-d " . $time);
    mysqli_query($conn, "UPDATE jadwal SET rombel='$rombel', tahun='$tahun', file='$file', updated_at='$updated_at'  WHERE id_jadwal='$id_jadwal'");
    return mysqli_affected_rows($conn);
  }
  function hapus_jadwal($data)
  {
    global $conn;
    $id_jadwal = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['id-jadwal']))));
    $fileOld = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['fileOld']))));
    unlink('../assets/file/jadwal/' . $fileOld);
    mysqli_query($conn, "DELETE FROM jadwal WHERE id_jadwal='$id_jadwal'");
    return mysqli_affected_rows($conn);
  }
  function fileIjasah()
  {
    $namaFile = $_FILES["ijasah"]["name"];
    $ukuranFile = $_FILES["ijasah"]["size"];
    $error = $_FILES["ijasah"]["error"];
    $tmpName = $_FILES["ijasah"]["tmp_name"];
    if ($error === 4) {
      $_SESSION['message-danger'] = "Pilih file terlebih dahulu!";
      $_SESSION['time-message'] = time();
      return false;
    }
    $ekstensiGambarValid = ['pdf'];
    $ekstensiGambar = explode('.', $namaFile);
    $ekstensiGambar = strtolower(end($ekstensiGambar));
    if (!in_array($ekstensiGambar, $ekstensiGambarValid)) {
      $_SESSION['message-danger'] = "Maaf, file kamu bukan pdf!";
      $_SESSION['time-message'] = time();
      return false;
    }
    if ($ukuranFile > 2000000) {
      $_SESSION['message-danger'] = "Maaf, ukuran file terlalu besar! (2 MB)";
      $_SESSION['time-message'] = time();
      return false;
    }
    $namaFile_encrypt = crc32($namaFile);
    $encrypt = $namaFile_encrypt . "." . $ekstensiGambar;
    move_uploaded_file($tmpName, '../assets/file/ijasah/' . $encrypt);
    return $encrypt;
  }
  function tambah_guru($data)
  {
    global $conn;
    $nip = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['nip']))));
    $checkNIP = mysqli_query($conn, "SELECT * FROM guru WHERE nip='$nip'");
    if (mysqli_num_rows($checkNIP) > 0) {
      $_SESSION['message-danger'] = "Maaf, NIP yang anda masukan sudah digunakan di data guru yang lain";
      $_SESSION['time-message'] = time();
      return false;
    }
    $nama = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['nama']))));
    $tempat_lahir = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['tempat-lahir']))));
    $tgl_lahir = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['tgl-lahir']))));
    $tgl_lahir = date_create($tgl_lahir);
    $tgl_lahir = date_format($tgl_lahir, "m d Y");
    $gol = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['gol']))));
    $tmt = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['tmt']))));
    $jabatan = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['jabatan']))));
    $gelar = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['gelar']))));
    $tahun = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['thn-lulus']))));
    $tahun = date_create($tahun);
    $tahun = date_format($tahun, "Y");
    $file = fileIjasah();
    if (!$file) {
      return false;
    }
    mysqli_query($conn, "INSERT INTO guru(nip,nama,tempat_lahir,tgl_lahir,gol,tmt,jabatan,gelar,thn_lulus,ijasah) VALUES('$nip','$nama','$tempat_lahir','$tgl_lahir','$gol','$tmt','$jabatan','$gelar','$tahun','$file')");
    return mysqli_affected_rows($conn);
  }
  function ubah_guru($data)
  {
    global $conn, $time;
    $id_guru = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['id-guru']))));
    $nip = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['nip']))));
    $nipOld = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['nipOld']))));
    if ($nip != $nipOld) {
      $checkNIP = mysqli_query($conn, "SELECT * FROM guru WHERE nip='$nip'");
      if (mysqli_num_rows($checkNIP) > 0) {
        $_SESSION['message-danger'] = "Maaf, NIP yang anda masukan sudah digunakan di data guru yang lain";
        $_SESSION['time-message'] = time();
        return false;
      }
    }
    $nama = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['nama']))));
    $tempat_lahir = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['tempat-lahir']))));
    $tgl_lahir = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['tgl-lahir']))));
    $tgl_lahir = date_create($tgl_lahir);
    $tgl_lahir = date_format($tgl_lahir, "d M Y");
    $gol = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['gol']))));
    $tmt = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['tmt']))));
    $jabatan = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['jabatan']))));
    $gelar = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['gelar']))));
    $tahun = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['thn-lulus']))));
    $tahun = date_create($tahun);
    $tahun = date_format($tahun, "Y");
    $fileOld = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['fileOld']))));
    if (!empty($_FILES['ijasah']['name'])) {
      $file = fileIjasah();
      if (!$file) {
        return false;
      } else {
        unlink('../assets/file/ijasah/' . $fileOld);
      }
    } else {
      $file = $fileOld;
    }
    $updated_at = date("Y-m-d " . $time);
    mysqli_query($conn, "UPDATE guru SET nip='$nip', nama='$nama', tempat_lahir='$tempat_lahir', tgl_lahir='$tgl_lahir', gol='$gol', tmt='$tmt', jabatan='$jabatan', gelar='$gelar', thn_lulus='$tahun', ijasah='$file', updated_at='$updated_at' WHERE id_guru='$id_guru'");
    return mysqli_affected_rows($conn);
  }
  function hapus_guru($data)
  {
    global $conn;
    $id_guru = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['id-guru']))));
    $fileOld = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['fileOld']))));
    unlink('../assets/file/ijasah/' . $fileOld);
    mysqli_query($conn, "DELETE FROM guru WHERE id_guru='$id_guru'");
    return mysqli_affected_rows($conn);
  }
  function import_guru()
  {
    global $conn;
    require "../assets/autoload.php";
    $ekstensi = "";
    $file_name = $_FILES['import']['name'];
    $file_data = $_FILES['import']['tmp_name'];
    if (empty($file_name)) {
      $_SESSION['message-danger'] = "Maaf, kamu belum memasukan file excel!";
      $_SESSION['time-message'] = time();
      return false;
    } else {
      $ekstensi = pathinfo($file_name)['extension'];
    }
    $ekstensi_allowed = array("xls", "xlsx");
    if (!in_array($ekstensi, $ekstensi_allowed)) {
      $_SESSION['message-danger'] = "Maaf, file yang kamu memasukan bukan excel!";
      $_SESSION['time-message'] = time();
      return false;
    }
    $reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReaderForFile($file_data);
    $spreadsheet = $reader->load($file_data);
    $sheetData = $spreadsheet->getActiveSheet()->toArray();
    for ($i = 1; $i < count($sheetData); $i++) {
      $nip = $sheetData[$i]['1'];
      $nama = $sheetData[$i]['2'];
      $tempat_lahir = $sheetData[$i]['3'];
      $tgl_lahir = $sheetData[$i]['4'];
      $tgl_lahir = date_create($tgl_lahir);
      $tgl_lahir = date_format($tgl_lahir, "d M Y");
      $gol = $sheetData[$i]['5'];
      $tmt = $sheetData[$i]['6'];
      $jabatan = $sheetData[$i]['7'];
      $gelar = $sheetData[$i]['8'];
      $tahun = $sheetData[$i]['9'];
      $tahun = date_create($tahun);
      $tahun = date_format($tahun, "Y");
      mysqli_query($conn, "INSERT INTO guru(nip,nama,tempat_lahir,tgl_lahir,gol,tmt,jabatan,gelar,thn_lulus) VALUES('$nip','$nama','$tempat_lahir','$tgl_lahir','$gol','$tmt','$jabatan','$gelar','$tahun')");
    }
    return mysqli_affected_rows($conn);
  }
  function tambah_siswa($data)
  {
    global $conn;
    $nis = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['nis']))));
    $checkNIS = mysqli_query($conn, "SELECT * FROM siswa WHERE nis='$nis'");
    if (mysqli_num_rows($checkNIS) > 0) {
      $_SESSION['message-danger'] = "Maaf, NIS yang anda masukan sudah digunakan di data siswa lain!";
      $_SESSION['time-message'] = time();
      return false;
    }
    $nama = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['nama']))));
    $tempat_lahir = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['tempat-lahir']))));
    $tgl_lahir = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['tgl-lahir']))));
    $alamat = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['alamat']))));
    $agama = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['agama']))));
    $kelas = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['kelas']))));
    mysqli_query($conn, "INSERT INTO siswa(nis,nama,tempat_lahir,tgl_lahir,alamat,agama,kelas) VALUES('$nis','$nama','$tempat_lahir','$tgl_lahir','$alamat','$agama','$kelas')");
    return mysqli_affected_rows($conn);
  }
  function ubah_siswa($data)
  {
    global $conn, $time;
    $id_siswa = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['id-siswa']))));
    $nis = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['nis']))));
    $nisOld = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['nisOld']))));
    if ($nis != $nisOld) {
      $checkNIS = mysqli_query($conn, "SELECT * FROM siswa WHERE nis='$nis'");
      if (mysqli_num_rows($checkNIS) > 0) {
        $_SESSION['message-danger'] = "Maaf, NIS yang anda masukan sudah digunakan di data siswa lain!";
        $_SESSION['time-message'] = time();
        return false;
      }
    }
    $nama = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['nama']))));
    $tempat_lahir = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['tempat-lahir']))));
    $tgl_lahir = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['tgl-lahir']))));
    $alamat = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['alamat']))));
    $agama = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['agama']))));
    $kelas = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['kelas']))));
    $updated_at = date("Y-m-d " . $time);
    mysqli_query($conn, "UPDATE siswa SET nis='$nis', nama='$nama', tempat_lahir='$tempat_lahir', tgl_lahir='$tgl_lahir', alamat='$alamat', agama='$agama', kelas='$kelas', updated_at='$updated_at' WHERE id_siswa='$id_siswa'");
    return mysqli_affected_rows($conn);
  }
  function hapus_siswa($data)
  {
    global $conn;
    $id_siswa = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['id-siswa']))));
    mysqli_query($conn, "DELETE FROM siswa WHERE id_siswa='$id_siswa'");
    return mysqli_affected_rows($conn);
  }
  function import_siswa($data)
  {
    global $conn;
  }
}
