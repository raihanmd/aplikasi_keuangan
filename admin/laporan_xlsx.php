<?php
require '../vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

function formatDate($date)
{
    return date('d/m/Y', strtotime($date)); // Format tanggal diganti menjadi dd/mm/yyyy
}

function formatMoney($amount)
{
    return "Rp. " . number_format($amount, 0, ',', '.') . " ,-";
}

function addImageToSheet($sheet, $imagePath, $startCell, $endCell)
{
    $drawing = new \PhpOffice\PhpSpreadsheet\Worksheet\Drawing();
    $drawing->setPath($imagePath);
    $drawing->setCoordinates($startCell);
    $drawing->setOffsetX(5); // X offset (adjust as needed)
    $drawing->setOffsetY(5); // Y offset (adjust as needed)
    $drawing->setHeight(100); // Height of the image (adjust as needed)
    $drawing->setWorksheet($sheet);
    $sheet->mergeCells($startCell . ':' . $endCell);
}

$spreadsheet = new Spreadsheet();

$sheet = $spreadsheet->getActiveSheet();

$gambarKop = '../gambar/user/logo.png';
addImageToSheet($sheet, $gambarKop, 'B1', 'B4');

$sheet->setCellValue('C3', 'LAPORAN');
$sheet->setCellValue('C4', 'BGN APPS');
$sheet->mergeCells('C3:F3');
$sheet->mergeCells('C4:F4');


