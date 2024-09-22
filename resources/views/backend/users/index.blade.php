@extends('backend.layouts.app')

@section('styles')
<style type="text/css">
    .listImg{
        width:50px;
        height: 50px;
    }
.switch {
  position: relative;
  display: inline-block;
  width: 60px;
  height: 34px;
}

.switch input { 
  opacity: 0;
  width: 0;
  height: 0;
}

.slider {
  position: absolute;
  cursor: pointer;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: #ccc;
  -webkit-transition: .4s;
  transition: .4s;
}

.slider:before {
  position: absolute;
  content: "";
  height: 26px;
  width: 26px;
  left: 4px;
  bottom: 4px;
  background-color: white;
  -webkit-transition: .4s;
  transition: .4s;
}

input:checked + .slider {
  background-color: #2196F3;
}

input:focus + .slider {
  box-shadow: 0 0 1px #2196F3;
}

input:checked + .slider:before {
  -webkit-transform: translateX(26px);
  -ms-transform: translateX(26px);
  transform: translateX(26px);
}
</style>
@endsection

@section('content')
<!-- BEGIN: Subheader -->
<div class="m-subheader">
    <div class="mr-auto">
        <h3 class="m-subheader__title m-subheader__title--separator">User Management</h3>           
        <ul class="m-subheader__breadcrumbs m-nav m-nav--inline">
            <li class="m-nav__item m-nav__item--home">
                <a href="{{route('backend.')}}" class="m-nav__link m-nav__link--icon">
                 <i class="m-nav__link-icon la la-home"></i>
             </a>
         </li>
        <li class="m-nav__separator">-</li>
        <li class="m-nav__item">
            <a href="{{route('backend.users.index')}}" class="m-nav__link">
                <span class="m-nav__link-text">Users
                </span>
            </a>
        </li>
        <li class="m-nav__separator">-</li>
        <li class="m-nav__item">
            <a href="{{route('backend.users.index')}}" class="m-nav__link">
                <span class="m-nav__link-text">List</span>
            </a>
        </li>
    </ul>
</div>
</div>
<!-- END: Subheader -->
<div class="m-content">
	@include('frontend.layouts.partials.alert-messages')
    <div class="row">
        <div class="col-sm-12">
            <div class="m-portlet m-portlet--mobile">

                <div class="m-portlet__head">
                    <div class="m-portlet__head-caption">
                        <div class="m-portlet__head-title">
                            <h3 class="m-portlet__head-text">
                                User List
                            </h3>
                        </div>
                    </div>

                    <div class="m-portlet__head-tools">
                        <ul class="m-portlet__nav">
                            <li class="m-portlet__nav-item">
                                <a href="{{route('backend.users.create')}}" class="btn btn-info m-btn m-btn--custom m-btn--icon m-btn--air">
                                    <span>
                                        <i class="la la-plus"></i>
                                        <span>Add User</span>
                                    </span>
                                </a>
                            </li>
                            <li class="m-portlet__nav-item"></li>
                        </ul>
                    </div>
                </div>
                <div class="row tbl-column-filter">
                <div class="col-sm-4">
                    
                    <div class="form-group m-form__group row">
                        <label for="example-text-input" class="col-4 col-form-label">Select status</label>
                        <div class="col-5">
                           <select name="status" class="form-control" id="status">
                            <option value="">--Select--</option>
                            <option value="Y">Active</option>
                            <option value="N">In Active</option>
                        </select>
                    </div>
                </div>

                </div>
                <div class="col-sm-5">

            </div>
            <div class="col-sm-3 tbl-column-filter-btn">
                <button type="button" class="btn btn-primary" value="search" id="search">Search</button>
                <button type="button" class="btn btn-secondary" value="reset" id="reset">Reset</button>
            </div>


        </div>
        <hr>

        <!--    <div class="data-table-block"> -->
         <div class="m-portlet__body">


            <!--begin: Datatable -->
            <div id="m_table_1_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
                <div class="row">

                    <div class="col-sm-12">
                     <table class="table table-striped- table-bordered table-hover table-checkable" id="m_table_1">
                        <thead>
                            <tr role="row">
                             <th>No</th>
                             <th>First Name</th>
                             <th>Last Name</th>
                             <th>Image</th>
                             <th>Email</th>
                             <th>User Name</th>
                             <th>Phone Number</th>
                             <th>Status</th>
                             <th>Action</th>
                         </tr>
                     </thead>
                     <tbody>

                     </tbody>
                 </table>
             </div>
         </div>
     </div>
 </div>
