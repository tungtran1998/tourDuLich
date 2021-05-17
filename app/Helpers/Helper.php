<?php

namespace App\Helpers;

use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\File;

class Helper{

    /**
     * uploadFile method
     * @param $imageFile
     * @return string
     */
    public function uploadFile(UploadedFile $imageFile = null)
    {
        $imageName = "default.png";
        if ($imageFile) {
            // get file original extention
            $imageExt = $imageFile->getClientOriginalExtension();
            // new file name
            $imageName = date('Y-M-D') . '_' . round(microtime(true) * 1000) . '.' . $imageExt;
            // move file
            $imageFile->move('administration/imageRooms/', $imageName);
        }
        return $imageName;
    }

    public function uploadFileImage($url, UploadedFile $imageFile = null)
    {
        $imageName = "default.png";
        if ($imageFile) {
            // get file original extention
            $imageExt = $imageFile->getClientOriginalExtension();
            // new file name
            $imageName = date('Y-M-D') . '_' . round(microtime(true) * 1000) . '.' . $imageExt;
            // move file
            $imageFile->move($url, $imageName);
        }
        return $imageName;
    }



    public function deleteFile($fileName = null)
    {
        $image_path = "administration/imageRooms/" . $fileName;  // Value is not URL but directory file path
        if(File::exists($image_path)) {
            File::delete($image_path);
        }
    }

    public function notification($alertype = null)
    {
        $notification = array(
            'message' => trans('message.success-create'),
            'alert-type' => $alertype,
        );
    }

    /**
     * get arr input method
     * @param $request
     * @return arr
     */
    // public static function getArrInput(Request $request)
    // {
    //     $imageFile = $request->file('avatar');
    //     // uploadFile
    //     $helper = new Helper;
    //     $avatarName = $helper->uploadFile($imageFile);
    //     // get arr input
    //     $arrInput = $request->all();
    //     if($arrInput['password']!=null){
    //     $arrInput['password'] = bcrypt($arrInput['password']);
    //     }
    //     $arrInput['avatar'] = $avatarName;

    //     return $arrInput;
    // }

    // public static function update($id,Request $request)
    // {
    //     $user = User::find($id);
    //     // call funtion get arr input from app\heplers\helper
    //     $helper = new Helper;
    //     $input = $helper->getArrInput($request);

    //     // nếu mật khẩu null thì không đổi mật khẩu;
    //     if($input['password']==null){
    //         $input['password'] = $user['password'];
    //     }
    //     // nếu avatar là ảnh mặt định thì không đổi avatars;
    //     if($input['avatar']== 'default.png'){
    //         $input['avatar'] = $user['avatar'];
    //     }

    //     $user->update($input);
    // }
    // update for Blog controller
    // public static function updateBlog($id,Request $request)
    // {
    //     $post = User::find($id);
        
    //     $imageFile = $request->file('image');

    //     dd($imageFile);

    //     // $post->update($input);
    // }
}
