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
                <button id="addRow" class="btn btn-primary">Add</button>
                <button id="btn-submit" class="btn btn-primary">Save</button>

            </div>
        
                <form id="myForm">
                    @csrf
                    <div class="form-row">
                        <table id="myTable">
                            <tr>
                                <td>
                                    <div class="col">
                                        <label for="exampleFormControlFile1">Name</label>
                                        <input type="text" class="form-control name">
                                     </div>
                                </td>
                                 
                                <td>
                                    <div class="col">
                                        <label for="exampleFormControlFile1" id="country">Country</label>
                                        <select class="custom-select country">
                                            <option value="1">One</option>
                                            <option value="2">Two</option>
                                            <option value="3">Three</option>
                                          </select>
                                      </div>
                                </td>
                                
                                <td>
                                    <div class="col">
                                        <label for="exampleFormControlFile1">State</label>
                                        <select class="custom-select state">
                                            <option selected>Select State</option>
                                            <option value="1">One</option>
                                            <option value="2">Two</option>
                                            <option value="3">Three</option>
                                          </select>
                                      </div>
                                </td>
                                
                                <td>
                                    <div class="col"><form>
                                        <div class="form-group">
                                            <label for="exampleFormControlFile1">Image</label>
                                            <input type="file" class="form-control-file image" id="exampleFormControlFile1">
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
        var newRow = $(`<tr>
                                <td>
                                    <div class="col">
                                        <label for="exampleFormControlFile1">Name</label>
                                        <input type="text" class="form-control name">
                                     </div>
                                </td>
                                 
                                <td>
                                    <div class="col">
                                        <label for="exampleFormControlFile1">Country</label>
                                        <select class="custom-select country">
                                            <option value="1">One</option>
                                            <option value="2">Two</option>
                                            <option value="3">Three</option>
                                          </select>
                                      </div>
                                </td>
                                
                                <td>
                                    <div class="col">
                                        <label for="exampleFormControlFile1">State</label>
                                        <select class="custom-select state">
                                            <option selected>Select State</option>
                                            <option value="1">One</option>
                                            <option value="2">Two</option>
                                            <option value="3">Three</option>
                                          </select>
                                      </div>
                                </td>
                                
                                <td>
                                    <div class="col"><form>
                                        <div class="form-group">
                                            <label for="exampleFormControlFile1">Image</label>
                                            <input type="file" class="form-control-file image">
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
            // Serialize form data

            let name = [];

                // Loop through each input element and push its value to the array
                $('.name').each(function() {
                    name.push($(this).val());
                });

            let country=[];    
                  // Loop through each input element and push its value to the array
                  $('.country').each(function() {
                    country.push($(this).val());
                });

            let state=[];    
                // Loop through each input element and push its value to the array
                $('.state').each(function() {
                    state.push($(this).val());
            });
           
            let image=[];    
                // Loop through each input element and push its value to the array
                $('.image').each(function() {
                    image.push($(this).val());
            });
          
            $.ajax({
                url: "/submit",
                type: "POST",
                enctype: 'multipart/form-data',
                data: {
                    name: JSON.stringify(name),
                    country: JSON.stringify(country),
                    state: JSON.stringify(state),
                    image: JSON.stringify(image),
                },
                dataType: "json",
                success: function(response) {
                    // Handle the success response (e.g., show a success message)
                    alert(response.message);
                },
                error: function(xhr) {
                    // Handle the error response (e.g., display validation errors)
                    var errors = xhr.responseJSON.errors;
                    console.log(errors);
                }
            });
        });
    });
    </script>
  

    </body>
</html>
