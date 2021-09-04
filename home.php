<!DoCTYPE html>
<html lang="en">
  <head>
     <title>لوحة التحكم</title>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width,initial-scale=1">
     <style>
        body{
            background-color:white;
            font-family:'Arial','Tahoma';
        }
        #mother{
            width:100%;
            font-size:20px;
        }
        main{
            float:left;
            border:1px solid gray;
            padding:5px;
        }
      aside  input{
            padding:4px;
            border:2px solid black;
            border-radius:8px;
            text-align:center;
            font-size:16px;
            font-family:'Arial','Tahoma';
            width:200px;
            margin-bottom:2px;
        }
        aside{
            text-align:center;
            width:300px;
            float:right;
           border:1px solid black;
           padding:10px;
           font-size:20px;
           background-color:silver;
           color:blue;
        }

        /* التحكم في جدول */
        #table1{
            width:900px;
            font-size:20px;
            text-align:center;
        }
        #table1:hover{
           background-color:white;
        }
        #table1 th{
            background:silver;
            color:white;
            font-size:20px;
            padding:10px;
        }
        img{
            width:200px;
            height:200px;
            border-radius:40px;
        }

      aside  button{
            width:200px;
            padding:9px;
            margin-top:6px;
            font-size:17px;
            font-family:'Arial','Tahoma';
            font-weight:bold;
        }
     </style>
  </head>
  <body dir="rtl"> 
    <?php
    Session_start();
    if(empty($_SESSION['userdata'])){
        header("location: login.php");
    }
   
    // كود الاتصال بقاعدة البيانات
      $host='localhost';
      $user='root';
      $pass='';
      $db='studentnative';
      $con=mysqli_connect($host,$user,$pass,$db);
      $res=mysqli_query($con,"select * from studentdata");
    //define varaibles for pass data
    $name='';
    $address='';
    $email='';
    if(isset($_POST['studentname'])){
        $name=$_POST['studentname'];
    }
    if(isset($_POST['studentaddress'])){
        $address=$_POST['studentaddress'];
    }
    if(isset($_POST['email'])){
        $email=$_POST['email'];
    }
   
    //زر الاضافة
    $sqlstat='';
    if(isset($_POST['addstudent'])){
     $sqlstat="insert into studentdata(name,address,email) values('$name','$address','$email')";
     mysqli_query($con,$sqlstat);
     header("location: home.php");
    }

    //زر الحذف
    if(isset($_POST['deletestudent'])){
        $sqlstat="delete from studentdata where name='$name'";
        mysqli_query($con,$sqlstat);
        header("location:home.php");
    }

     //زر البحث
     if(isset($_POST['searchstudent'])){
        $sqlstat="select * from studentdata where name='$name'";
        $res=mysqli_query($con,$sqlstat);
        if(!$row=mysqli_fetch_assoc($res))
            {
                echo 'no data found';
                header("location:home.php");
            }
        else{
            'studentname'->$row['name']; 
            // $_POST['studentaddress']=$row['address']; 
            // $_POST['email']=$row['email']; 
            header("location:edit.php?id=".$row['id']);
            }
    
    }
   ?>
     <div id="mother">
        <form  method='POST' autocomplete="off">
            <aside>
               <div id="side">
                   <img src='images/user.png' alt="logopage" title="Dashboard"/>
                   <h3> لوحة التحكم بالطلاب</h3>
               </div>
              <br/>
              <label>إسم الطالب</label><br/>
              <input type="text" name="studentname" id="studentname" required/><br/>
              <label>عنوان الطالب</label><br/>
              <input type="text" name="studentaddress" id="studentaddress"  /><br/>
              <label>ايميل الطالب</label><br/>
              <input type="text" name="email" id="email" /><br/><br/>
              <button name="addstudent">اضافة طالب</button>
              <button name="deletestudent">حذف طالب</button>
              <hr>
              <button name="searchstudent">بحث عن طالب</button>
            </aside>
            <main>
               <table id="table1">
                   <tr>
                     <th>إسم الطالب</th>
                     <th>عنوان الطالب</th>
                     <th>ايميل الطالب</th>
                   </tr>
                   <?php
                     while($row = mysqli_fetch_array($res)){
                         echo "<tr>";
                         echo "<td>".$row['name']."</td>";
                         echo "<td>".$row['address']."</td>";
                         echo "<td>".$row['email']."</td>";
                         echo "</tr>";
                     }

                   ?>
               </table>
            </main>
        </fom>
     </div>
  </body>
</html>