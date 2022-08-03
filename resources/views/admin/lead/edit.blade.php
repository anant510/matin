@extends('admin.layouts.admin')
@section('title', 'Edit Lead')

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
                        <h1> Edit Lead</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Edit Lead</li>
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
                                <h3 class="card-title">Edit Lead</h3>
                            </div>


                            <form method="POST" action="{{ route('lead.update',[$lead->id]) }}">
                                @csrf
                                @method('PUT')
                                <div class="card-body">

                                    <div class="form-group">
                                    <label for="exampleInputEmail1">Category</label>
                                       <select name="category_id" id="category_id" class="form-control">
                                            <option value="">Select Category</option>
                                            @foreach($category_datas as $category_data)
                                            <option value="{{ $category_data->id }}"{{$lead->category_id == $category_data->id ? 'selected' :'' }}>{{ $category_data->name }}</option>
                                            @endforeach
                                       </select>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Name</label>
                                        <input type="text" class="form-control" id="exampleInputEmail1" name="name"
                                            placeholder="Enter Full Name" value="{{ $lead->name }}">
                                    </div>

                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Email</label>
                                        <input type="email" class="form-control" id="exampleInputEmail1" name="email"
                                            placeholder="Enter email"  value="{{ $lead->email }}">
                                    </div>

                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Phone Number</label>
                                        <input type="text" class="form-control" id="exampleInputEmail1" name="phone"
                                            placeholder="Enter Phone Number"  value="{{ $lead->phone }}">
                                    </div>

                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Notes</label>
                                        <input type="text" class="form-control" id="exampleInputEmail1" name="notes"
                                            placeholder="Enter Notes" value="{{ $lead->notes }}">
                                    </div>

                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Date</label>
                                        <input type="text" class="form-control" id="exampleInputEmail1" name="date"
                                            placeholder="Enter date in Nepali"  value="{{ $lead->date }}">
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