<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class PaymentStatus
 *
 * @package App
 * @property string $title
*/
class PaymentStatus extends Model
{
    protected $fillable = ['title'];
    protected $hidden = [];
	
	const AGUARDANDO_PAGAMENTO = 1;
	const PAGO = 2;
	const CANCELADO = 3;
 
}
