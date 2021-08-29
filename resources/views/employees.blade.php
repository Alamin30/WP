@extends('layout.app')

@section('title','Employees')

@section('css')
<link rel="stylesheet" href="{{asset('assets/sweetalert2.min.css')}}">
@endsection

@section('content')

<section class="content">
    <div class="container-fluid">

        <div class="row">
            <div class="col-12">
                @if (Session::has('success'))
                <div class="alert alert-success">{{ Session::get('success') }}</div>
                @endif
                <div class="card">
                    <div class="card-header">
                        <a href="{{ route('create') }}" class="btn btn-primary float-left btn-sm">Add Employee</a>

                        <div class="card-tools d-flex justify-content-between">
                            <div class="input-group input-group-sm pr-2">
                                <form action="{{ route('employees') }}" method="GET" id="filter-form">
                                    <select class="form-control form-select-lg" name="sort" onchange="document.getElementById('filter-form').submit();">
                                        <option selected disabled>Select a field to sort data</option>
                                        <option value="age"{{isset($_GET['sort']) && $_GET['sort'] == 'age' ? 'selected' : ''}}>Sort by age</option>
                                        <option value="years_of_exp" {{isset($_GET['sort']) && $_GET['sort'] == 'years_of_exp' ? 'selected' : ''}}>Sort by years of
                                            experience</option>
                                    </select>
                                </form>
                            </div>

                            <form action="{{route('search')}}" method="get">
                            <div class="input-group mb-3">
                                <input type="text" name="search" class="form-control float-right" placeholder="Search">
                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-default"><i class="fas fa-search"></i></button>
                                </div>

                            </div>
                            </form>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body table-responsive p-0" style="height: 300px;">
                        <table class="table table-head-fixed">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Years Of Exp.</th>
                                    <th>Age</th>
                                    <th>Salary</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->email }}</td>
                                    <td>{{ $item->years_of_exp }} years</td>
                                    <td>{{ $item->age }} years</td>
                                    <td>{{ $item->salary }} tk.</td>
                                    <td>
                                        <a href="{{ route('edit', $item->id) }}" class="btn btn-primary btn-sm">Edit</a>
                                        <a href="#" class="delete_btn btn btn-danger btn-sm">Delete</a>
                                        <input type="hidden" name="" id="employee_id" value="{{$item->id}}"
                                            class="hidden">
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
        <!-- /.row -->
    </div><!-- /.container-fluid -->
</section>

@endsection

@section('js')
<script src="{{asset('assets/sweetalert2.min.js')}}"></script>
<script>
    $('.delete_btn').click(function () {
        var id = $(this).next('#employee_id').val();
        swal({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then(function () {
            window.location.href = "/employees/delete/"+id;
        })
    });
</script>
@endsection