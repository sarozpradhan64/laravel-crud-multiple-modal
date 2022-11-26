<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Show Students</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
</head>

<body>

    <div class="container">
        <h2 class="text-center mb-5">Laravel - CRUD with multiple Modal</h2>

        {{-- error message --}}
        @foreach($errors->all() as $error)
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{$error}}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endforeach

        {{-- success message --}}
        @if(Session::get('message'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{Session::get('message')}}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif

        <a class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#add_new_student">Add New Student</a>
        <div class="table-responsive">
            <table class="table table-dark table-hover">
                <thead>
                    <tr>
                        <th>
                            S.N
                        </th>

                        <th>
                            Name
                        </th>

                        <th>
                            Phone
                        </th>

                        <th>
                            Email
                        </th>

                        <th>
                            Dob
                        </th>

                        <th>
                            Grade
                        </th>
                        <th>
                            Action
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($students as $student)
                    <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>{{$student->name}}</td>
                        <td>{{$student->phone}}</td>
                        <td>{{$student->email}}</td>
                        <td>{{$student->dob}}</td>
                        <td>{{$student->grade}}</td>
                        <td> <a class="btn btn-primary" id="edit_btn_{{$student->id}}" href="" data-bs-toggle="modal"
                                data-bs-target="#edit_modal_{{$student->id}}">Edit</a> <a class="btn btn-danger"
                                href="{{route('student.delete', [$student->id])}}"
                                onclick="return confirm('Are you sure?')">Delete</a> </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    {{-- add new modal --}}
    <div class="modal fade" id="add_new_student" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add new Student</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{route('student.create')}}" method="POST">
                        {{@csrf_field()}}
                        <input class="form-control mt-2" type="text" name="name" placeholder="Enter full name">
                        <input class="form-control mt-2" type="text" name="phone" placeholder="Enter phone number">
                        <input class="form-control mt-2" type="email" name="email" placeholder="Enter email address">
                        <input class="form-control mt-2" type="date" name="dob" placeholder="Enter date of birth">
                        <input class="form-control mt-2" type="text" name="grade" placeholder="Enter grade">
                        <button type="submit" class="btn btn-primary mt-3">Add new</button>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>

                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    @foreach($students as $student)
    <div class="modal fade" id="edit_modal_{{$student->id}}" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit view of {{$student->name}}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{route('student.update', [$student->id])}}" method="POST">
                        {{@csrf_field()}}
                        <input class="form-control mt-2" type="text" name="name" placeholder="Enter full name"
                            value="{{$student->name}}">
                        <input class="form-control mt-2" type="text" name="phone" placeholder="Enter phone number"
                            value="{{$student->phone}}">
                        <input class="form-control mt-2" type="email" name="email" placeholder="Enter email address"
                            value="{{$student->email}}">
                        <input class="form-control mt-2" type="date" name="dob" placeholder="Enter date of birth"
                            value="{{$student->dob}}">
                        <input class="form-control mt-2" type="text" name="grade" placeholder="Enter grade"
                            value="{{$student->grade}}">
                        <button type="submit" class="btn btn-primary mt-3">Save changes</button>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>

                </div>
            </div>
        </div>
    </div>
    @endforeach
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous">
    </script>
    <script>
        //clicks to specific edit button after the update form modal has been submitted
        @if(!empty(Session::get('modal_id')))
        console.log('{{Session::get("modal_id")}}');
    document.getElementById("edit_btn_" + "{{Session::get('modal_id')}}").click();
    @endif
    </script>

</body>

</html>