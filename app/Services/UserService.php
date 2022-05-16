<?php

namespace App\Services;

use App\Models\User;

class UserService
{
    public function getRecordAdmins()
    {
        return User::admin()->active()->get();
    }

    public function getRecordMembers()
    {
        return User::anggota()->active()->get();
    }
}