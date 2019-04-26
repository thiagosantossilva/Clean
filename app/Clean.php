<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Http\Request;

/**
 * Class Clean
 *
 * @package App
 * @property integer $external_id
 * @property integer $payment_id
 * @property string $address_type
 * @property string $clean_type
 * @property string $clean_category
 * @property string $client
 * @property string $status
 * @property string $assigned_to
 * @property integer $qt_bedrooms
 * @property integer $qt_bathrooms
 * @property string $additionals
 * @property string $total_time
 * @property tinyInteger $products_included
 * @property decimal $value
 * @property string $start_time
 * @property string $end_time
 * @property tinyInteger $pet
 * @property text $pet_cautions
*/
class Clean extends Model
{
    //protected $fillable = ['external_id', 'payment_id', 'qt_bedrooms', 'qt_bathrooms', 'additionals', 'total_time', 'products_included', 'value', 'start_time', 'end_time', 'pet', 'pet_cautions', 'address_type_id', 'clean_type_id', 'clean_category_id', 'client_id', 'status_id', 'assigned_to_id'];
    protected $fillable = ['external_id', 'payment_id', 'qt_bedrooms', 'qt_bathrooms', 'additionals', 'total_time', 'products_included', 'value', 'start_time', 'end_time', 'pet', 'pet_cautions', 'qt_employees', 'address_type_id', 'clean_type_id', 'clean_category_id', 'client_id', 'status_id', 'payment_status_id'];
	protected $hidden = [];
	protected $dates = [
        'start_time',
		'end_time'
    ];
    
    
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

    /**
     * Set attribute to money format
     * @param $input
     */
    public function setExternalIdAttribute($input)
    {
        $this->attributes['external_id'] = $input ? $input : null;
    }

    /**
     * Set attribute to money format
     * @param $input
     */
    public function setPaymentIdAttribute($input)
    {
        $this->attributes['payment_id'] = $input ? $input : null;
    }

    /**
     * Set to null if empty
     * @param $input
     */
    public function setAddressTypeIdAttribute($input)
    {
        $this->attributes['address_type_id'] = $input ? $input : null;
    }

    /**
     * Set to null if empty
     * @param $input
     */
    public function setCleanTypeIdAttribute($input)
    {
        $this->attributes['clean_type_id'] = $input ? $input : null;
    }

    /**
     * Set to null if empty
     * @param $input
     */
    public function setCleanCategoryIdAttribute($input)
    {
        $this->attributes['clean_category_id'] = $input ? $input : null;
    }

    /**
     * Set to null if empty
     * @param $input
     */
    public function setClientIdAttribute($input)
    {
        $this->attributes['client_id'] = $input ? $input : null;
    }

    /**
     * Set to null if empty
     * @param $input
     */
    public function setStatusIdAttribute($input)
    {
        $this->attributes['status_id'] = $input ? $input : null;
    }
	
	/**
     * Set to null if empty
     * @param $input
     */
    public function setPaymentStatusIdAttribute($input)
    {
        $this->attributes['payment_status_id'] = $input ? $input : null;
    }

    /**
     * Set to null if empty
     * @param $input
     */
    public function setAssignedToIdAttribute($input)
    {
        $this->attributes['assigned_to_id'] = $input ? $input : null;
    }

    /**
     * Set attribute to money format
     * @param $input
     */
    public function setQtBedroomsAttribute($input)
    {
        $this->attributes['qt_bedrooms'] = $input ? $input : null;
    }

    /**
     * Set attribute to money format
     * @param $input
     */
    public function setQtBathroomsAttribute($input)
    {
        $this->attributes['qt_bathrooms'] = $input ? $input : null;
    }

    /**
     * Set attribute to date format
     * @param $input
     */
    public function setStartTimeAttribute($input)
    {
        if ($input != null && $input != '') {
            $this->attributes['start_time'] = Carbon::createFromFormat(config('app.date_format') . ' H:i:s', $input)->format('Y-m-d H:i:s');
        } else {
            $this->attributes['start_time'] = null;
        }
    }

