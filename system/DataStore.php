<?php

class DataStore {
	
	private static $connection;
	
	private static $metaObjects;
	
	public static function init() {
		
		self::connectToDatabase();
		
	}
	
	private static function connectToDatabase() {
		
		$db_host=Registry::lookupConfig('database_host');
		$db_port=Registry::lookupConfig('database_port');
		$db_name=Registry::lookupConfig('database_name');
		$db_user=Registry::lookupConfig('database_username');
		$db_pass=Registry::lookupConfig('database_password');
		
		self::$connection=mysql_connect($db_host.':'.$db_port,$db_user,$db_pass);
		
		mysql_select_db($db_name,self::$connection);
	} 
	
	private static function disconnectFromDatabase() {
		
		if(self::$connection) mysql_close(self::$connection);
		
	}
	
	/**
	 * Persists a single object to the database.
	 */
	public static function persist_object($object,$update=false) {
	
		$metaObjects=self::$metaObjects;
		
		$class=strtolower(get_class($object));
		
		$values=array();
		$var_names=array_keys(get_class_vars($class));
		foreach($var_names as $v) array_push($values,sprintf("'%s'",$object->$v));
		
		if(!self::$connection) self::connectToDatabase();
		
		if(!in_array($class,array_keys($metaObjects))) {
			$globalKey=$object->getGlobalKey();
			$objKey=$object->getKeyName();
			
			if($update) {
				if($globalKey) {
					$pairs=array();
					for($i=0;$i<count($var_names);$i++) array_push($pairs,sprintf("%s=%s",$var_names[$i],$values[$i]));
					$query=sprintf("update `%s` set %s where globalkey=%s",$class,implode(',',$pairs),$globalKey);
					mysql_query($query,self::$connection);
				} else {
					mysql_query(sprintf("delete from `%s` where %s='%s'",$class,$objKey,$object->$objKey),self::$connection);
					mysql_query(sprintf("delete from global where object='%s' and okey='%s'",$class,$objKey),self::$connection);
				}
			} else {
				if($objKey) $okey=$object->$objKey;
				else $okey='';
				mysql_query(sprintf("insert into global (object,okey) values ('%s','%s')",$class,$okey),self::$connection);
				$object->setGlobalKey(mysql_insert_id());
				array_push($values,$object->getGlobalKey());
				array_push($var_names,'globalkey');
				$query=sprintf("insert into `%s` (%s) values (%s)",$class,implode(',',$var_names),implode(',',$values));
				mysql_query($query,self::$connection);
				$globalKey=$object->getGlobalKey();
				if(!$objKey) mysql_query(sprintf("update global set okey=%s where gkey=%s",$globalKey,$globalKey),self::$connection);
			}
			
			return $globalKey;
		} else {
			if($update) {
				$pairs=array();
				for($i=0;$i<count($var_names);$i++) array_push($pairs,sprintf("%s=%s",$var_names[$i],$values[$i]));
				$query=sprintf("update `%s` set %s where %s",$metaObjects[$class],implode(',',$pairs),true);
			} else {
				$query=sprintf("insert into `%s` (%s) values (%s)",$metaObjects[$class],implode(',',$var_names),implode(',',$values));
				mysql_query($query,self::$connection);
			}
			return true;
		}
	}
	
	/**
	 * Restores a single object from the database.
	 */
	public static function restore_object($key,$class) {
		
		if(!self::$connection) self::connectToDatabase();
		
		$object=new $class();
		$objKey=$object->getKeyName();
		
		$query=sprintf("select * from `%s` where %s='%s'",strtolower($class),$objKey,$key);
		$p=mysql_query($query,self::$connection);
		$set=mysql_fetch_assoc($p);
		if(!$set) return null;
		
		$object->setGlobalKey($set['globalkey']);
		$var_names=array_keys(get_class_vars($class));
		foreach($var_names as $v) $object->$v=$set[strtolower($v)];
		
		return $object;
	}
	
