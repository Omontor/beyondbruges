<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyCouponRedeemRequest;
use App\Http\Requests\StoreCouponRedeemRequest;
use App\Http\Requests\UpdateCouponRedeemRequest;
use App\Models\Coupon;
use App\Models\CouponRedeem;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CouponRedeemController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('coupon_redeem_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $couponRedeems = CouponRedeem::with(['user', 'coupon'])->get();

        return view('admin.couponRedeems.index', compact('couponRedeems'));
    }

    public function create()
    {
        abort_if(Gate::denies('coupon_redeem_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $coupons = Coupon::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.couponRedeems.create', compact('users', 'coupons'));
    }

    public function store(StoreCouponRedeemRequest $request)
    {
        $couponRedeem = CouponRedeem::create($request->all());

        return redirect()->route('admin.coupon-redeems.index');
    }

    public function edit(CouponRedeem $couponRedeem)
    {
        abort_if(Gate::denies('coupon_redeem_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $coupons = Coupon::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $couponRedeem->load('user', 'coupon');

        return view('admin.couponRedeems.edit', compact('users', 'coupons', 'couponRedeem'));
    }

    public function update(UpdateCouponRedeemRequest $request, CouponRedeem $couponRedeem)
    {
        $couponRedeem->update($request->all());

        return redirect()->route('admin.coupon-redeems.index');
    }

    public function show(CouponRedeem $couponRedeem)
    {
        abort_if(Gate::denies('coupon_redeem_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $couponRedeem->load('user', 'coupon');

        return view('admin.couponRedeems.show', compact('couponRedeem'));
    }

    public function destroy(CouponRedeem $couponRedeem)
    {
        abort_if(Gate::denies('coupon_redeem_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $couponRedeem->delete();

        return back();
    }

    public function massDestroy(MassDestroyCouponRedeemRequest $request)
    {
        CouponRedeem::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
