<?php

namespace App\Helpers\V1;


use App\Models\DocumentType;
use App\Models\TreasuryDeposit;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;



class TreasuryDepositHelper
{

    public static function getTreasuryDepositViaId($id)
    {
        return TreasuryDeposit::find($id);
    }
    private static function addDeposit(Request $request, $transaction_id, $entity_id)
    {
        //  treasury deposit helper
        try {
            DB::beginTransaction();
            $challanForm = $request->input('challanForm');
            $challanData = array(
                'entity_id'                 => $entity_id,
                'treasury_challan_number'   => $request->input('invoiceId'),
                'bank'                      => $challanForm['bank'],
                'branch'                 => $challanForm['branch'],
                'district'               => $challanForm['district'],
                'date'                   => $challanForm['date'],
                'deposit_account_code'   => $challanForm['deposit_account_code'],
                'deposit_amount'         => $challanForm['deposit_amount'],
                'deposit_type'           => $challanForm['deposit_type'],
                'transaction_id'         => $transaction_id,
            );
            //store adjustment
            TreasuryDeposit::create($challanData);
            DB::commit();
            return ['error' => false];
        } catch (Exception $e) {
            DB::rollBack();
            return ['message' => $e->getMessage(), 'error' => true];
        }
    }
    private static function updateDeposit(Request $request, $transaction_id, $entity_id, $treasuryDeposit)
    {
        //  treasury deposit helper
        try {
            DB::beginTransaction();
            $challanForm = $request->input('challanForm');
            $challanData = array(
                'entity_id'                 => $entity_id,
                'treasury_challan_number'   => $request->input('invoiceId'),
                'bank'                      => $challanForm['bank'],
                'branch'                 => $challanForm['branch'],
                'district'               => $challanForm['district'],
                'date'                   => $challanForm['date'],
                'deposit_account_code'   => $challanForm['deposit_account_code'],
                'deposit_amount'         => $challanForm['deposit_amount'],
                'deposit_type'           => $challanForm['deposit_type'],
                'transaction_id'         => $transaction_id,
            );
            //store adjustment
            $treasuryDeposit->update($challanData);
            DB::commit();
            return ['error' => false];
        } catch (Exception $e) {
            DB::rollBack();
            return ['message' => $e->getMessage(), 'error' => true];
        }
    }


    public static function storeTreasuryDeposit(Request $request, $entity_id)
    {
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
            $depositStatus = self::addDeposit($request, $transaction->id, $entity_id);

            if (is_array($depositStatus) && isset($depositStatus['error']) && $depositStatus['error']) {
                throw new Exception($depositStatus['message']);
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

    public static function treasuryForUpdate(Request $request, $entity_id, $transaction, $update = false)
    {

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

            //treasury deposit
            if ($update) {
                $challanForm = $request->input('challanForm');
                $treasuryDeposit = self::getTreasuryDepositViaId($challanForm['id']);
                if (!$treasuryDeposit) {
                    throw new Exception('Treasury Deposit not exists with this id');
                }
                $treasuryStatus = self::updateDeposit($request, $transaction->id, $entity_id, $treasuryDeposit);
            } else {
                //for new adjustment
                $treasuryStatus = self::addDeposit($request, $transaction->id, $entity_id);
            }

            if (is_array($treasuryStatus) && isset($treasuryStatus['error']) && $treasuryStatus['error']) {
                throw new Exception($treasuryStatus['message']);
            }

            //after transaction completed now I have to updated status of documents
            // $status = TransactionHelper::updateDocumentsForTransaction($request, $documents, $transaction);

            //if transaction not stored and has error then throw exception
            // if (isset($status['error']) && $status['error']) {
            //     throw new Exception($status['message']);
            // }

            DB::commit();
            return ['text' => "Transaction has been updated successfully", 'transaction_id' => $transaction->id, 'error' => false];
        } catch (Exception $e) {
            DB::rollBack();
            return ['text' => $e->getMessage(), 'error' => true];
        }
    }
}
