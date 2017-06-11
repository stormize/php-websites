<?php
error_reporting(E_ALL ^ E_NOTICE);

class searching 
{
	protected $graph;
	protected $visited = array();
	function __construct($graph)
	{
		$this->graph =$graph;
		
	}

	public function breedthfirst($origin,$destination){
		$mypath = array();
		$mypath['path']=array();

		foreach ($this->graph as $vertix => $vadj) {
			$visited[$vertix]=false;
		}
		$q =new SplQueue();
		$q->enqueue($origin);
		$this->visited[$origin]=true;
		$path = array();
		$path[$origin]= new SplDoublyLinkedList();
		$path[$origin]->setIteratorMode(
        SplDoublyLinkedList::IT_MODE_FIFO|SplDoublyLinkedList::IT_MODE_KEEP);
			
           $path[$origin]->push($origin);
           $found=false;
           while (!$q->isEmpty()&&$q->bottom()!=$destination) {
           	$t = $q->dequeue();
           	if(!empty($this->graph[$vertix])){
           	foreach ($this->graph[$t] as $vertix) {
           		if(!$this->visited[$vertix]){
           			$q->enqueue($vertix);          		
           		$this->visited[$vertix]=true;
           		$path[$vertix] = clone $path[$t];
           		$path[$vertix]->push($vertix);
           	}
           	}
           }}
           if(isset($path[$destination])){
          
           	$mypath['hops'] = count($path[$destination])-1;
           	
           	 foreach ($path[$destination] as $vertix) {
           	 	array_push($mypath['path'],$vertix);
           	 	
           	 }
           }
           else{
           	array_push($mypath, "no route");
           }
           return $mypath;
	}
}


?>