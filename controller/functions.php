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
          'role' => $row['id_role'],
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
    $id_role = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['id-role']))));
    $password = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['password']))));
    $password = password_hash($password, PASSWORD_DEFAULT);
    mysqli_query($conn, "INSERT INTO users(id_role,username,email,password) VALUES('$id_role','$username','$email','$password')");
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
    $id_role = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['id-role']))));
    $updated_at = date("Y-m-d " . $time);
    mysqli_query($conn, "UPDATE users SET id_role='$id_role', username='$username', email='$email', updated_at='$updated_at' WHERE id_user='$id_user'");
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
    $id_guru = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['id-guru']))));
    $kelas = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['kelas']))));
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
    mysqli_query($conn, "INSERT INTO jadwal(id_guru,kelas,jam_mulai,jam_selesai,hari) VALUES('$id_guru','$kelas','$jam_mulai','$jam_selesai','$hari')");
    return mysqli_affected_rows($conn);
  }
  function ubah_jadwal($data)
  {
    global $conn, $time;
    $id_jadwal = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['id-jadwal']))));
    $id_guru = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['id-guru']))));
    $kelas = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['kelas']))));
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
    mysqli_query($conn, "UPDATE jadwal SET id_guru='$id_guru', kelas='$kelas', jam_mulai='$jam_mulai', jam_selesai='$jam_selesai', hari='$hari', updated_at='$updated_at'  WHERE id_jadwal='$id_jadwal'");
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
    if ($nip != "") {
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
    $tgl_lahir = date_format($tgl_lahir, "m d Y");
    $status = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['status']))));
    $jenis_kelamin = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['jenis-kelamin']))));
    $gelar = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['gelar']))));
    $mapel = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['mapel']))));
    mysqli_query($conn, "INSERT INTO guru(nip,nama,tempat_lahir,tgl_lahir,status,jenis_kelamin,gelar,mapel) VALUES('$nip','$nama','$tempat_lahir','$tgl_lahir','$status','$jenis_kelamin','$gelar','$mapel')");
    return mysqli_affected_rows($conn);
  }
  function ubah_guru($data)
  {
    global $conn, $time;
    $id_guru = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['id-guru']))));
    $nip = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['nip']))));
    $nipOld = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['nipOld']))));
    if ($nip != "") {
      if ($nip != $nipOld) {
        $checkNIP = mysqli_query($conn, "SELECT * FROM guru WHERE nip='$nip'");
        if (mysqli_num_rows($checkNIP) > 0) {
          $_SESSION['message-danger'] = "Maaf, NIP yang anda masukan sudah digunakan di data guru yang lain";
          $_SESSION['time-message'] = time();
          return false;
        }
      }
    }
    $nama = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['nama']))));
    $tempat_lahir = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['tempat-lahir']))));
    $tgl_lahir = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['tgl-lahir']))));
    $tgl_lahir = date_create($tgl_lahir);
    $tgl_lahir = date_format($tgl_lahir, "d M Y");
    $status = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['status']))));
    $jenis_kelamin = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['jenis-kelamin']))));
    $gelar = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['gelar']))));
    $mapel = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['mapel']))));
    $updated_at = date("Y-m-d " . $time);
    mysqli_query($conn, "UPDATE guru SET nip='$nip', nama='$nama', tempat_lahir='$tempat_lahir', tgl_lahir='$tgl_lahir', status='$status', jenis_kelamin='$jenis_kelamin', gelar='$gelar', mapel='$mapel', updated_at='$updated_at' WHERE id_guru='$id_guru'");
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
    $ortu = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['ortu']))));
    $pekerjaan = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['pekerjaan']))));
    $no_hp_ortu = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['no-hp-ortu']))));
    $no_hp_siswa = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['no-hp-siswa']))));
    mysqli_query($conn, "INSERT INTO siswa(nis,nama,tempat_lahir,tgl_lahir,alamat,agama,kelas,ortu,pekerjaan,no_hp_ortu,no_hp_siswa) VALUES('$nis','$nama','$tempat_lahir','$tgl_lahir','$alamat','$agama','$kelas','$ortu','$pekerjaan','$no_hp_ortu','$no_hp_siswa')");
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
    $ortu = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['ortu']))));
    $pekerjaan = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['pekerjaan']))));
    $no_hp_ortu = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['no-hp-ortu']))));
    $no_hp_siswa = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['no-hp-siswa']))));
    $updated_at = date("Y-m-d " . $time);
    mysqli_query($conn, "UPDATE siswa SET nis='$nis', nama='$nama', tempat_lahir='$tempat_lahir', tgl_lahir='$tgl_lahir', alamat='$alamat', agama='$agama', kelas='$kelas', ortu='$ortu', pekerjaan='$pekerjaan', no_hp_ortu='$no_hp_ortu', no_hp_siswa='$no_hp_siswa', updated_at='$updated_at' WHERE id_siswa='$id_siswa'");
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
  function tambah_pegawai($data)
  {
    global $conn;
    $nip = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['nip']))));
    if ($nip != "") {
      $checkNIP = mysqli_query($conn, "SELECT * FROM pegawai WHERE nip='$nip'");
      if (mysqli_num_rows($checkNIP) > 0) {
        $_SESSION['message-danger'] = "Maaf, NIP yang anda masukan sudah digunakan di data pegawai yang lain";
        $_SESSION['time-message'] = time();
        return false;
      }
    }
    $nama = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['nama']))));
    $alamat = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['alamat']))));
    $jabatan = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['jabatan']))));
    $jk = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['jk']))));
    $result = mysqli_query($conn, "INSERT INTO pegawai(nip,nama_pegawai,alamat_pegawai,jabatan_pegawai,jk_pegawai) VALUES('$nip','$nama','$alamat','$jabatan','$jk')");
    return mysqli_affected_rows($conn);
  }
  function ubah_pegawai($data)
  {
    global $conn, $time;
    $id_pegawai = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['id-pegawai']))));
    $nip = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['nip']))));
    $nipOld = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['nipOld']))));
    if ($nip != "") {
      if ($nip != $nipOld) {
        $checkNIP = mysqli_query($conn, "SELECT * FROM pegawai WHERE nip='$nip'");
        if (mysqli_num_rows($checkNIP) > 0) {
          $_SESSION['message-danger'] = "Maaf, NIP yang anda masukan sudah digunakan di data pegawai yang lain";
          $_SESSION['time-message'] = time();
          return false;
        }
      }
    }
    $nama = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['nama']))));
    $alamat = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['alamat']))));
    $jabatan = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['jabatan']))));
    $jk = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['jk']))));
    $updated_at = date("Y-m-d " . $time);
    mysqli_query($conn, "UPDATE pegawai SET nip='$nip', nama_pegawai='$nama', alamat_pegawai='$alamat', jabatan_pegawai='$jabatan', jk_pegawai='$jk', updated_at='$updated_at' WHERE id_pegawai='$id_pegawai'");
    return mysqli_affected_rows($conn);
  }
  function hapus_pegawai($data)
  {
    global $conn;
    $id_pegawai = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['id-pegawai']))));
    mysqli_query($conn, "DELETE FROM pegawai WHERE id_pegawai='$id_pegawai'");
    return mysqli_affected_rows($conn);
  }
  function tambah_prestasi($data)
  {
    global $conn;
    $id_siswa = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['id-siswa']))));
    $id_guru = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['id-guru']))));
    $lomba = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['lomba']))));
    $juara = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['juara']))));
    $tgl_lomba = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['tgl-lomba']))));
    mysqli_query($conn, "INSERT INTO prestasi(id_siswa,id_guru,lomba,juara,tgl_lomba) VALUES('$id_siswa','$id_guru','$lomba','$juara','$tgl_lomba')");
    return mysqli_affected_rows($conn);
  }
  function ubah_prestasi($data)
  {
    global $conn, $time;
    $id_prestasi = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['id-prestasi']))));
    $id_siswa = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['id-siswa']))));
    $id_guru = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['id-guru']))));
    $lomba = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['lomba']))));
    $juara = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['juara']))));
    $tgl_lomba = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['tgl-lomba']))));
    $updated_at = date("Y-m-d " . $time);
    mysqli_query($conn, "UPDATE prestasi SET id_siswa='$id_siswa', id_guru='$id_guru', lomba='$lomba', juara='$juara', tgl_lomba='$tgl_lomba', updated_at='$updated_at' WHERE id_prestasi='$id_prestasi'");
    return mysqli_affected_rows($conn);
  }
  function hapus_prestasi($data)
  {
    global $conn;
    $id_prestasi = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['id-prestasi']))));
    mysqli_query($conn, "DELETE FROM prestasi WHERE id_prestasi='$id_prestasi'");
    return mysqli_affected_rows($conn);
  }
  function tambah_pengumuman($data)
  {
    global $conn;
    $isi = $data['isi'];
    mysqli_query($conn, "INSERT INTO pengumuman(isi) VALUES('$isi')");
    return mysqli_affected_rows($conn);
  }
  function ubah_pengumuman($data)
  {
    global $conn, $time;
    $id_pengumuman = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['id-pengumuman']))));
    $isi = $data['isi'];
    $updated_at = date("Y-m-d " . $time);
    mysqli_query($conn, "UPDATE pengumuman SET isi='$isi', updated_at='$updated_at' WHERE id_pengumuman='$id_pengumuman'");
    return mysqli_affected_rows($conn);
  }
  function hapus_pengumuman($data)
  {
    global $conn;
    $id_pengumuman = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['id-pengumuman']))));
    mysqli_query($conn, "DELETE FROM pengumuman WHERE id_pengumuman='$id_pengumuman'");
    return mysqli_affected_rows($conn);
  }
  function image($route)
  {
    $namaFile = $_FILES["image"]["name"];
    $ukuranFile = $_FILES["image"]["size"];
    $error = $_FILES["image"]["error"];
    $tmpName = $_FILES["image"]["tmp_name"];
    if ($error === 4) {
      $_SESSION['message-danger'] = "Pilih gambar terlebih dahulu!";
      $_SESSION['time-message'] = time();
      return false;
    }
    $ekstensiGambarValid = ['jpg', 'png', 'jpeg', 'heic'];
    $ekstensiGambar = explode('.', $namaFile);
    $ekstensiGambar = strtolower(end($ekstensiGambar));
    if (!in_array($ekstensiGambar, $ekstensiGambarValid)) {
      $_SESSION['message-danger'] = "Maaf, file kamu bukan gambar!";
      $_SESSION['time-message'] = time();
      return false;
    }
    if ($ukuranFile > 2000000) {
      $_SESSION['message-danger'] = "Maaf, ukuran gambar terlalu besar! (2 MB)";
      $_SESSION['time-message'] = time();
      return false;
    }
    $namaFile_encrypt = crc32($namaFile);
    $encrypt = $namaFile_encrypt . ".jpg";
    move_uploaded_file($tmpName, '../assets/images/' . $route . '/' . $encrypt);
    return $encrypt;
  }
  function tambah_ekstra($data)
  {
    global $conn;
    $nama = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['nama']))));
    $deskripsi = $data['deskripsi'];
    $route = "ekstra";
    $image = image($route);
    if (!$image) {
      return false;
    }
    mysqli_query($conn, "INSERT INTO ekstra(image_ekstra,nama_ekstra,deskripsi_ekstra) VALUES('$image','$nama','$deskripsi')");
    return mysqli_affected_rows($conn);
  }
  function ubah_ekstra($data)
  {
    global $conn, $time;
    $id_ekstra = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['id-ekstra']))));
    $nama = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['nama']))));
    $deskripsi = $data['deskripsi'];
    $imageOld = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['imageOld']))));
    if (!empty($_FILES["image"]["name"])) {
      $route = "ekstra";
      $image = image($route);
      if (!$image) {
        return false;
      } else {
        unlink('../assets/images/wisata/' . $imageOld);
      }
    } else {
      $image = $imageOld;
    }
    $updated_at = date("Y-m-d " . $time);
    mysqli_query($conn, "UPDATE ekstra SET image_ekstra='$image', nama_ekstra='$nama', deskripsi_ekstra='$deskripsi', updated_at='$updated_at' WHERE id_ekstra='$id_ekstra'");
    return mysqli_affected_rows($conn);
  }
  function hapus_ekstra($data)
  {
    global $conn;
    $id_ekstra = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['id-ekstra']))));
    $imageOld = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['imageOld']))));
    unlink('../assets/images/ekstra/' . $imageOld);
    mysqli_query($conn, "DELETE FROM ekstra WHERE id_ekstra='$id_ekstra'");
    return mysqli_affected_rows($conn);
  }
}
