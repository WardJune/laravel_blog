<?php

namespace App\Http\Controllers;

use App\Jobs\SendMailJob;
use App\Mail\SendMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class SendMailController extends Controller
{
    public function sendEmail(){
        Mail::to('junawar183@gmail.com')
            ->send(new SendMail);
        echo "send Email";
    }

    public function sendEmailQueues(){
        SendMailJob::dispatch();
        echo "send mail with queues";
    }
}