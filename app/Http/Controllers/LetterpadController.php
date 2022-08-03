<?php

namespace App\Http\Controllers;

use App\Models\Letterpad;
use Illuminate\Http\Request;

class LetterpadController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dataCount = Letterpad::count();
        return view('admin.letterpad.index',compact('dataCount'));
    }

    public function ajaxTable(Request $request)
    {
        $columns = array(
            0 => 'id',
            1 => 'date',
            2 => 'content',
            3 => 'created_at',
            4 => 'action',
        );

        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];;
        $dir   = $request->input('order.0.dir');
        
        if($request->input('search.value'))
            $search = $request->input('search.value');

        $totalData = Letterpad::count();
        $letterpads  = Letterpad::select('letterpads.*');
        

        if($request->input('search.value')){
            $letterpads = $letterpads->where(function($qSearch)use($search){
                $qSearch = $qSearch->where('letterpads.id','LIKE',"%{$search}%")
                            ->orWhere('letterpads.created_at', 'LIKE',"%{$search}%");
            });
        }

        $totalFiltered = $letterpads->get()->count();
        if($order!="action"){
            $letterpads   = $letterpads->orderBy($order,$dir)->offset($start)
                           ->limit($limit)
                           ->get();            
        }else{
            $letterpads   = $letterpads->offset($start)
                           ->limit($limit)
                           ->get();
        }

        $data = array();
        if(!empty($letterpads))
        {   
            $i = $start;
            foreach ($letterpads as $letterpad)
         
     
            {
                $nestedData['id']             = ++$i;
                $nestedData['date'] = $letterpad->date;
                $nestedData['content']        = substr($letterpad->content, 0, 350) . '...';
                $nestedData['created_at']     = $letterpad->created_at;
                $nestedData['action'] = '<div class="btn-group" role="group" aria-label="actions">';

                $nestedData['action'] = $nestedData['action'].'<a href="'.route('letterpad.show',$letterpad->id).'" class="btn btn-sm btn-secondary text-white rowletterpad" data-id="'.$letterpad->id.'">Letterpad</a>';

                $nestedData['action'] = $nestedData['action'].'<a href="'.route('letterpad.edit',$letterpad->id).'" class="btn btn-sm btn-primary text-white rowEdit" data-id="'.$letterpad->id.'"><i class="fa fa-edit"></i>Edit</a>';
                
                $nestedData['action'] = $nestedData['action'] .'<button class="btn btn-sm btn-danger text-white rowDelete" data-link="'.route('letterpad.destroy',$letterpad->id).'" data-id="'.$letterpad->id.'"><i class="fa fa-trash"></i>Delete</button>';

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
        return view('admin.letterpad.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $letterpad = new Letterpad();

        $letterpad->content  = $request->content;
        $letterpad->date  = $request->date;

        $letterpad->save();

        return redirect()->route('letterpad.index')->with('message','Added Content');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $letterpad = Letterpad::findOrFail($id);

        return view('admin.letterpad.show',compact('letterpad'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $letterpad = Letterpad::findOrFail($id);

        return view('admin.letterpad.edit',compact('letterpad'));
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
        $letterpad = Letterpad::findOrFail($id);

        $letterpad->content  = $request->content;
        $letterpad->date  = $request->date;

        $letterpad->save();

        return redirect()->route('letterpad.index')->with('message',"Updated Sucessfully");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $letterpad = Letterpad::findOrFail($request->id);

        $letterpad->delete();

        return redirect()->route('letterpad.index')->with('message',"Deleted Sucessfully");
    }
}
