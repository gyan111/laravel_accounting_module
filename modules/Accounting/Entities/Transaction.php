<?php namespace Modules\Accounting\Entities;
   
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Transaction extends Model {

	use SoftDeletes;

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['amount','type', 'date', 'description', 'verified'];

	/**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['date'];


    /**
     * Set the date.
     *
     * @param  string  $date
     * @return string
     */
    public function setDateAttribute($date)
    {
        $this->attributes['date'] = date('Y-m-d', strtotime($date));
    }


	/**
     * Get the user who created the transaction.
     */
    public function createdBy()
    {
        return $this->belongsTo('app\User', 'created_by');
    }

    /**
     * Get the user who modified the transaction.
     */
    public function modifiedBy()
    {
        return $this->belongsTo('app\User', 'modified_by');
    }
    /**
     * Get the account to which the transaction belongs to
     */
    public function account()
    {
        return $this->belongsTo('Modules\Accounting\Entities\Account', 'account_id');
    }

    /**
     * Get the category to which the transaction belongs to
     */
    public function category()
    {
        return $this->belongsTo('Modules\Accounting\Entities\Category', 'category_id');
    }

}
