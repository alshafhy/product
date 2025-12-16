<?php

use App\Helpers\Helper;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\AssayFormController;
use App\Http\Controllers\AssayItemController;
use App\Http\Controllers\StaterkitController;
use App\Http\Controllers\AttachmentController;
use App\Http\Controllers\AssayServiceController;
use App\Http\Controllers\NotificationController;

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

Route::get('/underMaintenance', [App\Http\Controllers\HomeController::class, 'underMaintenance'])->name('mm');
Route::get('/pageComingSoon', [App\Http\Controllers\HomeController::class, 'pageComingSoon'])->name('pageComingSoon');
Route::get('/', [App\Http\Controllers\HomeController::class, 'pageComingSoon'])->name('home-page');
Auth::routes();
Route::get('testupload', function () {
    Storage::disk('google')->put('test.txt', 'Hello World');
});


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
    Route::resource('workOrderTransactionsHistories', App\Http\Controllers\WorkOrderTransactionsHistoryController::class);


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
    Route::get('generator_builder', '\InfyOm\GeneratorBuilder\Controllers\GeneratorBuilderController@builder')->name('io_generator_builder');
    Route::get('field_template', '\InfyOm\GeneratorBuilder\Controllers\GeneratorBuilderController@fieldTemplate')->name('io_field_template');
    Route::get('relation_field_template', '\InfyOm\GeneratorBuilder\Controllers\GeneratorBuilderController@relationFieldTemplate')->name('io_relation_field_template');
    Route::post('generator_builder/generate', '\InfyOm\GeneratorBuilder\Controllers\GeneratorBuilderController@generate')->name('io_generator_builder_generate');
    Route::post('generator_builder/rollback', '\InfyOm\GeneratorBuilder\Controllers\GeneratorBuilderController@rollback')->name('io_generator_builder_rollback');
    Route::post(
        'generator_builder/generate-from-file',
        '\InfyOm\GeneratorBuilder\Controllers\GeneratorBuilderController@generateFromFile'
    )->name('io_generator_builder_generate_from_file');

    /* Routes for attachment start */
    Route::prefix(config('attachment.route.prefix'))->middleware(config('attachment.route.middleware'))->name('attachment.')->group(function () {
        Route::get("view/{uuid}", [AttachmentController::class, 'view'])->name("view");
        Route::get("download/{uuid}", [AttachmentController::class, 'download'])->name("download");
        Route::get("delete/{uuid}", [AttachmentController::class, 'delete'])->name("delete");
    });
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
    /*************End testing*************** */
});

