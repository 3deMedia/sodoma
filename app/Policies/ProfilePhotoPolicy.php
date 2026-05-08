<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Photo;
use Illuminate\Auth\Access\HandlesAuthorization;

class PhotoPolicy
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
     * @param  \App\Models\Photo  $photo
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, Photo $photo)
    {
        //
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        //
    }


    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Photo  $photo
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Photo $photo)
    {
        //
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Photo  $photo
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Photo $photo)
    {
        //
    }

    // agencia borra imagen de un perfil propiedad
    public function AgencyDeleteImageFor(User $user, Photo $photo)
    {
        $escorts=$user->Agency->Escorts->pluck('id')->toArray();
       $is_owner=in_array($photo->profile_id, $escorts);
       return $is_owner and $photo->profile_type==1;
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Photo  $photo
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, Photo $photo)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Photo  $photo
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, Photo $photo)
    {
        //
    }
}
