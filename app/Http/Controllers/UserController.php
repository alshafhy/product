<?php

namespace App\Http\Controllers;

use Flash;
use Response;
use App\Models\User;
use App\Http\Requests;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Overrides\Spatie\Role;
use App\Utils\PermissionsUtil;
use App\DataTables\UserDataTable;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\UpdateUserRequest;
use Illuminate\Validation\Rules\Password;
use App\Http\Controllers\AppBaseController;

class UserController extends AppBaseController
{

    public $gClient;

    public function __construct()
    {
        // $google_redirect_url = route('glogin');
        // $this->gClient = new \Google_Client();
        // $this->gClient->setApplicationName(config('services.google.app_name'));
        // $this->gClient->setClientId(config('services.google.client_id'));
        // $this->gClient->setClientSecret(config('services.google.client_secret'));
        // $this->gClient->setRedirectUri($google_redirect_url);
        // $this->gClient->setDeveloperKey(config('services.google.api_key'));
        // $this->gClient->setScopes(array(               
        //     'https://www.googleapis.com/auth/drive.file',
        //     'https://www.googleapis.com/auth/drive'
        // ));
        // $this->gClient->setAccessType("offline");
        // $this->gClient->setApprovalPrompt("force");
    }

    public function googleLogin(Request $request)
    {

        // $google_oauthV2 = new \Google_Service_Oauth2($this->gClient);
        // if ($request->get('code')){
        //     $this->gClient->authenticate($request->get('code'));
        //     $request->session()->put('token', $this->gClient->getAccessToken());
        // }
        // if ($request->session()->get('token'))
        // {
        //     $this->gClient->setAccessToken($request->session()->get('token'));
        // }
        // if ($this->gClient->getAccessToken())
        // {
        //     //For logged in user, get details from google using acces
        //     $user=User::find(1);
        //     $user->access_token=json_encode($request->session()->get('token'));
        //     $user->save();               
        //     dd("Successfully authenticated");
        // } else
        // {
        //     //For Guest user, get google login url
        //     $authUrl = $this->gClient->createAuthUrl();
        //     return redirect()->to($authUrl);
        // }
    }

    public function uploadFileUsingAccessToken()
    {
        //     $service = new \Google_Service_Drive($this->gClient);
        //     $user=User::find(1);
        //     $this->gClient->setAccessToken(json_decode($user->access_token,true));
        //     if ($this->gClient->isAccessTokenExpired()) {

        //         // save refresh token to some variable
        //         $refreshTokenSaved = $this->gClient->getRefreshToken();
        //         // update access token
        //         $this->gClient->fetchAccessTokenWithRefreshToken($refreshTokenSaved);               
        //         // // pass access token to some variable
        //         $updatedAccessToken = $this->gClient->getAccessToken();
        //         // // append refresh token
        //         $updatedAccessToken['refresh_token'] = $refreshTokenSaved;
        //         //Set the new acces token
        //         $this->gClient->setAccessToken($updatedAccessToken);

        //         $user->access_token=$updatedAccessToken;
        //         $user->save();                
        //     }

        //    $fileMetadata = new \Google_Service_Drive_DriveFile(array(
        //         'name' => 'ExpertPHP',
        //         'mimeType' => 'application/vnd.google-apps.folder'));
        //     $folder = $service->files->create($fileMetadata, array(
        //         'fields' => 'id'));
        //     printf("Folder ID: %s\n", $folder->id);


        //     $file = new \Google_Service_Drive_DriveFile(array(
        //                     'name' => 'cdrfile.jpg',
        //                     'parents' => array($folder->id)
        //                 ));
        //     $result = $service->files->create($file, array(
        //       'data' => file_get_contents(public_path('images/myimage.jpg')),
        //       'mimeType' => 'application/octet-stream',
        //       'uploadType' => 'media'
        //     ));
        //     // get url of uploaded file
        //     $url='https://drive.google.com/open?id='.$result->id;
        //     dd($result);

    }
    /**
     * Display a listing of the User.
     *
     * @param UserDataTable $userDataTable
     * @return Response
     */
    public function index(UserDataTable $userDataTable)
    {
        return $userDataTable->render('users.index');
    }

