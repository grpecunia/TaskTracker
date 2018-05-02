<?php
/** @package    Tasktracker::Model::DAO */

/** import supporting libraries */
require_once("verysimple/Phreeze/IDaoMap.php");
require_once("verysimple/Phreeze/IDaoMap2.php");

/**
 * TaskMap is a static class with functions used to get FieldMap and KeyMap information that
 * is used by Phreeze to map the TaskDAO to the tasks datastore.
 *
 * WARNING: THIS IS AN AUTO-GENERATED FILE
 *
 * This file should generally not be edited by hand except in special circumstances.
 * You can override the default fetching strategies for KeyMaps in _config.php.
 * Leaving this file alone will allow easy re-generation of all DAOs in the event of schema changes
 *
 * @package Tasktracker::Model::DAO
 * @author ClassBuilder
 * @version 1.0
 */
class TaskMap implements IDaoMap, IDaoMap2
{

	private static $KM;
	private static $FM;
	
	/**
	 * {@inheritdoc}
	 */
	public static function AddMap($property,FieldMap $map)
	{
		self::GetFieldMaps();
		self::$FM[$property] = $map;
	}
	
	/**
	 * {@inheritdoc}
	 */
	public static function SetFetchingStrategy($property,$loadType)
	{
		self::GetKeyMaps();
		self::$KM[$property]->LoadType = $loadType;
	}

	/**
	 * {@inheritdoc}
	 */
	public static function GetFieldMaps()
	{
		if (self::$FM == null)
		{
			self::$FM = Array();
			self::$FM["Id"] = new FieldMap("Id","tasks","id",false,FM_TYPE_VARCHAR,5,null,false);
			self::$FM["Project"] = new FieldMap("Project","tasks","project",false,FM_TYPE_VARCHAR,20,null,false);
			self::$FM["Task"] = new FieldMap("Task","tasks","task",false,FM_TYPE_VARCHAR,100,null,false);
			self::$FM["Hours"] = new FieldMap("Hours","tasks","hours",false,FM_TYPE_VARCHAR,2,null,false);
			self::$FM["Startdate"] = new FieldMap("Startdate","tasks","startdate",false,FM_TYPE_DATE,null,null,false);
			self::$FM["Enddate"] = new FieldMap("Enddate","tasks","enddate",false,FM_TYPE_DATE,null,null,false);
			self::$FM["PkColumn"] = new FieldMap("PkColumn","tasks","pk_column",true,FM_TYPE_INT,11,null,true);
		}
		return self::$FM;
	}

	/**
	 * {@inheritdoc}
	 */
	public static function GetKeyMaps()
	{
		if (self::$KM == null)
		{
			self::$KM = Array();
		}
		return self::$KM;
	}

}

?>