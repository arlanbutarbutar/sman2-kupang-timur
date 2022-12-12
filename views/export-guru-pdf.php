<?php
require_once("../controller/script.php");
require_once __DIR__ . '../../vendor/autoload.php';

$guru = mysqli_query($conn, "SELECT * FROM guru ORDER BY id_guru DESC");

$mpdf = new \Mpdf\Mpdf();
// $mpdf->WriteHTML('<img src="assets/img/cop.png">');
$mpdf->WriteHTML('<h2 style="text-align: center;">Data Guru SMAN 2 Kupang Timur</h2>');
$mpdf->WriteHTML('<table class="table table-striped" style="text-align: center;margin: auto;">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">NIP</th>
      <th scope="col">Nama</th>
      <th scope="col">TTL</th>
      <th scope="col">Status</th>
      <th scope="col">Jenis Kelamin</th>
      <th scope="col">Gelar</th>
    </tr>
  </thead>
<tbody id="search-page">
');
if (mysqli_num_rows($guru) == 0) {
  $mpdf->WriteHTML('<tr>
<th colspan="7">Belum ada data.</th>
</tr>
');
}
$no = 1;
if (mysqli_num_rows($guru) > 0) {
  while ($row = mysqli_fetch_assoc($guru)) {
    $mpdf->WriteHTML('
<tr>
  <th scope="row">' . $no . '</th>
  <td>' . $row["nip"] . '</td>
  <td>' . $row["nama"] . '</td>
  <td>' . $row["tempat_lahir"] . ', ' . $row["tgl_lahir"] . '</td>
  <td>' . $row["status"] . '</td>
  <td>' . $row["jenis_kelamin"] . '</td>
  <td>' . $row["gelar"] . '</td>
</tr>');
    $no++;
  }
}

$mpdf->WriteHTML('
</tbody>
</table>
');
$mpdf->Output();
