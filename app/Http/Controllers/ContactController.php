<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactMessage;
use Illuminate\Support\Facades\Log;

class ContactController extends Controller
{
    public function send(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email',
            'subject' => 'required|string|max:150',
            'message' => 'required|string|max:1000',
        ]);

        $data = [
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'subject' => $request->input('subject'),
            'message' => $request->input('message'),
        ];

        try {
            Mail::to('aymicookie21@gmail.com')->send(new ContactMessage($data));

            return redirect()->back()->with('success', '¡Mensaje enviado correctamente! 📩');
        } catch (\Exception $e) {
            Log::error('Error al enviar mensaje de contacto: ' . $e->getMessage());

            return redirect()->back()->with('error', 'Error al enviar el mensaje. Intenta de nuevo más tarde.');
        }
    }
}
