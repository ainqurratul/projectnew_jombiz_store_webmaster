@extends('layouts.admin')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Image</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Transaction</li>
              <li class="breadcrumb-item active">View</li>

            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">

      <!-- Transaction Pending -->
        <div class="card">
              <div class="card-header">
                <h3 class="card-title">View Image</h3>
                <!-- <button type="button" class="btn btn-info float-right" data-toggle="modal" data-target="#exampleModal"><i class="fas fa-plus"></i> Add item</button> -->
              </div>
              <!-- /.card-header -->
              <div class="card-body p-0">
                <table class="table table-striped">
                  <thead>
                    <tr>
                      <th style="width: 10px">TID</th>
                      <th style="width: 10px">UID</th>
                      <th >Name</th>
                      <th >Delivery Email</th>
                      <th>Total</th>
                      <th style="width: 100px">Transfer Image</th>
                    </tr>
                  </thead>
                  <tbody>
                      @foreach($viewImage as $data)
                        <tr>
                            <td>{{ $transaction->id }}</td>
                            <td>{{ $transaction->user_id }}</td>
                            <td>{{ $transaction->name }}</td>
                            <td>{{ $transaction->detail_location }}</td>
                            <td>{{"RM " .number_format($transaction->total_transfer) }}</td>
                            <td>
                              <iframe src= "transfer/{{$transaction->resit}}">
                            </td>
                        </tr>
                      @endforeach
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
        </div>

      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection
