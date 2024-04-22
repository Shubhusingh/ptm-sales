@extends('layouts.app')
@section('extra_css')
    <style type="text/css">
    .modal {
    overflow: auto;
    overflow-y: hidden;
}
        /* .modal-open {
            margin-left: -250px
        } */

        .custom_padding {
            padding: .3rem !important;
        }

        .checkbox,
        #chk_all {
            width: 20px;
            height: 20px;
        }

        #loader {
            display: flex;
            justify-content: center;
            align-items: center;
            font-size: 20px;
            color: #555;
        }
    </style>
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item active">Fleet</li>
@endsection


    
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card card-info">
                <div class="card-header">
                    
                    <h3 class="card-title">Manage Fleet &nbsp; @can('Vehicles add')
                            <a href="{{route('fleet.create')}}" class="btn btn-success" title="@lang('fleet.addNew')"><i
                                    class="fa fa-plus"></i></a>
                        @endcan
                       
                    </h3>
                </div>
                
            

                <div class="card-body table-responsive">
                    
                    <table id="example" class="display nowrap table-bordered" style="width:100%">
        <thead>
            <tr>
                 <th>#</th>
                                
                                 <th>Fleet Name</th>
                                <th>Start Date</th>
                                 <th>End Date</th>
                               <th>Asset Install</th>
                                <th>Bussiness module</th>
                                                              <th>Fleet Address</th>
                                                              <th>Date</th>
                                                              
                                                               <th>Supervisor</th>
                                                              <th>Action</th>
                                                              
                                
            </tr>
        </thead>
       
        <tbody>
           
           @php
           $sno=1;
           
           @endphp
            @foreach($data as $value)
            <tr>
                <td>{{$sno++}}</td>
                 <td>{{$value->fleetname ?? 0}}</td>
                <td>{{$value->start ?? 0}}
                
                
                </td>
                <td>{{$value->end ?? 0}}</td>
             
               <td>{{$value->asset ?? 0}}</td>
              
              <td>{{$value->models ?? 0}}</td>
               <td>{{$value->address ?? 0}}</td>
                <td>{{$value->created_at ?? 0}}</td>
                @php
                
                $userdetail=DB::table('users')->where('id',$value->user_id)->select('name')->first();
                
                @endphp
            
                <td>{{$userdetail->name ?? ''}}</td>
                 <td><a href="{{route('fleet.edit',$value->id)}}" class="btn btn-danger">Edit</a>
                 
                 <a href="{{route('fleet.delete',$value->id)}}"   onclick="return confirm('Are you sure you want to delete this item?');" class="btn btn-danger">Delete</a>
                 </td>
                    
            </tr>
            @endforeach
         
        </tbody>
       
    </table>
                    
                    
                    <table class="table" id="example" style="padding-bottom: 25px">
                        <thead class="thead-inverse">
                            <tr>
                               
                             
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

   

   

 
@endsection

