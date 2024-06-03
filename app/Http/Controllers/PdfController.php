<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\Snappy\Facades\SnappyPdf; 
use Illuminate\Support\Facades\Log;

class PdfController extends Controller
{
    public function generatePdf1(Request $request)
    {
        try {
            $absensiData = $request->input('absensiData');
            $html = view('pdf.daftar_ekstrakulikuler', compact('absensiData'))->render();
            $pdfPath = public_path('generated-pdf1') . '/absensi.pdf';
            SnappyPdf::loadHTML($html)->save($pdfPath);
            Log::info('PDF berhasil dibuat!');
            return response()->json(['pdfUrl' => url('generated-pdf1/absensi.pdf')]);
        } catch (\Exception $e) {
            Log::error('Terjadi kesalahan saat membuat PDF: ' . $e->getMessage());
            return response()->json(['error' => 'Terjadi kesalahan saat membuat PDF: ' . $e->getMessage()], 500);
        }
    }
    public function generatePdf(Request $request)
    {
        try {
            $absensiData = $request->input('absensiData');
            $html = view('pdf.daftar_hadir', compact('absensiData'))->render();
            $pdfPath = public_path('generated-pdf') . '/absensi.pdf';
            SnappyPdf::loadHTML($html)->save($pdfPath);
            Log::info('PDF berhasil dibuat!');
            return response()->json(['pdfUrl' => url('generated-pdf/absensi.pdf')]);
        } catch (\Exception $e) {
            Log::error('Terjadi kesalahan saat membuat PDF: ' . $e->getMessage());
            return response()->json(['error' => 'Terjadi kesalahan saat membuat PDF: ' . $e->getMessage()], 500);
        }
    }
}
