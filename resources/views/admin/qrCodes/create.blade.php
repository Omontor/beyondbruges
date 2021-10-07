@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.qrCode.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.qr-codes.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="transaction_total">{{ trans('cruds.qrCode.fields.transaction_total') }}</label>
                <input class="form-control {{ $errors->has('transaction_total') ? 'is-invalid' : '' }}" type="number" name="transaction_total" id="transaction_total" value="{{ old('transaction_total', '') }}" step="1" required>
                @if($errors->has('transaction_total'))
                    <span class="text-danger">{{ $errors->first('transaction_total') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.qrCode.fields.transaction_total_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="issued_bryghia">{{ trans('cruds.qrCode.fields.issued_bryghia') }}</label>
                <input class="form-control {{ $errors->has('issued_bryghia') ? 'is-invalid' : '' }}" type="number" name="issued_bryghia" id="issued_bryghia" value="{{ old('issued_bryghia', '') }}" step="1" required>
                @if($errors->has('issued_bryghia'))
                    <span class="text-danger">{{ $errors->first('issued_bryghia') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.qrCode.fields.issued_bryghia_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="partner_id">{{ trans('cruds.qrCode.fields.partner') }}</label>
                <select class="form-control select2 {{ $errors->has('partner') ? 'is-invalid' : '' }}" name="partner_id" id="partner_id">
                    @foreach($partners as $id => $entry)
                        <option value="{{ $id }}" {{ old('partner_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('partner'))
                    <span class="text-danger">{{ $errors->first('partner') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.qrCode.fields.partner_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="user_id">{{ trans('cruds.qrCode.fields.user') }}</label>
                <select class="form-control select2 {{ $errors->has('user') ? 'is-invalid' : '' }}" name="user_id" id="user_id">
                    @foreach($users as $id => $entry)
                        <option value="{{ $id }}" {{ old('user_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('user'))
                    <span class="text-danger">{{ $errors->first('user') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.qrCode.fields.user_helper') }}</span>
            </div>
            <div class="form-group">
                <button class="btn btn-danger" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>
        </form>
    </div>
</div>



@endsection