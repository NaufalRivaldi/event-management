<?php

namespace App\Http\Controllers\Admin;

use App\Models\{
    User,
    UserDetail
};
use App\Http\Requests\{
    ProfileRequest,
    ProfilePasswordRequest,
};
use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends BaseController
{
    protected $title = 'Profile';

    private $baseView = 'pages.admin.';

    public function index()
    {
        return view(
            $this->baseView . 'profile',
            $this->getData()
        );
    }

    public function update(ProfileRequest $request, User $user)
    {
        $inputs = $request->validated();

        try {
            $user->saveFromInputs($inputs);

            $inputs['user_id'] = $user->id;

            if ($user->isAnggota) {
                if (!$user->userDetail) {
                    $userDetail = new UserDetail();
                    $userDetail->saveFromInputs($inputs);
                } else {
                    $user->userDetail->saveFromInputs($inputs);
                }
            }

            return redirect()
                ->route('admin.profile.index')
                ->with('success', __('Profile berhasil diupdate.'));
        } catch (\Throwable $th) {

            return redirect()
                ->route('admin.profile.index')
                ->with('danger', $th->getMessage());

        }
    }

    public function updatePassword(ProfilePasswordRequest $request, User $user)
    {
        $inputs = $request->validated();

        try {
            if (Hash::check($inputs['current_password'], Auth::user()->password)) {
                $user->password = Hash::make($inputs['new_password']);
                $user->save();

                Auth::logout();

                $request->session()->invalidate();

                $request->session()->regenerateToken();

                return redirect()
                    ->route('login')
                    ->with('success', __('Password sudah update, silahkan lakukan login kembali.'));
            } else {
                return redirect()
                    ->back()
                    ->with('danger', __('Password lama tidak valid!'));
            }
        } catch (\Throwable $th) {
            return redirect()
                    ->back()
                    ->with('danger', $th->getMessage());
        }
    }
}
