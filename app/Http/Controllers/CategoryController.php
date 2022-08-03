<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dataCount = Category::count();
        return view('admin.category.index',compact('dataCount'));
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

        $totalData = Category::count();
        $cat_datas  = Category::select('categories.*');
        

        if($request->input('search.value')){
            $cat_datas = $cat_datas->where(function($qSearch)use($search){
                $qSearch = $qSearch->where('categories.id','LIKE',"%{$search}%")
                            ->orWhere('categories.created_at', 'LIKE',"%{$search}%");
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

            

                $nestedData['action'] = $nestedData['action'].'<a href="'.route('category.edit',$cat_data->id).'" class="btn btn-sm btn-primary text-white rowEdit" data-id="'.$cat_data->id.'"><i class="fa fa-edit"></i>Edit</a>';
                
                $nestedData['action'] = $nestedData['action'] .'<button class="btn btn-sm btn-danger text-white rowDelete" data-link="'.route('category.destroy',$cat_data->id).'" data-id="'.$cat_data->id.'"><i class="fa fa-trash"></i>Delete</button>';

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
        return view('admin.category.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $category = new Category();
        $category->name =  $request->name;

        $category->save();

        return redirect()->route('category.index')->with('message','Added Category Sucessfully');
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
        $category = Category::findOrFail($id);

        return view('admin.category.edit',compact('category'));
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
        $category = Category::findOrFail($id);

        $category->name = $request->name;
        $category->save();

        return redirect()->route('category.index')->with('message','Updated Category Sucessfully');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $category = Category::findOrFail($request->id);

        $category->delete();

        return redirect()->route('category.index')->with('message','Deleted Category Sucessfully');

    }
}
