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
                                <th>Transection Details</th>
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
                                    <td>
                                        <div class="user-block">
                                            <img class="img-circle img-bordered-sm" src="/dist/img/{{ $item->userProfile }}"
                                                alt="user image">
                                            <span class="username">
                                                <a href="">{{ $item->userFirstName }}</a>
                                            </span>
                                            <span
                                                class="description">{{ date('d M, Y - h:m a', strtotime($item->traDate)) }}</span>
                                        </div>
                                    </td>
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
                                <th>User - Date Time</th>
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
                                <td><strong>{{ round($report['totalAmount'], 2) }}</strong>&nbsp&nbsp<i
                                        class="fas fa-rupee-sign"></i>
                                </td>
                            </tr>
                            <tr>
                                <td><strong>1.</strong></td>
                                <td>Balance</td>
                                <td>
                                    <div class="progress progress-xs">
                                        <div class="progress-bar progress-bar-striped bg-success" role="progressbar"
                                            style="width: {{ ($report['balance'] * 100) / $report['totalAmount'] }}%">
                                        </div>
                                    </div>
                                </td>
                                <td><span
                                        class="badge bg-success">{{ round(($report['balance'] * 100) / $report['totalAmount'], 2) }}%</span>
                                </td>
                                <td><strong>{{ round($report['balance'], 2) }}</strong>&nbsp&nbsp<i
                                        class="fas fa-rupee-sign"></i>
                                </td>
                            </tr>
                            <tr>
                                <td><strong>2.</strong></td>
                                <td>Spent</td>
                                <td>
                                    <div class="progress progress-xs">
                                        <div class="progress-bar progress-bar-striped bg-danger" role="progressbar"
                                            style="width: {{ ($report['spent'] * 100) / $report['totalAmount'] }}%">
                                        </div>
                                    </div>
                                </td>
                                <td><span
                                        class="badge bg-danger">{{ round(($report['spent'] * 100) / $report['totalAmount'], 2) }}%</span>
                                </td>
                                <td><strong>{{ round($report['spent'], 2) }}</strong>&nbsp&nbsp<i
                                        class="fas fa-rupee-sign"></i></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    {{-- User wise Report --}}

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title"><strong>Detailed Report</strong></h3>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <tbody>
                            <tr>
                                <td><strong>#</strong></td>
                                <td><strong>User</strong></td>
                                <td class="w-25"><strong>Amount Received</strong></td>
                                <td><strong>Amount Spent</strong></td>
                            </tr>
                            @foreach ($userReport as $item)
                                <tr>
                                    <td><strong>{{ ++$userCount }}</strong></td>
                                    <td>
                                        <div class="user-block">
                                            <img class="img-circle img-bordered-sm"
                                                src="/dist/img/{{ $item->userProfile }}" alt="user image">
                                            <span class="username">
                                                <a
                                                    href="">{{ $item->userFirstName . ' ' . $item->userLastName }}</a>
                                            </span>
                                            <span class="description">
                                                @switch($item->userRole)
                                                    @case('0')
                                                        <span class="badge bg-info">Employee</span>
                                                    @break

                                                    @case('1')
                                                        <span class="badge bg-success">CO-Founder</span>
                                                    @break

                                                    @case('2')
                                                        <span class="badge bg-success">Company Profit</span>
                                                    @break
                                                @endswitch
                                            </span>
                                        </div>
                                    </td>
                                    <td>{{ $item->amountReceived }}</td>
                                    <td>{{ $item->amountSpent }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
