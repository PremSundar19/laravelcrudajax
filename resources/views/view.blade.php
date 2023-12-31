<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Index</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
        <style>
            #addNewEmployee{
                right:-360px;
                position: relative;
            }
        </style>
</head>
<body>
    <div class="container mt-2">
    <div id="message-container"></div>
        <div class="card">
            <div class="card-body">
                <div class="bg-success">
                    <span id="newEmployeeAddedMessage"></span>
                </div>
            <div class="bg-secondary  p-2  m-2">
                        <h5 class="text-dark text-center">Laravel AJAX CRUD Operation</h5>
                    </div>
                <div class="row">
                        <div class="col-sm-6">
                            <h2>Employee <b>List</b></h2>
                        </div>
                        <div class="col-sm-6" id="addNewEmployee">
                <button type="button" class="btn btn-primary mt-2" data-bs-toggle="modal" data-bs-target="#addEmployeeModal">
                    Add New Employee
                </button>
                        </div>
                    </div>
                <table class="table  table-bordered table-stripted table-hover mt-3">
                    <thead class="table-dark">
                        <tr>
                            <th scope="col">Name</th>
                            <th scope="col">Email</th>
                            <th scope="col">Gender</th>
                            <th scope="col">Date Of Birth</th>
                            <th scope="col">Age</th>
                            <th scope="col">salary</th>
                            <th scope="col">City</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody id="employee_data">
                    </tbody>
                </table>
            </div>
        </div>
    </div>
     <!-- Create modal -->
     <div id="addEmployeeModal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Add Employee</h4>
                </div>
                <div class="modal-body add_epmployee">
                @csrf
                <form id="saveform" method="post">
                         <div class="form-group">
                             <label for="name" class="form-label">Name</label>
                            <input type="text" name="name" id="name" class="form-control" oninput=" validateText(this);">
                            <span id="nameError2" class="text-danger"></span>
                        </div>
                        <div class="form-group">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" name="email" id="email"   onblur="duplicateEmail(this);"  class="form-control">
                            <span id="emailError" class="text-danger"></span>
                            <span id="alreadyExists" class="text-danger"></span>
                        </div>
                        <div class="form-group">
                            <label class="form-label">gender</label>
                            <div>
                                <input type="radio" name="gender" id="male" value="Male">
                                <label for="male" class="form-label">Male</label>
                                <input type="radio" name="gender" id="female" value="Female">
                                <label for="female" class="form-label">Female</label>
                                <input type="radio" name="gender" id="others" value="Others">
                                <label for="others" class="form-label">Others</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="dob" class="form-label">Date Of Birth</label>
                            <input type="date" name="dob" id="dob" class="form-control" >
                            <span id="dobError" class="text-danger"></span>
                        </div>
                        <div class="form-group">
                            <label for="age" class="form-label">Age</label>
                            <input type="number" name="age" id="age" class="form-control" readonly>
                        </div>
                        <div class="form-group">
                            <label for="salary" class="form-label">Salary</label>
                            <input type="number" name="salary" id="salary" class="form-control" oninput="validateSalary(this);">
                            <span id="salaryError" class="text-danger"></span>
                        </div>
                        <div class="form-group">
                            <label for="city" class="form-label">City</label>
                            <input type="text" name="city" id="city" class="form-control" oninput="validateText(this);">
                            <span id="cityError" class="text-danger"></span>
                        </div>
                        <br>
                        <div class="modal-footer"  style="height: 45px;">
                            <button type="button" class="btn btn-secondary btn-xs py-0 saveFormClose"
                                data-bs-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary btn-xs py-0" id="save" onclick="addEmployee();">Save</button>
                        </div>
                </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Edit modal -->
    <div class="modal fade" id="editEmployeeModal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editEmployee">Employee Edit Form</h5>
                </div>
                <div class="modal-body">
                    <form id="editform" method="post">
                    @csrf
                            <input type="hidden" name="id" id="id" >
                        <div class="form-group">
                            <label for="editname" class="form-label">Name</label>
                            <input type="text" name="editname" id="editname" class="form-control" oninput="validateText(this);">
                        </div>
                        <div class="form-group">
                            <label for="editemail" class="form-label">Email</label>
                            <input type="email" name="editemail" id="editemail" class="form-control"  onblur="duplicateEmail(this);" >
                        </div>
                        <div class="form-group">
                            <label class="form-label">gender</label>
                            <div>
                                <input type="radio" name="editgender" id="editmale" value="Male">
                                <label for="editmale" class="form-label">Male</label>
                                <input type="radio" name="editgender" id="editfemale" value="Female">
                                <label for="editfemale" class="form-label">Female</label>
                                <input type="radio" name="editgender" id="editothers" value="Others">
                                <label for="editothers" class="form-label">Others</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="editdob" class="form-label">Date Of Birth</label>
                            <input type="date" name="editdob" id="editdob" class="form-control">
                            <span id="editdobError" class="text-danger"></span>
                        </div>
                        <div class="form-group">
                            <label for="editage" class="form-label">Age</label>
                            <input type="number" name="editage" id="editage" class="form-control" readonly>
                        </div>
                        <div class="form-group">
                            <label for="editsalary" class="form-label">Salary</label>
                            <input type="number" name="editsalary" id="editsalary" class="form-control" oninput="validateSalary(this);">
                        </div>
                        <div class="form-group">
                            <label for="editcity" class="form-label">City</label>
                            <input type="text" name="editcity" id="editcity" class="form-control" oninput="validateText(this);">
                        </div>
                        <br>
                        <div class="modal-footer" style="height: 45px;">
                            <button type="button" class="btn btn-secondary btn-xs py-0"
                                data-bs-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary btn-xs py-0" onclick="updateEmployee()">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Delete Modal -->
    <div id="deleteEmployeeModal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Delete Employee</h4>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to delete these Records?</p>
                    <p class="text-danger"><small>This action cannot be undone.</small></p>
                </div>
                <input type="hidden" id="delete_id">
                <div class="modal-footer"  style="height: 60px;">
                    <input type="button" class="btn btn-secondary close btn-xs py-0" data-bs-dismiss="modal" value="Cancel">
                    <input type="submit" class="btn btn-danger btn-xs py-0" onclick="deleteEmployee()" value="Delete">
                </div>
            </div>
        </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script>
        function validateText(input){
            const regex = /[0-9!@#$%^&*()_+{}\[\]:;|/='"<>,?~\\-]/;
            if (regex.test(input.value)) {
                $('#nameError').text('* Special Charater or Number not allowed');
                input.value= input.value.replace(/[^A-Za-z]/g, '');
            } else { 
                $('#nameError').text('');
            }
        }
        $('#name').on('blur',()=>{
                var name = $('#name').val();
                if(name.length < 5 ){
                    $('#nameError2').text('* Name Should be aleast 5 letters');
                    $('#name').val('');
                }else{
                    $('#nameError2').text('');
                }
        });
       function validateSalary(input){
                const salary = parseFloat(input.value);
                if (isNaN(salary) || salary < 0) {
                        $('#salaryError').text('* Salary must be a non-negative number.');
                        input.value =  "";
                    } else {
                        $('#salaryError').text('');
                    }
        }
        function validateEmail(input) {
                    const validateEmail = input.value;
                    const emailPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;
                    if (!emailPattern.test(validateEmail)) {
                          $('#alreadyExists').text('');
                          $('#emailError').text('* Please enter a valid email address.');
                    } else {
                        $('#emailError').text('');
                    }
        }
        function duplicateEmail(element){
           var email = $(element).val();
                $.ajax({
                    type: 'get',
                    url: '{{url('checkEmail')}}',
                    data: {email:email},
                    dataType: "json",
                    success: function(response) {
                        if(response.exists){
                            $('#alreadyExists').text('* Email is already exists')
                            $('#email').val('');
                        }
                    }
                });
        }
        $('.saveFormClose').click(()=>{
                    $('#nameError2,#alreadyExists').text('');
                    $('#name,#email,#dob,#age,#salary,#city').val('');
                    $('input[type="radio"][name="gender"]').prop('checked', false);
        });
    </script>
    <script>
         $(document).ready(()=>{
            employeeList();
        });
        $.ajaxSetup({
          headers: {
           'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
        });
        function employeeList() {
            $.ajax({
                type: 'get',
                url: '{{ url('employeeList') }}',
                success: function(response) {
                    $('#employee_data').empty();
                    var tr = '';
                        for(let i=response.length-1;i>=0;i--){
                            tr += '<tr>';
                            tr += '<td>'+ response[i].name +'</td>';
                            tr += '<td>'+ response[i].email +'</td>';
                            tr += '<td>'+ response[i].gender +'</td>';
                            tr += '<td>'+ response[i].dob +'</td>';
                            tr += '<td>'+ response[i].age +'</td>'
                            tr += '<td>'+ response[i].salary +'</td>' 
                            tr += '<td>'+ response[i].city +'</td>'; 
                            tr += '<td><div class="d-flex">';
                            tr += '<a class="btn btn-success  btn-xs py-0" data-bs-target="#editEmployeeModal" data-bs-toggle="modal" onclick=viewEmployee("' + response[i].id +'")>Edit</a> &nbsp;&nbsp;' ;
                            tr += '<a class="btn btn-danger  btn-xs py-0"  data-bs-target="#deleteEmployeeModal" data-bs-toggle="modal"  onclick=$("#delete_id").val("' +response[i].id+'")>Delete</a>';
                            tr += '</div></td>';
                            tr += '</tr>';
                        }
                        $('#employee_data').append(tr);
                }
            });
        }
        function calculateAge(dobId, ageId, dobErrorId) {
            var dob = new Date($(dobId).val());
            var today = new Date();
            var age = today.getFullYear() - dob.getFullYear();
            if (dob > today ||(dob.getFullYear() === today.getFullYear() && dob.getMonth() === today.getMonth() && dob.getDate() > today.getDate())) {
                $(dobErrorId).text('Please Select Correct Date Of Birth');
                $(ageId).val('');
            } else {
                $(dobErrorId).text('');
                if (today.getMonth() < dob.getMonth() ||(today.getMonth() === dob.getMonth() && today.getDate() < dob.getDate())) {
                age--;
                }
                $(ageId).val(age);
            }
        }
        $('#dob').on('change', () => {
            calculateAge('#dob', '#age', '#dobError');
        });
        $('#editdob').on('change', () => {
            calculateAge('#editdob', '#editage', '#editdobError');
        });
        function successMessage(message,status) {
             $('#message-container').html('<div class="alert alert-success">' + message + '</div>');
             setTimeout(function () {
                 $('#message-container').empty();
             }, 4000);
             employeeList();
             console.log('Status : ' + status + ', Response Message : ' + message);
        }
        function addEmployee(){
            var name = $('#name').val();
            var email = $('#email').val();
            var gender = $('input[name="gender"]:checked').val();
            var dob = $('#dob').val();
            var age = $('#age').val();
            var salary = $('#salary').val();
            var city = $('#city').val();
                if(name !== "" && email !== "" && gender !== "" && dob !== "" && age !== "" && salary !== "" && city !== "" ){
                    $("#save").attr("disabled", "disabled");
                    $.post('{{url('employeeAdd')}}', {
                        name: name,
                        email: email,
                        gender: gender,
                        dob: dob,
                        age: age,
                        salary: salary,
                        city: city
                    }, function (response) {
                        $('#addEmployeeModal').modal('hide');
                              successMessage(response.message,response.status);
                    });
                }else{
                    alert('please fill all the fields');
                }
                }
        function viewEmployee(id) {
            $.ajax({
                type: 'get',
                url: '{{ url('employeeFetch') }}/' + id,
                success: function(response) {
                    $('#id').val(response.id);
                    $('#editname').val(response.name);
                    $('#editemail').val(response.email);
                    genderValue = response.gender;
                            if(genderValue === "Male"){
                                $('input[name="editgender"][value="' + genderValue + '"]').prop('checked', true);
                            }else if(genderValue === "Female"){
                                $('input[name="editgender"][value="' + genderValue + '"]').prop('checked', true);
                            }else{
                                $('input[name="editgender"][value="' + genderValue + '"]').prop('checked', true);
                            }
                    $('#editdob').val(response.dob);
                    $('#editage').val(response.age);
                    $('#editsalary').val(response.salary);
                    $('#editcity').val(response.city);
                }
            })
        }
        function updateEmployee(){
            var data = {
             editid : $('#id').val(),
             editname : $('#editname').val(),
             editemail : $('#editemail').val(),
             editgender : $('input[name="editgender"]:checked').val(),
             editdob : $('#editdob').val(),
             editage : $('#editage').val(),
             editsalary : $('#editsalary').val(),
             editcity :$('#editcity').val(),
            };
            $.ajax({
                url:'{{url('employeeUpdate')}}',
                type:'post',
                data:data, 
                success: function(response) {
                    $('#editEmployeeModal').modal('hide');
                    successMessage(response.message,response.status);
                }
            });
        }
        function deleteEmployee(){
            var id = $('#delete_id').val();
            $('#deleteEmployeeModal').modal('hide');
            $.ajax({
               url : '{{ url('employeDelete') }}/' + id,
               type : "get",
               success:function(response){
                    successMessage(response.message,response.status);
               }
            });
        }
    </script>
</body>
</html>