<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Contact;

class ContactController extends Controller
{
    /**
     * Display a listing of the contact messages
     */
    public function index() {
        $contacts = Contact::all();
        return view('pages.admin.contact.index', compact('contacts'));
    }
}
