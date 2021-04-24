<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Photo;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Intervention\Image\Facades\Image;

class PhotoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        $photos = Photo::latest()->paginate(20);
        return view('backend.photo.index', compact('photos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create()
    {
        return view('backend.photo.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return RedirectResponse
     */
    public function store(Request $request)
    {

        $this->validate($request, [
            'title' => 'required|min:3|max:120',
            'description' => 'required|min:3|max:200',
            'image' => 'required|mimes:jpeg,jpg,png'

        ]);

        $image = $request->file('image');
        $filaname = $image->hashName();
        $size = $request->image->getSize();

        $format = $request->image->getClientOriginalExtension();

        $path = 'uploads/' . $filaname;
        $path1 = 'uploads/1280x1024/' . $filaname;
        $path2 = 'uploads/316x255/' . $filaname;
        $path3 = 'uploads/118x95/' . $filaname;

        Image::make($image->getRealPath())->resize(800, 600)->save($path);
        Image::make($image->getRealPath())->resize(1280, 1024)->save($path1);
        Image::make($image->getRealPath())->resize(316, 255)->save($path2);
        Image::make($image->getRealPath())->resize(118, 95)->save($path3);

        $photo = new Photo;
        $photo->title = $request->title;
        $photo->description = $request->description;
        $photo->file = $filaname;
        $photo->format = $format;
        $photo->size = $size;
        $photo->save();
        return redirect()->back()->with('message', 'Wallpaper uploaded successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return Application|Factory|View
     */
    public function edit($id)
    {
        $photo = Photo::find($id);
        return view('backend.photo.edit', compact('photo'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return RedirectResponse|Response
     */
    public function update(Request $request, $id)
    {
//        validation
        $this->validate($request, [
            'title' => 'required | min:3 | max:100',
            'description' => 'required | min:3 | max:100',
        ]);

//          details of the photo from db
        $photo = Photo::find($id);
        $fileName = $photo->file;
        $format = $photo->format;
        $size = $photo->size;

//        if user uploaded and new photo
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $newFilename = $image->hashName();
            $size = $request->image->getSize();

            $format = $request->image->getClientOriginalExtension();

            $path = 'uploads/' . $newFilename;
            $path1 = 'uploads/1280x1024/' . $newFilename;
            $path2 = 'uploads/316x255/' . $newFilename;
            $path3 = 'uploads/118x95/' . $newFilename;
//          upload and resize new updated image
            Image::make($image->getRealPath())->resize(800, 600)->save($path);
            Image::make($image->getRealPath())->resize(1280, 1024)->save($path1);
            Image::make($image->getRealPath())->resize(316, 255)->save($path2);
            Image::make($image->getRealPath())->resize(118, 95)->save($path3);
//          delete the previous image
            unlink(public_path('/uploads/' . $photo->file));
            unlink(public_path('/uploads/1280x1024/' . $photo->file));
            unlink(public_path('/uploads/316x255/' . $photo->file));
            unlink(public_path('/uploads/118x95/' . $photo->file));

            $photo->title = $request->get('title');
            $photo->description = $request->get('description');
            $photo->format = $format;
            $photo->size = $size;
//            save new file name in DB
            $photo->file = $newFilename;
            $photo->save();

            return redirect()->back()->with('message', 'Photo Updated successfully');

        } else {
//            if user has not uploaded new photo just want to change title
            $photo->title = $request->get('title');
            $photo->description = $request->get('description');
            $photo->format = $format;
            $photo->size = $size;
            $photo->file = $fileName;
            $photo->save();

            return redirect()->back()->with('message', 'Photo Updated successfully');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return RedirectResponse
     */
    public function destroy($id)
    {
        $photo = Photo::find($id);
        $photo->delete();
        unlink(public_path('/uploads/' . $photo->file));
        unlink(public_path('/uploads/1280x1024/' . $photo->file));
        unlink(public_path('/uploads/316x255/' . $photo->file));
        unlink(public_path('/uploads/118x95/' . $photo->file));

        return redirect()->back()->with('message', 'Photo Deleted successfully');
    }
}
