@extends('admin.layouts.admin')
@section('title', 'Create Portfolio')

@section('content')

    <div class="content-wrapper" style="min-height: 1345.6px;">

        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Portfolio</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Portfolio</li>
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
                                <h3 class="card-title">Portfolio</h3>
                            </div>


                            <form method="POST" action="{{ route('portfolio.store') }}" enctype="multipart/form-data">
                                @csrf
                                <div class="card-body">

                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Category</label>
                                        <select name="category" id="" class="form-control">
                                            <option value="application">Application</option>
                                            <option value="web">Web</option>
                                        </select>
                                       
                                    </div>
                                    
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Name</label>
                                        <input type="text" class="form-control" id="exampleInputEmail1" name="name"
                                            placeholder="Enter Name">
                                    </div>

                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Photo</label>
                                        <input type="file" class="form-control" id="exampleInputEmail1" name="photo"
                                            >
                                    </div>

                                    <div class="form-group">
                                        <label for="exampleInputEmail1">URL</label>
                                        <input type="text" class="form-control" id="exampleInputEmail1" name="url"
                                            placeholder="Enter URL">
                                    </div>

                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Details</label>
                                        <input type="text" class="form-control" id="exampleInputEmail1" name="details"
                                            placeholder="Enter Details">
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