    /**
     * Get attribute from date format
     * @param $input
     *
     * @return string
     */
    public function getStartTimeAttribute($input)
    {
        $zeroDate = str_replace(['Y', 'm', 'd'], ['0000', '00', '00'], config('app.date_format') . ' H:i:s');

        if ($input != $zeroDate && $input != null) {
            return Carbon::createFromFormat('Y-m-d H:i:s', $input)->format(config('app.date_format') . ' H:i:s');
        } else {
            return '';
        }
    }

    /**
     * Set attribute to date format
     * @param $input
     */
    public function setEndTimeAttribute($input)
    {
        if ($input != null && $input != '') {
            $this->attributes['end_time'] = Carbon::createFromFormat(config('app.date_format') . ' H:i:s', $input)->format('Y-m-d H:i:s');
        } else {
            $this->attributes['end_time'] = null;
        }
    }

    /**
     * Get attribute from date format
     * @param $input
     *
     * @return string
     */
    public function getEndTimeAttribute($input)
    {
        $zeroDate = str_replace(['Y', 'm', 'd'], ['0000', '00', '00'], config('app.date_format') . ' H:i:s');

        if ($input != $zeroDate && $input != null) {
            return Carbon::createFromFormat('Y-m-d H:i:s', $input)->format(config('app.date_format') . ' H:i:s');
        } else {
            return '';
        }
    }
	
	/**
     * Set attribute to money format
     * @param $input
     */
    public function setQtEmployeesAttribute($input)
    {
        $this->attributes['qt_employees'] = $input ? $input : null;
    }
    
    public function address_type()
    {
        return $this->belongsTo(AddressType::class, 'address_type_id');
    }
    
    public function clean_type()
    {
        return $this->belongsTo(CleaningType::class, 'clean_type_id');
    }
    
    public function clean_category()
    {
        return $this->belongsTo(CleanCategory::class, 'clean_category_id');
    }
    
    public function client()
    {
        return $this->belongsTo(User::class, 'client_id')/*->where('role_id', 4)*/;
    }
    
    public function status()
    {
        return $this->belongsTo(CleaningStatus::class, 'status_id');
    }
	
	public function payment_status()
    {
        return $this->belongsTo(PaymentStatus::class, 'payment_status_id');
    }
	
	public function assigned_to()
    {
        return $this->belongsToMany(User::class, 'clean_slots');
    }
    
	public function qt_assigned_to(){
		//return $this->belongsToMany('App\CleanUser', 'clean_user')->where('user_id', 0);
		return \App\CleanSlot::where('clean_id', $this->id)->where('user_id', '!=', NULL)->count();
	}
	
	public function clean_slots() {
        return $this->hasMany(CleanSlot::class, 'clean_id');
    }
	
	public function free_slots() {
        return $this->hasMany(CleanSlot::class, 'clean_id')->where('user_id', NULL);
    }
	
	public function qt_free_slots(){
		//return $this->belongsToMany('App\CleanUser', 'clean_user')->where('user_id', 0);
		return \App\CleanSlot::where('clean_id', $this->id)->where('user_id', NULL)->count();
	}

	
	public function scopeFilterByRequest($query, Request $request){
		if ($request->day_start || $request->month_start || $request->year_start) {
			if($request->day_end && $request->month_end && $request->year_end){
				$query->whereBetween('start_time', [Carbon::createFromDate($request->year_start, $request->month_start, $request->day_start),
					Carbon::createFromDate($request->year_end, $request->month_end, $request->day_end)]);
			}
			else {
				if($request->day_end || $request->month_end || $request->year_end){
					if($request->day_start && $request->day_end){
						$query->whereDay('start_time', '>=' ,$request->day_start);
						$query->whereDay('start_time', '<=' ,$request->day_end);
					}
					if($request->month_start && $request->month_end){
						$query->whereMonth('start_time', '>=' ,$request->month_start);
						$query->whereMonth('start_time', '<=' ,$request->month_end);
					}
					if($request->year_start && $request->year_end){
						$query->whereYear('start_time', '>=' ,$request->year_start);
						$query->whereYear('start_time', '<=' ,$request->year_end);
					}
				}
				else {
					if($request->day_start) {
						$query->whereDay('start_time', $request->day_start);
					}
					if($request->month_start) {
						$query->whereMonth('start_time', $request->month_start);
					}
					if($request->year_start) {
						$query->whereYear('start_time', $request->year_start);
					}
				}
			}
		}
	}
	
    
}
