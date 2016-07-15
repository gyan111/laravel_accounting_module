<?php namespace Modules\Accounting\Entities;
   

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Account extends Model {

    use SoftDeletes;
	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['account_name', 'is_default', 'deleted', 'created_by', 'modified_by'];

	/**
     * Get the user who created the account.
     */
    public function createdBy()
    {
        return $this->belongsTo('app\User', 'created_by');
    }

    /**
     * Get the user who modified the account.
     */
    public function modifiedBy()
    {
        return $this->belongsTo('app\User', 'modified_by');
    }

}
