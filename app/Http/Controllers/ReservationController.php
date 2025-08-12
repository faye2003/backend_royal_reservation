<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Reservation\StoreReservationRequest;
use App\Http\Requests\Reservation\UpdateReservationRequest;
use App\Http\Resources\ReservationResource;
use App\Http\Resources\ReservationCollection;
use App\Models\Reservation;
use App\Services\ReservationService;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    public function __construct(private ReservationService $reservationService) {}

    public function index(Request $request)
    {
        $reservations = Reservation::query()
            ->when($request->filled('post_id'), fn($q) => $q->where('post_id', $request->post_id))
            ->when($request->filled('user_id'), fn($q) => $q->where('user_id', $request->user_id))
            ->latest('id')
            ->paginate($request->integer('per_page', 15));

        return ReservationResource::collection($reservations);
    }

    public function store(StoreReservationRequest $request)
    {
        $reservation = $this->reservationService->create($request->validated());
        return new ReservationResource($reservation);
    }

    public function show(Reservation $reservation)
    {
        return new ReservationResource($reservation);
    }

    public function update(UpdateReservationRequest $request, Reservation $reservation)
    {
        $reservation = $this->reservationService->update($reservation, $request->validated());
        return new ReservationResource($reservation);
    }

    public function destroy(Reservation $reservation)
    {
        $reservation->delete();
        return response()->noContent();
    }
}
