<?php

namespace App\Http\Controllers\Api;

use App\Contact;
use App\Http\Controllers\Controller;
use App\Http\Requests\ContactStoreRequest;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function store(ContactStoreRequest $request){
        $data = $request->validated();

        $newContact = new Contact();
        $newContact->fill($data);
        $newContact->save();

        return response()->json($newContact);
    }
}
