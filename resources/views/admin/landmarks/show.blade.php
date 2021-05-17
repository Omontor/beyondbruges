@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.landmark.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.landmarks.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.landmark.fields.id') }}
                        </th>
                        <td>
                            {{ $landmark->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.landmark.fields.name') }}
                        </th>
                        <td>
                            {{ $landmark->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.landmark.fields.address') }}
                        </th>
                        <td>
                            {{ $landmark->address }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.landmark.fields.lat') }}
                        </th>
                        <td>
                            {{ $landmark->lat }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.landmark.fields.lng') }}
                        </th>
                        <td>
                            {{ $landmark->lng }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.landmark.fields.gallery') }}
                        </th>
                        <td>
                            @foreach($landmark->gallery as $key => $media)
                                <a href="{{ $media->getUrl() }}" target="_blank" style="display: inline-block">
                                    <img src="{{ $media->getUrl('thumb') }}">
                                </a>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.landmark.fields.description_a') }}
                        </th>
                        <td>
                            {!! $landmark->description_a !!}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.landmark.fields.description_b') }}
                        </th>
                        <td>
                            {!! $landmark->description_b !!}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.landmark.fields.description_c') }}
                        </th>
                        <td>
                            {!! $landmark->description_c !!}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.landmarks.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection