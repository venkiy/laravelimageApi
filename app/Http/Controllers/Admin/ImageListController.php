<?php

namespace App\Http\Controllers\Admin;

use App\ImageList;
use Spatie\Permission\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreImagesRequest;
use Illuminate\Support\Facades\Storage;

class ImageListController extends Controller
{
    /**
     * Display a listing of User.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Gate::allows('image_manage')) {
            return abort(401);
        }

        $images = ImageList::all();

        return view('admin.images.index', compact('images'));
    }

    /**
     * Show the form for creating new User.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('image_manage')) {
            return abort(401);
        }        

        return view('admin.images.create');
    }

    /**
     * Store a newly created User in storage.
     *
     * @param  \App\Http\Requests\StoreUsersRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreImagesRequest $request)
    {
        if (! Gate::allows('users_manage')) {
            return abort(401);
        }
        $uploadFolder = 'users';
		$image = $request->file('image');
		$image_uploaded_path = $image->store($uploadFolder, 'public');
		$uploadedImageResponse = array(
		    "image_name" => basename($image_uploaded_path),
		    "image_url" => Storage::disk('public')->url($image_uploaded_path),
		    "mime" => $image->getClientMimeType()
		);
        $imagedetails = [
        	'image' => basename($image_uploaded_path),
        	'caption' => $request->input('caption'),
        	'description' => $request->input('description'),   
            'created_by' => \Auth::user()->id,     	
        ];
        $images = ImageList::create($imagedetails);        

        return redirect()->route('admin.images.index');
    }


    /**
     * Show the form for editing User.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(ImageList $image)
    {
        if (! Gate::allows('image_manage')) {
            return abort(401);
        }
        
        return view('admin.images.edit', compact('image'));
    }

    /**
     * Update User in storage.
     *
     * @param  \App\Http\Requests\UpdateUsersRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreImagesRequest $request, ImageList $currentimage)
    {
        if (! Gate::allows('image_manage')) {
            return abort(401);
        }
        $uploadFolder = 'users';
        $image = $request->file('image');
        $image_uploaded_path = $image->store($uploadFolder, 'public');        
       
        $currentimage = ImageList::find($request->input('imageId'));
        $currentimage->image = basename($image_uploaded_path);
        $currentimage->caption = $request->input('caption');
        $currentimage->description = $request->input('description');
        $currentimage->created_by = \Auth::user()->id;
        $currentimage->save();
         
        return redirect()->route('admin.images.index');
    }

    public function show(ImageList $image)
    {
        if (! Gate::allows('image_manage')) {
            return abort(401);
        }        

        return view('admin.images.show', compact('image'));
    }

    /**
     * Remove User from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(ImageList $image)
    {
        if (! Gate::allows('image_manage')) {
            return abort(401);
        }

        $image->delete();

        return redirect()->route('admin.images.index');
    }

    /**
     * Delete all selected User at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('image_manage')) {
            return abort(401);
        }
        ImageList::whereIn('id', request('ids'))->delete();

        return response()->noContent();
    }

public function displayImage($filename)

{
    $path = asset("storage/app/public/users/$filename");//storage_public('users/' . $filename);  

    if (!File::exists($path)) {
        abort(404);
    } 

    //$file = File::get($path);
    //$type = File::mimeType($path);
    //$response = Response::make($file, 200);
    //$response->header("Content-Type", $type);
    return $path;

}
}
