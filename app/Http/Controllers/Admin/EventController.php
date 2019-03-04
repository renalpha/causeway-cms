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
        return view('admin.events.create');
    }

    /**
     * @param Request $request
     * @param CalendarItem $calendarItem
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Request $request, CalendarItem $calendarItem)
    {
        return view('admin.events.update', [
            'calendarItem' => $calendarItem,
        ]);
    }

    /**
     * @param PostEventRequest $request
     * @param CalendarItem|null $calendarItem
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(PostEventRequest $request, CalendarItem $calendarItem = null)
    {
        $event = $this->eventService->updateOrCreate([
            'id' => $calendarItem->id ?? null,
        ], $request->only([
            'name',
            'start_datetime',
            'end_datetime',
        ]));

        return redirect()
            ->back();
    }

    /**
     * @param PostEventRequest $request
     * @param CalendarItem $calendarItem
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(PostEventRequest $request, CalendarItem $calendarItem)
    {
        return $this->store($request, $calendarItem);
    }

    /**
     * @param Request $request
     * @param CalendarItem $calendarItem
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function removeEvent(Request $request, CalendarItem $calendarItem)
    {
        $calendarItem->delete();

        return redirect()
            ->back();
    }

    /**
     * Get Datatables.
     *
     * @return mixed
     * @throws \Exception
     */
    public function getAjaxPages()
    {
        $events = CalendarItem::get();

        return Datatables::of($events)
            ->addColumn('name', function ($row) {
                return $row->name;
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