<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    public function create(User $user)
    {
        return $user->isAdmin();
    }

    public function update(User $logado, User $alvo)
    {
        if ($logado->isAdmin()){
            return true;
        }

        if ($this->isEspertinho($logado, $alvo)) {
            return false;
        }

        return $logado->id === $alvo->id;
    }

    /**
     * @param \App\User $logado
     * @param \App\User $alvo
     *
     * @return bool
     */
    protected function isEspertinho(User $logado, User $alvo)
    {
        return !$logado->isAdmin() && request('permissoes') == 'administrador' && $logado->id == $alvo->id;
    }
}
