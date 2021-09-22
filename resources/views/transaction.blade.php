@extends('layouts.admin')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
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
        <h3 class="m-0 text-dark text-lg-center">Transaction Pending</h3>
        
        <br>
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-body table-responsive p-0" style="height: 400px;">
                <table class="table table-head-fixed text-nowrap">
                <thead>
                    <tr>
                      <th style="width: 10px">TID</th>
                      <th style="width: 10px">UID</th>
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
                            <td>{{ $data->user_id }}</td>
                            <td>{{ $data->name }}</td>
                            <td>{{ $data->detail_location }}</td>
                            <td>{{"RM " .number_format($data->total_transfer) }}</td>
                            <td>{{ $data->bank }}</td>
                            <td>
                              <!-- <img src = "{{ asset ('public/transfer'.$data->resit)}}" width="70px" height = "70px" alt="Image"> -->
                              <!-- {{ $data->resit }} -->
                              <!-- <a href ="{{url ('/download', $data->id)}}">View</a> -->
                              <a href ="{{url ('/view', $data->resit)}}">View</a>

                            </td>  
                            <td>{{ $data->status }}</td>
                            <td>
                              
                              @if($data->status == "PENDING")
                                <a href = "{{route('cancelTransaction', $data->id)}}">
                                  <button type="button" class="btn btn btn-danger btn-xs">Cancel</button>
                                </a>
                                /
                                <a href = "{{route('confirmTransaction', $data->id)}}">
                                  <button type="button" class="btn btn btn-success btn-xs">Process</button>
                                </a>
                              @elseif($data->status == "PAID")
                                <a href = "{{route('confirmTransaction', $data->id)}}">
                                    <button type="button" class="btn btn btn-success btn-xs">Process</button>
                                  </a>
                                /
                                <a href="{{ route('details.index')}}">
                                  <button type="button" class="btn btn btn-secondary btn-xs">Details</button>
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
            <!-- /.card -->
          </div>
        </div>

        <br>
            <!-- Transaction Completed -->
          <h3 class="m-0 text-dark text-lg-center">Transaction Completed</h3>
        <br>

        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-body table-responsive p-0" style="height: 400px;">
                <table class="table table-head-fixed text-nowrap">
                <thead>
                    <tr>
                      <th style="width: 10px">TID</th>
                      <th style="width: 10px">UID</th>
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
                            <td>{{ $data->user_id }}</td>
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
                              <a href="{{ route('details.index')}}">
                                  <button type="button" class="btn btn btn-secondary btn-xs">Details</button>
                                </a>
                              @elseif($data->status == "COMPLETED" || $data->status == "CANCELLED")
                                <a href="{{ route('details.index')}}">
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
            <!-- /.card -->
          </div>
        </div>
        
        <br>

      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection
