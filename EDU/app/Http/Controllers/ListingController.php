<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ListingController extends Controller
{
    //all listigs
    public function index(){
        //dd(request('tag'));
        return view('listings.index', [
            'listings' => Listing::latest()->filter(request(['tag', 'search']))->paginate(5)   
         ]);
        }
    //single listing
    public function show(Listing $listing){
        return view('listings.show',[
            'listing' => $listing
            ]);
    }
    // Show create form
    public function create(){
        return view('listings.create');
    }
    //store listing data
    public function store(Request $request){
        $formFields = $request->validate([
            'title'=>'required',
            'company'=>['required', Rule::unique('listings','company')],
            'location' => 'required',
            'website' =>'required',
            'email'=> ['required','email'],
            'tags'=>'required',
            'description'=>'required'
        ]);

        if($request->hasFile('logo')){
            $formFields['logo'] = $request->file('logo')->store('logos', 'public');
        }
        $formFields['user_id'] = auth()->id();

        Listing::create($formFields);
        

        return redirect('/')->with('message','Created succesfully');
    }
    //show edit form
    public function edit(Listing $listing){
        return view('listings.edit',['listing'=>$listing]);
    }
    //update listing
    public function update(Request $request, Listing $listing){
        //make sure logged in user is owner
        if($listing->user_id != auth()->id()){
            abort(403,'Unauthorized action');
        }

        $formFields = $request->validate([
            'title'=>'required',
            'company'=>['required'],
            'location' => 'required',
            'website' =>'required',
            'email'=> ['required','email'],
            'tags'=>'required',
            'description'=>'required'
        ]);

        if($request->hasFile('logo')){
            $formFields['logo'] = $request->file('logo')->store('logos', 'public');
        }
        $listing->update($formFields);
        

        return back()->with('message','Updated succesfully');
    }
    //deelete listing
    public function destroy(Listing $listing){
        if($listing->user_id != auth()->id()){
            abort(403,'Unauthorized action');
        }
        $listing->delete();
        return redirect('/')->with('message', 'Listing Deleted succesfully');
    }

    //manage listing
    public function manage(){
        return view('listings.manage', ['listings'=>auth()->user()->listings()->get()]);
    }
}
