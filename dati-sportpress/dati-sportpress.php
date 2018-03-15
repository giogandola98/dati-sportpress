
<?php
/*
Plugin Name:  Dati-sportpress
Description:  Created by Giorgio Gandola and Samuele Pasini
Version:      1.0.2b1
Author:       Giorgio Gandola
License:      GPL2
License URI:  https://www.gnu.org/licenses/gpl-2.0.html
*/

//settings inclusion
require_once('settings.php');



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
              <i class="m-b-1"><img src="'.$imglink.'"></i>
              <h2 class="statistic-counter">'.$value.'</h2>
              <p class="my-counter">'.$description.'</p>
          </div>
      </div>';
}
function print_squadra_form()
{
   global $css_links,$js_links,$clubs_img;
   $segnati;$subiti;$occasioni;
   run_query($segnati,$subiti,$occasioni);
   load_css($css_links);
   load_js($js_links);
   echo '
       <section id="counter" class="counter">
             <div class="main_counter_area">
                 <div class="overlay p-y-3">
                     <div class="container">
                         <div class="row">
                         <div class="main_counter_content text-center white-text wow fadeInUp">';
                         print_r($clubs_img);
                         print_r($clubs_img["segnati"]);
                         echo 'ciao';
                         print_single_counter($segnati,"Goal Segnati",$clubs_img["segnati"]);
                         print_single_counter($segnati,"Goal Subiti",$clubs_img["subiti"]);
                         print_single_counter($segnati,"Occasioni",$clubs_img["occasioni"]);

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
