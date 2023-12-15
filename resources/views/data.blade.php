@extends('layout')

@section('activeTbl')
    active
@endsection

@section('pageTitle')
    Add Transection
@endsection

@section('content')
    <div class="col-12">
        <!-- general form elements -->
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">New Transection</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form action="/data/submit" method="POST">
                @csrf
                @method('POST')
                <div class="card-body">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Title</label>
                        <input type="text" class="form-control" id="exampleInputEmail1" name="traTitle"
                            placeholder="Enter transection title">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Entity</label>
                        <input type="text" class="form-control" id="exampleInputPassword1" name="traEntity"
                            placeholder="Enter transection entity">
                    </div>
                    <div class="form-group">
                        <label for="amount">Amount</label>
                        <input type="number" step="0.01" class="form-control" id="amount" name="traAmount"
                            placeholder="Enter transection amount">
                    </div>
                    <div class="form-group">
                        <label for="type">Transection Type</label><br>
                        <input type="checkbox" name="traType" value="1" checked data-bootstrap-switch data-off-color="danger"
                            data-on-color="success">
                    </div>
                    <div class="form-group">
                        <label for="type">Transection Method</label><br>
                        <div class="btn-group btn-group-toggle w-100" data-toggle="buttons">
                            <label class="btn bg-info active">
                                <input type="radio" name="traMethod" id="option_b1" value="0" autocomplete="off"
                                    checked=""> Cash
                            </label>
                            <label class="btn bg-success">
                                <input type="radio" name="traMethod" id="option_b2" value="1" autocomplete="off">
                                UPI
                            </label>
                            <label class="btn bg-danger">
                                <input type="radio" name="traMethod" id="option_b3" value="2" autocomplete="off">
                                Card
                            </label>
                            <label class="btn bg-warning">
                                <input type="radio" name="traMethod" id="option_b4" value="3" autocomplete="off">
                                Cheque
                            </label>
                        </div>
                    </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                    <button type="submit" class="btn btn-primary w-25">Add Transection</button>
                </div>
            </form>
        </div>
        <!-- /.card -->
    </div>
@endsection
