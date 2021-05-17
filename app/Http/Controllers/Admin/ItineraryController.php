<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyItineraryRequest;
use App\Http\Requests\StoreItineraryRequest;
use App\Http\Requests\UpdateItineraryRequest;
use App\Models\Itinerary;
use App\Models\Location;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ItineraryController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('itinerary_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $itineraries = Itinerary::with(['locations'])->get();

        $locations = Location::get();

        return view('admin.itineraries.index', compact('itineraries', 'locations'));
    }

    public function create()
    {
        abort_if(Gate::denies('itinerary_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $locations = Location::all()->pluck('name', 'id');

        return view('admin.itineraries.create', compact('locations'));
    }

    public function store(StoreItineraryRequest $request)
    {
        $itinerary = Itinerary::create($request->all());
        $itinerary->locations()->sync($request->input('locations', []));

        return redirect()->route('admin.itineraries.index');
    }

    public function edit(Itinerary $itinerary)
    {
        abort_if(Gate::denies('itinerary_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $locations = Location::all()->pluck('name', 'id');

        $itinerary->load('locations');

        return view('admin.itineraries.edit', compact('locations', 'itinerary'));
    }

    public function update(UpdateItineraryRequest $request, Itinerary $itinerary)
    {
        $itinerary->update($request->all());
        $itinerary->locations()->sync($request->input('locations', []));

        return redirect()->route('admin.itineraries.index');
    }

    public function show(Itinerary $itinerary)
    {
        abort_if(Gate::denies('itinerary_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $itinerary->load('locations');

        return view('admin.itineraries.show', compact('itinerary'));
    }

    public function destroy(Itinerary $itinerary)
    {
        abort_if(Gate::denies('itinerary_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $itinerary->delete();

        return back();
    }

    public function massDestroy(MassDestroyItineraryRequest $request)
    {
        Itinerary::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
