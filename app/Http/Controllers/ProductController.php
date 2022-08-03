<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dataCount = Product::count();
        return view('admin.product.index',compact('dataCount'));
    }

    public function ajaxTable(Request $request)
    {
        $columns = array(
            0 => 'id',
            1 => 'cat_id',
            2 => 'name',
            3 => 'details',
            4 => 'type',
            5 => 'renewal_type',
            6 => 'price',
            7 => 'created_at',
            8 => 'action',
        );

        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];;
        $dir   = $request->input('order.0.dir');
        
        if($request->input('search.value'))
            $search = $request->input('search.value');

        $totalData = Product::count();
        $products  = Product::select('products.*');
        

        if($request->input('search.value')){
            $products = $products->where(function($qSearch)use($search){
                $qSearch = $qSearch->where('products.id','LIKE',"%{$search}%")
                            ->orWhere('products.name', 'LIKE',"%{$search}%")
                            ->orWhere('products.created_at', 'LIKE',"%{$search}%");
            });
        }

        $totalFiltered = $products->get()->count();
        if($order!="action"){
            $products   = $products->orderBy($order,$dir)->offset($start)
                           ->limit($limit)
                           ->get();            
        }else{
            $products   = $products->offset($start)
                           ->limit($limit)
                           ->get();
        }

        $data = array();
        if(!empty($products))
        {   
            $i = $start;
            foreach ($products as $product)
         
     
            {
                $nestedData['id']             = ++$i;
                $nestedData['cat_id']        = $product->productcategory->name;
                $nestedData['name']        = $product->name;
                $nestedData['details']        = $product->details;
                $nestedData['type']        = $product->type;
                $nestedData['renewal_type']        = $product->renewal_type;
                $nestedData['price']        = $product->price;
                $nestedData['created_at']     = $product->created_at;
                

                $nestedData['action'] = '<div class="btn-group" role="group" aria-label="actions">';

            

                $nestedData['action'] = $nestedData['action'].'<a href="'.route('product.edit',$product->id).'" class="btn btn-sm btn-primary text-white rowEdit" data-id="'.$product->id.'"><i class="fa fa-edit"></i>Edit</a>';
                
                $nestedData['action'] = $nestedData['action'] .'<button class="btn btn-sm btn-danger text-white rowDelete" data-link="'.route('product.destroy',$product->id).'" data-id="'.$product->id.'"><i class="fa fa-trash"></i>Delete</button>';

                $nestedData['action'] = $nestedData['action'] .'</div>';
                $data[] = $nestedData;
            }
        
        }

        $json_data = array(
            "draw"            => intval($request->input('draw')),  
            "recordsTotal"    => intval($totalData),  
            "recordsFiltered" => intval($totalFiltered), 
            "data"            => $data,
        );

        echo json_encode($json_data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $product_categories = ProductCategory::all();
        return view('admin.product.create',compact('product_categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $product = new Product();
    
        $product->cat_id = $request->cat_id;
        $product->name = $request->name;
        $product->details = $request->details;
        $product->type = $request->type;
        $product->renewal_type = $request->renewal_type;
        $product->price = $request->price;

        $product->save();

        return redirect()->route('product.index')->with('message','Product Added Successfully');
        

        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $product_categories = ProductCategory::all();

        return view('admin.product.edit',compact('product','product_categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $product->cat_id = $request->cat_id;
        $product->name = $request->name;
        $product->details = $request->details;
        $product->type = $request->type;
        $product->renewal_type = $request->renewal_type;
        $product->price = $request->price;

        $product->save();

        return redirect()->route('product.index')->with('message','Product Updated Successfully');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $product = Product::findOrFail($request->id);
        $product->delete();

        return redirect()->route('product.index')->with('message','Product Deleted Successfully');
    }

    public function search(Request $request)
    {
        $type = $request->type;
        return view('admin.product.renewal', compact('type'));

    }

    public function edit_search(Request $request)
    {
        $type = $request->type;
        $product_id = $request->product_id;

        $product = Product::findOrFail($product_id);
        
        return view('admin.product.edit_renewal', compact('type','product'));

    }
}
