<?php

namespace App\Helpers\V1;

use App\Helpers\Global\GetSDRate;
use App\Helpers\Global\GetVATRate;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\TransactionProduct;

class ReportNinePointOneHelper
{

    public static function transactionProductsViaTransactionTypeWithDate($entity_id, $date, $transaction_type_id)
    {
        $transactionsProducts = TransactionProduct::with(['transaction', 'transaction.contact'])
        ->join('transactions', 'transactions.id', '=', 'transaction_products.transaction_id')->where(function ($query) use ($date, $entity_id, $transaction_type_id) {
            $query->whereMonth('transactions.transaction_date', date('m', strtotime($date)))
                ->whereYear('transactions.transaction_date', date('Y', strtotime($date)))
                ->where([
                    ['transactions.entity_id', '=', $entity_id],
                    ['transactions.transaction_type_id', '=', $transaction_type_id],
                    ['transactions.review_status', '=', 'approved']
                ]);
        })->select('transaction_products.*')->get();
        return $transactionsProducts;
    }

    public static function transactionProductsViaTransactionTypeWithDateRange($entity_id, $fromDate, $toDate, $transaction_type_id)
    {
        $transactionsProducts = TransactionProduct::with(['transaction', 'transaction.contact'])->join('transactions', 'transactions.id', '=', 'transaction_products.transaction_id')->where(function ($query) use ($fromDate, $toDate, $entity_id, $transaction_type_id) {
            $query->where([
                ['transactions.transaction_date', '>=', $fromDate],
                ['transactions.transaction_date', '<=', $toDate],
                ['transactions.entity_id', '=', $entity_id],
                ['transactions.transaction_type_id', '=', $transaction_type_id],
                ['transactions.review_status', '=', 'approved']
            ]);
        })->select('transaction_products.*')->get();
        return $transactionsProducts;
    }

    public static function transactionProductsTaxableValue($transactionProducts)
    {
        return $transactionProducts->reduce(fn ($carry, $item) => $carry + $item->taxable_value, 0);
    }

    public static function transactionProductsSDRate($transactionProducts)
    {

        if (count($transactionProducts) > 0) {
            return $transactionProducts->reduce(fn ($carry, $item) => $carry + GetSDRate::handler($item), 0);
        }
        return 0;
    }
    public static function transactionProductsVATRate($transactionProducts)
    {

        if (count($transactionProducts) > 0) {
            return $transactionProducts->reduce(fn ($carry, $item) => $carry + GetVATRate::handler($item), 0);
        }
        return 0;
    }

    public static function  getTaxRateViaNote($note)
    {
        $tax_rate = 0;
        $note = (int)$note;
        if ($note === 1 || $note === 2 || $note === 10 || $note === 11) {
            $tax_rate = 0; // zero rated goods
        } elseif ($note === 3 || $note === 12  || $note === 13) {
            $tax_rate = -1; //exempted rated goods
        } elseif ($note === 4 || $note === 14 || $note === 15) {
            $tax_rate = 15; // standard rated goods
        } elseif ($note === 8) {
            $tax_rate = 5; // is mrp
        } else if ($note === 20) {
            $tax_rate = "unregistered";
        } elseif ($note === 7 || $note === 16 || $note === 17) {
            $tax_rate = 'non standard'; //non standard rated goods
        }

        return $tax_rate;
    }
}
