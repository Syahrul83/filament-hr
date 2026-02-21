<?php

declare(strict_types=1);

namespace App\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use App\Models\Gambar;
use Illuminate\Auth\Access\HandlesAuthorization;

class GambarPolicy
{
    use HandlesAuthorization;
    
    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('ViewAny:Gambar');
    }

    public function view(AuthUser $authUser, Gambar $gambar): bool
    {
        return $authUser->can('View:Gambar');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('Create:Gambar');
    }

    public function update(AuthUser $authUser, Gambar $gambar): bool
    {
        return $authUser->can('Update:Gambar');
    }

    public function delete(AuthUser $authUser, Gambar $gambar): bool
    {
        return $authUser->can('Delete:Gambar');
    }

    public function restore(AuthUser $authUser, Gambar $gambar): bool
    {
        return $authUser->can('Restore:Gambar');
    }

    public function forceDelete(AuthUser $authUser, Gambar $gambar): bool
    {
        return $authUser->can('ForceDelete:Gambar');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('ForceDeleteAny:Gambar');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return $authUser->can('RestoreAny:Gambar');
    }

    public function replicate(AuthUser $authUser, Gambar $gambar): bool
    {
        return $authUser->can('Replicate:Gambar');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('Reorder:Gambar');
    }

}