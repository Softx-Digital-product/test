<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.gstatic.com">
        <link rel="stylesheet" href="../assets12/css/sam.css">
          <link rel="stylesheet" href="../Timeline/timeline.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha512-SfTiTlX6kk+qitfevl/7LibUOeJWlt9rbyDn92a1DqWOw9vWG2MFoays0sgObmWazO5BQPiFucnnEAjpAB+/Sw==" crossorigin="anonymous" />

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    
    
    <title>Testing</title>
    <style>
     .block {
    z-index: 2;
    position: relative;
}
.drop{
    overflow: auto;
}
    </style>
  </head>
  <body>
  <?php include 'Innerheader.php';?>
        <div class="topnav1 p-0 ">
          <a class="nav_link  p-2  " href="../Task.php">View Tasks</a>
              <a class="nav_link ml-1 text-white p-2 "data-toggle="modal" data-target="#CreateTask" href="#" >Create  Task</a>
              <a class="nav_link ml-1 text-white p-2  active" href="KanBan.php" >Kan-Ban</a>
                <a class="nav_link ml-1 text-white p-2 " href="#" >Performance</a>
      </div>
      <div class="container-fluid">
          <div class="row">
              <div class="col-lg-6 ">
                  <div class="bg-danger p-2 block">
                     Task 1
                  </div>
                  <div class="bg-warning p-2 block">
                      Task 2
                  </div>
                  <div class="bg-success p-2 block">
                      Task 3
                  </div>
                   <div class="bg-info p-2 block">
                      Task 4
                  </div>
                  <div class="bg-secondary p-2 block">
                      Task 5
                  </div>
              </div>
              
              <div class="col-lg-6 bg-dark drop" >
                  
              </div>
          </div>
      </div>

   
      <script>
          $(".block").draggable();

$(".drop").droppable({
    accept:".block",
    drop:function (ev,ui){
        alert("Changed status");
    }
})
          </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>

  
  </body>
</html>