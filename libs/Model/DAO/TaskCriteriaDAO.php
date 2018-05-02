<?php
/** @package    Tasktracker::Model::DAO */

/** import supporting libraries */
require_once("verysimple/Phreeze/Criteria.php");

/**
 * TaskCriteria allows custom querying for the Task object.
 *
 * WARNING: THIS IS AN AUTO-GENERATED FILE
 *
 * This file should generally not be edited by hand except in special circumstances.
 * Add any custom business logic to the ModelCriteria class which is extended from this class.
 * Leaving this file alone will allow easy re-generation of all DAOs in the event of schema changes
 *
 * @inheritdocs
 * @package Tasktracker::Model::DAO
 * @author ClassBuilder
 * @version 1.0
 */
class TaskCriteriaDAO extends Criteria
{

	public $Id_Equals;
	public $Id_NotEquals;
	public $Id_IsLike;
	public $Id_IsNotLike;
	public $Id_BeginsWith;
	public $Id_EndsWith;
	public $Id_GreaterThan;
	public $Id_GreaterThanOrEqual;
	public $Id_LessThan;
	public $Id_LessThanOrEqual;
	public $Id_In;
	public $Id_IsNotEmpty;
	public $Id_IsEmpty;
	public $Id_BitwiseOr;
	public $Id_BitwiseAnd;
	public $Project_Equals;
	public $Project_NotEquals;
	public $Project_IsLike;
	public $Project_IsNotLike;
	public $Project_BeginsWith;
	public $Project_EndsWith;
	public $Project_GreaterThan;
	public $Project_GreaterThanOrEqual;
	public $Project_LessThan;
	public $Project_LessThanOrEqual;
	public $Project_In;
	public $Project_IsNotEmpty;
	public $Project_IsEmpty;
	public $Project_BitwiseOr;
	public $Project_BitwiseAnd;
	public $Task_Equals;
	public $Task_NotEquals;
	public $Task_IsLike;
	public $Task_IsNotLike;
	public $Task_BeginsWith;
	public $Task_EndsWith;
	public $Task_GreaterThan;
	public $Task_GreaterThanOrEqual;
	public $Task_LessThan;
	public $Task_LessThanOrEqual;
	public $Task_In;
	public $Task_IsNotEmpty;
	public $Task_IsEmpty;
	public $Task_BitwiseOr;
	public $Task_BitwiseAnd;
	public $Hours_Equals;
	public $Hours_NotEquals;
	public $Hours_IsLike;
	public $Hours_IsNotLike;
	public $Hours_BeginsWith;
	public $Hours_EndsWith;
	public $Hours_GreaterThan;
	public $Hours_GreaterThanOrEqual;
	public $Hours_LessThan;
	public $Hours_LessThanOrEqual;
	public $Hours_In;
	public $Hours_IsNotEmpty;
	public $Hours_IsEmpty;
	public $Hours_BitwiseOr;
	public $Hours_BitwiseAnd;
	public $Startdate_Equals;
	public $Startdate_NotEquals;
	public $Startdate_IsLike;
	public $Startdate_IsNotLike;
	public $Startdate_BeginsWith;
	public $Startdate_EndsWith;
	public $Startdate_GreaterThan;
	public $Startdate_GreaterThanOrEqual;
	public $Startdate_LessThan;
	public $Startdate_LessThanOrEqual;
	public $Startdate_In;
	public $Startdate_IsNotEmpty;
	public $Startdate_IsEmpty;
	public $Startdate_BitwiseOr;
	public $Startdate_BitwiseAnd;
	public $Enddate_Equals;
	public $Enddate_NotEquals;
	public $Enddate_IsLike;
	public $Enddate_IsNotLike;
	public $Enddate_BeginsWith;
	public $Enddate_EndsWith;
	public $Enddate_GreaterThan;
	public $Enddate_GreaterThanOrEqual;
	public $Enddate_LessThan;
	public $Enddate_LessThanOrEqual;
	public $Enddate_In;
	public $Enddate_IsNotEmpty;
	public $Enddate_IsEmpty;
	public $Enddate_BitwiseOr;
	public $Enddate_BitwiseAnd;
	public $PkColumn_Equals;
	public $PkColumn_NotEquals;
	public $PkColumn_IsLike;
	public $PkColumn_IsNotLike;
	public $PkColumn_BeginsWith;
	public $PkColumn_EndsWith;
	public $PkColumn_GreaterThan;
	public $PkColumn_GreaterThanOrEqual;
	public $PkColumn_LessThan;
	public $PkColumn_LessThanOrEqual;
	public $PkColumn_In;
	public $PkColumn_IsNotEmpty;
	public $PkColumn_IsEmpty;
	public $PkColumn_BitwiseOr;
	public $PkColumn_BitwiseAnd;

}

?>