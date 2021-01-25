<?php


namespace App\Http\Controllers;


use App\Core\Controller;
use App\Core\Http\Request;

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

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required',
            'images.*.type' => 'image',
            'gallery_id' => 'required'
        ]);
    }
}