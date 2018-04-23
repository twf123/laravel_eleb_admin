<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Handlers\ImageUploadHandler;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Storage;
use OSS\Core\OssException;

class UploaderController extends Controller
{
    //
    public function upload(Request $request){

//        dd($request->file('file'));
        $img = $request->file('file')->store('public/shop_member');


        $client = App::make('aliyun-oss');
        try{
            $client->uploadFile('tanzong-eleb-shop',$img,storage_path('app/'.$img));
        }catch (OssException $e){
            printf($e->getMessage());
   }
        return ['url'=>url(Storage::url($img)),'pic'=>$img];

        }
}
