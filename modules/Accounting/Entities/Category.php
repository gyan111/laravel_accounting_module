<?php namespace Modules\Accounting\Entities;
   
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model {

    use SoftDeletes;

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['type','category_name', 'is_default', 'deleted', 'created_by', 'modified_by'];

	/**
     * Get the user who created the category.
     */
    public function createdBy()
    {
        return $this->belongsTo('app\User', 'created_by');
    }

    /**
     * Get the user who modified the category.
     */
    public function modifiedBy()
    {
        return $this->belongsTo('app\User', 'modified_by');
    }

}
