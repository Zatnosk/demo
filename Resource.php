<?php

class Resource {
	private $id,
	        $identity_id,
	        $created_at,
	        $current_version,
	        $resource_type,
	        $data;

	private function __construct($identity, $type, $content, $content_type){
		$this->generate_id();
		$this->identity_id = $identity;
		$this->created_at = (new DateTime())->format('c');
		$this->current_version = 1;
		$this->resource_type = $type;
		$this->data = [
			1 => 
		];
	}

	private function generate_id(){
		$this->id = 'dc33ba9b-5efe-4754-b2df-4b592d68edd5';
	}

	public static function create($identity_id, $resource_type, $content){
		return new Resource($identity_id, $resource_type, $content, 'text');
	}

	public static function create_url($resource_type, $content_url){
		return new Resource($identity_id, $resource_type, $content_url, 'url');
	}

	public static function create_binary($resource_type, $content_binary){
		return new Resource($identity_id, $resource_type, $content_binary, 'binary');
	}
}

?>