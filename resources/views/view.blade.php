<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Index</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js"
        integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V"
        crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10/dist/sweetalert2.min.css">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
        <style>
            #addNewEmployee{
                right:-360px;
                position: relative;
            }
        </style>
</head>
<body>
    <div class="container mt-2">
    <div id="message-container">

    </div>
        <div class="card">
            <div class="card-body">
                <div class="bg-success">
                    <span id="newEmployeeAddedMessage"></span>
                </div>
            <div class="bg-secondary  p-2  m-2">
                        <h5 class="text-dark text-center">Laravel Ajax CRUD operation</h5>
                    </div>
                <div class="row">
                        <div class="col-sm-6">
                            <h2>Employee <b>List</b></h2>
                        </div>
                        <div class="col-sm-6" id="addNewEmployee">
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addEmployeeModal">
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
     <!-- Create Employee -->
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
                            <input type="text" name="name" id="name" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" name="email" id="email" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="gender" class="form-label">gender</label>
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
                            <input type="date" name="dob" id="dob" class="form-control">
                            <span id="dobError" class="text-danger"></span>
                        </div>
                        <div class="form-group">
                            <label for="age" class="form-label">Age</label>
                            <input type="number" name="age" id="age" class="form-control" readonly>
                        </div>
                        <div class="form-group">
                            <label for="salary" class="form-label">Salary</label>
                            <input type="number" name="salary" id="salary" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="city" class="form-label">City</label>
                            <input type="text" name="city" id="city" class="form-control">
                        </div>
                        <br>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary btn-xs py-1"
                                data-bs-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary btn-xs py-1" id="save" onclick="addEmployee();">Save changes</button>
                        </div>
                </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Edit Form -->
    <div class="modal fade" id="editEmployeeModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editEmployeeModal">Employee Edit Form</h5>
                </div>
                <div class="modal-body">
                    <form action="" method="post">
                    @csrf
                            <input type="hidden" name="id" id="id" >
                        <div class="form-group">
                            <label for="editname" class="form-label">Name</label>
                            <input type="text" name="editname" id="editname" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="editemail" class="form-label">Email</label>
                            <input type="email" name="editemail" id="editemail" class="form-control" >
                        </div>
                        <div class="form-group">
                            <label for="editgender" class="form-label">gender</label>
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
                            <input type="date" name="editdob" id="editdob" class="form-control" >
                        </div>
                        <div class="form-group">
                            <label for="editage" class="form-label">Age</label>
                            <input type="number" name="editage" id="editage" class="form-control" readonly>
                        </div>
                        <div class="form-group">
                            <label for="editsalary" class="form-label">Salary</label>
                            <input type="number" name="editsalary" id="editsalary" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="editcity" class="form-label">City</label>
                            <input type="text" name="editcity" id="editcity" class="form-control">
                        </div>
                        <br>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary btn-xs py-1"
                                data-bs-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary btn-xs py-1 update">save</button>
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
                <div class="modal-footer">
                    <input type="button" class="btn btn-default close" data-bs-dismiss="modal" value="Cancel">
                    <input type="submit" class="btn btn-danger" onclick="deleteEmployee()" value="Delete">
                </div>
            </div>
        </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script>
         
         $(document).ready(function(){
            employeeList();
        });

        function employeeList() {
            $.ajax({
                type: 'get',
                url: "{{ url('view') }}",
                success: function(response) {
                    var tr = '';
    for(let i=0;i<response.length;i++){
        tr += '<tr>';
        tr += '<td>'+ response[i].name +'</td>';
        tr += '<td>'+ response[i].email +'</td>';
        tr += '<td>'+ response[i].gender +'</td>';
        tr += '<td>'+ response[i].dob +'</td>';
        tr += '<td>'+ response[i].age +'</td>'
        tr += '<td>'+ response[i].salary +'</td>' 
        tr += '<td>'+ response[i].city +'</td>'; 
        tr += '<td><div class="d-flex">';
        tr += '<a class="btn btn-success" data-bs-target="#editEmployeeModal" data-bs-toggle="modal" onclick=viewEmployee("' + response[i].id +'")>Edit</a> &nbsp;&nbsp;' ;
        tr += '<a class="btn btn-danger"  data-bs-target="#deleteEmployeeModal" data-bs-toggle="modal"  onclick=$("#delete_id").val("' +response[i].id+'")>Delete</a>';
        tr += '</div></td>';
        tr += '</tr>';
    }
    $('#employee_data').append(tr);
                }
            });
        }

                $('#dob').on('change',()=>{
               var dob = new Date( $('#dob').val());
               var today = new Date();
               var age = today.getFullYear() - dob.getFullYear();
               if((dob.getFullYear() === today.getFullYear() && dob.getMonth() === today.getMonth() && dob.getDate() > today.getDate()) || (dob.getFullYear() === today.getFullYear() && dob.getMonth() > today.getMonth())||(dob.getFullYear() > today.getFullYear())){
                   $('#dobError').text('Please Select Correct Date Of Birth');
                   $('#dob').val('');
               }else{
                   $('#dobError').text('');
                  if(today.getMonth() < dob.getMonth() || (today.getMonth() === dob.getMonth() && today.getDate() < dob.getDate())){
                    age--;
                  }
                  $('#age').val(age);
               }
            });

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
                    console.log($('#saveform').serialize());
            $.ajax({
               url: "{{url('employee-add')}}",
               type:"POST",
               data :{
                  name:name,
                  email:email,
                  gender:gender,
                  dob:dob,
                  age:age,
                  salary:salary,
                  city:city,
               },
               success: function(response) {
                    $('#addEmployeeModal').modal('hide');
                    employeeList();
                }
            })
                }else{
                    alert('please fill all the fields');
                }
                }

function viewEmployee(id) {
            $.ajax({
                type: 'get',
                url: "{{ url('employee') }}/" + id,
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
        $('.update').click(()=>{
            var editid = $('#id').val();
            var editname =$('#editname').val();
            var editemail = $('#editemail').val();
            var editgender = $('input[name="editgender"]:checked').val();
            console.log(editgender);
            var editdob = $('#editdob').val();
            var editage =$('#editage').val();
            var editsalary = $('#editsalary').val();
            var editcity =$('#editcity').val();
            $.ajax({
                url:'{{url('employeeupdate')}}',
                type:'post',
                data:{
                    editid : editid,
                    editname : editname,
                    editemail : editemail,
                    editgender : editgender,
                    editdob : editdob,
                    editage : editage,
                    editsalary : editsalary,
                    editcity : editcity,
                }, success: function(data) {
                    $('#editEmployeeModal').modal('hide');
                    if (data.message) {
                        $('#message-container').html('<div class="alert alert-success">' + data.message + '</div>');
                    }
                    employeeList();
                }
            });
        });

       function deleteEmployee(){
       var id = $("#delete_id").val();
       $('#deleteEmployeeModal').modal('hide');
            console.log(id);
            $.ajax({
               url : "{{ url('employee-delete') }}/" + id,
               type : "get",
               success:function(response){
                employeeList();
               }
            });
        }

    </script>
</body>
</html>