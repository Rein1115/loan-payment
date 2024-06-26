<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
	use HasFactory;

	protected $fillable = [
		'firstname',
		'middlename',
		'lastname',
		'dob',
		'gender',
		'civil_status',
		'edu_att',
		'religion',
		'present_add',
		'prov_add',
		'salary_income',
		'occupation',
		'nameOfBusiness',
		'addOfBusiness',
		'mo_income',
		'contact_no',
		'otherLoan',
		'sp_name',
		'sp_add',
		'sp_occupation',
		'sp_salary',
		'no_dependents',
		'sp_contact',
		'sp_children',
		'co_maker',
		'checkedBy',
		'approvedBy',
		'client_pic',
		'client_add_sketch',
	];
}