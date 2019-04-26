<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class CleaningStatus
 *
 * @package App
 * @property string $title
*/
class CleaningStatus extends Model
{
    protected $fillable = ['title'];
    protected $hidden = [];
    
    
    
}
