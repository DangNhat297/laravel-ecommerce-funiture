<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactRequest;
use App\Jobs\SendNewContact;
use App\Mail\SendMailContact;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    
    public function index(){
        return view('screen.client.contact');
    }

    public function store(ContactRequest $request)
    {
        try{
            $c = new Contact();
            $c->fill($request->all());
            $c->save();
            Mail::to("ndnhat1@gmail.com")->send(new SendMailContact($request->all()));
            // dispatch(new SendNewContact($request->all()));
            // Artisan::call("queue:work --stop-when-empty");
            return redirect()
                        ->back()
                        ->with('success', 'Gửi liên hệ thành công');
        }catch(\Exception $e){
            Log::error($e->getMessage());
            return redirect()
                        ->back()
                        ->with('error', 'Có lỗi xảy ra, vui lòng thử lại');
        }
    }

}
