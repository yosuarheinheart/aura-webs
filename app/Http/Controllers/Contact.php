<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\ContactFormMail;
use App\Mail\ContactConfirmationMail;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function send(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'message' => 'required|string|min:10'
        ]);

        // Kirim email ke admin
        Mail::to('auraumn@gmail.com')->queue(new ContactFormMail($validated));

        // Kirim email konfirmasi ke pengirim
        Mail::to($validated['email'])->queue(new ContactConfirmationMail($validated));

        return response()->json(['success' => true, 'message' => 'Pesan berhasil dikirim!']);
    }
}
