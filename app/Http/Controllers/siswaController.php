<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\tbsiswa;
use Yajra\DataTables\DataTables;
use setasign\Fpdi\Fpdi;
use ZipArchive;
use Illuminate\Support\Facades\Log;

class siswaController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = tbsiswa::with(['kelas'])
                ->select('siswa_id', 'foto', 'NamaLengkap', 'NomorInduk', 'NISN', 'Agama', 'JenisKelamin', 'NomorTelephone', 'Alamat', 'Email', 'kelas_id')->get();

            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    // Tambahkan tautan unduh ke dalam kolom 'action'
                    $downloadUrl = route('siswa.download', ['id' => $row->siswa_id]);
                    return '<a href="' . $downloadUrl . '" class="btn btn-primary">Unduh</a>';
                })
                ->make(true);
        }

        return view('siswa.index');
    }


    public function download($id)
    {
        $siswa = tbsiswa::with(['kelas'])->find($id);

        if (!$siswa) {
            // Siswa tidak ditemukan, mungkin hendak menangani kasus ini
            abort(404, 'Siswa tidak ditemukan');
        }
        $kopSuratPath = storage_path('app/public/kop/KOP[1].pdf');
        $outputPdfPath = storage_path('app/public/dokumensiswa/siswa_' . $siswa->NamaLengkap . '_document.pdf');
        $tempPath = storage_path('app/public/dokumensiswa/temp_kop_surat.pdf');
        copy($kopSuratPath, $tempPath);
        $pdf = new Fpdi();
        $pdf->setSourceFile($tempPath);
        $tplIdx = $pdf->importPage(1);
        $pdf->addPage();
        $pdf->useTemplate($tplIdx, 0, 0);
        $pdf->SetFont('times', 'B', 14);
        $pdf->SetTextColor(0, 0, 0);
        $pdf->SetXY(20, 65);
        $pdf->Cell(0, 10, 'DATA DIRI SISWA', 0, 1, 'C');
        $pdf->SetFont('times', '', 12);
        $imagePath = null;
        if (!empty($siswa->foto)) {
            // Construct the image path based on the storage directory
            $imagePath = storage_path('app/public/fotosiswa/' . $siswa->foto);
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

           
            ['Nama Lengkap :', $siswa->NamaLengkap],
            ['Tempat Lahir :', $siswa->TempatLahir],
            ['Tanggal Lahir :', $siswa->TanggalLahir],
            ['Agama :', $siswa->Agama],
            ['Jenis Kelamin :', $siswa->JenisKelamin],
            ['Nomor Induk :', $siswa->NomorInduk],
            ['NISN :', $siswa->NISN],
            ['Nomor Telephone :', $siswa->NomorTelephone],
            ['Email :', $siswa->Email],
            ['Alamat :', $siswa->Alamat],
            ['Kelas :', $siswa->kelas ? $siswa->kelas->namakelas : '-'],
        ];
        $tableX = 20;
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
        
        $pdf->Cell(0, $cellHeight, $siswa->NamaLengkap, 0, 1, 'R');
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
        $siswas = tbsiswa::with('kelas')->get();
        $outputZipPath = storage_path('app/public/semuafilesiswa/siswa_documents.zip');
        $outputZipFolder = storage_path('app/public/semuafilesiswa/');
        if (!file_exists($outputZipFolder)) {
            mkdir($outputZipFolder, 0755, true);
        }
    
        $zip = new ZipArchive();
        if ($zip->open($outputZipPath, ZipArchive::CREATE) === TRUE) {
            $tempPath = storage_path('app/public/dokumensiswa/temp_kop_surat.pdf');
            $kopSuratPath = storage_path('app/public/kop/KOP[1].pdf');
            foreach ($siswas as $siswa) {
                try {
                    $outputPdfPath = storage_path('app/public/dokumensiswa/siswa_' . $siswa->NamaLengkap . '_document.pdf');
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
                    $pdf->Cell(0, 10, 'DATA DIRI Siswa', 0, 1, 'C');
    
                    $pdf->SetFont('times', '', 12);
    $imagePath = null;
            if (!empty($siswa->foto)) {
                // Construct the image path based on the storage directory
                $imagePath = storage_path('app/public/fotosiswa/' . $siswa->foto);
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
                        ['Nama Lengkap :', $siswa->NamaLengkap],
                        ['Tempat Lahir :', $siswa->TempatLahir],
                        ['Tanggal Lahir :', $siswa->TanggalLahir],
                        ['Agama :', $siswa->Agama],
                        ['Jenis Kelamin :', $siswa->JenisKelamin],
                        ['Nomor Induk :', $siswa->NomorInduk],
                        ['NISN :', $siswa->NISN],
                        ['Nomor Telephone :', $siswa->NomorTelephone],
                        ['Email :', $siswa->Email],
                        ['Alamat :', $siswa->Alamat],
                        ['Kelas :', $siswa->kelas ? $siswa->kelas->namakelas : '-'],
                        
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
                    $pdf->Cell(0, $cellHeight, $siswa->NamaLengkap, 0, 1, 'R');
    
                    $pdf->Output($outputPdfPath, 'F');
    
                    // Menambahkan file PDF ke dalam ZIP
                    if (file_exists($outputPdfPath)) {
                        $zip->addFile($outputPdfPath, 'siswa_' . $siswa->NamaLengkap . '_document.pdf');
                    } else {
                        Log::error('File not found: ' . $outputPdfPath);
                    }
                } catch (\Exception $e) {
                    Log::error('Error creating PDF for ' . $siswa->NamaLengkap . ': ' . $e->getMessage());
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













    // public function downloadAll()
    // {
    //     set_time_limit(120);

    //     $siswas = tbsiswa::with('kelas')->get();

    //     $outputZipPath = storage_path('app/siswa_documents.zip');
    //     $zip = new \ZipArchive();
    //     $zip->open($outputZipPath, \ZipArchive::CREATE);

    //     $batchSize = 50;
    //     $siswasChunks = array_chunk($siswas->toArray(), $batchSize);

    //     $kelas = Cache::remember('daftar_kelas', now()->addMinutes(2), function () {
    //         return kelas::select('namakelas')->get();
    //     });

    //     collect($siswasChunks)->each(function ($siswasChunk) use ($kelas, $zip) {
    //         foreach ($siswasChunk as $siswa) {
    //             $outputPdfPath = $this->generateStudentPdf($siswa, $kelas);
    //             $zip->addFile($outputPdfPath, 'siswa_' . $siswa['NamaLengkap'] . '_document.pdf');
    //         }
    //     });

    //     $zip->close();

    //     $headers = [
    //         'Content-Type' => 'application/zip',
    //         'Content-Disposition' => 'attachment;filename="' . basename($outputZipPath) . '"',
    //         'Cache-Control' => 'max-age=0',
    //     ];

    //     return response()->download($outputZipPath, basename($outputZipPath), $headers);
    // }

    private function generateStudentPdf($siswa, $kelas)
    {
        $tempPath = storage_path('app/temp_kop_surat.pdf');
        $kopSuratPath = public_path('kop/KOP[1].pdf');
        $outputPdfPath = storage_path('app/siswa_' . $siswa['NamaLengkap'] . '_document.pdf');

        copy($kopSuratPath, $tempPath);

        $pdf = new Fpdi();
        $pdf->setSourceFile($tempPath);
        $tplIdx = $pdf->importPage(1);
        $pdf->addPage();
        $pdf->useTemplate($tplIdx, 0, 0);
        $pdf->SetFont('times', 'B', 14);
        $pdf->SetTextColor(0, 0, 0);
        $pdf->SetXY(20, 65);
        $pdf->Cell(0, 10, 'DATA DIRI SISWA', 0, 1, 'C');
        $pdf->SetFont('times', '', 12);
        $imagePath = null;
        if (!empty($siswa->foto)) {
            // Construct the image path based on the storage directory
            $imagePath = public_path('fotosiswa/' . $siswa->foto);
        }

        $gambarWidth = 40;
        $gambarHeight = 60;
        $gambarX = 195 - $gambarWidth;
        $gambarY = 68;

        if ($imagePath && file_exists($imagePath)) {
            $imagePathInfo = pathinfo($imagePath);
            $imageExtension = isset($imagePathInfo['extension']) ? $imagePathInfo['extension'] : '';

            $pdf->Image($imagePath, $gambarX, $gambarY, $gambarWidth, $gambarHeight, $imageExtension);
        }

        $tableData = [
            ['Nama Lengkap :', $siswa['NamaLengkap']],
            ['Jenis Kelamin :', $siswa['JenisKelamin']],
            ['Agama :', $siswa['Agama']],
            ['Nomor Induk :', $siswa['NomorInduk']],
            ['NISN :', $siswa['NISN']],
            ['Nomor Telepon :', $siswa['NomorTelephone']],
            ['Email :', $siswa['Email']],
            ['Alamat :', $siswa['Alamat']],
            ['Kelas :', isset($siswa['kelas']) ? $siswa['kelas']['namakelas'] : '-'],

        ];

        $tableX = 20;
        $tableY = 80;
        $cellHeight = 10;

        foreach ($tableData as $row) {
            $pdf->SetXY($tableX, $tableY);
            $pdf->Cell(40, $cellHeight, $row[0], 0);
            $pdf->Cell(0, $cellHeight, $row[1], 0, 1);
            $tableY += $cellHeight;
        }

        $marginBottom = 10;
        $marginLeft = 130;
        $pdf->SetY($pdf->GetY() + $marginBottom);
        $pdf->SetX($pdf->GetX() + $marginLeft);
        $pdf->Cell(0, $cellHeight, 'Mataram, ' . date('d-m-Y'), 0, 1, 'L');

        $marginBottom = 15;
        $marginLeft = 130;
        $pdf->SetY($pdf->GetY() + $marginBottom);
        $pdf->SetX($pdf->GetX() + $marginLeft);
        $pdf->Cell(0, $cellHeight, $siswa['NamaLengkap'], 0, 1, 'L');

        $pdf->Output($outputPdfPath, 'F');
        unlink($tempPath);

        return $outputPdfPath;
    }
}
