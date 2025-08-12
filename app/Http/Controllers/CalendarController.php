<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Calendar\StoreCalendarRequest;
use App\Http\Requests\Calendar\UpdateCalendarRequest;
use App\Http\Resources\CalendarResource;
use App\Models\Calendar;
use App\Services\CalendarService;
use Illuminate\Http\Request;

class CalendarController extends Controller
{
    public function __construct(private CalendarService $calendarService) {}

    public function index(Request $request)
    {
        $items = Calendar::query()
            ->when($request->filled('annonce_id'), fn($q) => $q->where('annonce_id', $request->annonce_id))
            ->when($request->filled('from'), fn($q) => $q->whereDate('date', '>=', $request->date('from')))
            ->when($request->filled('to'), fn($q) => $q->whereDate('date', '<=', $request->date('to')))
            ->orderBy('date')
            ->paginate($request->integer('per_page', 31));

        return CalendarResource::collection($items);
    }

    public function store(StoreCalendarRequest $request)
    {
        $item = $this->calendarService->upsert($request->validated());
        return new CalendarResource($item);
    }

    public function show(Calendar $calendar)
    {
        return new CalendarResource($calendar);
    }

    public function update(UpdateCalendarRequest $request, Calendar $calendar)
    {
        $calendar->update($request->validated());
        return new CalendarResource($calendar);
    }

    public function destroy(Calendar $calendar)
    {
        $calendar->delete();
        return response()->noContent();
    }

    // Endpoints pratiques
    public function block(Request $request)
    {
        $data = $request->validate([
            'annonce_id' => ['required','exists:annonces,id'],
            'date'       => ['required','date'],
        ]);
        $item = $this->calendarService->upsert($data + ['est_bloque' => true]);
        return new CalendarResource($item);
    }

    public function unblock(Request $request)
    {
        $data = $request->validate([
            'annonce_id' => ['required','exists:annonces,id'],
            'date'       => ['required','date'],
        ]);
        $item = $this->calendarService->upsert($data + ['est_bloque' => false]);
        return new CalendarResource($item);
    }
}
