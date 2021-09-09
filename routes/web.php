<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
//Route::get('/}', function () {
// return view('auth.login');
//})->where('any', '.*');
//});
/*Route::get('/{any}', function () {
    return view('welcome');
})->where('any', '.*');
*/
//Route::get('/{any}', function () {
//    return view('index');
//})->where('any', '.*');

//Route::get('/}', function () {
//    return view('index');
//});

 //Auth::routes();

 Route::get('/', [App\Http\Controllers\Admin\HomeController::class, 'index'])->name('web');

Route::get('/login', [App\Http\Controllers\Auth\LoginController::class, 'login'])->name('auth');

Route::get('/register', [App\Http\Controllers\Auth\RegisterController::class, 'register'])->name('auth');

Route::get('/perfil', [App\Http\Controllers\Auth\PerfilController::class, 'perfil'])->name('auth');

Route::get('/dashboard', [App\Http\Controllers\Web\DashboardController::class, 'dashboard'])->name('web');

Route::get('/estudiantes', [App\Http\Controllers\Web\EstudiantesController::class, 'estudiantes'])->name('web');

Route::get('/docentes', [App\Http\Controllers\Web\DocentesController::class, 'docentes'])->name('web');

Route::get('/matriculacion', [App\Http\Controllers\Web\MatriculacionController::class, 'matriculacion'])->name('web');

Route::get('/actividades', [App\Http\Controllers\Web\ActividadesController::class, 'actividades'])->name('web');

Route::get('/evaluaciones', [App\Http\Controllers\Web\EvaluacionesController::class, 'evaluaciones'])->name('web');

Route::get('/cursos', [App\Http\Controllers\Web\CursosController::class, 'cursos'])->name('web');

Route::get('/materias', [App\Http\Controllers\Web\MateriasController::class, 'materias'])->name('web');

Route::get('/periodos', [App\Http\Controllers\Web\PeriodosController::class, 'periodos'])->name('web');

Route::get('/planes', [App\Http\Controllers\Web\PlanesController::class, 'planes'])->name('web');

Route::get('/asignadoc', [App\Http\Controllers\Web\AsignadocController::class, 'asignadoc'])->name('web');

Route::get('/modalidad', [App\Http\Controllers\Web\ModalidadController::class, 'modalidad'])->name('web');

Route::get('/aula', [App\Http\Controllers\Web\AulaController::class, 'aula'])->name('web');

Route::get('/seccion', [App\Http\Controllers\Web\SeccionController::class, 'seccion'])->name('web');

Route::get('/general', [App\Http\Controllers\Web\GeneralController::class, 'general'])->name('web');

Route::get('/calificaciones', [App\Http\Controllers\Web\CalificacionesController::class, 'calificaciones'])->name('web');

Route::get('/analisisdatos', [App\Http\Controllers\Web\AnalisisdatosController::class, 'analisisdatos'])->name('web');

Route::get('/reparto', [App\Http\Controllers\Web\RepartoController::class, 'reparto'])->name('web');

Route::get('/especialidad', [App\Http\Controllers\Web\EspecialidadController::class, 'especialidad'])->name('web');

Route::get('/tipogrado', [App\Http\Controllers\Web\TipogradoController::class, 'tipogrado'])->name('web');

Route::get('/tiposangre', [App\Http\Controllers\Web\TiposangreController::class, 'tiposangre'])->name('web');

Route::get('/tipocurso', [App\Http\Controllers\Web\TipocursoController::class, 'tipocurso'])->name('web');

Route::get('/ejecurso', [App\Http\Controllers\Web\EjecursoController::class, 'ejecurso'])->name('web');

Route::get('/roles', [App\Http\Controllers\Web\RolesController::class, 'roles'])->name('web');

Route::get('/usuario', [App\Http\Controllers\Web\UsuarioController::class, 'usuario'])->name('web');

Route::get('/password', [App\Http\Controllers\Web\PasswordController::class, 'password'])->name('web');

Route::get('/salir', [App\Http\Controllers\Web\SalirController::class, 'salir'])->name('web');






