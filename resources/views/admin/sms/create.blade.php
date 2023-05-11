@extends('layouts.dashboard')

{{-- Title --}}
@section('title')
    {{ config('app.name') }} |  Create SMS
@endsection

{{-- Active Menu --}}
@section('createSms')
    active
@endsection


{{-- Breadcrumb --}}
@section('breadcrumb')
     <h2 class="content-header-title float-left mb-0">Admin Dashboard</h2>
    <div class="breadcrumb-wrapper">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{ route('dashboard') }}">Home</a>
            </li>
            <li class="breadcrumb-item active">
               Create SMS
            </li>
        </ol>
    </div>
@endsection

{{-- Page Content --}}
@section('content')
    <section >
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Send SMS</h4>
                        @if (session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                        @endif
                        @if (session('warning'))
                            <div class="alert alert-warning">{{ session('warning') }}</div>
                        @endif
                    </div>
                    <div class="card-body">
                        @if(nexmosetting()->api_key == null || nexmosetting()->api_secret == null)
                            <div class="alert alert-warning">Please set your nexmo api key and secret in the nexmo settings page</div>
                        @else
                        <form action="{{ url('/admin/send-sms') }}" method="post">
                            @csrf

                            <div class="form-group">
                                <label for="choose">Select Group or Individual</label>
                                <select name="choose" id="choose" required class="form-control">
                                    <option value="">Select</option>
                                    <option value="group">Group</option>
                                    <option value="individual">Individual</option>
                                </select>
                            </div>

                            <div class="form-group d-none" id="individual">
                                <label for="numbers">Insert Number (For Multiple numbers please use space, For Example : 33123456789 33123456789 33123456789)</label>
                                <textarea class="form-control" required type="text" name="numbers"  id="numbers" placeholder="Example : 33123456789 33123456789 33123456789">{{ old('numbers') }}</textarea>
                            </div>

                            <div class="form-group d-none" id="group">
                                <label for="group">Select Group</label>
                                <select name="group_id" id="group" class="form-control">
                                    <option value="">Select</option>
                                    @foreach ($groups as $group)
                                       @if(\App\Models\PhoneDirectory::where('group_id', $group->id)->exists())
                                        <option value="{{ $group->id }}">{{ $group->name }}</option>
                                       @endif
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="title">SMS Name</label>
                                <input class="form-control" required type="text" id="title" name="title" placeholder="Example : SoClose" value="{{ old('title') }}">
                            </div>
                            <div class="form-group">
                                <label for="body">SMS Body</label>
                                <textarea class="form-control" required name="body" id="body" cols="30" rows="10" placeholder="Enter sms message">{{ old('body') }}</textarea>
                            </div>
                            <div class="form-group">
                                <button class="btn btn-primary" type="submit">Send SMS</button>
                            </div>
                        </form>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('js')
    <script>
        $(document).ready(function(){
            $('#choose').change(function(){
                var choose = $(this).val();
                if(choose == 'group'){
                   $("#group").removeClass("d-none");
                   $("#individual").addClass("d-none");
                   $("#numbers").removeAttr("required");
                }else{
                    $("#group").addClass("d-none");
                    $("#individual").removeClass("d-none");
                    $("#numbers").addAttr("required");
                }
            });
        });
    </script>
@endpush