<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyRedeemRequest;
use App\Http\Requests\StoreRedeemRequest;
use App\Http\Requests\UpdateRedeemRequest;
use App\Models\Prize;
use App\Models\Redeem;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RedeemController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('redeem_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $redeems = Redeem::with(['user', 'prize'])->get();

        $users = User::get();

        $prizes = Prize::get();

        return view('admin.redeems.index', compact('redeems', 'users', 'prizes'));
    }

    public function create()
    {
        abort_if(Gate::denies('redeem_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $prizes = Prize::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.redeems.create', compact('users', 'prizes'));
    }

    public function store(StoreRedeemRequest $request)
    {
        $redeem = Redeem::create($request->all());

        return redirect()->route('admin.redeems.index');
    }

    public function edit(Redeem $redeem)
    {
        abort_if(Gate::denies('redeem_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $prizes = Prize::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $redeem->load('user', 'prize');

        return view('admin.redeems.edit', compact('users', 'prizes', 'redeem'));
    }

    public function update(UpdateRedeemRequest $request, Redeem $redeem)
    {
        $redeem->update($request->all());

        return redirect()->route('admin.redeems.index');
    }

    public function show(Redeem $redeem)
    {
        abort_if(Gate::denies('redeem_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $redeem->load('user', 'prize');

        return view('admin.redeems.show', compact('redeem'));
    }

    public function destroy(Redeem $redeem)
    {
        abort_if(Gate::denies('redeem_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $redeem->delete();

        return back();
    }

    public function massDestroy(MassDestroyRedeemRequest $request)
    {
        Redeem::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
