    <?php
    define("DB_HOST","localhost");
    define("DB_USER","root");
    define("DB_PASS","");
    define("DB_NAME","php_basic_blog");
    date_default_timezone_set("Asia/Rangoon");

    function dbConnect(){
      $dbConnect=mysqli_connect(DB_HOST,DB_USER,DB_PASS,DB_NAME);
      if(mysqli_connect_errno($dbConnect)==0){
          return $dbConnect;
      }else{
          echo "Database Connection Fail!";
      }
    };
    $db=dbConnect();

    function passGenerator($pass){
        $pass=md5($pass);
        $pass=sha1($pass);
        $pass=crypt($pass,$pass);
        return $pass;
    }
    function getMyDate(){
        return date("Y:m:d H:m:s",time());
    }









    function insertDatas($username,$email,$password){
        $db=dbConnect();
        $password=passGenerator($password);
        $curTime=getMyDate();
        $select="SELECT*FROM members WHERE email='$email'";
        $result=mysqli_query($db,$select);
        if(mysqli_num_rows($result)>0){
            return "Email is already in use!";
        }else{
            $qry="INSERT INTO members (name,email,password,created_at,updated_at) VALUES('$username','$email','$password','$curTime','$curTime')";
            $result=mysqli_query($db,$qry);
            if($result==1){
                return "Register Success";
            }else{
                return "Register Fail!";
            }
        }
    };

    function loginDbCheck($email,$password){
        $password=passGenerator($password);
        $qry="SELECT name FROM members WHERE email='$email' AND password='$password'";
        $result=mysqli_query(dbConnect(),$qry);
        if(mysqli_num_rows($result)>0){
            foreach($result as $item){
                return $item['name'];
            }
        }else{
            return "Login Fail!";
        }

    }