Route::middleware(['auth', 'acl'])->group(function () {


    Route::group(array('prefix' => 'commonScreens'), function () {
        Route::resource('districts', App\Http\Controllers\DistrictController::class);
        Route::resource('cities', App\Http\Controllers\CityController::class);
        Route::resource('attachmentTypes', App\Http\Controllers\AttachmentTypeController::class);
        Route::resource('branches', App\Http\Controllers\BranchController::class);
        Route::resource('baladies', App\Http\Controllers\BaladyController::class);
    });

    Route::group(array('prefix' => 'userManagement'), function () {
        Route::get('/change-password', [App\Http\Controllers\UserController::class, 'changePassword'])->name('change-password');
        Route::post('/change-password', [App\Http\Controllers\UserController::class, 'updatePassword'])->name('update-password');
        Route::resource('users', App\Http\Controllers\UserController::class);
        Route::resource('roles', App\Http\Controllers\RoleController::class);
        Route::get('/roles/{role}/_permissions/{objectId?}', [App\Http\Controllers\RoleController::class, 'getPermissionsView'])->name('roles.getPermissions');
    });


    Route::group(array('prefix' => 'workOrdersManagement'), function () {
        Route::resource('electricalStationsTypes', App\Http\Controllers\ElectricalStationsTypeController::class);
        Route::resource('electricityDepartments', App\Http\Controllers\ElectricityDepartmentController::class);
        Route::resource('workTypes', App\Http\Controllers\WorkTypeController::class);
        Route::resource('contractors', App\Http\Controllers\ContractorController::class);
        Route::resource('consultants', App\Http\Controllers\ConsultantController::class);

        Route::resource('workOrdersTypes', App\Http\Controllers\WorkOrdersTypeController::class);
        Route::resource('workOrdersStages', App\Http\Controllers\WorkOrdersStageController::class);
        Route::resource('workOrdersPermitTypes', App\Http\Controllers\WorkOrdersPermitTypeController::class);

        Route::resource('workOrdersProjects', App\Http\Controllers\WorkOrdersProjectController::class);
        Route::post('workOrdersProjects/{id}/close', [App\Http\Controllers\WorkOrdersProjectController::class, 'closeProject'])->name('workOrdersProjects.close');
        Route::resource('servicesCategories', App\Http\Controllers\ServicesCategoryController::class);
        Route::resource('workOrderServices', App\Http\Controllers\WorkOrderServiceController::class);

        Route::post('workOrders/update_attachment/{work_order_id}', [App\Http\Controllers\WorkOrderController::class, 'update_attachment'])->name('workOrders.update_attachment');
        Route::post('workOrdersPermits/update_attachment/{work_order_permit_id}', [App\Http\Controllers\WorkOrdersPermitController::class, 'update_attachment'])->name('workOrdersPermits.update_attachment');

        Route::patch('workOrders/updateStatus/{Status}/{work_order_id}/{redirectTo?}', [App\Http\Controllers\WorkOrderController::class, 'updateStatus'])->name('workOrders.changeStatus');
        Route::resource('workOrders', App\Http\Controllers\WorkOrderController::class);
        Route::resource('workOrdersDrilling', App\Http\Controllers\WorkOrderController::class);
        Route::resource('workOrdersDrillingProjects', App\Http\Controllers\WorkOrderController::class);
        Route::resource('workOrdersElectricity', App\Http\Controllers\WorkOrderController::class);
        Route::resource('workOrdersElectricTowers', App\Http\Controllers\WorkOrderController::class);
        Route::resource('workOrdersPermits', App\Http\Controllers\WorkOrdersPermitController::class);
        Route::get('recalculateWorkOrdersPermit', [App\Http\Controllers\WorkOrdersPermitController::class, 'recalculateWorkOrdersPermit']);
        Route::resource('workOrdersPermitsExtensions', App\Http\Controllers\WorkOrdersPermitsExtensionController::class);
        Route::resource('workOrdersPermitsFines', App\Http\Controllers\WorkOrdersPermitsFineController::class);
        Route::resource('electricityCompanyEmployees', App\Http\Controllers\ElectricityCompanyEmployeesController::class);
    });

    Route::group(array('prefix' => 'employeesManagement'), function () {
        Route::resource('departments', App\Http\Controllers\DepartmentController::class);
        Route::resource('jobs', App\Http\Controllers\JobController::class);
        Route::resource('employees', App\Http\Controllers\EmployeeController::class);
    });

    Route::group(array('prefix' => 'stores'), function () {
        Route::resource('units', App\Http\Controllers\UnitController::class);
        Route::resource('itemsCategories', App\Http\Controllers\ItemsCategoryController::class);
        Route::resource('items', App\Http\Controllers\ItemController::class);

        Route::resource('servicesCategories', App\Http\Controllers\ServicesCategoryController::class);
        Route::resource('workOrderServices', App\Http\Controllers\WorkOrderServiceController::class);

        Route::get('assayForms/printAssay/{id}', [App\Http\Controllers\AssayFormController::class, 'print_assay'])->name("assayForms.printAssay");
        Route::resource('assayForms', App\Http\Controllers\AssayFormController::class);
        Route::resource('assayService', App\Http\Controllers\AssayServiceController::class);
        Route::resource('assayItem', App\Http\Controllers\AssayItemController::class);
        Route::get('assayForms/approval/{id}', [App\Http\Controllers\AssayFormController::class, 'approval'])->name("assayForms.approval");
        Route::post('assayForms/{id}/services', [App\Http\Controllers\AssayServiceController::class, 'add_services'])->name("assayService.services");
    });

    Route::group(array('prefix' => 'systemManagement'), function () {
        Route::resource('systemComponents', App\Http\Controllers\SystemComponentController::class);
    });

    Route::group(array('prefix' => 'restablishWorkOrders'), function () {
        Route::resource('layers', App\Http\Controllers\LayerController::class);
        Route::resource('landLayers', App\Http\Controllers\LandLayerController::class);
        Route::delete('delete_history/{id}', [App\Http\Controllers\LandLayerController::class, 'deleteFromHistory']);
        Route::resource('labs', App\Http\Controllers\LabController::class);
        Route::resource('returnSituations', App\Http\Controllers\ReturnSituationController::class);
        Route::patch('workOrderFollows/updateStatus/{Status}/{work_order_id}/{redirectTo?}', [App\Http\Controllers\WorkOrderFollowController::class, 'updateStatus'])->name('WorkOrderFollows.changeStatus');
        Route::resource('workOrderFollows', App\Http\Controllers\WorkOrderFollowController::class);
        Route::get('workOrderFollows/printWorkOrderFollows/{id}', [App\Http\Controllers\WorkOrderFollowController::class, 'printWorkOrderFollows'])->name("workOrderFollows.printFollow");
    });

    Route::group(array('prefix' => 'emergency'), function () {
        Route::post('emergencyMissions/update_attachment/{work_order_id}', [App\Http\Controllers\EmergencyMissionController::class, 'update_attachment'])->name('emergencyMissions.update_attachment');
        Route::post('emergencyMissions/convertToWorkOrder/{emergency_mission_id}', [App\Http\Controllers\EmergencyMissionController::class, 'convertToWorkOrder'])->name('emergencyMissions.convertToWorkOrder');
        Route::patch('emergencyMissions/updateStatus/{Status}/{emergency_mission_id}/{redirectTo?}', [App\Http\Controllers\EmergencyMissionController::class, 'updateStatus'])->name('emergencyMissions.changeStatus');
        Route::resource('missionTypes', App\Http\Controllers\MissionTypeController::class);
        Route::resource('emergencyMissions', App\Http\Controllers\EmergencyMissionController::class);
        Route::resource('emergencyIssuesTypes', App\Http\Controllers\EmergencyIssuesTypeController::class);
    });

    Route::group(array('prefix' => 'paymentClearances'), function () {
        Route::resource('financialDueTypes', App\Http\Controllers\FinancialDueTypeController::class);
        Route::resource('achievementCertificates', App\Http\Controllers\AchievementCertificateController::class);
        Route::get('achievementCertificates/approval/{id}', [App\Http\Controllers\AchievementCertificateController::class, 'approval'])->name("achievementCertificates.approval");
        Route::resource('financialDues', App\Http\Controllers\FinancialDueController::class);
        Route::get('financialDues/approval/{id}', [App\Http\Controllers\FinancialDueController::class, 'approval'])->name("financialDues.approval");
        Route::get('financialDues/{financial_due_id}/{work_order_id}', [App\Http\Controllers\FinancialDueController::class, 'deleteWorkOrder'])->name("financialDues.deleteWorkOrder");
        Route::post('financialDues/{financial_due_id}', [App\Http\Controllers\FinancialDueController::class, 'storeWorkOrder'])->name("financialDues.storeWorkOrder");
    });

    // Reports
    Route::group(array('prefix' => 'reports'), function () {
        Route::get('/previewPdf/{reportName}', [App\Http\Controllers\Reports\ReportController::class, 'show'])->name('previewReport');
        Route::post('/previewPdf/{reportName}', [App\Http\Controllers\Reports\ReportController::class, 'show'])->name('previewReport');

        Route::get('/workOrdersGeneralReport', [App\Http\Controllers\Reports\WorkOrdersReportsController::class, 'workOrdersGeneralReport'])->name('workOrdersGeneralReport');
        Route::get('/unfinishedDrillingWorkOrdersReport', [App\Http\Controllers\Reports\WorkOrdersReportsController::class, 'unfinishedDrillingWorkOrdersReport'])->name('unfinishedDrillingWorkOrdersReport');
        Route::get('/finishedDrillingWorkOrdersReport', [App\Http\Controllers\Reports\WorkOrdersReportsController::class, 'finishedDrillingWorkOrdersReport'])->name('finishedDrillingWorkOrdersReport');
        Route::get('/electricTowerWorkOrdersReport', [App\Http\Controllers\Reports\WorkOrdersReportsController::class, 'electricTowerWorkOrdersReport'])->name('electricTowerWorkOrdersReport');

        Route::get('/finishedElectricyWorkOrdersReport', [App\Http\Controllers\Reports\WorkOrdersReportsController::class, 'finishedElectricyWorkOrdersReport'])->name('finishedElectricyWorkOrdersReport');
        Route::get('/electricyOperationsReport', [App\Http\Controllers\Reports\WorkOrdersReportsController::class, 'electricyOperationsReport'])->name('electricyOperationsReport');
        Route::get('/electricyCountersReport', [App\Http\Controllers\Reports\WorkOrdersReportsController::class, 'electricyCountersReport'])->name('electricyCountersReport');

        Route::get('/workOrdersPermitReport', [App\Http\Controllers\Reports\PermitFollowReportsController::class, 'workOrdersPermitReport'])->name('workOrdersPermitReport');
        Route::get('/emergencyMissionsDailyReport', [App\Http\Controllers\Reports\EmergencyMissionsReportsController::class, 'emergencyMissionsDailyReport'])->name('emergencyMissionsDailyReport');

        Route::get('/ordersWithOutCertificatesReport', [App\Http\Controllers\Reports\FinancialDuesReportsController::class, 'ordersWithOutCertificatesReport'])->name('ordersWithOutCertificatesReport');
        Route::get('/ordersWithOutFinancialDuesReport', [App\Http\Controllers\Reports\FinancialDuesReportsController::class, 'ordersWithOutFinancialDuesReport'])->name('ordersWithOutFinancialDuesReport');
        Route::get('/finishedFinancialDuesReport', [App\Http\Controllers\Reports\FinancialDuesReportsController::class, 'finishedFinancialDuesReport'])->name('finishedFinancialDuesReport');
        Route::get('/allFinancialDuesReport', [App\Http\Controllers\Reports\FinancialDuesReportsController::class, 'allFinancialDuesReport'])->name('allFinancialDuesReport');

        Route::get('/allRecivedOrdersReport', [App\Http\Controllers\Reports\TopManagementReportsController::class, 'allRecivedOrdersReport'])->name('allRecivedOrdersReport');
        Route::get('/permitFinesAmountsReport', [App\Http\Controllers\Reports\TopManagementReportsController::class, 'permitFinesAmountsReport'])->name('permitFinesAmountsReport');
        Route::get('/totalPermitAmountsReport', [App\Http\Controllers\Reports\TopManagementReportsController::class, 'totalPermitAmountsReport'])->name('totalPermitAmountsReport');
    });
});


// Route::resource('missionTypes', App\Http\Controllers\MissionTypeController::class);


// Route::resource('consultants', App\Http\Controllers\ConsultantController::class);















Route::resource('sizes', App\Http\Controllers\SizeController::class);
Route::resource('colors', App\Http\Controllers\ColorController::class);
Route::resource('products', App\Http\Controllers\ProductController::class);
