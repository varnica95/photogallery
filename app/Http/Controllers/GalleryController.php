<?php


namespace App\Http\Controllers;


use App\Core\Controller;
use App\Core\Http\Request;
use App\Core\Includes\File;
use App\Core\View;
use App\Models\Gallery;

class GalleryController extends Controller
{
    /**
     * @param Request $request
     */
    public function create(Request $request)
    {
        $this->view('galleries.create', [
            'user' => $request->user()
        ]);
    }

    /**
     * @param Request $request
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => ['required', 'min:5'],
            'description' => ['required', 'optional', 'max:200'],
            'image.*.type' => ['image']
       ]);

        $gallery = Gallery::create([
            'user_id' => $request->user()->id,
            'title' => $request->title,
            'description' => $request->description,
        ]);

        if (! is_null($request->image)){
            $gallery->image = $request->image;
            $gallery->uploadGalleryImage();
        }else{
            $gallery->image = $gallery->defaultImage();
            $gallery->save();
        }

        $this->view('galleries.create', [
            'user' => $request->user(),
            'success' => 'Gallery successfully created.'
        ]);
    }

    /**
     * @param Request $request
     * @param Gallery $gallery
     */
    public function destroy(Request $request, Gallery $gallery)
    {
        $gallery->destroy();
    }

    /**
     * @param Request $request
     * @param Gallery $gallery
     */
    public function show(Request $request, Gallery $gallery)
    {
        dump($gallery->user());
    }
}