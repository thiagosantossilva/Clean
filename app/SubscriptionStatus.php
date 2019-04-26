<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class SubscriptionStatus
 *
 * @package App
 * @property string $title
*/
class SubscriptionStatus extends Model
{
    protected $fillable = ['title'];
    protected $hidden = [];
    
    
    
}
