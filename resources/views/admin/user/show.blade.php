@extends('admin.layouts.admin')
@section('title', 'User ')

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
                        <h1>User</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">User</li>
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
                                <h3 class="card-title">Show User</h3>
                            </div>


                            <!-- <form method="POST" action="{{ route('ticket.store') }}"> -->
                                <!-- @csrf -->
                                <div class="card-body">

                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Name:</label>
                                        <input type="text" class="form-control" name="unique_id" value="{{ $user->name }}" readonly>
                                    </div>

                                    <div class="form-group">
                                    <label for="exampleInputEmail1">Email:</label>
                                    <input type="text" class="form-control" name="unique_id" value="{{ $user->email }}" readonly>
                                    </div>

                                    <div class="form-group">
                                    <label for="exampleInputEmail1">Phone:</label>
                                    <input type="text" class="form-control" name="unique_id" value="{{ $user->phone }}" readonly>
                                    </div>

                                    <div class="form-group">
                                    <label for="exampleInputEmail1">Photo:</label> <br>
                                    @if($user->photo)
                                    <img style="width:100px;" src="{{ asset($user->photo) }}" alt="">
                                    @endif
                                    </div>
                                    
                                </div>

                                <!-- <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">Save</button>
                                </div> -->
                            <!-- </form> -->
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