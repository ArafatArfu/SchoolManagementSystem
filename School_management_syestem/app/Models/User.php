<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Request;

use function PHPUnit\Framework\fileExists;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
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
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
    
    static function getSingle($id)
    {
        return User::find($id);
    }

    static function getAdmin()
    {
      $return = User::select('users.*')
                    ->where('user_type', '=', 1)
                    ->where('is_delete', '=', 0);
                    if(!empty(Request::get('name')))
                    {
                        $return = $return->where('name', 'like','%'. Request::get('name').'%');
                    }
                   if(!empty(Request::get('email')))
                    { 
                        $return = $return->where('email', 'like','%'. Request::get('email').'%');
                    }
                    if(!empty(Request::get('date')))
                    { 
                        $return = $return->whereDate('created_at', '=', Request::get('date'));
                    }
      $return = $return->orderBy('id','desc')
                    ->paginate(10);
       return $return;
    }


    static function getStudent()
    {
      $return = User::select('users.*')
                    ->where('users.user_type', '=', 3)
                    ->where('users.is_delete', '=', 0);

      $return = $return->orderBy('users.id','desc')
                    ->paginate(20);
       return $return;
    }


    static function getEmailSingle($email)
    {
        return User::where('email', '=' , $email)->first();
    }

    static function getTokenSingle($remember_token)
    {
        return User::where('remember_token', '=', $remember_token)->first();
    }


    
    public function getProfile()
    {
        if (!empty($this->profile_pic) && file_exists('upload/profile/' . $this->profile_pic)) {
            return url('upload/profile/' . $this->profile_pic);
        }

        else {
            return "";
        }
    }
}
