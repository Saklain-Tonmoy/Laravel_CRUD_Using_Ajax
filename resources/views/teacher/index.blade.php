<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <meta name="csrf-token" content="{{ csrf_token() }}"> -->
    <title>Laravel 8 Ajax Crud Application</title>
    
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
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
                        <table class="table table-striped">
                            @csrf
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
                        <span id="addTitle">Add New Teacher</span>
                        <span id="updateTitle">Update Teacher</span>
                    </div>
                    <div class="card-body">
                        <form id="teacherForm">
                            @csrf
                            <input type="hidden" id="id">
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" class="form-control" id="name" placeholder="Enter Name">
                                <span class="text-danger" id="nameError"></span>
                            </div>
                            <div class="form-group">
                                <label for="title">Title</label>
                                <input type="text" class="form-control" id="title" placeholder="Enter Title">
                                <span class="text-danger" id="titleError"></span>
                            </div>
                            <div class="form-group">
                                <label for="institute">Institute</label>
                                <input type="text" class="form-control" id="institute" placeholder="Enter Institute">
                                <span class="text-danger" id="instituteError"></span>
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
    
        $('#addTitle').show();
        $('#updateTitle').hide();
        $('#addButton').show();
        $('#updateButton').hide();

        /******* CSRF token setup in ajax  *******/
        // $.ajaxSetup({
        //     headers:{
        //         'X-CSRF-TOKEN' : $('meta [name="csrf-token"]').attr('content')
        //     }
        // });

        
        /******* Fetching All Data from database starts *******/
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
                        data += '<button class="btn btn-sm btn-primary float-left mr-2" id="editButton" data-id=" '+ value.id +' ">Edit</button>'  // adding the button using DOM.  data-id has been used to keep the track of the id
                        data += '<button class="btn btn-sm btn-danger float-left mr-2" id="deleteButton" data-id=" '+ value.id +' ">Delete</button>'   // adding the button using DOM
                        data += "</td>"
                        data += "</tr>"
                    })
                    $('tbody').html(data);
                }
            });
        }

        allData();

        /********* Fetching All Data ends *********/


        /****** Reseting the teacherForm & the validation messages starts *******/
        function clearData() {
            $("#name").val('');
            $("#title").val('');
            $("#institute").val('');
            $("#nameError").text('');
            $("#titleError").text('');
            $("#instituteError").text('');
        }
        /*********** Reseting the teacherForm ends ********/


        /******** Storing form data into database using $(document).on('click', '#buttonId', function() {}) starts  */
        // $(document).on('click', '#addButton', function(e) {
        //     e.preventDefault();

        //     let name = $("#name").val();
        //     let title = $("#title").val();
        //     let institute = $("#institute").val();
        //     let _token = $("input[name=_token]").val();

        //     $.ajax({
        //         type: "POST",
        //         url: "{{route('teacher.store')}}",               
        //         data: {
        //             name: name,
        //             title:title,
        //             institute:institute,
        //             _token:_token,
        //         },
        //         success: function(response) {
        //             allData();  // this function has been called to fetch the data after insertion
        //             clearData();    // this function has been called to reset the form and also to vanish the validation message
        //             // $("#teacherForm")[0].reset();       // this line of code resets the teacherForm
        //             console.log('Data added Successfully.')
        //         },
        //         error: function(error) {
        //             $("#nameError").text(error.responseJSON.errors.name);
        //             $("#titleError").text(error.responseJSON.errors.title);
        //             $("#instituteError").text(error.responseJSON.errors.institute);
        //             console.log(error.responseJSON.errors.name);
        //             console.log(error.responseJSON.errors.title);
        //             console.log(error.responseJSON.errors.institute);
        //         }
        //     });
        // });
        /******** Storing All Data into database ends *******/


        /******** Storing form data into database using $('#formId').on('submit', function() {}) starts  *******/
        /**** This is the general way to store data on FORM Submit, 
        but when a button or form is added or prepened or appened using DOM,
        then you have to use: 
        $(document).on('click', '#buttonId', function() {}) =>for button click
        $(document).on('submit', '#formId', function() {}) =>for Form submit
        ****/
        $('#addButton').on('click', function(e) {
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
                    allData();  // this function has been called to fetch the data after insertion
                    clearData();    // this function has been called to reset the form and also to vanish the validation message
                    // $("#teacherForm")[0].reset();       // this line of code resets the teacherForm
                    console.log('Data added Successfully.')
                },
                error: function(error) {
                    $("#nameError").text(error.responseJSON.errors.name);
                    $("#titleError").text(error.responseJSON.errors.title);
                    $("#instituteError").text(error.responseJSON.errors.institute);
                    console.log(error.responseJSON.errors.name);
                    console.log(error.responseJSON.errors.title);
                    console.log(error.responseJSON.errors.institute);
                }
            });
        });
        /******** Storing All Data into database ends *******/

        /********** Fetch data from database and show it in the Form starts **********/
        /*********** When Any Button is added to the page using DOM then you have to use 
            $(document).on('click, '#buttonId', function() {})  ***********/
        // $(document).on('click', '#editButton', function() {
            
        //     $("#addTitle").hide();
        //     $("#updateTitle").show();
        //     $("#addButton").hide();
        //     $("#updateButton").show();
            
        //     var id = $(this).data('id');    // this is nothing but getting the value of 'data-id' from the edit button. 'data-id' has to be fetched by the code: $(this).data('id') in jquery
        //     //alert(id);

        //     $.ajax({
        //         type: "GET",
        //         dataType: "json",
        //         url: "{{route('teacher.edit')}}",
        //         data: {
        //             id:id,
        //         },
        //         success: function(response) {
        //             console.log(response);
        //             $("#name").val(response.name);
        //             $("#title").val(response.title);
        //             $("#institute").val(response.institute);
        //         },
        //         error: function(error) {
        //             console.log(error);
        //         }
        //     });
        // });

        /********** Fetch data from database and show it in the Form ends **********/


        /********** Fetch data from DataTable and show it in the Form starts **********/
        $(document).on('click', '#editButton', function() {
            
            $("#addTitle").hide();
            $("#updateTitle").show();
            $("#addButton").hide();
            $("#updateButton").show();
            
            $tr = $(this).closest('tr');
            var data = $tr.children('td').map(function() {
                return $(this).text();
            }).get();
            console.log(data);
            $("#id").val(data[0]);
            $("#name").val(data[1]);
            $("#title").val(data[2]);
            $("#institute").val(data[3]);
        });



        $(document).on('click', '#updateButton', function() {

            let id = $("#id").val();
            console.log(id);
            let name = $("#name").val();
            let title = $("#title").val();
            let institute = $("#institute").val();
            let _token = $("input[name=_token]").val();

            $.ajax({
                type: "PUT",
                url: "{{route('teacher.update')}}",               
                data: {
                    id: id,
                    name: name,
                    title:title,
                    institute:institute,
                    _token:_token,
                },
                success: function(response) {
                    allData();  // this function has been called to fetch the data after insertion
                    clearData();    // this function has been called to reset the form and also to vanish the validation message
                    // $("#teacherForm")[0].reset();       // this line of code resets the teacherForm
                    $('#addTitle').show();
                    $('#updateTitle').hide();
                    $('#addButton').show();
                    $('#updateButton').hide();

                    console.log('Data added Successfully.');
                },
                error: function(error) {
                    $("#nameError").text(error.responseJSON.errors.name);
                    $("#titleError").text(error.responseJSON.errors.title);
                    $("#instituteError").text(error.responseJSON.errors.institute);
                    console.log(error.responseJSON.errors.name);
                    console.log(error.responseJSON.errors.title);
                    console.log(error.responseJSON.errors.institute);
                }

            
        });
    });

        

    </script>

</body>

</html>