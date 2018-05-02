<?php
/** @package    TASKTRACKER::Controller */

/** import supporting libraries */
require_once("AppBaseController.php");
require_once("Model/Task.php");

/**
 * TaskController is the controller class for the Task object.  The
 * controller is responsible for processing input from the user, reading/updating
 * the model as necessary and displaying the appropriate view.
 *
 * @package TASKTRACKER::Controller
 * @author ClassBuilder
 * @version 1.0
 */
class TaskController extends AppBaseController
{

	/**
	 * Override here for any controller-specific functionality
	 *
	 * @inheritdocs
	 */
	protected function Init()
	{
		parent::Init();

		// TODO: add controller-wide bootstrap code
		
		// TODO: if authentiation is required for this entire controller, for example:
		// $this->RequirePermission(ExampleUser::$PERMISSION_USER,'SecureExample.LoginForm');
	}

	/**
	 * Displays a list view of Task objects
	 */
	public function ListView()
	{
		$this->Render();
	}

	/**
	 * API Method queries for Task records and render as JSON
	 */
	public function Query()
	{
		try
		{
			$criteria = new TaskCriteria();
			
			// TODO: this will limit results based on all properties included in the filter list 
			$filter = RequestUtil::Get('filter');
			if ($filter) $criteria->AddFilter(
				new CriteriaFilter('Id,Project,Task,Hours,Startdate,Enddate,PkColumn'
				, '%'.$filter.'%')
			);

			// TODO: this is generic query filtering based only on criteria properties
			foreach (array_keys($_REQUEST) as $prop)
			{
				$prop_normal = ucfirst($prop);
				$prop_equals = $prop_normal.'_Equals';

				if (property_exists($criteria, $prop_normal))
				{
					$criteria->$prop_normal = RequestUtil::Get($prop);
				}
				elseif (property_exists($criteria, $prop_equals))
				{
					// this is a convenience so that the _Equals suffix is not needed
					$criteria->$prop_equals = RequestUtil::Get($prop);
				}
			}

			$output = new stdClass();

			// if a sort order was specified then specify in the criteria
 			$output->orderBy = RequestUtil::Get('orderBy');
 			$output->orderDesc = RequestUtil::Get('orderDesc') != '';
 			if ($output->orderBy) $criteria->SetOrder($output->orderBy, $output->orderDesc);

			$page = RequestUtil::Get('page');

			if ($page != '')
			{
				// if page is specified, use this instead (at the expense of one extra count query)
				$pagesize = $this->GetDefaultPageSize();

				$tasks = $this->Phreezer->Query('Task',$criteria)->GetDataPage($page, $pagesize);
				$output->rows = $tasks->ToObjectArray(true,$this->SimpleObjectParams());
				$output->totalResults = $tasks->TotalResults;
				$output->totalPages = $tasks->TotalPages;
				$output->pageSize = $tasks->PageSize;
				$output->currentPage = $tasks->CurrentPage;
			}
			else
			{
				// return all results
				$tasks = $this->Phreezer->Query('Task',$criteria);
				$output->rows = $tasks->ToObjectArray(true, $this->SimpleObjectParams());
				$output->totalResults = count($output->rows);
				$output->totalPages = 1;
				$output->pageSize = $output->totalResults;
				$output->currentPage = 1;
			}


			$this->RenderJSON($output, $this->JSONPCallback());
		}
		catch (Exception $ex)
		{
			$this->RenderExceptionJSON($ex);
		}
	}

	/**
	 * API Method retrieves a single Task record and render as JSON
	 */
	public function Read()
	{
		try
		{
			$pk = $this->GetRouter()->GetUrlParam('pkColumn');
			$task = $this->Phreezer->Get('Task',$pk);
			$this->RenderJSON($task, $this->JSONPCallback(), true, $this->SimpleObjectParams());
		}
		catch (Exception $ex)
		{
			$this->RenderExceptionJSON($ex);
		}
	}

	/**
	 * API Method inserts a new Task record and render response as JSON
	 */
	public function Create()
	{
		try
		{
						
			$json = json_decode(RequestUtil::GetBody());

			if (!$json)
			{
				throw new Exception('The request body does not contain valid JSON');
			}

			$task = new Task($this->Phreezer);

			// TODO: any fields that should not be inserted by the user should be commented out

			$task->Id = $this->SafeGetVal($json, 'id');
			$task->Project = $this->SafeGetVal($json, 'project');
			$task->Task = $this->SafeGetVal($json, 'task');
			$task->Hours = $this->SafeGetVal($json, 'hours');
			$task->Startdate = date('Y-m-d H:i:s',strtotime($this->SafeGetVal($json, 'startdate')));
			$task->Enddate = date('Y-m-d H:i:s',strtotime($this->SafeGetVal($json, 'enddate')));
			// this is an auto-increment.  uncomment if updating is allowed
			// $task->PkColumn = $this->SafeGetVal($json, 'pkColumn');


			$task->Validate();
			$errors = $task->GetValidationErrors();

			if (count($errors) > 0)
			{
				$this->RenderErrorJSON('Please check the form for errors',$errors);
			}
			else
			{
				$task->Save();
				$this->RenderJSON($task, $this->JSONPCallback(), true, $this->SimpleObjectParams());
			}

		}
		catch (Exception $ex)
		{
			$this->RenderExceptionJSON($ex);
		}
	}

	/**
	 * API Method updates an existing Task record and render response as JSON
	 */
	public function Update()
	{
		try
		{
						
			$json = json_decode(RequestUtil::GetBody());

			if (!$json)
			{
				throw new Exception('The request body does not contain valid JSON');
			}

			$pk = $this->GetRouter()->GetUrlParam('pkColumn');
			$task = $this->Phreezer->Get('Task',$pk);

			// TODO: any fields that should not be updated by the user should be commented out

			$task->Id = $this->SafeGetVal($json, 'id', $task->Id);
			$task->Project = $this->SafeGetVal($json, 'project', $task->Project);
			$task->Task = $this->SafeGetVal($json, 'task', $task->Task);
			$task->Hours = $this->SafeGetVal($json, 'hours', $task->Hours);
			$task->Startdate = date('Y-m-d H:i:s',strtotime($this->SafeGetVal($json, 'startdate', $task->Startdate)));
			$task->Enddate = date('Y-m-d H:i:s',strtotime($this->SafeGetVal($json, 'enddate', $task->Enddate)));
			// this is a primary key.  uncomment if updating is allowed
			// $task->PkColumn = $this->SafeGetVal($json, 'pkColumn', $task->PkColumn);


			$task->Validate();
			$errors = $task->GetValidationErrors();

			if (count($errors) > 0)
			{
				$this->RenderErrorJSON('Please check the form for errors',$errors);
			}
			else
			{
				$task->Save();
				$this->RenderJSON($task, $this->JSONPCallback(), true, $this->SimpleObjectParams());
			}


		}
		catch (Exception $ex)
		{


			$this->RenderExceptionJSON($ex);
		}
	}

	/**
	 * API Method deletes an existing Task record and render response as JSON
	 */
	public function Delete()
	{
		try
		{
						
			// TODO: if a soft delete is prefered, change this to update the deleted flag instead of hard-deleting

			$pk = $this->GetRouter()->GetUrlParam('pkColumn');
			$task = $this->Phreezer->Get('Task',$pk);

			$task->Delete();

			$output = new stdClass();

			$this->RenderJSON($output, $this->JSONPCallback());

		}
		catch (Exception $ex)
		{
			$this->RenderExceptionJSON($ex);
		}
	}
}

?>