	/**
	 * Restores a collection of objects from a single relation.
	 */
	public static function restore_collection($class,$criterion=null,$limit=100) {
	
		$metaObjects=self::$metaObjects;
		
		if(!self::$connection) self::connectToDatabase();
		
		$meta=false;
		
		if(array_key_exists(strtolower($class),$metaObjects)) {
			$meta=true;
			$relation=$metaObjects[strtolower($class)];
			if($criterion) $query=sprintf("select * from `%s` where %s limit %s",$relation,$criterion,$limit);
			else $query=sprintf("select * from `%s` limit %s",$relation,$limit);
		} else {
			$relation=strtolower($class);
			$okey=new $class();$okey=$okey->getKeyName();
			if($criterion) $query=sprintf("select * from `%s` inner join global on okey=%s where %s limit %s",$relation,$okey,$criterion,$limit);
			else $query=sprintf("select * from `%s` inner join global on okey=%s limit %s",$relation,$okey,$limit);
		}
		
		$result_set=array();
		$p=mysql_query($query,self::$connection);
		if($p) while($record=mysql_fetch_assoc($p)) array_push($result_set,$record);
		
		$collection=array();
		$var_names=array_keys(get_class_vars($class));
		foreach($result_set as $r) {
			$object=new $class();
			if(!$meta) $object->setGlobalKey($r['gkey']);
			foreach($var_names as $v) $object->$v=$r[strtolower($v)];
			array_push($collection,$object);
		}
		
		return $collection;
	}
	
	/**
	 * Restores a collection of a set of objects from multiple relations.
	 * Basically performs a join operationon database relations.
	 */
	public static function restore_composite_collection($classes,$glue,$criterion=null,$limit=100) {
	
		$metaObjects=self::$metaObjects;
		
		if(!self::$connection) self::connectToDatabase();
		
		$relations=array();
		foreach($classes as $c) {
			if(array_key_exists(strtolower($c),$metaObjects)) array_push($relations,'`'.$metaObjects[strtolower($c)].'`');
			else array_push($relations,'`'.strtolower($c).'`');
		}
		
		$joined_classes=implode(' inner join ',$relations);
		if(!$criterion) $criterion='true';
		
		$attributes=array();
		foreach($classes as $c) {
			$vars=array_keys(get_class_vars($c));
			if(array_key_exists(strtolower($c),$metaObjects)) {
				foreach($vars as $v) array_push($attributes,sprintf("%s as '%s'",'`'.$metaObjects[strtolower($c)].'`.'.strtolower($v),$metaObjects[strtolower($c)].'.'.strtolower($v)));
			} else {
				foreach($vars as $v) array_push($attributes,sprintf("%s as '%s'",'`'.strtolower($c).'`.'.strtolower($v),strtolower($c).'.'.strtolower($v)));
				array_push($attributes,sprintf("%s as '%s'",'`'.strtolower($c).'`.globalkey',strtolower($c).'.globalkey'));
			}
		}
		$attributes=implode(',',$attributes);
		
		$objects=array();
		$query=sprintf("select %s from %s on %s where %s limit %s",$attributes,$joined_classes,$glue,$criterion,$limit);
		$p=mysql_query($query,self::$connection);
		while($record=mysql_fetch_assoc($p)) {
			$object_set=array();
			foreach($classes as $c) {
				$object=new $c();
				$var_names=array_keys(get_class_vars($c));
				if(array_key_exists(strtolower($c),$metaObjects)) {
					foreach($var_names as $v) $object->$v=$record[$metaObjects[strtolower($c)].'.'.strtolower($v)];
				} else {
					foreach($var_names as $v) $object->$v=$record[strtolower($c).'.'.strtolower($v)];
					$object->setGlobalKey($record[strtolower($c).'.globalkey']);
				}
				$object_set[strtolower($c)]=$object;
			}
			array_push($objects,$object_set);
		}
		
		return $objects;
	}
	
}

?>
