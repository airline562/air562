<?php
 mysql_connect("localhost","root","");
 mysql_select_db("php_autocomplete");
 
 $term=$_GET["term"];
 
 $query=mysql_query("SELECT * FROM country where name like '%".$term."%' order by name ");
 $json=array();
 
    while($country=mysql_fetch_array($query)){
         $json[]=array(
                    'value'=> $country["name"],
                    'label'=>$country["name"]
                        );
    }
 
 echo json_encode($json);
 
?>