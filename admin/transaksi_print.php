<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Bumi Pakarangan Ciamis</title>
    <link rel="stylesheet" href="../assets/bower_components/bootstrap/dist/css/bootstrap.min.css">
</head>
<style>

* {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
}


.kop {
  font-style: italic;
  display: flex;
  align-items: center;
}

.kop img {
  width: 100px;
  border-right: 4px solid #000;
  padding-right: 10px;
  margin-right: 10px;
  margin-top: 20px;
  margin-bottom: 20px;
}

.kop-judul {
  line-height: 4px;
}

.kop-judul h2 {
  line-height: 10px;
  font-size: 24px;
}

.kop-judul h3 {
  line-height: 10px;
  font-size: 18px;
  margin-top: 10px;
}

.kop-judul p {
  font-size: 12px;
  margin-top: 5px;
}

.row {
  margin-top: 20px;
}

.table-bordered th,
.table-bordered td {
  border: 1px solid #dee2e6;
}

.table-bordered th {
  background-color: #f5f5f5;
}

.text-center {
  text-align: center;
  margin-top: 20px;
}

table > thead > tr > th {
  font-weight: bold;
  text-align: center;
}

table tbody tr td:first-child {
  text-align: center;
}

.keterangan {
    display: flex;
    justify-content: space-around;
    text-align: center;
}

.keterangan div p:first-child {
    margin-top: 35px;
    margin-bottom: 60px;
}
</style>
<body>
    <div class="kop">
        <img src="../gambar/user/logo.png" alt="" width="120">
        <div class="kop-judul">
            <h2>BUMI PAKARANGAN CIAMIS</h2>
            <h3>Tahap 2 | #SemuaMulaiDariRumah</h3>
            <p>Jln. Timbang Windu, Desa Pamalayan, Kec Cijeungjing</p>
            <p>Kab. Ciamis, Kode Pos 46271</p>
        </div>
    </div>

    <div class="table-responsive">
        <table class="table table-bordered table-striped">
            <colgroup>
                <col style="width: 20px;">
                <col style="width: 50px;">
                <col style="width: auto;">
                <col style="width: 300px;"> <!-- Atur lebar kolom TOTAL sesuai kebutuhan -->
            </colgroup>
            <thead>
                <tr>
                    <th>NO</th>
                    <th>TANGGAL</th>
                    <th>KETERANGAN</th>
                    <th>TOTAL</th>
                </tr>
            </thead>
            <tbody>
            <?php
                include '../koneksi.php'; // Sesuaikan dengan file koneksi Anda

                function formatDate($date) {
                    return date('d/m/Y', strtotime($date));
                }

                function formatMoney($amount) {
                    return "Rp. " . number_format($amount, 0, ',', '.') . " ,-";
                }

                if (isset($_GET['query']) && !empty($_GET['query'])) {
                    $query = $_GET['query'];
                    $result = mysqli_query($koneksi, "SELECT * FROM transaksi WHERE transaksi_keterangan LIKE '%$query%' ORDER BY transaksi_id DESC");
                } else {
                    $result = mysqli_query($koneksi, "SELECT * FROM transaksi ORDER BY transaksi_id DESC");
                }

                $no = 1;
                $totalNominal = 0;
                while ($row = mysqli_fetch_assoc($result)) {
                    echo '<tr>';
                    echo '<td>' . $no . '</td>';
                    echo '<td>' . formatDate($row['transaksi_tanggal']) . '</td>';
                    echo '<td>' . $row['transaksi_keterangan'] . '</td>';
                    echo '<td>' . formatMoney($row['transaksi_nominal']) . '</td>';
                    echo '</tr>';
                    $totalNominal += $row['transaksi_nominal'];
                    $no++;
                }
                ?>
                <tr style="height: 37px;">
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <th colspan="3" class="text-center">Total</th>
                    <th><?php echo formatMoney($totalNominal); ?></th>
                </tr>
            </tbody>
        </table>
        <div class="keterangan">
            <div>
                <p>Mengetahui,</p>
                <p>Yuliati</p>
            </div>
            <div>
                <p>Div. Keuangan,</p>
                <p>Syiva</p>
            </div>
            <div>
                <p>Penerima,</p>
                <p>....................</p>
            </div>
        </div>
    </div>

    <script>
    window.print();
    $(document).ready(function(){

    });
    </script>

</body>
</html>