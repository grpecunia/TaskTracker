<?php
/** @package    Tasktracker::Model::DAO */

/** import supporting libraries */
require_once("verysimple/Phreeze/IDaoMap.php");
require_once("verysimple/Phreeze/IDaoMap2.php");

/**
 * EmployeeMap is a static class with functions used to get FieldMap and KeyMap information that
 * is used by Phreeze to map the EmployeeDAO to the employees datastore.
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
class EmployeeMap implements IDaoMap, IDaoMap2
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
			self::$FM["Id"] = new FieldMap("Id","employees","id",false,FM_TYPE_VARCHAR,5,null,false);
			self::$FM["Fname"] = new FieldMap("Fname","employees","fname",false,FM_TYPE_VARCHAR,20,null,false);
			self::$FM["Lname"] = new FieldMap("Lname","employees","lname",false,FM_TYPE_VARCHAR,20,null,false);
			self::$FM["Email"] = new FieldMap("Email","employees","email",false,FM_TYPE_VARCHAR,35,null,false);
			self::$FM["PkColumn"] = new FieldMap("PkColumn","employees","pk_column",true,FM_TYPE_INT,11,null,true);
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