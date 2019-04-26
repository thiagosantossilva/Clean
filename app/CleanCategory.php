<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class CleanCategory
 *
 * @package App
 * @property string $title
*/
class CleanCategory extends Model
{
    protected $fillable = ['title'];
    protected $hidden = [];
    
    
    
}
