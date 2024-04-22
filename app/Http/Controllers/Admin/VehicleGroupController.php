<?php



namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\VehicleGroupRequest;
use App\Model\VehicleGroupModel;
use Auth;
use DataTables;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class VehicleGroupController extends Controller {
	public function __construct() {
		// $this->middleware(['role:Admin']);
		$this->middleware('permission:VehicleGroup add', ['only' => ['create']]);
		$this->middleware('permission:VehicleGroup edit', ['only' => ['edit']]);
		$this->middleware('permission:VehicleGroup delete', ['only' => ['bulk_delete', 'destroy']]);
		$this->middleware('permission:VehicleGroup list');
	}

	public function index() {
	   
	    
	     if(Auth::user()->id==1){
	       $data=VehicleGroupModel::orderBy('id','desc')->get();  
	    }else{
	        
	         $data=VehicleGroupModel::orderBy('id','desc')->where('user_id',Auth::user()->id)->get();
	    }
	    
		return view('vehicle_groups.index',compact('data'));
	}

	public function fetch_data(Request $request) {
		if ($request->ajax()) {

			if (Auth::user()->user_type == "S" || Auth::user()->group_id == null) {
				$vehicle_groups = VehicleGroupModel::query();
			} else {
				// $vehicle_groups = VehicleGroupModel::where('id', Auth::user()->group_id);
				$vehicle_groups = VehicleGroupModel::where('user_id', Auth::user()->id)->orwhere('id', Auth::user()->group_id);
				// dd($vehicle_groups);
			}

			return DataTables::eloquent($vehicle_groups)
				->addColumn('check', function ($vehicle) {
					$tag = '';
					if ($vehicle->id == '1') {
						$tag = '<i class="fa fa-ban" style="color:#767676;"></i>';
					}else{
						$tag = '<input type="checkbox" name="ids[]" value="' . $vehicle->id . '" class="checkbox" id="chk' . $vehicle->id . '" onclick=\'checkcheckbox();\'>';
					}

					return $tag;
				})

				->addColumn('vehicle_count', function ($vehicle) {
					$v = DB::table('vehicles')
						->where('group_id', $vehicle->id)->where('deleted_at', null)
						->count('group_id');
					return $v;
				})
				->addColumn('user_count', function ($vehicle) {
					$v = DB::table('users')->where('group_id', $vehicle->id)->where('deleted_at', null)->count('group_id');
					return $v;
				})
				->addColumn('action', function ($vehicle) {
					return view('vehicle_groups.list-actions', ['row' => $vehicle]);
				})
				->addIndexColumn()
				->rawColumns(['action', 'check'])
				->make(true);
			//return datatables(User::all())->toJson();

		}
	}

	public function create() {
		return view('vehicle_groups.create');
	}

	public function store(Request $request) {
	    $today= Carbon::now();
	    
 date_default_timezone_set('Asia/Kolkata');
$currentTime = date( 'h:i A', time () );
	    
	   if($request->hasfile('image'))
        {
            $file = $request->file('image');
            $extenstion = $file->getClientOriginalExtension();
            $filename = time().'.'.$extenstion;
            $file->move('uploads/tyre/', $filename);
            
            
            
            
            
            
              $file2 = $request->file('image2');
              if(!empty($file2)){
            $extenstion = $file2->getClientOriginalExtension();
            $filename2 = time().'.'.$extenstion;
            $file2->move('uploads/tyre/', $filename2);
        }else{
            $filename2='';
        }
            
            
            $file3 = $request->file('image3');
            if(!empty($file3)){
            $extenstion = $file3->getClientOriginalExtension();
            $filename3 = time().'.'.$extenstion;
            $file3->move('uploads/tyre/', $filename3);
            }else{
                $filename3=''; 
            }

	$group = new VehicleGroupModel();
		$group->name = '';
		$group->description = '';
		$group->note = '';
		$group->user_id=Auth::user()->id;
			foreach ($request->service as $sku) {
		if($sku=='patch no 3' || $sku=='patch no 4' || $sku=='patch no 5' || $sku=='patch no 6' || $sku=='patch no 7' ||  $sku=='patch no 10' || $sku=='patch no 12'
		|| $sku=='patch no 13' || $sku=='patch no 14' || $sku=='patch no 15' || $sku=='patch no 20' || $sku=='patch no 30'  ||  $sku=='patch no 32' ||  $sku=='patch no 33'
		||  $sku=='patch no 35' ||  $sku=='patch no 37' ||  $sku=='patch no 38' ||  $sku=='patch no 40' ||  $sku=='patch no 42' ||  $sku=='patch no 44'
		 ||  $sku=='patch no 45' ||  $sku=='patch no 46' ||  $sku=='patch no 48' ||  $sku=='patch no 50' || $sku=='patch no 52' || $sku=='patch no 55' 
		 || $sku=='patch no 84' || $sku=='patch no 86'){
		$group->color="red";
	 }else{
     $group->color="green";
}
              
    }
		$group->service=implode(',',$request->service);
		$group->vehicle_no=$request->searchno;
		$group->review=$request->review;
		$group->date=$request->date ?? '';
			$group->time=$currentTime ?? '';
		$group->image=$filename;
		$group->image2=$filename2 ?? '';
		$group->image3=$filename3 ?? '';
		$group->serial=$request->serialno ?? '';
		$group->month=$today->month ?? '';

$group->save();
        }
		return redirect()->route('vehicle_group.index');
	}

	public function edit($id) {
		$index['data'] = VehicleGroupModel::where('id', $id)->first();
		return view('vehicle_groups.edit', $index);

	}

	public function update(VehicleGroupRequest $request) {
	    
  if($request->hasfile('image'))
        {
            $file = $request->file('image');
            $extenstion = $file->getClientOriginalExtension();
            $filename = time().'.'.$extenstion;
            $file->move('uploads/tyre/', $filename);
           
        
		$group = new VehicleGroupModel();
		$group->name = '';
		$group->description = '';
		$group->note = '';
		$group->user_id=1;
		$group->service=implode(',',$request->service);
		$group->vehicle_no=$request->searchno;
		$group->review=$request->review;
		$group->date=$request->date ?? '';
		$group->image=$filename;
		$group->serial=$request->serial ?? '';
		$group->save();
        }
		return redirect()->route('vehicle_group.index');

	}

	public function destroy(Request $request) {

		VehicleGroupModel::find($request->id)->delete();
		return redirect()->route('vehicle_group.index');
	}

	public function bulk_delete(Request $request) {
		VehicleGroupModel::whereIn('id', $request->ids)->delete();
		return back();
	}
}