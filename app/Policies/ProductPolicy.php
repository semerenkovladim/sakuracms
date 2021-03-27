<?php

namespace App\Policies;

use App\Models\Product;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class ProductPolicy
{
    use HandlesAuthorization;


    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return ($user->role->title === 'Manager' || $user->role->title === 'Administrator')
            ? Response::allow()
            : Response::deny('You do not has rights on this action.');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Product  $product
     * @return mixed
     */
    public function update(User $user, Product $product)
    {
        return ($user->role->title === 'Manager' || $user->role->title === 'Administrator')
            ? Response::allow()
            : Response::deny('You do not has rights on this action.');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Product  $product
     * @return mixed
     */
    public function delete(User $user, Product $product)
    {
        return ($user->role->title === 'Manager' || $user->role->title === 'Administrator')
            ? Response::allow()
            : Response::deny('You do not has rights on this action.');
    }
}
