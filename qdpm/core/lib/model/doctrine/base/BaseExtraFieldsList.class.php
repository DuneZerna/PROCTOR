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
Doctrine_Manager::getInstance()->bindComponent('ExtraFieldsList', 'doctrine');

/**
 * BaseExtraFieldsList
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $id
 * @property integer $extra_fields_id
 * @property integer $bind_id
 * @property string $value
 * @property ExtraFields $ExtraFields
 * 
 * @method integer         getId()              Returns the current record's "id" value
 * @method integer         getExtraFieldsId()   Returns the current record's "extra_fields_id" value
 * @method integer         getBindId()          Returns the current record's "bind_id" value
 * @method string          getValue()           Returns the current record's "value" value
 * @method ExtraFields     getExtraFields()     Returns the current record's "ExtraFields" value
 * @method ExtraFieldsList setId()              Sets the current record's "id" value
 * @method ExtraFieldsList setExtraFieldsId()   Sets the current record's "extra_fields_id" value
 * @method ExtraFieldsList setBindId()          Sets the current record's "bind_id" value
 * @method ExtraFieldsList setValue()           Sets the current record's "value" value
 * @method ExtraFieldsList setExtraFields()     Sets the current record's "ExtraFields" value
 * 
 * @package    sf_sandbox
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseExtraFieldsList extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('extra_fields_list');
        $this->hasColumn('id', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => true,
             'autoincrement' => true,
             'length' => 4,
             ));
        $this->hasColumn('extra_fields_id', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'default' => '0',
             'notnull' => true,
             'autoincrement' => false,
             'length' => 4,
             ));
        $this->hasColumn('bind_id', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'default' => '0',
             'notnull' => true,
             'autoincrement' => false,
             'length' => 4,
             ));
        $this->hasColumn('value', 'string', null, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => true,
             'autoincrement' => false,
             'length' => '',
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasOne('ExtraFields', array(
             'local' => 'extra_fields_id',
             'foreign' => 'id'));
    }
}
