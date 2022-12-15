<?php require_once("../controller/script.php");
require_once("redirect.php");

$guru = mysqli_query($conn, "SELECT * FROM guru ORDER BY id_guru DESC");

header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=Data Guru SMAN 2 Kupang Timur.xls");
?>
<center>
  <h3>Data Guru SMAN 2 Kupang Timur</h3>
</center>
<table border="1">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">NIP</th>
      <th scope="col">Nama</th>
      <th scope="col">TTL</th>
      <th scope="col">Status</th>
      <th scope="col">Jenis Kelamin</th>
      <th scope="col">Gelar</th>
      <th scope="col">Mapel</th>
    </tr>
  </thead>
  <tbody>
    <?php if (mysqli_num_rows($guru) == 0) { ?>
      <tr>
        <th scope="row" colspan="9">belum ada data guru</th>
      </tr>
      <?php } else if (mysqli_num_rows($guru) > 0) {
      $no = 1;
      while ($row = mysqli_fetch_assoc($guru)) { ?>
        <tr>
          <th scope="row"><?= $no; ?></th>
          <td><?= $row['nip'] ?></td>
          <td><?= $row['nama'] ?></td>
          <td><?= $row['tempat_lahir'] . ", " . $row['tgl_lahir'] ?></td>
          <td><?= $row['status'] ?></td>
          <td><?= $row['jenis_kelamin'] ?></td>
          <td><?= $row['gelar'] ?></td>
          <td><?= $row['mapel'] ?></td>
        </tr>
    <?php $no++;
      }
    } ?>
  </tbody>
</table>