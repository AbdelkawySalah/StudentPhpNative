<!DoCTYPE html>
<html lang="en">
  <head>
     <title>تعديل</title>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width,initial-scale=1">
     <link href="css/style.css" rel="stylesheet">
     <style>
        body{
            background-color:white;
            font-family:'Arial','Tahoma';
        }
        #mother{
            width:100%;
            font-size:20px;
        }
      
      aside  input{
            padding:4px;
            border:2px solid black;
            border-radius:8px;
            text-align:center;
            font-size:16px;
            font-family:'Arial','Tahoma';
            width:400px;
            margin-bottom:2px;
        }
        aside{
            text-align:center;
            width:100%;
           border:1px solid black;
           padding:10px;
           font-size:20px;
           background-color:silver;
           color:blue;
        }

        /* التحكم في جدول */
       
       

      aside  button{
            width:100%;
            padding:9px;
            margin-top:6px;
            font-size:17px;
            font-family:'Arial','Tahoma';
            font-weight:bold;
        }
     </style>
  </head>
  <body dir="rtl"> 
     <br/>
     <?php
        $host='localhost';
        $user='root';
        $pass='';
        $db='studentnative';
        $con=mysqli_connect($host,$user,$pass,$db);
        $id=$_GET['id'];
        $sqla="select * from studentdata where id=$id";
        $res=mysqli_query($con,$sqla);
        if($row=mysqli_fetch_assoc($res))
            {
                
            }
        else{
            echo 'no data found';
            }

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
        //when click on update
        if(isset($_POST['updatestudent'])){
          $sqla="update  studentdata set name='$name' , address='$address' , email='$email' where id=$id";
          mysqli_query($con,$sqla);
          header("location: home.php");
        }
     ?>
     <div id="mother">
        <form  method='POST' autocomplete="off">
            <aside>
              
              <label>إسم الطالب</label><br/>
              <input type="text" name="studentname" id="studentname" requied value="<?php echo($row['name']) ?>"/><br/>
              <label>عنوان الطالب</label><br/>
              <input type="text" name="studentaddress" id="studentaddress"  value="<?php echo($row['address']) ?>"  /><br/>
              <label>ايميل الطالب</label><br/>
              <input type="text" name="email" id="email" value="<?php echo($row['email']) ?>"/><br/><br/>
              
              <button name="updatestudent">تحديث بيانات </button>
            </aside>
           
        </fom>
     </div>
  </body>
</html>