<?php

namespace App\Http\Controllers;

use App\Repositories\UserRepositoryInterface;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class SocialiteController extends Controller
{
    protected $userRepo;

    public function __construct(UserRepositoryInterface $userRepo)
    {
        $this->userRepo = $userRepo;
    }

    public function redirect($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    public function callback($provider)
    {
        try {
            $user = Socialite::driver($provider)->stateless()->user();
        } catch (\Exception $e) {
            return redirect('/');
        }

        $loginUser = $this->userRepo->findExistedUser($user, $provider);
        if (!$loginUser) {
            $loginUser = $this->userRepo->createNewSocialiteUser($user, $provider);
            $this->userRepo->setDefaultUserRole($loginUser);
        }

        // Login to app
        Auth::login($loginUser, true);

        return redirect('/');
    }
}
