<?php
//sql server settings
define("USERNAME", "guidafanta");
define("SERVERNAME", "localhost");
define("PASSWORD", "merdine98");

//external js and css links path

 $js_links=array('jquery-1.11.1.min.js.trasferimento','jquery.waypoints.min.js.trasferimento','jquery.counterup.min.js.trasferimento');
 $css_links=array('./bootstrap.min.css','stylesheets.css','font-awesome.min.css');

//player images vector
 $clubs_img= array(
  'segnati'=>'https://i0.wp.com/guidafanta.altervista.org/wp-content/uploads/2017/07/goalfatti.png?zoom=1.25&fit=90%2C90',
  'subiti' =>'https://i1.wp.com/guidafanta.altervista.org/wp-content/uploads/2017/07/goalsubiti.png?zoom=1.25&fit=90%2C90',
'occasioni'=>'https://i1.wp.com/guidafanta.altervista.org/wp-content/uploads/2017/07/occasioni.png?zoom=1.25&fit=90%2C90'
 );


//some default functions
function load_css($css_links)
{
  foreach ($css_links as $i => $value)
  {
    echo '<link href="'.plugins_url('dati-sportpress/include').'/'.$css_links[$i].'" rel="stylesheet">';
  }
}

function load_js($js_links)
{
  for($i=0;$i<count($js_links);$i++)
  {
    echo '<script src="'.plugins_url('dati-sportpress/include').'/'.$js_links[$i].'"></script>';
  }
}

//connect db function
function connect_db(){
  $conn = new mysqli(SERVERNAME, USERNAME, PASSWORD,"my_".USERNAME);
  if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
   }
  return $conn;
}

?>
