<?php

namespace App\Http\Controllers\Api;

use App\Contact;
use App\Http\Controllers\Controller;
use App\Http\Requests\ContactStoreRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendNewMail;

class ContactController extends Controller
{
    public function store(ContactStoreRequest $request){
        $data = $request->validated();

        $newContact = new Contact();
        $newContact->fill($data);
        $newContact->save();

        Mail::to('admin.sito.laravel@sito.com')
        ->send(new SendNewMail($newContact));

        return response()->json($newContact);
    }
}
