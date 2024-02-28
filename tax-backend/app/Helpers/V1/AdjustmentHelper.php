<?php

namespace App\Helpers\V1;

use App\Models\Document;
use App\Models\DocumentType;
use App\Models\TaxRate;
use App\Models\VATAdjustment;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;

class AdjustmentHelper
{

    private static function addAdjustment(Request $request, $transaction_id, $entity_id)
    {
        // adjustmentForm: {
        //     title: null,
        //     amount: 0,
        //     vat_rate: null,
        //     adjustment_date: null,
        //     adjustment_type: null,
        //   },
        try {
            DB::beginTransaction();
            $adjustmentForm = $request->input('adjustmentForm');
            $adjustmentdata = array(
                'entity_id'        => $entity_id,
                'title'            => $adjustmentForm['title'],
                'amount'           => $adjustmentForm['amount'],
                'adjustment_date'  => $adjustmentForm['adjustment_date'],
                'adjustment_type'  => $adjustmentForm['adjustment_type'],
                'vat_rate'         => $adjustmentForm['vat_rate'],
                'transaction_id'   => $transaction_id,
            );
            //store adjustment
            $adjustment = VATAdjustment::create($adjustmentdata);
            DB::commit();
            return ['error' => false];
        } catch (Exception $e) {
            DB::rollBack();
            return ['message' => $e->getMessage(), 'error' => true];
        }
    }
    private static function updateAdjustment(Request $request, $transaction_id, $entity_id, $adjustment)
    {
        // adjustmentForm: {
        //     title: null,
        //     amount: 0,
        //     vat_rate: null,
        //     adjustment_date: null,
        //     adjustment_type: null,
        //   },
        try {
            DB::beginTransaction();
            $adjustmentForm = $request->input('adjustmentForm');
            $adjustmentData = array(
                'entity_id'        => $entity_id,
                'title'            => $adjustmentForm['title'],
                'amount'           => $adjustmentForm['amount'],
                'adjustment_date'  => $adjustmentForm['adjustment_date'],
                'adjustment_type'  => $adjustmentForm['adjustment_type'],
                'vat_rate'         => $adjustmentForm['vat_rate'],
                'transaction_id'   => $transaction_id,
            );
            //store adjustment
            $adjustment->update($adjustmentData);
            DB::commit();
            return ['error' => false];
        } catch (Exception $e) {
            DB::rollBack();
            return ['message' => $e->getMessage(), 'error' => true];
        }
    }

    public static function storeAdjustment(Request $request, $entity_id)
    {
        // adjustmentForm: {
        //     title: null,
        //     amount: 0,
        //     vat_rate: null,
        //     adjustment_date: null,
        //     adjustment_type: null,
        //   },
        $transaction_type = TransactionHelper::checkTransactionType($request->input('transaction_type'));
        if (!$transaction_type) {
            throw new Exception("Transaction type doesn't exist");
        }
        //get document types for transaction
        $document_type = DocumentType::find($request->input('document_type'));
        if ($document_type === null) {
            throw new Exception("Document type doesn't exist please check it");
        }
        try {
            DB::beginTransaction();
            //for contact
            $contactResponse = TransactionHelper::contactLogic($request, $entity_id);
            if (is_array($contactResponse) && $contactResponse['error'] === true) {
                throw new Exception($contactResponse['message']);
            } else {
                $contact = $contactResponse['contact'] ?? null;
                if ($contact == null) {
                    throw new Exception("Contact not found or doesn't store");
                }
            }
            // end for contact

            //get tax rate from taxrates table
            $adjustmentForm = $request->input('adjustmentForm');
            if ($adjustmentForm) {
                $vatRate = TaxRate::find($adjustmentForm['vat_rate']);
                if ($vatRate == null) {
                    throw new Exception("Vat rate doesn't exist please check it!");
                }
            }

            //get all draft document via entity id
            $documents = TransactionHelper::getAllDraftedDocumentViaDocumentIds($request->input('documents'), $entity_id);
            if ($documents->count() === 0) {
                throw new Exception("Draft documents not found with these documents id");
            }

            $transactionStatus  = TransactionHelper::storeTransaction($request, $documents, $document_type, $entity_id, $contact);

            // check if has any error when storing transaction then throw error
            if (isset($transactionStatus['error']) && $transactionStatus['error']) {
                throw new Exception($transactionStatus['message']);
            }
            //destructuring transaction from transactionStatus
            ['transaction' => $transaction] = $transactionStatus;

            //addadjustment
            $adjustmentStatus = self::addAdjustment($request, $transaction->id, $entity_id);

            if (is_array($adjustmentStatus) && isset($adjustmentStatus['error']) && $adjustmentStatus['error']) {
                throw new Exception($adjustmentStatus['message']);
            }

            //after transaction completed now I have to updated status of documents
            $status = TransactionHelper::updateDocumentsForTransaction($request, $documents, $transaction);

            //if transaction not stored and has error then throw exception
            if (isset($status['error']) && $status['error']) {
                throw new Exception($status['message']);
            }

            DB::commit();
            return ['text' => "Transaction has been Completed Successfully", 'transaction_id' => $transaction->id, 'error' => false];
        } catch (Exception $e) {
            DB::rollBack();
            return ['text' => $e->getMessage(), 'error' => true];
        }
    }

