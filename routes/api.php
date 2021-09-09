<?php

use App\Http\Controllers\Api\ActividadevaController;
use App\Models\Actividadeva;
use App\Http\Controllers\Api\AlumnoController;
use App\Models\Alumno;
use App\Http\Controllers\Api\AulaController;
use App\Models\Aula;
use App\Http\Controllers\Api\CursoController;
use App\Models\Curso;
use App\Http\Controllers\Api\DocenteController;
use App\Models\Docente;
use App\Http\Controllers\Api\EjecursoController;
use App\Models\Ejecurso;
use App\Http\Controllers\Api\EspecialidadController;
use App\Models\Especialidad;
use App\Http\Controllers\Api\EvaluacionController;
use App\Models\Evaluacion;
use App\Http\Controllers\Api\DetallevaController;
use App\Models\Detalleva;
use App\Http\Controllers\Api\AsignadocController;
use App\Models\Asignadoc;
use App\Http\Controllers\Api\MateriaController;
use App\Models\Materia;
use App\Http\Controllers\Api\MatriculaController;
use App\Models\Matricula;
use App\Http\Controllers\Api\ModalidadcursoController;
use App\Models\Modalidadcurso;
use App\Http\Controllers\Api\PeriodoController;
use App\Models\Periodo;
use App\Http\Controllers\Api\PlanestudioController;
use App\Models\Planes;
use App\Http\Controllers\Api\RepartoController;
use App\Models\Reparto;
use App\Http\Controllers\Api\RolesController;
use App\Http\Controllers\Api\SeccionController;
use App\Http\Controllers\Api\TipocursoController;
use App\Models\Tipocurso;
use App\Http\Controllers\Api\TipogradoController;
use App\Models\Tipogrado;
use App\Http\Controllers\Api\TiposangreController;
use App\Models\Tiposangre;
use App\Http\Controllers\Api\UserController;
Use App\Models\RoleUser;
use App\Http\Controllers\Api\RoleController;
Use App\Models\Role;
use App\Http\Controllers\Api\PermissionController;
Use App\Models\Permission;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

// API MODELO ACTIVIDADEVA
Route::apiResource('actividadeva',ActividadevaController::class);

// API MODELO ALUMNO
Route::apiResource('alumno',AlumnoController::class);

// API MODELO AULA
Route::apiResource('aula',AulaController::class);

// API MODELO EJECURSO
Route::apiResource('ejecurso',EjecursoController::class);

// API MODELO ESPECIALIDAD
Route::apiResource('especialidad',EspecialidadController::class);

//API MODELO EVALUACION
Route::get('evaluacion', [EvaluacionController::class, 'index']);

//API MODELO DETALLEEVALUACION
Route::get('detalleva', [DetallevaController::class, 'index']);

// API MODELO GESTION
Route::get('gestion', [GestionController::class, 'index']);

// API MODELO ASIGNADOC
Route::apiResource('asignadoc',AsignadocController::class);

// API MODELO MATERIA
Route::apiResource('materia',MateriaController::class);

// API MODELO CURSO
Route::apiResource('curso',CursoController::class);

// API MODELO MATRICULA
Route::apiResource('matricula',MatriculaController::class);

// API MODELO MODALIDAD
Route::apiResource('modalidad',ModalidadcursoController::class);

// API MODELO CLASE
Route::apiResource('clase',ClasesController::class);

// API MODELO DOCENTE
Route::apiResource('docente',DocenteController::class);

// API MODELO PERIODO
Route::apiResource('periodo',PeriodoController::class);

// API MODELO PLANESTUDIO
Route::apiResource('planestudio',PlanestudioController::class);

// API MODELO REPARTO
Route::apiResource('reparto',RepartoController::class);

// API MODELO ROLES
Route::apiResource('role',RoleController::class);

// API MODELO PERMISO
Route::apiResource('permission',PermissionController::class);

// API MODELO SECCION
Route::apiResource('seccion',SeccionController::class);

// API MODELO TIPOCURSO
Route::apiResource('tipocurso',TipocursoController::class);

// API MODELO TIPOGRADO
Route::apiResource('tipogrado',TipogradoController::class);

// API MODELO TIPOSANGRE
Route::apiResource('tiposangre',TiposangreController::class);

// API MODELO USER
Route::apiResource('user',UserController::class);
