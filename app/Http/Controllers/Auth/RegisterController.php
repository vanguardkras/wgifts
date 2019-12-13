<?php

namespace App\Http\Controllers\Auth;

use App\Gift;
use App\GiftList;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * First list ID for users created lists without registration.
     *
     * @var int
     */
    protected $firstListId;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/list/create';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        /** @noinspection PhpUndefinedMethodInspection */
        $user = User::create([
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);

        if ((session()->has('created'))) {
            $this->createListFromSession($user);
        }

        return $user;
    }

    /**
     * Redirect after registration logic.
     *
     * @return string
     */
    protected function redirectTo()
    {
        if (isset($this->firstListId)) {
            return 'lists/'.$this->firstListId.'/edit_list';
        }

        return $this->redirectTo;
    }

    /**
     * Create a gifts list for just authorized users.
     *
     * @param User $user
     */
    private function createListFromSession(User $user)
    {
        $session = session('created');
        $list = new GiftList;


        $list->user_id = $user->id;
        $list->domain = $session->domain;
        $list->title = $session->title;
        $list->background_id = $session->background_id;
        $list->information = $session->information;
        $list->date = $session->date;
        $list->comment_opt = $session->comment_opt;
        $list->save();

        foreach ($session->gifts as $sgift) {
            $gift = new Gift;
            $gift->gift_list_id = $list->id;
            $gift->name = $sgift->name;
            $gift->save();
        }

        $this->firstListId = $list->id;

        session()->forget('created');
    }
}
