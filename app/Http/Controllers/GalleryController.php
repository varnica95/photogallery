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
            'image' => ['image']
       ]);

        $gallery = Gallery::create([
            'user_id' => $request->user()->id,
            'title' => $request->title,
            'description' => $request->description,
        ]);

        if (! empty($request->only('image'))){
            $gallery->image = $request->image;
            $gallery->uploadTo('gallery_avatars');
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
        if (! empty($images = $gallery->images())) {
            foreach ($images as $image) {
                unlink($image->image);
            }
        }

        $gallery->destroy();
    }

    /**
     * @param Request $request
     * @param Gallery $gallery
     */
    public function show(Request $request, Gallery $gallery)
    {
        $user = $request->user();
        $images = $gallery->images();
        $this->view('galleries.show', compact('user', 'gallery', 'images'));
    }
}