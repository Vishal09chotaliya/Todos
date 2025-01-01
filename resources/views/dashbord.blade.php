<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Dashbord</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <style>
        .tbl-container {
            width: 60%;
            margin: auto;
        }

        .tbl-container button {
            margin-top: 20px;
        }

        span {
            color: red;
            display: none;
        }

        .smsg {
            display: none;
        }

        .head {
            display: flex;
            justify-content: space-between;
        }

        .head h3 {
            margin-top: 20px;
        }
    </style>
</head>

<body class="font-sans antialiased dark:bg-black dark:text-white/50">

    <div class="tbl-container">
        <!-- Button trigger modal -->
        <div class="head">
            <button taype="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                Add Data
            </button>
            <h3>Welcome, {{ Auth::user()->user_name }}</h3>
            <div class="dropdown dropend">
                <div class="dropdown">
                    <button type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown">
                        Option
                    </button>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" id="changePass" href="{{ route('dashbord.change.pass') }}">Change
                                Password</li>
                        <li><a class="dropdown-item" id="logout-btn" href="#">Logout</a></li>
                    </ul>
                </div>
                <ul class="dropdown-menu">
                    <li><button class="dropdown-item">LogOut</button></li>
                </ul>
            </div>
        </div>
        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Add Data</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="" method="post" id="addform">
                            @csrf
                            @method('POST')
                            <input type="text" placeholder="First Name" class="form-control" id="fname"
                                name="fname"><br>
                            <input type="text" placeholder="Last Name" class="form-control" id="lname"
                                name="lname">
                        </form><br>
                        <span id="msg">All field are Require. Please Fill the Form.</span>
                        <div class="smsg text-success">Data Saved.</div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" id="save-data">Save</button>
                    </div>
                </div>
            </div>
        </div><br><br>
        <input type="text" placeholder="Search.." class="form-control" id="search-data">
        <br>
        <table class="table table-secondary" id="user-table">
            <thead>
                <tr>
                    <th scope="col">Id</th>
                    <th scope="col">First Name</th>
                    <th scope="col">Last Name</th>
                    <th scope="col">Edit</th>
                    <th scope="col">Delete</th>
                </tr>
            </thead>
            <tbody id="table-data">
                @foreach ($data as $item)
                    <tr id="tr_{{ $item->id }}">
                        <th scope="row_">{{ $item->id }}</th>
                        <td>{{ $item->first_name }}</td>
                        <td>{{ $item->last_name }}</td>

                        <td> <button class="btn btn-secondary btn-edit" data-bs-toggle="modal"
                                data-bs-target="#editModal" data-id="{{ $item->id }}">Edit</button>

                        </td>
                        <td><a href="javascript:void[0]" class="btn btn-danger"
                                onclick="Delete({{ $item->id }})">Delete</a></td>
                    </tr>
                @endforeach
            </tbody>
            <div class="mt-5">
                {{ $data->links('pagination::bootstrap-5') }}
            </div>
        </table>

        <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Edit Data</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="loaddata" method="POST">
                            @csrf
                            <input type="text" id="first_name" name="first_name" class="form-control"
                                value="{{ $todo->first_name ?? '' }}"><br>
                            <input type="text" id="last_name" name="last_name" class="form-control"
                                value="{{ $todo->last_name ?? '' }}">
                        </form>
                        <span id="edit-msg"></span>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" id="saveChangesBtn">Save changes</button>
                    </div>
                </div>
            </div>
        </div>


    </div>
    @include('jquery')
    <script>
        $(document).ready(function() {
            $('#save-data').on('click', function(e) {
                e.preventDefault();
                var fname = $('#fname').val();
                var lname = $('#lname').val();

                if (fname == '' || lname == '') {
                    $('#msg').show();
                    setTimeout(function() {
                        $('#msg').hide(1000);
                    }, 5000);

                } else {
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        url: "{{ route('store') }}",
                        method: 'POST',
                        data: {
                            fnm: fname,
                            lnm: lname
                        },
                        success: function(response) {
                            $('.smsg').show(500);
                            setTimeout(function() {
                                $('.smsg').hide(1000);
                            }, 5000);
                            $('#table-data').append(`<tr id="row${response.id}">
                                <td id="tr_${response.id}">${response.id}</td>
                                <td>${response.first_name}</td>
                                <td>${response.last_name}</td>
                                <td>
                                    <button class="btn btn-secondary btn-edit" data-bs-toggle="modal" data-bs-target="#editModal" data-id="${response.id}">Edit</button>
                                </td>
                                <td><button class="btn btn-danger" data-id="${response.id}">Delete</button></td>
                            </tr>`);
                            $('#addform')[0].reset();

                        }
                    });
                }
            });

            $('.btn-edit').on('click', function() {
                var todoId = $(this).data('id');

                $.ajax({
                    url: '/todos/' + todoId,
                    method: 'GET',
                    success: function(response) {
                        $('#first_name').val(response.first_name);
                        $('#last_name').val(response.last_name);

                        $('#loaddata').attr('action', '/edit/' + response.id);
                    }
                });
            });

            $('#saveChangesBtn').on('click', function() {
                var form = $('#loaddata');
                var formData = form.serialize();

                $.ajax({
                    url: form.attr('action'),
                    method: 'POST',
                    data: formData,
                    success: function(response) {
                        if (response.success) {
                            $('#editModal').modal('hide');
                            alert('Data updated successfully');
                            location.reload();
                        }
                    },
                    error: function(response) {
                        alert('Error updating Data');
                    }
                });
            });

            $('#search-data').on('keyup', function(e) {
                e.preventDefault();
                var searchItem = $('#search-data').val();

                $.ajax({
                    url: "/search-data",
                    type: 'GET',
                    data: {
                        search: searchItem
                    },
                    success: function(result) {
                        let tableContent = '';
                        if (result.data && result.data.length > 0) {
                            // Loop through the result data to construct rows
                            for (let i = 0; i < result.data.length; i++) {
                                tableContent += `
                        <tr id="row${result.data[i].id}">
                            <td>${result.data[i].id}</td>
                            <td>${result.data[i].first_name}</td>
                            <td>${result.data[i].last_name}</td>
                            <td>
                                <button class="btn btn-secondary btn-edit" data-bs-toggle="modal" data-bs-target="#editModal" data-id="${result.data[i].id}">Edit</button>
                            </td>
                            <td><button class="btn btn-danger" data-id="${result.data[i].id}">Delete</button></td>
                        </tr>`;
                            }
                        } else {
                            tableContent = '<tr><td colspan="5">No results found</td></tr>';
                        }

                        // Update the table content
                        $('#table-data').html(tableContent);
                    },
                    error: function() {
                        $('#table-data').html(
                            '<tr><td colspan="5">An error occurred while fetching data</td></tr>'
                        );
                    }
                });
            });

            $('#logout-btn').on('click', function() {
                if (confirm('Are you sure Logout of this User')) {
                    $.ajax({
                        url: "{{ route('logout') }}",
                        method: "GET",
                        success: function(response) {
                            window.location.href = "/";
                        }
                    });
                }

            });
        });


        function Delete(id) {
            if (confirm('Are you Sure to Delete This.')) {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: '/delete/' + id,
                    type: 'DELETE',
                    success: function(result) {
                        $('#' + result['tr']).slideUp(1000);
                    }
                });
            }
        }
    </script>
</body>

</html>
