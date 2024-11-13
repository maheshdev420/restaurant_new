@extends('admin/index')
@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Add Category</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">All Category</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <button type="button" class="btn btn-default" data-toggle="modal"
                                data-target="#modal-default">Add Category</button>
                        </div>
                        <table id="parentcategorylisting" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>S.no</th>
                                    <th>Icon</th>
                                    <th>Category Name</th>
                                    <th>Parent Category</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($all_cat_list as $key => $cat)
                                    <tr>
                                        <td>{{ ++$key }}</td>
                                        <td><img src="{{ asset('/admin-assets/img/category_img/all-category') }}/{{ $cat->category_icon }} "
                                                alt="Category Icon"></td>
                                        <td><b>{{ $cat->category_name }}</b></td>
                                        <td>{{ $cat->parent_name }}</td>
                                        <td>{{ $cat->category_status == '0' ? 'Pending' : 'Active' }}</td>
                                        <td><a href="#" class="edit_cat admin_edit_category"
                                                parentcat_id="{{ $cat->parent_id }}" cat_id="{{ $cat->id }}"
                                                cat_name="{{ $cat->category_name }}"
                                                icon_path="{{ asset('/admin-assets/img/category_img/all-category/') }}"
                                                cat_icon="{{ $cat->category_icon }}"
                                                cat_status="{{ $cat->category_status }}">Edit</a>/ <a href="{{route('admin.category.delete',$cat->id) }}">delete</a></td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div class="modal fade" id="modal-default">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Add Category</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="add_new_cat_form" action="{{ url('admin/insert-cat') }}" method="post"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">

                            <div class="form-group upload_caticon_outer">
                                <div class="containers">
                                    <div class="imageWrapper">
                                        <img class="image show_cat_icon" src="">
                                    </div>
                                </div>
                                <button class="file-upload">
                                    <input type="file" name="cat_icon" class="cat-file-input" value=""
                                        accept="image/*">Choose File
                                </button>
                            </div>

                            <div class="form-group">
                                <label for="Inputparentcat_name">Parent-Category Name</label>
                                <select class="form-control parent_category" name="parent_category" id="parent_category">
                                    <option value="">Select Parent Category</option>
                                    @foreach ($all_cat_list as $parent_category)
                                        <option class="parentCat{{ $parent_category['id'] }}" value="{{ $parent_category['id'] }}">
                                            {{ $parent_category['category_name'] }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="Inputcat_name">Category Name</label>
                                <input type="text" name="cat_name" class="form-control cat_name" id="cat_name"
                                    placeholder="Enter Category Name">
                            </div>

                            <div class="form-group">
                                <div class="form-check">
                                    <input type="radio" name="cat_status" id="cat_status_active"
                                        class="form-check-input cat_status_active" value="1" checked>
                                    <label class="form-check-label" for="cat_status_active">Active</label>
                                </div>
                                <div class="form-check">
                                    <input type="radio" name="cat_status" id="cat_status_inactive"
                                        class="form-check-input cat_status_inactive" value="0">
                                    <label class="form-check-label" for="cat_status_inactive">Inactive</label>
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
@endsection
