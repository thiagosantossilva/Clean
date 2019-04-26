<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class CleansFeedback
 *
 * @package App
 * @property string $clean
 * @property text $text
*/
class CleansFeedback extends Model
{
    protected $fillable = ['text', 'clean_id'];
    protected $hidden = [];
    
    

    /**
     * Set to null if empty
     * @param $input
     */
    public function setCleanIdAttribute($input)
    {
        $this->attributes['clean_id'] = $input ? $input : null;
    }
    
    public function clean()
    {
        return $this->belongsTo(Clean::class, 'clean_id');
    }
    
}
