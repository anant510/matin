<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use App\Models\User;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dataCount = Ticket::count();
        return view('admin.ticket.index',compact('dataCount'));
    }

    public function ajaxTable(Request $request)
    {
        $columns = array(
            0 => 'id',
            1 => 'unique_id',
            2 => 'user',
            3 => 'user_id',
            4 => 'topic',
            5 => 'content',
            6 => 'created_at',
            7 => 'action',
        );

        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];;
        $dir   = $request->input('order.0.dir');
        
        if($request->input('search.value'))
            $search = $request->input('search.value');

        $totalData = Ticket::count();
        $tickets  = Ticket::select('tickets.*')->with('user');
       

        if($request->input('search.value')){
            $tickets = $tickets->where(function($qSearch)use($search){
                $qSearch = $qSearch->where('tickets.id','LIKE',"%{$search}%")
                            ->orWhere('tickets.created_at', 'LIKE',"%{$search}%");
            });
        }

        $totalFiltered = $tickets->get()->count();
        if($order!="action"){
            $tickets   = $tickets->orderBy($order,$dir)->offset($start)
                           ->limit($limit)
                           ->get();            
        }else{
            $tickets   = $tickets->offset($start)
                           ->limit($limit)
                           ->get();
        }

        $data = array();
        if(!empty($tickets))
        {   
            $i = $start;
            foreach ($tickets as $ticket)
           
            {

               

                $nestedData['id']      = ++$i;
                $nestedData['unique_id']  = $ticket->unique_id;
                $nestedData['user']        = $ticket->user->name;
                $nestedData['user_id']        = $ticket->user->email;
                $nestedData['topic']        = $ticket->topic;
                $nestedData['content']        = substr($ticket->content, 0, 30) . '...';
                $nestedData['created_at']     = $ticket->created_at;
                

                $nestedData['action'] = '<div class="btn-group" role="group" aria-label="actions">';

            

                $nestedData['action'] = $nestedData['action'].'<a href="'.route('ticket.show',$ticket->id).'" class="btn btn-sm btn-primary text-white rowEdit" data-id="'.$ticket->id.'"><i class="fa fa-eye"></i>Show</a>';
                
                $nestedData['action'] = $nestedData['action'] .'<button class="btn btn-sm btn-danger text-white rowDelete" data-link="'.route('ticket.destroy',$ticket->id).'" data-id="'.$ticket->id.'"><i class="fa fa-trash"></i>Delete</button>';

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
        // $users = User::all();
        $tickets = Ticket::all();
       
    
        
        
        
        return view('admin.ticket.create',compact('tickets'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $ticket = new Ticket();

        $ticket->unique_id = $request->unique_id;
        $ticket->user_id = $request->user_id;
        $ticket->topic = $request->topic;
        $ticket->content = $request->content;

        $ticket->save();

        return redirect()->back()->with('message','Ticket Created Sucessfully');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $ticket = Ticket::findOrFail($id);
        // dd($ticket);
        return view('admin.ticket.show',compact('ticket'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $lead = Ticket::findOrFail($request->id);
        $lead->delete();
    
        return redirect()->route('ticket.index')->with('message','Ticket Deleted Sucessfully');

    }
}
