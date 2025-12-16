<?php
namespace App\Traits;
use App\Scopes\BranchScope;
use Illuminate\Support\Facades\Auth;


// this trait to save authancated user id in the model that use this trait 
trait Branchable
{
	public static function bootBranchable()
	{
		static::addGlobalScope(new BranchScope);
		static::saving(function ($model) {
			// you can define in your model  this (BranchIdFieldName) to override the default name of "created_by"
			if(Auth::user()){
				$branch_id=Auth::user()->branch_id;
				if ($model->BranchIdFieldName) 
					$model->{$model->BranchIdFieldName} =  $branch_id;
				else 
					$model->branch_id =$branch_id;
			}
			
		});
	}
}