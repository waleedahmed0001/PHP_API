<?php
$action = $_SERVER["REQUEST_URI"];
$country = explode('/',$action);
$json_data = file_get_contents("data.json");
$updated_country = ucwords($_GET["country"]);
$returning_data = array();
function get_json(){
	global $json_data;
	return json_decode($json_data,true);
}


$decoded_jsons = get_json();

function add_json($json): array
{        global $returning_data;
    
    return $returning_data[] = $json;
}


if ($action == "/") {
    echo "null";
}

elseif(isset($_GET['sort']) or isset($_GET['country']) or isset($_GET['matches-lost']) or isset($_GET['matches-won']) or isset($_GET['team-matches-played']) or isset($_GET['team-matches-played(gte)'] ) or isset($_GET['team-matches-played(lte)'] ) or isset($_GET['matches-won(gte)'] ) or isset($_GET['matches-won(lte)'] ) or isset($_GET['matches-lost(gte)'] ) or isset($_GET['matches-lost(lte)'] ))
{
    if(isset($_GET['sort'])){
        if($_GET["sort"] == "country"){
            usort($decoded_jsons, function ($a, $b){
                return strcmp($a['country'],$b['country']);
            });
        }
        elseif ($_GET["sort"] == "team-matches-played"){
            usort($decoded_jsons,function ($a,$b){
                return $a["team-matches-played"] <=> $b["team-matches-played"];
            });
    
        }
        elseif ($_GET["sort"] == "matches-won"){
            usort($decoded_jsons,function ($a,$b){
                return $a["matches-won"] <=> $b["matches-won"];
            });
        }
        else{
            usort($decoded_jsons,function ($a,$b){
                return $a["matches-lost"] <=> $b["matches-lost"];
            });
        }
    
    }
$returning_data=$decoded_jsons;
    if(isset($_GET['country'])){
        $decoded_jsons=$returning_data;
        $data=array();
        $returning_data=array();
        $data=array();
        foreach ($decoded_jsons as $json) {
            if ($json["country"] == $updated_country) {
                add_json($json);
            }
        }
         
    }
    if (isset($_GET["team-matches-played"])){
        $decoded_jsons=$returning_data;
        $data=array();
        $returning_data=array();
        $data=array();
        foreach ($decoded_jsons as $json) {
            if ($json["team-matches-played"] == $_GET["team-matches-played"]) {
                add_json($json);				}
        }
    }

   

    if (isset($_GET['team-matches-played(gte)'])){
         $decoded_jsons=$returning_data;
         $data=array();
         $returning_data=array();
         $data=array();
         foreach ($decoded_jsons as $json) {
           if ($json["team-matches-played"] >= $_GET['team-matches-played(gte)']) {
               add_json($json);				}
       }
   }

   

   if (isset($_GET['team-matches-played(lte)'])){
     $decoded_jsons=$returning_data;
     $data=array();
     $returning_data=array();
     $data=array();
     foreach ($decoded_jsons as $json) {
       if ($json["team-matches-played"] <= $_GET['team-matches-played(lte)']) {
           add_json($json);				}
   }
}

    if (isset($_GET["matches-won"])){
        $decoded_jsons=$returning_data;
        $data=array();
        $returning_data=array();
        $data=array();
        foreach ($decoded_jsons as $json) {
            if ($json["matches-won"] == $_GET["matches-won"]) {
                add_json($json);				}
        }
    }

    if (isset($_GET['matches-won(gte)'])){
        $decoded_jsons=$returning_data;
        $data=array();
        $returning_data=array();
        $data=array();
        foreach ($decoded_jsons as $json) {
          if ($json["matches-won"] >= $_GET['matches-won(gte)']) {
              add_json($json);				}
      }
  }

  

  if (isset($_GET['matches-won(lte)'])){
    $decoded_jsons=$returning_data;
    $data=array();
    $returning_data=array();
    $data=array();
    foreach ($decoded_jsons as $json) {
      if ($json["matches-won"] <= $_GET['matches-won(lte)']) {
          add_json($json);				}
  }
}

    
    if (isset($_GET["matches-lost"])){
        $decoded_jsons=$returning_data;
        $data=array();
        $returning_data=array();
        $data=array();
        foreach ($decoded_jsons as $json) {
            if ($json["matches-lost"] == $_GET["matches-lost"]) {
                add_json($json);				}
        }
    }

    if (isset($_GET['matches-lost(gte)'])){
        $decoded_jsons=$returning_data;
        $data=array();
        $returning_data=array();
        $data=array();
        foreach ($decoded_jsons as $json) {
          if ($json["matches-lost"] >= $_GET['matches-lost(gte)']) {
              add_json($json);				}
      }
  }

  

  if (isset($_GET['matches-lost(lte)'])){
    $decoded_jsons=$returning_data;
    $data=array();
    $returning_data=array();
    $data=array();
    foreach ($decoded_jsons as $json) {
      if ($json["matches-lost"] <= $_GET['matches-lost(lte)']) {
          add_json($json);				}
  }
}

    
    
    echo json_encode($returning_data);

}






elseif ($country[count($country)-1] == "data") {
    echo json_encode($json_data);
} elseif (count($country) == 5) {
    $params = [];
    $Country = $country[4];
    print_r($country[4]);
    $Country = ucwords(str_replace("%20", " ", $Country));
    $decoded_jsons = json_decode($json_data, true);
    foreach ($decoded_jsons as $json) {
        if ($Country == $json["country"]) {
            add_json($json);	
        }
    }
    echo json_encode($returning_data);
} else {
    echo json_encode(null);
}



?>