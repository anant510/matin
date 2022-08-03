<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AgreementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dataCount = User::count();
        return view('admin.agreement.index',compact('dataCount'));

    }

    public function ajaxTable(Request $request)
    {
        $columns = array(
            0 => 'id',
            1 => 'name',
            2 => 'phone',
            3 => 'created_at',
            4 => 'action',
        );

        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];;
        $dir   = $request->input('order.0.dir');
        
        if($request->input('search.value'))
            $search = $request->input('search.value');

        $totalData = User::count();
        $users  = User::select('users.*');
       

        if($request->input('search.value')){
            $users = $users->where(function($qSearch)use($search){
                $qSearch = $qSearch->where('users.id','LIKE',"%{$search}%")
                            ->orWhere('users.created_at', 'LIKE',"%{$search}%");
            });
        }

        $totalFiltered = $users->get()->count();
        if($order!="action"){
            $users   = $users->orderBy($order,$dir)->offset($start)
                           ->limit($limit)
                           ->get();            
        }else{
            $users   = $users->offset($start)
                           ->limit($limit)
                           ->get();
        }

        $data = array();
        if(!empty($users))
        {   
            $i = $start;
            foreach ($users as $user)
           
            {
  

                $nestedData['id']      = ++$i;
                $nestedData['name']  = $user->name;
                $nestedData['phone']        = $user->phone;
                $nestedData['created_at']     = $user->created_at;
                

                $nestedData['action'] = '<div class="btn-group" role="group" aria-label="actions">';

            

                $nestedData['action'] = $nestedData['action'].'<a href="'.route('agreement.show',$user->id).'" class="btn btn-sm btn-primary text-white rowEdit" data-id="'.$user->id.'"><i class="fa fa-eye"></i>Agreement</a>';
                
                // if($user->role == 0){
                // $nestedData['action'] = $nestedData['action'] .'<button class="btn btn-sm btn-danger text-white rowDelete" data-link="'.route('user.destroy',$user->id).'" data-id="'.$user->id.'"><i class="fa fa-trash"></i>Delete</button>';
                // }                    
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
        $user = User::findOrFail($id);
        return view('admin.agreement.show',compact('user'));
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
    public function destroy($id)
    {
        //
    }
}
