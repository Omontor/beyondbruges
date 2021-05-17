@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.qrCode.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.qr-codes.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.qrCode.fields.id') }}
                        </th>
                        <td>
                            {{ $qrCode->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.qrCode.fields.transaction_total') }}
                        </th>
                        <td>
                            {{ $qrCode->transaction_total }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.qrCode.fields.issued_bryghia') }}
                        </th>
                        <td>
                            {{ $qrCode->issued_bryghia }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.qrCode.fields.partner') }}
                        </th>
                        <td>
                            {{ $qrCode->partner->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.qrCode.fields.user') }}
                        </th>
                        <td>
                            {{ $qrCode->user->name ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.qr-codes.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection