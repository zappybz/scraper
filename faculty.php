<style>
    .wrapper {
        //width: 750px;
    }
    .item {
        display: inline-block; 
        width: 200px;
        margin: 20px;
        vertical-align: top;
    }

</style>


<?php

$dbname = '';
$dbuser = '';
$dbpwd = '';

$conn = new mysqli('localhost', $dbuser, $dbpwd, $dbname);
if ($conn->connect_error) die("Connection failed: " . $conn->connect_error);
$conn->set_charset("utf8");

if(isset($_GET['name'])) {
    
    $result = $conn->query('SELECT * FROM doctors WHERE name = '.$_GET['name']); 
    
    if (mysqli_num_rows($result)) {
        $output = '';
        while ($row = $result->fetch_object()) { 
            $output .= $row->position;
        }
        echo $output;
    }
    
    
} else {
    
    $result = $conn->query('SELECT * FROM doctors');  

    if (mysqli_num_rows($result)) {

        $output = '<div class="wrapper">';
        while ($row = $result->fetch_object()) { 
           
            $output .= '<div class="link-wrapper"><a href="'.$row->link.'">'.$row->name.'</a></div>';
            $output .= '<div class="positions-wrapper"><ul>'.$row->position.'</ul></div>';
            //$output .= '</div>';
        }
        $output .= '</div>';
        echo $output;

    }
}