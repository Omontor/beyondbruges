<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyPrizeRequest;
use App\Http\Requests\StorePrizeRequest;
use App\Http\Requests\UpdatePrizeRequest;
use App\Models\Prize;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class PrizeController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('prize_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $prizes = Prize::with(['media'])->get();

        return view('admin.prizes.index', compact('prizes'));
    }

    public function create()
    {
        abort_if(Gate::denies('prize_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.prizes.create');
    }

    public function store(StorePrizeRequest $request)
    {
        $prize = Prize::create($request->all());

        if ($request->input('thumb_image', false)) {
            $prize->addMedia(storage_path('tmp/uploads/' . basename($request->input('thumb_image'))))->toMediaCollection('thumb_image');
        }

        foreach ($request->input('gallery', []) as $file) {
            $prize->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('gallery');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $prize->id]);
        }

        return redirect()->route('admin.prizes.index');
    }

    public function edit(Prize $prize)
    {
        abort_if(Gate::denies('prize_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.prizes.edit', compact('prize'));
    }

    public function update(UpdatePrizeRequest $request, Prize $prize)
    {
        $prize->update($request->all());

        if ($request->input('thumb_image', false)) {
            if (!$prize->thumb_image || $request->input('thumb_image') !== $prize->thumb_image->file_name) {
                if ($prize->thumb_image) {
                    $prize->thumb_image->delete();
                }
                $prize->addMedia(storage_path('tmp/uploads/' . basename($request->input('thumb_image'))))->toMediaCollection('thumb_image');
            }
        } elseif ($prize->thumb_image) {
            $prize->thumb_image->delete();
        }

        if (count($prize->gallery) > 0) {
            foreach ($prize->gallery as $media) {
                if (!in_array($media->file_name, $request->input('gallery', []))) {
                    $media->delete();
                }
            }
        }
        $media = $prize->gallery->pluck('file_name')->toArray();
        foreach ($request->input('gallery', []) as $file) {
            if (count($media) === 0 || !in_array($file, $media)) {
                $prize->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('gallery');
            }
        }

        return redirect()->route('admin.prizes.index');
    }

    public function show(Prize $prize)
    {
        abort_if(Gate::denies('prize_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $prize->load('prizeRedeems');

        return view('admin.prizes.show', compact('prize'));
    }

    public function destroy(Prize $prize)
    {
        abort_if(Gate::denies('prize_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $prize->delete();

        return back();
    }

    public function massDestroy(MassDestroyPrizeRequest $request)
    {
        Prize::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('prize_create') && Gate::denies('prize_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new Prize();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
