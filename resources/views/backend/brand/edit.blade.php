@extends('backend.layouts.master')
@section('title','E-SHOP || Brand Edit')
@section('main-content')

<div class="card">
    <h5 class="card-header">Edit Base</h5>
    <div class="card-body">
      <form method="post" action="{{route('brand.update',$base->id)}}">
        @csrf
        @method('PATCH')
        <div class="form-group">
          <label for="inputTitle" class="col-form-label">City <span class="text-danger">*</span></label>
        <input id="cityname" type="text" name="cityname" placeholder="Enter title"  value="{{$base->cityname}}" class="form-control">
        @error('title')
        <span class="text-danger">{{$message}}</span>
        @enderror
        </div>
        <div class="form-group">
          <label for="inputTitle" class="col-form-label">Latitude <span class="text-danger">*</span></label>
        <input id="latitude" type="text" name="latitude" placeholder="Enter title"  value="{{$base->latitude}}" class="form-control">
        </div>

        <div class="form-group">
          <label for="inputTitle" class="col-form-label">Longitude <span class="text-danger">*</span></label>
        <input id="longitude" type="text" name="longitude" placeholder="Enter title"  value="{{$base->longitude}}" class="form-control">

        </div>
        <div class="form-group">
          <label for="status" class="col-form-label">Status <span class="text-danger">*</span></label>
          <select name="status" class="form-control">
            <option value="active" {{(($base->status=='active') ? 'selected' : '')}}>Active</option>
            <option value="inactive" {{(($base->status=='inactive') ? 'selected' : '')}}>Inactive</option>
          </select>
          @error('status')
          <span class="text-danger">{{$message}}</span>
          @enderror
        </div>
        <div class="form-group mb-3">
           <button class="btn btn-success" type="submit">Update</button>
        </div>
      </form>
    </div>
</div>

@endsection

@push('styles')
<link rel="stylesheet" href="{{asset('backend/summernote/summernote.min.css')}}">
@endpush
@push('scripts')
<script src="/vendor/laravel-filemanager/js/stand-alone-button.js"></script>
<script src="{{asset('backend/summernote/summernote.min.js')}}"></script>
<script>
    $('#lfm').filemanager('image');

    $(document).ready(function() {
    $('#description').summernote({
      placeholder: "Write short description.....",
        tabsize: 2,
        height: 150
    });
    });
</script>
@endpush
