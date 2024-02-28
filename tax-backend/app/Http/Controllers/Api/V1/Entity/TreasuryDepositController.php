<?php

namespace App\Http\Controllers\Api\V1\Entity;

use App\Http\Controllers\Controller;
use App\Models\Entity;
use App\Models\EntityAccount;
use App\Models\TreasuryDeposit;
use Exception;
use Illuminate\Http\Request;

class TreasuryDepositController extends Controller
{
    public function getTreasuryDepositsInDateRange($entity_id, $fromDate, $toDate)
    {
        $treasuryDeposits = TreasuryDeposit::with(['entity', 'transaction'])
            ->join('transactions', 'transactions.id', '=', 'treasury_deposits.transaction_id')
            ->where(function ($query) use ($entity_id, $fromDate, $toDate) {
                $conditionArray = [
                    ['treasury_deposits.entity_id', '=', $entity_id],
                    ['transactions.transaction_date', '>=', $fromDate],
                    ['transactions.transaction_date', '<=', $toDate],
                ];
                $query->where($conditionArray);
            })->select('treasury_deposits.*')->get();
        if (!$treasuryDeposits) {
            return response()->json(['error' => 'Treasury Deposits Not Found'], 404);
        }
        return response()->json(compact('treasuryDeposits'));
    }
    public function getTreasuryDepositsInDate($entity_id, $date)
    {
        $treasuryDeposits = TreasuryDeposit::with(['entity', 'transaction'])
            ->join('transactions', 'transactions.id', '=', 'treasury_deposits.transaction_id')
            ->where(function ($query) use ($entity_id, $date) {
                $conditionArray = [
                    ['treasury_deposits.entity_id', '=', $entity_id],
                ];
                $query->whereMonth('transactions.transaction_date', date('m', strtotime($date)))
                    ->whereYear('transactions.transaction_date', date('Y', strtotime($date)))
                    ->where($conditionArray);
            })->select('treasury_deposits.*')->get();
        if (!$treasuryDeposits) {
            return response()->json(['error' => 'Treasury Deposits Not Found'], 404);
        }
        return response()->json(compact('treasuryDeposits'));
    }

    public function getTreasuryDepositsInDateRangeViaDepositType($entity_id, $fromDate, $toDate,$depositType)
    {
        $treasuryDeposits = TreasuryDeposit::with(['entity', 'transaction'])
        ->join('transactions', 'transactions.id', '=', 'treasury_deposits.transaction_id')
        ->where(function ($query) use ($entity_id, $fromDate, $toDate,$depositType) {
            $conditionArray = [
                ['treasury_deposits.entity_id', '=', $entity_id],
                ['transactions.transaction_date', '>=', $fromDate],
                ['transactions.transaction_date', '<=', $toDate],
                ['treasury_deposits.deposit_type', '=', $depositType],
            ];
            $query->where($conditionArray);
        })->select('treasury_deposits.*')->get();
        if (!$treasuryDeposits) {
            return response()->json(['error' => 'Treasury Deposits Not Found'], 404);
        }
        return response()->json(compact('treasuryDeposits'));
    }
    public function getTreasuryDepositsInDateViaDepositType($entity_id, $date,$depositType)
    {
        $treasuryDeposits = TreasuryDeposit::with(['entity', 'transaction'])
            ->join('transactions', 'transactions.id', '=', 'treasury_deposits.transaction_id')
            ->where(function ($query) use ($entity_id, $date,$depositType) {
                $conditionArray = [
                    ['treasury_deposits.entity_id', '=', $entity_id],
                    ['treasury_deposits.deposit_type', '=', $depositType],
                ];
                $query->whereMonth('transactions.transaction_date', date('m', strtotime($date)))
                    ->whereYear('transactions.transaction_date', date('Y', strtotime($date)))
                    ->where($conditionArray);
            })->select('treasury_deposits.*')->get();
        if (!$treasuryDeposits) {
            return response()->json(['error' => 'Treasury Deposits Not Found'], 404);
        }
        return response()->json(compact('treasuryDeposits'));
    }
}
