<?php
/**
*qdPM
*
* NOTICE OF LICENSE
*
* This source file is subject to the Open Software License (OSL 3.0)
* that is bundled with this package in the file LICENSE.txt.
* It is also available through the world-wide-web at this URL:
* http://opensource.org/licenses/osl-3.0.php
* If you did not receive a copy of the license and are unable to
* obtain it through the world-wide-web, please send an email
* to license@qdPM.net so we can send you a copy immediately.
*
* DISCLAIMER
*
* Do not edit or add to this file if you wish to upgrade qdPM to newer
* versions in the future. If you wish to customize qdPM for your
* needs please refer to http://www.qdPM.net for more information.
*
* @copyright  Copyright (c) 2009  Sergey Kharchishin and Kym Romanets (http://www.qdpm.net)
* @license    http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
*/
?>
<?php
// Connection Component Binding
Doctrine_Manager::getInstance()->bindComponent('Tasks', 'doctrine');

/**
 * BaseTasks
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $id
 * @property integer $projects_id
 * @property integer $tasks_status_id
 * @property integer $tasks_priority_id
 * @property integer $tasks_type_id
 * @property integer $tasks_label_id
 * @property integer $tasks_groups_id
 * @property integer $projects_phases_id
 * @property integer $versions_id
 * @property integer $created_by
 * @property string $name
 * @property string $description
 * @property string $assigned_to
 * @property float $estimated_time
 * @property date $due_date
 * @property timestamp $created_at
 * @property integer $tickets_id
 * @property date $closed_date
 * @property integer $discussion_id
 * @property date $start_date
 * @property integer $progress
 * @property Projects $Projects
 * @property Tickets $Tickets
 * @property TasksStatus $TasksStatus
 * @property TasksPriority $TasksPriority
 * @property TasksTypes $TasksTypes
 * @property TasksLabels $TasksLabels
 * @property TasksGroups $TasksGroups
 * @property ProjectsPhases $ProjectsPhases
 * @property Versions $Versions
 * @property Users $Users
 * @property Doctrine_Collection $TasksComments
 * 
 * @method integer             getId()                 Returns the current record's "id" value
 * @method integer             getProjectsId()         Returns the current record's "projects_id" value
 * @method integer             getTasksStatusId()      Returns the current record's "tasks_status_id" value
 * @method integer             getTasksPriorityId()    Returns the current record's "tasks_priority_id" value
 * @method integer             getTasksTypeId()        Returns the current record's "tasks_type_id" value
 * @method integer             getTasksLabelId()       Returns the current record's "tasks_label_id" value
 * @method integer             getTasksGroupsId()      Returns the current record's "tasks_groups_id" value
 * @method integer             getProjectsPhasesId()   Returns the current record's "projects_phases_id" value
 * @method integer             getVersionsId()         Returns the current record's "versions_id" value
 * @method integer             getCreatedBy()          Returns the current record's "created_by" value
 * @method string              getName()               Returns the current record's "name" value
 * @method string              getDescription()        Returns the current record's "description" value
 * @method string              getAssignedTo()         Returns the current record's "assigned_to" value
 * @method float               getEstimatedTime()      Returns the current record's "estimated_time" value
 * @method date                getDueDate()            Returns the current record's "due_date" value
 * @method timestamp           getCreatedAt()          Returns the current record's "created_at" value
 * @method integer             getTicketsId()          Returns the current record's "tickets_id" value
 * @method date                getClosedDate()         Returns the current record's "closed_date" value
 * @method integer             getDiscussionId()       Returns the current record's "discussion_id" value
 * @method date                getStartDate()          Returns the current record's "start_date" value
 * @method integer             getProgress()           Returns the current record's "progress" value
 * @method Projects            getProjects()           Returns the current record's "Projects" value
 * @method Tickets             getTickets()            Returns the current record's "Tickets" value
 * @method TasksStatus         getTasksStatus()        Returns the current record's "TasksStatus" value
 * @method TasksPriority       getTasksPriority()      Returns the current record's "TasksPriority" value
 * @method TasksTypes          getTasksTypes()         Returns the current record's "TasksTypes" value
 * @method TasksLabels         getTasksLabels()        Returns the current record's "TasksLabels" value
 * @method TasksGroups         getTasksGroups()        Returns the current record's "TasksGroups" value
 * @method ProjectsPhases      getProjectsPhases()     Returns the current record's "ProjectsPhases" value
 * @method Versions            getVersions()           Returns the current record's "Versions" value
 * @method Users               getUsers()              Returns the current record's "Users" value
 * @method Doctrine_Collection getTasksComments()      Returns the current record's "TasksComments" collection
 * @method Tasks               setId()                 Sets the current record's "id" value
 * @method Tasks               setProjectsId()         Sets the current record's "projects_id" value
 * @method Tasks               setTasksStatusId()      Sets the current record's "tasks_status_id" value
 * @method Tasks               setTasksPriorityId()    Sets the current record's "tasks_priority_id" value
 * @method Tasks               setTasksTypeId()        Sets the current record's "tasks_type_id" value
 * @method Tasks               setTasksLabelId()       Sets the current record's "tasks_label_id" value
 * @method Tasks               setTasksGroupsId()      Sets the current record's "tasks_groups_id" value
 * @method Tasks               setProjectsPhasesId()   Sets the current record's "projects_phases_id" value
 * @method Tasks               setVersionsId()         Sets the current record's "versions_id" value
 * @method Tasks               setCreatedBy()          Sets the current record's "created_by" value
 * @method Tasks               setName()               Sets the current record's "name" value
 * @method Tasks               setDescription()        Sets the current record's "description" value
 * @method Tasks               setAssignedTo()         Sets the current record's "assigned_to" value
 * @method Tasks               setEstimatedTime()      Sets the current record's "estimated_time" value
 * @method Tasks               setDueDate()            Sets the current record's "due_date" value
 * @method Tasks               setCreatedAt()          Sets the current record's "created_at" value
 * @method Tasks               setTicketsId()          Sets the current record's "tickets_id" value
 * @method Tasks               setClosedDate()         Sets the current record's "closed_date" value
 * @method Tasks               setDiscussionId()       Sets the current record's "discussion_id" value
 * @method Tasks               setStartDate()          Sets the current record's "start_date" value
 * @method Tasks               setProgress()           Sets the current record's "progress" value
 * @method Tasks               setProjects()           Sets the current record's "Projects" value
 * @method Tasks               setTickets()            Sets the current record's "Tickets" value
 * @method Tasks               setTasksStatus()        Sets the current record's "TasksStatus" value
 * @method Tasks               setTasksPriority()      Sets the current record's "TasksPriority" value
 * @method Tasks               setTasksTypes()         Sets the current record's "TasksTypes" value
 * @method Tasks               setTasksLabels()        Sets the current record's "TasksLabels" value
 * @method Tasks               setTasksGroups()        Sets the current record's "TasksGroups" value
 * @method Tasks               setProjectsPhases()     Sets the current record's "ProjectsPhases" value
 * @method Tasks               setVersions()           Sets the current record's "Versions" value
 * @method Tasks               setUsers()              Sets the current record's "Users" value
 * @method Tasks               setTasksComments()      Sets the current record's "TasksComments" collection
 * 
 * @package    sf_sandbox
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseTasks extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('tasks');
        $this->hasColumn('id', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => true,
             'autoincrement' => true,
             'length' => 4,
             ));
        $this->hasColumn('projects_id', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'default' => '0',
             'notnull' => true,
             'autoincrement' => false,
             'length' => 4,
             ));
        $this->hasColumn('tasks_status_id', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             'length' => 4,
             ));
        $this->hasColumn('tasks_priority_id', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             'length' => 4,
             ));
        $this->hasColumn('tasks_type_id', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             'length' => 4,
             ));
        $this->hasColumn('tasks_label_id', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             'length' => 4,
             ));
        $this->hasColumn('tasks_groups_id', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             'length' => 4,
             ));
        $this->hasColumn('projects_phases_id', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             'length' => 4,
             ));
        $this->hasColumn('versions_id', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             'length' => 4,
             ));
        $this->hasColumn('created_by', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             'length' => 4,
             ));
        $this->hasColumn('name', 'string', 255, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'default' => '',
             'notnull' => true,
             'autoincrement' => false,
             'length' => 255,
             ));
        $this->hasColumn('description', 'string', null, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             'length' => '',
             ));
        $this->hasColumn('assigned_to', 'string', 255, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             'length' => 255,
             ));
        $this->hasColumn('estimated_time', 'float', null, array(
             'type' => 'float',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             'length' => '',
             ));
        $this->hasColumn('due_date', 'date', 25, array(
             'type' => 'date',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             'length' => 25,
             ));
        $this->hasColumn('created_at', 'timestamp', 25, array(
             'type' => 'timestamp',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             'length' => 25,
             ));
        $this->hasColumn('tickets_id', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             'length' => 4,
             ));
        $this->hasColumn('closed_date', 'date', 25, array(
             'type' => 'date',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             'length' => 25,
             ));
        $this->hasColumn('discussion_id', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             'length' => 4,
             ));
        $this->hasColumn('start_date', 'date', 25, array(
             'type' => 'date',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             'length' => 25,
             ));
        $this->hasColumn('progress', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             'length' => 4,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasOne('Projects', array(
             'local' => 'projects_id',
             'foreign' => 'id'));

        $this->hasOne('Tickets', array(
             'local' => 'tickets_id',
             'foreign' => 'id'));

        $this->hasOne('TasksStatus', array(
             'local' => 'tasks_status_id',
             'foreign' => 'id'));

        $this->hasOne('TasksPriority', array(
             'local' => 'tasks_priority_id',
             'foreign' => 'id'));

        $this->hasOne('TasksTypes', array(
             'local' => 'tasks_type_id',
             'foreign' => 'id'));

        $this->hasOne('TasksLabels', array(
             'local' => 'tasks_label_id',
             'foreign' => 'id'));

        $this->hasOne('TasksGroups', array(
             'local' => 'tasks_groups_id',
             'foreign' => 'id'));

        $this->hasOne('ProjectsPhases', array(
             'local' => 'projects_phases_id',
             'foreign' => 'id'));

        $this->hasOne('Versions', array(
             'local' => 'versions_id',
             'foreign' => 'id'));

        $this->hasOne('Users', array(
             'local' => 'created_by',
             'foreign' => 'id'));

        $this->hasMany('TasksComments', array(
             'local' => 'id',
             'foreign' => 'tasks_id'));
    }
}
