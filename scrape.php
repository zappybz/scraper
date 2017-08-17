 <pre>
<?php

require  'simple_html_dom.php';

$dbname = '';
$dbuser = '';
$dbpwd = '';

$conn = new mysqli('localhost', $dbuser, $dbpwd, $dbname);
if ($conn->connect_error) die("Connection failed: " . $conn->connect_error);
$conn->set_charset("utf8");

$result = $conn->query('SELECT * FROM doctors');   

if (mysqli_num_rows($result) > 0) {
    while ($row = $result->fetch_object()) { 
        $links[] = $row->link;
        $images2[$row->link] = $row->image;
    
        if ($row->image == '') echo "<a href='$row->link'>$row->link</a><br>";
    }
    
    
    //print_r($images2);
}

if ($html = file_get_html('')) {
    $i = 0;
    foreach($html->find('.view-content .views-field-title a') as $link_tag) {
        $link = $link_tag->href;
        $name = $link_tag->plaintext;
        var_dump($name);
        //if(!in_array($link, $links)) {    
            
            if ($doctor_page = file_get_html($link)) {
                if (strpos($link, '') !== false) {
                    //$name = trim(preg_replace('/\t+/', '', $doctor_page->find('.doctor h1', 0)->plaintext));  
                    
                    $position = $doctor_page->find('#credentials .positions li', 0)->innertext;
                    $positions = substr($position, 0, strpos($position, ","));
                    /*foreach($positions_scrape as $position) {
                        if (strpos($position->innertext, 'atholog') !== false) {
                            $positions .= '<li class="sitename">'.trim($position->innertext).'</li>';
                        }
                    }*/
                    //$image = $doctor_page->find('meta[property="twitter:image:src"]', 0)->value;
                    //$image = 'http://sites.org'.str_replace('-square', '-thumb', $image);
                    //if (getimagesize($image) === false) $image = '';
                    
                } 
                if (strpos($link, '') !== false) {
                    //var_dump($doctor_page);
                    //$name = $doctor_page->find('#left_column h1.title', 0)->plaintext; 
                    
                    $position = $doctor_page->find('p.education-section__heading', 0)->innertext;
                    $positions = substr($position, 0, strpos($position, ","));
                    /*foreach($positions_scrape as $position) {
                        if (strpos($position->innertext, 'atholog') !== false) {
                            $positions .= '<li class="sitename">'.trim($position->innertext).'</li>';
                        }
                    }*/
                    
                    /*$image = $doctor_page->find('#left_column img', 0)->src;
                    if (getimagesize($image) === false) $image = '';*/
                }
                
                //mysqli_query($conn, "INSERT INTO doctors (name,position,image,link,updated) VALUES ('$name', '$positions', '$image', '$link', '".time()."')") or die(mysqli_error($conn));
                
            }
        //}
        var_dump($positions);
        $i++ ;
        //if($i++ == 5) break;
    }

    
    //echo $i;
}


?>
</pre>