<?php

namespace App\Http\Controllers\Admin;

use App\Models\{
    Event,
    EventRegister
};
use App\Services\EventService;
use App\Http\Controllers\BaseController;
use App\Http\Requests\EventRequest;
use Illuminate\Http\Request;

class EventListController extends BaseController
{
    protected $title = 'Event List';

    private $baseView = 'pages.admin.event-list.';
    private $eventService;

    public function __construct(EventService $eventService)
    {
        $this->eventService = $eventService;
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
                'records' => $this->eventService->getEventIncomming(),
            ])
        );
    }

    public function show(Event $event)
    {
        return view(
            $this->baseView . 'show',
            $this->getData([
                'record' => $event,
            ])
        );
    }

    public function absen(Request $request, Event $event)
    {
        try {
            $eventRegister = new EventRegister();

            $eventRegister->user_id = auth()->user()->id;
            $eventRegister->event_id = $event->id;
            $eventRegister->save();

            return redirect()
                ->route('admin.event-list.show', $event->id)
                ->with('success', 'Anda berhasil absen pada kegiatan ini');
        } catch (\Throwable $th) {
            return redirect()
                ->route('admin.event-list.show', $event->id)
                ->with('danger', $th->getMessage());
        };
    }
}
