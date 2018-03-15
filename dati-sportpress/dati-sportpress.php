
<?php
/*
Plugin Name: dati-sportpress
Description: Samuele Pasini e Giorgio Gandola hanno bestemmiato tanto
*/
/* Inserisci le tue funzioni personalizzate */
function connect_db(){
  require_once('settings.php');
  $conn = new mysqli($servername, $username, $password,"my_".$username);
  if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
   }
  return $conn;
}
function getpath_name(&$type)
{
  $path= ($_SERVER['REQUEST_URI']);
  if(strpos($path,"squadre"))
  {
    $squadra= str_replace("/squadre/","",$path);
    $type="squadra";
  }
  else
  {
    $squadra= str_replace("/calciatori/","",$path);
    $type="calciatori";
  }
  return $squadra;
}
function run_query(&$segnati,&$subiti,&$occasioni)
{
  $squadra=getpath_name($type);
  if($type=="squadra")
    $query="SELECT * FROM squadre WHERE nome='".$squadra."'";
  $conn=connect_db();
  $result=$conn->query($query);
  if ($result->num_rows > 0)
  {
    while($row = $result->fetch_assoc()) {
        $segnati=$row['segnati'];
        $subiti=$row['subiti'];
        $occasioni=$row['occasioni'];
    }
   } else {
    echo "-1";
   }
   $conn->close();
}

function print_squadra_form()
{
   $segnati;$subiti;$occasioni;
   run_query($segnati,$subiti,$occasioni);
   echo '
   <link href="./bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
   <link href="./stylesheets.css" rel="stylesheet" id="bootstrap-css">
   <script src="./jquery-1.11.1.min.js.trasferimento"></script>
   <link rel="stylesheet" href="./font-awesome.min.css">
       <section id="counter" class="counter">
             <div class="main_counter_area">
                 <div class="overlay p-y-3">
                     <div class="container">
                         <div class="row">
                             <div class="main_counter_content text-center white-text wow fadeInUp">
                                 <div class="col-md-3">
                                     <div class="single_counter p-y-2 m-t-1">
                                         <i class="m-b-1"><img src="https://i0.wp.com/guidafanta.altervista.org/wp-content/uploads/2017/07/goalfatti.png?zoom=1.25&fit=90%2C90"></i>
                                         <h2 class="statistic-counter">'.$segnati.'</h2>
                                         <p>Goal Segnati</p>
                                     </div>
                                 </div>
                                 <div class="col-md-3">
                                     <div class="single_counter p-y-2 m-t-1">
                                         <i class="m-b-1"><img src="https://i1.wp.com/guidafanta.altervista.org/wp-content/uploads/2017/07/goalsubiti.png?zoom=1.25&fit=90%2C90"></i>
                                         <h2 class="statistic-counter">'.$subiti.'</h2>
                                         <p>Goal Subiti</p>
                                     </div>
                                 </div>
                                 <div class="col-md-3">
                                     <div class="single_counter p-y-2 m-t-1">
                                         <i class="m-b-1"><img src="https://i1.wp.com/guidafanta.altervista.org/wp-content/uploads/2017/07/occasioni.png?zoom=1.25&fit=90%2C90"></i>
                                         <h2 class="statistic-counter">'.$occasioni.'</h2>
                                         <p>Occasioni Create</p>
                                     </div>
                                 </div>
                             </div>
                         </div>
                     </div>
                 </div>
             </div>
         </section>
 <script type="text/javascript" src="./jquery.waypoints.min.js.trasferimento"></script>
 <script type="text/javascript" src="./jquery.counterup.min.js.trasferimento"></script>
 <script type="text/javascript">
             jQuery(\'.statistic-counter\').counterUp({
                 delay: 4,
                 time: 2000
             });
  </script>';
}



//set shortcode for wordpress
add_shortcode('print_squadra_form','print_squadra_form');
/* Nulla sotto questa riga */
















?>
