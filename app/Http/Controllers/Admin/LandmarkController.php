<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyLandmarkRequest;
use App\Http\Requests\StoreLandmarkRequest;
use App\Http\Requests\UpdateLandmarkRequest;
use App\Models\Landmark;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class LandmarkController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('landmark_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $landmarks = Landmark::with(['media'])->get();

        return view('admin.landmarks.index', compact('landmarks'));
    }

    public function create()
    {
        abort_if(Gate::denies('landmark_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.landmarks.create');
    }

    public function store(StoreLandmarkRequest $request)
    {
        $landmark = Landmark::create($request->all());

        foreach ($request->input('gallery', []) as $file) {
            $landmark->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('gallery');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $landmark->id]);
        }

        return redirect()->route('admin.landmarks.index');
    }

    public function edit(Landmark $landmark)
    {
        abort_if(Gate::denies('landmark_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.landmarks.edit', compact('landmark'));
    }

    public function update(UpdateLandmarkRequest $request, Landmark $landmark)
    {
        $landmark->update($request->all());

        if (count($landmark->gallery) > 0) {
            foreach ($landmark->gallery as $media) {
                if (!in_array($media->file_name, $request->input('gallery', []))) {
                    $media->delete();
                }
            }
        }
        $media = $landmark->gallery->pluck('file_name')->toArray();
        foreach ($request->input('gallery', []) as $file) {
            if (count($media) === 0 || !in_array($file, $media)) {
                $landmark->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('gallery');
            }
        }

        return redirect()->route('admin.landmarks.index');
    }

    public function show(Landmark $landmark)
    {
        abort_if(Gate::denies('landmark_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $landmark->load('landmarkItineraries');

        return view('admin.landmarks.show', compact('landmark'));
    }

    public function destroy(Landmark $landmark)
    {
        abort_if(Gate::denies('landmark_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $landmark->delete();

        return back();
    }

    public function massDestroy(MassDestroyLandmarkRequest $request)
    {
        Landmark::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('landmark_create') && Gate::denies('landmark_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new Landmark();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
