<?php

namespace App\Helpers\V1;

use App\Helpers\Global\UploadImage;
use App\Models\ATRate;
use App\Models\Contact;
use App\Models\Document;
use App\Models\DocumentType;
use App\Models\EntityProduct;
use App\Models\Product;
use App\Models\ProductTaxRelation;
use App\Models\SdRate;
use App\Models\TaxRate;
use App\Models\Transaction;
use App\Models\TransactionProduct;
use App\Models\TransactionType;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class TransactionHelper
{



    public static function checkTransactionType($transaction_type)
    {
        return TransactionType::where('id', $transaction_type)->first();
    }
    public static  function store(Request $request, $entity_id)
    {

        try {
            //this collection will use for storing
            //products for transaction details
            $entityProductsForTransactionDetails = collect([]);

            $transaction_type = self::checkTransactionType($request->input('transaction_type'));
            if (!$transaction_type) {
                throw new Exception("Transaction type doesn't exist");
            }
            //get document types for transaction
            $document_type = DocumentType::find($request->input('document_type'));
            if ($document_type === null) {
                throw new Exception("Document type doesn't exist please check it");
            }
            DB::beginTransaction();
            //for contact
            $contactResponse = self::contactLogic($request, $entity_id);
            if (is_array($contactResponse) && $contactResponse['error'] === true) {
                throw new Exception($contactResponse['message']);
            } else {
                $contact = $contactResponse['contact'] ?? null;
                if ($contact == null) {
                    throw new Exception("Contact not found or doesn't store");
                }
            }
            // end for contact

            if (!$request->input('isMultiple')) {
                //get tax rate from taxrates table
                $taxRate = TaxRate::find($request->input('taxRate'));
                if ($taxRate == null) {
                    throw new Exception("Vat rate doesn't exist please check it");
                }
            }
            //for single product
            if ($request->productId == 'new_product' && !$request->input('isMultiple')) {

                $productData = array(
                    'code'        => $request->input('productCode'),
                    'hs_code'     => $request->input('productHSCode') ?? null,
                    'title'       => $request->input('productName'),
                    'details'     => $request->input('productName'),
                    'unit'        => $request->input('product_unit'),
                    'cd'          => $request->input('cd') ?? 0,
                    'sd_rate'     => $request->input('sdRate') ?? 0,
                    'vat_rate'    => $taxRate->rate,
                    'ait'         => $request->input('ait') ?? 0,
                    'rd'          => $request->input('rd') ?? 0,
                    'at'          => $request->input('atRate') ?? 0,
                    'product_id'  => $request->input('dictionaryProductId') ?? null,
                    'entity_id'   => $entity_id,
                    'is_tracking' => 1
                );
                $entityProduct = self::storeProductInEntityProduct($productData);
                $entityProductsForTransactionDetails->push($entityProduct);
            } else if (!$request->input('isMultiple') && $request->productId !== 'new_product') {
                //first get product via product id
                $entityProduct = EntityProduct::where([
                    ['id', '=', $request->input('productId')],
                    ['entity_id', '=', $entity_id]
                ])->first();

                if ($entityProduct == null) {
                    throw new Exception("Product Doesn't Exist Please Check it Or Add New One");
                }
                if ($entityProduct->is_tracking == 0) {
                    throw new Exception("Your product is not trackable.please make it trackable from your inventory");
                }
                //am using product into array for storing transaction products
                $entityProductsForTransactionDetails->push($entityProduct);
            }

            //for multiple product
            if ($request->input('isMultiple')) {
                foreach ($request->input('productsArray') as $key => $product) {
                    if ($product['productId'] === 'new_product') {
                        $productData = array(
                            'title'       => $product['productName'],
                            'details'     => $product['productName'],
                            'code'        => $product['productCode'],
                            'hs_code'     => $product['productHSCode'] ?? null,
                            'unit'        => $product['product_unit'],
                            'cd'          => isset($product['cd']) ? $product['cd'] : 0,
                            'rd'          => isset($product['rd']) ? $product['rd'] : 0,
                            'ait'         => isset($product['ait']) ? $product['ait'] : 0,
                            'at'          => isset($product['atRate']) ? $product['atRate'] : 0,
                            'sd_rate'     => isset($product['sdRate']) ? $product['sdRate'] : 0,
                            'vat_rate'    => $product['taxRate'],
                            'product_id'  => $product['dictionaryProductId'] ?? null,
                            'entity_id'   => $entity_id,
                            'is_tracking' => 1
                        );
                        $entityProduct = self::storeProductInEntityProduct($productData);
                        $entityProductsForTransactionDetails->push($entityProduct);
                    } else {
                        $entityProduct = EntityProduct::where([
                            ['id', '=', $product['productId']],
                            ['entity_id', '=', $entity_id]
                        ])->first();

                        if ($entityProduct == null) {
                            throw new Exception("Product doesn't exist on line {$key}");
                        }
                        if ($entityProduct->is_tracking == 0) {
                            throw new Exception("Your product is not trackable.please make it trackable from your inventory");
                        }
                        $entityProductsForTransactionDetails->push($entityProduct);
                    }
                }
            }
            //get all draft document via entity id
            $documents = self::getAllDraftedDocumentViaDocumentIds($request->input('documents'), $entity_id);
            if ($documents->count() === 0) {
                throw new Exception("Draft documents not found with these documents id");
            }

            $transactionStatus = self::storeTransaction($request, $documents, $document_type, $entity_id, $contact);


            // check if has any error when storing transaction then throw error
            if (isset($transactionStatus['error']) && $transactionStatus['error']) {
                throw new Exception($transactionStatus['message']);
            }

            //destructuring transaction from transactionStatus
            ['transaction' => $transaction] = $transactionStatus;

            //update transaction details
            $total_taxable_value = 0;
            $total_tax_value  = 0;
            $total_sd_value   = 0;
            $total_at_value   = 0;
            $total_ait        = 0;
            $total_rd         = 0;
            $total_cd         = 0;
            if (!$request->input('isMultiple')) {
                $entityProduct  = $entityProductsForTransactionDetails->first();
                if ($entityProduct == null) {
                    throw new Exception('Entity Product Not Found');
                }
                //taxable value section
                $taxable_value = (float)$request->input('qty') * (float)$request->input('unit_price');
                $total_taxable_value += $taxable_value;
                //end of taxable value section

                //sdValue section
                $sdValue = 0;
                if ($request->input('sdRate')) {
                    $sdValue = ((float)$request->input('sdRate') * $taxable_value) / 100;
                }
                $total_sd_value += $sdValue;
                //end of sdValue  section

                //$taxRate variable is defined above
                if ($taxRate->rate <= 0) {
                    $taxValue = 0;
                } else {
                    $taxValue = ((float)$taxRate->rate * ($taxable_value + $sdValue)) / 100;
                }
                $total_tax_value += $taxValue;
                // end of tax rate section

                $atRateValue = 0;
                if ($request->input('atRate')) {
                    $atRateValue = ((float)$request->input('atRate') * ($sdValue + $taxable_value)) / 100;
                }
                $total_at_value += $atRateValue;
                // end of at rate value

                //total ait value
                $ait_value = 0;
                if ($request->input('ait')) {
                    $ait_value = ((float)$request->input('ait') * $taxable_value) / 100;
                }
                $total_ait += $ait_value;
                // end of total ait value

                //total ait value
                $rd_value = 0;
                if ($request->input('rd')) {
                    $rd_value = ((float)$request->input('rd') * $taxable_value) / 100;
                }
                $total_rd += $rd_value;
                // end of total ait value

                //total ait value
                $cd_value = 0;
                if ($request->input('cd')) {
                    $cd_value = ((float)$request->input('cd') * $taxable_value) / 100;
                }
                $total_cd += $cd_value;
                // end of total ait value
                $detailsData = array(
                    'transaction_id'     => $transaction->id,
                    'entity_product_id'  => $entityProduct->id,
                    'product_name'       => $request->input('productName'),
                    'unit'               => $request->input('product_unit'),
                    'unit_price'         => $request->input('unit_price'),
                    'qty'                => $request->input('qty'),
                    'sd_rate'            => $request->input('sdRate') ?? 0,
                    'at_rate'            => $request->input('atRate') ?? 0,
                    'tax_rate'           => $taxRate->rate,
                    'ait'                => $request->input('ait') ?? 0,
                    'rd'                 => $request->input('rd') ?? 0,
                    'cd'                 => $request->input('cd') ?? 0,
                    'taxable_value'      => $taxable_value,
                    'sd_rate_value'      => $sdValue,
                    'tax_rate_value'     => $taxValue,
                    'at_rate_value'      => $atRateValue,
                    'tax_rate_id'        => $taxRate->id,
                );
                //create transaction product
                $transactionProduct = TransactionProduct::create($detailsData);
                //if document type invoice (sell) or Bill(purchase) then decrease or increase quantity from entity product
                $response = TransactionHelper::updateEntityQtyAndPriceFromEntityProduct($document_type, $entityProduct, $transactionProduct);
                if ($response['error']) {
                    throw new Exception($response['message']);
                }
            } elseif ($request->input('isMultiple')) {
                foreach ($request->input('productsArray') as $key => $product) {

                    $taxRateProduct = TaxRate::where([
                        ['id', '=', $product['taxRate']],
                    ])->first();
                    if (!$taxRateProduct) {
                        throw new Exception("Tax rate not found on line {$key}");
                    }
                    //individual taxable value
                    $taxable_value = ((float)$product['qty'] * (float)$product['unit_price']);
                    //update total_taxable_value for transaction update
                    $total_taxable_value += $taxable_value;
                    // end of taxable value section
                    $sdValue = 0;
                    if (isset($product['sdRate'])) {
                        $sdValue  = ((float)$product['sdRate'] * $taxable_value) / 100;
                    }
                    $total_sd_value += $sdValue;

                    //tax value
                    if ($taxRateProduct->rate <= 0) {
                        $taxValue   = 0;
                    } else {
                        $taxValue   = ((float)$taxRateProduct->rate * ($taxable_value + $sdValue)) / 100;
                    }
                    $total_tax_value  += $taxValue;
                    //end of tax value

                    //at value
                    $atRateValue   = 0;
                    if (isset($product['atRate']) && $product['atRate'] <= 0) {
                        $atRateValue = ((float)$product['atRate'] * ($taxable_value + $sdValue)) / 100;
                    }
                    $total_at_value += $atRateValue;
                    // end of at value

                    //ait
                    $ait_value = 0;
                    if (isset($product['ait'])) {
                        $ait_value = ((float)$product['ait'] * $taxable_value) / 100;
                    }
                    $total_ait += $ait_value;
                    // end ait

                    //rd
                    $rd_value = 0;
                    if (isset($product['rd'])) {
                        $rd_value = ((float)$product['rd'] * $taxable_value) / 100;
                    }
                    $total_rd += $rd_value;
                    // end rd

                    //cd
                    $cd_value =  0;
                    if (isset($product['cd'])) {
                        $cd_value = ((float)$product['cd'] * $taxable_value) / 100;
                    }
                    $total_cd += $cd_value;
                    // end rd

                    $detailsData = array(
                        'transaction_id'     => $transaction->id,
                        'entity_product_id'  => $entityProductsForTransactionDetails[$key]->id,
                        'product_name'       => $entityProductsForTransactionDetails[$key]->title,
                        'unit'               => $product['product_unit'],
                        'unit_price'         => $product['unit_price'],
                        'qty'                => $product['qty'],
                        'sd_rate'            => $product['sdRate'] ?? 0,
                        'at_rate'            => $product['atRate'] ?? 0,
                        'tax_rate'           => $taxRateProduct->rate,
                        'ait'                => $product['ait'] ?? 0,
                        'rd'                 => $product['rd'] ?? 0,
                        'cd'                 => $product['cd'] ?? 0,
                        'taxable_value'      => $taxable_value,
                        'sd_rate_value'      => $sdValue,
                        'tax_rate_value'     => $taxValue,
                        'at_rate_value'      => $atRateValue,
                        'tax_rate_id'        => $taxRateProduct->id,
                    );
                    $transactionProduct = TransactionProduct::create($detailsData);
                    $response = TransactionHelper::updateEntityQtyAndPriceFromEntityProduct($document_type, $entityProductsForTransactionDetails[$key], $transactionProduct);
                    if ($response['error']) {
                        throw new Exception($response['message']);
                    }
                } //end of foreach loop
            }

            //now update transaction
            $transaction->update([
                'total_taxable_value'  => $total_taxable_value,
                'total_tax_value'      => $total_tax_value,
                'total_sd_value'       => $total_sd_value,
                'total_at_value'       => $total_at_value,
                'total_ait'            => $total_ait,
                'total_rd'             => $total_rd,
                'total_cd'             => $total_cd,
            ]);


            //after transaction completed now I have to updated status of documents
            $status = self::updateDocumentsForTransaction($request, $documents, $transaction);
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

    public static function updateDocumentsForTransaction(Request $request, $documents, $transaction)
    {
        try {
            DB::beginTransaction();
            if ($request->input('approve')) {
                $document_status = 'approved';
            } elseif ($request->input('reject')) {
                $document_status = 'failed';
            } else {
                $document_status = 'review';
            }
            foreach ($documents as $document) {
                $document->update([
                    'transaction_id'   => $transaction->id,
                    'document_type_id' => $request->input('document_type'),
                    'status'           => $document_status,
                ]);
            }
            DB::commit();
            return ['error' => false];
        } catch (Exception $e) {
            DB::rollBack();
            return ['message' => $e->getMessage(), 'error' => true];
        }
    }


    public static function storeTransaction(Request $request, $documents, $document_type, $entity_id, $contact)
    {
        try {
            DB::beginTransaction();
            //store transaction
            $transactionData = array(
                'entity_id'                =>  $entity_id,
                'transaction_type_id'      =>  $request->input('transaction_type'),
                'invoice_no'               =>  $request->input('invoiceId'),
                'transaction_date'         =>  date('Y-m-d', strtotime($request->input('transaction_date'))),
                'transaction_category'     =>  $request->input('transaction_category'),
                'document_type_id'         =>  $document_type->id,
                'document_type'            =>  $document_type->title,
                'user_id'                  =>  auth()->id(),
                'contact_id'               =>  $contact->id,
                'contact_name'             =>  $contact->name,
                'contact_code'             =>  $contact->contact_code,
                'employee_id'              =>  $request->input('employee_id') ?? null,
                'quantity'                 =>  $documents->count(),
                'tax_payable'              => $request->input('tax_payable') ? 1 : 0,
                'transaction_channel'      => $request->input('transaction_channel')  ?? null
            );
            if ($request->input('approve')) {
                $transactionData['review_status']  = 'approved';
                $transactionData['approved_at']    = now();
            } elseif ($request->input('reject')) {
                $transactionData['review_status']  = 'rejected';
                $transactionData['rejected_at']    = now();
            } else {
                $transactionData['review_status']  = 'submitted';
                $transactionData['submitted_at']   = now();
            }


            if ($request->input('transaction_category') === 'international') {
                $transactionData['office_code'] = $request->input('office_code');
                $transactionData['CPC'] = $request->input('CPC');
                $transactionData['item_no'] = $request->input('item_no');
            }
            $transaction = Transaction::create($transactionData);
            // 'drafted_at'  => $request->input(''),
            // 'approved_at'  => $request->input(''),
            // 'rejected_at'  => $request->input(''),
            // 'filed_at'  => $request->input(''),
            DB::commit();
            return ['transaction' => $transaction, 'error' => false];
        } catch (Exception $e) {
            DB::rollBack();
            return ['message' => $e->getMessage(), 'error' => true];
        }
    }

    public static function getAllDraftedDocumentViaDocumentIds($documentIds, $entity_id)
    {
        $documents = Document::where([
            ['entity_id', '=', $entity_id],
            ['status', '=', 'draft'],
        ])->whereIn('id', $documentIds)->get();
        return $documents;
    }
    protected static function storeProductInEntityProduct($productData)
    {
        return EntityProduct::create($productData);
    }

    public static  function update(Request $request, $entity_id, $transaction)
    {

        try {

            //this collection will use for storing
            //products for transaction details
            $entityProductsForTransactionDetails = collect([]);
            $transaction_type = TransactionType::find($request->input('transaction_type'));
            if (!$transaction_type) {
                throw new Exception("Transaction type doesn't exist");
            }
            //get document types for transaction
            $document_type = DocumentType::find($request->input('document_type'));
            if ($document_type === null) {
                throw new Exception("Document Type Doesn't Exist Please Check it");
            }
            DB::beginTransaction();

            //for contact
            $contactData = array(
                'entity_id'    => $entity_id,
                'name'         => $request->input('contact_name'),
                'contact_code' => substr($request->input('contact_name'), 0, 2) . time(),
                'address'      => $request->input('contactAddress'),
            );
            if ($request->has('contact_bin_number')) {
                $contactData['bin'] = $request->input('contact_bin_number');
            }
            if ($request->contact_id == 'new_contact') {
                $contact = self::storeEntityContact($contactData);
            } else {
                $contact = Contact::where([
                    ['entity_id', '=', $entity_id],
                    ['id', '=', $request->contact_id],
                ])->first();
                if ($contact == null) {
                    throw new Exception("Contact doesn't exist please check it or add new one");
                }
                $contact->update($contactData);
            }
            // end of contact



            //get tax rate from tax rates table
            if (!$request->input('isMultiple')) {
                $taxRate = TaxRate::find($request->input('taxRate'));
                if ($taxRate == null) {
                    throw new Exception("Tax rate doesn't exist please check it");
                }
            }

            //first delete previous transaction products or services
            if ($transaction->transactionProducts?->count() > 0) {
                $response = TransactionHelper::resetEntityProductForTransactionProduct($transaction->transactionProducts);
                if ($response['error']) {
                    throw new Exception($response['message']);
                }
                $transaction->transactionProducts()->delete();
            }


            //for single product
            if ($request->productId == 'new_product' && !$request->input('isMultiple')) {
                $productData = array(
                    'code'        => $request->input('productCode'),
                    'hs_code'     => $request->input('productHSCode') ?? null,
                    'title'       => $request->input('productName'),
                    'details'     => $request->input('productName'),
                    'unit'        => $request->input('product_unit'),
                    'cd'          => $request->input('cd') ?? 0,
                    'sd_rate'     => $request->input('sdRate') ?? 0,
                    'vat_rate'    => $taxRate->rate,
                    'ait'         => $request->input('ait') ?? 0,
                    'rd'          => $request->input('rd') ?? 0,
                    'cd'          => $request->input('cd') ?? 0,
                    'at'          => $request->input('atRate') ?? 0,
                    'product_id'  => $request->input('dictionaryProductId') ?? null,
                    'entity_id'   => $entity_id,
                    'is_tracking' => 1
                );
                $entityProduct = self::storeProductInEntityProduct($productData);
                $entityProductsForTransactionDetails->push($entityProduct);
                // end of at are
            } else if (!$request->input('isMultiple') && $request->productId !== 'new_product') {
                //first get product via product id
                $entityProduct = EntityProduct::where([
                    ['id', '=', $request->input('productId')],
                    ['entity_id', '=', $entity_id]
                ])->first();

                if ($entityProduct == null) {
                    throw new Exception("Product doesn't exist please check it Or Add New One");
                }
                $entityProductsForTransactionDetails->push($entityProduct);
            }
            // end of for single product

            //for multiple product
            if ($request->input('isMultiple')) {
                foreach ($request->input('productsArray') as $key => $product) {
                    if ($product['productId'] === 'new_product') {
                        $productData = array(
                            'title'       => $product['productName'],
                            'details'     => $product['productName'],
                            'code'        => $product['productCode'],
                            'hs_code'     => $product['productHSCode'] ?? null,
                            'unit'        => $product['product_unit'],
                            'cd'          => isset($product['cd']) ? $product['cd'] : 0,
                            'rd'          => isset($product['rd']) ? $product['rd'] : 0,
                            'ait'         => isset($product['ait']) ? $product['ait'] : 0,
                            'at'          => isset($product['atRate']) ? $product['atRate'] : 0,
                            'sd_rate'     => isset($product['sdRate']) ? $product['sdRate'] : 0,
                            'vat_rate'    => $product['taxRate'],
                            'product_id'  => $product['dictionaryProductId'] ?? null,
                            'entity_id'   => $entity_id,
                        );
                        $entityProduct = self::storeProductInEntityProduct($productData);
                        $entityProductsForTransactionDetails->push($entityProduct);
                    } else {
                        $entityProduct = EntityProduct::where([
                            ['id', '=', $product['productId']],
                            ['entity_id', '=', $entity_id]
                        ])->first();
                        if ($entityProduct == null) {
                            throw new Exception("Product doesn't exist on line {$key}");
                        }
                        $entityProductsForTransactionDetails->push($entityProduct);
                    }
                }
            }



            //update transaction
            $transactionStatus = self::updateTransaction($request, $entity_id, $contact, $document_type, $transaction);

            // check if has any error when storing transaction then throw error
            if (isset($transactionStatus['error']) && $transactionStatus['error']) {
                throw new Exception($transactionStatus['message']);
            }
            //destructuring transaction from transactionStatus
            ['transaction' => $transaction] = $transactionStatus;

            //update transaction details
            $total_taxable_value = 0;
            $total_tax_value  = 0;
            $total_sd_value   = 0;
            $total_at_value   = 0;
            $total_ait        = 0;
            $total_rd         = 0;
            $total_cd         = 0;
            if (!$request->input('isMultiple')) {
                $entityProduct  = $entityProductsForTransactionDetails->first();
                if ($entityProduct == null) {
                    throw new Exception('Entity Product Not Found');
                }
                //taxable value section
                $taxable_value = (float)$request->input('qty') * (float)$request->input('unit_price');
                $total_taxable_value += $taxable_value;
                //end of taxable value section

                //sdValue section
                $sdValue = 0;
                if ($request->input('sdRate')) {
                    $sdValue = ((float)$request->input('sdRate') * $taxable_value) / 100;
                }
                $total_sd_value += $sdValue;
                //end of sdValue  section

                //$taxRate variable is defined above
                if ($taxRate->rate <= 0) {
                    $taxValue = 0;
                } else {
                    $taxValue = ((float)$taxRate->rate * $taxable_value) / 100;
                }
                $total_tax_value += $taxValue;
                // end of tax rate section

                $atRateValue = 0;
                if ($request->input('atRate')) {
                    $atRateValue = ((float)$request->input('atRate') * $taxable_value) / 100;
                }
                $total_at_value += $atRateValue;
                // end of at rate value

                //total ait value
                $ait_value = 0;
                if ($request->input('ait')) {
                    $ait_value = ((float)$request->input('ait') * $taxable_value) / 100;
                }
                $total_ait += $ait_value;
                // end of total ait value

                //total ait value
                $rd_value = 0;
                if ($request->input('rd')) {
                    $rd_value = ((float)$request->input('rd') * $taxable_value) / 100;
                }
                $total_rd += $rd_value;
                // end of total ait value

                //total ait value
                $cd_value = 0;
                if ($request->input('cd')) {
                    $cd_value = ((float)$request->input('cd') * $taxable_value) / 100;
                }
                $total_cd += $cd_value;
                //if vat expert try to sells something but entity doesn't has any product for selling
                if ($entityProduct->qty == 0  && $transaction_type->id === 2) {
                    // throw new Exception("Entity doesn't has product stock to Sell");
                    return ['text' => "Entity doesn't has product stock to sell", 'error' => true];
                }
                // end of total ait value

                $detailsData = array(
                    'transaction_id'     => $transaction->id,
                    'entity_product_id'  => $entityProduct->id,
                    'product_name'       => $request->input('productName'),
                    'unit'               => $request->input('product_unit'),
                    'unit_price'         => $request->input('unit_price'),
                    'qty'                => $request->input('qty'),
                    'sd_rate'            => $request->input('sdRate') ?? 0,
                    'at_rate'            => $request->input('atRate') ?? 0,
                    'tax_rate'           => $taxRate->rate,
                    'ait'                => $request->input('ait') ?? 0,
                    'rd'                 => $request->input('rd') ?? 0,
                    'cd'                 => $request->input('cd') ?? 0,
                    'taxable_value'      => $taxable_value,
                    'sd_rate_value'      => $sdValue,
                    'tax_rate_value'     => $taxValue,
                    'at_rate_value'      => $atRateValue,
                    'tax_rate_id'        => $taxRate->id,
                );
                $transactionProduct = TransactionProduct::create($detailsData);
                $response = TransactionHelper::updateEntityQtyAndPriceFromEntityProduct($document_type, $entityProduct, $transactionProduct);
                if ($response['error']) {
                    throw new Exception($response['message']);
                }
            } else if ($request->input('isMultiple')) {
                foreach ($request->input('productsArray') as $key => $product) {
                    $taxRateProduct = TaxRate::where([
                        ['id', '=', $product['taxRate']],
                    ])->first();
                    if (!$taxRateProduct) {
                        throw new Exception("Tax rate not found on line {$key}");
                    }
                    //individual taxable value
                    $taxable_value = ((float)$product['qty'] * (float)$product['unit_price']);
                    //update total_taxable_value for transaction update
                    $total_taxable_value += $taxable_value;
                    // end of taxable value section


                    $sdValue = 0;
                    if (isset($product['sdRate'])) {
                        $sdValue  = ((float)$product['sdRate'] * $taxable_value) / 100;
                    }
                    $total_sd_value += $sdValue;

                    //tax value
                    if ($taxRateProduct->rate <= 0) {
                        $taxValue   = 0;
                    } else {
                        $taxValue   = ((float)$taxRateProduct->rate * $taxable_value) / 100;
                    }
                    $total_tax_value += $taxValue;
                    //end of tax value

                    //at value
                    $atRateValue   = 0;
                    if (isset($product['atRate']) && $product['atRate'] <= 0) {
                        $atRateValue = ((float)$product['atRate'] * $taxable_value) / 100;
                    }
                    $total_at_value += $atRateValue;
                    // end of at value

                    //ait
                    $ait_value = 0;
                    if (isset($product['ait'])) {
                        $ait_value = ((float)$product['ait'] * $taxable_value) / 100;
                    }
                    $total_ait += $ait_value;
                    // end ait

                    //rd
                    $rd_value = 0;
                    if (isset($product['rd'])) {
                        $rd_value = ((float)$product['rd'] * $taxable_value) / 100;
                    }
                    $total_rd += $rd_value;
                    // end rd

                    //cd
                    $cd_value = 0;
                    if (isset($product['cd'])) {
                        $cd_value = ((float)$product['cd'] * $taxable_value) / 100;
                    }
                    $total_cd += $cd_value;
                    // end rd

                    $detailsData = array(
                        'transaction_id'     => $transaction->id,
                        'entity_product_id'  => $entityProductsForTransactionDetails[$key]->id,
                        'product_name'       => $entityProductsForTransactionDetails[$key]->title,
                        'unit'               => $product['product_unit'],
                        'unit_price'         => $product['unit_price'],
                        'qty'                => $product['qty'],
                        'sd_rate'            => $product['sdRate'] ?? 0,
                        'at_rate'            => $product['atRate'] ?? 0,
                        'tax_rate'           => $taxRateProduct->rate,
                        'ait'                => $product['ait'] ?? 0,
                        'rd'                 => $product['rd'] ?? 0,
                        'cd'                 => $product['cd'] ?? 0,
                        'taxable_value'      => $taxable_value,
                        'sd_rate_value'      => $sdValue,
                        'tax_rate_value'     => $taxValue,
                        'at_rate_value'      => $atRateValue,
                        'tax_rate_id'        => $taxRateProduct->id,
                    );
                    $transactionProduct = TransactionProduct::create($detailsData);
                    $response = TransactionHelper::updateEntityQtyAndPriceFromEntityProduct($document_type, $entityProductsForTransactionDetails[$key], $transactionProduct);
                    if ($response['error']) {
                        throw new Exception($response['message']);
                    }
                }
            }
            //now update transaction
            $transaction->update([
                'total_taxable_value'  => $total_taxable_value,
                'total_tax_value'      => $total_tax_value,
                'total_sd_value'       => $total_sd_value,
                'total_at_value'       => $total_at_value,
                'total_ait'            => $total_ait,
                'total_rd'             => $total_rd,
                'total_cd'             => $total_cd,
            ]);
            DB::commit();
            return ['text' => "Transaction has been Updated Successfully", 'error' => false, 'transaction' => $transaction];
        } catch (Exception $e) {
            DB::rollBack();
            return ['text' => $e->getMessage(), 'error' => true];
        }
    }



    public static function updateTransaction(Request $request, $entity_id, $contact, $document_type, $transaction)
    {

        try {
            DB::beginTransaction();
            //store transaction
            $transactionData = array(
                'entity_id'                => $entity_id,
                'transaction_type_id'      => $request->input('transaction_type'),
                'invoice_no'               => $request->input('invoiceId'),
                'transaction_date'         => date('Y-m-d', strtotime($request->input('transaction_date'))),
                'transaction_category'     => $request->input('transaction_category'),
                'document_type_id'         => $document_type->id,
                'document_type'            => $document_type->title,
                'user_id'                  => auth()->id(),
                'contact_id'               => $contact->id,
                'contact_name'             => $contact->name,
                'contact_code'             => $contact->contact_code,
                'employee_id'              => $request->input('employee_id') ?? null,
                'tax_payable'              => $request->input('tax_payable') ? 1 : 0,
                'transaction_channel'      => $request->input('transaction_channel') ? $request->input('transaction_channel') : null
            );
            if ($request->input('transaction_category') === 'international') {
                $transactionData['office_code'] = $request->input('office_code');
                $transactionData['CPC']         = $request->input('CPC');
                $transactionData['item_no']     = $request->input('item_no');
            } else {
                $transactionData['office_code'] = null;
                $transactionData['CPC']         = null;
                $transactionData['item_no']     = null;
            }
            // 'approved_at' // 'rejected_at' // 'filed_at'
            $transaction->update($transactionData);
            DB::commit();
            return ['transaction' => $transaction, 'error' => false];
        } catch (Exception $e) {
            DB::rollBack();
            return ['message' => $e->getMessage(), 'error' => true];
        }
    }


    public static function contactLogic(Request $request, $entity_id)
    {

        try {
            $contactData = array(
                'entity_id'    => $entity_id,
                'name'         => $request->input('contact_name'),
                'contact_code' => substr($request->input('contact_name'), 0, 2) . time(),
                'address'      => $request->input('contactAddress'),
            );

            if ($request->has('contact_bin_number')) {
                $contactData['bin'] = $request->input('contact_bin_number');
            }

            if ($request->contact_id == 'new_contact') {
                $contact = self::storeEntityContact($contactData);
            } else {
                $contact = Contact::where([
                    ['entity_id', '=', $entity_id],
                    ['id', '=', $request->input('contact_id')],
                ])->first();
                if ($contact == null) {
                    throw new Exception("Contact doesn't exist please check it or add new one");
                }
                $contact->update($contactData);
            }
            return ['contact' => $contact, 'error' => false];
        } catch (\Exception $e) {
            return ['message' => $e->getMessage(), 'error' => true];
        }
    }



    protected static function storeEntityContact($contactData)
    {
        return Contact::create($contactData);
    }

    public static function getTransactionViaId($entity_id, $transaction_id)
    {
        $transaction = Transaction::with(['transactionProducts', 'transactionType', 'entity', 'employee', 'contact', 'documents', 'treasuryDeposit', 'adjustment'])->where([
            ['entity_id', '=', $entity_id],
            ['id', '=', $transaction_id],
        ])->first();
        return $transaction;
    }

    private static function updateEntityQtyAndPriceFromEntityProduct($document_type, $entityProduct, $transactionProduct)
    {
        try {
            DB::beginTransaction();
            //if product or service is sells
            $unitPrice        = $entityProduct->unit_price;
            $remaining_qty    = $entityProduct->qty;
            $prev_total_value = $unitPrice * $remaining_qty;
            //invoice means sells
            if ($document_type->title == 'Invoice') {
                $remaining_qty -= $transactionProduct->qty;
                if ($remaining_qty < 0) {
                    throw new Exception('Entity Product ' . $entityProduct->title . ' has no enough Quantity');
                } elseif ($remaining_qty == 0) {
                    $unitPrice = $entityProduct->unit_price;
                    $remaining_qty = 0;
                } else {
                    $unitPrice       = ($prev_total_value - ($entityProduct->unit_price * $transactionProduct->qty))  / $remaining_qty;
                }
            }
            //bill means purchase
            elseif ($document_type->title == 'Bill') {
                $remaining_qty += $transactionProduct->qty;
                $unitPrice       = ($prev_total_value + ($transactionProduct->unit_price * $transactionProduct->qty))  / $remaining_qty;
            }

            $entityProduct->update([
                'unit_price' => $unitPrice,
                'qty'        => $remaining_qty
            ]);
            DB::commit();
            return ['error' => false, 'message' => 'success'];
        } catch (Exception $e) {
            DB::rollBack();
            return ['error' => true, 'message' => $e->getMessage()];
        }
    }

    public static function resetEntityProductForTransactionProduct($transactionProducts)
    {
        try {
            DB::beginTransaction();
            foreach ($transactionProducts as $transProduct) {
                //first entityProduct
                $entityProduct = EntityProduct::find($transProduct->entity_product_id);
                if (!$entityProduct) {
                    throw new Exception('Entity product  not found in transaction products list');
                }
                $transactionQty   = $transProduct->qty; //
                $transactionPrice = $transProduct->unit_price;
                $remainingQty     = $entityProduct->qty - $transactionQty;
                $remainingPrice    = 0;
                if ($remainingQty != 0) {
                    $remainingPrice   = (($entityProduct->unit_price * $entityProduct->qty) - ($transactionPrice * $transactionQty)) / $remainingQty;
                }
                $entityProduct->update([
                    'unit_price' => $remainingPrice,
                    'qty'        => $remainingQty
                ]);
            }
            DB::commit();
            return ['error' => false];
        } catch (Exception $e) {
            DB::rollBack();
            return ['error' => true, 'message' => $e->getMessage()];
        }
    }
}
