<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Admin Dashboard</title>

  <!-- Custom fonts for this template-->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">


  <!-- <link href="/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css"> -->
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="/css/sb.min.css" rel="stylesheet">
  <link rel="stylesheet" type="" href="/mycss.css">
  

</head>

<body id="page-top">
  

  <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="/">
        <div class="sidebar-brand-icon">
          <i class="fas fa-university"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Result Management System </div>
      </a>

      <!-- Divider -->
      <hr class="sidebar-divider my-0">

      <!-- Nav Item - Dashboard -->
      <li class="nav-item">
        <a class="nav-link" href="/admin/departments">
          <i class="fas fa-fw fa-building"></i>
          <span>Departments</span></a>
      </li>
      <!-- Nav Item - Dashboard -->
      <li class="nav-item">
        <a class="nav-link" href="/admin/courses">
          <i class="fas fa-fw fa-book"></i>
          <span>Courses</span></a>
      </li>
      <!-- Nav Item - Dashboard -->
      <li class="nav-item">
        <a class="nav-link" href="/admin/students">
          <i class="fas fa-fw fa-user-graduate"></i>
          <span>Students</span></a>
      </li>
      <!-- Nav Item - Dashboard -->
      <li class="nav-item">
        <a class="nav-link" href="/admin/teachers">
          <i class="fas fa-fw fa-chalkboard-teacher"></i>
          <span>Teachers</span></a>
      </li> 
      <!-- Nav Item - Dashboard -->
      <li class="nav-item">
        <a class="nav-link" href="/admin/results">
          <i class="fas fa-fw fa-poll"></i>
          <span>Results</span></a>
      </li>  

      <!-- Divider -->
      <hr class="sidebar-divider">

  

      <!-- Sidebar Toggler (Sidebar) -->
      <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
      </div>

    </ul>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

        <!-- Topbar -->
        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

          <!-- Sidebar Toggle (Topbar) -->
          <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
            <i class="fa fa-bars"></i>
          </button>

          <h3>Admin Dashboard</h3>
          

          <!-- Topbar Navbar -->
          <ul class="navbar-nav ml-auto">

            <!-- Nav Item - Search Dropdown (Visible Only XS) -->
           
          
            <li class="nav-item active">
            <form method="post" action="/adminlogout">
              @csrf

              <button type="submit" class="btn btn-primary">Logout</button>
            </form>
          </li>
            <!-- <div class="topbar-divider d-none d-sm-block"></div> -->

             

          </ul>

        </nav>
        <!-- End of Topbar -->

        <!-- Begin Page Content -->
        <div class="container-fluid">




    <div class="container">
     
    <table class="table table-hover" id="example">
    <thead class="table-primary">
    <tr>
      <th scope="col">#</th>
      <th scope="col">Reg No</th>
      @foreach($courses as $course)
      <th scope="col">{{$course->code}}</th>
      @endforeach
      <th scope="col">Gpa</th>
    </tr>
  </thead>
  <tbody>
    <?php 
    $total = 0;
    $cnt = 0;
    $i = 1;
     ?>
      @foreach($arr as $a => $v)
      <tr>
        <td scope="col">{{$i++}}</td>
        <td scope="col">{{\App\Student::find($a)->reg_no}}</td>
        @foreach($courses as $course)
          @foreach($marks as $mark)
            @if($mark->student_id==$a && $mark->subject->course_id==$course->id)
            
            <td scope="col">{{$mark->gpa}}</td> 
            <?php $cnt++; $total+= $mark->gpa*$mark->subject->course->credit ?>

            @endif
          @endforeach
        @endforeach
        @foreach(\App\Cgpa::all() as $cgpa)
          @if($cgpa->student_id==$a && $cgpa->semester==$semester)
            <td scope="col">{{$cgpa->gpa}}</td>
          @endif
        @endforeach
        <?php 
          $total = 0;
          $cnt = 0;
          ?> 
        </tr>
      @endforeach
  </tbody>
</table>
    </div>




<p class="lead"> <button id="pdf" class="btn btn-danger">Download as PDF</button></p>


 


</div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->

      <!-- Footer -->
      <footer class="sticky-footer bg-white">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>©Department of Computer Science Sylhet Engineering College</span>
          </div>
        </div>
      </footer>
      <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  
  <!-- Bootstrap core JavaScript-->
  <script src="/vendor/jquery.min.js"></script>
  <script src="/vendor/b.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="/vendor/je.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="/js/sb.min.js"></script>



 <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.4.1/jspdf.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/2.3.5/jspdf.plugin.autotable.min.js"></script>

<script src="/tableHTMLExport.js"></script>
    <script>
 
  $('#pdf').on('click',function(){
    $("#example").tableHTMLExport({type:'pdf',filename:'sample.pdf'});
  })
  </script>
</body>

</html>
