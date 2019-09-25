<?php

namespace App\Http\Controllers\Api;

use App\Contact;
use App\Http\Requests\NewContactRequest;
use App\Http\Requests\UpdateContactRequest;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Mockery\Exception;

class ContactsController extends Controller
{
    public function create(NewContactRequest $request)
    {
        try {
            $contact = new Contact();

            $contact->first_name = $request->first_name;
            $contact->last_name = $request->last_name;
            $contact->email = $request->email;
            $contact->phone = $request->phone;
            $contact->birthday = $request->birthday ? Carbon::createFromFormat('m-d-Y', $request->birthday) : null;
            $contact->address = $request->address;
            $contact->city = $request->city;
            $contact->state = $request->state;
            $contact->zip = $request->zip;

            $contact->save();

            return response()->json(['success' => true, 'reload' => true]);
        } catch (Exception $e) {
            return response()->json(['success' => false, 'errors' => $e]);
        }
    }

    public function update(UpdateContactRequest $request)
    {
        try {
            $contact = Contact::where('id', $request->id)->first();

            if (!$contact) {
                $error = \Illuminate\Validation\ValidationException::withMessages([
                    'id' => ['Invalid Contact Id'],
                ]);
                throw $error;
            }

            $contact->first_name = $request->first_name;
            $contact->last_name = $request->last_name;
            $contact->email = $request->email;
            $contact->phone = $request->phone;
            $contact->birthday = $request->birthday ? Carbon::createFromFormat('m-d-Y', $request->birthday) : null;
            $contact->address = $request->address;
            $contact->city = $request->city;
            $contact->state = $request->state;
            $contact->zip = $request->zip;

            $contact->save();

            return response()->json(['success' => true, 'reload' => false, 'message' => 'Successfully Updated']);
        } catch (Exception $e) {
            return response()->json(['success' => false, 'errors' => $e]);
        }
    }
}
