<?php require_once("../controller/script.php");
require_once("redirect.php");

$siswa = mysqli_query($conn, "SELECT * FROM siswa ORDER BY id_siswa DESC");

header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=Data Siswa SMAN 2 Kupang Timur.xls");
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
    </tr>
  </thead>
  <tbody>
    <?php if (mysqli_num_rows($siswa) == 0) { ?>
      <tr>
        <th scope="row" colspan="7">belum ada data siswa</th>
      </tr>
      <?php } else if (mysqli_num_rows($siswa) > 0) {
      $no = 1;
      while ($row = mysqli_fetch_assoc($siswa)) {
        $tgl_lahir = date_create($row['tgl_lahir']);
        $tgl_lahir = date_format($tgl_lahir, "d M Y"); ?>
        <th scope="row"><?= $no; ?></th>
        <td><?= $row['nis'] ?></td>
        <td><?= $row['nama'] ?></td>
        <td><?= $row['kelas'] ?></td>
        <td><?= $row['alamat'] ?></td>
        <td><?= $row['tempat_lahir'] . ", " . $tgl_lahir ?></td>
        <td><?= $row['agama'] ?></td>
        </tr>
    <?php $no++;
      }
    } ?>
  </tbody>
</table>