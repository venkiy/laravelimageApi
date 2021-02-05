<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\ImageList;
use App\Http\Requests\Admin\StoreImagesRequest;

class ImagesListController extends Controller
{
    public function index()
    {       
        $images = ImageList::all();

        return response()->json(['message' => 'Images list.','data' => $images, 'imageURL'=> asset("storage/app/public/users/")], 200);
    } 

    /**
     * Store a newly created User in storage.
     *
     * @param  \App\Http\Requests\StoreUsersRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreImagesRequest $request)
    {        
        $uploadFolder = 'users';
		$image = $request->file('image');
		$image_uploaded_path = $image->store($uploadFolder, 'public');
		
        $imagedetails = [
        	'image' => basename($image_uploaded_path),
        	'caption' => $request->input('caption'),
        	'description' => $request->input('description'),   
            'created_by' => 1,     	
        ];
        $images = ImageList::create($imagedetails);        

        return response()->json(['message' => 'Image Uploaded Successfully.'], 200);
    }
}
