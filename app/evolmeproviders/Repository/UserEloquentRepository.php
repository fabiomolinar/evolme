<?php
/**
 * Created by PhpStorm.
 * User: claudionor
 * Date: 4/22/16
 * Time: 3:25 PM
 */

namespace Evolme\EvolmeProviders\Repository;

use Evolme\User;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Mail;
use Psy\Util\Json;
use Validator;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Auth;
use Evolme\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Evolme\Http\Requests\UserResetPasswordRequest;
use Evolme\Http\Requests;
use Evolme\Http\Requests\UserLoginRequest;
use Evolme\Http\Requests\PlanosPrecosRequest;
use Evolme\Http\Requests\UserRedefinePasswordRequest;
use Evolme\Http\Requests\UserUpdateProfileRequest;
use Illuminate\Cache\RateLimiter;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Support\Facades\Password;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Illuminate\Support\Facades\DB;



class UserEloquentRepository
{
    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    /**
    *
    *The user model.
    *
    **/
    protected $user;

    /**
     *
     *Create new user
     * @param User $user
     * @return void
     *
     **/
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     *
     * Returning the user profile image.
     *
     */
    public function GetUserProfileImage(){
        return $this->user->user_images()->where('is_active',true);
    }

    /**
     *
     * Returning a user by its id.
     *
     */
    public function GetUserById($id){
        return $this->user->findOrFail($id);
    }


    /**
     *
     * Returning an the reviews a user has made.
     *
     */
    public function GetUserReviews(){
        return $this->user->reviews();
    }

    /**
     *
     * Returning the role of a user.
     *
     */
    public function GetUserRole(){
        return $this->user->roles();
    }

    /**
     * Returning an user by its email address. Method used by the social authentication
     */
    public function GetUserByEmail($email){
        return $this->user->where('email',$email)->get()->first();
    }

    public function GetAllUserPhotos(){
        $this->user->photos();
    }

    /**
     * Returning an user profile picture.
     */
    public function GetUserProfilePhotoByUserId(){
        $this->user->photos()->where('is_profile',true)->get();
    }

    /**
     * Authenticating user
     */
    public function AuthenticateUser($user){
        Auth::login($user);
    }

    /**
     * Creates a new user
     * @param $user
     * @param $provider
     * @return static
     */
    public function Create($user,$provider){
        $user['role_id'] = 1;
        return $this->user->create($user);
    }

    /**
     * @param $user
     * @param $social_provider
     * @return static
     */
    public function CreateSocial($user,$social_provider){
        $user['role_id'] = 1;
        return $this->user->create([
            'name' => $user->name,
            'email' => $user->email,
            'provider_token' => $user->token,
            'provider' => $social_provider,
            'provider_id' => $user->id,
            'avatar' => $user->avatar,
            'role_id' => 1,
        ]);
    }
    /**
     * Returning the Authenticated user
     */
    public function GetAuthenticatedUser(){
        return Auth::user();
    }

    public function LoginAttempt($credentials,UserLoginRequest $request){
        return Auth::attempt($credentials, $request->has('remember'));
    }

    /**
     * * Handle a login request to the application.
     * @param UserLoginRequest $request
     * @return \Illuminate\Http\RedirectResponse|string
     */
    public function handlesLoginRequest(UserLoginRequest $request)
    {
        // If the class is using the ThrottlesLogins trait, we can automatically throttle
        // the login attempts for this application. We'll key this by the username and
        // the IP address of the client making these requests into this application.
        $throttles = $this->isUsingThrottlesLoginsTrait();

        if ($throttles && $this->hasTooManyLoginAttempts($request)) {
            return $this->sendLockoutResponse($request);
        }

        $credentials = $this->getCredentials($request);

        if ($this->LoginAttempt($credentials,$request)) {
            return $this->handleUserWasAuthenticated($request, $throttles);
        }

        // If the login attempt was unsuccessful we will increment the number of attempts
        // to login and redirect the user back to the login form. Of course, when this
        // user surpasses their maximum number of attempts they will get locked out.
        if ($throttles) {
            $this->incrementLoginAttempts($request);
        }
        /*return redirect($this->loginPath())
            ->withInput($request->only($this->loginUsername(), 'remember'))
            ->withErrors([
                $this->loginUsername() => $this->getFailedLoginMessage(),
            ]);*/
        echo json_encode(array('status' => "false",'loginFail' => 'Login e/ou senha inválidos.'));
    }

    /**
     * Sends the response after a user was authenticated
     * @param UserLoginRequest $request
     * @param $throttles
     * @return string
     */
    protected function handleUserWasAuthenticated(UserLoginRequest $request, $throttles)
    {
        if ($throttles) {
            $this->clearLoginAttempts($request);
        }

        if (method_exists($this, 'authenticated')) {
            return $this->authenticated($request, $this->GetAuthenticatedUser());
        }

        //return redirect()->intended($this->redirectPath());
        $redirectUrl = $this->getRedirectUrl();
        echo json_encode(array("status" => "true","returnUrl" => $redirectUrl));
    }

    public function getRedirectUrl(){
        $redirectUrl = Session::get('url.intended');
        if($redirectUrl == null || $redirectUrl == ""){
            $redirectUrl = "perfil";
        }
        Session::forget('url.intended');
        return $redirectUrl;
    }

    /**
     * Redirect the user after determining they are locked out.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    protected function sendLockoutResponse(UserLoginRequest $request)
    {
        $seconds = app(RateLimiter::class)->availableIn(
            $this->getThrottleKey($request)
        );

        return redirect()->back()
            ->withInput($request->only($this->loginUsername(), 'remember'))
            ->withErrors([
                $this->loginUsername() => $this->getLockoutErrorMessage($seconds),
            ]);
    }

    /**
     * Get the throttle key for the given request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string
     */
    protected function getThrottleKey(UserLoginRequest $request)
    {
        return mb_strtolower($request->input($this->loginUsername())).'|'.$request->ip();
    }

    public function UpdateUserProfile(UserUpdateProfileRequest $request){
        $params = [
            "name" => $request->name,
            "last_name" => $request->last_name,
            "zip" => $request->zip,
            "city" => $request->city,
            "state" => $request->state,
            "nickname" => $request->nickname,
            "birth_date" => $request->birth_date,
            "birth_date_update_at" => date('Y-m-d h:i:s', time())
        ];
        $userToSave = $this->GetAuthenticatedUser();
        $userToSave->update($params);
        return $userToSave;
    }

    public function CreateFromPlanosEPrecos(PlanosPrecosRequest $request){
        $userToSave = [
            'name'=>$request->input('name'),
            'last_name'=>$request->input('last_name'),
            'email'=>$request->input('email'),
            'password'=>bcrypt($request->input('password')),
            'password_confirmation'=>bcrypt($request->input('password')),
            //'notification' => array_key_exists('notification',$request->input())? 1 : 0,
            'notification' => 1
        ];
        return $this->Create($userToSave,"evolme");
    }

}