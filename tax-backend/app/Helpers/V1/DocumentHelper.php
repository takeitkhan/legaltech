<?php
namespace App\Helpers\V1;

use App\Helpers\Global\UploadImage;
use App\Models\Document;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
class DocumentHelper{

  public static function uploadFile($file){
    $public_path = public_path().'/files/documents';
    $file_name = 'document_'.Str::random(5).'.'.$file->extension();
    $file_name = UploadImage::uploadImage($file,$public_path,$file_name );
    return $file_name;
  }

  public static  function store(Request $request){
    if(!$request->file('file')){
        // return ['error'=>"",'code'=>422];
        throw new Exception('File is Not Valid');
    }

    $file_name = self::uploadFile($request->file('file'));
    $file_extension = $request->file('file')->getClientOriginalExtension();
    $documentData = array(
        'name'             => $file_name,
        'file_extension'   => $file_extension,
        'user_id'          => auth()->id(),
        'entity_id'        => $request->entity_id,
    );
    return Document::create($documentData);
  }
}
