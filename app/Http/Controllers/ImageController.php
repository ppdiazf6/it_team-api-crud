<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ImageController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    

    public function index()
    {
        $url_api = 'https://pixabay.com/api/?key=13119377-fc7e10c6305a7de49da6ecb25';
        
        $images = HTTP::get($url_api);
            
        $imagesArray = $images->json()['hits'];
        
        return view('imagenes.index', compact('imagesArray'));
    }

    public function show($id)
    {
        $url_api = 'https://pixabay.com/api/?key=13119377-fc7e10c6305a7de49da6ecb25&id='.$id;
        $images = HTTP::get($url_api);
        $imagesArray = $images->json();
        
        $image = $imagesArray['hits'][0];
        
        return view('imagenes.show', compact('image'));
    }

    public function search(Request $request)
    {
        $url_api = 'https://pixabay.com/api/?key=13119377-fc7e10c6305a7de49da6ecb25&lang=es&q='.$request->search;
            
        $images = HTTP::get($url_api);
        $imagesArray = $images->json()['hits'];
        
        return view('imagenes.index', compact('imagesArray'));
    }

    public function category($category)
    {
        $url_api = 'https://pixabay.com/api/?key=13119377-fc7e10c6305a7de49da6ecb25&category='.$category;
        $images = HTTP::get($url_api);
        $imagesArray = $images->json()['hits'];
            
        return view('imagenes.index', compact('imagesArray'));
    }
}
