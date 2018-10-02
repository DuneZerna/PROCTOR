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
Doctrine_Manager::getInstance()->bindComponent('ProjectsComments', 'doctrine');

/**
 * BaseProjectsComments
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $id
 * @property integer $projects_id
 * @property integer $created_by
 * @property string $description
 * @property timestamp $created_at
 * @property Projects $Projects
 * @property Users $Users
 * 
 * @method integer          getId()          Returns the current record's "id" value
 * @method integer          getProjectsId()  Returns the current record's "projects_id" value
 * @method integer          getCreatedBy()   Returns the current record's "created_by" value
 * @method string           getDescription() Returns the current record's "description" value
 * @method timestamp        getCreatedAt()   Returns the current record's "created_at" value
 * @method Projects         getProjects()    Returns the current record's "Projects" value
 * @method Users            getUsers()       Returns the current record's "Users" value
 * @method ProjectsComments setId()          Sets the current record's "id" value
 * @method ProjectsComments setProjectsId()  Sets the current record's "projects_id" value
 * @method ProjectsComments setCreatedBy()   Sets the current record's "created_by" value
 * @method ProjectsComments setDescription() Sets the current record's "description" value
 * @method ProjectsComments setCreatedAt()   Sets the current record's "created_at" value
 * @method ProjectsComments setProjects()    Sets the current record's "Projects" value
 * @method ProjectsComments setUsers()       Sets the current record's "Users" value
 * 
 * @package    sf_sandbox
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseProjectsComments extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('projects_comments');
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
        $this->hasColumn('created_by', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             'length' => 4,
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
        $this->hasColumn('created_at', 'timestamp', 25, array(
             'type' => 'timestamp',
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

        $this->hasOne('Users', array(
             'local' => 'created_by',
             'foreign' => 'id'));
    }
}