if (isset($_GET['tanggal_sampai']) && isset($_GET['tanggal_dari']) && isset($_GET['kategori'])) {
    $tgl_dari = $_GET['tanggal_dari'];
    $tgl_sampai = $_GET['tanggal_sampai'];
    $kategori = $_GET['kategori'];
    $saldo_awal = $_GET['saldo_awal'];

    $sheet->setCellValue('A8', 'DARI TANGGAL');
    $sheet->setCellValue('B8', ':');
    $sheet->setCellValue('C8', formatDate($tgl_dari));

    $sheet->setCellValue('A9', 'SAMPAI TANGGAL');
    $sheet->setCellValue('B9', ':');
    $sheet->setCellValue('C9', formatDate($tgl_sampai));

    $sheet->setCellValue('A10', 'KATEGORI');
    $sheet->setCellValue('B10', ':');
    if ($kategori == "semua") {
        $sheet->setCellValue('C10', 'SEMUA KATEGORI');
    } else {
        include '../koneksi.php';
        $k = mysqli_query($koneksi, "SELECT * FROM kategori WHERE kategori_id='$kategori'");
        $kk = mysqli_fetch_assoc($k);
        $sheet->setCellValue('C10', $kk['kategori']);
    }

    $sheet->setCellValue('A11', 'SALDO AWAL');
    $sheet->setCellValue('B11', ':');
    $sheet->setCellValue('C11', formatMoney($saldo_awal));

    include '../koneksi.php';
    $no = 1;
    $total_pemasukan = 0;
    $total_pengeluaran = 0;
    if ($kategori == "semua") {
        $query = "SELECT * FROM transaksi_umum, kategori WHERE kategori_id=transaksi_kategori AND date(transaksi_tanggal)>='$tgl_dari' AND date(transaksi_tanggal)<='$tgl_sampai' ORDER BY transaksi_tanggal DESC";
    } else {
        $query = "SELECT * FROM transaksi_umum, kategori WHERE kategori_id=transaksi_kategori AND kategori_id='$kategori' AND date(transaksi_tanggal)>='$tgl_dari' AND date(transaksi_tanggal)<='$tgl_sampai' ORDER BY transaksi_tanggal DESC";
    }

    $data = [];
    $result = mysqli_query($koneksi, $query);
    if ($result) {
        while ($row = mysqli_fetch_assoc($result)) {
            $data[] = $row;
        }
    } else {
        echo "Query execution failed: " . mysqli_error($koneksi);
        exit;
    }

    $row = 13;

    $sheet->setCellValue('A' . $row, 'NO');
    $sheet->setCellValue('B' . $row, 'TANGGAL');
    $sheet->setCellValue('C' . $row, 'KATEGORI');
    $sheet->setCellValue('D' . $row, 'KETERANGAN');
    $sheet->setCellValue('E' . $row, 'PEMASUKAN');
    $sheet->setCellValue('F' . $row, 'PENGELUARAN');

    $row++;

    $no = 1;
    $total_pemasukan = $saldo_awal;
    $total_pengeluaran = 0;

    $sheet->setCellValue('A' . $row, "-");
    $sheet->setCellValue('B' . $row, "-");
    $sheet->setCellValue('C' . $row, "-");
    $sheet->setCellValue('D' . $row, "SALDO AWAL");
    $sheet->setCellValue('E' . $row, formatMoney($saldo_awal));

    $sheet->setCellValue('F' . $row, '-');
    $row++;

    foreach ($data as $d) {
        $sheet->setCellValue('A' . $row, $no++);
        $sheet->setCellValue('B' . $row, formatDate($d['transaksi_tanggal']));
        $sheet->setCellValue('C' . $row, $d['kategori']);
        $sheet->setCellValue('D' . $row, $d['transaksi_keterangan']);
        if ($d['transaksi_jenis'] == "Pemasukan") {
            $sheet->setCellValue('E' . $row, formatMoney($d['transaksi_nominal']));
            $total_pemasukan += $d['transaksi_nominal'];
        } else {
            $sheet->setCellValue('E' . $row, '-');
        }
        if ($d['transaksi_jenis'] == "Pengeluaran") {
            $sheet->setCellValue('F' . $row, formatMoney($d['transaksi_nominal']));
            $total_pengeluaran += $d['transaksi_nominal'];
        } else {
            $sheet->setCellValue('F' . $row, '-');
        }
        $row++;
    }

    $sheet->setCellValue('A' . $row, 'TOTAL');
    $sheet->mergeCells('A' . $row . ':D' . $row);
    $sheet->setCellValue('E' . $row, formatMoney($total_pemasukan));
    $sheet->setCellValue('F' . $row, formatMoney($total_pengeluaran));
    $row++;

    $sheet->setCellValue('A' . $row, 'SALDO');
    $sheet->mergeCells('A' . $row . ':D' . $row);
    $sheet->getStyle('A' . $row . ':F' . $row)->getFont()->getColor()->setRGB('FFFFFF');
    $sheet->getStyle('A' . $row . ':F' . $row)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID);
    $sheet->getStyle('A' . $row . ':F' . $row)->getFill()->getStartColor()->setRGB('0070C0');
    //ALIGN DATA COLUMN
    $sheet->getStyle('A13' . ':A' . $row)->getAlignment()->setHorizontal('left');
    //ALIGN TOTAL DAN SALDO COLUMN
    $sheet->getStyle('A' . $row - 1 . ':F' . $row)->getAlignment()->setHorizontal('center');
    $sheet->setCellValue('E' . $row, formatMoney($total_pemasukan - $total_pengeluaran));
    $row++;
} else {
    $sheet->setCellValue('A4', 'Silahkan Filter Laporan Terlebih Dulu.');
    $sheet->getStyle('A4')->getFont()->setBold(true);
    $sheet->getStyle('A4')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID);
    $sheet->getStyle('A4')->getFill()->getStartColor()->setRGB('C0C0C0');
}

// Set lebar kolom tabel
$sheet->getColumnDimension('A')->setWidth(17);
$sheet->getColumnDimension('B')->setWidth(20);
$sheet->getColumnDimension('C')->setWidth(25);
$sheet->getColumnDimension('D')->setWidth(30);
$sheet->getColumnDimension('E')->setWidth(15);
$sheet->getColumnDimension('F')->setWidth(15);

$lastRow = $row - 1;
$tableRange = 'A13:F' . $lastRow;
$sheet->getStyle($tableRange)->getBorders()->getAllBorders()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);


$headerRange = 'A13:F13';
$sheet->getStyle($headerRange)->getFont()->setBold(true);
$sheet->getStyle($headerRange)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

// Set style untuk total dan saldo
$totalRange = 'A' . $row . ':F' . $row;
$sheet->getStyle($totalRange)->getFont()->setBold(true);
$sheet->getStyle($totalRange)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

$saldoRange = 'A' . ($row + 1) . ':F' . ($row + 1);
$sheet->getStyle($saldoRange)->getFont()->setBold(true);
$sheet->getStyle($saldoRange)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

$outputFilePath = 'out/laporan_keuangan.xlsx';

$writer = new Xlsx($spreadsheet);

header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="laporan_keuangan.xlsx"');
header('Cache-Control: max-age=0');

$writer->save('php://output');
