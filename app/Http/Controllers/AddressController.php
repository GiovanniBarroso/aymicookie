<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Address;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

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
        $request->validate([
            'calle' => 'required|string|max:255',
            'ciudad' => 'required|string|max:100',
            'provincia' => 'required|string|max:100',
            'codigo_postal' => 'required|string|max:10',
            'pais' => 'required|string|max:50',
        ]);

        $user = Auth::user();
        if (!$user) {
            return redirect()->route('addresses.index')->with('error', 'Usuario no autenticado.');
        }

        try {
            DB::beginTransaction();

            $address = new Address([
                'user_id' => $user->id,
                'calle' => $request->calle,
                'ciudad' => $request->ciudad,
                'provincia' => $request->provincia,
                'codigo_postal' => $request->codigo_postal,
                'pais' => $request->pais,
            ]);

            $address->save();

            DB::commit();

            return redirect()->route('addresses.index')->with('success', 'Dirección añadida correctamente.');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error al guardar dirección: ' . $e->getMessage());
            return redirect()->route('addresses.index')->with('error', 'Error al guardar la dirección. Intenta de nuevo.');
        }
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

        try {
            DB::beginTransaction();

            $address->update($request->all());

            DB::commit();

            return redirect()->route('addresses.index')->with('success', 'Dirección actualizada correctamente.');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error al actualizar dirección: ' . $e->getMessage());
            return redirect()->route('addresses.index')->with('error', 'Error al actualizar la dirección. Intenta de nuevo.');
        }
    }

    public function destroy(Address $address)
    {
        if ($address->user_id !== Auth::id()) {
            abort(403);
        }

        try {
            DB::beginTransaction();

            $address->delete();

            DB::commit();

            return redirect()->route('addresses.index')->with('success', 'Dirección eliminada correctamente.');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error al eliminar dirección: ' . $e->getMessage());
            return redirect()->route('addresses.index')->with('error', 'Error al eliminar la dirección. Intenta de nuevo.');
        }
    }
}
