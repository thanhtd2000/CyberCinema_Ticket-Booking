<?php

namespace App\Policies;

use App\Models\Role;
use App\Models\User;
use App\Models\Product;
use Illuminate\Auth\Access\HandlesAuthorization;

class ProductPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user)
    {
        $role =   Role::where('key', 'danh-sach-san-pham')->where('check', 1)->first();
        return $user->role == 0 || $user->role == ($role == null ? '' : 3);

    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        $role =   Role::where('key', 'them-san-pham')->where('check', 1)->first();
        return $user->role == 0 || $user->role == ($role == null ? '' : 3);

    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Actor  $actor
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user)
    {
        $role =   Role::where('key', 'sua-san-pham')->where('check', 1)->first();
        return $user->role == 0 || $user->role == ($role == null ? '' : 3);

    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Actor  $actor
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user)
    {
        $role =   Role::where('key', 'xoa-san-pham')->where('check', 1)->first();
        return $user->role == 0 || $user->role == ($role == null ? '' : 3);

    }


    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, Product $product)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, Product $product)
    {
        //
    }
}
