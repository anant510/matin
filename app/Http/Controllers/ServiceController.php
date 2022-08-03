<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dataCount = Service::count();
        return view('admin.service.index',compact('dataCount'));
    }

    
    public function ajaxTable(Request $request)
    {
        $columns = array(
            0 => 'id',
            1 => 'name',
            2 => 'icon',
            3 => 'details',
            4 => 'created_at',
            5 => 'action',
        );

        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];;
        $dir   = $request->input('order.0.dir');
        
        if($request->input('search.value'))
            $search = $request->input('search.value');

        $totalData = Service::count();
        $services  = Service::select('services.*');
        

        if($request->input('search.value')){
            $services = $services->where(function($qSearch)use($search){
                $qSearch = $qSearch->where('services.id','LIKE',"%{$search}%")
                            ->orWhere('services.name', 'LIKE',"%{$search}%")
                            ->orWhere('services.created_at', 'LIKE',"%{$search}%");
            });
        }

        $totalFiltered = $services->get()->count();
        if($order!="action"){
            $services   = $services->orderBy($order,$dir)->offset($start)
                           ->limit($limit)
                           ->get();            
        }else{
            $services   = $services->offset($start)
                           ->limit($limit)
                           ->get();
        }

        $data = array();
        if(!empty($services))
        {   
            $i = $start;
            foreach ($services as $service)
         
     
            {
                $nestedData['id']             = ++$i;
                $nestedData['name']        = $service->name;
                $nestedData['icon']        = '<img height="80px" src="'.asset($service->icon).'">';
                $nestedData['details']        = $service->details;
                $nestedData['created_at']     = $service->created_at;
                

                $nestedData['action'] = '<div class="btn-group" role="group" aria-label="actions">';

            

                $nestedData['action'] = $nestedData['action'].'<a href="'.route('service.edit',$service->id).'" class="btn btn-sm btn-primary text-white rowEdit" data-id="'.$service->id.'"><i class="fa fa-edit"></i>Edit</a>';
                
                $nestedData['action'] = $nestedData['action'] .'<button class="btn btn-sm btn-danger text-white rowDelete" data-link="'.route('service.destroy',$service->id).'" data-id="'.$service->id.'"><i class="fa fa-trash"></i>Delete</button>';

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
        return view('admin.service.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $service = new Service();

        //for photo
        if($request->icon){
            $fileName = time().'_'.$request->icon->getClientOriginalName();
            $filePath = $request->file('icon')->storeAs('uploads/users', $fileName, 'public');
            $modifiedPath = '/storage/'.$filePath;
            }else{
                $modifiedPath='';
            }

        $service->name = $request->name;

        $service->icon = $modifiedPath;

        $service->details = $request->details;

        $service->save();

        return redirect()->route('service.index')->with('message','Service Added Sucessfully');


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
        $service = Service::findOrFail($id);
       
        return view('admin.service.edit', compact('service'));
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
        $service = Service::findOrFail($id);

        //for photo
        if($request->icon){
            $fileName = time().'_'.$request->icon->getClientOriginalName();
            $filePath = $request->file('icon')->storeAs('uploads/users', $fileName, 'public');
            $modifiedPath = '/storage/'.$filePath;
            }else{
                $modifiedPath='';
            }

        $service->name = $request->name;

        if($request->icon){
        $service->icon = $modifiedPath;
        }
        
        $service->details = $request->details;

        $service->save();

        return redirect()->route('service.index')->with('message','Service Updated Sucessfully');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $service = Service::findOrFail($request->id);
        $service->delete();

        return redirect()->route('service.index')->with('message','Service Deleted Sucessfully');
    }
}
