<?php

namespace App\Http\Controllers\Admin;

use App\Models\{
    User,
    UserDetail
};
use App\Services\UserService;
use App\Http\Controllers\BaseController;
use App\Http\Requests\AnggotaRequest;
use Illuminate\Http\Request;

class AnggotaController extends BaseController
{
    protected $title = 'Anggota List';

    private $baseView = 'pages.admin.anggota.';
    private $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view(
            $this->baseView . 'index',
            $this->getData([
                'records' => $this->userService->getRecordMembers(),
            ])
        );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view(
            $this->baseView . 'form',
            $this->getData([
                'record' => new User(),
            ])
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AnggotaRequest $request)
    {
        $inputs = $request->validated();
        $inputs['role_id'] = User::USER_ANGGOTA;

        try {
            $user = new User();

            $user->saveFromInputs($inputs);
            $user->savePassword($inputs);

            $userDetail = new UserDetail();
            $inputs['user_id'] = $user->id;
            $userDetail->saveFromInputs($inputs);

            if (isset($inputs['photo'])) {
                $photoUrl = cloudinary()->upload(
                    $request->file('photo')->getRealPath(),
                    [
                        'folder' => 'photo'
                    ]
                )->getSecurePath();

                $userDetail->savePhotoUrl($photoUrl);
            }

            return redirect()
                ->route('admin.anggota.index')
                ->with('success', 'User berhasil di simpan');
        } catch (\Throwable $th) {
            return redirect()
                ->route('admin.anggota.create')
                ->with('danger', $th->getMessage());
        };
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $anggotum)
    {
        return view(
            $this->baseView . 'form',
            $this->getData([
                'record' => $anggotum,
            ])
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(AnggotaRequest $request, User $anggotum)
    {
        $inputs = $request->validated();

        try {
            $anggotum->saveFromInputs($inputs);

            if ($inputs['password']) {
                $anggotum->savePassword($inputs);
            }

            $inputs['user_id'] = $anggotum->id;
            $anggotum->userDetail->saveFromInputs($inputs);

            if (isset($inputs['photo'])) {
                $photoUrl = cloudinary()->upload(
                    $request->file('photo')->getRealPath(),
                    [
                        'folder' => 'photo'
                    ]
                )->getSecurePath();

                $anggotum->userDetail->savePhotoUrl($photoUrl);
            }

            return redirect()
                ->route('admin.anggota.index')
                ->with('success', 'User berhasil di simpan');
        } catch (\Throwable $th) {
            return redirect()
                ->route('admin.anggota.edit', $anggotum->id)
                ->with('danger', $th->getMessage());
        };
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $anggotum)
    {
        $anggotum->status = false;
        $anggotum->save();

        return redirect()
                ->route('admin.anggota.index')
                ->with('success', 'User berhasil di delete');
    }
}
