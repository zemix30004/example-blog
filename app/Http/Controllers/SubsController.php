<?php

namespace App\Http\Controllers;

use App\Models\Subscription;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\SubscribeEmail;

class SubsController extends Controller
{
    public function subscribe(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email|unique:subscriptions',
        ]);
        $subscription = new Subscription;
        $subscription->add($request->get('email'));
        $subscription->generateToken();
        // Mail::to($subscription)->send(new SubscribeEmail($subscription));
        // Mail::send('emails.activation',  function ($message, $email, $subject) {
        //     $message->to($email)->subject($subject);
        // });
        // $subscription = Subscription::all()->take(100)->get('email');
        // Subscription::add($request->get('email'));
        return redirect()->back()->with('status', 'Проверьте вашу почту!');
    }
    // public function add()
    // {
    //     $sub = new Subscription();
    //     $sub->add();
    //     $sub = Subscription::all()->take(100)->get();
    // }
    public function verify($token)
    {
        $subscription = Subscription::where('token', $token)->firstOrFail();
        $subscription = null;
        $subscription()->save();
        return redirect('/')->with('status', 'Ваша почта подтверждена!');
    }
}
