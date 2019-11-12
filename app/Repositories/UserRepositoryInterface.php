<?php

namespace App\Repositories;

use App\Models\User;

interface UserRepositoryInterface
{
    /**
     * Find an existed user.
     *
     * @param array $user
     * @param string $provider
     * @return User
     */
    public function findExistedUser($user, $provider);

    /**
     * Create a new socialite user with provider information.
     *
     * @param array $user
     * @param string $provider
     * @return User
     */
    public function createNewSocialiteUser($user, $provider);

    /**
     * Set default role user to a new user.
     *
     * @param $user
     * @return mixed
     */
    public function setDefaultUserRole($user);
}
