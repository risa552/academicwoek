<?php
/**
 * Created by PhpStorm.
 * User: mahadoang
 * Date: 3/24/16
 * Time: 12:35 PM
 */
namespace App\services;
use Storage;
use Mpdf\Mpdf;
class PDF_Portait
{
    public static function html($html='',$orentation='P')
    {
        ini_set('memory_limit', '512M');
        ob_end_clean();
        date_default_timezone_set('Asia/Bangkok');
        $defaultConfig = (new \Mpdf\Config\ConfigVariables())->getDefaults();
        $fontDirs = $defaultConfig['fontDir'];
        $defaultFontConfig = (new \Mpdf\Config\FontVariables())->getDefaults();
        $fontData = $defaultFontConfig['fontdata'];
        
        $config = [
            'fontDir' => array_merge($fontDirs, [
                __DIR__ . '/THSarabun',
            ]),
            'fontdata' => $fontData + [
                "thsarabun" => [
                    'R' => "R.ttf",
                    'B' => "B.ttf",
                    'I' => "I.ttf",
                    'BI'=> "BI.ttf",
                    'useOTL' => 0x00,
                ]
            ],
            'default_font' => 'thsarabun',
            'orientation'  => ($orentation=='P')?'P':'L',
            'format'=>'A4',
            'mode'=>'th',
            'mgl'=>12,
            'mgr'=>12,
            'mgt'=>15,
            'mgb'=>10,
            'mgh'=>6,
            'mgf'=>3
        ];

        if($orentation=='P') $pdf = new mPDF($config); // margin left right top bottom
        else $pdf = new mPDF($config);
        $css = 'body{font-family:thsarabun;font-size:13pt;letter-spacing:0px;}.fa{font-family:fa;font-size:13px;}span{body{font-family:thsarabun;font-size:13pt;}';
        $pdf->WriteHTML($css,1);
        $pdf->WriteHTML(trim($html));
        $pdf->Output();
    }
}