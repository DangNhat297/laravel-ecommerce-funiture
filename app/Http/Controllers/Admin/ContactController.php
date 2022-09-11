<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    
    public function index()
    {
        $contacts = Contact::all();
        return view('screen.admin.contact.list', compact('contacts'));
    }

}
