@extends('admin.layouts.admin')
@section('title', 'Create Clients')

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
                        <h1>Client</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Client</li>
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
                                <h3 class="card-title">Create Client</h3>
                            </div>


                            <form method="POST" action="{{ route('user.store') }}" enctype="multipart/form-data">
                                @csrf
                                <div class="card-body">

                                    <div class="form-group">
                                    <label for="">Full Name:</label>
                                    <input type="text" class="form-control" name="name" id="name" placeholder="Enter Full Name" required>
                                    </div>
                                    <div class="form-group">
                                    <label for="">Email:</label>
                                    <input type="email" class="form-control" name="email" id="email" placeholder="Enter Email" required>
                                    </div>

                                    <!-- <div class="form-group">
                                    <label for="">Full Name:</label>
                                    <input type="password" class="form-control" name="password" id="password" placeholder="Enter Password" required>
                                    </div> -->

                                    <div class="form-group">
                                    <label for="">Phone Number:</label>
                                    <input type="text" class="form-control" name="phone" id="phone" placeholder="Enter Phone Number" required>
                                    </div>

                                    <div class="form-group">
                                    <label for="">Company Name:</label>
                                    <input type="text" class="form-control" name="company_name" id="company_name" placeholder="Enter Company Name">
                                    </div>

                                    <div class="form-group">
                                    <label for="">Location | Address:</label>
                                    <input type="text" class="form-control" name="address" id="address" placeholder="Enter Address">
                                    </div>

                                    <div class="form-group">
                                    <label for="">Web:</label>
                                    <input type="text" class="form-control" name="web" id="web" placeholder="Enter Web">
                                    </div>

                                    
                                    <div class="form-group">
                                    <label for="">Photo:</label>
                                    <input type="file" class="form-control" name="photo" id="photo" >
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