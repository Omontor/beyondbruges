<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StorePrizeRequest;
use App\Http\Requests\UpdatePrizeRequest;
use App\Http\Resources\Admin\PrizeResource;
use App\Models\Prize;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PrizeApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('prize_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new PrizeResource(Prize::all());
    }

    public function store(StorePrizeRequest $request)
    {
        $prize = Prize::create($request->all());

        if ($request->input('thumb_image', false)) {
            $prize->addMedia(storage_path('tmp/uploads/' . basename($request->input('thumb_image'))))->toMediaCollection('thumb_image');
        }

        if ($request->input('gallery', false)) {
            $prize->addMedia(storage_path('tmp/uploads/' . basename($request->input('gallery'))))->toMediaCollection('gallery');
        }

        return (new PrizeResource($prize))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Prize $prize)
    {
        abort_if(Gate::denies('prize_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new PrizeResource($prize);
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

        if ($request->input('gallery', false)) {
            if (!$prize->gallery || $request->input('gallery') !== $prize->gallery->file_name) {
                if ($prize->gallery) {
                    $prize->gallery->delete();
                }
                $prize->addMedia(storage_path('tmp/uploads/' . basename($request->input('gallery'))))->toMediaCollection('gallery');
            }
        } elseif ($prize->gallery) {
            $prize->gallery->delete();
        }

        return (new PrizeResource($prize))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Prize $prize)
    {
        abort_if(Gate::denies('prize_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $prize->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
