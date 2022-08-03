<?php

namespace App\Http\Controllers;

use App\Models\ProductCategory;
use Illuminate\Http\Request;

class ProductCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dataCount = ProductCategory::count();
        return view('admin.product_category.index',compact('dataCount'));
    }

    public function ajaxTable(Request $request)
    {
        $columns = array(
            0 => 'id',
            1 => 'name',
            2 => 'created_at',
            3 => 'action',
        );

        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];;
        $dir   = $request->input('order.0.dir');
        
        if($request->input('search.value'))
            $search = $request->input('search.value');

        $totalData = ProductCategory::count();
        $cat_datas  = ProductCategory::select('product_categories.*');
        

        if($request->input('search.value')){
            $cat_datas = $cat_datas->where(function($qSearch)use($search){
                $qSearch = $qSearch->where('product_categories.id','LIKE',"%{$search}%")
                            ->orWhere('product_categories.name', 'LIKE',"%{$search}%")
                            ->orWhere('product_categories.created_at', 'LIKE',"%{$search}%");
            });
        }

        $totalFiltered = $cat_datas->get()->count();
        if($order!="action"){
            $cat_datas   = $cat_datas->orderBy($order,$dir)->offset($start)
                           ->limit($limit)
                           ->get();            
        }else{
            $cat_datas   = $cat_datas->offset($start)
                           ->limit($limit)
                           ->get();
        }

        $data = array();
        if(!empty($cat_datas))
        {   
            $i = $start;
            foreach ($cat_datas as $cat_data)
         
     
            {
                $nestedData['id']             = ++$i;
                $nestedData['name']        = $cat_data->name;
                $nestedData['created_at']     = $cat_data->created_at;
                

                $nestedData['action'] = '<div class="btn-group" role="group" aria-label="actions">';

            

                $nestedData['action'] = $nestedData['action'].'<a href="'.route('product_category.edit',$cat_data->id).'" class="btn btn-sm btn-primary text-white rowEdit" data-id="'.$cat_data->id.'"><i class="fa fa-edit"></i>Edit</a>';
                
                $nestedData['action'] = $nestedData['action'] .'<button class="btn btn-sm btn-danger text-white rowDelete" data-link="'.route('product_category.destroy',$cat_data->id).'" data-id="'.$cat_data->id.'"><i class="fa fa-trash"></i>Delete</button>';

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
        return view('admin.product_category.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $product_category = new ProductCategory();

        $product_category->name = $request->name;
        $product_category->save();

        return redirect()->route('product_category.index')->with('message','ProductCategory Added Sucessfully');
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
        $product_category = ProductCategory::findOrFail($id);

        return view('admin.product_category.edit',compact('product_category'));
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
        $product_category = ProductCategory::findOrFail($id);
        
        $product_category->name = $request->name;
        $product_category->save();

        return redirect()->route('product_category.index')->with('message','ProductCategory Updated Sucessfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $product_category = ProductCategory::findOrFail($request->id);

        $product_category->delete();

        return redirect()->route('product_category.index')->with('message','ProductCategory Deleted Sucessfully');
    }
}
