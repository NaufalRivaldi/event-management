<?php

namespace App\Http\Controllers\Admin;

use App\Models\{
    Event,
    EventRegister
};
use App\Services\{
    EventService,
    UserService
};
use App\Http\Controllers\BaseController;
use App\Http\Requests\EventRequest;
use Illuminate\Http\Request;

class EventController extends BaseController
{
    protected $title = 'Event List';

    private $baseView = 'pages.admin.event.';
    private $eventService;
    private $userService;

    public function __construct(
        EventService $eventService,
        UserService $userService
    ) {
        $this->eventService = $eventService;
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
                'records' => $this->eventService->getRecord(),
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
                'record' => new Event(),
            ])
        );
    }

    public function createRegister(Event $event)
    {
        $userIds = [];

        foreach ($event->eventRegisters()->get() as $register) {
            $userIds[] = $register->user_id;
        }

        return view(
            $this->baseView . 'form-register',
            $this->getData([
                'record' => $event,
                'userIds' => $userIds,
                'anggotas' => $this->userService->getRecordMembers()
            ])
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EventRequest $request)
    {
        $inputs = $request->validated();
        $inputs['user_id'] = auth()->user()->id;

        try {
            $event = new Event();

            $event->saveFromInputs($inputs);

            return redirect()
                ->route('admin.events.index')
                ->with('success', 'User berhasil di simpan');
        } catch (\Throwable $th) {
            return redirect()
                ->route('admin.events.create')
                ->with('danger', $th->getMessage());
        };
    }

    public function storeRegister(Request $request, Event $event)
    {
        try {
            $eventRegister = new EventRegister();

            $eventRegister->user_id = $request->user_id;
            $eventRegister->event_id = $event->id;
            $eventRegister->save();

            return redirect()
                ->route('admin.events.show', $event->id)
                ->with('success', 'User berhasil di simpan');
        } catch (\Throwable $th) {
            return redirect()
                ->route('admin.events.register.create', $event->id)
                ->with('danger', $th->getMessage());
        };
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Event $event)
    {
        return view(
            $this->baseView . 'show',
            $this->getData([
                'record' => $event,
            ])
        );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Event $event)
    {
        return view(
            $this->baseView . 'form',
            $this->getData([
                'record' => $event,
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
    public function update(EventRequest $request, Event $event)
    {
        $inputs = $request->validated();

        try {
            $event->saveFromInputs($inputs);

            return redirect()
                ->route('admin.events.index')
                ->with('success', 'User berhasil di simpan');
        } catch (\Throwable $th) {
            return redirect()
                ->route('admin.events.create')
                ->with('danger', $th->getMessage());
        };
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Event $event)
    {
        $event->status = false;
        $event->save();

        return redirect()
                ->route('admin.events.index')
                ->with('success', 'User berhasil di delete');
    }

    public function destroyEventRegister(EventRegister $register)
    {
        $eventId = $register->event_id;

        $register->delete();

        return redirect()
                ->route('admin.events.show', $eventId)
                ->with('success', 'User berhasil di hapus pada event.');
    }
}
