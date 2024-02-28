<?php

namespace App\Http\Controllers\Api\V1\Entity;

use App\Http\Controllers\Controller;
use App\Models\TransactionProduct;
use Illuminate\Http\Request;

class ReportSixPointTwoPointOneController extends Controller
{
    public function getTransactionProductsViaProductIdInDateRange($entity_id,$productId, $fromDate, $toDate)
    {
        $transactionsProducts = TransactionProduct::with(['transaction', 'transaction.contact', 'entity_product'])->join('transactions', 'transactions.id', '=', 'transaction_products.transaction_id')->where(function ($query) use ($fromDate, $toDate, $entity_id,$productId) {
            $query->where([
                ['transactions.transaction_date', '>=', $fromDate],
                ['transactions.transaction_date', '<=', $toDate],
                ['transactions.entity_id', '=', $entity_id],
                ['transaction_products.entity_product_id', '=', $productId],
                // ['transactions.review_status', '=', 'approved']/just for now
            ]);
        })->select('transaction_products.*')->orderBy('transactions.transaction_date', 'asc')->get(); //->orderBy('transactions.transaction_type_id', 'asc')
        return response()->json(compact('transactionsProducts'));
    }

    public function getTransactionProductsViaProductIdInDate($entity_id,$productId, $date)
    {
        $transactionsProducts = TransactionProduct::with(['transaction', 'transaction.contact', 'entity_product'])
            ->join('transactions', 'transactions.id', '=', 'transaction_products.transaction_id')->where(function ($query) use ($date, $entity_id,$productId) {
                $query->whereMonth('transactions.transaction_date', date('m', strtotime($date)))
                    ->whereYear('transactions.transaction_date', date('Y', strtotime($date)))
                    ->where([
                        ['transactions.entity_id', '=', $entity_id],
                        ['transaction_products.entity_product_id', '=', $productId],
                        // ['transactions.review_status', '=', 'approved'] //just for now
                    ]);
            })->select('transaction_products.*')->orderBy('transactions.transaction_date', 'asc')->get(); //->orderBy('transactions.transaction_type_id', 'asc')
        return response()->json(compact('transactionsProducts'));
    }
}
