<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\tbguru;
use Yajra\DataTables\DataTables;
use setasign\Fpdi\Fpdi;
use ZipArchive;
use Illuminate\Support\Facades\Log;

class guruController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = tbguru::select('guru_id', 'foto', 'Nama', 'Agama', 'JenisKelamin', 'NomorTelephone', 'Alamat', 'Email', 'TugasMengajar', 'TugasTambahan')->get();

            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    // Tambahkan tautan unduh ke dalam kolom 'action'
                    $downloadUrl = route('guru.download', ['id' => $row->guru_id]);
                    return '<a href="' . $downloadUrl . '" class="btn btn-primary">Unduh</a>';
                })
                ->make(true);
        }

        return view('guru.index');
    }

    public function download($id)
{
    $guru = tbguru::find($id);
    $kopSuratPath = storage_path('app/public/kop/KOP[1].pdf');
        $outputPdfPath = storage_path('app/public/dokumenguru/guru_' . $guru->Nama . '_document.pdf');
        $tempPath = storage_path('app/public/dokumenguru/temp_kop_surat.pdf');
        copy($kopSuratPath, $tempPath);
        $pdf = new Fpdi();
        $pdf->setSourceFile($tempPath);
        $tplIdx = $pdf->importPage(1);
        $pdf->addPage();
        $pdf->useTemplate($tplIdx, 0, 0);
        $pdf->SetFont('times', 'B', 14);
        $pdf->SetTextColor(0, 0, 0);
        $pdf->SetXY(20, 65);
        $pdf->Cell(0, 10, 'DATA DIRI GURU', 0, 1, 'C');
        $pdf->SetFont('times', '', 12);
      
        $imagePath = null;
        if (!empty($guru->foto)) {
            // Construct the image path based on the storage directory
            $imagePath = storage_path('app/public/fotoguru/' . $guru->foto);
        }
    $gambarWidth = 40; 
    $gambarHeight = 60; 
    $gambarX = 195 - $gambarWidth;
    $gambarY = 68;
    if ($imagePath && file_exists($imagePath)) {
        $imagePathInfo = pathinfo($imagePath);
        $imageExtension = isset($imagePathInfo['extension']) ? $imagePathInfo['extension'] : '';
    
        $pdf->Image($imagePath, $gambarX, $gambarY, $gambarWidth, $gambarHeight, $imageExtension);
    } else {
    }
    
    $tableData = [
        ['Nama Lengkap :', $guru->Nama],
        ['Agama :', $guru->Agama],
        ['Jenis Kelamin :', $guru->JenisKelamin],
        ['Status Pegawai :', $guru->StatusPegawai],
        ['NIPNIPS :', $guru->NipNips],
        ['NSP :', $guru->NomorSertifikatPendidik],
        ['Tahun Sertifikasi :', $guru->TahunSertifikasi],
        ['PGT :', $guru->PangkatGolonganTerakhir],
        ['Pendidikan Akhir :', $guru->PendidikanAkhir],
        ['Jurusan :', $guru->Jurusan],
        ['Nomor Telepon :', $guru->NomorTelephone],
        ['Alamat :', $guru->Alamat],
        ['Email :', $guru->Email],
        ['Tugas Mengajar :', $guru->TugasMengajar],
        ['Tugas Tambahan :', $guru->TugasTambahan],
    ];
    $tableX = 13;
    $tableY = 80;
    $cellHeight = 10;
    foreach ($tableData as $row) {
        $pdf->SetXY($tableX, $tableY);
        $pdf->Cell(40, $cellHeight, $row[0], 0);
        $pdf->Cell(0, $cellHeight, $row[1], 0, 1);
        $tableY += $cellHeight;
    }
    $marginBottom = 10;
    // $marginLeft = 125;
    $pdf->SetY($pdf->GetY() + $marginBottom );
    // $pdf->SetX($pdf->GetX() + $marginLeft);
    $pdf->Cell(0, $cellHeight, 'Mataram, ' . date('d-m-Y'), 0, 1, 'R');

    $marginBottom = 15;
    // $marginLeft = 125;
    $pdf->SetY($pdf->GetY() + $marginBottom );
    // $pdf->SetX($pdf->GetX() + $marginLeft );
    $pdf->Cell(0, $cellHeight, $guru->Nama, 0, 1, 'R');
    $pdf->Output($outputPdfPath, 'F');
    unlink($tempPath);
    $headers = [
        'Content-Type' => 'application/pdf',
        'Content-Disposition' => 'attachment;filename="' . basename($outputPdfPath) . '"',
        'Cache-Control' => 'max-age=0',
    ];
    return response()->download($outputPdfPath, basename($outputPdfPath), $headers);
}


