<?php

namespace App\Http\Controllers;

use App\Models\Atividade;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Http;

class QRCodeController extends Controller
{
    public function generate(Atividade $atividade)
    {
        $qrHash = Str::random(32);
        $qrData = route('checkin.validate', ['hash' => $qrHash]);
        
        // Gera QR Code via API externa 
        $encodedData = urlencode($qrData);
        $qrUrl = "https://api.qrserver.com/v1/create-qr-code/?size=300x300&data={$encodedData}";
        
        $response = Http::get($qrUrl );
        $qrBase64 = 'data:image/png;base64,' . base64_encode($response->body());

        $atividade->update([
            'qr_code' => $qrBase64,
            'qr_code_hash' => $qrHash,
        ]);

        return back()->with('success', 'QR Code gerado!');
    }

    public function show(Atividade $atividade)
    {
        return view('qrcode.show', compact('atividade'));
    }
}