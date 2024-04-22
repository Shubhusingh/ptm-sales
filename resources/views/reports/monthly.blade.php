@extends('layouts.app')
@section("breadcrumb")
<li class="breadcrumb-item"><a href="#">@lang('menu.reports')</a></li>
<li class="breadcrumb-item active">@lang('fleet.monthlyReport')</li>
@endsection
@section('content')

<div class="row">
  <div class="col-md-12">
    <div class="card card-info">
      <div class="card-header">
        <h3 class="card-title">@lang('fleet.monthlyReport')
        </h3>
      </div>
     
 
      <div class="card-body">
        {!! Form::open(['route' => 'reports.monthly','method'=>'post','class'=>'form-inline']) !!}
        <div class="row">
         
          <div class="form-group" style="margin-right: 10px">
            {!! Form::label('month', __('fleet.month'), ['class' => 'form-label']) !!}
            <div class="form-group" style="margin-left:5px;">
            {!! Form::selectMonth('month',$month_select,['class'=>'form-control']) !!}</div>
          </div>
         
          <button type="submit" class="btn btn-info" style="margin-right: 10px">@lang('fleet.generate_report')</button>
        </div>
        {!! Form::close() !!}
      </div>
    </div>
  </div>
</div>
    

@if(isset($search))
<div class="row">
  <div class="col-md-12">
    <div class="card card-info">
      <div class="card-header">
        <h3 class="card-title">
          @lang('fleet.report')
        </h3>
      </div>
    <div class="card-body table-responsive">
           <table id="example" class="display nowrap table-bordered" style="width:100%">
        <thead>
            <tr>
                 <th>#</th>
                               <th>Vehicle Details</th>
                                <th>Image</th>
             
              <th>Serial No</th>
              <th>Date</th>
               <th>Type Service</th>
               <th>Review</th>
                 
                                                               <th>Supervisor</th>
              <!--<th>@lang('fleet.action')</th>-->
                              
                                <!--<th>@lang('fleet.action')</th>-->
            </tr>
        </thead>
        <tbody>
            @php 
            $sno=1;
            @endphp
            @foreach($search as $value)
            <tr>
                <td>{{$sno++}}</td>
                <td>{{$value->vehicle_no}}</td>
<!--                <td><img src="{{ asset('uploads/tyre/'.$value->image) }}" style="width: 55px;-->
<!--"></td>-->

<td>
    
    
                
                    <a href="{{ asset('uploads/tyre/'.$value->image) }}" download>
  Download1
</a>

@if(!empty($value->image2))
                   <a href="{{ asset('uploads/tyre/'.$value->image2) }}" download>
  Download 2
</a>
@else


@endif
<br>

@if(!empty($value->image3))
                  <a href="{{ asset('uploads/tyre/'.$value->image3) }}" download>
  Download 3
</a>
@else


@endif
  
</td>
                <td>{{$value->serial ?? 0}}</td>
               <td>{{$value->date ?? 0}}
                {{$value->time ?? 0}}</td>
               <td>{{$value->service ?? 0}}</td>
              <td>{{$value->review ?? ''}}</td>
              @php
                
                $userdetail=DB::table('users')->where('id',$value->user_id)->select('name')->first();
                
                @endphp
            
                <td>{{$userdetail->name ?? ''}}</td>
            </tr>
            @endforeach
         
        </tbody>
       
    </table>
          
       
      </div>
    </div>
  </div>
</div>
@endif

@endsection

@section("script2")
<script>
window.chartColors = {
  red: 'rgb(255, 99, 132)',
  orange: 'rgb(255, 159, 64)',
  yellow: 'rgb(255, 205, 86)',
  green: 'rgb(75, 192, 192)',
  blue: 'rgb(54, 162, 235)',
  purple: 'rgb(153, 102, 255)',
  grey: 'rgb(201, 203, 207)',
  black: 'rgb(0,0,0)'
};
function random_color(i){
  var color1,color2,color3;
  var col_arr=[];
  for(x=0;x<=i;x++){

  var c1 = [176,255,84,220,134,66,238];
  var c2 = [254,61,147,114,51,26,137];
  var c3 = [27,111,153,93,157,216,187,44,243];
  color1 = c1[Math.floor(Math.random()*c1.length)];
  color2 = c2[Math.floor(Math.random()*c2.length)];
  color3 = c3[Math.floor(Math.random()*c3.length)];

  col_arr.push("rgba("+color1+","+color2+","+color3+",0.5)");
  }
  return col_arr;
}

