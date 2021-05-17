@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.redeem.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.redeems.update", [$redeem->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="user_id">{{ trans('cruds.redeem.fields.user') }}</label>
                <select class="form-control select2 {{ $errors->has('user') ? 'is-invalid' : '' }}" name="user_id" id="user_id" required>
                    @foreach($users as $id => $entry)
                        <option value="{{ $id }}" {{ (old('user_id') ? old('user_id') : $redeem->user->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('user'))
                    <span class="text-danger">{{ $errors->first('user') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.redeem.fields.user_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="prize_id">{{ trans('cruds.redeem.fields.prize') }}</label>
                <select class="form-control select2 {{ $errors->has('prize') ? 'is-invalid' : '' }}" name="prize_id" id="prize_id" required>
                    @foreach($prizes as $id => $entry)
                        <option value="{{ $id }}" {{ (old('prize_id') ? old('prize_id') : $redeem->prize->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('prize'))
                    <span class="text-danger">{{ $errors->first('prize') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.redeem.fields.prize_helper') }}</span>
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