public function downloadAll()
{
    $gurus = tbguru::get();
    $outputZipPath = storage_path('app/public/semuafileguru/guru_documents.zip');
    $outputZipFolder = storage_path('app/public/semuafileguru/');

    if (!file_exists($outputZipFolder)) {
        mkdir($outputZipFolder, 0755, true);
    }

    $zip = new ZipArchive();
    if ($zip->open($outputZipPath, ZipArchive::CREATE) === TRUE) {
        $tempPath = storage_path('app/public/dokumenguru/temp_kop_surat.pdf');
        $kopSuratPath = storage_path('app/public/kop/KOP[1].pdf');

        foreach ($gurus as $guru) {
            try {
                $outputPdfPath = storage_path('app/public/dokumenguru/guru_' . $guru->Nama . '_document.pdf');
                copy($kopSuratPath, $tempPath);

                $pdf = new Fpdi();
                $pdf->setSourceFile($tempPath);
                $tplIdx = $pdf->importPage(1);
                $pdf->addPage();
                $pdf->useTemplate($tplIdx, 0, 0);

                // Menambahkan data ke PDF
                $pdf->SetFont('times', 'B', 14);
                $pdf->SetTextColor(0, 0, 0);
                $pdf->SetXY(20, 65);
                $pdf->Cell(0, 10, 'DATA DIRI GURU', 0, 1, 'C');

                $pdf->SetFont('times', '', 12);
$imagePath = null;
        if (!empty($guru->foto)) {
            // Construct the image path based on the storage directory
            $imagePath = storage_path('app/public/fotoguru/' . $guru->foto);
        }
    $gambarWidth = 40; 
    $gambarHeight = 60; 
    $gambarX = 195 - $gambarWidth;
    $gambarY = 68;
    if ($imagePath && file_exists($imagePath)) {
        $imagePathInfo = pathinfo($imagePath);
        $imageExtension = isset($imagePathInfo['extension']) ? $imagePathInfo['extension'] : '';
    
        $pdf->Image($imagePath, $gambarX, $gambarY, $gambarWidth, $gambarHeight, $imageExtension);
    } else {
    }
                $tableData = [
                    ['Nama Lengkap :', $guru->Nama],
                    ['Agama :', $guru->Agama],
                    ['Jenis Kelamin :', $guru->JenisKelamin],
                    ['Status Pegawai :', $guru->StatusPegawai],
                    ['NIPNIPS :', $guru->NipNips],
                    ['NSP :', $guru->NomorSertifikatPendidik],
                    ['Tahun Sertifikasi :', $guru->TahunSertifikasi],
                    ['PGT :', $guru->PangkatGolonganTerakhir],
                    ['Pendidikan Akhir :', $guru->PendidikanAkhir],
                    ['Jurusan :', $guru->Jurusan],
                    ['Nomor Telepon :', $guru->NomorTelephone],
                    ['Alamat :', $guru->Alamat],
                    ['Email :', $guru->Email],
                    ['Tugas Mengajar :', $guru->TugasMengajar],
                    ['Tugas Tambahan :', $guru->TugasTambahan],
                ];

                $tableX = 13;
                $tableY = 80;
                $cellHeight = 10;

                foreach ($tableData as $row) {
                    $pdf->SetXY($tableX, $tableY);
                    $pdf->Cell(40, $cellHeight, $row[0], 0);
                    $pdf->Cell(0, $cellHeight, $row[1], 0, 1);
                    $tableY += $cellHeight;
                }

                $marginBottom = 10;
                $pdf->SetY($pdf->GetY() + $marginBottom);
                $pdf->Cell(0, $cellHeight, 'Mataram, ' . date('d-m-Y'), 0, 1, 'R');

                $marginBottom = 15;

                $pdf->SetY($pdf->GetY() + $marginBottom);
                $pdf->Cell(0, $cellHeight, $guru->Nama, 0, 1, 'R');

                $pdf->Output($outputPdfPath, 'F');

                // Menambahkan file PDF ke dalam ZIP
                if (file_exists($outputPdfPath)) {
                    $zip->addFile($outputPdfPath, 'guru_' . $guru->Nama . '_document.pdf');
                } else {
                    Log::error('File not found: ' . $outputPdfPath);
                }
            } catch (\Exception $e) {
                Log::error('Error creating PDF for ' . $guru->Nama . ': ' . $e->getMessage());
            }
        }

        $zip->close();

        $headers = [
            'Content-Type' => 'application/zip',
            'Content-Disposition' => 'attachment;filename="' . basename($outputZipPath) . '"',
            'Pragma' => 'public',
            'Expires' => '0',
            'Cache-Control' => 'must-revalidate, post-check=0, pre-check=0',
        ];

        return response()->download($outputZipPath, basename($outputZipPath), $headers);
    } else {
        return response()->json(['error' => 'Could not create ZIP file'], 500);
    }


}
}