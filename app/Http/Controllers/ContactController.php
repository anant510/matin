<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dataCount = Contact::count();
        return view('admin.contact.index',compact('dataCount'));
    }

    public function ajaxTable(Request $request)
    {
        $columns = array(
            0 => 'id',
            1 => 'name',
            2 => 'email',
            3 => 'message',
            4 => 'created_at',
            5 => 'action',
        );

        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];;
        $dir   = $request->input('order.0.dir');
        
        if($request->input('search.value'))
            $search = $request->input('search.value');

        $totalData = Contact::count();
        $contacts  = Contact::select('contacts.*');
       

        if($request->input('search.value')){
            $contacts = $contacts->where(function($qSearch)use($search){
                $qSearch = $qSearch->where('contacts.id','LIKE',"%{$search}%")
                            ->orWhere('contacts.created_at', 'LIKE',"%{$search}%");
            });
        }

        $totalFiltered = $contacts->get()->count();
        if($order!="action"){
            $contacts   = $contacts->orderBy($order,$dir)->offset($start)
                           ->limit($limit)
                           ->get();            
        }else{
            $contacts   = $contacts->offset($start)
                           ->limit($limit)
                           ->get();
        }

        $data = array();
        if(!empty($contacts))
        {   
            $i = $start;
            foreach ($contacts as $contact)
           
            {

                $nestedData['id']      = ++$i;
                $nestedData['name']        = $contact->name;
                $nestedData['email']        = $contact->email;
                $nestedData['message']        = substr($contact->message, 0, 30) . '...';
                $nestedData['created_at']     = $contact->created_at;
                

                $nestedData['action'] = '<div class="btn-group" role="group" aria-label="actions">';

            

                $nestedData['action'] = $nestedData['action'].'<a href="'.route('contact.show',$contact->id).'" class="btn btn-sm btn-primary text-white rowEdit" data-id="'.$contact->id.'"><i class="fa fa-eye"></i>Show</a>';
                
                $nestedData['action'] = $nestedData['action'] .'<button class="btn btn-sm btn-danger text-white rowDelete" data-link="'.route('contact.destroy',$contact->id).'" data-id="'.$contact->id.'"><i class="fa fa-trash"></i>Delete</button>';

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
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $contact = Contact::findOrFail($id);

        return view('admin.contact.show',compact('contact'));
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
        $contact = Contact::findOrFail($request->id);
        $contact->delete();
    
        return redirect()->route('contact.index')->with('message','contact Deleted Sucessfully');
    }
}
