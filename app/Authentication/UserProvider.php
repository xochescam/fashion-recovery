<?php

namespace App\Authentication;
use Illuminate\Support\Str;
use Illuminate\Contracts\Auth\UserProvider as IlluminateUserProvider;
use Illuminate\Contracts\Auth\Authenticatable as UserContract;
use Illuminate\Contracts\Hashing\Hasher as HasherContract;
use Illuminate\Database\ConnectionInterface;

use Illuminate\Auth\GenericUser;

class UserProvider implements IlluminateUserProvider
{

    /**
     * Create a new database user provider.
     *
     * @param  \Illuminate\Database\ConnectionInterface  $conn
     * @param  \Illuminate\Contracts\Hashing\Hasher  $hasher
     * @param  string  $table
     * @return void
     */
    public function __construct(HasherContract $hasher, $model)
    {
        $this->model = $model;
        $this->hasher = $hasher;
    }

    /**
     * @param    mixed  $identifier
     * @return  \Illuminate\Contracts\Auth\Authenticatable|null
     */
    public function retrieveById($identifier)
    {
        // Get and return a user by their unique identifier
    }

    /**
     * @param    mixed   $identifier
     * @param    string  $token
     * @return  \Illuminate\Contracts\Auth\Authenticatable|null
     */
    public function retrieveByToken($identifier, $token)
    {
        // Get and return a user by their unique identifier and "remember me" token
    }

    /**
     * @param    \Illuminate\Contracts\Auth\Authenticatable  $user
     * @param    string  $token
     * @return  void
     */
    public function updateRememberToken(UserContract $user, $token)
    {
        $this->conn->table($this->table)
                ->where($user->getAuthIdentifierName(), $user->getAuthIdentifier())
                ->update([$user->getRememberTokenName() => $token]);
    }

    /**
     * Retrieve a user by the given credentials.
     *
     * @param    array  $credentials
     * @return  \Illuminate\Contracts\Auth\Authenticatable|null
     */
    public function retrieveByCredentials(array $credentials)
    {
        if (empty($credentials) ||
           (count($credentials) === 1 &&
            array_key_exists('Password', $credentials))) {
            return;
        }

        // First we will add each credential element to the query as a where clause.
        // Then we can execute the query and, if we found a user, return it in a
        // generic "user" object that will be utilized by the Guard instances.
        $query = $this->createModel()->newQuery();

        foreach ($credentials as $key => $value) {
            if (! Str::contains($key, 'Password')) {

                $query->where($key, $value);
            }
        }

        $user = $query->first();

        return $this->getGenericUser($user);
    }

    /**
     * Validate a user against the given credentials.
     *
     * @param  \Illuminate\Contracts\Auth\Authenticatable  $user
     * @param  array  $credentials
     * @return bool
     */
    public function validateCredentials(UserContract $user, array $credentials)
    {
        return $this->hasher->check(
            $credentials['Password'], $user->getAuthPassword()
        );
    }

    /**
     * Create a new instance of the model.
     *
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function createModel() {
        $class = '\\' . ltrim($this->model, '\\');
        return new $class;
    }

    /**
     * Get the generic user.
     *
     * @param  mixed  $user
     * @return \Illuminate\Auth\GenericUser|null
     */
    protected function getGenericUser($user)
    {
        //dd($user);
        if (! is_null($user)) {
            return new GenericUser((array) $user);
        }
    }
}