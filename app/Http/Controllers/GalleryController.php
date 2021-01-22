<?php


namespace App\Http\Controllers;


use App\Core\Controller;
use App\Core\Http\Request;

class GalleryController extends Controller
{
    /**
     * @param Request $request
     */
    public function index(Request $request)
    {
        $this->view('gallery.create', [
            'user' => $request->user()
        ]);
    }

    public function store(Request $request)
    {
       $request->validate([
           'title' => ['required', 'min:5'],
           'description' => ['required', 'optional', 'max:200']
       ]);
    }
}