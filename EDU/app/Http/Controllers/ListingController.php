<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use Illuminate\Http\Request;

class ListingController extends Controller
{
    //all listigs
    public function index(){
        //dd(request('tag'));
        return view('listings.index', [
            'listings' => Listing::latest()->filter(request(['tag']))->get()   
         ]);
        }
    //single listing
    public function show(Listing $listing){
        return view('listings.show',[
            'listing' => $listing
            ]);
    }
}
