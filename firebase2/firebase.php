<?php
$header = ("Content-Type: text/html; charset=UTF-8");


class getdata{

	public function getJson($link){
$ch = curl_init();
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_URL, $link);
$result = curl_exec($ch);
curl_close($ch);


$obj = json_decode($result);

	
$arrayName = (array) $obj;
$arrayName = get_object_vars($obj);
$final = array();
foreach ($arrayName as $key => $value) {
	if(isset($arrayName[$key]->to)&&isset($arrayName[$key]->from)){
          if(!$final[$arrayName[$key]->from])
         $final[$arrayName[$key]->from] =array();

         array_push($final[$arrayName[$key]->from], $arrayName[$key]->to);
    }
}

	return $final;


}
public function formGraph(){
	$edges = array();
	$edges = $this->getJson("https://transportation-dd94f.firebaseio.com/edges.json");
	return $edges;
}
}

?>
