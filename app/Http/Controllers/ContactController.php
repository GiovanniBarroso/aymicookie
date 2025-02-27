<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function index()
    {
        return view('contact');
    }

    public function send(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'message' => 'required|string|min:10',
        ]);

        // Enviar el correo (configurar en .env)
        Mail::raw("Mensaje de: {$request->name}\nEmail: {$request->email}\n\n{$request->message}", function ($mail) use ($request) {
            $mail->to('contacto@aymicookie.com')
                 ->subject('Nuevo Mensaje de Contacto');
        });

        return back()->with('success', 'Tu mensaje ha sido enviado con éxito.');
    }
}
