<?php
require '../vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

function formatDate($date)
{
    return date('d/m/Y', strtotime($date));
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
    $drawing->setOffsetX(5);
    $drawing->setHeight(100);
    $drawing->setWorksheet($sheet);
    $sheet->mergeCells($startCell . ':' . $endCell);
}

$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();

$gambarKop = '../gambar/user/logo.png';
addImageToSheet($sheet, $gambarKop, 'B2', 'B5');

$sheet->setCellValue('C2', ' BUMI PAKARANGAN CIAMIS');
$sheet->setCellValue('C3', ' Tahap 2 | #SemuaMulaiDariRumah');
$sheet->setCellValue('C4', '   Jln. Timbang Windu, Desa Pamalayan, Kec Cijeungjing');
$sheet->setCellValue('C5', '   Kab. Ciamis, Kode Pos 46271');
$sheet->mergeCells('C2:D2');
$sheet->mergeCells('C3:D3');
$sheet->mergeCells('C4:D4');
$sheet->mergeCells('C5:D5');

if (isset($_GET['query']) && !empty($_GET['query'])) {
    $query = $_GET['query'];
    $sheet->setCellValue('A8', 'FILTER');
    $sheet->setCellValue('B8', ':');
    $sheet->setCellValue('C8', $query);

    include '../koneksi.php';
    $no = 1;
    $total = 0;

    $result = mysqli_query($koneksi, "SELECT * FROM transaksi_umum WHERE transaksi_keterangan LIKE '%$query%' ORDER BY transaksi_id DESC");

    if ($result) {
        $data = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $data[] = $row;
        }
    } else {
        echo "Query execution failed: " . mysqli_error($koneksi);
        exit;
    }
} else {
    include '../koneksi.php';
    $no = 1;
    $total = 0;

    $result = mysqli_query($koneksi, "SELECT * FROM transaksi_umum ORDER BY transaksi_id DESC");

    if ($result) {
        $data = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $data[] = $row;
        }
    } else {
        echo "Query execution failed: " . mysqli_error($koneksi);
        exit;
    }
}

$sheet->setCellValue('A7', 'NO');
$sheet->setCellValue('B7', 'TANGGAL');
$sheet->setCellValue('C7', 'KETERANGAN');
$sheet->setCellValue('D7', 'TOTAL');

$sheet->getColumnDimension('A')->setWidth(5);
$sheet->getColumnDimension('B')->setWidth(16);
$sheet->getColumnDimension('C')->setWidth(50);
$sheet->getColumnDimension('D')->setWidth(20);

$no = 6;
$nomor = 1;
foreach ($data as $row) {
    $jenis = $row['transaksi_jenis'];
    $nominal = $row['transaksi_nominal'];

    $sheet->setCellValue('A' . ($no + 2), $nomor);
    $sheet->setCellValue('B' . ($no + 2), formatDate($row['transaksi_tanggal']));
    $sheet->setCellValue('C' . ($no + 2), $row['transaksi_keterangan']);

    if ($jenis == "Pemasukan") {
        $sheet->setCellValue('D' . ($no + 2), "Rp. " . number_format($nominal) . " ,-");
        $total += $nominal;
    } else {
        if (isset($_GET['jenis'])) {
            $sheet->setCellValue('D' . ($no + 2),  "Rp. " . number_format($nominal) . " ,-");
            $total += $nominal;
        } else {
            $sheet->setCellValue('D' . ($no + 2),  "Rp. -" . number_format($nominal) . " ,-");
            $total -= $nominal;
        }
    }

    $no++;
    $nomor++;
}

$lastRow = $no + 1;


$totalCollumn = 'A' . ($lastRow + 1) . ':C' . ($lastRow + 1);
$sheet->mergeCells($totalCollumn);
$sheet->getStyle($totalCollumn)->getFont()->setBold(true);
$sheet->setCellValue('A' . ($lastRow + 1), 'TOTAL');
$sheet->setCellValue('D' . ($lastRow + 1), "Rp. " . number_format($total) . " ,-");

$namaTerang = $lastRow + 4;
$sheet->setCellValue('A' . ($namaTerang), 'Mengetahui,');
$sheet->setCellValue('C' . ($namaTerang), 'Div. Keuangan,');
$sheet->setCellValue('D' . ($namaTerang), 'Penerima,');
$sheet->setCellValue('A' . ($namaTerang + 3), 'Yuliati');
$sheet->setCellValue('C' . ($namaTerang + 3), 'Syiva');
$sheet->setCellValue('D' . ($namaTerang + 3), '....................');

$sheet->mergeCells('A' . ($namaTerang) . ':B' . $namaTerang);
$sheet->mergeCells('A' . ($namaTerang + 3) . ':B' . ($namaTerang + 3));

$sheet->getStyle('A' . $namaTerang . ':D' . ($namaTerang + 3))->getFont()->setName('Futura Bk BT');
$sheet->getStyle('A' . $namaTerang . ':D' . ($namaTerang + 3))->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER)->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);

$tableRange = 'A7:D' . ($no + 2);
$sheet->getStyle($tableRange)->getFont()->setItalic(true);
$sheet->getStyle($tableRange)->getBorders()->getAllBorders()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);

$sheet->getStyle('A1:D' . ($lastRow + 1))->getFont()->setName('Futura');
$sheet->getStyle('A7:D' . ($lastRow + 1))->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER)->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);

$sheet->getStyle('C7:C' . $lastRow)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT)->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
$sheet->getStyle('D7:D' . $lastRow + 1)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT)->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);

$headerRange = 'A7:D7';
$sheet->getStyle($headerRange)->getFont()->setBold(true);
$sheet->getStyle($headerRange)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER)->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);

// mengatur kop yg atashh
$sheet->getStyle('C2:D2')->getFont()->setItalic(true)->setSize(20);
$sheet->getStyle('C3:D3')->getFont()->setItalic(true)->setSize(16);
$sheet->getStyle('C4:D4')->getFont()->setItalic(true)->setSize(8);
$sheet->getStyle('C5:D5')->getFont()->setItalic(true)->setSize(8);


$sheet->getStyle('C2:C5')->getBorders()->getLeft()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_MEDIUM);

for ($i = 7; $i <= $lastRow + 1; $i++) {
    $sheet->getRowDimension($i)->setRowHeight(23);
}

if (isset($_GET['jenis'])) {
    $sheet->insertNewRowBefore(($lastRow + 1), 1);
}

$writer = new Xlsx($spreadsheet);

header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="laporan_keuangan.xlsx"');
header('Cache-Control: max-age=0');

$writer->save('php://output');
