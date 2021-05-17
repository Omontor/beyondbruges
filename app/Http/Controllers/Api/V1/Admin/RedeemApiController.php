<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreRedeemRequest;
use App\Http\Requests\UpdateRedeemRequest;
use App\Http\Resources\Admin\RedeemResource;
use App\Models\Redeem;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RedeemApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('redeem_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new RedeemResource(Redeem::with(['user', 'prize'])->get());
    }

    public function store(StoreRedeemRequest $request)
    {
        $redeem = Redeem::create($request->all());

        return (new RedeemResource($redeem))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Redeem $redeem)
    {
        abort_if(Gate::denies('redeem_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new RedeemResource($redeem->load(['user', 'prize']));
    }

    public function update(UpdateRedeemRequest $request, Redeem $redeem)
    {
        $redeem->update($request->all());

        return (new RedeemResource($redeem))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Redeem $redeem)
    {
        abort_if(Gate::denies('redeem_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $redeem->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
