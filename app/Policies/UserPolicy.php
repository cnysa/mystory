<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * User that can login to /administrator
     * TODO: upgrading this feature
     *
     * @param User $user
     * @return bool
     */
    public function login(User $user)
    {
        return $user->id === 1;
    }

    public function actionByQeoQeoUser(User $user)
    {
        return $user->is_qeoqeo_user;
    }
}
