@extends ('admin/index')
@section ("content")


<!-- Content Header (Page header) -->
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>All Subadmin</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="#">Home</a></li>
          <li class="breadcrumb-item active">Subadmin</li>
        </ol>
      </div>
    </div>
  </div><!-- /.container-fluid -->
</section>

<!-- Main content -->
<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-12">
        <div class="card">
            <div class="card-header">
              <button type="button" class="btn btn-default" data-toggle="modal" data-target="#modal-subadmin">Add Subadmin</button>
            </div>          
          <!-- /.card-header -->
          {{-- dd($users_list) --}}
          <div class="card-body">
            <table id="subadminlisting" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>S.no</th>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Mobile</th>
                        <th>Status</th>
                        <th>Accessiblity</th>                             
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>   
                  {{--$subadmin_list--}}
                    @foreach($subadmin_list as $subadmin) 
                    <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>{{$subadmin->username}}</td>
                        <td>{{$subadmin->email}}</td>
                        <td>{{$subadmin->mobile}}</td>                          
                        <td>{{ucfirst($subadmin->status)}}</td>
                        <td>Change</td>
                        <td>
                            <a href="" class="admin_edit_subadmin" userid="{{$subadmin->id}}" username="{{$subadmin->username}}" useremail="{{$subadmin->email}}" userphone="{{$subadmin->mobile}}" userstatus="{{$subadmin->status}}">Edit</a> 
                            /
                            <form method="get" action="{{route('admin.deletesubadmin', $subadmin->id)}}">
                                @csrf
                                <input name="_method" type="hidden" value="DELETE">                                
                                <a href="{{route('admin.deletesubadmin', $subadmin->id)}}" class="delete_subadmin admin_delete_subadmin show_confirm">Delete</a>
                            </form>
                        </td>
                    </tr>                           
                    @endforeach
                </tbody>
                    <tfoot>
                        <tr>
                            <th>S.no</th>
                            <th>Username</th>
                            <th>Email</th>
                            <th>Mobile</th>
                            <th>Status</th>
                            <th>Accessiblity</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                </table>
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->

        <!-- /.card -->
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->
  </div>
  <!-- /.container-fluid -->
</section>

<div class="modal fade" id="modal-subadmin">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Add New User</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="add_new_subadmin_form" action="{{route('admin.insertsubadmin')}}" method="post">
                        @csrf
                        <div class="card-body">
                            <div class="form-group">
                                <label for="Inputusername">Username</label>
                                <input type="text" name="username" class="form-control subadmin_name" id="Inputusername" placeholder="Enter Username">
                            </div>                      
                            <div class="form-group">
                                <label for="InputEmail">Email address</label>
                                <input type="email" name="email" class="form-control subadmin_email" id="InputEmail" placeholder="Enter email">
                            </div>
                            <div class="form-group">
                                <label for="InputPhoneNumber">Phone Number</label>
                                <input type="text" name="phoneNumber" class="form-control subadmin_mobile" id="InputPhoneNumber" placeholder="Enter PhoneNumber">
                            </div>
                            <div class="form-group">
                                <label for="InputPassword">Password</label>
                                <input type="password" name="password" class="form-control subadmin_password" id="InputPassword" placeholder="Password">
                            </div>
                            <div class="form-group">
                              <div class="form-check">
                                  <input type="radio" name="subadmin_status" id="subadmin_status_active" class="form-check-input subadmin_status_active" value="active" checked>
                                  <label class="form-check-label" for="subadmin_status_active">Active</label>
                              </div>  
                              <div class="form-check">
                              <input type="radio" name="subadmin_status" id="subadmin_status_inactive" class="form-check-input subadmin_status_inactive" value="inactive">
                                  <label class="form-check-label" for="subadmin_status_inactive">Inactive</label>
                              </div> 
                            </div>
                        </div>                
                        <div class="card-footer">
                          <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
            </div>              
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>

@stop