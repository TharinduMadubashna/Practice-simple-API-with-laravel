<?php


namespace App\Http\Controllers;


use App\Models\Post;
use Illuminate\Http\Request;


class ImageController extends Controller
{
    public function imageUpload(Request $req)
    {
        $postObj = new Post;
        if ($req->hasfile('image')) {
            $filename = $req->file('image')->getClientOriginalName();
            $getfilenamewitoutext = pathinfo($filename, PATHINFO_FILENAME);
            $getfileExtension = $req->file('image')->getClientOriginalExtension();
            $createnewFileName = time() . '_' . str_replace('', '_', $getfilenamewitoutext) . '.' . $getfileExtension;
            $img_path = $req->file('image')->storeAs('public/post_img', $createnewFileName);
            $postObj->image = $createnewFileName;
        }
        if ($postObj->save()) {
            return ['status' => true, 'message' => "Image Uplode Successfully"];
        } else {
            return ['status' => false, 'message' => "Error : Image not uploaded successfully"];
        }
    }
}
