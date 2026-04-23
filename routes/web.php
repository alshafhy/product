<?php

use App\Helpers\Helper;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\LocaleController;
use App\Http\Controllers\AssayFormController;
use App\Http\Controllers\AssayItemController;
use App\Http\Controllers\StaterkitController;
use App\Http\Controllers\AttachmentController;
use App\Http\Controllers\AssayServiceController;
use App\Http\Controllers\NotificationController;
use Laragear\WebAuthn\Http\Routes as WebAuthn;

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

Route::get('locale/{locale}', [LocaleController::class, 'switch'])
    ->name('locale.switch')
    ->where('locale', 'ar|en');

Route::get('/underMaintenance', [App\Http\Controllers\HomeController::class, 'underMaintenance'])->name('mm');
Route::get('/pageComingSoon', [App\Http\Controllers\HomeController::class, 'pageComingSoon'])->name('pageComingSoon');
Route::get('/', [App\Http\Controllers\HomeController::class, 'pageComingSoon'])->name('home-page');
Auth::routes();


Route::get('testupload', function () {
    Storage::disk('google')->put('test.txt', 'Hello World');
});
WebAuthn::register();

Route::group([
    'middleware' => 'auth'
], function () {
    // Route::post('login', [AuthController::class, 'login']);
    // Route::post('register', [AuthController::class, 'register']);

    // Route::get('/', [StaterkitController::class, 'home'])->name('home-page');
    // Route::get('home', [StaterkitController::class, 'home'])->name('home');
    // Route::get('/', [StaterkitController::class, 'home'])->name('home');
    // Route::get('home', [StaterkitController::class, 'home'])->name('home');

    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('/convertDimention/{easting}/{northing}', [App\Http\Controllers\HomeController::class, 'convertDimention'])->name('convertDimention');

    // PDF Testing
    Route::get('/testPdf', [App\Http\Controllers\HomeController::class, 'testPdf'])->name('testPdf');
    Route::get('/previewPdf', [App\Http\Controllers\HomeController::class, 'previewPdf'])->name('previewPdf');
    Route::get('/workOrderTestReport', [App\Http\Controllers\HomeController::class, 'workOrderReport'])->name('workOrderTestReport');



    Route::resource('systemReleases', App\Http\Controllers\SystemReleaseController::class);
    Route::get('systemReleasesShow', [App\Http\Controllers\SystemReleaseController::class, 'systemReleasesShow'])->name('systemReleasesShow');
    Route::resource('systemReleasesFeatures', App\Http\Controllers\SystemReleasesFeatureController::class);
    // Route::resource('workOrderTransactionsHistories', App\Http\Controllers\WorkOrderTransactionsHistoryController::class);


    // Route Components
    Route::get('layouts/collapsed-menu', [StaterkitController::class, 'collapsed_menu'])->name('collapsed-menu');
    Route::get('layouts/full', [StaterkitController::class, 'layout_full'])->name('layout-full');
    Route::get('layouts/without-menu', [StaterkitController::class, 'without_menu'])->name('without-menu');
    Route::get('layouts/empty', [StaterkitController::class, 'layout_empty'])->name('layout-empty');
    Route::get('layouts/blank', [StaterkitController::class, 'layout_blank'])->name('layout-blank');

    // Route::get('glogin',array('as'=>'glogin','uses'=>'UserController@googleLogin')) ;
    Route::get('glogin', [App\Http\Controllers\UserController::class, 'googleLogin'])->name('glogin');
    // Route::post('upload-file',array('as'=>'upload-file','uses'=>'UserController@uploadFileUsingAccessToken')) ;
    Route::post('upload-file', [App\Http\Controllers\UserController::class, 'upload-file'])->name('upload-file');
    // locale Route
    Route::get('lang/{locale}', [LanguageController::class, 'swap']);

    //
    Route::get('me/notifications/read', [NotificationController::class, 'markAsReadNotificationAll'])->name("markAsReadNotificationAll");
    Route::get('me/notifications/read/{id}', [NotificationController::class, 'markAsReadNotification'])->name("markAsReadNotification");
    Route::get('me/notifications/', [NotificationController::class, 'showNotification'])->name("showNotification");


    //infyomlabs generator builder ui package routes
    // Route::get('generator_builder', '\InfyOm\GeneratorBuilder\Controllers\GeneratorBuilderController@builder')->name('io_generator_builder');
    // Route::get('field_template', '\InfyOm\GeneratorBuilder\Controllers\GeneratorBuilderController@fieldTemplate')->name('io_field_template');
    // Route::get('relation_field_template', '\InfyOm\GeneratorBuilder\Controllers\GeneratorBuilderController@relationFieldTemplate')->name('io_relation_field_template');
    // Route::post('generator_builder/generate', '\InfyOm\GeneratorBuilder\Controllers\GeneratorBuilderController@generate')->name('io_generator_builder_generate');
    // Route::post('generator_builder/rollback', '\InfyOm\GeneratorBuilder\Controllers\GeneratorBuilderController@rollback')->name('io_generator_builder_rollback');
    // Route::post(
    //     'generator_builder/generate-from-file',
    //     '\InfyOm\GeneratorBuilder\Controllers\GeneratorBuilderController@generateFromFile'
    // )->name('io_generator_builder_generate_from_file');

    /* Routes for attachment start */
    // Route::prefix(config('attachment.route.prefix'))->middleware(config('attachment.route.middleware'))->name('attachment.')->group(function () {
    //     Route::get("view/{uuid}", [AttachmentController::class, 'view'])->name("view");
    //     Route::get("download/{uuid}", [AttachmentController::class, 'download'])->name("download");
    //     Route::get("delete/{uuid}", [AttachmentController::class, 'delete'])->name("delete");
    // });
    /* Routes for attachment end */

    //testing
    /*************Start testing*************** */
    Route::get("send_notifications", function () {
        $title = "تصريح قارب على الانتهاء";
        $message = "رقم التصريح : - ٥٤٦٦٤٦٦٤٤٦ - التابع لامر العمل  ٥٥٥٤٦٨٤٦٣";
        Helper::SendNotifications($title, $message, 7, 'Department', '/workOrdersManagement/workOrders/15', 'bg-light-success', 'check');
        return redirect()->to('/home');
    })->name("SendTestNotification");


    Route::prefix("post")->group(function () {
        Route::get('one', function () {
            return view('post.post_file');
        });
        Route::get('many', function () {
            return view('post.post_files');
        });
        Route::get('view/{id}', function ($id) {
            $post = \App\Models\Post::with("attachments")->findOrFail($id);
            return view('post.view_file_list', ['post' => $post]);
        })->name("post_view");

        Route::post('test', function (\Illuminate\Http\Request $request) {
            $post = \App\Models\Post::create([
                'title' => $request->get("title"),
                'body' => $request->get("body"),
            ]);
            return redirect()->route("post_view", ['id' => $post->id]);
        })->name("post_store");
    });

    /* Route Forms */
    Route::group(['prefix' => 'form'], function () {
        Route::get('new_repeater', [App\Http\Controllers\FormsController::class, 'new_form_repeater'])->name('new-form-repeater');
        Route::post('new_repeater', [App\Http\Controllers\FormsController::class, 'new_form_repeater'])->name('new-form-repeater');

        Route::get('repeater', [App\Http\Controllers\FormsController::class, 'form_repeater'])->name('form-repeater');
        Route::post('repeater', [App\Http\Controllers\FormsController::class, 'form_repeater'])->name('form-repeater');
    });
});
/* Legacy Routes Block Removed */
// ── POS Dashboard Routes ─────────────────────────────────────────────
Route::middleware(['auth'])->prefix('dashboard')->name('dashboard.')->group(function () {

    // ── Foundation ────────────────────────────────────────────────
    Route::resource('categories', \App\Http\Controllers\CategoryController::class)
        ->middleware('permission:category.view');

    Route::resource('units', \App\Http\Controllers\UnitOfMeasureController::class)
        ->middleware('permission:unit.view');

    // ── Products ──────────────────────────────────────────────────
    Route::resource('products', \App\Http\Controllers\ProductController::class)
        ->middleware('permission:product.view');

    // ── Customers ─────────────────────────────────────────────────
    Route::resource('customers', \App\Http\Controllers\CustomerController::class)
        ->middleware('permission:customer.view');

    Route::post('customers/{customer}/payment', [\App\Http\Controllers\CustomerController::class, 'recordPayment'])
        ->name('customers.payment')
        ->middleware('permission:customer.record_payment');

    // ── Suppliers ─────────────────────────────────────────────────
    Route::resource('suppliers', \App\Http\Controllers\SupplierController::class)
        ->middleware('permission:supplier.view');

    Route::post('suppliers/{supplier}/adjust', [\App\Http\Controllers\SupplierController::class, 'adjustBalance'])
        ->name('suppliers.adjust')
        ->middleware('permission:supplier.adjust_balance');

    // ── Sale Invoices ─────────────────────────────────────────────
    Route::resource('sale-invoices', \App\Http\Controllers\SaleInvoiceController::class)
        ->middleware('permission:sale_invoice.view');

    Route::post('sale-invoices/{saleInvoice}/collect', [\App\Http\Controllers\SaleInvoiceController::class, 'collectDebt'])
        ->name('sale-invoices.collect')
        ->middleware('permission:sale_invoice.collect_debt');

    // ── Purchase Invoices ─────────────────────────────────────────
    Route::resource('purchase-invoices', \App\Http\Controllers\PurchaseInvoiceController::class)
        ->middleware('permission:purchase_invoice.view');

    Route::post('purchase-invoices/{purchaseInvoice}/pay', [\App\Http\Controllers\PurchaseInvoiceController::class, 'paySupplier'])
        ->name('purchase-invoices.pay')
        ->middleware('permission:purchase_invoice.pay_supplier');

    // ── Treasury ──────────────────────────────────────────────────
    Route::resource('treasury', \App\Http\Controllers\TreasuryController::class)
        ->only(['index', 'create', 'store', 'show'])
        ->middleware('permission:treasury.view');

    Route::post('treasury/deposit', [\App\Http\Controllers\TreasuryController::class, 'deposit'])
        ->name('treasury.deposit')
        ->middleware('permission:treasury.deposit');

    Route::post('treasury/withdraw', [\App\Http\Controllers\TreasuryController::class, 'withdraw'])
        ->name('treasury.withdraw')
        ->middleware('permission:treasury.withdraw');

    Route::post('treasury/expense', [\App\Http\Controllers\TreasuryController::class, 'expense'])
        ->name('treasury.expense')
        ->middleware('permission:treasury.expense');

    // ── Installments ──────────────────────────────────────────────
    Route::resource('installments', \App\Http\Controllers\InstallmentController::class)
        ->middleware('permission:installment.view');

    Route::post('installments/{installment}/collect', [\App\Http\Controllers\InstallmentController::class, 'collect'])
        ->name('installments.collect')
        ->middleware('permission:installment.collect');

    // ── Reports ───────────────────────────────────────────────────
    Route::prefix('reports')->name('reports.')->middleware('permission:report.view')->group(function () {
        Route::get('/',            [\App\Http\Controllers\ReportController::class, 'index'])->name('index');
        Route::get('/sales',       [\App\Http\Controllers\ReportController::class, 'sales'])->name('sales');
        Route::get('/stock',       [\App\Http\Controllers\ReportController::class, 'stock'])->name('stock');
        Route::get('/customers',   [\App\Http\Controllers\ReportController::class, 'customers'])->name('customers');
        Route::get('/suppliers',   [\App\Http\Controllers\ReportController::class, 'suppliers'])->name('suppliers');
        Route::get('/treasury',    [\App\Http\Controllers\ReportController::class, 'treasury'])->name('treasury');
        Route::get('/installments',[\App\Http\Controllers\ReportController::class, 'installments'])->name('installments');
    });
});
