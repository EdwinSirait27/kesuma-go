<?php

namespace App\Policies;

use App\Models\User;

class ListAkunSiswaPolicy
{
    /**
     * Determine whether the user can create ListAkunSiswa.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->hakakses === 'Siswa';
    }
}
