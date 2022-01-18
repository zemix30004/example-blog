<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class User extends Authenticatable
{
    const IS_BANNED = 1;
    const IS_ACTIVE = 0;
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function posts()
    {
        return $this->hasMany(Post::class);
    }
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
    public static function add($fields)
    {
        $user = new static;
        $user->fill($fields);
        $user->save();
        return $user;
    }
    public function edit($fields)
    {
        $this->fill($fields);

        $this->save();
    }

    public function generatePassword($password)
    {
        if ($password != null) {
            $this->password = bcrypt($password);
            $this->save();
        }
    }
    public function remove()
    {
        // Storage::delete('uploads/' . $this->avatar);
        $this->removeAvatar();
        $this->delete();
    }
    public function uploadAvatar($image)
    {
        if ($image == null) {
            return;
        }
        $this->removeAvatar();
        // dd(get_class_methods($image));
        $filename = Str::random(10) . '.' . $image->extension();
        $image->storeAs('uploads', $filename);
        $this->avatar = $filename;
        $this->save();
    }

    public function removeAvatar()
    {
        if ($this->avatar != null) {
            Storage::delete('uploads/' . $this->avatar);
        }
    }
    public function getImage()
    {
        if ($this->avatar == null) {
            return '/img/no-image.jpg';
        }
        return '/uploads/' . $this->avatar;
    }
    public function makeAdmin()
    {
        $this->is_admin = 1;
        $this->save();
    }
    public function makeNormal()
    {
        $this->is_admin = 0;
        $this->save();
    }
    public function toggleAdmin($value)
    {
        if ($value == null) {
            return $this->makeNormal();
        }
        return $this->makeAdmin();
    }
    public function ban()
    {
        $this->status = User::IS_BANNED;
        $this->save();
    }
    public function unBan()
    {
        $this->status = User::IS_ACTIVE;
        $this->save();
    }
    public function toggleBan($value)
    {
        if ($value == null) {
            return $this->unBan();
        }
        return $this->ban();
    }
}
