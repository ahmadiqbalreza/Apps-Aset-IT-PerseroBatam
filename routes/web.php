<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AsetController;
use App\Http\Controllers\AsetSoftwareController;
use App\Http\Controllers\PublicAppsController;
use App\Http\Controllers\JenisAsetController;
use App\Http\Controllers\LandingPageController;
use App\Http\Controllers\LokasiAsetController;
use App\Http\Controllers\UnitController;
use App\Http\Controllers\SerahTerimaController;
use Illuminate\Support\Facades\Auth;

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

// Route::get('/', function () {
//     return view('landing-page.layout.main');
// });


Auth::routes();


// Route::get('/', [AsetController::class, 'index']);
// Route::get('/tes', [AsetController::class, 'tes']);
// Route::get('/data-aset', [AsetController::class, 'data_aset']);
// Route::get('/tambah-aset', [AsetController::class, 'create']);
// Route::post('/add-aset', [AsetController::class, 'add_aset']);

// Landing Page
Route::get('/', [LandingPageController::class, 'index']);
Route::get('/pencarian-publik', [LandingPageController::class, 'cari_publik']);
Route::get('/detail-cari', [LandingPageController::class, 'detail_cari']);
Route::get('/tiket/{nomorAset}', [LandingPageController::class, 'getdataaset']);
Route::get('/tiket', [LandingPageController::class, 'tiket']);



Route::get('/dashboard', [AsetController::class, 'dashboard'])->middleware('auth');
Route::resource('aset', AsetController::class)->middleware('auth');
Route::get('/pencarian', [AsetController::class, 'cari'])->middleware('auth');
Route::get('/tespdf', [AsetController::class, 'tespdf']);
Route::get('/tess', function () {
    return view('printtes');
});


// Route Resource
Route::resource('jenis-aset', JenisAsetController::class)->middleware('auth');
Route::resource('lokasi-aset', LokasiAsetController::class)->middleware('auth');
Route::resource('unit', UnitController::class)->middleware('auth');
Route::resource('aset-software', AsetSoftwareController::class)->middleware('auth');
Route::resource('public-apps', PublicAppsController::class)->middleware('auth');
Route::resource('serah-terima', SerahTerimaController::class)->middleware('auth');
Route::get('/export-serahterima', [SerahTerimaController::class, 'serahterimaexport']);


// Route Update data aset
// Route::put('/updateaset/{aset}', [AsetController::class, 'updateaset']);
Route::put('/aset/{aset}', [AsetController::class, 'update'])->name('aset.update');

// Route Import Export
Route::get('/export-excel', [AsetController::class, 'exportToExcelAllAset'])->name('exportallaset.excel');
Route::get('/import-excel', [AsetController::class, 'showImportForm'])->name('import.form');
Route::post('/import-excel', [AsetController::class, 'importFromExcel'])->name('import.excel');
Route::get('/export-to-excel-jenis/{jenisId}', [AsetController::class, 'exportToExcelJenisAset']);
Route::get('/export-to-excel-lokasi/{lokasiId}', [AsetController::class, 'exportToExcelLokasiAset']);
Route::get('/export-to-pdf/{sortir}', [AsetController::class, 'exportToPdf'])->name('export.to.pdf');
Route::get('/export-to-pdf-bast', [SerahTerimaController::class, 'exportToPdfbast']);


// get data
Route::get('/nomoraset', [AsetController::class, 'getNomoraset'])->name('nomoraset');
Route::get('/nomorasetsoftware', [AsetSoftwareController::class, 'getNomorasetsoftware'])->name('nomorasetsoftware');

// ETC
Route::get('/generate-barcode', [AsetController::class, 'generateBarcode'])->middleware('auth');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
