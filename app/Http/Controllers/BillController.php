<?php

namespace App\Http\Controllers;

use App\Models\Bill;
use App\Models\User;
use Illuminate\Http\Request;

class BillController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dataCount = Bill::count();
        return view('admin.bill.index',compact('dataCount'));
    }

    public function ajaxTable(Request $request)
    {
        $columns = array(
            0 => 'id',
            1 => 'user_id',
            2 => 'name',
            5 => 'created_at',
            6 => 'action',
        );

        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];;
        $dir   = $request->input('order.0.dir');
        
        if($request->input('search.value'))
            $search = $request->input('search.value');

        $totalData = Bill::count();
        $bills  = Bill::with('user');
      
       

        if($request->input('search.value')){
            $bills = $bills->where(function($qSearch)use($search){
                $qSearch = $qSearch->where('bills.id','LIKE',"%{$search}%")
                            ->orWhere('bills.user_id', 'LIKE',"%{$search}%")
                            ->orWhere('bills.created_at', 'LIKE',"%{$search}%");
            });
        }

        $totalFiltered = $bills->get()->count();
        if($order!="action"){
            $bills   = $bills->orderBy($order,$dir)->offset($start)
                           ->limit($limit)
                           ->get();            
        }else{
            $bills   = $bills->offset($start)
                           ->limit($limit)
                           ->get();
        }

        $data = array();
        if(!empty($bills))
        {   
            $i = $start;
            foreach ($bills as $bill)
           
            {
  

                $nestedData['id']      = ++$i;
                $nestedData['user_id']  = $bill->user_id;
                $nestedData['name']        = $bill->user->name;  
                $nestedData['created_at']     = $bill->created_at;
                

                $nestedData['action'] = '<div class="btn-group" role="group" aria-label="actions">';

                if(auth()->user()->role  == 1){
                    $nestedData['action'] = $nestedData['action'].'<a href="'.route('bill.edit',$bill->id).'" class="btn btn-sm btn-primary text-white rowEdit" data-id="'.$bill->id.'"> Edit</a>';

 
                    $nestedData['action'] = $nestedData['action'] .'<button class="btn btn-sm btn-danger text-white rowDelete" data-link="'.route('bill.destroy',$bill->id).'" data-id="'.$bill->id.'"><i class="fa fa-trash"></i>Delete</button>';

                }                    
                
                $nestedData['action'] = $nestedData['action'].'<a href="'.route('bill.show_bill',$bill->id).'" class="btn btn-sm btn-secondary text-white rowShow" data-id="'.$bill->id.'"> Show Bill</a>';

               
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
        return view('admin.bill.show',compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $bill = Bill::findOrFail($id);
        
        return view('admin.bill.edit',compact('bill'));
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
        $bill = Bill::findOrFail($id);

        $bill->status = $request->status;
        $bill->date = $request->date;
 
        $bill->total = $request->total;
        $bill->total_one = $request->total_one;
        $bill->total_two = $request->total_two;
        $bill->total_three = $request->total_three;
        $bill->total_four = $request->total_four;
     
 
        $bill->sn = $request->sn;
        $bill->sn_one = $request->sn_one;
        $bill->sn_two = $request->sn_two;
        $bill->sn_three = $request->sn_three;
        $bill->sn_four = $request->sn_four;
 
        $bill->name = $request->name;
        $bill->name_one = $request->name_one;
        $bill->name_two = $request->name_two;
        $bill->name_three = $request->name_three;
        $bill->name_four = $request->name_four;
 
        $bill->price = $request->price;
        $bill->price_one = $request->price_one;
        $bill->price_two = $request->price_two;
        $bill->price_three = $request->price_three;
        $bill->price_four = $request->price_four;
 
        $bill->quantity = $request->quantity;
        $bill->quantity_one = $request->quantity_one;
        $bill->quantity_two = $request->quantity_two;
        $bill->quantity_three = $request->quantity_three;
        $bill->quantity_four = $request->quantity_four;
 
      
        $bill->sub_total = $request->sub_total;
 
        $bill->vat = $request->vat;
 
        $bill->all_total = $request->all_total;
 
        $bill->save();

        return redirect()->route('bill.index')->with('message','Bill Updated Sucessfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {   
        $bill = Bill::findOrFail($request->id);
      
        $bill->delete();

        return redirect()->route('bill.index')->with('message','Bill Deleted Sucessfully');
    }

    public function get_data(Request $request,$id)
    {       

       
       
     
       $user = User::findOrFail($id);

       $bill = new Bill();

       $bill->user_id = $user->id;

       $bill->status = $request->status;
       $bill->date = $request->date;

       $bill->total = $request->total;
       $bill->total_one = $request->total_one;
       $bill->total_two = $request->total_two;
       $bill->total_three = $request->total_three;
       $bill->total_four = $request->total_four;
    

       $bill->sn = $request->sn;
       $bill->sn_one = $request->sn_one;
       $bill->sn_two = $request->sn_two;
       $bill->sn_three = $request->sn_three;
       $bill->sn_four = $request->sn_four;

       $bill->name = $request->name;
       $bill->name_one = $request->name_one;
       $bill->name_two = $request->name_two;
       $bill->name_three = $request->name_three;
       $bill->name_four = $request->name_four;

       $bill->price = $request->price;
       $bill->price_one = $request->price_one;
       $bill->price_two = $request->price_two;
       $bill->price_three = $request->price_three;
       $bill->price_four = $request->price_four;

       $bill->quantity = $request->quantity;
       $bill->quantity_one = $request->quantity_one;
       $bill->quantity_two = $request->quantity_two;
       $bill->quantity_three = $request->quantity_three;
       $bill->quantity_four = $request->quantity_four;

     
       $bill->sub_total = $request->sub_total;

       $bill->vat = $request->vat;

       $bill->all_total = $request->all_total;

       $bill->save();

       return redirect()->route('user.index')->with('message','Bill Added Sucessfully');
       
       
    }

    public function show_bill($id)
    {
        $bill = Bill::findOrFail($id);
        return view('admin.bill.show_bill',compact('bill'));
    }
}
