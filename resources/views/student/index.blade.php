<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>Ajax Crud Operation</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js" integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous"></script>
</head>

<body>

    <!--Add Student Modal -->
    <div class="modal fade" id="addStudentModal" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="addStudentModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addStudentModalLabel">Add Student Information</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                
                    <div class="modal-body">
                        <form id="addStudentForm">
                        @csrf
                        <div class="form-group row">
                            <label for="first_name" class="col-sm-2 col-form-label">Firstname</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="first_name">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="last_name" class="col-sm-2 col-form-label">Lastname</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="last_name">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="email" class="col-sm-2 col-form-label">Email</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="email">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="phone" class="col-sm-2 col-form-label">Phone</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="phone">
                            </div>
                        </div>
                        <div class="form-group">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" id="saveButton" class="btn btn-primary">Save</button>
                        </div>
                        
                    </div>
                    
                </form>

            </div>
        </div>
    </div>


    <!--Edit Student Modal -->
    <div class="modal fade" id="editStudentModal" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="editStudentModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editStudentModalLabel">Add Student Information</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="editStudentForm">
                    @csrf
                    @method('put')
                    <div class="modal-body">
                        <input type="hidden" id="id" type="text">
                        <div class="form-group row">
                            <label for="first_name" class="col-sm-2 col-form-label">Firstname</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="first_name">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="last_name" class="col-sm-2 col-form-label">Lastname</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="last_name">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="email" class="col-sm-2 col-form-label">Email</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="email">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="phone" class="col-sm-2 col-form-label">Phone</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="phone">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" id="updateButton" class="btn btn-primary">Update</button>
                    </div>
                </form>

            </div>
        </div>
    </div>


    <div class="container">
        <div class="jumbotron">
            <div class="row">
                <h1>Laravel CRUD - AJAX jQuery using Bootstrap MODAL</h1>
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addStudentModal">
                    Add New Student
                </button>
            </div>
            <div class="card">
                <div class="card-body">
                    <table class="table table-dark">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Firstname</th>
                                <th>Lastname</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>



<script>

    
    allData();

    function allData() {
        $.ajax({
            type: "GET",
            dataType: "json",
            url: "{{route('student.allData')}}",
            success: function(response) {
                var data = "";
                $.each(response, function(key, value) {
                    data += "<tr>"
                    data += "<td>" + value.id + "</td>",
                    data += "<td>" + value.first_name + "</td>"
                    data += "<td>" + value.last_name + "</td>"
                    data += "<td>" + value.email + "</td>"
                    data += "<td>" + value.phone + "</td>"
                    data += "<td>"
                    data += "<button class='btn btn-success float-left m-2' id='editButton' data-toggle='modal' data-target='#editStudentModal' data-id=' " + value.id + " ' >Edit</button>"
                    data += "<button class='btn btn-danger float-left m-2' id='deleteButton' data-token='{{ csrf_token() }}' data-id=' " + value.id + " ' >Delete</button>"
                    data += "</td>"
                });
                $('tbody').html(data);
            }
        });
    }

    $(document).on('click', '#editButton', function() {

        $tr = $(this).closest('tr');
        var data = $tr.children('td').map(function() {
            return $(this).text();
        }).get();
        $("#editStudentModal").modal('show');
        $("#id").val(data[0]);
        $("#first_name").val(data[1]);
        $("#last_name").val(data[2]);
        $("#email").val(data[3]);
        $("#phone").val(data[4]);
    })

    $("#addStudentForm").submit(function(e) {

        e.preventDefault();

        let first_name = $("input[name=first_name]").val();
        let last_name = $("input[name=last_name]").val();
        let email = $("input[name=email]").val();
        let phone = $("input[name=phone]").val();
        let _token = $("input[name=_token]").val();

        $.ajax({
            type: "POST",
            //dataType: "json",
            url: "{{route('student.store')}}",
            //headers: {'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')},
            _token: _token,
            data: {
                first_name: first_name,
                last_name: last_name,
                email: email,
                phone: phone,
                _token: _token
            },
            success: function(response) {
                console.log(response),
                    $("#addStudentModal").modal('hide'),
                    $("input[name=first_name]").val(''),
                    $("input[name=last_name]").val(''),
                    $("input[name=email]").val(''),
                    $("input[name=phone]").val(''),
                    // alert("Data Saved");
                    allData();
            },
            error: function(error) {
                
                alert("Data Not Saved");
            }
        });
    });

    $("#editStudentForm").submit(function(e) {
        e.preventDefault();

        let id = $("#id").val();
        let first_name = $("#first_name").val();
        let last_name = $("#last_name").val();
        let email = $("#email").val();
        let phone = $("#phone").val();
        let _token = $("input[name=_token]").val();

        //console.log(_token);

        $.ajax({
            type: "PUT",
            url: "{{route('student.update')}}",
            data: {
                id: id,
                first_name: first_name,
                last_name: last_name,
                email: email,
                phone: phone,
                _token: _token,
            },
            success: function(response) {
                $("#editStudentModal").modal('hide');
                $("#id").val('');
                $("#first_name").val('');
                $("#last_name").val('');
                $("#email").val('');
                $("#phone").val('');

                allData();
            },
            error: function(error) {
                console.log(error);
                alert("Data not saved.");
            }
        });
    });


    $(document).on('click', "#deleteButton", function(e) {
        e.preventDefault();

        $tr = $(this).closest('tr');
        var data = $tr.children('td').map(function() {
            return $(this).text();
        }).get();

        var token = $(this).data("token");
        let id = data[0];
        
        $.ajax({
            type: 'DELETE',
            url: "{{route('student.delete')}}",
            data: {
                id: id,
                _token: token,
            },
            success: function(response) {
                console.log('Data deleted.');
                allData();
            },
            error: function(error) {
                alert('not deleted.');
            }
        })
    })



</script>
</body>


</html>