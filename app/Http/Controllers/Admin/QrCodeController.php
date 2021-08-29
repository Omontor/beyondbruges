<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyQrCodeRequest;
use App\Http\Requests\StoreQrCodeRequest;
use App\Http\Requests\UpdateQrCodeRequest;
use App\Models\Partner;
use App\Models\QrCode;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class QrCodeController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('qr_code_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $qrCodes = QrCode::with(['partner', 'user'])->get();

        $partners = Partner::get();

        $users = User::get();

        return view('admin.qrCodes.index', compact('qrCodes', 'partners', 'users'));
    }

    public function create()
    {
        abort_if(Gate::denies('qr_code_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $partners = Partner::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $users = User::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.qrCodes.create', compact('partners', 'users'));
    }

    public function store(StoreQrCodeRequest $request)
    {

        $qrCode = QrCode::create($request->all());

        return redirect()->route('admin.qr-codes.index');
    }

    public function edit(QrCode $qrCode)
    {
        abort_if(Gate::denies('qr_code_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $partners = Partner::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $users = User::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $qrCode->load('partner', 'user');

        return view('admin.qrCodes.edit', compact('partners', 'users', 'qrCode'));
    }

    public function update(UpdateQrCodeRequest $request, QrCode $qrCode)
    {
        $qrCode->update($request->all());

        return redirect()->route('admin.qr-codes.index');
    }

    public function show(QrCode $qrCode)
    {
        abort_if(Gate::denies('qr_code_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $qrCode->load('partner', 'user');

        return view('admin.qrCodes.show', compact('qrCode'));
    }

    public function destroy(QrCode $qrCode)
    {
        abort_if(Gate::denies('qr_code_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $qrCode->delete();

        return back();
    }

    public function massDestroy(MassDestroyQrCodeRequest $request)
    {
        QrCode::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function newtransaction ($userid){

        $user = User::findOrFail($userid);
        return view('admin.qrCodes.transaction', compact('user'));

    }
}
