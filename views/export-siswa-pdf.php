<?php
require_once("../controller/script.php");
require_once __DIR__ . '../../vendor/autoload.php';

if (isset($_GET['kelas'])) {
  $kelas = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $_GET['kelas']))));
  $kelas = str_replace("%20", " ", $kelas);
  $siswa = mysqli_query($conn, "SELECT * FROM siswa WHERE kelas='$kelas' ORDER BY id_siswa DESC");
} else if (!isset($_GET['kelas'])) {
  $siswa = mysqli_query($conn, "SELECT * FROM siswa ORDER BY id_siswa DESC");
}

$mpdf = new \Mpdf\Mpdf();
$mpdf->WriteHTML('<img src="../assets/images/cop.jpg">');
$mpdf->WriteHTML('<h2 style="text-align: center;">Data Siswa SMAN 2 Kupang Timur</h2>');
$mpdf->WriteHTML('<table class="table table-striped" style="text-align: center;margin: auto;">
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
<tbody id="search-page">
');
if (mysqli_num_rows($siswa) == 0) {
  $mpdf->WriteHTML('<tr>
<th colspan="11">Belum ada data.</th>
</tr>
');
}
$no = 1;
if (mysqli_num_rows($siswa) > 0) {
  while ($row = mysqli_fetch_assoc($siswa)) {
    $mpdf->WriteHTML('
<tr>
  <th scope="row">' . $no . '</th>
  <td>' . $row["nis"] . '</td>
  <td>' . $row["nama"] . '</td>
  <td>' . $row["kelas"] . '</td>
  <td>' . $row["alamat"] . '</td>
  <td>' . $row["tempat_lahir"] . ', ' . $row["tgl_lahir"] . '</td>
  <td>' . $row["agama"] . '</td>
  <td>' . $row["no_hp_siswa"] . '</td>
  <td>' . $row["ortu"] . '</td>
  <td>' . $row["pekerjaan"] . '</td>
  <td>' . $row["no_hp_ortu"] . '</td>
</tr>');
    $no++;
  }
}

$mpdf->WriteHTML('
</tbody>
</table>
');
$mpdf->Output();