</div>
</div>
</div>
</div>
@endsection

@section('scripts')
<script>
  $(function () {
    var table = $('#m_table_1').DataTable({

        processing: true,

        serverSide: true,

        ajax: {
            url: "{{ route('backend.users.index') }}",
            data: function (d) {
                d.status = $('#status').val();
            }
        },

        columns: [

        {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},

        {data: 'firstname', name: 'firstname'},

        {data: 'lastname', name: 'lastname'},

        {data: 'image', name: 'image'},

        {data: 'email', name: 'email'},

        {data: 'username', name: 'username'},

        {data: 'phone_number', name: 'phone_number'},

        {data: 'status', name: 'status'},

        {data: 'action', name: 'action', orderable: false, searchable: false},

        ],
        
    });

    $('#search').on('click',function(event) {
        table.draw();
        
    });


    $(document).on( 'click', '#updateStatus', function () {

        mApp.blockPage({
            overlayColor: '#000000',
            type: 'loader',
            state: 'primary',
            message: 'Processing...'
        });

        setTimeout(function() {
            mApp.unblockPage();
        }, 2000);

        var id = $(this).attr("data-id");
        var is_active;  
        if($('.is_active'+id).is(":checked")){
            is_active='Y';
        }else{
            is_active='N';  
        }

        swal({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, changed it!'

        }).then(function(result) {
            if (result.value) {

                $.ajax({
                    url:"{{route('backend.users.change-status')}}",
                    method:'post',
                    data:{is_active:is_active,id:id,"_token":'{{ csrf_token() }}'},  
                    success:function(data){
                        if(data.status=='success'){
                            toastr.success(data.message);
                            table.draw();  
                        }else{
                            toastr.error(data.message);
                        }

                    }
                });
            }else if (result.dismiss === 'cancel'){

                if($('.is_active'+id).is(":checked")){

                    $('.is_active'+id).prop("checked",false);
                }else{
                    $('.is_active'+id).prop("checked",true);
                }
                swal(
                    'Cancelled',
                    'Your status do not change:)',
                    'error'
                    )
            }
        })
    });


    $(document).on('click','.deleteRecord',function(){
        var id = $(this).data("id");
        
        swal({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, deleted it!'

        }).then(function(result) {
            if (result.value) {

                mApp.blockPage({
                    overlayColor: '#000000',
                    type: 'loader',
                    state: 'primary',
                    message: 'Processing...'
                });

                setTimeout(function() {
                    mApp.unblockPage();
                }, 2000);

                var url = "{{URL('backend/users')}}";
                var dltUrl = url+"/"+id;

                $.ajax({
                    type: 'POST',
                    dataType: 'json',
                    data: {
                     id: id,
                     _method: 'DELETE',
                     _token:'{{ csrf_token() }}'
                 },
                 url: dltUrl,
                 success: function (data){
                    if(data.status=='success'){
                        table.draw();
                        toastr.success(data.message);
                    }else{
                     toastr.error(data.message);
                 }
             }
            });
            }else if (result.dismiss === 'cancel') {
                swal(
                    'Cancelled',
                    'Your record is safe :)',
                    'error'
                    )
            }
        });
    });

    $(document).on('click','#reset',function(){
     $('#status').val('');
     table.draw();
 })
});

</script>
@endsection