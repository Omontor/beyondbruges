@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.itinerary.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.itineraries.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.itinerary.fields.id') }}
                        </th>
                        <td>
                            {{ $itinerary->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.itinerary.fields.name') }}
                        </th>
                        <td>
                            {{ $itinerary->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.itinerary.fields.landmark') }}
                        </th>
                        <td>
                            @foreach($itinerary->landmarks as $key => $landmark)
                                <span class="label label-info">{{ $landmark->name }}</span>
                            @endforeach
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.itineraries.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection