<?php
require_once("../controller/script.php");
require_once __DIR__ . '../../vendor/autoload.php';

$pegawai = mysqli_query($conn, "SELECT * FROM pegawai ORDER BY id_pegawai DESC");

$mpdf = new \Mpdf\Mpdf();
$mpdf->WriteHTML('<img src="../assets/images/cop.jpg">');
$mpdf->WriteHTML('<h2 style="text-align: center;">Data Pegawai SMAN 2 Kupang Timur</h2>');
$mpdf->WriteHTML('<table class="table table-striped" style="text-align: center;margin: auto;">
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
<tbody id="search-page">
');
if (mysqli_num_rows($pegawai) == 0) {
  $mpdf->WriteHTML('<tr>
<th colspan="7">Belum ada data.</th>
</tr>
');
}
$no = 1;
if (mysqli_num_rows($pegawai) > 0) {
  while ($row = mysqli_fetch_assoc($pegawai)) {
    $mpdf->WriteHTML('
<tr>
  <th scope="row">' . $no . '</th>
  <td>' . $row["nip"] . '</td>
  <td>' . $row["nama_pegawai"] . '</td>
  <td>' . $row["alamat_pegawai"] . '</td>
  <td>' . $row["jabatan_pegawai"] . '</td>
  <td>' . $row["jk_pegawai"] . '</td>
</tr>');
    $no++;
  }
}

$mpdf->WriteHTML('
</tbody>
</table>
');
$mpdf->Output();
