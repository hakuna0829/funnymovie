<?php

require_once('header.php');
require_once('process.php');

?>
<style>
.span4 img {
    margin-right: 10px;
}
.span4 .img-left {
    float: left;
}
.span4 .img-right {
    float: right;
}
.embed-responsive{
    margin-right: 10px;
    float: left;
}

.padding10{
    padding-top:10px;
    padding-bottom:10px;
}
</style>
<div>
    <div class="container-fluid" >
        <?php
        $movies = getAllMovies($conn);

        if( $movies == true){
            for($i = 0; $i<count($movies) ; $i++){
                // var_dump($movies["$i"]);
?>
        <div class="row d-flex justify-content-center padding10">
                    
                    <div class="col-sm-12 col-md-6 col-lg-4">
                        <div class="embed-responsive embed-responsive-16by9">
                            <iframe class="embed-responsive-item" src="<?php echo $movies["$i"]['move_link']?>" allowfullscreen></iframe>
                            
                        </div>                                
                    </div>
                    <div class="col-sm-12 col-md-6 col-lg-4">
                    <div class="movie-title"><h3>Movie Title</h3></div>
                        <div class="movie-author">
                            <h6>
                                Shared by: <?php echo $movies["$i"]['userEmail']?>
                                <?php
                                 if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
                                    ?>
                                    <img src="img/voteup.png" alt="">
                                    <img src="img/votedown.png" alt="">
                                    <span>(un-voted)</span>
                                    <?php
                                 }
                                ?>
                                
                            </h6> 
                            
                        </div>
                        <div class="movie-vote">
                            <span class="voteup"></span>35<a href='#'><img src="img/voteup.png" alt="" width=20></a>
                            <span class="voteup"></span>5<a href='#'><img src="img/votedown.png" alt="" width=20></a>
                        </div>
                        <div class="movie-description"><h6>Description: </h6> </div>
                        <p>
                            Donec id elit non mi porta gravida at eget metus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui.
                            Donec id elit non mi porta gravida at eget metus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui.
                            Donec id elit non mi porta gravida at eget metus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui.
                        </p>   
                    </div>                        
        
        </div>
        <div class="row d-flex justify-content-center">
            <div class="col-sm-12 col-md-12 col-lg-8">
                <hr>
            </div>
        </div>
       
<?php
            }            
        }else{
            echo "false";
        }
        ?>
        
            
    </div>   
   


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

        $('#btn_login').click(function(e){
            var valid = this.form.checkValidity();
            if(valid){
                e.preventDefault();

                var userEmail   = $('#loginEmail').val();
                var password    = $('#loginPassword').val();
               
                $.ajax({
                    type: 'POST',
                    url:   'process.php',
                    data: {userEmail:userEmail, password:password, signin:true},
                    success: function(data){

                        if(data == 'valid'){
                            Swal.fire({
                                title: 'Done!',
                                text: "Login succeed.",
                                type: 'success',
                            
                            });
                            window.setTimeout(function(){location.replace('index.php')},1000)
                        }else{
                            Swal.fire({
                                title: 'Failed!',
                                text: "Invalid User Account...",
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
        })


        
    })
   
</script>    
</body>
</html>