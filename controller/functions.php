<?php
if (!isset($_SESSION['data-user'])) {
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
}

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
    $rombel_ipa10 = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['rombel-ipa10']))));
    $rombel_ips10 = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['rombel-ips10']))));
    $rombel_ipa11 = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['rombel-ipa11']))));
    $rombel_ips11 = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['rombel-ips11']))));
    $rombel_ipa12 = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['rombel-ipa12']))));
    $rombel_ips12 = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['rombel-ips12']))));
    $fasilitas = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['fasilitas']))));
    $deskripsi = $data['deskripsi'];
    mysqli_query($conn, "INSERT INTO profil_sekolah(judul,rombel_ipa10,rombel_ipa11,rombel_ipa12,rombel_ips10,rombel_ips11,rombel_ips12,fasilitas,isi) VALUES('$judul','$rombel_ipa10','$rombel_ipa11','$rombel_ipa12','$rombel_ips10','$rombel_ips11','$rombel_ips12','$fasilitas','$deskripsi')");
    return mysqli_affected_rows($conn);
  }
  function ubah_prosek($data)
  {
    global $conn, $time;
    $id_profil = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['id-profil']))));
    $rombel_ipa10 = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['rombel-ipa10']))));
    $rombel_ips10 = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['rombel-ips10']))));
    $rombel_ipa11 = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['rombel-ipa11']))));
    $rombel_ips11 = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['rombel-ips11']))));
    $rombel_ipa12 = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['rombel-ipa12']))));
    $rombel_ips12 = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['rombel-ips12']))));
    $fasilitas = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['fasilitas']))));
    $judul = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['judul']))));
    $deskripsi = $data['deskripsi'];
    $updated_at = date("Y-m-d " . $time);
    mysqli_query($conn, "UPDATE profil_sekolah SET judul='$judul', rombel_ipa10='$rombel_ipa10', rombel_ipa11='$rombel_ipa11', rombel_ipa12='$rombel_ipa12', rombel_ips10='$rombel_ips10', rombel_ips11='$rombel_ips11', rombel_ips12='$rombel_ips12', fasilitas='$fasilitas', isi='$deskripsi', updated_at='$updated_at' WHERE id_profil='$id_profil'");
    return mysqli_affected_rows($conn);
  }
  function hapus_prosek($data)
  {
    global $conn;
    $id_profil = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['id-profil']))));
    mysqli_query($conn, "DELETE FROM profil_sekolah WHERE id_profil='$id_profil'");
    return mysqli_affected_rows($conn);
  }
  function hari_ini($hari)
  {

    switch ($hari) {
      case 'Sun':
        $hari_ini = "Minggu";
        break;

      case 'Mon':
        $hari_ini = "Senin";
        break;

      case 'Tue':
        $hari_ini = "Selasa";
        break;

      case 'Wed':
        $hari_ini = "Rabu";
        break;

      case 'Thu':
        $hari_ini = "Kamis";
        break;

      case 'Fri':
        $hari_ini = "Jumat";
        break;

      case 'Sat':
        $hari_ini = "Sabtu";
        break;

      default:
        $hari_ini = "Tidak di ketahui";
        break;
    }
    return $hari_ini;
  }
  function tambah_jadwal($data)
  {
    global $conn;
    $kelas = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['kelas']))));
    $mapel = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['mapel']))));
    $jam_mulai = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['jam-mulai']))));
    $jam_mulai = date_create($jam_mulai);
    $jam_mulai = date_format($jam_mulai, "h:i a");
    $jam_selesai = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['jam-selesai']))));
    $jam_selesai = date_create($jam_selesai);
    $jam_selesai = date_format($jam_selesai, "h:i a");
    $tgl = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['tgl']))));
    $hari = date_create($tgl);
    $hari = date_format($hari, "D");
    $hari = hari_ini($hari);
    mysqli_query($conn, "INSERT INTO jadwal(kelas,mapel,jam_mulai,jam_selesai,hari) VALUES('$kelas','$mapel','$jam_mulai','$jam_selesai','$hari')");
    return mysqli_affected_rows($conn);
  }
  function ubah_jadwal($data)
  {
    global $conn, $time;
    $id_jadwal = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['id-jadwal']))));
    $kelas = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['kelas']))));
    $mapel = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['mapel']))));
    $jam_mulai = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['jam-mulai']))));
    $jam_mulai = date_create($jam_mulai);
    $jam_mulai = date_format($jam_mulai, "h:i a");
    $jam_selesai = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['jam-selesai']))));
    $jam_selesai = date_create($jam_selesai);
    $jam_selesai = date_format($jam_selesai, "h:i a");
    $tgl = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['tgl']))));
    $hari = date_create($tgl);
    $hari = date_format($hari, "D");
    $hari = hari_ini($hari);
    $updated_at = date("Y-m-d " . $time);
    mysqli_query($conn, "UPDATE jadwal SET kelas='$kelas', mapel='$mapel', jam_mulai='$jam_mulai', jam_selesai='$jam_selesai', hari='$hari', updated_at='$updated_at'  WHERE id_jadwal='$id_jadwal'");
    return mysqli_affected_rows($conn);
  }
  function hapus_jadwal($data)
  {
    global $conn;
    $id_jadwal = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['id-jadwal']))));
    mysqli_query($conn, "DELETE FROM jadwal WHERE id_jadwal='$id_jadwal'");
    return mysqli_affected_rows($conn);
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
    $status = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['status']))));
    $jenis_kelamin = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['jenis-kelamin']))));
    $jabatan = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['jabatan']))));
    $gelar = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['gelar']))));
    mysqli_query($conn, "INSERT INTO guru(nip,nama,tempat_lahir,tgl_lahir,status,jenis_kelamin,jabatan,gelar) VALUES('$nip','$nama','$tempat_lahir','$tgl_lahir','$status','$jenis_kelamin','$jabatan','$gelar')");
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
    $status = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['status']))));
    $jenis_kelamin = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['jenis-kelamin']))));
    $jabatan = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['jabatan']))));
    $gelar = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['gelar']))));
    $updated_at = date("Y-m-d " . $time);
    mysqli_query($conn, "UPDATE guru SET nip='$nip', nama='$nama', tempat_lahir='$tempat_lahir', tgl_lahir='$tgl_lahir', status='$status', jenis_kelamin='$jenis_kelamin', jabatan='$jabatan', gelar='$gelar', updated_at='$updated_at' WHERE id_guru='$id_guru'");
    return mysqli_affected_rows($conn);
  }
  function hapus_guru($data)
  {
    global $conn;
    $id_guru = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['id-guru']))));
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
