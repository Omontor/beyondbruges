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
                <label class="required" for="transaction_total">{{ trans('cruds.qrCode.fields.transaction_total') }} in Euro</label>
                <input class="form-control {{ $errors->has('transaction_total') ? 'is-invalid' : '' }}" type="float" name="transaction_total" id="transaction_total" value="{{ old('transaction_total', '') }}" step="1" required onchange="myFunction(this.value)">
                @if($errors->has('transaction_total'))
                    <span class="text-danger">{{ $errors->first('transaction_total') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.qrCode.fields.transaction_total_helper') }}</span>
            </div>

<script type="text/javascript"> 
    function myFunction (){
        document.getElementById("issued_bryghia").setAttribute('value', document.getElementById('transaction_total').value * .1);
    } 
</script>

            <div class="form-group">
                <label class="required" for="issued_bryghia">{{ trans('cruds.qrCode.fields.issued_bryghia') }}</label>
                <input class="form-control {{ $errors->has('issued_bryghia') ? 'is-invalid' : '' }}" type="number" name="issued_bryghia" id="issued_bryghia" value="{{ old('issued_bryghia', '') }}" step="1" required readonly="">
                @if($errors->has('issued_bryghia'))
                    <span class="text-danger">{{ $errors->first('issued_bryghia') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.qrCode.fields.issued_bryghia_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="partner_id">{{ trans('cruds.qrCode.fields.partner') }}</label>
                <select class="form-control select2 {{ $errors->has('partner') ? 'is-invalid' : '' }}" name="partner_id" id="partner_id">
                    @foreach(Auth::user()->ownerPartners as $id => $entry)
                        <option value="{{ $entry->id }}" {{ old('partner_id') == $id ? 'selected' : '' }}>{{ $entry->name }}</option>
                    @endforeach
                </select>
                @if($errors->has('partner'))
                    <span class="text-danger">{{ $errors->first('partner') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.qrCode.fields.partner_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="user_id">{{ trans('cruds.qrCode.fields.user') }}</label>
                <input type="text" name="user_id" value="{{$user->id}}" hidden>
                <h3>{{$user->name}}</h3>
                <h3>{{$user->email}}</h3>
                <h3>{{$user->score}}</h3>
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