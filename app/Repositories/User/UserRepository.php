<?php

namespace App\Repositories\User;

use App\Models\{User, SocialUser};
use Illuminate\Database\Eloquent\Model;

class UserRepository implements UserRepositoryInterface
{
    /**
     * Find user by email
     *
     * @param string $email
     * @return mixed
     */
    public function findByEmail(string $email): mixed
    {
        return User::where(['email' => $email])->first();
    }

    /**
     * Store user information.
     *
     * @param array $attr
     * @return mixed
     */
    public function store(array $attr): mixed
    {
        return User::create($attr);
    }

    /**
     * Store provider information of social user;
     *
     * @param User $user
     * @param String $providerName
     * @param String $providerId
     * @return Model
     */
    public function storeProviderUser(User $user, string $providerName, string $providerId): Model
    {
        return $user->socialUsers()->create([
            'provider_name' => $providerName,
            'provider_id' => $providerId
        ]);
    }

    /**
     * Find social user by provider name & provider id
     *
     * @param string $providerName
     * @param String $providerId
     * @return mixed
     */
    public function findByProvider(string $providerName, string $providerId): mixed
    {
        return SocialUser::where([
            'provider_name' => $providerName,
            'provider_id' => $providerId
        ])->first();
    }
}
