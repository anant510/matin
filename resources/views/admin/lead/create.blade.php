@extends('admin.layouts.admin')
@section('title', 'Create Lead')

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
                        <h1>Lead</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Lead</li>
                        </ol>
                    </div>
                </div>
            </div>
        </section>

        <section class="content">
            <div class="container-fluid">
                <div class="row">

                    <div class="col-md-12">

                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Lead</h3>
                            </div>


                            <form method="POST" action="{{ route('lead.store') }}">
                                @csrf
                                <div class="card-body">

                                    <div class="form-group">
                                    <label for="exampleInputEmail1">Category</label>
                                       <select name="category_id" id="category_id" class="form-control" required>
                                            <option value="">Select Category</option>
                                            @foreach($category_datas as $category_data)
                                            <option value="{{ $category_data->id }}">{{ $category_data->name }}</option>
                                            @endforeach
                                       </select>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Name</label>
                                        <input type="text" class="form-control" id="exampleInputEmail1" name="name"
                                            placeholder="Enter Full Name" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Email</label>
                                        <input type="email" class="form-control" id="exampleInputEmail1" name="email"
                                            placeholder="Enter email" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Phone Number</label>
                                        <input type="text" class="form-control" id="exampleInputEmail1" name="phone"
                                            placeholder="Enter Phone Number" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Notes</label>
                                        <input type="text" class="form-control" id="exampleInputEmail1" name="notes"
                                            placeholder="Enter Notes">
                                    </div>

                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Date</label>
                                        <input type="text" class="form-control" id="exampleInputEmail1" name="date"
                                            placeholder="Enter date in Nepali" required>
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