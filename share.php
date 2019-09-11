<?php

require_once('header.php');

// echo $_SERVER['REQUEST_URI'];
// echo "Share movie page" ; 
?>

<div>
    <form action="index.php" method="post">
        <div class="container">
            <div class="row d-flex justify-content-center">
                <div class="col-sm-6 ">
                    <h1>Share Youtube Movie</h1>
                    

                    
                    <label for="youtubeLink"><b>Youtube URL:</b></label>
                    <input class="form-control" type="text" id="youtubeLink" name="youtubeLink" required>

                    <hr class="mb-6">
                    <input class="btn btn-primary form-control" type="submit" id="btnShare" name="btnShare" value="Share">
                </div>
            </div>
        </div>   
    </form>


</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
<script>

    $(function(){

        $('#btnShare').click(function(e){
            var valid = this.form.checkValidity();
            if(valid){
                e.preventDefault();

                var youtubeLink   = $('#youtubeLink').val();
                if(matchYoutubeUrl(youtubeLink)){
                    $.ajax({
                        type: 'POST',
                        url:   'process.php',
                        dataType: 'json',
                        data: {youtubeLink:youtubeLink, shared:true},
                        success: function(data){

                            console.log(data)                        
                            if(data.type == 2){
                                Swal.fire({
                                    title: 'Done!',
                                    text: data.msg,
                                    type: 'success',
                                
                                });
                                $('#youtubeLink').val('');
                            }else{
                                Swal.fire({
                                    title: 'Failed!',
                                    text: data.msg,
                                    type: 'error',                            
                                });
                            }
                            
                        },
                        error: function(data){
                            Swal.fire({
                            title: 'Error!',
                            text: 'There were errors while saving the data...',
                            type: 'error'
                            
                            });
                        }
                    });
                }
                else{
                    console.log('false')
                    Swal.fire({
                        title: 'Error!',
                        text: 'Please enter your valid youtube link.',
                        type: 'error'                        
                    });
                }
                

            }
        })


        
    })
    function matchYoutubeUrl(url) {
        var p = /^(?:https?:\/\/)?(?:m\.|www\.)?(?:youtu\.be\/|youtube\.com\/(?:embed\/|v\/|watch\?v=|watch\?.+&v=))((\w|-){11})(?:\S+)?$/;
        if(url.match(p)){
            return url.match(p)[1];
        }
        return false;
    }
</script>    
</body>
</html>