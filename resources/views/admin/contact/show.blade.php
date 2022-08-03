@extends('admin.layouts.admin')
@section('title', 'Show Contact')

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
                        <h1>Contact</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Contact</li>
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
                                <h3 class="card-title">Show Contact</h3>
                            </div>


                            <!-- <form method="POST" action="{{ route('ticket.store') }}"> -->
                                <!-- @csrf -->
                                <div class="card-body">


                                    <div class="form-group">
                                    <label for="exampleInputEmail1">Name:</label>
                                    <input type="text" class="form-control" name="unique_id" value="{{ $contact->name }}" readonly>
                                    </div>
                                    
                                    

                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Email:</label>
                                        <input type="text" class="form-control" id="exampleInputEmail1" name="topic"
                                            placeholder="Enter Topic" value="{{ $contact->email }}" readonly>
                                    </div>

                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Message:</label>
                                        <!-- <input type="text" class="form-control" id="exampleInputEmail1" name="phone"
                                            placeholder="Enter Phone Number" required> -->
                                            <textarea class="form-control" name="message" id="message" cols="100" rows="5"  readonly>{{ $contact->message }}</textarea>
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