@section('script')
    <script type="text/javascript">
        $("#del_btn").on("click", function() {
            var id = $(this).data("submit");
            $("#form_" + id).submit();
        });

        $('#myModal').on('show.bs.modal', function(e) {
            var id = e.relatedTarget.dataset.id;
            $("#del_btn").attr("data-submit", id);
        });

        // $(document).on('click', '.openBtn', function() {
        //     // alert($(this).data("id"));
        //     var id = $(this).attr("data-id");
        //     $('#myModal2 .modal-body').load('{{ url('admin/vehicle/event') }}/' + id, function(result) {
        //         $('#myModal2').modal({
        //             show: true
        //         });
        //     });
        // });
        $(document).on('click', '.openBtn', function() {
            var id = $(this).attr("data-id");
            $('#myModal2 .modal-body').html('<div id="loader">Loading data...</div>');
            $('#myModal2').modal({
                show: true
            });
            $.ajax({
                url: '{{ url('admin/vehicle/event') }}/' + id,
                type: 'GET',
                success: function(result) {
                    $('#myModal2 .modal-body').html(result);
                },
                error: function() {
                    $('#myModal2 .modal-body').html('Error loading data.');
                },
                complete: function() {
                    $('#loader').hide();
                }
            });
        });


        $(function() {

            var table = $('#ajax_data_table').DataTable({
            
                processing: true,
             
                ajax: {
                    url: "{{ url('admin/vehicles-fetch') }}",
                    type: 'POST',
                    data: {}
                },
                columns: [
                    {
                        data: 'id',
                        name: 'id'
                    },
                    {
                        data: 'engine_type',
                        name: 'engine_type',
                        searchable: false,
                        orderable: false
                    },
                    {
                        data: 'vehicle_no',
                        name: 'vehicle_no',
                          searchable: false,
                        orderable: true
                    },
                    {
                        data: 'odometer',
                        name: 'odometer'
                    },
                    {
                        data: 'wheeler_no',
                        name: 'wheeler_no'
                    },
                    {
                        data: 'date',
                        name: 'date'
                    },
                   
                    // {data: 'assigned_driver', name: 'assigned_driver'},
                    {
                        data: 'action',
                        name: 'action',
                        searchable: false,
                        orderable: false
                    }
                ],
                order: [
                    [1, 'desc']
                ],
                "initComplete": function() {
                    table.columns().every(function() {
                        var that = this;
                        $('input', this.footer()).on('keyup change', function() {
                            // console.log($(this).parent().index());
                            that.search(this.value).draw();
                        });
                    });
                }
            });
        });
        $(document).on('click', 'input[type="checkbox"]', function() {
            if (this.checked) {
                $('#bulk_delete').prop('disabled', false);

            } else {
                if ($("input[name='ids[]']:checked").length == 0) {
                    $('#bulk_delete').prop('disabled', true);
                }
            }

        });
        $('#bulk_delete').on('click', function() {
            // console.log($( "input[name='ids[]']:checked" ).length);
            if ($("input[name='ids[]']:checked").length == 0) {
                $('#bulk_delete').prop('type', 'button');
                new PNotify({
                    title: 'Failed!',
                    text: "@lang('fleet.delete_error')",
                    type: 'error'
                });
                $('#bulk_delete').attr('disabled', true);
            }
            if ($("input[name='ids[]']:checked").length > 0) {
                // var favorite = [];
                $.each($("input[name='ids[]']:checked"), function() {
                    // favorite.push($(this).val());
                    $("#bulk_hidden").append('<input type=hidden name=ids[] value=' + $(this).val() + '>');
                });
                // console.log(favorite);
            }
        });

        $('#chk_all').on('click', function() {
            if (this.checked) {
                $('.checkbox').each(function() {
                    $('.checkbox').prop("checked", true);
                });
            } else {
                $('.checkbox').each(function() {
                    $('.checkbox').prop("checked", false);
                });
                $('#bulk_delete').prop('disabled', true);
            }
        });

        // Checkbox checked
        function checkcheckbox() {
            // Total checkboxes
            var length = $('.checkbox').length;
            // Total checked checkboxes
            var totalchecked = 0;
            $('.checkbox').each(function() {
                if ($(this).is(':checked')) {
                    totalchecked += 1;
                }
            });
            // console.log(length+" "+totalchecked);
            // Checked unchecked checkbox
            if (totalchecked == length) {
                $("#chk_all").prop('checked', true);
            } else {
                $('#chk_all').prop('checked', false);
            }
        }

        $(document).ready(function() {
            $('#myTable tfoot th').each(function() {
                if ($(this).index() != 0 && $(this).index() != $('#data_table tfoot th').length - 1) {
                    var title = $(this).text();
                    $(this).html('<input type="text" placeholder="' + title + '" />');
                }
            });
            var myTable = $('#myTable').DataTable({
                dom: 'Bfrtip',
                buttons: [{
                    extend: 'collection',
                    text: 'Export',
                    buttons: [{
                            extend: 'excel',
                            exportOptions: {
                                columns: [2, 3, 4, 5, 6, 7, 8, 9]
                            },
                        },
                        {
                            extend: 'csv',
                            exportOptions: {
                                columns: [2, 3, 4, 5, 6, 7, 8, 9]
                            },
                        },
                        {
                            extend: 'pdf',
                            exportOptions: {
                                columns: [2, 3, 4, 5, 6, 7, 8, 9]
                            },
                        }
                    ]
                }],
                "language": {
                    "url": '{{ asset('assets/datatables/') . '/' . __('fleet.datatable_lang') }}',
                },
                // individual column search
                "initComplete": function() {
                    myTable.columns().every(function() {
                        var that = this;
                        $('input', this.footer()).on('keyup change', function() {
                            that.search(this.value).draw();
                        });
                    });
                }
            });
        });
    </script>
@endsection
