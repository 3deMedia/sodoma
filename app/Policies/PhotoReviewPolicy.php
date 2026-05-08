<?php

namespace App\Policies;

use App\Models\PhotoReview;
use App\Models\Photo;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PhotoReviewPolicy
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
     * @param  \App\Models\PhotoReview  $photoReview
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, PhotoReview $photoReview)
    {
        //
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function AgencyCreatePrFor(User $user,Photo $photo)
    {

    }
    public function EscortCreatePR(User $user,Photo $photo)
    {
        $escort_id = $user->Escort->id;
        return $photo->profile_id === $escort_id and $photo->profile_type === 1;

    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\PhotoReview  $photoReview
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, PhotoReview $photoReview)
    {
        //
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\PhotoReview  $photoReview
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, PhotoReview $photoReview)
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\PhotoReview  $photoReview
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, PhotoReview $photoReview)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\PhotoReview  $photoReview
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, PhotoReview $photoReview)
    {
        //
    }
}
