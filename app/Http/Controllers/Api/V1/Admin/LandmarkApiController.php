<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StoreLandmarkRequest;
use App\Http\Requests\UpdateLandmarkRequest;
use App\Http\Resources\Admin\LandmarkResource;
use App\Models\Landmark;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class LandmarkApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('landmark_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new LandmarkResource(Landmark::all());
    }

    public function store(StoreLandmarkRequest $request)
    {
        $landmark = Landmark::create($request->all());

        if ($request->input('gallery', false)) {
            $landmark->addMedia(storage_path('tmp/uploads/' . basename($request->input('gallery'))))->toMediaCollection('gallery');
        }

        return (new LandmarkResource($landmark))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Landmark $landmark)
    {
        abort_if(Gate::denies('landmark_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new LandmarkResource($landmark);
    }

    public function update(UpdateLandmarkRequest $request, Landmark $landmark)
    {
        $landmark->update($request->all());

        if ($request->input('gallery', false)) {
            if (!$landmark->gallery || $request->input('gallery') !== $landmark->gallery->file_name) {
                if ($landmark->gallery) {
                    $landmark->gallery->delete();
                }
                $landmark->addMedia(storage_path('tmp/uploads/' . basename($request->input('gallery'))))->toMediaCollection('gallery');
            }
        } elseif ($landmark->gallery) {
            $landmark->gallery->delete();
        }

        return (new LandmarkResource($landmark))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Landmark $landmark)
    {
        abort_if(Gate::denies('landmark_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $landmark->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
