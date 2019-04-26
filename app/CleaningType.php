<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class CleaningType
 *
 * @package App
 * @property string $title
 * @property integer $external_id
*/
class CleaningType extends Model
{
    protected $fillable = ['title', 'external_id'];
    protected $hidden = [];
    
    

    /**
     * Set attribute to money format
     * @param $input
     */
    public function setExternalIdAttribute($input)
    {
        $this->attributes['external_id'] = $input ? $input : null;
    }
    
}
