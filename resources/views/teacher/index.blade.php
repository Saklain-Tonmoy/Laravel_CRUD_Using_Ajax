<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Laravel 8 Ajax Crud Application</title>
    
    <script src="https://code.jquery.com/jquery-3.1.0.min.js" integrity="sha256-cCueBR6CsyA4/9szpPfrX3s49M9vUU5BgtiJj06wt/s=" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js" integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous"></script>
</head>

<body>

    <div style="padding: 30px;"></div>
    <div class="container">
        <h2 style="color: red;">
            <marquee behavior="" direction="">Laravel 8 Ajax Crud Application</marquee>
        </h2>
        <div class="row">
            <div class="col-sm-8">
                <div class="card">
                    <div class="card-header">
                        All Teachers
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col">S.No</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Title</th>
                                    <th scope="col">Institution</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- <tr>
                                    <td>1</td>
                                    <td>John Doe</td>
                                    <td>Udemy Teacher</td>
                                    <td>Udemy</td>
                                    <td>
                                        <button class="btn btn-sm btn-primary float-left mr-2">Edit</button>
                                        <button class="btn btn-sm btn-danger float-left mr-2">Delete</button>
                                    </td>
                                </tr> -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="card">
                    <div class="card-header">
                        <span id="addT">Add New Teacher</span>
                        <span id="updateT">Update Teacher</span>
                    </div>
                    <div class="card-body">
                        <form id="teacherForm">
                            @csrf
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" class="form-control" id="name" placeholder="Enter Name">
                            </div>
                            <div class="form-group">
                                <label for="title">Title</label>
                                <input type="text" class="form-control" id="title" placeholder="Enter Title">
                            </div>
                            <div class="form-group">
                                <label for="institute">Institute</label>
                                <input type="text" class="form-control" id="institute" placeholder="Enter Institute">
                            </div>
                            
                            <button type="submit" id="addButton" class="btn btn-primary">Add</button>
                            <button type="submit" id="updateButton" class="btn btn-primary">Update</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
    
        $('#addT').show();
        $('#updateT').hide();
        $('#addButton').show();
        $('#updateButton').hide();

        $.ajaxSetup({
            headers:{
                'X-CSRF-TOKEN' : $('meta [name="csrf-token"]').attr('content')
            }
        });

        

        function allData() {
            $.ajax({
                type: "GET",
                dataType: 'json',
                url: "/teacher/all",
                success: function(response) {
                    var data = "";
                    console.log(response);
                    $.each(response, function(key, value) {
                        console.log(value.id);
                        console.log(value.name);
                        console.log(value.title);
                        console.log(value.institute);
                        data += "<tr>"
                        data += "<td>" + value.id + "</td>"
                        data += "<td>" + value.name + "</td>"
                        data += "<td>" + value.title + "</td>"
                        data += "<td>" + value.institute + "</td>"
                        data += "<td>"
                        data += '<button class="btn btn-sm btn-primary float-left mr-2">Edit</button>'
                        data += '<button class="btn btn-sm btn-danger float-left mr-2">Delete</button>'
                        data += "</td>"
                        data += "</tr>"
                    })
                    $('tbody').html(data);
                }
            });
        }

        allData();

        $("#teacherForm").on('submit', function(e) {
            e.preventDefault();

            let name = $("#name").val();
            let title = $("#title").val();
            let institute = $("#institute").val();
            let _token = $("input[name=_token]").val();

            $.ajax({
                type: "POST",
                url: "{{route('teacher.store')}}",               
                data: {
                    name: name,
                    title:title,
                    institute:institute,
                    _token:_token,
                },
                success: function(response) {
                    allData();
                    $("#teacherForm")[0].reset();
                    console.log('Data added Successfully.')
                }
            });
        });
        
        

        // function addData() {
        //     var name = $('#name').val();
        //     var title = $('#title').val();
        //     var institute = $('#institute').val();

        //     // console.log(name);
        //     // console.log(title);
        //     // console.log(institute);

        //     $.ajax({
        //         type: "POST",
        //         dataType: "json",
                
        //         // _token: {{csrf_token()}},
        //         data: {name:name, title:title, institute:institute},
        //         url: "{{route('teacher.store')}}",
        //         success: function(data) {
        //             console.log('successfully added data');
        //         }

        //     })

            
        // }

        // addData();

        
        // $("#teacherForm").on('submit', function(e) {
        //     e.preventDefault();

        //     $.ajax({
        //         type: "POST",
        //         dataType: "json",
        //         url: "{{route('teacher.store')}}",
        //         data: {name:name, title:title, institute:institute},
        //         success: function(response) {
        //             console.log("successfully added data");
        //         }
        //     })
        // })
        

    </script>

</body>

</html>