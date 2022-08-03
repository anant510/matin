<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Lead;
use Illuminate\Http\Request;
use PhpParser\Node\Stmt\Catch_;

class LeadController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        // dd('hi');
        $dataCount = Lead::count();
        return view('admin.lead.index',compact('dataCount'));
    }

    public function ajaxTable(Request $request)
    {
        $columns = array(
            0 => 'id',
            1 => 'category_id',
            2 => 'name',
            3 => 'email',
            4 => 'phone',
            5 => 'notes',
            6 => 'date',
            7 => 'created_at',
            8 => 'action',
        );

        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];;
        $dir   = $request->input('order.0.dir');
        
        if($request->input('search.value'))
            $search = $request->input('search.value');

        $totalData = Lead::count();
        $leads  = Lead::select('leads.*')->with('category');
        

        if($request->input('search.value')){
            $leads = $leads->where(function($qSearch)use($search){
                $qSearch = $qSearch->where('leads.id','LIKE',"%{$search}%")
                            ->orWhere('leads.created_at', 'LIKE',"%{$search}%");
            });
        }

        $totalFiltered = $leads->get()->count();
        if($order!="action"){
            $leads   = $leads->orderBy($order,$dir)->offset($start)
                           ->limit($limit)
                           ->get();            
        }else{
            $leads   = $leads->offset($start)
                           ->limit($limit)
                           ->get();
        }

        $data = array();
        if(!empty($leads))
        {   
            $i = $start;
            foreach ($leads as $lead)
         
     
            {
                $nestedData['id']      = ++$i;
                $nestedData['category_id']  = $lead->category->name;
                $nestedData['name']        = $lead->name;
                $nestedData['email']        = $lead->email;
                $nestedData['phone']        = $lead->phone;
                $nestedData['notes']        = $lead->notes;
                $nestedData['date']        = $lead->date;
                $nestedData['created_at']     = $lead->created_at;
                

                $nestedData['action'] = '<div class="btn-group" role="group" aria-label="actions">';

            

                $nestedData['action'] = $nestedData['action'].'<a href="'.route('lead.edit',$lead->id).'" class="btn btn-sm btn-primary text-white rowEdit" data-id="'.$lead->id.'"><i class="fa fa-edit"></i>Edit</a>';
                
                $nestedData['action'] = $nestedData['action'] .'<button class="btn btn-sm btn-danger text-white rowDelete" data-link="'.route('lead.destroy',$lead->id).'" data-id="'.$lead->id.'"><i class="fa fa-trash"></i>Delete</button>';

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
        $category_datas = Category::all();
        return view('admin.lead.create', compact('category_datas'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $lead = new Lead();

        $lead->category_id = $request->category_id;
        $lead->name = $request->name;
        $lead->email = $request->email;
        $lead->phone = $request->phone;
        $lead->notes = $request->notes;
        $lead->date = $request->date;

        $lead->save();

        return redirect()->route('lead.index')->with('message','Lead Added Sucessfully');

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

        $lead = Lead::findOrFail($id);

        $category_datas = Category::all();

        return view('admin.lead.edit', compact('lead','category_datas'));
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
        $lead = Lead::findOrFail($id);

        $lead->category_id = $request->category_id;
        $lead->name = $request->name;
        $lead->email = $request->email;
        $lead->phone = $request->phone;
        $lead->notes = $request->notes;
        $lead->date = $request->date;

        $lead->save();

        return redirect()->route('lead.index')->with('message','Lead Updated Sucessfully');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
       
        $lead = Lead::findOrFail($request->id);
        $lead->delete();

        
        return redirect()->route('lead.index')->with('message','Lead Deleted Sucessfully');
    }
}
