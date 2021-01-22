<?php


namespace App\Http\Controllers;


use App\Core\Controller;
use App\Core\Http\Request;

class GalleryController extends Controller
{
    public function create(Request $request)
    {
        $this->view('gallery.create');
    }
}