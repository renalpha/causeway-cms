<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\PostEventRequest;
use Domain\Entities\Event\CalendarItem;
use Domain\Services\EventService;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

/**
 * Class EventController
 * @package App\Http\Controllers\Admin
 */
class EventController extends Controller
{
    /**
     * @var EventService
     */
    protected $eventService;

    /**
     * EventController constructor.
     * @param EventService $eventService
     */
    public function __construct(EventService $eventService)
    {
        $this->eventService = $eventService;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('admin.events.index');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('admin.events.new');
    }

    /**
     * @param Request $request
     * @param CalendarItem $event
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Request $request, CalendarItem $event)
    {
        return view('admin.events.update', [
            'event' => $event,
        ]);
    }

    /**
     * @param PostEventRequest $request
     * @param CalendarItem|null $event
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(PostEventRequest $request, CalendarItem $event = null)
    {
        $this->eventService->updateOrCreate([
            'id' => $event->id ?? null,
        ], $request->only([
            'title',
            'slug',
            'description',
            'user_id',
            'start_datetime',
            'end_datetime',
        ]));

        return redirect()
            ->back();
    }

    /**
     * @param PostEventRequest $request
     * @param CalendarItem $event
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(PostEventRequest $request, CalendarItem $event)
    {
        return $this->store($request, $event);
    }

    /**
     * @param Request $request
     * @param CalendarItem $event
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function removeEvent(Request $request, CalendarItem $event)
    {
        $event->delete();

        return redirect()
            ->back();
    }

    /**
     * Get Datatables.
     *
     * @return mixed
     * @throws \Exception
     */
    public function getAjaxEvents()
    {
        $events = CalendarItem::get();

        return Datatables::of($events)
            ->addColumn('title', function ($row) {
                return $row->title;
            })
            ->addColumn('start_datetime', function ($row) {
                return $row->start_datetime;
            })
            ->addColumn('end_datetime', function ($row) {
                return $row->end_datetime;
            })
            ->addColumn('manage', function ($row) {
                return '<a href="' . route('admin.events.update', ['id' => $row->id]) . '" class="btn btn-sm btn-warning">Edit</a>
                        <a href="' . route('admin.events.remove', ['id' => $row->id]) . '" class="btn btn-sm btn-danger">Remove</a>
                        ';
            })
            ->rawColumns(['name', 'start_datetime', 'end_datetime', 'manage'])
            ->make(true);
    }

}