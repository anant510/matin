@extends('admin.layouts.admin')
@section('title', 'Edit Blog')


@section('content')

    <div class="content-wrapper" style="min-height: 1345.6px;">

        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Edit Blog</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Edit Blog</li>
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
                                <h3 class="card-title">Edit Blog</h3>
                            </div>


                            <form method="POST" action="{{ route('blog.update',[$blog->id]) }}">
                                @csrf
                                @method('PUT')
                                <div class="card-body">
                                    
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Name</label>
                                        <input type="text" class="form-control summernote" id="exampleInputEmail1" name="name"
                                            value="{{ $blog->name }}">
                                    </div>

                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Content</label>
                                        <input type="text" class="form-control " id="exampleInputEmail1" name="content"
                                        value="{{ $blog->content }}" >
                                           
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