<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dataCount = Blog::count();
        return view('admin.blog.index',compact('dataCount'));
    }

    public function ajaxTable(Request $request)
    {
        $columns = array(
            0 => 'id',
            1 => 'name',
            2 => 'content',
            3 => 'created_at',
            4=> 'action',
        );

        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];;
        $dir   = $request->input('order.0.dir');
        
        if($request->input('search.value'))
            $search = $request->input('search.value');

        $totalData = Blog::count();
        $blogs  = Blog::select('blogs.*');
        

        if($request->input('search.value')){
            $blogs = $blogs->where(function($qSearch)use($search){
                $qSearch = $qSearch->where('blogs.id','LIKE',"%{$search}%")
                            ->orWhere('blogs.name', 'LIKE',"%{$search}%")
                            ->orWhere('blogs.created_at', 'LIKE',"%{$search}%");
            });
        }

        $totalFiltered = $blogs->get()->count();
        if($order!="action"){
            $blogs   = $blogs->orderBy($order,$dir)->offset($start)
                           ->limit($limit)
                           ->get();            
        }else{
            $blogs   = $blogs->offset($start)
                           ->limit($limit)
                           ->get();
        }

        $data = array();
        if(!empty($blogs))
        {   
            $i = $start;
            foreach ($blogs as $blog)
         
     
            {
                $nestedData['id']             = ++$i;
                $nestedData['name']        = $blog->name;
                $nestedData['content']        = substr($blog->content, 0, 25) . '...';
                $nestedData['created_at']     = $blog->created_at;
                

                $nestedData['action'] = '<div class="btn-group" role="group" aria-label="actions">';

            

                $nestedData['action'] = $nestedData['action'].'<a href="'.route('blog.edit',$blog->id).'" class="btn btn-sm btn-primary text-white rowEdit" data-id="'.$blog->id.'"><i class="fa fa-edit"></i>Edit</a>';
                
                $nestedData['action'] = $nestedData['action'] .'<button class="btn btn-sm btn-danger text-white rowDelete" data-link="'.route('blog.destroy',$blog->id).'" data-id="'.$blog->id.'"><i class="fa fa-trash"></i>Delete</button>';

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
        return view('admin.blog.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $blog = new Blog();

        $blog->name = $request->name;
        $blog->content = $request->content;

        $blog->save();

        return redirect()->route('blog.index')->with('message','BLog Added Successfully');
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
        $blog = Blog::findOrFail($id);

        return view('admin.blog.edit',compact('blog'));
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
        $blog = Blog::findOrFail($id);

        $blog->name = $request->name;
        $blog->content = $request->content;

        $blog->save();

        return redirect()->route('blog.index')->with('message','BLog Updated Successfully');


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $blog = Blog::findOrFail($request->id);
        $blog->delete();

        return redirect()->route('blog.index')->with('message','BLog Deleted Successfully');

    }
}
