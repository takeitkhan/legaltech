<?php

namespace App\Http\Controllers\Api\V1\Entity;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helpers\Global\UploadImage;
use Illuminate\Support\Str;
use App\Helpers\V1\DocumentHelper;
use App\Http\Resources\DocumentResource;
use App\Models\ATRate;
use App\Models\Bank;
use App\Models\Document;
use App\Models\DocumentType;
use App\Models\ProductNature;
use App\Models\SdRate;
use App\Models\TaxRate;
use App\Models\TransactionType;
use Exception;
use Illuminate\Support\Facades\DB;
use Mockery\CountValidator\Exact;

class DocumentController extends Controller
{
    //get entity documents via entity and status
    public function getEntityDocumentsViaStatus($entity,$status){
        if($status === 'all'){
            $documents = Document::with(['uploadUser','entity','document_type','transaction'])
            ->where('entity_id',$entity)->orderBy('id','desc')->get();
        }
        else{
            $documents = Document::with(['uploadUser','entity','document_type','transaction'])->where([
                ['entity_id','=',$entity],
                ['status','=',$status],
            ])->orderBy('id','desc')->get();
        }
        $documents= DocumentResource::collection($documents);
        return response()->json(compact('documents'));
    }

    public function upload(Request $request){
        //store document in table
        try{
            DocumentHelper::store($request);
            return response(['message'=>'Document Uploaded Successfully']);
        }catch(Exception $e){
            return response()->json(['error'=>$e->getMessage()],500);
        }
    }

    public function documentTypes(){
        $documentTypes = DocumentType::all();
        return response()->json(compact('documentTypes'));
    }

    public function getTaxRates(){
        $taxRates  = TaxRate::all();
        return response()->json(compact('taxRates'));
    }
    public function getSdRates(){
        $sdRates  = SdRate::all();
        return response()->json(compact('sdRates'));
    }
    public function getAtRates(){
        $atRates = ATRate::all();
        return response()->json(compact('atRates'));
    }
    public function banksList(){
        $banks = Bank::all();
        return response()->json(compact('banks'));
    }

    public function getTransactionTypes(){
        $transactionTypes = TransactionType::all();
        return response()->json(compact('transactionTypes'));
    }
    public function getProductNature(){
        $productNatures = ProductNature::all();
        return response()->json(compact('productNatures'));
    }


    /// get document for entity via transactionId and status
    public function getEntityDocumentsViaTransactionAndStatus($entity,$transactionId,$status){
        if($status === 'all'){
            $documents = Document::with(['uploadUser','entity','document_type','transaction'])->where([
                ['entity_id','=',$entity],
                ['transaction_id','=',$transactionId],
            ])->orderBy('id','desc')->get();
        }
        else{
            $documents = Document::with(['uploadUser','entity','document_type','transaction'])->where([
                ['entity_id','=',$entity],
                ['transaction_id','=',$transactionId],
                ['status','=',$status],
            ])->orderBy('id','desc')->get();
        }
        $documents= DocumentResource::collection($documents);
        return response()->json(compact('documents'));
    }


    public function trashDocument($entityId,$documentId){
        $document = Document::where([
            ['entity_id','=',$entityId ],
            ['id','=',$documentId ],
            ['status','=','draft'],
            ['transaction_id','=',null],
        ])->first();

        if(!$document){
            return response()->json(['error'=>"Document Not Exists"],404);
        }

        try{
            $document->update(['status'=>'trashed']);
            return response()->json(['success'=>"Document has been trashed Successfully"]);
        }
        catch(Exception $e){
            DB::rollback();
           return response()->json(['error'=>$e->getMessage()],500);
        }
    }
    public function deleteDocument($entityId,$documentId){
        $document = Document::where([
            ['entity_id','=',$entityId ],
            ['id','=',$documentId ],
            ['status','=','trashed'],
            ['transaction_id','=',null],
        ])->first();

        if(!$document){
            return response()->json(['error'=>"Document Doesn't Exists"],404);
        }

        try{
            DB::beginTransaction();
            $documentFile = $document->name;
            $document->delete();
            $public_path = public_path('/files/documents/'.$documentFile);
            if(file_exists($public_path)){
                unlink($public_path);
            }
            else{
                throw new Exception('Document file does not exist');
            }
            DB::commit();
            return response()->json(['success'=>"Document has been Deletedd permanently"]);
        }
        catch(Exception $e){
            DB::rollback();
           return response()->json(['error'=>$e->getMessage()],500);
        }
    }




    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