    public static function adjustmentForUpdate(Request $request, $entity_id, $transaction, $update = false)
    {
        // adjustmentForm: {
        //     title: null,
        //     amount: 0,
        //     vat_rate: null,
        //     adjustment_date: null,
        //     adjustment_type: null,
        //   },
        $transaction_type = TransactionHelper::checkTransactionType($request->input('transaction_type'));
        if (!$transaction_type) {
            throw new Exception("Transaction type doesn't exist");
        }
        //get document types for transaction
        $document_type = DocumentType::find($request->input('document_type'));
        if ($document_type === null) {
            throw new Exception("Document type doesn't exist please check it");
        }
        try {
            DB::beginTransaction();
            //for contact
            $contactResponse = TransactionHelper::contactLogic($request, $entity_id);
            if (is_array($contactResponse) && $contactResponse['error'] === true) {
                throw new Exception($contactResponse['message']);
            } else {
                $contact = $contactResponse['contact'] ?? null;
                if ($contact == null) {
                    throw new Exception("Contact not found or doesn't store");
                }
            }
            // end for contact

            //get vat rate from vat rates table
            $adjustmentForm = $request->input('adjustmentForm');
            $vatRate = TaxRate::find($adjustmentForm['vat_rate']);
            if ($vatRate == null) {
                throw new Exception("Vat rate doesn't exist please check it!");
            }

            //get all draft document via entity id
            // $documents = TransactionHelper::getAllDraftedDocumentViaDocumentIds($request->input('documents'),$entity_id);
            // if($documents->count() === 0){
            //     throw new Exception("Draft documents not found with these documents id");
            // }

            $transactionStatus  = TransactionHelper::updateTransaction($request, $entity_id, $contact, $document_type, $transaction);

            // check if has any error when storing transaction then throw error
            if (isset($transactionStatus['error']) && $transactionStatus['error']) {
                throw new Exception($transactionStatus['message']);
            }
            //destructuring transaction from transactionStatus
            ['transaction' => $transaction] = $transactionStatus;

            //addadjustment
            if ($update) {
                $adjustment = self::getAdjustmentViaId($adjustmentForm['id']);
                if (!$adjustment) {
                    throw new Exception('Adjustment not exists with this id');
                }
                $adjustmentStatus = self::updateAdjustment($request, $transaction->id, $entity_id, $adjustment);
            } else {
                //for new adjustment
                $adjustmentStatus = self::addAdjustment($request, $transaction->id, $entity_id);
            }

            if (is_array($adjustmentStatus) && isset($adjustmentStatus['error']) && $adjustmentStatus['error']) {
                throw new Exception($adjustmentStatus['message']);
            }

            //after transaction completed now I have to updated status of documents
            // $status = TransactionHelper::updateDocumentsForTransaction($request, $documents, $transaction);

            //if transaction not stored and has error then throw exception
            // if (isset($status['error']) && $status['error']) {
            //     throw new Exception($status['message']);
            // }

            DB::commit();
            return ['text' => "Transaction has been updated Successfully", 'transaction_id' => $transaction->id, 'error' => false];
        } catch (Exception $e) {
            DB::rollBack();
            return ['text' => $e->getMessage(), 'error' => true];
        }
    }

    public static function getAdjustmentViaId($adjustment_id)
    {
        return VATAdjustment::find($adjustment_id);
    }
}
