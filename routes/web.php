<?php
use App\Http\Controllers\CommonController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\UnitController;
use App\Http\Controllers\SubCategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\HeadController;
use App\Http\Controllers\PartyController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\PurchaseDetailController;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\SaleDetailsController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\CustomerPaymentsController;
use App\Http\Controllers\ExpensesController;
use App\Http\Controllers\PaymentTypeController;
use App\Http\Controllers\addShortController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\QuatationController;
use App\Http\Controllers\QuatationDetailsController;

//Clear Cache facade value:
Route::get('/clear', function() {
    $exitCode = Artisan::call('cache:clear');
    $exitCode = Artisan::call('optimize');
     $exitCode = Artisan::call('route:cache');
        $exitCode = Artisan::call('route:clear');
        $exitCode = Artisan::call('view:clear');
         $exitCode = Artisan::call('config:cache');
    return '<h1>Done</h1>';
    
});

Route::get('/',[ReportController::class, 'index'])->name('index')->middleware('auth');


Route::get('/login', [LoginController::class, 'loginPage'])->name('login');

Route::post('login', [LoginController::class, 'Login'])->name('user.login');

Route::get('logout', [LoginController::class, 'logout'])->name('user.logout');

Route::middleware(['auth'])->group(function () {
    
    //Master file
    Route::resource('company', CompanyController::class);
    Route::resource('category', CategoriesController::class);
    Route::resource('session', SessionController::class);
    Route::resource('unit', UnitController::class);
    Route::resource('paymentType', PaymentTypeController::class);
    Route::resource('sub-category', SubCategoryController::class);
    Route::resource('product', ProductController::class);
    Route::resource('head', HeadController::class);
    Route::resource('expenses', ExpensesController::class);
    Route::resource('quatation', QuatationController::class);
    Route::resource('quatationD', QuatationDetailsController::class);
    Route::get('quatationDetailsedit', [QuatationDetailsController::class, 'show']);
    Route::get('getInfo', [ReportController::class, 'getInfo']);
    
    Route::get('incomeIndex', [ExpensesController::class, 'incomeIndex'])->name('incomeIndex');
    Route::get('incomeCreate', [ExpensesController::class, 'incomeCreate'])->name('incomeCreate');
  
    Route::resource('party', PartyController::class);
    Route::resource('supplierPayment', PaymentController::class);

    Route::get('customerPaymentIndex', [PaymentController::class, 'customerPaymentIndex'])->name('customerPaymentIndex');
    Route::get('customerPayment', [PaymentController::class, 'customerPayment'])->name('customerPayment');
    //END Master file

    //purchase
    Route::resource('purchase', PurchaseController::class);
    Route::resource('purchaseDetails', PurchaseDetailController::class);

    Route::get('purchaseDetailsEdit', [PurchaseDetailController::class, 'show']);

    Route::GET('purchase-final-submit', [PurchaseController::class, 'purchaseFinalSubmit'])->name('purchase.final.submit');

    Route::GET('purchase-edit/{id}', [PurchaseController::class, 'edit']);

    Route::get('purchase-details', [PurchaseDetailController::class, 'purchseDetails']);
    
    // SALES ROUTE
    
    Route::resource('sales', SaleController::class);

    Route::resource('salesDetails', SaleDetailsController::class);

    Route::get('saleDetailsEdit', [SaleDetailsController::class, 'show']);

    Route::GET('sale-final-submit', [SaleController::class, 'saleFinalSubmit'])->name('sale.final.submit');

    Route::GET('sale-edit/{id}', [SaleController::class, 'edit']);

    Route::GET('sale-details', [SaleDetailsController::class, 'saleDetails']);


    // ROute::get('getTotalAmount', [CommonController::class, 'getTotalAmount']);

    //select option
    Route::get('/common-get-select2', [CommonController::class, 'getSelectOption2']);
    Route::get('/common-get-select-where', [CommonController::class, 'getSelectOptionWhere']);

    // GET A VALUE
    Route::get('/common-get-value', [CommonController::class, 'getValueByAjax']);

    // GET A Row
    Route::get('/common-get-row', [CommonController::class, 'getValueRow']);

    // EDIT RECORD USING AJAX
    Route::get('/common-get-edit', [CommonController::class, 'editValueByAjax']);
    Route::get('/get-buy-sale-rate', [CommonController::class, 'getSaleBuyRate']);

    // DELETE RECORD USING AJAX
    Route::get('/common-ajax-delete', [CommonController::class, 'deleteRecordByAjax']);

    Route::get('session/status/change', [CommonController::class, 'changeStatus']);

    //add shrot
    Route::get('/add_new',[addShortController::class,'addNew']);

    //Report Route

    Route::get('/companyLedger',[ReportController::class,'companyLedger'])->name('companyLedger');
    Route::get('/supplierLedger',[ReportController::class,'saleLedger'])->name('saleLedger');
    Route::get('/customerLedger',[ReportController::class,'purchaseLadger'])->name('purchaseLadger');
    Route::get('/profit-loss-statement',[ReportController::class,'profitLossStatement'])->name('profitLossStatement');
    Route::get('/product-min-stocks',[ReportController::class,'productMinStocks'])->name('productMinStocks');


});