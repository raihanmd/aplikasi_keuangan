<?php
require '../vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

function formatDate($date)
{
    return date('d-m-Y', strtotime($date));
}

function formatMoney($amount)
{
    return "Rp. " . number_format($amount, 0, ',', '.') . " ,-";
}

$spreadsheet = new Spreadsheet();

$sheet = $spreadsheet->getActiveSheet();

$sheet->setCellValue('A1', 'LAPORAN');
$sheet->setCellValue('A2', 'Keuangan Toko Kelontong Dan Pom Mini Bu Edy');
$sheet->mergeCells('A1:F1');
$sheet->mergeCells('A2:F2');
$sheet->getStyle('A1:F2')->getAlignment()->setHorizontal('center');

if (isset($_GET['tanggal_sampai']) && isset($_GET['tanggal_dari']) && isset($_GET['kategori'])) {
    $tgl_dari = $_GET['tanggal_dari'];
    $tgl_sampai = $_GET['tanggal_sampai'];
    $kategori = $_GET['kategori'];

    $sheet->setCellValue('A4', 'DARI TANGGAL');
    $sheet->setCellValue('B4', ':');
    $sheet->setCellValue('C4', formatDate($tgl_dari));

    $sheet->setCellValue('A5', 'SAMPAI TANGGAL');
    $sheet->setCellValue('B5', ':');
    $sheet->setCellValue('C5', formatDate($tgl_sampai));

    $sheet->setCellValue('A6', 'KATEGORI');
    $sheet->setCellValue('B6', ':');
    if ($kategori == "semua") {
        $sheet->setCellValue('C6', 'SEMUA KATEGORI');
    } else {
        include '../koneksi.php';
        $k = mysqli_query($koneksi, "SELECT * FROM kategori WHERE kategori_id='$kategori'");
        $kk = mysqli_fetch_assoc($k);
        $sheet->setCellValue('C6', $kk['kategori']);
    }

    include '../koneksi.php';
    $no = 1;
    $total_pemasukan = 0;
    $total_pengeluaran = 0;
    if ($kategori == "semua") {
        $query = "SELECT * FROM transaksi, kategori WHERE kategori_id=transaksi_kategori AND date(transaksi_tanggal)>='$tgl_dari' AND date(transaksi_tanggal)<='$tgl_sampai'";
    } else {
        $query = "SELECT * FROM transaksi, kategori WHERE kategori_id=transaksi_kategori AND kategori_id='$kategori' AND date(transaksi_tanggal)>='$tgl_dari' AND date(transaksi_tanggal)<='$tgl_sampai'";
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

    $sheet->setCellValue('A8', 'NO');
    $sheet->setCellValue('B8', 'TANGGAL');
    $sheet->setCellValue('C8', 'KATEGORI');
    $sheet->setCellValue('D8', 'KETERANGAN');
    $sheet->setCellValue('E8', 'PEMASUKAN');
    $sheet->setCellValue('F8', 'PENGELUARAN');

    $row = 9;
    $no = 1;
    $total_pemasukan = 0;
    $total_pengeluaran = 0;

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
    $sheet->getStyle('A' . $row . ':F' . $row)->getAlignment()->setHorizontal('center');
    $sheet->setCellValue('E' . $row, formatMoney($total_pemasukan - $total_pengeluaran));
    $row++;
} else {
    $sheet->setCellValue('A4', 'Silahkan Filter Laporan Terlebih Dulu.');
    $sheet->getStyle('A4')->getFont()->setBold(true);
    $sheet->getStyle('A4')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID);
    $sheet->getStyle('A4')->getFill()->getStartColor()->setRGB('C0C0C0');
}

$sheet->getColumnDimension('A')->setWidth(5);
$sheet->getColumnDimension('B')->setWidth(20); 
$sheet->getColumnDimension('C')->setWidth(25); 
$sheet->getColumnDimension('D')->setWidth(30); 
$sheet->getColumnDimension('E')->setWidth(15); 
$sheet->getColumnDimension('F')->setWidth(15); 

$outputFilePath = 'out/laporan_keuangan.xlsx';

$writer = new Xlsx($spreadsheet);

header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="laporan_keuangan.xlsx"');
header('Cache-Control: max-age=0');

$writer->save('php://output');