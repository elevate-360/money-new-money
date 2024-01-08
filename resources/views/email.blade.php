@extends('layout')

@section('activeEml')
    active
@endsection

@section('pageTitle')
    Send Email
@endsection

@section('content')
    <div class="col-12">
        <!-- general form elements -->
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Compose Email</h3>
            </div>
            <!-- /.card-header -->
            <form action="/email/send" method="post">
                @csrf
                @method('POST')
                <div class="card-body">
                    <div class="form-group">
                        <input class="form-control" placeholder="To:"  type="email" name="email">
                    </div>
                    <div class="form-group">
                        <input class="form-control" placeholder="Full name" type="text" name="name">
                    </div>
                    <div class="form-group">
                        <input class="form-control" placeholder="Subject:" type="text" name="subject">
                    </div>
                    <div class="form-group">
                        <textarea id="compose-textarea" class="form-control" style="height: 300px" name="message">
                    </textarea>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="float-right">
                        <button type="button" class="btn btn-default"><i class="fas fa-pencil-alt"></i> Draft</button>
                        <button type="submit" class="btn btn-primary"><i class="far fa-envelope"></i> Send</button>
                    </div>
                    <button type="reset" class="btn btn-default"><i class="fas fa-times"></i> Discard</button>
                </div>
            </form>
        </div>
        <!-- /.card -->
    </div>
@endsection
