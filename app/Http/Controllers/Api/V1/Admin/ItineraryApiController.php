<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreItineraryRequest;
use App\Http\Requests\UpdateItineraryRequest;
use App\Http\Resources\Admin\ItineraryResource;
use App\Models\Itinerary;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ItineraryApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('itinerary_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new ItineraryResource(Itinerary::with(['landmarks'])->get());
    }

    public function store(StoreItineraryRequest $request)
    {
        $itinerary = Itinerary::create($request->all());
        $itinerary->landmarks()->sync($request->input('landmarks', []));

        return (new ItineraryResource($itinerary))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Itinerary $itinerary)
    {
        abort_if(Gate::denies('itinerary_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new ItineraryResource($itinerary->load(['landmarks']));
    }

    public function update(UpdateItineraryRequest $request, Itinerary $itinerary)
    {
        $itinerary->update($request->all());
        $itinerary->landmarks()->sync($request->input('landmarks', []));

        return (new ItineraryResource($itinerary))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Itinerary $itinerary)
    {
        abort_if(Gate::denies('itinerary_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $itinerary->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
