<?php require_once("../controller/script.php");
require_once("redirect.php");

if (isset($_GET['kelas'])) {
  $kelas = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $_GET['kelas']))));
  $kelas = str_replace("%20", " ", $kelas);
  $siswa = mysqli_query($conn, "SELECT * FROM siswa WHERE kelas='$kelas' ORDER BY id_siswa DESC");
} else if (!isset($_GET['kelas'])) {
  $siswa = mysqli_query($conn, "SELECT * FROM siswa ORDER BY id_siswa DESC");
}

header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=Data siswa SMAN 2 Kupang Timur.xls");
?>
<center>
  <h3>Data Siswa SMAN 2 Kupang Timur</h3>
</center>
<table border="1">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">NIS</th>
      <th scope="col">Nama</th>
      <th scope="col">Kelas</th>
      <th scope="col">Alamat</th>
      <th scope="col">TTL</th>
      <th scope="col">Agama</th>
      <th scope="col">No HP</th>
      <th scope="col">Nama Ortu/Wali</th>
      <th scope="col">Pekerjaan</th>
      <th scope="col">No HP Ortu/Wali</th>
    </tr>
  </thead>
  <tbody>
    <?php if (mysqli_num_rows($siswa) == 0) { ?>
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
        </tr>
    <?php $no++;
      }
    } ?>
  </tbody>
</table>