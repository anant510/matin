<?php

namespace App\Http\Controllers;

use App\Models\Portfolio;
use Illuminate\Http\Request;

class PortfolioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dataCount = Portfolio::count();
        return view('admin.portfolio.index',compact('dataCount'));
    }

    public function ajaxTable(Request $request)
    {
        $columns = array(
            0 => 'id',
            1 => 'category',
            2 => 'name',
            3 => 'photo',
            4 => 'url',
            5 => 'details',
            6 => 'created_at',
            7 => 'action',
        );

        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];;
        $dir   = $request->input('order.0.dir');
        
        if($request->input('search.value'))
            $search = $request->input('search.value');

        $totalData = Portfolio::count();
        $portfolios  = Portfolio::select('portfolios.*');
        

        if($request->input('search.value')){
            $portfolios = $portfolios->where(function($qSearch)use($search){
                $qSearch = $qSearch->where('portfolios.id','LIKE',"%{$search}%")
                            ->orWhere('portfolios.name', 'LIKE',"%{$search}%")
                            ->orWhere('portfolios.created_at', 'LIKE',"%{$search}%");
            });
        }

        $totalFiltered = $portfolios->get()->count();
        if($order!="action"){
            $portfolios   = $portfolios->orderBy($order,$dir)->offset($start)
                           ->limit($limit)
                           ->get();            
        }else{
            $portfolios   = $portfolios->offset($start)
                           ->limit($limit)
                           ->get();
        }

        $data = array();
        if(!empty($portfolios))
        {   
            $i = $start;
            foreach ($portfolios as $portfolio)
         
     
            {
                $nestedData['id']             = ++$i;
                $nestedData['category']        = $portfolio->category;
                $nestedData['name']        = $portfolio->name;
                $nestedData['url']        = $portfolio->url;
                $nestedData['photo']        = '<img height="80px" src="'.asset($portfolio->photo).'">';
                $nestedData['details']        = $portfolio->details;
                $nestedData['created_at']     = $portfolio->created_at;
                

                $nestedData['action'] = '<div class="btn-group" role="group" aria-label="actions">';

            

                $nestedData['action'] = $nestedData['action'].'<a href="'.route('portfolio.edit',$portfolio->id).'" class="btn btn-sm btn-primary text-white rowEdit" data-id="'.$portfolio->id.'"><i class="fa fa-edit"></i>Edit</a>';
                
                $nestedData['action'] = $nestedData['action'] .'<button class="btn btn-sm btn-danger text-white rowDelete" data-link="'.route('portfolio.destroy',$portfolio->id).'" data-id="'.$portfolio->id.'"><i class="fa fa-trash"></i>Delete</button>';

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
        return view('admin.portfolio.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $portfolio = new Portfolio();

         //for photo
         if($request->photo){
            $fileName = time().'_'.$request->photo->getClientOriginalName();
            $filePath = $request->file('photo')->storeAs('uploads/users', $fileName, 'public');
            $modifiedPath = '/storage/'.$filePath;
            }else{
                $modifiedPath='';
            }

        $portfolio->category = $request->category;
        $portfolio->name = $request->name;
        $portfolio->url = $request->url;
        $portfolio->details = $request->details;

        $portfolio->photo = $modifiedPath;

        $portfolio->save();

        return redirect()->route('portfolio.index')->with('message','Portfolio Added Sucessfully');

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
        $portfolio = Portfolio::findOrFail($id);

        return view('admin.portfolio.edit',compact('portfolio'));
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
        $portfolio = Portfolio::findOrFail($id);

         //for photo
         if($request->photo){
            $fileName = time().'_'.$request->photo->getClientOriginalName();
            $filePath = $request->file('photo')->storeAs('uploads/users', $fileName, 'public');
            $modifiedPath = '/storage/'.$filePath;
            }else{
                $modifiedPath='';
            }

        $portfolio->category = $request->category;
        $portfolio->name = $request->name;
        $portfolio->url = $request->url;
        $portfolio->details = $request->details;

        if($request->photo){
        $portfolio->photo = $modifiedPath;
        }

        $portfolio->save();
        return redirect()->route('portfolio.index')->with('message','Portfolio Updated Sucessfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $portfolio = Portfolio::findOrFail($request->id);
        $portfolio->delete();

        return redirect()->route('portfolio.index')->with('message','Portfolio Deleted Sucessfully');
    }
}
