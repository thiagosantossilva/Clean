<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class AddressType
 *
 * @package App
 * @property string $title
*/
class AddressType extends Model
{
    protected $fillable = ['title'];
    protected $hidden = [];
    
    
    
}
