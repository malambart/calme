<?php

namespace App\Policies;

use App\User;
use App\Dossier;
use Illuminate\Auth\Access\HandlesAuthorization;

class DossierPolicy
{
    use HandlesAuthorization;
    
    public function before(User $user)
    {   
        if ($user->isSuperAdmin()) {
        return true;
        }
    }
    

    public function show(User $user, Dossier $dossier)
    {
        return $user->id==$dossier->user_id;
    }
}
