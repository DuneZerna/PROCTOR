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
Doctrine_Manager::getInstance()->bindComponent('Versions', 'doctrine');

/**
 * BaseVersions
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $id
 * @property integer $projects_id
 * @property integer $versions_status_id
 * @property string $name
 * @property string $description
 * @property date $due_date
 * @property Projects $Projects
 * @property VersionsStatus $VersionsStatus
 * @property Doctrine_Collection $Tasks
 * 
 * @method integer             getId()                 Returns the current record's "id" value
 * @method integer             getProjectsId()         Returns the current record's "projects_id" value
 * @method integer             getVersionsStatusId()   Returns the current record's "versions_status_id" value
 * @method string              getName()               Returns the current record's "name" value
 * @method string              getDescription()        Returns the current record's "description" value
 * @method date                getDueDate()            Returns the current record's "due_date" value
 * @method Projects            getProjects()           Returns the current record's "Projects" value
 * @method VersionsStatus      getVersionsStatus()     Returns the current record's "VersionsStatus" value
 * @method Doctrine_Collection getTasks()              Returns the current record's "Tasks" collection
 * @method Versions            setId()                 Sets the current record's "id" value
 * @method Versions            setProjectsId()         Sets the current record's "projects_id" value
 * @method Versions            setVersionsStatusId()   Sets the current record's "versions_status_id" value
 * @method Versions            setName()               Sets the current record's "name" value
 * @method Versions            setDescription()        Sets the current record's "description" value
 * @method Versions            setDueDate()            Sets the current record's "due_date" value
 * @method Versions            setProjects()           Sets the current record's "Projects" value
 * @method Versions            setVersionsStatus()     Sets the current record's "VersionsStatus" value
 * @method Versions            setTasks()              Sets the current record's "Tasks" collection
 * 
 * @package    sf_sandbox
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseVersions extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('versions');
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
        $this->hasColumn('versions_status_id', 'integer', 4, array(
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
        $this->hasColumn('due_date', 'date', 25, array(
             'type' => 'date',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             'length' => 25,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasOne('Projects', array(
             'local' => 'projects_id',
             'foreign' => 'id'));

        $this->hasOne('VersionsStatus', array(
             'local' => 'versions_status_id',
             'foreign' => 'id'));

        $this->hasMany('Tasks', array(
             'local' => 'id',
             'foreign' => 'versions_id'));
    }
}
