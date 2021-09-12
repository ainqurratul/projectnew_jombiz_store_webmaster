@extends('layouts.admin')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Table of Transaction</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Transaction</li>
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
                <h3 class="card-title">Transaction Pending</h3>
                <!-- <button type="button" class="btn btn-info float-right" data-toggle="modal" data-target="#exampleModal"><i class="fas fa-plus"></i> Add item</button> -->
              </div>
              <!-- /.card-header -->
              <div class="card-body p-0">
                <table class="table table-striped">
                  <thead>
                    <tr>
                      <th style="width: 10px">#</th>
                      <th >Name</th>
                      <th >Delivery Email</th>
                      <th>Total</th>
                      <th>Bank</th>
                      <th style="width: 100px">Transfer Image</th>
                      <th>Status</th>
                      <th style="width: 150px">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($listPending as $data)
                        <tr>
                            <td>{{ $data->id }}</td>
                            <td>{{ $data->name }}</td>
                            <td>{{ $data->detail_location }}</td>
                            <td>{{"RM " .number_format($data->total_transfer) }}</td>
                            <td>{{ $data->bank }}</td>
                            <td>
                              <img src = "{{ asset ('public/transfer'.$data->resit)}}" width="70px" height = "70px" alt="Image">
                              <!-- {{ $data->resit }} -->
                            </td>  
                            <td>{{ $data->status }}</td>

                            <td>
                              <a href = "{{route('cancelTransaction', $data->id)}}">
                                <button type="button" class="btn btn btn-danger btn-xs">Cancel</button>
                              </a>
                              /
                              <a href = "{{route('confirmTransaction', $data->id)}}">
                                <button type="button" class="btn btn btn-success btn-xs">Process</button>
                              </a>
                            </td>
                        </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
        </div>

        <br><br>

        <!-- Transaction Completed -->
        <div class="card">
              <div class="card-header">
                <h3 class="card-title">Transaction Completed</h3>
                <!-- <button type="button" class="btn btn-info float-right" data-toggle="modal" data-target="#exampleModal"><i class="fas fa-plus"></i> Add item</button> -->
              </div>
              <!-- /.card-header -->
              <div class="card-body p-0">
                <table class="table table-striped">
                  <thead>
                    <tr>
                      <th style="width: 10px">#</th>
                      <th >Name</th>
                      <th >Delivery Email</th>
                      <th>Total</th>
                      <th>Bank</th>
                      <th>Status</th>                      
                      <th style="width: 150px">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($listComplete as $data)
                        <tr>
                            <td>{{ $data->id }}</td>
                            <td>{{ $data->name }}</td>
                            <td>{{ $data->detail_location }}</td>
                            <td>{{"RM " .number_format($data->total_transfer) }}</td>
                            <td>{{ $data->bank }}</td>
                            <td>{{ $data->status }}</td>

                            <td>
                              @if($data->status == "DELIVERED")
                                <a href = "{{route('completeTransaction', $data->id)}}">
                                  <button type="button" class="btn btn-block btn-success btn-xs">Complete</button>
                                </a>
                              @elseif($data->status == "PROCESS")
                                <a href = "{{route('deliverTransaction', $data->id)}}">
                                  <button type="button" class="btn btn btn-warning btn-xs">Delivery</button>
                                </a>
                              /
                                <a href = "#">
                                  <button type="button" class="btn btn btn-secondary btn-xs">Details</button>
                                </a>
                              @elseif($data->status == "COMPLETED" || $data->status == "CANCELLED")
                                <a href = "#">
                                  <button type="button" class="btn btn-block btn-secondary btn-xs">Details</button>
                                </a>
                              @endif
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
