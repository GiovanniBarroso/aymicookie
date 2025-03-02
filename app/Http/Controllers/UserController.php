<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('admin.users.index', compact('users'));
    }

    public function show($id)
    {
        $user = User::findOrFail($id);
        return view('admin.users.show', compact('user'));
    }

    public function destroy($id)
    {
        try {
            DB::beginTransaction();

            $user = User::findOrFail($id);
            $user->delete();

            DB::commit();

            return redirect()->route('users.index')->with('success', 'Usuario eliminado correctamente');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error al eliminar usuario: ' . $e->getMessage());
            return redirect()->route('users.index')->with('error', 'Error al eliminar el usuario.');
        }
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('admin.users.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'apellidos' => 'nullable|string|max:255',
            'email' => 'required|email|max:255',
            'roles_id' => 'required|integer',
        ]);

        try {
            DB::beginTransaction();

            $user = User::findOrFail($id);
            $user->update($request->all());

            DB::commit();

            return redirect()->route('users.index')->with('success', 'Usuario actualizado correctamente');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error al actualizar usuario: ' . $e->getMessage());
            return redirect()->route('users.index')->with('error', 'Error al actualizar el usuario.');
        }
    }
}
