<?php

namespace Evolme\Http\Controllers;

use Illuminate\Http\Request;
use Evolme\Http\Requests;
use Evolme\Http\Requests\UserRegistrationRequest;
use Evolme\Http\Requests\UserLoginRequest;
use Evolme\Http\Controllers\Controller;
use Evolme\EvolmeProviders\Repository\UserEloquentRepository;
use Illuminate\Support\Facades\Gate;
use Laravel\Socialite\Facades\Socialite;
use Evolme\EvolmeProviders\Helpers\EmailHelper;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Illuminate\Support\Facades\Auth;
use Evolme\User;
use Validator;
use Evolme\Http\Requests\UserResetPasswordRequest;
use Evolme\Http\Requests\UserUpdateProfileRequest;


class UserController extends Controller
{

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;
    /**
     *
     *The user Repository.
     *
     **/
    protected $userRepo;

    /**
     *
     *Create new UserEloquentRepository
     * @param UserEloquentRepository $userRepo
     *
     **/
    public function __construct(UserEloquentRepository $userRepo)
    {
        $this->userRepo = $userRepo;
    }

    /**
     * Route to get the login using socialite
     * @param null $provider
     * @return mixed
     */
    public function getSocialAuth($provider=null)
    {
        if(!config("services.$provider")) abort('404'); //just to handle providers that doesn't exist

        return Socialite::with($provider)->redirect();
    }

    /**
     * Route to handle the authentication and registration of a user with social providers
     * @param null $provider
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|string
     *
     */
    public function getSocialAuthCallback($provider=null)
    {
        if($user = Socialite::with($provider)->user()){
            $registeredUser = $this->userRepo->GetUserByEmail($user->email);
            if($registeredUser){
                $this->userRepo->AuthenticateUser($registeredUser);
                $redirectUrl = $this->userRepo->getRedirectUrl();
                return redirect($redirectUrl);
            }else{
                $newUser = $this->userRepo->CreateSocial($user,$provider);

                if($newUser){
                    $this->userRepo->AuthenticateUser($newUser);
                    $redirectUrl = $this->userRepo->getRedirectUrl();
                    EmailHelper::WelcomeMail($newUser);
                    return redirect($redirectUrl);
                }else{
                    return 'something went wrong';
                }
            }
        }else{
            return 'something went wrong';
        }
    }

    /**
     * Handles login request to the application
     * @param UserLoginRequest $request
     */
    public function postLogin(UserLoginRequest $request)
    {
        $this->userRepo->handlesLoginRequest($request);
    }

    /**
     * Handle a registration request for the application.
     *
     * @param  \Illuminate\Http\UserRegistrationRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function postRegister(UserRegistrationRequest $request)
    {
        $userToSave = [
                        'name'=>$request->input('name'),
                        'last_name'=>$request->input('last_name'),
                        'nickname' => $request->input('nickname'),
                        'email'=>$request->input('email'),
                        'password'=>bcrypt($request->input('password')),
                        'password_confirmation'=>bcrypt($request->input('password')),
                        'notification' => array_key_exists('notification',$request->input())? 1 : 0,
                        'role_id' => 1,
        ];
        $user = $this->userRepo->Create($userToSave,'evolme');
        $this->userRepo->AuthenticateUser($user);
        //EmailHelper::WelcomeMail($user);
        $redirectUrl = $this->userRepo->getRedirectUrl();
        echo json_encode(array("status" => "true","returnUrl" => $redirectUrl));
    }


    /**
     * Redirects the user to the profile page
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function perfil(){
        $user = $this->userRepo->GetAuthenticatedUser();
        return view('privadas.meusDados',compact('user'));
    }

    /**
     * @param Requests\UserUpdateProfileRequest $request
     */
    public function update(UserUpdateProfileRequest $request){
         //echo $this->userRepo->UpdateUserProfile($request);
         echo json_encode($this->userRepo->UpdateUserProfile($request));
    }

}
