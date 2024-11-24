@extends('backend.layouts.master')
@section('title','E-SHOP || Brand Create')
@section('main-content')

<div class="card">
    <h5 class="card-header">Add Base</h5>
    <div class="card-body">
      <form method="post" action="{{route('brand.store')}}">
        {{csrf_field()}}

        <div class="form-group">
            <label for="inputTitle" class="col-form-label">ZipCord<span class="text-danger">*</span></label>
            <input id="zip" type="text" name="zip" placeholder="Enter zip"  value="" class="form-control" require>
            <button class="btn btn-success" id="zip_button" >Add</button>
        </div>

        <div class="form-group">
        <label for="inputTitle" class="col-form-label">City Name <span class="text-danger">*</span></label>
        <input id="cityname" type="text" name="cityname" placeholder="Enter cityname"  value="" class="form-control">
        @error('title')
        <span class="text-danger">{{$message}}</span>
        @enderror
        </div>

        <div class="form-group">
            <label for="inputTitle" class="col-form-label">Latitude <span class="text-danger">*</span></label>
            <input id="latitude" type="text" name="latitude" placeholder="Enter title"  value="" class="form-control" require>
        </div>

        <div class="form-group">
            <label for="inputTitle" class="col-form-label">Longitude <span class="text-danger">*</span></label>
            <input id="longitude" type="text" name="longitude" placeholder="Enter title"  value="" class="form-control" require>
        </div>

        <div class="form-group">
          <label for="status" class="col-form-label">Status <span class="text-danger">*</span></label>
          <select name="status" class="form-control">
              <option value="active">Active</option>
              <option value="inactive">Inactive</option>
          </select>
          @error('status')
          <span class="text-danger">{{$message}}</span>
          @enderror
        </div>
        <div class="form-group mb-3">
          <button type="reset" class="btn btn-warning">Reset</button>
           <button id="" class="btn btn-success" type="submit">Submit</button>
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

    $(document).ready(function () {
        $('#zip_button').click(function (e) {
            e.preventDefault(); // Prevent the default form submission

            let postalCode = $('#zip').val();
            let country = 'US'; // You can make this dynamic if needed

            if (postalCode) {
                $.ajax({
                    url: "{{ route('brand.getLocation') }}", // Route to call your controller method
                    type: "GET",
                    data: {
                        postalCode: postalCode,
                        country: country
                    },
                    success: function (response) {
                        // Populate fields with the response data
                        $('#latitude').val(response.lat);
                        $('#longitude').val(response.lon);
                        $('#cityname').val(response.cityname);
                        console.log(response.total);
                    },
                    error: function (xhr, status, error) {
                        console.error(error);
                        alert('Failed to fetch location. Please check the ZIP code and try again.');
                    }
                });
            } else {
                alert('Please enter a ZIP code.');
            }
        });
    });



</script>

<style>
    #zip_button {
        margin-top: 15px;
        width: 90px;
    }
</style>
@endpush