var chartData = {
    labels: ["@lang('fleet.income')", "@lang('fleet.expenses')"],
    datasets: [{
        type: 'pie',
        label: '',
        backgroundColor: [window.chartColors.green,window.chartColors.red],
        borderColor: window.chartColors.black,
        borderWidth: 1,
        data: [{{@$income_amt}},{{@$expense_amt}}]
    }]
};

var chartData2 = {
  labels: [@foreach($income_by_cat as $exp) "{{$income_cats[$exp->income_cat]}}", @endforeach],
  datasets: [{
      type: 'pie',
      label: '',
      backgroundColor: random_color({{count($income_by_cat)}}),
      borderColor: window.chartColors.black,
      borderWidth: 1,
      data: [@foreach($income_by_cat as $exp) {{$exp->driver_amount??$exp->amount}}, @endforeach]
  }]
};

var chartData3 = {
    labels: [@foreach($expense_by_cat as $exp) "@if($exp->type == "s"){{$service[$exp->expense_type]}} @else{{$expense_cats[$exp->expense_type]}}@endif", @endforeach],
    datasets: [{
        type: 'pie',
        label: '',
        backgroundColor: random_color({{count($expense_by_cat)}}),
        borderColor: window.chartColors.black,
        borderWidth: 1,
        data: [@foreach($expense_by_cat as $exp) {{$exp->expense}}, @endforeach]
    }]
};

window.onload = function() {
    var ctx = document.getElementById("canvas1").getContext("2d");
    window.myMixedChart = new Chart(ctx, {
        type: 'pie',
        data: chartData,
        options: {

            responsive: true,
            title: {
                display: false,
                text: "@lang('fleet.chart')"
            },
            tooltips: {
                mode: 'index',
                intersect: true
            }
        }
    });
    var ctx = document.getElementById("canvas3").getContext("2d");
    window.myMixedChart = new Chart(ctx, {
        type: 'pie',
        data: chartData3,
        options: {

            responsive: true,
            title: {
                display: false,
                text: "@lang('fleet.chart')"
            },
            tooltips: {
                mode: 'index',
                intersect: true
            }
        }
    });

    var ctx = document.getElementById("canvas2").getContext("2d");
    window.myMixedChart = new Chart(ctx, {
        type: 'pie',
        data: chartData2,
        options: {

            responsive: true,
            title: {
                display: false,
                text: "@lang('fleet.chart')"
            },
            tooltips: {
                mode: 'index',
                intersect: true
            }
        }
    });
};

</script>
@endsection
@section("script")
<script type="text/javascript">
  $(document).ready(function() {
    $('#vehicle_id').select2();
      $('.myTable').DataTable({
        "paging":   false,
        "ordering": false,
        "searching": false,
        "info":     false,

        dom: 'Bfrtip',
        buttons: [{
             extend: 'collection',
                text: '@lang('fleet.Export')',
                buttons: [
                    'copy',
                    'excel',
                    'csv',
                    'pdf',
                ]}
        ],
        "language": {
                 "url": '{{ asset("assets/datatables/")."/".__("fleet.datatable_lang") }}',
              }
    });

    $('.expTable').DataTable({
      "ordering": false,
      "searching": false,
      "info":     false,
      "pageLength": 5,
      dom: 'Bfrtip',
      buttons: [{
           extend: 'collection',
              text: '@lang('fleet.Export')',
              buttons: [
                  'copy',
                  'excel',
                  'csv',
                  'pdf',
              ]}
      ],
      "language": {
               "url": '{{ asset("assets/datatables/")."/".__("fleet.datatable_lang") }}',
            }
    });
  });
</script>
@endsection