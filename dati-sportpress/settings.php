<?php
//sql server settings
$servername = "localhost";
$username = "guidafanta";
$password = "merdine98";
$EXTERNAL_ASSETS_DIR='';

//external js and css links path
$js_links=array('jquery-1.11.1.min.js.trasferimento','jquery.waypoints.min.js.trasferimento','jquery.counterup.min.js.trasferimento');
$css_link=array('./bootstrap.min.css','stylesheets.css','font-awesome.min.css');

//player images vector
$clubs_img= array(
  'segnati'=>'https://i0.wp.com/guidafanta.altervista.org/wp-content/uploads/2017/07/goalfatti.png?zoom=1.25&fit=90%2C90',
  'subiti' =>'https://i1.wp.com/guidafanta.altervista.org/wp-content/uploads/2017/07/goalsubiti.png?zoom=1.25&fit=90%2C90',
'occasioni'=>'https://i1.wp.com/guidafanta.altervista.org/wp-content/uploads/2017/07/occasioni.png?zoom=1.25&fit=90%2C90'
 );


//some default function to have
function load_css($css_links)
{
  for($i=0;$i<$css_link.length())
  {
    echo '<link href="'.$EXTERNAL_ASSETS_DIR.'/'.$x.'" rel="stylesheet">';
  }
}

function load_js($js_links)
{
  foreach($css_links as $x)
  {
    echo '<script src="'.$EXTERNAL_ASSETS_DIR.'/'.$x.'"></script>';
  }
}

function connect_db(){
  $conn = new mysqli($servername, $username, $password,"my_".$username);
  if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
   }
  return $conn;
}

?>
