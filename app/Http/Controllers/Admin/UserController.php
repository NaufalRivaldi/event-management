<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Services\UserService;
use App\Http\Controllers\BaseController;
use App\Http\Requests\UserRequest;
use Illuminate\Http\Request;

class UserController extends BaseController
{
    protected $title = 'User List';

    private $baseView = 'pages.admin.user.';
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
                'records' => $this->userService->getRecordAdmins(),
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
    public function store(UserRequest $request)
    {
        $inputs = $request->validated();
        $inputs['role_id'] = User::USER_ADMIN;

        try {
            $user = new User();

            $user->saveFromInputs($inputs);
            $user->savePassword($inputs);

            return redirect()
                ->route('admin.users.index')
                ->with('success', 'User berhasil di simpan');
        } catch (\Throwable $th) {
            return redirect()
                ->route('admin.users.create')
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
    public function edit(User $user)
    {
        return view(
            $this->baseView . 'form',
            $this->getData([
                'record' => $user,
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
    public function update(UserRequest $request, User $user)
    {
        $inputs = $request->validated();

        try {
            $user->saveFromInputs($inputs);

            if ($inputs['password']) {
                $user->savePassword($inputs);
            }

            return redirect()
                ->route('admin.users.index')
                ->with('success', 'User berhasil di simpan');
        } catch (\Throwable $th) {
            return redirect()
                ->route('admin.users.create')
                ->with('danger', $th->getMessage());
        };
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();

        return redirect()
                ->route('admin.users.index')
                ->with('success', 'User berhasil di delete');
    }
}
