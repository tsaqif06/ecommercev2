<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class LanguageController extends Controller
{
    public function setLanguage(Request $request)
    {
        // Validasi input
        $request->validate([
            'language' => 'required|string|in:EN,ID',
        ]);

        // Simpan pilihan bahasa di session
        Session::put('applocale', $request->language);

        return response()->json(['success' => true]);
    }
}
