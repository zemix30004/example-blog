<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    use HasFactory;
    public function add($email)
    {
        $sub = new static;
        $sub->email = $email;
        $sub->token = str_random(100);
        $sub->save();
        return $sub;
    }
    public function remove()
    {
        $this->delete();
    }
}
