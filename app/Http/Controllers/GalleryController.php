<?php


namespace App\Http\Controllers;


use App\Core\Controller;
use App\Core\Http\Request;
use App\Models\Gallery;

class GalleryController extends Controller
{
    /**
     * @param Request $request
     */
    public function create(Request $request)
    {
        $this->view('gallery.create', [
            'user' => $request->user()
        ]);
    }

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

        $gallery->image = $gallery->defaultImage();
        $gallery->save();
    }
}