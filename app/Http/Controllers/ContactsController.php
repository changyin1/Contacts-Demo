<?php

namespace App\Http\Controllers;

use App\Contact;
use Illuminate\Http\Request;

class ContactsController extends Controller
{
    public function index() {
        $contacts = Contact::all();

        return view('contacts.index', [
            'contacts' => $contacts
        ]);
    }

    public function view($id) {
        $contact= Contact::where('id', $id)->first();

        return view('contacts.edit', [
            'contact' => $contact
        ]);
    }

    public function delete(Request $request)
    {
        $contact = Contact::where('id', $request->contact_id)->first();

        if (!$contact) {
            $error = \Illuminate\Validation\ValidationException::withMessages([
                'id' => ['Invalid Contact Id'],
            ]);
            throw $error;
        }

        $contact->delete();

        return redirect('/home');
    }
}
