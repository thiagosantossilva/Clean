<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class CleanSlot
 *
 * @package App
 * @property string $clean
 * @property string $user
 * @property decimal $value
*/
class CleanSlot extends Model
{
    protected $fillable = ['value', 'clean_id', 'user_id'];
    protected $hidden = [];
    
    

    /**
     * Set to null if empty
     * @param $input
     */
    public function setCleanIdAttribute($input)
    {
        $this->attributes['clean_id'] = $input ? $input : null;
    }

    /**
     * Set to null if empty
     * @param $input
     */
    public function setUserIdAttribute($input)
    {
        $this->attributes['user_id'] = $input ? $input : null;
    }

    /**
     * Set attribute to money format
     * @param $input
     */
    public function setValueAttribute($input)
    {
		if ($input != null && $input != '') {
			if (strpos($input, ',') !== false) {
				$input = preg_replace( '/[^0-9]/', '', $input );
				$input = substr_replace($input, '.', strlen($input)-2, 0);
			}
            $this->attributes['value'] = $input;
        } else {
            $this->attributes['value'] = null;
        }
        //$this->attributes['price'] = $input ? $input : null;
    }
	
	public function getValueAttribute($input){
		if ($input != "" && $input != null) {
            return str_replace(".", ",", $input);
        } else {
            return '';
        }
	}
    
    public function clean()
    {
        return $this->belongsTo(Clean::class, 'clean_id');
    }
    
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
	
	public function hasSlot($clean){
		$slots = CleanSlot::where([['clean_id', '=', $clean], ['user_id', '=', NULL]])->count();
		if($slots){
			return true;
		}
		return false;
	}
    
}
