
<?php
/*
Plugin Name: dati-sportpress
Description: Created by Giorgio Gandola and Samuele Pasini
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

function print_single_counter($value,$description,$imglink)
{
  echo '
      <div class="col-md-3">
          <div class="single_counter p-y-2 m-t-1">
              <i class="m-b-1">'.$imglink.'<img src=""></i>
              <h2 class="statistic-counter">'.$value.'</h2>
              <p>'.$description.'</p>
          </div>
      </div>';
}
function print_squadra_form()
{
   $segnati;$subiti;$occasioni;
   run_query($segnati,$subiti,$occasioni);
   load_css();
   load_js();
   echo '
       <section id="counter" class="counter">
             <div class="main_counter_area">
                 <div class="overlay p-y-3">
                     <div class="container">
                         <div class="row">
                         <div class="main_counter_content text-center white-text wow fadeInUp">';
                         print_single_counter($segnati,"Goal Segnati",$clubs_img['segnati']);
                         print_single_counter($segnati,"Goal Subiti",$clubs_img['subiti']);
                         print_single_counter($segnati,"Occasioni",$clubs_img['occasioni']);

echo'
                                 </div>
                             </div>
                         </div>
                     </div>
                 </div>
             </div>
         </section>

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
