<?php

namespace Acelle\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use Acelle\Model\User;

class UserPolicy
{
    use HandlesAuthorization;

    public function read(User $user)
    {
        $can = $user->admin->getPermission('user_read') != 'no';

        return $can;
    }

    public function read_all(User $user)
    {
        $can = $user->admin->getPermission('user_read') == 'all';

        return $can;
    }

    public function create(User $user)
    {
        $can = $user->admin->getPermission('user_create') == 'yes';

        return $can;
    }

    public function profile(User $user, User $item)
    {
        return $user->id == $item->id;
    }

    public function update(User $user, User $item)
    {
        $ability = $user->admin->getPermission('user_update');
        $can = $ability == 'all'
                || ($ability == 'own' && $user->id == $item->id);

        return $can;
    }

    public function delete(User $user, User $item)
    {
        $ability = $user->admin->getPermission('user_delete');
        $can = $ability == 'all'
                || ($ability == 'own' && $user->id == $item->id);
        $can = $can && $user->id != $item->id;

        return $can;
    }

    public function customer_access(User $user)
    {
        return is_object($user->customer);
    }

    public function service_access(User $user)
    {
        $service = $user->user_type == 'service_provider' || $user->user_relation == 'both';
        return $service;
    }

    public function client_access(User $user)
    {
        $service = $user->user_type == 'client' || $user->user_type == 'service_provider';
        return $service;
    }

    public function admin_access(User $user)
    {
        return is_object($user->admin);
    }

    public function reseller_access(User $user)
    {
        return is_object($user->reseller);
    }

    public function change_group(User $user)
    {
        $ability = $user->admin->getPermission('user_update');
        $can = $ability == 'all';

        return $can;
    }
}
