<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}" />
        <title>Laravel</title>

        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

    
    </head>
    <body style="background-color: gray">
         <nav class="navbar sticky-top navbar-light bg-light">
            <a class="navbar-brand" href="/dashboard">Dashboard</a>
          </nav>
       
    <div class="container">
        <div class="card mt-4 px-2 py-2">
            <div class="mt-2 mb-2 ml-2">
                <button id="addRow"  class="btn btn-primary">Add</button>
                <button id="btn-submit" class="btn btn-primary">Save</button>

            </div>
        
                <form id="myForm">
                    @csrf
                    <div class="form-row">
                        <table id="myTable">
                            <tr row="1" id="row_id1">
                                <td>
                                    <div class="col">
                                        <label for="exampleFormControlFile1">Name</label>
                                        <input type="text" class="form-control" name="name[]">
                                     </div>
                                </td>
                                 
                                <td>
                                    <div class="col">
                                        <label for="exampleFormControlFile1" >Country</label>
                                        <select class="custom-select" select_count = "1"  id="country-dropdown" onchange="change_country(this,this.getAttribute('select_count'))" name="country[]">
                                            <option selected disabled value="">Select Country</option>
                                                @php
                                             {{ $countries= App\Models\Country::get(); }} 
                                                @endphp
                                            @endphp
                                            @foreach ($countries as $key => $value)
                                            {{ $key }}
                                                <option value="{{ $value->id }}" {{ ( $key == $key) ?  : '' }}> 
                                                    {{ $value->country_name }} 
                                                </option>
                                          @endforeach    
                                          </select>
                                      </div>
                                </td>
                                
                                <td>
                                    <div class="col">
                                        <label for="exampleFormControlFile1">State</label>
                                        <select class="custom-select" name="state[]" id="state-dropdown1">
                                            <option selected disabled value="">Select State</option>1
                                          </select>
                                      </div>
                                </td>
                                
                                <td>
                                    <div class="col"><form>
                                        <div class="form-group">
                                            <label for="exampleFormControlFile1">Image</label>
                                            <input type="file" class="form-control-file" name="image[]" id="img">
                                          </div>
                                </td>
                                 
                            </tr>
                        </table>
                     
                  
                      </form>
                      </div>
                    </div>
                    
                  </form>
             </div>
        </div>

<script>
    $(document).ready(function() {

    
    $("#addRow").click(function() {
    
        let count_row =  $('table tr:last') 
                  .attr('row');
        count_row++   
       

        var newRow = $(`<tr id="row_id${count_row}" row=${count_row}>
                                <td>
                                    <div class="col">
                                        <label for="exampleFormControlFile1">Name</label>
                                        <input type="text" class="form-control" name="name[]">
                                     </div>
                                </td>
                                 
                                <td>
                                    <div class="col">
                                        <label for="exampleFormControlFile1">Country</label>
                                        <select class="custom-select" select_count=${count_row} id="country-dropdown${count_row}" name="country[]" onchange="change_country(this,this.getAttribute('select_count'))">
                                            @php
                                             {{ $countries= App\Models\Country::get(); }} 
                                                @endphp
                                            @endphp
                                            @foreach ($countries as $key => $value)
                                                <option value="{{ $value->id }}" {{ ( $key == $key) ?  : '' }}> 
                                                    {{ $value->country_name }} 
                                                </option>
                                          @endforeach    
                                          </select>
                                      </div>
                                </td>
                                
                                <td>
                                    <div class="col">
                                        <label for="exampleFormControlFile1">State</label>
                                        <select class="custom-select" name="state[]" id="state-dropdown${count_row}">
                                            <option value="">Select State</option>
                                          </select>
                                      </div>
                                </td>
                                
                                <td>
                                    <div class="col"><form>
                                        <div class="form-group">
                                            <label for="exampleFormControlFile1">Image</label>
                                            <input type="file" class="form-control-file" name="image[]" id="img">
                                          </div>
                                </td>
                                <td><button class="btn btn-danger removeRow">Remove</button></td>
                                 
            </tr>`);
        $("#myTable").append(newRow);
       
    });
});
</script>

<script>
        $(document).ready(function() {
        // Remove a row when a button with class "removeRow" is clicked
        $("#myTable").on("click", ".removeRow", function() {
            $(this).closest("tr").remove();
        });
    });
</script>


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>



<script>
    $(document).ready(function() {

        $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
        $('#btn-submit').click(function() {
            // var formData = new FormData();
            // // Serialize form data
            // var formData = {
            //         name: [],
            //         country:[],
            //         state:[],
            //         image:[],
            //     };

               

            var formData = new FormData();
        // Loop through each row and collect data
        $('#myTable tr').each(function() {
                    // formData.name.push($(this).find('input[name="name[]"]').val());
                    // formData.country.push($(this).find('select[name="country[]"]').val());
                    // formData.state.push($(this).find('select[name="state[]"]').val()); 
                    
                    formData.append("name[]",$(this).find('input[name="name[]"]').val());
                    formData.append("country[]",$(this).find('select[name="country[]"]').val());
                    formData.append("state[]",$(this).find('select[name="state[]"]').val());
                    formData.append("images[]",$(this).find('input[name="image[]"]')[0].files[0]);                                
                });

            $.ajax({
                url: "/submit",
                type: "POST",
                enctype: 'multipart/form-data',
                data:  formData,
                contentType:'application/json',
                dataType: "json",
                accept:'application/json',
                // cache: false,
                contentType: false,
                processData: false,
                success: function(response) {
                    // Handle the success response (e.g., show a success message)
                    // location.href= "http://127.0.0.1:8000/dashboard";
                    window.location = "http://127.0.0.1:8000/dashboard";
                },
                        error: function(xhr, type, exception) { 
                            window.location = "http://127.0.0.1:8000/dashboard";
        }
               
            });
        });
    });
    </script>


<script>

    function change_country(e,select_count){
        var idCountry = e.value;
        // alert(e.select_count.value);
            $("#state-dropdown").html('');
            $.ajax({
                url: "{{url('/fetch-states')}}",
                type: "POST",
                data: {
                    country_id: idCountry,  
                    _token: '{{csrf_token()}}'
                },
                dataType: 'json',
                success: function (result) {
                    $('#state-dropdown'+select_count).html('<option value="">-- Select State --</option>');
                    $.each(result.states, function (key, value) {
                        $("#state-dropdown"+select_count).append('<option value="' + value
                            .id + '">' + value.state_name + '</option>');
                    });
                    $('#city-dropdown').html('<option value="">-- Select City --</option>');
                }
            });
        }
            
   
</script>






    </body>
</html>
