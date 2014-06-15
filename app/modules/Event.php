<?php

class Event {
	
	private $event_map = array(
		'USER_REGISTER'=>null,
		'PROFILE_UPDATE_PHOTO'=>"SELECT sex FROM account WHERE id=:id",
		'ARTICLE_CREATED'=>"SELECT title FROM article WHERE id=:id",
		'FORUM_THREAD_CREATED'=>"SELECT title FROM forumthread WHERE id=:id",
		'COMMENTED_FORUM'=>"SELECT title FROM forumthread WHERE id=:id",
		'MEETING_CREATED'=>"SELECT datetime,agenda FROM meeting WHERE id=:id",
		'COMMENTED_ARTICLE'=>"SELECT title FROM article WHERE id=:id",
		'MEETING_UPDATED'=>"SELECT agenda FROM meeting WHERE id=:id"
	);
	
    public static function trigger($event_name, $source, $target, $description = null) {

        $event = R::dispense('event');

        $event->name = $event_name;
        $event->source = $source;
        $event->target = $target;
        $event->description = $description;
        $event->timestamp = time();
		
		if(!$event->target) $event->target = $event->source;

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
	
	public function fetchPresentableGlobalEvents($limit = 100) {
		
		$query = "SELECT account.id AS acc_no,`event`.id AS event_id,photo_id,full_name,`name` AS event_name,target,`timestamp`,
			(CASE photo_id WHEN NULL THEN NULL ELSE (SELECT thumbnail FROM photo WHERE photo.id=account.photo_id) END) AS thumbnail,
			(CASE photo_id WHEN NULL THEN NULL ELSE (SELECT mime FROM photo WHERE photo.id=account.photo_id) END) AS mime  
			FROM account INNER JOIN `event`
			ON `event`.source=account.id
			ORDER BY `timestamp` DESC";
		
		$results = R::getAll($query);
		
		$feed_data = array();
		
		foreach($results as $result) {
			$query = $this->event_map[$result['event_name']];
			if($query) {
				$row = R::getAssocRow($query, array(':id'=>$result['target']));
				array_push($feed_data, array_merge($result, $row[0]));
			} else {
				array_push($feed_data, $result);
			}
		}
		
		return $feed_data;
	}

}

?>