@extends('layout.app')

@section('title','Edit Employee')


@section('content')

<section class="content">
    <div class="container-fluid">
        <div class="row">

            <div class="col-md-12">
                @if (Session::has('success'))
                    <div class="alert alert-success">{{ Session::get('success') }}</div>
                @endif
                <!-- general form elements -->
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Edit Employee</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form method="post" action="{{route('update', $data['id'])}}">
                        @csrf
                        <div class="card-body">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Name</label>
                                <input type="text" class="form-control" name="name" id="exampleInputEmail1"
                                    placeholder="Enter Name" value="{{ $data['name'] }}">
                                @if ($errors->first('name'))
                                <span class="text-danger">{{ $errors->first('name') }}</span>
                                @endif
                            </div>

                            <div class="form-group">
                                <label for="exampleInputEmail1">Email address</label>
                                <input type="email" class="form-control" name="email" id="exampleInputEmail1"
                                    placeholder="Enter email" value="{{ $data['email'] }}">
                                    @if ($errors->first('email'))
                                <span class="text-danger">{{ $errors->first('email') }}</span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Age</label>
                                <input type="text" class="form-control" name="age" id="exampleInputPassword1"
                                    placeholder="Age" value="{{ $data['age'] }}">
                                    @if ($errors->first('age'))
                                <span class="text-danger">{{ $errors->first('age') }}</span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Experience</label>
                                <input type="text" class="form-control" name="experience" id="exampleInputPassword1"
                                    placeholder="Years of Experience" value="{{ $data['years_of_exp'] }}">
                                    @if ($errors->first('experience'))
                                <span class="text-danger">{{ $errors->first('experience') }}</span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Salary</label>
                                <input type="text" class="form-control" name="salary" id="exampleInputPassword1"
                                    placeholder="Salary" value="{{ $data['salary'] }}">
                                    @if ($errors->first('salary'))
                                <span class="text-danger">{{ $errors->first('salary') }}</span>
                                @endif
                            </div>

                        </div>
                        <!-- /.card-body -->

                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>


            </div>

        </div>
        <!-- /.row -->
    </div><!-- /.container-fluid -->
</section>

@endsection