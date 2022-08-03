@extends('admin.layouts.admin')
@section('title', 'Edit LetterPad')

@section('styles')
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
@endsection

@section('content')

    <div class="content-wrapper" style="min-height: 1345.6px;">

        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1> Edit LetterPad</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Edit LetterPad</li>
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
                                <h3 class="card-title">Edit LetterPad</h3>
                            </div>


                            <form method="POST" action="{{ route('letterpad.update',[$letterpad->id]) }}">
                                @csrf
                                @method('PUT')
                                <div class="card-body">

                                <div class="form-group">
                                    <label for="">Date</label>
                                    <input type="text" name="date" class="form-control" value="{{ $letterpad->date }}">
                                </div>
                                    
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Content</label>
                                            <textarea name="content"  class="summernote" id="" cols="30" rows="40">{{ $letterpad->content }}</textarea>
                                           
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


@section('scripts')

<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $('.summernote').summernote();
    });
</script>
    
@endsection


@endsection