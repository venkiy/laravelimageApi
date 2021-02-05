@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.image.title_singular') }}
    </div>

    <div class="card-body">
        <div class="mb-2">
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.image.fields.id') }}
                        </th>
                        <td>
                            {{ $image->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.image.fields.photo') }}
                        </th>
                        <td>
                            <img src="{{ asset("../storage/app/public/users/$image->image") }}" alt="" title="" width="50%" height="50%">
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.image.fields.caption') }}
                        </th>
                        <td>
                            {{ $image->caption }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.image.fields.description') }}
                        </th>
                        <td>
                            {{ $image->description }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <a style="margin-top:20px;" class="btn btn-default" href="{{ url()->previous() }}">
                {{ trans('global.back_to_list') }}
            </a>
        </div>


    </div>
</div>
@endsection