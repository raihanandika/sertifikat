<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use setasign\Fpdi\Fpdi;
use setasign\Fpdi\PdfReader;
use setasign\Fpdi\PdfReader\PdfReader as PdfReaderPdfReader;

class SertifikatController extends Controller
{
    public function process(Request $request)
    {
        // $descript = $request->post('descript');
        // $price = $request->post('price');

        $name = "RAIHAN ANDIKA";

        $dateFile = date("Ymd");
        $nameFile = $dateFile . "_$name" . '.pdf';

        $outputfile = public_path() . "\master\ $nameFile";
        $path = public_path("template.pdf");
        $this->sertifikat($path, $outputfile, $name);

        return response()->file($outputfile);
    }

    public function sertifikat($file, $outputfile, $name)
    {

        $pdf = new Fpdi();

        $pdf->setSourceFile($file);
        $template = $pdf->importPage(1);
        $size = $pdf->getTemplateSize($template);
        $pdf->AddPage($size['orientation'], array($size['width'], $size['height']));
        $pdf->useTemplate($template);
        $top = 130;
        $right = 50;

        $pdf->SetFont("helvetica", "B", 17);
        $pdf->SetTextColor(25, 26, 25);

        $pdf->SetXY(135, 93);
        $pdf->SetFontSize(30.0);
        $pdf->Cell(20, 10, $name, 0, 0, 'C');


        return $pdf->Output($outputfile, 'F');
    }
}
