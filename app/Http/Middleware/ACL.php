<?php

namespace App\Http\Middleware;

use Closure;
use Laracasts\Flash\Flash;
use Illuminate\Http\Request;
use App\Models\SystemComponent;
use App\Helpers\UserPermissions;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Log;
use App\Overrides\Spatie\Permission;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Redirect;

class ACL
{

    
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        // dd(env('DISABLE_ACL', false));
        if(env('DISABLE_ACL', false)){
            return $next($request);
        }
        // dd($user->hasRole('admin'));
        // dd(UserPermissions::getCurrentRouteName(true,false));
        $user=Auth::user();
        if ($user != null  && !$user->hasRole('admin')) {//if ($user != null && !$user->hasRole('admin')) {
            $permissionName = UserPermissions::getPermissionName();
            $routeName = UserPermissions::getCurrentRouteName(false,true);
            // dd(Route::current()->getName());
            $currentRouteName = Route::current()->getName();
            if ($permissionName == "" 
                || $currentRouteName  == 'dashboards.dashboard-1' 
                || $currentRouteName  == 'io_generator_builder'
                || $currentRouteName  == 'change-password'
                || $currentRouteName  == 'update-password'
                || $routeName  == 'landLayers'//TODO try to remove this and add sysytem component for this without appear in the menue
                ) {
                return $next($request);
            }
            // dd($routeName);
            if ($routeName == "previewReport"){
                // $routeName =  UserPermissions::getCurrentRouteName(true,false).".".$request->route('reportName');
                $routeName = $request->route('reportName');
                $permissionName =UserPermissions::getPrefixName().".".$request->route('reportName');
            } 
            
            $data = SystemComponent::where('route_name',$routeName)
                                    ->whereIn('comp_type', [3,4])   
                                    ->first();
            if (!$data){
                $msg =" عفوا هذه الصفحة غير موجوده فى عناصر النظام ";
                Log::alert($msg , ['user' => Auth::user()->id,'RouteName' =>$routeName ,'currentRouteName' =>$currentRouteName] );
                App::abort(403, $msg);
            }
            // dd($permissionName );
            if( $data->comp_type == 3){
                $methodName =UserPermissions::getCurrentMethodName();
                if($methodName == 'store' ){
                    $permissionName =  str_replace($methodName, "create", $permissionName);
                }
                if( $methodName == 'update'){
                    $permissionName =  str_replace($methodName, "edit", $permissionName);
                }
            }
            
            // dd($permissionName );
            // dd($data->id);
            //$fullPermissionName =  $permissionName . "." . $data->id;
            $fullPermissionName =  $permissionName ;
            // $request->session()->forget('systemObjectId');

            // if(isset($sysData) && !$request->session()->has('systemArName')){
            //     $systemArName = $sysData->object_name;
            //     $systemObjectId = $sysData->id;

            //     $request->session()->put('systemArName', $systemArName);
            //     $request->session()->put('systemObjectId', $systemObjectId);
            // }

            if (!$user->can($fullPermissionName)) {
                $this->DoPermissionAccessDenied($fullPermissionName,$data->id);
                if($data->comp_type == 4){
                    return Redirect::away(route("home")); 
                }else{
                  return Redirect::back();  
                }
                
            }
        }


        return $next($request);
    }


    private function DoPermissionAccessDenied($fullPermissionName = null ,$systemComponentID="")
    {
        // dd($fullPermissionName );
        // session()->forget('object_id');
        //$msg = "Access denied for user id  (" . Auth::user()->id . ") user name :(" . Auth::user()->username . ") try to acsess (" . Route::current()->getName() . ") Permission Name :(" . $fullPermissionName . ")" ;
        // $msg =" عفوا لا تمتلك صلاحية للدخول على هذه الصفحة ";
        // App::abort(403, $msg);
        // $permission = Permission::firstOrCreate(['name' => $fullPermissionName]);
        
        if($fullPermissionName && $systemComponentID){
            $permission =Permission::firstOrCreate(
                    ['name' => $fullPermissionName],
                    ['name' => $fullPermissionName,'system_component_id' => $systemComponentID]
                );
               
        }

        // Log::withContext(['user' => Auth::user()->id,'PermissionName' =>$fullPermissionName]);
        Log::alert('محاولة الدخول بدون صلاحية ' , ['user' => Auth::user()->id,'PermissionName' =>$fullPermissionName] );
        // Log::channel('slack')->alert('محاولة الدخول بدون صلاحية', ['user' => Auth::user()->id,'PermissionName' =>$fullPermissionName]);
        Flash::error('عفوا لا تمتلك صلاحية للدخول على هذه الصفحة / أو اتمام هذا الاجراء' );
    }



    
}
