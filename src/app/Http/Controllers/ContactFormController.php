<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ContactRequest;
use App\Models\Contact;
use App\Models\Category;
use Illuminate\Support\Facades\Session;

class ContactFormController extends Controller
{
    public function index()
    {
        $categories = \App\Models\Category::all();
        $input = Session::get('contact_input');
        return view('contact.index', compact('categories', 'input'));
    }

    public function confirm(ContactRequest $request)
    {
        $input = $request->validated();
        Session::put('contact_input', $input);

        $input['gender_string'] = (new Contact())->setGenderAttribute($input['gender'])->gender_string;
        $input['category_name'] = Category::find($input['category_id'])->name;

        return view('confirm', compact('input'));
    }

    public function store(Request $request)
    {
        $input = Session::get('contact_input');

        if (!$input) {
            return redirect()->route('index');
        }

        Contact::create($input);

        Session::forget('contact_input');

        return redirect()->route('complete');
    }
    public function complete()
    {
        return view('complete');
    }
}