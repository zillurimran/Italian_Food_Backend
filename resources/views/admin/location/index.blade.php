@extends('layouts.dashboard')
@section('title')
{{ config('app.name') }} | Location
@endsection
@section('location')
    active
@endsection
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    
                        <h3 class="card-title">Set Location</h3>
                        <div class="custom-control custom-switch ml-1">
                            <input type="checkbox" {{ (hideshow()->map_status == 1)? 'checked' : ''}} class="custom-control-input map-switcher" id="customSwitch1">
                            <label class="custom-control-label" for="customSwitch1" title="Show/Hide Map"></label>
                        </div>
                    
                </div>
                <div class="card-body">
                    <form action="{{ route('location.update', $location->id) }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="heading">Location Url <small>(Embed map HTML) <span class="text-danger">*</span></small></label>
                            <textarea name="location_url" class="form-control" rows="6">{{ $location->location_url ?? old('location_url') }}</textarea>
                        </div>
                        <button type="submit" class="btn btn-success">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('js')

 <script>
    $(document).ready(function(){
        $('body').on("click", '.map-switcher', function(){
            if($(this).is(':checked') == true)
            {
               var status = 1;
            }
            else 
            {
                var status =  0;
            }

            console.log(status);



            $.ajax({
                method : 'post', 
                url : "{{ route('map.status') }}", 
                data : {
                    status : status
                }
            })

        })
    });
 </script>

@endpush