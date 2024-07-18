<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Storage;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class QrCodeHelper
{

    // remove encode (xml) tag
    public static function generate($content, $size = 50, $status_request)
    {
        if ($status_request == 'APPROVED') {
            $qrcode = QrCode::size($size)->generate($content);
        } else {
            // $qrcode = QrCode::color(255, 0, 0)->size($size)->generate($content);
            $logoPath = public_path('assets/img/logo-color-baru.jpg');
            $qrcode = QrCode::size($size)
            ->color(255, 0, 0)
            // ->merge($logoPath, .1, true)
            // ->errorCorrection('M')
            ->generate($content);
        }

        return substr((string) $qrcode, 38);
    }

}
