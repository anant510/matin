<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $dataCount = User::count();
        return view('admin.user.index',compact('dataCount'));
    }

    public function ajaxTable(Request $request)
    {
        $columns = array(
            0 => 'id',
            1 => 'name',
            2 => 'email',
            3 => 'phone',
            4 => 'photo',
            5 => 'created_at',
            6 => 'action',
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
                $nestedData['email']        = $user->email;
                $nestedData['phone']        = $user->phone;
                if($user->photo){
                $nestedData['photo']  = '<img height="80px" src="'.asset($user->photo).'">';
                }else{
                $nestedData['photo'] = "";
                }   
                $nestedData['created_at']     = $user->created_at;
                

                $nestedData['action'] = '<div class="btn-group" role="group" aria-label="actions">';

            

                $nestedData['action'] = $nestedData['action'].'<a href="'.route('user.show',$user->id).'" class="btn btn-sm btn-success text-white rowEdit" data-id="'.$user->id.'"><i class="fa fa-eye"></i>Show</a>';
                
                if(auth()->user()->role  == 1){

                $nestedData['action'] = $nestedData['action'].'<a href="'.route('bill.show',$user->id).'" class="btn btn-sm btn-secondary text-white rowEdit" data-id="'.$user->id.'"> Generate Bill</a>';

                
                $nestedData['action'] = $nestedData['action'].'<a href="'.route('user.edit',$user->id).'" class="btn btn-sm btn-primary text-white rowEdit" data-id="'.$user->id.'"><i class="fa fa-edit"></i>Edit</a>';

                $nestedData['action'] = $nestedData['action'] .'<button class="btn btn-sm btn-danger text-white rowDelete" data-link="'.route('user.destroy',$user->id).'" data-id="'.$user->id.'"><i class="fa fa-trash"></i>Delete</button>';
                }                    
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
        return view('admin.user.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = new User();

        //for photo
        if($request->photo){
            $fileName = time().'_'.$request->photo->getClientOriginalName();
            $filePath = $request->file('photo')->storeAs('uploads/users', $fileName, 'public');
            $modifiedPath = '/storage/'.$filePath;
            }else{
                $modifiedPath='';
            }

        $user->name = $request->name;
        $user->email = $request->email;
        // $user->password = Hash::make($request->password);
        $user->phone = $request->phone;
        $user->company_name = $request->company_name;
        $user->address = $request->address;
        $user->web = $request->web;

        $user->photo = $modifiedPath;

        $user->save();

        return redirect()->route('user.index')->with('message','User Added Sucessfully.');
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

        return view('admin.user.show',compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);

        return view('admin.user.edit',compact('user'));
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
        $user = User::findOrFail($id);

        if($request->photo){
            $fileName = time().'_'.$request->photo->getClientOriginalName();
            $filePath = $request->file('photo')->storeAs('uploads/users', $fileName, 'public');
            $modifiedPath = '/storage/'.$filePath;
            }else{
                $modifiedPath='';
            }

        $user->name = $request->name;
        $user->email = $request->email;
        // $user->password = Hash::make($request->password);
        $user->phone = $request->phone;
        $user->company_name = $request->company_name;
        $user->address = $request->address;
        $user->web = $request->web;

        if($request->photo){
        $user->photo = $modifiedPath;
        }
        $user->save();

        return redirect()->route('user.index')->with('message','User Updated Sucessfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $user = User::findOrFail($request->id);
        // dd($user->id);
        $user->delete();
        return redirect()->route('user.index')->with('message','User Deleted Sucessfully');
    }
}
