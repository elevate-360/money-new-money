@extends('layout')

@section('activeDb')
    active
@endsection

@section('pageTitle')
    Dashboard
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title"><strong>Transection details</strong></h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table id="example1" class="table table-hover table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Transection No.</th>
                                <th>Title</th>
                                <th>Entity</th>
                                <th>Amount</th>
                                <th>Transection Type</th>
                                <th>Method</th>
                                <th>Date Time</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $item)
                                <tr>
                                    <td>{{ ++$count }}</td>
                                    <td>{{ $item->traTitle }}</td>
                                    <td>{{ $item->traEntity }}</td>
                                    <td>{{ $item->traAmount }}</td>
                                    <td>
                                        @if ($item->traType == 1)
                                            <span class="badge bg-olive">Credit</span>
                                        @else
                                            <span class="badge bg-warning">Debit</span>
                                        @endif
                                    </td>
                                    <td>
                                        @switch($item->traMethod)
                                            @case('0')
                                                <span class="badge bg-info">Cash</span>
                                            @break

                                            @case('1')
                                                <span class="badge bg-danger">Card</span>
                                            @break

                                            @case('2')
                                                <span class="badge bg-success">UPI</span>
                                            @break

                                            @case('3')
                                                <span class="badge bg-warning">Cheque</span>
                                            @break
                                        @endswitch
                                    </td>
                                    <td>{{ date('d M, Y - h:m a', strtotime($item->traDate)) }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>Transection No.</th>
                                <th>Title</th>
                                <th>Entity</th>
                                <th>Amount</th>
                                <th>Transection Type</th>
                                <th>Method</th>
                                <th>Date Time</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>

    {{-- Final Report --}}

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title"><strong>Final Report</strong></h3>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <tbody>
                            <tr>
                                <td><strong>#</strong></td>
                                <td><strong>Total Amount</strong></td>
                                <td class="w-25">
                                    <center><strong>-</strong></center>
                                </td>
                                <td>
                                    <center><strong>-</strong></center>
                                </td>
                                <td><strong>{{ $report['totalAmount'] }}</strong>&nbsp&nbsp<i class="fas fa-rupee-sign"></i>
                                </td>
                            </tr>
                            <tr>
                                <td><strong>1.</strong></td>
                                <td>Balance</td>
                                <td>
                                    <div class="progress progress-xs">
                                        <div class="progress-bar progress-bar-striped bg-success" role="progressbar"
                                            style="width: {{ ($report['balance'] * 100) / ($report['totalAmount'] != 0) ? $report['totalAmount'] : 1 }}%">
                                        </div>
                                    </div>
                                </td>
                                <td><span
                                        class="badge bg-success">{{ ($report['balance'] * 100) / ($report['totalAmount'] != 0) ? $report['totalAmount'] : 1 }}%</span>
                                </td>
                                <td><strong>{{ $report['balance'] }}</strong>&nbsp&nbsp<i class="fas fa-rupee-sign"></i>
                                </td>
                            </tr>
                            <tr>
                                <td><strong>2.</strong></td>
                                <td>Spent</td>
                                <td>
                                    <div class="progress progress-xs">
                                        <div class="progress-bar progress-bar-striped bg-danger" role="progressbar"
                                            style="width: {{ ($report['spent'] * 100) / ($report['totalAmount'] != 0) ? $report['totalAmount'] : 1 }}%">
                                        </div>
                                    </div>
                                </td>
                                <td><span
                                        class="badge bg-danger">{{ ($report['spent'] * 100) / ($report['totalAmount'] != 0) ? $report['totalAmount'] : 1 }}%</span>
                                </td>
                                <td><strong>{{ $report['spent'] }}</strong>&nbsp&nbsp<i class="fas fa-rupee-sign"></i></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
