<?php
namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Notifications\ResetPassword;
use Hash;
use Carbon\Carbon;

/**
 * Class User
 *
 * @package App
 * @property string $name
 * @property string $email
 * @property string $password
 * @property string $role
 * @property string $remember_token
*/
class User extends Authenticatable
{
    use Notifiable;
    protected $fillable = ['name', 'email', 'password', 'remember_token', 'role_id', 'external_id', 'cpf', 'birthdate', 'gender', 'phone', 'celphone', 'street', 'number', 'zip', 'neighborhood', 'city', 'state', 'complement', 'location_address', 'location_latitude', 'location_longitude'];
    protected $hidden = ['password', 'remember_token'];
    
    
    
    /**
     * Hash password
     * @param $input
     */
    public function setPasswordAttribute($input)
    {
        if ($input)
            $this->attributes['password'] = app('hash')->needsRehash($input) ? Hash::make($input) : $input;
    }
    

    /**
     * Set to null if empty
     * @param $input
     */
    public function setRoleIdAttribute($input)
    {
        $this->attributes['role_id'] = $input ? $input : null;
    }
	
	/**
     * Set attribute to date format
     * @param $input
     */
    public function setBirthdateAttribute($input)
    {
        if ($input != null && $input != '') {
			if (strpos($input, '/') !== false) {
				$this->attributes['birthdate'] = Carbon::createFromFormat(config('app.date_format'), $input)->format('Y-m-d');
			}
			else {
				$this->attributes['birthdate'] = Carbon::createFromFormat('dmY', $input)->format('Y-m-d');
			}
            
        } else {
            $this->attributes['birthdate'] = null;
        }
    }
	
	 /**
     * Get attribute from date format
     * @param $input
     *
     * @return string
     */
    public function getBirthdateAttribute($input)
    {
        $zeroDate = str_replace(['Y', 'm', 'd'], ['0000', '00', '00'], config('app.date_format'));

        if ($input != $zeroDate && $input != null) {
            return Carbon::createFromFormat('Y-m-d', $input)->format(config('app.date_format'));
        } else {
            return '';
        }
    }
	
    
    public function role()
    {
        return $this->belongsTo(Role::class, 'role_id');
    }
    
    public function topics() {
        return $this->hasMany(MessengerTopic::class, 'receiver_id')->orWhere('sender_id', $this->id);
    }

    public function inbox()
    {
        return $this->hasMany(MessengerTopic::class, 'receiver_id');
    }

    public function outbox()
    {
        return $this->hasMany(MessengerTopic::class, 'sender_id');
    }
	
	public function clean_slot()
    {
        return $this->hasMany(CleanSlot::class, 'user_id');
    }
    

    public function sendPasswordResetNotification($token)
    {
       $this->notify(new ResetPassword($token));
    }
}
