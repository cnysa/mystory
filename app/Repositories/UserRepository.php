<?php

namespace App\Repositories;

use App\Helpers\Cloudinary;
use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Str;

class UserRepository implements UserRepositoryInterface
{
    protected $user;

    /**
     * UserRepository constructor.
     * @param User $user
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * Find an existed user.
     *
     * @param array $user
     * @param string $provider
     * @return User
     */
    public function findExistedUser($user, $provider)
    {
        return $this->user
            ->where([
                'provider' => $provider,
                'provider_id' => $user->getId()])
            ->orWhere(['email' => $user->getEmail()])
            ->first();
    }

    /**
     * Create a new socialite user with provider information.
     *
     * @param array $user
     * @param string $provider
     * @return User
     */
    public function createNewSocialiteUser($user, $provider)
    {
        return $this->user->create([
            'name' => $user->getName(),
            'email' => $user->getEmail(),
            'nickname' => Str::slug($user->getName()) . '-' . Str::random(3),
            'avatar' => app(Cloudinary::class)->upload($user->getAvatar(), 'avatar')['secure_url'],
            'provider' => $provider,
            'provider_id' => $user->getId()
        ]);
    }

    /**
     * Set default role user to a new user.
     *
     * @param $user
     * @return mixed
     */
    public function setDefaultUserRole($user)
    {
        $user->roles()->attach(Role::where('name', 'user')->first());
    }
}
