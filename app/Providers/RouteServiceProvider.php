use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

public function boot()
{
$this->routes(function () {
Route::middleware('web')
->group(base_path('routes/web.php'));
});

// Redirigir según el rol después del login
Route::get('/home', function () {
if (Auth::check()) {
return Auth::user()->roles_id == 1
? Redirect::to('/admin/products')
: Redirect::to('/user/orders');
}
return Redirect::to('/login');
});
}