    /**
     * Show the form for creating a new User.
     *
     * @return Response
     */
    public function create()
    {
        $branches = Branch::pluck('name', 'id')->prepend("اختر", "");
        return view('users.create', compact('branches'));
    }

    /**
     * Store a newly created User in storage.
     *
     * @param CreateUserRequest $request
     *
     * @return Response
     */
    public function store(CreateUserRequest $request)
    {
        $input = $request->all();
        // $pass =Str::random(12);
        $pass = $input['username'] . "@demo";
        /** @var User $user */
        $input['password'] = Hash::make($pass);
        if (!$request->branch_id) {
            $input['branch_id'] = 1;
        }
        $input['pass_need_to_be_changed'] = 1;
        $user = User::create($input);

        Flash::success(__('messages.saved', ['model' => __('models/users.singular')]));

        return redirect(route('users.index'));
    }

    /**
     * Display the specified User.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var User $user */
        $user = User::find($id);

        if (empty($user)) {
            Flash::error(__('models/users.singular') . ' ' . __('messages.not_found'));

            return redirect(route('users.index'));
        }

        return view('users.show')->with('user', $user);
    }

    /**
     * Show the form for editing the specified User.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        /** @var User $user */
        $user = User::find($id);

        if (empty($user)) {
            Flash::error(__('messages.not_found', ['model' => __('models/users.singular')]));

            return redirect(route('users.index'));
        }

        $roles_list = Role::pluck('ar_name', 'id');

        $userRoles = $user->roles()
            ->select('id', 'ar_name')
            ->get();

        return view('users.edit', compact('user', 'roles_list', 'userRoles'));
    }

    /**
     * Update the specified User in storage.
     *
     * @param  int              $id
     * @param UpdateUserRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateUserRequest $request)
    {
        $this->validate($request, [
            'username' => 'required|unique:users,username,' . $id,
            'email' => 'required|email|unique:users,email,' . $id
        ]);

        /** @var User $user */
        $user = User::find($id);

        if (empty($user)) {
            Flash::error(__('messages.not_found', ['model' => __('models/users.singular')]));

            return redirect(route('users.index'));
        }

        $user->fill($request->all());
        $user->save();

        $user->syncRoles($request->input('roles'));
        PermissionsUtil::clearPermissionCash();

        Flash::success(__('messages.updated', ['model' => __('models/users.singular')]));

        return redirect(route('users.index'));
    }

    /**
     * Remove the specified User from storage.
     *
     * @param  int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var User $user */
        $user = User::find($id);

        if (empty($user)) {
            Flash::error(__('messages.not_found', ['model' => __('models/users.singular')]));

            return redirect(route('users.index'));
        }

        $user->delete();

        Flash::success(__('messages.deleted', ['model' => __('models/users.singular')]));

        return redirect(route('users.index'));
    }

    public function changePassword()
    {
        return view('users.change-password');
    }

    public function updatePassword(Request $request)
    {
        # Validation
        $request->validate([
            'old_password' => 'required',
            // 'new_password' => 'required|confirmed',
            'new_password' => [
                'required',
                'confirmed',
                Password::min(8)
                    ->mixedCase()
            ],
            // 'new_password_confirmation' => 'required|same:new_password'
        ]);


        #Match The Old Password
        if (!Hash::check($request->old_password, auth()->user()->password)) {
            return back()->with("error", __("Old Password Doesn't match!"));
        }


        #Update the new Password
        User::whereId(auth()->user()->id)->update([
            'password' => Hash::make($request->new_password),
            'pass_need_to_be_changed' => 0
        ]);

        return back()->with("status", __("Password changed successfully!"));
    }
}
