<?php
//entity controller
use App\Http\Controllers\Api\V1\Entity\DocumentController;
use App\Http\Controllers\Api\V1\Entity\EntityContactController;
use App\Http\Controllers\Api\V1\Entity\EntityController;
use App\Http\Controllers\Api\V1\Entity\EntityEmployeeController;
use App\Http\Controllers\Api\V1\Entity\EntityProductController;
use App\Http\Controllers\Api\V1\Entity\InventoryController;
use App\Http\Controllers\Api\V1\Entity\ProductController;
use App\Http\Controllers\Api\V1\Entity\TransactionController;
use App\Http\Controllers\Api\V1\Entity\ProfileController;
use App\Http\Controllers\Api\V1\Entity\ReportNinePointOneController;
use App\Http\Controllers\Api\V1\Entity\ReportSixPointTwoPointOneController;
use App\Http\Controllers\Api\V1\Entity\TreasuryDepositController;
use App\Http\Controllers\Reports\ReportNinePointOneExcel;
use App\Http\Controllers\Reports\ReportNinePointOnePDF;
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

Route::group(['middleware' => ['auth:sanctum']], function () {

    Route::group(
        ['middleware' => 'user.permission', 'prefix' => 'profile'],
        function () {
            Route::post('update', [ProfileController::class, 'profile_update']);
        }
    );

    //document
    Route::group(['prefix' => 'documents'], function () {
        Route::post('upload/', [DocumentController::class, 'upload']);
        // for filter entity document via filelist tab
        Route::get('/{entity}/{status}', [DocumentController::class, 'getEntityDocumentsViaStatus']);
        //for showing in filelist tab
        Route::get('/{entity}/{transaction_id}/{status}', [DocumentController::class, 'getEntityDocumentsViaTransactionAndStatus']);
        Route::post('/trash/document/{entityId}/{documentId}', [DocumentController::class, 'trashDocument']);
        Route::post('/delete/document/{entityId}/{documentId}', [DocumentController::class, 'deleteDocument']);
    });

    ///For transactions store
    Route::post('/transaction/{entity_id}', [TransactionController::class, 'store']);
    Route::get('/transaction/details/{entity_id}/{transaction_id}/', [TransactionController::class, 'transactionDetails']);



    //update transaction via entity_id and transaction_id
    Route::post('/transaction/update/{entity_id}/{transaction_id}/', [TransactionController::class, 'update']);

    //updating transaction status
    Route::post('/transaction/update/status/{entity_id}/{transaction_id}/{status}', [TransactionController::class, 'updateReviewStatusOfTransaction']);
    //get transaction via document id
    Route::get('transaction/{entity_id}/{document_id}', [TransactionController::class, 'getTransactionViaDocument']);


    //for 9.1 form
    Route::get('transactions/{entity_id}', [TransactionController::class, 'transactions']);
    Route::get('/transactions/{entity_id}/{dateTimeQuery}', [TransactionController::class, 'transactionsViaQuery']);


    ///documenttypes
    Route::get('/documentTypes', [DocumentController::class, 'documentTypes']);
    ///bank list
    Route::get('/banks', [DocumentController::class, 'banksList']);
    //get dictionary product via hs_code
    Route::get('/product/{product_hs_code}', [ProductController::class, 'getDictionaryProduct']);




    //required routes for transaction
    Route::get('/tax_rates', [DocumentController::class, 'getTaxRates']);
    Route::get('/sd_rates', [DocumentController::class, 'getSdRates']);
    Route::get('/at_rates', [DocumentController::class, 'getAtRates']);
    Route::get('/transactionTypes', [DocumentController::class, 'getTransactionTypes']);
    Route::get('/productNatures', [DocumentController::class, 'getProductNature']);


    //entity
    Route::get('/auth_user/entities', [EntityController::class, 'index']);
    Route::get('/entities', [EntityController::class, 'index']);

    Route::get('/entity_products/{entity_id}/{product_code}', [EntityProductController::class, 'getEntityProduct']);
    Route::get('/entity_products/{entity_id}/{product_id}/product', [EntityProductController::class, 'getProductViaId']);
    Route::get('/entity_products/{entity_id}', [EntityProductController::class, 'entityProductList']);
    Route::get('/entity_untracking_products/{entity_id}', [EntityProductController::class, 'entityUntrackingProducts']);




    Route::get('/entity/employees/{entity_id}', [EntityEmployeeController::class, 'entityEmployees']);

    //contacts of entity
    Route::get('/get-contacts/{entity_id}', [EntityContactController::class, 'index']);
    Route::get('/entity/contacts/transactions/{entity_id}', [EntityContactController::class, 'getContactsWithTransactionsForEntity']);
    Route::get('/entity/contacts/transactions/{entity_id}/{contact_id}', [EntityContactController::class, 'getContactViaId']);



    //entity sells transactions
    Route::get('/sells_transactions/{entity_id}/{date}', [ReportNinePointOneController::class, 'sellsTransactionDetailsViaDate']);
    Route::get('/sells_transactions/{entity_id}/{fromDate}/{toDate}', [ReportNinePointOneController::class, 'sellsTransactionDetailsViaDateRange']);


    //entity purchase transactions
    Route::get('/purchase_transactions/{entity_id}/{date}', [ReportNinePointOneController::class, 'purchaseTransactionDetailsViaDate']);
    Route::get('/purchase_transactions/{entity_id}/{fromDate}/{toDate}/', [ReportNinePointOneController::class, 'purchaseTransactionDetailsViaDateRange']);


    ///report generators pdf
    Route::get('/report-nine-point-one/pdf/{entity_id}/{date}', [ReportNinePointOnePDF::class, 'exportPDFUsingDate']);
    Route::get('/report-nine-point-one/pdf/{entity_id}/{fromDate}/{toDate}', [ReportNinePointOnePDF::class, 'exportPDFUsingDateRange']);

    //report generators excel
    Route::get('/report-nine-point-one/excel/{entity_id}/{date}', [ReportNinePointOneExcel::class, 'exportExcelUsingDate']);
    Route::get('/report-nine-point-one/excel/{entity_id}/{fromDate}/{toDate}', [ReportNinePointOneExcel::class, 'exportExcelUsingDateRange']);



    Route::get('/localTransactionDetails/{entity_id}/{note}/{fromDate}/{toDate}/{transactionType}', [ReportNinePointOneController::class, 'getLocalTransactionDetailsInDateRange']);

    Route::get('/localTransactionDetails/{entity_id}/{note}/{date}/{transactionType}', [ReportNinePointOneController::class, 'getLocalTransactionDetailsInDate']);

    Route::get('/importTransactionDetails/{entity_id}/{note}/{fromDate}/{toDate}/{transactionType}', [ReportNinePointOneController::class, 'getImportTransactionDetailsInDateRange']);

    Route::get('/importTransactionDetails/{entity_id}/{note}/{date}/{transactionType}', [ReportNinePointOneController::class, 'getImportTransactionDetailsInDate']);


    //next day I will work on it
    Route::get('/getAdjustments/{entity_id}/{fromDate}/{toDate}/{adjustment_type}', [ReportNinePointOneController::class, 'getAdjustmentInDateRange']);
    Route::get('/getAdjustments/{entity_id}/{date}/{adjustment_type}', [ReportNinePointOneController::class, 'getAdjustmentInDate']);


    Route::get('/getTreasuryDeposits/{entity_id}/{fromDate}/{toDate}', [TreasuryDepositController::class, 'getTreasuryDepositsInDateRange']);
    Route::get('/getTreasuryDeposits/{entity_id}/{date}', [TreasuryDepositController::class, 'getTreasuryDepositsInDate']);
    Route::get('/getTreasuryDepositsViaDepositType/{entity_id}/{fromDate}/{toDate}/{depositType}', [TreasuryDepositController::class, 'getTreasuryDepositsInDateRangeViaDepositType']);
    Route::get('/getTreasuryDepositsViaDepositType/{entity_id}/{date}/{depositType}', [TreasuryDepositController::class, 'getTreasuryDepositsInDateViaDepositType']);


    Route::controller(InventoryController::class)->group(function () {
        Route::post('/registerProduct/{entity_id}', 'registerProduct');
        Route::get('/transactionProducts/{entityId}/{entityProductId}', 'transactionProducts');
    });

    Route::controller(ReportSixPointTwoPointOneController::class)->group(function () {
        Route::get('/getTransactionProductsViaProductIdInDateRange/{entityId}/{productId}/{fromDate}/{toDate}', 'getTransactionProductsViaProductIdInDateRange');
        Route::get('/getTransactionProductsViaProductIdInDate/{entityId}/{productId}/{date}', 'getTransactionProductsViaProductIdInDate');
    });
});
