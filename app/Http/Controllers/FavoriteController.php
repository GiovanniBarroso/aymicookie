<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Favorite;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class FavoriteController extends Controller
{
    public function index()
    {
        $favorites = Auth::user()->favorites()->with('product')->get();
        return view('favorites.index', compact('favorites'));
    }

    public function toggleFavorite($productId)
    {
        $user = Auth::user();

        try {
            DB::beginTransaction();

            $favorite = Favorite::where('user_id', $user->id)
                ->where('product_id', $productId)
                ->first();

            if ($favorite) {
                $favorite->delete();
                DB::commit();
                return response()->json(['status' => 'removed']);
            } else {
                Favorite::create([
                    'user_id' => $user->id,
                    'product_id' => $productId
                ]);
                DB::commit();
                return response()->json(['status' => 'added']);
            }

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error al cambiar favorito: ' . $e->getMessage());
            return response()->json([
                'status' => 'error',
                'message' => 'Error al actualizar favoritos. Intenta de nuevo.'
            ], 500);
        }
    }
}
