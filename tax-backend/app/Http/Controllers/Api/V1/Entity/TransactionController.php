<?php

namespace App\Http\Controllers\Api\V1\Entity;

use App\Helpers\V1\AdjustmentHelper;
use App\Helpers\V1\TransactionHelper;
use App\Helpers\V1\TreasuryDepositHelper;
use App\Http\Controllers\Controller;
use App\Http\Resources\TransactionDetailsResource;
use App\Models\Document;
use App\Models\EntityProduct;
use App\Models\Product;
use App\Models\Transaction;
use App\Models\VATAdjustment;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class TransactionController extends Controller
{

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $entity_id)
    {

        $validatorRules = [
            'document_type'             => 'required',
            'transaction_type'          => 'required',
            'transaction_date'          => 'required',
            // 'employee_id'               => 'required',
            'contact_id'                => 'required',
            'contact_name'              => 'required',
            'contactAddress'            => 'required',
            'documents'                 => 'required|array',
            'invoiceId'                 => 'required',
            'isMultiple'                => 'required',
            // 'bank_name_id'         => 'required',
            // 'bank_statement_date'  =>'required',
            'transaction_category'     => 'required',
        ];

        if ($request->input('transaction_type') == 5) {
            $validator = Validator::make($request->all(), $validatorRules);
            if ($validator->fails()) {
                return response()->json(['errors' => $validator->errors()], 422);
            }
            $adjustmentForm = $request->input('adjustmentForm');
            if (!array_key_exists('title', $adjustmentForm) || empty($adjustmentForm['title'])) {
                return $this->error('Adjustment title Field is required', 404);
            }
            if (!array_key_exists('amount', $adjustmentForm) || empty($adjustmentForm['amount'])) {
                return $this->error('Adjustment Amount Field is required', 404);
            }
            if (!array_key_exists('vat_rate', $adjustmentForm) || empty($adjustmentForm['vat_rate'])) {
                return $this->error('Adjustment VAT Rate Field is required', 404);
            }
            if (!array_key_exists('adjustment_date', $adjustmentForm) || empty($adjustmentForm['adjustment_date'])) {
                return $this->error('Adjustment Date Field is required', 404);
            }
            if (!array_key_exists('adjustment_type', $adjustmentForm) || empty($adjustmentForm['adjustment_type'])) {
                return $this->error('Adjustment Type Field is required', 404);
            }

            $adjustmentStatus = AdjustmentHelper::storeAdjustment($request, $entity_id);
            if ($adjustmentStatus['error']) {
                return response()->json(['error' => $adjustmentStatus['text']], 500);
            }
            $transaction_id = $adjustmentStatus['transaction_id'];
            $transaction    = TransactionHelper::getTransactionViaId($entity_id, $transaction_id);
            $transaction    = new TransactionDetailsResource($transaction);
            return response()->json(['success' => $adjustmentStatus['text'], 'transaction' => $transaction]);
        }
        if ($request->input('transaction_type') == 4) {
            // challanForm: {
            //     bank: null,
            //     branch: null,
            //     district: null,
            //     date: null,
            //     deposit_account_code: null,
            //     deposit_amount: 0,
            //     deposit_type: null,
            //   },
            $validator = Validator::make($request->all(), $validatorRules);
            if ($validator->fails()) {
                return response()->json(['errors' => $validator->errors()], 422);
            }
            $challanForm = $request->input('challanForm');
            if (!array_key_exists('bank', $challanForm) || empty($challanForm['bank'])) {
                return $this->error('Bank Field is required', 404);
            }
            if (!array_key_exists('branch', $challanForm) || empty($challanForm['branch'])) {
                return $this->error('Branch Field is required', 404);
            }
            if (!array_key_exists('district', $challanForm) || empty($challanForm['district'])) {
                return $this->error('District Field is required', 404);
            }
            if (!array_key_exists('date', $challanForm) || empty($challanForm['date'])) {
                return $this->error('Date Field is required', 404);
            }
            if (!array_key_exists('deposit_account_code', $challanForm) || empty($challanForm['deposit_account_code'])) {
                return $this->error('Deposit Account Code Field is required', 404);
            }
            if (!array_key_exists('deposit_amount', $challanForm) || empty($challanForm['deposit_amount'])) {
                return $this->error('Deposit Amount Field is required', 404);
            }
            if (!array_key_exists('deposit_type', $challanForm) || empty($challanForm['deposit_type'])) {
                return $this->error('Deposit Type Field is required', 404);
            }

            $treasuryDepositStatus = TreasuryDepositHelper::storeTreasuryDeposit($request, $entity_id);
            if ($treasuryDepositStatus['error']) {
                return response()->json(['error' => $treasuryDepositStatus['text']], 500);
            }
            $transaction_id = $treasuryDepositStatus['transaction_id'];
            $transaction    = TransactionHelper::getTransactionViaId($entity_id, $transaction_id);
            $transaction    = new TransactionDetailsResource($transaction);
            return response()->json(['success' => $treasuryDepositStatus['text'], 'transaction' => $transaction]);
        }

        $validatorRules['office_code'] = 'required_if:transaction_category,international';
        $validatorRules['item_no']     = 'required_if:transaction_category,international';
        $validatorRules['CPC']         = 'required_if:transaction_category,international';
        //if product is multiple then
        if ($request->input('isMultiple')) {
            $validatorRules['productsArray'] = 'required|array';
        } else {
            // $validatorForSingleProduct = [
            //     // 'sdRate'                    => 'required',
            //     // 'ait'                       => 'required',
            //     // 'cd'                        => 'required',
            //     // 'rd'                        => 'required',
            // ];
            $validatorRules['productId']     = 'required';
            $validatorRules['productCode']   = 'required';
            // $validatorRules['productHSCode'] = 'required';
            $validatorRules['productName']   = 'required';
            $validatorRules['qty']          = 'required|numeric';
            $validatorRules['product_unit'] = 'required';
            $validatorRules['unit_price']   = 'required|numeric';
            // $validatorRules['dictionaryProductId'] = 'required_if:prductId,new_product';
            $validatorRules['taxable_value'] = 'required|numeric';
            $validatorRules['atRate']        = 'required_if:transaction_category,international';
            $validatorRules['taxRate']       = 'required|numeric';
        }
        $validator = Validator::make($request->all(), $validatorRules);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        //check if product hs code is valid or not
        // if($request->input('productId') === 'new_product' && !$request->input('isMultiple') ){
        //     $hs_code = Product::where('hs_code',$request->input('productHSCode'))->first();
        //     if(!$hs_code){
        //         return $this->error("Dictionary Product With HS Code not found",404);
        //     }
        // }

        //if product is multitple then product validation will be
        if ($request->input('isMultiple')) {
            foreach ($request->input('productsArray')  as $key => $product) {
                if (!isset($product['productId'])) {
                    return $this->error("product Id not found on {$key} line in product modal", 404);
                }
                // if(!isset($product['productHSCode'])){
                //     return $this->error("Product HS code is required on ${key} line",404);
                // }
                // if($product['productId'] === 'new_product'){
                //     $hs_code = Product::where('hs_code',$product['productHSCode'])->first();
                //     if(!$hs_code){
                //         return $this->error("product with HS code not found on {$key} line in product modal",404);
                //     }
                // }
                // if($product['productId'] === 'new_product' && !isset($product['dictionaryProductId'])){
                //     return $this->error("Dictionary product Id is required on ${key} line for New Product",404);
                // }
                // if($product['productId'] === 'new_product' && !isset($product['cd'])){
                //     return $this->error("For new product CD is required on ${key} line",404);
                // }
                // if($product['productId'] === 'new_product' && !isset($product['rd'])){
                //     return $this->error("For new product RD is required on ${key} line",404);
                // }
                // if($product['productId'] === 'new_product' && !isset($product['ait'])){
                //     return $this->error("For new product AIT is required on ${key} line",404);
                // }
                if (!isset($product['productCode'])) {
                    return $this->error("Product code is required on ${key} line", 404);
                }
                if (!isset($product['product_unit'])) {
                    return $this->error("Product unit is required on ${key} line", 404);
                }
                if (!isset($product['unit_price'])) {
                    return $this->error("Product unit price is required on ${key} line", 404);
                }
                if (!isset($product['taxRate'])) {
                    return $this->error("Product tax rate is required on ${key} line", 404);
                }
                if (!isset($product['taxable_value'])) {
                    return $this->error("Product taxable value is required on ${key} line", 404);
                }
                if ($request->input('transaction_category') === 'international' && !isset($product['atRate'])) {
                    return $this->error("Product at rate is required on ${key} line", 404);
                }
                if (isset($product['productCode']) && $product['productId'] === 'new_product') {
                    $product = EntityProduct::where([
                        ['code', '=', $product['productCode']],
                        ['entity_id', '=', $entity_id],
                    ])->first();
                    if ($product) {
                        return $this->error("Product code already exist for this entity  on ${key} line", 404);
                    }
                }
            }
        }

        //for product
        $response = TransactionHelper::store($request, $entity_id);
        if (is_array($response) && $response['error'] == true) {
            return response()->json(['error' => $response['text']], 500);
        } elseif (is_array($response) && $response['error'] == false) {
            $transaction_id = $response['transaction_id'];
            $transaction    = TransactionHelper::getTransactionViaId($entity_id, $transaction_id);
            $transaction    = new TransactionDetailsResource($transaction);
            return response()->json(['success' => $response['text'], 'transaction' => $transaction], 200);
        }
    }


    public function update(Request $request, $entity_id, $transaction_id)
    {
        $transaction = TransactionHelper::getTransactionViaId($entity_id, $transaction_id);

        if (!$transaction) {
            return response()->json(['error' => 'Transaction Not Found'], 404);
        }

        $validatorRules = array(
            'id'                        => 'required',
            'document_type'             => 'required',
            'transaction_type'          => 'required',
            'transaction_date'          => 'required',
            // 'employee_id'               => 'required',
            'contact_id'                => 'required',
            'contact_name'              => 'required',
            'contactAddress'            => 'required',
            'invoiceId'                 => 'required',
            'isMultiple'                => 'required',
            'transaction_category' => 'required',
        );

        if ($request->input('transaction_type') == 5) {
            $validatorRules['adjustmentForm'] = 'required|array';
            $validator = Validator::make($request->all(), $validatorRules);
            if ($validator->fails()) {
                return response()->json(['errors' => $validator->errors()], 422);
            }
            $adjustmentForm = $request->input('adjustmentForm');
            //check adjustment already exist or not
            if (!array_key_exists('id', $adjustmentForm)) {
                return $this->error('Adjustment id field is required', 404);
            }
            if (!array_key_exists('title', $adjustmentForm) || empty($adjustmentForm['title'])) {
                return $this->error('Adjustment title Field is required', 404);
            }
            if (!array_key_exists('amount', $adjustmentForm) || empty($adjustmentForm['amount'])) {
                return $this->error('Adjustment Amount Field is required', 404);
            }
            if (!array_key_exists('vat_rate', $adjustmentForm) || empty($adjustmentForm['vat_rate'])) {
                return $this->error('Adjustment VAT Rate Field is required', 404);
            }
            if (!array_key_exists('adjustment_date', $adjustmentForm) || empty($adjustmentForm['adjustment_date'])) {
                return $this->error('Adjustment Date Field is required', 404);
            }
            if (!array_key_exists('adjustment_type', $adjustmentForm) || empty($adjustmentForm['adjustment_type'])) {
                return $this->error('Adjustment Type Field is required', 404);
            }

            //check if array key id exists or not
            //get adjustment
            try {
                if (!$transaction->adjustment) {
                    //if adjustment not exist then first delete previous relation of transaction with other like products,treasurydeposit  which is now exists
                    if ($transaction->treasuryDeposit) {
                        $transaction->treasuryDeposit->delete();
                    }
                    //
                    if ($transaction->transactionProducts->count()) {
                        $transaction->transactionProducts->delete();
                    }
                    $adjustmentStatus = AdjustmentHelper::adjustmentForUpdate($request, $entity_id, $transaction);
                } else {
                    //update adjustment
                    $adjustmentStatus = AdjustmentHelper::adjustmentForUpdate($request, $entity_id, $transaction, true);
                }
                //if adjustment status has error then send error response
                if ($adjustmentStatus['error']) {
                    return response()->json(['error' => $adjustmentStatus['text']], 500);
                }
                $transaction_id = $adjustmentStatus['transaction_id'];
                $transaction    = TransactionHelper::getTransactionViaId($entity_id, $transaction_id);
                $transaction    = new TransactionDetailsResource($transaction);
                return response()->json(['success' => $adjustmentStatus['text'], 'transaction' => $transaction]);
            } catch (Exception $e) {
                return response()->json(['error' => $e->getMessage()], 500);
            }
        } elseif ($request->input('transaction_type') == 4) {
            $validatorRules['challanForm'] = 'required|array';
            $validator = Validator::make($request->all(), $validatorRules);
            if ($validator->fails()) {
                return response()->json(['errors' => $validator->errors()], 422);
            }
            $challanForm = $request->input('challanForm');
            if (!array_key_exists('id', $challanForm)) {
                return $this->error('Id Field is required', 404);
            }
            if (!array_key_exists('bank', $challanForm) || empty($challanForm['bank'])) {
                return $this->error('Bank Field is required', 404);
            }
            if (!array_key_exists('branch', $challanForm) || empty($challanForm['branch'])) {
                return $this->error('Branch Field is required', 404);
            }
            if (!array_key_exists('district', $challanForm) || empty($challanForm['district'])) {
                return $this->error('District Field is required', 404);
            }
            if (!array_key_exists('date', $challanForm) || empty($challanForm['date'])) {
                return $this->error('Date Field is required', 404);
            }
            if (!array_key_exists('deposit_account_code', $challanForm) || empty($challanForm['deposit_account_code'])) {
                return $this->error('Deposit Account Code Field is required', 404);
            }
            if (!array_key_exists('deposit_amount', $challanForm) || empty($challanForm['deposit_amount'])) {
                return $this->error('Deposit Amount Field is required', 404);
            }
            if (!array_key_exists('deposit_type', $challanForm) || empty($challanForm['deposit_type'])) {
                return $this->error('Deposit Type Field is required', 404);
            }

            //check if array key id exists or not
            //get adjustmentty
            try {

                if (!$transaction->treasuryDeposit) {
                    //if adjustment not exist then first delete previous relation of transaction with other like products,treasurydeposit  which is now exists
                    if ($transaction->adjustment) {
                        $transaction->adjustment->delete();
                    }
                    //if transactionProducts exist then delete
                    if ($transaction->transactionProducts->count()) {
                        $transaction->transactionProducts->delete();
                    }

                    //add new treasurydeposit
                    $treasuryDepositStatus = TreasuryDepositHelper::treasuryForUpdate($request, $entity_id, $transaction);
                } else {
                    //if treasury deposit exist then update it
                    $treasuryDepositStatus = TreasuryDepositHelper::treasuryForUpdate($request, $entity_id, $transaction, true);
                }
                if ($treasuryDepositStatus['error']) {
                    return response()->json(['error' => $treasuryDepositStatus['text']], 500);
                }
                $transaction_id = $treasuryDepositStatus['transaction_id'];
                $transaction    = TransactionHelper::getTransactionViaId($entity_id, $transaction_id);
                $transaction    = new TransactionDetailsResource($transaction);
                return response()->json(['success' => $treasuryDepositStatus['text'], 'transaction' => $transaction]);
            } catch (Exception $e) {
                return response()->json(['error' => $e->getMessage()], 500);
            }
        }


        $validatorRules['office_code'] = 'required_if:transaction_category,international';
        $validatorRules['item_no']     = 'required_if:transaction_category,international';
        $validatorRules['CPC']         = 'required_if:transaction_category,international';


        if ($request->input('isMultiple')) {
            $validatorRules['productsArray'] = 'required|array';
        } else {
            // $validatorForSingleProduct = [
            //     // 'ait'                       => 'required',
            //     // 'cd'                        => 'required',
            //     // 'rd'                        => 'required',
            // ];
            $validatorRules['productId']     = 'required';
            $validatorRules['productCode']   = 'required';
            // $validatorRules['productHSCode'] = 'required';
            $validatorRules['productName']   = 'required';
            $validatorRules['qty'] = 'required|numeric';
            $validatorRules['product_unit'] = 'required';
            $validatorRules['unit_price']   = 'required|numeric';
            $validatorRules['dictionaryProductId'] = 'required_if:prductId,new_product';
            $validatorRules['taxable_value'] = 'required|numeric';
            $validatorRules['atRate']      = 'required_if:transaction_category,international';
            $validatorRules['taxRate']     = 'required|numeric';
        }

        $validator = Validator::make($request->all(), $validatorRules);



        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        //check if product hs code is valid or not
        // if($request->input('productId') === 'new_product' && !$request->input('isMultiple') ){
        //     $hs_code = Product::where('hs_code',$request->input('productHSCode'))->first();
        //     if(!$hs_code){
        //         return $this->error("Dictionary product with HS code not found",404);
        //     }
        // }

        //if product is multitple then product validation will be
        if ($request->input('isMultiple')) {
            foreach ($request->input('productsArray')  as $key => $product) {
                if (!isset($product['productId'])) {
                    return $this->error("product Id not found on {$key} line in product modal", 404);
                }
                // if(!isset($product['productHSCode'])){
                //     return $this->error("Product HS code is required on ${key} line",404);
                // }
                // if($product['productId'] === 'new_product'){
                //     $hs_code = Product::where('hs_code',$product['productHSCode'])->first();
                //     if(!$hs_code){
                //         return $this->error("product with HS code not found on {$key} line in product modal",404);
                //     }
                // }
                // if($product['productId'] === 'new_product' && !isset($product['dictionaryProductId'])){
                //     return $this->error("Dictionary product Id is required on ${key} line for New Product",404);
                // }
                // if($product['productId'] === 'new_product' && !isset($product['cd'])){
                //     return $this->error("For new product CD is required on ${key} line",404);
                // }
                // if($product['productId'] === 'new_product' && !isset($product['rd'])){
                //     return $this->error("For new product RD is required on ${key} line",404);
                // }
                // if($product['productId'] === 'new_product' && !isset($product['ait'])){
                //     return $this->error("For new product AIT is required on ${key} line",404);
                // }
                if ($product['productId'] === 'new_product' && !isset($product['productName'])) {
                    return $this->error("Product name is required on ${key} line", 404);
                }
                if (!isset($product['productCode'])) {
                    return $this->error("Product code is required on ${key} line", 404);
                }
                if (!isset($product['product_unit'])) {
                    return $this->error("Product unit is required on ${key} line", 404);
                }
                if (!isset($product['unit_price'])) {
                    return $this->error("Product unit price is required on ${key} line", 404);
                }
                if (!isset($product['qty'])) {
                    return $this->error("Product qty is required on ${key} line", 404);
                }
                if (!isset($product['taxRate'])) {
                    return $this->error("Product tax rate is required on ${key} line", 404);
                }
                if (!isset($product['taxable_value'])) {
                    return $this->error("Product taxable value is required on ${key} line", 404);
                }
                if ($request->input('transaction_category') === 'international' && !isset($product['atRate'])) {
                    return $this->error("Product at rate is required on ${key} line", 404);
                }
                if (isset($product['productCode']) && $product['productId'] === 'new_product') {
                    $product = EntityProduct::where([
                        ['code', '=', $product['productCode']],
                        ['entity_id', '=', $entity_id],
                    ])->first();
                    if ($product) {
                        return $this->error("Product code already exist for this entity  on ${key} line", 404);
                    }
                }
            }
        }

        //for product
        $response = TransactionHelper::update($request, $entity_id, $transaction);
        if (is_array($response) && $response['error'] == true) {
            return response()->json(['error' => $response['text']], 500);
        } elseif (is_array($response) && $response['error'] == false) {
            $transaction = Transaction::with(['transactionProducts', 'transactionType', 'entity', 'employee', 'contact'])->find($response['transaction']->id);
            $transaction = new TransactionDetailsResource($transaction);
            return response()->json(['success' => $response['text'], 'transaction' => $transaction], 200);
        }
    }

    public function transactionDetails($entity_id, $transaction_id)
    {
        $transaction  = TransactionHelper::getTransactionViaId($entity_id, $transaction_id);
        if ($transaction == null) {
            return response()->json(['error' => "Transaction Not Found"], 404);
        }
        $transaction = new TransactionDetailsResource($transaction);
        return response()->json(compact('transaction'));
    }

    public function transactions($entity_id)
    {
        $transactions = Transaction::with(['transactionProducts', 'transactionType', 'entity', 'employee', 'contact', 'documents'])->where([
            ['entity_id', '=', $entity_id],
            ['review_status', '=', 'approved']
        ])->get();
        if ($transactions == null) {
            return response()->json(['error' => "Transactions Not Found"], 404);
        }
        $transactions = TransactionDetailsResource::collection($transactions);
        return response()->json(compact('transactions'));
    }

    public function transactionsViaQuery($entity_id, $dateTimeQuery)
    {
        $dateTimeQuery = json_decode($dateTimeQuery, true);
        if ($dateTimeQuery === 'all') {
            $transactions = Transaction::with(['transactionProducts', 'transactionType', 'entity', 'employee', 'contact',])->where([
                ['entity_id', '=', $entity_id],
                ['review_status', '=', 'approved'],
            ])->get();
        } else {
            $transactions = Transaction::with(['transactionProducts', 'transactionType', 'entity', 'employee', 'contact'])
                ->where(function ($query) use ($dateTimeQuery, $entity_id) {

                    if ($dateTimeQuery['sort'] === 'month' || $dateTimeQuery['sort'] === 'lmonth') {
                        $date = date('m', strtotime($dateTimeQuery['format']));
                        info("month is running" . $date);
                        $query->whereMonth('transaction_date', $date);
                    } elseif ($dateTimeQuery['sort'] === 'quarter' || $dateTimeQuery['sort'] === 'lquarter') {
                        $dateArray = explode('to', $dateTimeQuery['format']);
                        $date1     = trim($dateArray[0]);
                        $date2     = trim($dateArray[1]);
                        $date1     = date('Y-m-d', strtotime($date1));
                        $date2     = date('Y-m-d', strtotime($date2));
                        $query->whereBetween('transaction_date', [$date1, $date2]);
                    } elseif ($dateTimeQuery['sort'] === 'year' || $dateTimeQuery['sort'] === 'lyear') {
                        $dateArray = explode('to', $dateTimeQuery['format']);
                        $date     = trim($dateArray[0]);
                        $year = date('Y', strtotime(trim($date)));
                        $query->whereYear('transaction_date', $year);
                    }
                    $query->where([
                        ['entity_id', '=', $entity_id],
                        ['review_status', '=', 'approved'],
                    ]);
                })
                ->get();
        }
        $transactions = TransactionDetailsResource::collection($transactions);
        return response()->json(compact('transactions'));
    }

    public function updateReviewStatusOfTransaction($entity_id, $transaction_id, $status)
    {
        $transaction = Transaction::with('documents')->where([
            ['entity_id', '=', $entity_id],
            ['id', '=', $transaction_id],
            ['review_status', '=', $status]
        ])->first();

        if ($transaction) {
            return $this->error("Transaction review status already {$status} ", 422);
        }

        $transaction = Transaction::with('documents')->where([
            ['entity_id', '=', $entity_id],
            ['id', '=', $transaction_id],
        ])->first();

        if (!$transaction) {
            return $this->error("Transaction Not Found", 500);
        }

        $documents = $transaction->documents;
        $document_status = 'draft';
        $data = array();
        if ($status === 'approved') {
            $data['approved_at'] = now();
            $transaction_status  = $status;
            $document_status     = $status;
        } elseif ($status === 'rejected') {
            $data['rejected_at'] = now();
            $transaction_status = $status;
            $document_status   = 'failed';
        } elseif ($status === 'drafted') {
            $data['drafted_at'] = now();
            $transaction_status = $status;
            $document_status = 'submitted';
            // $document_status ='draft';
        }
        try {
            DB::beginTransaction();
            $data['review_status'] = $transaction_status;
            $transaction->update($data);

            foreach ($documents as $document) {
                $document->update([
                    'status' => $document_status
                ]);
            }
            DB::commit();
            return response()->json(['success' => 'Transaction status updated successfully', 'transaction' => $transaction], 200);
        } catch (Exception $e) {
            DB::rollBack();
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function getTransactionViaDocument($entity_id, $document_id)
    {
        $document = Document::where([
            ['entity_id', '=', $entity_id],
            ['id', '=', $document_id],
            ['transaction_id', '<>', null]
        ])->first();
        if (!$document) {
            return $this->error("Transaction not found", 404);
        }
        $transaction = $document->transaction;
        return response()->json(['transaction' => $transaction], 200);
    }
}
