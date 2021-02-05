@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.image.title_singular') }}
    </div>

    <div class="card-body">
        <form action="{{ route("admin.images.store") }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group {{ $errors->has('image') ? 'has-error' : '' }}">
                <label for="image">{{ trans('cruds.image.fields.photo') }}*</label>
                <input type="file" id="photo" name="image" class="form-control" value="" required>
                @if($errors->has('image'))
                    <em class="invalid-feedback">
                        {{ $errors->first('image') }}
                    </em>
                @endif
                <p class="helper-block">
                    {{ trans('cruds.image.fields.photo_helper') }}
                </p>
            </div>
            <div class="form-group {{ $errors->has('caption') ? 'has-error' : '' }}">
                <label for="caption">{{ trans('cruds.image.fields.caption') }}</label>
                <input type="text" id="caption" name="caption" class="form-control" value="{{ old('caption', isset($image) ? $image->caption : '') }}">
                @if($errors->has('caption'))
                    <em class="invalid-feedback">
                        {{ $errors->first('caption') }}
                    </em>
                @endif
                <p class="helper-block">
                    {{ trans('cruds.image.fields.caption_helper') }}
                </p>
            </div>
            <div class="form-group {{ $errors->has('description') ? 'has-error' : '' }}">
                <label for="description">{{ trans('cruds.image.fields.description') }}</label>
                <input type="text" id="description" name="description" class="form-control" value="{{ old('description', isset($image) ? $image->description : '') }}">
                @if($errors->has('description'))
                    <em class="invalid-feedback">
                        {{ $errors->first('description') }}
                    </em>
                @endif
                <p class="helper-block">
                    {{ trans('cruds.image.fields.description_helper') }}
                </p>
            </div>
                   
            <div>
                <input class="btn btn-danger" type="submit" value="{{ trans('global.save') }}">
            </div>
        </form>

<a style="margin-top:20px;" class="btn btn-default" href="{{ url()->previous() }}">
                {{ trans('global.back_to_list') }}
            </a>
    </div>
</div>
@endsection