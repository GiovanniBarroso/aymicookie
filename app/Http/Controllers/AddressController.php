<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Address;
use Illuminate\Support\Facades\Auth;

class AddressController extends Controller
{
    public function index()
    {
        $addresses = Auth::user()->addresses;
        return view('addresses.index', compact('addresses'));
    }

    public function create()
    {
        return view('addresses.create');
    }

    public function store(Request $request)
    {
        // Validación de datos
        $request->validate([
            'calle' => 'required|string|max:255',
            'ciudad' => 'required|string|max:100',
            'provincia' => 'required|string|max:100',
            'codigo_postal' => 'required|string|max:10',
            'pais' => 'required|string|max:50',
        ]);

        // Obtener usuario autenticado
        $user = Auth::user();
        if (!$user) {
            return redirect()->route('addresses.index')->with('error', 'Usuario no autenticado.');
        }

        // Crear dirección manualmente con `user_id`
        $address = new Address([
            'user_id' => $user->id,  // 🔹 Asegurar que se asigna el usuario autenticado
            'calle' => $request->calle,
            'ciudad' => $request->ciudad,
            'provincia' => $request->provincia,
            'codigo_postal' => $request->codigo_postal,
            'pais' => $request->pais,
        ]);

        $address->save();

        return redirect()->route('addresses.index')->with('success', 'Dirección añadida correctamente.');
    }






    public function edit(Address $address)
    {
        if ($address->user_id !== Auth::id()) {
            abort(403);
        }
        return view('addresses.edit', compact('address'));
    }

    public function update(Request $request, Address $address)
    {
        if ($address->user_id !== Auth::id()) {
            abort(403);
        }

        $request->validate([
            'calle' => 'required|string|max:255',
            'ciudad' => 'required|string|max:100',
            'provincia' => 'required|string|max:100',
            'codigo_postal' => 'required|string|max:10',
            'pais' => 'required|string|max:50',
        ]);

        $address->update($request->all());

        return redirect()->route('addresses.index')->with('success', 'Dirección actualizada correctamente.');
    }

    public function destroy(Address $address)
    {
        if ($address->user_id !== Auth::id()) {
            abort(403);
        }

        $address->delete();
        return redirect()->route('addresses.index')->with('success', 'Dirección eliminada correctamente.');
    }
}
