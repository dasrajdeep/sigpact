<?php

class Event {

    public static function trigger($event_name, $source, $target, $description = null) {

        $event = R::dispense('event');

        $event->name = $event_name;
        $event->source = $source;
        $event->target = $target;
        $event->description = $description;
        $event->timestamp = time();

        return R::store($event);
    }

    public function fetchAllEvents($context, $limit = 100) {

        $all = array();

        $from = R::find('event', 'source=:source LIMIT :limit', array(':source' => $context, ':limit' => $limit));

        $all = array_merge($all, $from);

        $to = R::find('event', 'target=:target LIMIT :limit', array(':target' => $context, ':limit' => $limit));

        $all = array_merge($all, $to);

        return $all;
    }
	
	public function fetchGlobalEvents($limit = 100) {

        $all = R::find('event', 'LIMIT :limit', array(':limit' => $limit));

        return $all;
    }
	
	public function fetchPresentableGlobalEvents($limit = 100) {
		
		
		$query = "SELECT account.id AS acc_no,`event`.id AS event_id,photo_id,full_name,`name` AS event_name,`timestamp`,mime,standard,thumbnail 
			FROM account INNER JOIN `event` INNER JOIN photo 
			ON `event`.source=account.id AND account.photo_id=photo.id
			ORDER BY `timestamp` DESC";
		
		$results = R::getAll($query);
		
		return $results;
	}

}

?>