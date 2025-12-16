<?php

namespace App\Utils;

// use App\Models\Branch;
// use App\Models\Department;
// use App\Models\Employee;

class SessionUtil
{
    // public static function setCurrentBranch($user)
    // {
    //     session(['current_branch_id' => $user->branch_id]);
    //     $branchData=Branch::find($user->branch_id);
    //     session(['current_branch_name' => $branchData->name]);
    // }

    // public static function getCurrentBranch()
    // {
    //     $branch_id =session('current_branch_id');

    //     if(!$branch_id){
    //         if(isset(auth()->user()->branch_id) && auth()->user()->branch_id){
    //             $branch_id = auth()->user()->branch_id;
    //             session(['current_branch_id' => $branch_id ]);
    //         }else{
    //             dd("your machine or your browser have session problem");
    //         } 
    //     }
    //     return $branch_id ;
    // }
    // public static function getCurrentCityByBranch()
    // {
    //     $branchData=Branch::find(SessionUtil::getCurrentBranch());
    //     if($branchData){
    //         return $branchData->city_id;
    //     }else{
    //         return redirect(route('login'));
    //     }
    // }
    // public static function setCurrentDepartment($user)
    // {
        
    //     $employeeData=Employee::where('user_id' , $user->id)->first();
    //     if($employeeData){
    //         $departmentId=$employeeData->department->id;
    //         $departmentName = $employeeData->department->name;
    //         // $departmentData=Department::find($user->branch_id);
    //         session(['current_department_id' => $departmentId]);
    //         session(['current_department_name' => $departmentName]);
    //     }
        
    // }

}