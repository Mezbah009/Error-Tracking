<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PdfController extends Controller
{
    public function preview($id)
    {
        $pdfPath = public_path('storage/pdf/sample.pdf'); // Adjust the path as needed

        if (file_exists($pdfPath)) {
            return response()->file($pdfPath);
        } else {
            abort(404, 'PDF file not found.');
        }
    }
}