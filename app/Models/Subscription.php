<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Subscription extends Model
{
    use HasFactory;
    public static function add($email)
    {
        $subscription = new Subscription;
        $subscription->email = $email;
        $subscription->save();
        return $subscription;
    }

    public function generateToken()
    {
        $this->token = Str::random(100);
        $this->save();
    }
    public function remove()
    {
        $this->delete();
    }
}
