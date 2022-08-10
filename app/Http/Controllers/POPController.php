<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use setasign\Fpdi\Fpdi;
use setasign\Fpdi\PdfReader;
use setasign\Fpdi\PdfReader\PdfReader as PdfReaderPdfReader;

class POPController extends Controller
{
    public function process(Request $request)
    {
        // $descript = $request->post('descript');
        // $price = $request->post('price');


        $title = "REVLON";
        $descript = "HAIR COLOR DARK BROWN 60 ML";
        $price_normal = "4000";
        $price_discount = "2000";
        $date = "06 s/d 31 Juli 2022";


        $dateFile = date("Ymd");
        $nameFile = $dateFile . "_$title" . '.pdf';

        $outputfile = public_path() . "\master\ $nameFile";
        $path = public_path("POPPromoContent1Template.pdf");
        $this->promo($path, $outputfile, $title, $descript, $price_normal, $price_discount, $date);

        return response()->file($outputfile);
    }

    public function Smash($file, $outputfile, $title, $descript, $price_normal, $price_discount, $date)
    {
    }

    public function Bbm($file, $outputfile, $title, $descript, $price_normal, $price_discount, $date)
    {
    }

    public function solmet($file, $outputfile, $title, $descript, $price_normal, $price_discount, $date)
    {
    }

    public function hargaHeboh()
    {
    }

    public function promo($file, $outputfile, $title, $descript, $price_normal, $price_discount, $date)
    {

        $pdf = new Fpdi();

        // // echo json_encode($file);
        // // echo json_encode($outputfile);
        // // echo json_encode($descript);
        // // echo json_encode($price);

        // $pdf->AddPage();

        // $pdf->SetFont('helvetica', '', '14');

        // $path = public_path('dcc.pdf');

        // $pdf->setSourceFile($path);

        // $tplID = $pdf->importPage(1);

        // $pdf->useTemplate($tplID, null, null, null, 210, true);

        // $pdf->SetXY(90, 10);
        // $pdf->Write(0.1, "Demo Test");


        // $pdf->SetXY(90, 30);
        // $pdf->Write(0.1, "Demo Test");

        // $pdf->Output('I', "Demotest.pdf");

        $pdf->setSourceFile($file);
        $template = $pdf->importPage(1);
        $size = $pdf->getTemplateSize($template);
        $pdf->AddPage($size['orientation'], array($size['width'], $size['height']));
        $pdf->useTemplate($template);
        $top = 130;
        $right = 50;

        $pdf->SetFont("helvetica", "B", 17);
        $pdf->SetTextColor(25, 26, 25);


        // $pdf->Text($right, $top, $title, $descript);


        $pdf->SetXY(72, 135);
        $pdf->SetFontSize(20.0);
        $pdf->Cell(20, 10, $title, 0, 0, 'C');

        $pdf->SetXY(75, 143);
        $pdf->SetFontSize(14.0);
        $pdf->Cell(20, 10, $descript, 0, 0, 'C');



        $pdf->SetXY(200, 135);
        $pdf->SetFontSize(20.0);
        $pdf->Cell(20, 10, $title, 0, 0, 'C');

        $pdf->SetXY(200, 143);
        $pdf->SetFontSize(14.0);
        $pdf->Cell(20, 10, $descript, 0, 0, 'C');

        // ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++

        $number1 = number_format($price_normal, 0, ".", ".");
        $pdf->SetXY(40, 170);
        $pdf->SetFontSize(30.0);
        $pdf->Write(0.1, "$number1");

        $number1 = number_format($price_normal, 0, ".", ".");
        $pdf->SetXY(168, 170);
        $pdf->SetFontSize(30.0);
        $pdf->Write(0.1, "$number1");

        $number2 = number_format($price_discount, 0, ".", ".");
        $pdf->SetXY(45, 189);
        $pdf->SetTextColor(255, 0, 0);
        $pdf->SetFontSize(40.0);
        // $pdf->Cell(25,5,"<span style='text-decoration: line-through;'>$ ".number_format($price_discount, 2, ".</span>", ","),1,0,'R');
        $pdf->Write(0.1, "$number2");


        $number2 = number_format($price_discount, 0, ".", ".");
        $pdf->SetXY(173, 189);
        $pdf->SetTextColor(255, 0, 0);
        $pdf->SetFontSize(40.0);
        // $pdf->Cell(25,5,"<span style='text-decoration: line-through;'>$ ".number_format($price_discount, 2, ".</span>", ","),1,0,'R');
        $pdf->Write(0.1, "$number2");



        // ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++

        $pdf->SetXY(103, 189);
        $pdf->SetTextColor(0, 0, 0);
        $pdf->SetFontSize(12.0);
        $pdf->Write(0.1, $date);

        $pdf->SetXY(236, 189);
        $pdf->SetTextColor(0, 0, 0);
        $pdf->SetFontSize(12.0);
        $pdf->Write(0.1, $date);


        return $pdf->Output($outputfile, 'F');
    }
}
