<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Contact;

class ContactController extends Controller
{

    public function create() {
        return view('pages.user.contact_us');
    }

    public function store(Request $request) {
        $formFields = $request->validate([
            'fname' => 'required',
            'lname' => 'required',
            'email' => 'required|email',
            'message' => 'required',
        ]);
        //Insertion
        Contact::create($formFields);
        return back();
    }
}
