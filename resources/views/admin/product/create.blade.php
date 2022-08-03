@extends('admin.layouts.admin')
@section('title', 'Create Product')

@section('content')

    <div class="content-wrapper" style="min-height: 1345.6px;">

        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Product</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Product</li>
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
                                <h3 class="card-title">Product</h3>
                            </div>


                            <form method="POST" action="{{ route('product.store') }}" enctype="multipart/form-data">
                                @csrf
                                <div class="card-body">

                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Product Category</label>
                                        <select name="cat_id" id="" class="form-control">
                                            @foreach($product_categories as $product_category)
                                            <option value="{{ $product_category->id }}">{{ $product_category->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Name</label>
                                        <input type="text" class="form-control" id="exampleInputEmail1" name="name"
                                            placeholder="Enter Name">
                                    </div>


                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Details</label>
                                        <input type="text" class="form-control" id="exampleInputEmail1" name="details"
                                            placeholder="Enter Details">
                                    </div>

                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Type</label>
                                        <select name="type" id="type" class="form-control">
                                            <option value="non-renewal">Non-renewal</option>
                                            <option id="renewal" value="renewal">Renewal</option>
                                        </select>
                                    </div>

                                    <div class="" id="get_data"></div>

                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Price</label>
                                        <input type="text" class="form-control" id="exampleInputEmail1" name="price"
                                            placeholder="Enter Price">
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



<script type="text/javascript">


// $("#type").change(function(){
//   alert("The paragraph was clicked.");
// });


$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

$(document).ready(function(e){
    $('#type').change(function(){
        var type = $(this).val();
     
        
        $.ajax({
            url:"{{ route('product_renewal.search') }}",
            method:"POST",
            data:{
                "_token": "{{ csrf_token() }}",
                'type':type
            },
            success: function(data){
                $('#get_data').html(data);
             
            },
            error: function(error){
                // alert('error');
            }
        });
    });
});
</script>

@endsection


@endsection