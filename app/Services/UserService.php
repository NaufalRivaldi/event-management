<?php

namespace App\Services;

use App\Models\User;

class UserService
{
    public function getRecordAdmins()
    {
        return User::admin()->active()->get();
    }

    public function getRecordMembers(array $filter = [])
    {
        return User::anggota()
            ->with('userDetail')
            ->active()
            ->when($filter, function ($query) use ($filter){
                if (isset($filter['kesinoman'])) {
                    return $query->whereHas('userDetail', function ($q) use ($filter){
                        $q->where('kesinoman', $filter['kesinoman']);
                    });
                }
            })
            ->get();
    }
}