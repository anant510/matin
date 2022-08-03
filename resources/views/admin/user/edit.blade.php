@extends('admin.layouts.admin')
@section('title', 'Edit Clients')

@section('styles')
<link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css') }}">
<style>
    .select2-selection--single{
        height: 40px!important;
    }
</style>
@endsection

@section('content')

    <div class="content-wrapper" style="min-height: 1345.6px;">

        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Edit Client</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Edit Client</li>
                        </ol>
                    </div>
                </div>
            </div>
        </section>

        <section class="content">
            <div class="container-fluid">
                <div class="row">
                <div class="col-12">
                    @if(session()->has('message'))
                <div class="alert alert-success" role="alert">
                    {{ session()->get('message')}}
                </div>
                @endif

                    <div class="col-md-12">

                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Edit Client</h3>
                            </div>


                            <form method="POST" action="{{ route('user.update',[$user->id]) }}" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="card-body">

                                    <div class="form-group">
                                    <label for="">Full Name:</label>
                                    <input type="text" class="form-control" name="name" id="name" value="{{ $user->name }}">
                                    </div>
                                    <div class="form-group">
                                    <label for="">Email:</label>
                                    <input type="email" class="form-control" name="email" id="email" value="{{ $user->email }}">
                                    </div>

                                    <!-- <div class="form-group">
                                    <label for="">Full Name:</label>
                                    <input type="password" class="form-control" name="password" id="password" placeholder="Enter Password" required>
                                    </div> -->

                                    <div class="form-group">
                                    <label for="">Phone Number:</label>
                                    <input type="text" class="form-control" name="phone" id="phone" value="{{ $user->phone }}">
                                    </div>

                                    <div class="form-group">
                                    <label for="">Company Name:</label>
                                    <input type="text" class="form-control" name="company_name" id="company_name" value="{{ $user->company_name }}">
                                    </div>

                                    <div class="form-group">
                                    <label for="">Location | Address:</label>
                                    <input type="text" class="form-control" name="address" id="address" value="{{ $user->address }}">
                                    </div>

                                    <div class="form-group">
                                    <label for="">Web:</label>
                                    <input type="text" class="form-control" name="web" id="web" value="{{ $user->web }}">
                                    </div>

                                    
                                    <div class="form-group">
                                    <label for="">Photo:</label>
                                    @if($user->photo)
                                    <img style="width:100px;" src="{{ asset($user->photo)}}" alt="">
                                    <input type="file" id="photo" name="photo" class="form-control" />
                                    @else
                                    <input type="file" id="photo" name="photo" class="form-control" />
                                    @endif
                                    </div>

                                </div>

                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">Save</button>
                                </div>
                            </form>
                        </div>
                    </div>

                </div>

            </div>
        </section>
    </div>


@endsection


@section('scripts')
<script src="{{ asset('plugins/select2/js/select2.min.js')}}"></script>


<script> 

 $('#category_id').select2();

</script>        
@endsection