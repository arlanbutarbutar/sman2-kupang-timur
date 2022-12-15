<?php require_once("../controller/script.php");
require_once("redirect.php");

$pegawai = mysqli_query($conn, "SELECT * FROM pegawai ORDER BY id_pegawai DESC");

header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=Data Pegawai SMAN 2 Kupang Timur.xls");
?>
<center>
  <h3>Data Pegawai SMAN 2 Kupang Timur</h3>
</center>
<table border="1">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">NIP</th>
      <th scope="col">Nama</th>
      <th scope="col">Alamat</th>
      <th scope="col">Jabatan</th>
      <th scope="col">Jenis Kelamin</th>
    </tr>
  </thead>
  <tbody>
    <?php if (mysqli_num_rows($pegawai) == 0) { ?>
      <tr>
        <th scope="row" colspan="9">belum ada data pegawai</th>
      </tr>
      <?php } else if (mysqli_num_rows($pegawai) > 0) {
      $no = 1;
      while ($row = mysqli_fetch_assoc($pegawai)) { ?>
        <tr>
          <th scope="row"><?= $no; ?></th>
          <td><?= $row['nip'] ?></td>
          <td><?= $row['nama_pegawai'] ?></td>
          <td><?= $row['alamat_pegawai'] ?></td>
          <td><?= $row['jabatan_pegawai'] ?></td>
          <td><?= $row['jk_pegawai'] ?></td>
        </tr>
    <?php $no++;
      }
    } ?>
  </tbody>
</table>