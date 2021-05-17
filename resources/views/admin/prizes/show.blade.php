@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.prize.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.prizes.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.prize.fields.id') }}
                        </th>
                        <td>
                            {{ $prize->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.prize.fields.name') }}
                        </th>
                        <td>
                            {{ $prize->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.prize.fields.thumb_image') }}
                        </th>
                        <td>
                            @if($prize->thumb_image)
                                <a href="{{ $prize->thumb_image->getUrl() }}" target="_blank" style="display: inline-block">
                                    <img src="{{ $prize->thumb_image->getUrl('thumb') }}">
                                </a>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.prize.fields.gallery') }}
                        </th>
                        <td>
                            @foreach($prize->gallery as $key => $media)
                                <a href="{{ $media->getUrl() }}" target="_blank" style="display: inline-block">
                                    <img src="{{ $media->getUrl('thumb') }}">
                                </a>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.prize.fields.cost') }}
                        </th>
                        <td>
                            {{ $prize->cost }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.prize.fields.quantity') }}
                        </th>
                        <td>
                            {{ $prize->quantity }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.prize.fields.description') }}
                        </th>
                        <td>
                            {!! $prize->description !!}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.prizes.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header">
        {{ trans('global.relatedData') }}
    </div>
    <ul class="nav nav-tabs" role="tablist" id="relationship-tabs">
        <li class="nav-item">
            <a class="nav-link" href="#prize_redeems" role="tab" data-toggle="tab">
                {{ trans('cruds.redeem.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="prize_redeems">
            @includeIf('admin.prizes.relationships.prizeRedeems', ['redeems' => $prize->prizeRedeems])
        </div>
    </div>
</div>

@endsection