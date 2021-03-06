@extends('layouts.admin')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">List of Products</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Product</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">

        <div class="card">
              <div class="card-header">
                <button type="button" class="btn btn-info float-right" data-toggle="modal" data-target="#exampleModal"><i class="fas fa-plus"></i> Add item</button>
              </div>

              <div class="card-body p-0">
                <table class="table table-bordered">
                  <thead>
                    <tr>
                      <th style="width: 10px">PID</th>
                      <th>Name</th>
                      <th>Description</th>
                      <th>Category</th>
                      <th>Image</th>
                      <th>Price</th>
                      <th>Update At</th>
                      <th style="width: 50px">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($listUser as $data)
                        <tr>
                            <td>{{ $data->id }}</td>
                            <td>{{ $data->name }}</td>
                            <td>{{ $data->description }}</td>
                            <td>{{ $data->category_id }}</td>
                            <td>{{ $data->image }}</td>
                            <td>{{"RM " .number_format($data->price) }}</td>
                            <td>{{ $data->updated_at }}</td>
                            <td>
                                <a href = '/product/delete/{{ $data->id }}'><i class= "fa fa-trash red"></i></a>
                            </td>
                        </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Product</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>

              <form method="POST" action="{{ route('product.store') }}" role="form"  enctype="multipart/form-data">
              @csrf
                <div class="modal-body">
                  <div class="form-group">
                    <label>Product Name</label>
                    <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Enter Product Name" name="name">
                  </div>
                  <div class="row">
                    <div class="col-sm-6">
                      <!-- text input -->
                      <div class="form-group">
                        <label>Product Price</label>
                        <input type="text" class="form-control" placeholder="Enter Price" name="price"> 
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>Category</label>
                        <select class="form-control" name="category_id">
                          <option value = "1">Whatsapp Bussiness Tool</option>
                          <option value = "2">Facebook Bussiness Tool</option>
                          <option value = "3">Instagram Bussiness Tool</option>
                          <option value = "4">Telegram Bussiness Tool</option>
                          <option value = "5">Website Bussiness Tool</option>
                          <option value = "6">Others</option>
                        </select>
                      </div>
                    </div>
                  </div>

                  <div class="form-group">
                        <label>Description</label>
                        <textarea class="form-control" rows="3" placeholder="Description" name="description"></textarea>
                  </div>

                  <div class="form-group">
                    <label for="exampleInputFile">Image File</label>
                    <div class="input-group">
                      <div class="custom-file">
                        <input type="file" class="custom-file-input" id="exampleInputFile" name="image">
                        <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- /.card-body -->

                <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Add</button>
              </div>
              </form>
            </div>
          </div>
        </div>

      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection
