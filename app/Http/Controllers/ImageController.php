<?php


namespace App\Http\Controllers;


use App\Core\Controller;
use App\Core\Http\Request;
use App\Models\Gallery;
use App\Models\Image;

class ImageController extends Controller
{
    /**
     * @param Request $request
     */
    public function upload(Request $request)
    {
        $this->view('images.upload', [
            'user' => $request->user(),
            'galleries' => $request->user()->galleries()
        ]);
    }

    /**
     * @param Request $request
     */
    public function store(Request $request)
    {
        $noun = array_keys($request->all())[2];

        $request->validate([
            'title' => 'required',
            'gallery_id' => 'required',
            empty($noun) ? $noun : $noun . '.*.type' => 'required|image',
        ]);

        $gallery = Gallery::find($request->gallery_id);

        $images = [];
        //check if the $noun is assoc or not
        if (array_keys($request->$noun) !== range(0, count($request->$noun) - 1)) {
            $images = Image::create([
                'title' => $request->title,
                'gallery_id' => $request->gallery_id,
            ]);

            $images->image = $request->$noun;
            $images->uploadTo('gallery_images');
        }else{
            foreach ($request->$noun as $key => $value) {
                $images[$key] = Image::create([
                    'title' => $request->title,
                    'gallery_id' => $request->gallery_id,
                ]);

                $images[$key]->image = $request->$noun[$key];
                $images[$key]->uploadTo('gallery_images');
            }
        }

        $this->view('images.upload', [
            'user' => $request->user(),
            'galleries' => $request->user()->galleries(),
            'success' => 'Gallery successfully created.'
        ]);
    }

    public function destroy(Request $request, Image $image)
    {
        $image->destroy();
    }
}