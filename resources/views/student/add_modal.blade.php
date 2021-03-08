<!-- Modal -->
<div class="modal fade" id="addStudentModal" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="addStudentModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addStudentModalLabel">Add Student Information</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="addStudentForm">
                @csrf
                <div class="modal-body">
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
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" id="save" class="btn btn-primary">Save</button>
                </div>
            </form>

        </div>
    </div>
</div>

@push('scripts')
<script>
    

        $("#addStudentForm").on('submit', function(e) {
            e.preventDefault();

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            let first_name = $("#first_name").val();
            let last_name = $('#last_name').val();
            let email = $('#email').val();
            let phone = $('#phone').val();

            $.ajax({
                type: "POST",
                url: "{{route('student.store')}}",
                //_token: "{{csrf_token()}}",
                data: {
                    first_name: first_name,
                    last_name: last_name,
                    email: email,
                    phone: phone,
                    //_token: _token
                },
                success: function(response) {
                    console.log(response),
                    $("#addStudentModal").modal('hide'),
                    $("#first_name").val(''),
                    $("#last_name").val(''),
                    $("#email").val(''),
                    $("#phone").val(''),
                    // alert("Data Saved");
                    allData();
                },
                error: function(error) {
                    console.log(error),
                    alert("Data Not Saved");
                }
            });
        });

</script>
@endpush