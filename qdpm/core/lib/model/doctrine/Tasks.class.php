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

/**
 * Tasks
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @package    sf_sandbox
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
class Tasks extends BaseTasks
{
  public static function hasViewOwnAccess($sf_user,$tasks,$project)
  {
    if(Users::hasAccess('view_own','tasks',$sf_user,$project->getId()))
    {      
      if(!in_array($sf_user->getAttribute('id'),explode(',',$tasks->getAssignedTo())) and $tasks->getCreatedBy()!=$sf_user->getAttribute('id'))
      {
        return false;
      }
      else
      {
        return true;
      }
    }
    else
    {
      return true;
    }
  }
      
  public static function checkViewOwnAccess($c,$sf_user,$tasks,$project)
  {
    if(Users::hasAccess('view_own','tasks',$sf_user,$project->getId()))
    {      
      if(!in_array($sf_user->getAttribute('id'),explode(',',$tasks->getAssignedTo())) and $tasks->getCreatedBy()!=$sf_user->getAttribute('id'))
      {
        $c->redirect('accessForbidden/index');
      }
    }
  }
  
  public static function sendNotification($c,$tasks,$send_to,$sf_user)
  {
    foreach($send_to as $type=>$users)
    {
      switch($type)
      {
        case 'status': $subject = t::__('Tasks Status Updated');
          break;
        default: $subject = t::__('New Task');
          break;
      }
      
      $to = array();
      foreach($users as $v)
      {
        if($u = Doctrine_Core::getTable('Users')->find($v))
        {
          $to[$u->getEmail()]=$u->getName();
        }
      }
                
      $user = $sf_user->getAttribute('user');
      
      $from[$user->getEmail()] = $user->getName();
      $to[$user->getEmail()] = $user->getName();
      $to[$tasks->getUsers()->getEmail()] = $tasks->getUsers()->getName();
      
      if(sfConfig::get('app_send_email_to_owner')=='off')
      {
        unset($to[$user->getEmail()]);             
      }
             
      $subject .= ': ' . $tasks->getProjects()->getName() . ' - '  .  $tasks->getName() . ($tasks->getTasksStatusId()>0 ? ' [' . $tasks->getTasksStatus()->getName() . ']':'');
      $body  = $c->getComponent('tasks','emailBody',array('tasks'=>$tasks));
                  
      Users::sendEmail($from,$to,$subject,$body,$sf_user);
    }                
  }
    
  public static function addFiltersToQuery($q,$filters)
  {    
    $count_e = 0;
    
    foreach($filters as $table=>$fstr)
    {
      $ids = explode(',',$fstr);
      
      switch($table)
      {
        case 'TasksPriority':
            $q->whereIn('t.tasks_priority_id',$ids);
          break;
        case 'TasksStatus':
            $q->whereIn('t.tasks_status_id',$ids);
          break;
        case 'TasksTypes':
            $q->whereIn('t.tasks_type_id',$ids);
          break;
         case 'TasksLabels':
            $q->whereIn('t.tasks_label_id',$ids);
          break;
        case 'TasksGroups':
            $q->whereIn('t.tasks_groups_id',$ids);
          break;
        case 'Versions':
            $q->whereIn('t.versions_id',$ids);
          break;
        case 'ProjectsPhases':
            $q->whereIn('t.projects_phases_id',$ids);
          break;  
        case 'TasksAssignedTo':
            $filter_sql_array = array();
            foreach($ids as $id)
            {
              $filter_sql_array[] = 'find_in_set(' . $id . ',t.assigned_to)';
            }
            
            $q->addWhere(implode(' or ',$filter_sql_array));
          break;
        case 'TasksCreatedBy':
            $filter_sql_array = array();
            foreach($ids as $id)
            {
              $filter_sql_array[] = 'find_in_set(' . $id . ',t.created_by)';
            }
            
            $q->addWhere(implode(' or ',$filter_sql_array));
          break; 
          
        case 'Projects':
            $q->whereIn('t.projects_id',$ids);
          break; 
        case 'ProjectsStatus':
            $q->whereIn('p.projects_status_id',$ids);
          break;
        case 'ProjectsTypes':
            $q->whereIn('p.projects_types_id',$ids);
          break;  
      }
      
    }
          
    return $q;  
  }
  
  public static function getReportType($request, $type = 'filter')
  {
    if((int)$request->getParameter('projects_id')>0)
    {
      return $type . $request->getParameter('projects_id');
    }
    else
    {
      return $type;
    }
  }
  
  public static function saveTasksFilter($request, $filters,$sf_user,$filter_type = 'filter')
  {  
    $report_type = Tasks::getReportType($request,$filter_type);
    
    if($request->getParameter('update_user_filter')>0)
    {            
      $r = Doctrine_Core::getTable('UserReports')->createQuery()
            ->addWhere('id=?',$request->getParameter('update_user_filter'))
            ->addWhere('users_id=?',$sf_user->getAttribute('id'))
            ->addWhere('report_type=?',$report_type)
            ->fetchOne();
            
      if($r)
      {
        $r->setName($request->getParameter('name'));  
        $r->setIsDefault($request->getParameter('is_default'));
      }
      else
      {
        return false;
      }
    }
    else
    {    
      $r = new UserReports();
      $r->setName($request->getParameter('name'));
      $r->setUsersId($sf_user->getAttribute('id'));
      $r->setReportType($report_type);
      $r->setIsDefault($request->getParameter('is_default'));
    }
    
    if(!$request->hasParameter('update_user_filter') or ($request->hasParameter('update_user_filter') and $request->hasParameter('update_values')))
    {
      foreach($filters as $table=>$fstr)
      {            
        switch($table)
        {
          case 'TasksPriority':
              $r->setTasksPriorityId($fstr);            
            break;
          case 'TasksStatus':
              $r->setTasksStatusId($fstr);            
            break;
          case 'TasksTypes':
              $r->setTasksTypeId($fstr);            
            break;
          case 'TasksLabels':
              $r->setTasksLabelId($fstr);            
            break;
          case 'TasksGroups':
              $r->setTasksGroupsId($fstr);            
            break;  
          case 'Versions':
              $r->setVersionsId($fstr);            
            break;
          case 'ProjectsPhases':
              $r->setProjectsPhasesId($fstr);            
            break;
          case 'TasksAssignedTo':
              $r->setAssignedTo($fstr);            
            break;
          case 'TasksCreatedBy':
              $r->setCreatedBy($fstr);            
            break;  
        
        
          case 'Projects':
              $r->setProjectsId($fstr);            
            break;
          case 'ProjectsPriority':
              $r->setProjectsPriorityId($fstr);            
            break;
          case 'ProjectsStatus':
              $r->setProjectsStatusId($fstr);            
            break;
          case 'ProjectsTypes':
              $r->setProjectsTypeId($fstr);            
            break;
          case 'ProjectsGroups':
              $r->setProjectsGroupsId($fstr);            
            break;

        }
      }
    }
          
    $r->save();
    
    if($r->getIsDefault()==1)
    {
      Doctrine_Query::create()
      ->update('UserReports')
      ->set('is_default', 0)
      ->addWhere('id != ?', $r->getId())
      ->addWhere('report_type=?',$report_type)
      ->execute();
    }  
  }
  
  public static function useTasksFilter($request,$sf_user,$filter_type = 'filter')
  {
    $id = $request->getParameter('user_filter');
        
    $report_type = Tasks::getReportType($request,$filter_type);
    
    $f = array();
    
    $r = Doctrine_Core::getTable('UserReports')
                ->createQuery()
                ->addWhere('id=?',$id)
                ->addWhere('report_type=?',$report_type)
                ->addWhere('users_id=?',$sf_user->getAttribute('id'))
                ->fetchOne();
    
    if(strlen($r->getTasksPriorityId())>0)
    {
      $f['TasksPriority'] = $r->getTasksPriorityId(); 
    }
    
    if(strlen($r->getTasksStatusId())>0)
    {
      $f['TasksStatus'] = $r->getTasksStatusId(); 
    }
                
    if(strlen($r->getTasksTypeId())>0)
    {
      $f['TasksTypes'] = $r->getTasksTypeId(); 
    }
    
    if(strlen($r->getTasksLabelId())>0)
    {
      $f['TasksLabels'] = $r->getTasksLabelId(); 
    }
    
    if(strlen($r->getTasksGroupsId())>0)
    {
      $f['TasksGroups'] = $r->getTasksGroupsId(); 
    }
    
    if(strlen($r->getVersionsId())>0)
    {
      $f['Versions'] = $r->getVersionsId(); 
    }
    
    if(strlen($r->getProjectsPhasesId())>0)
    {
      $f['ProjectsPhases'] = $r->getProjectsPhasesId(); 
    }
    
    if(strlen($r->getAssignedTo())>0)
    {
      $f['TasksAssignedTo'] = $r->getAssignedTo(); 
    }
    
    if(strlen($r->getCreatedBy())>0)
    {
      $f['TasksCreatedBy'] = $r->getCreatedBy(); 
    }
    
    if(strlen($r->getProjectsId())>0)
    {
      $f['Projects'] = $r->getProjectsId(); 
    }
      
    if(strlen($r->getProjectsStatusId())>0)
    {
      $f['ProjectsStatus'] = $r->getProjectsStatusId(); 
    }
                
    if(strlen($r->getProjectsTypeId())>0)
    {
      $f['ProjectsTypes'] = $r->getProjectsTypeId(); 
    }
    
    return $f;
  }
  
  public static function getDefaultFilter($request,$sf_user, $filter_type='filter')
  {      
      $f = array();
      
      if(strstr($filter_type,'timeReport'))
      {
        if(count($s=app::getStatusByGroup('closed','TasksStatus'))>0)
        {
          $f['TasksStatus'] = implode(',',$s);
        } 
      }
      else
      {                  
        if(count($s=app::getStatusByGroup('open','TasksStatus'))>0)
        {
          $f['TasksStatus'] = implode(',',$s);
        }      
      }
                  
      return $f;

  }
  
  public static function  getProgressChoices()
  {
    $c = array(''=>'');      
            
    for($i=5;$i<=100;$i+=5)
    {
      $c[$i]=$i . '%';
    }
    
    return $c;
  }
  
  public static function getTasksColumnChoices()
  {
    return array(
                 'Id'                 => t::__('Id'),
                 'TasksGroups'    => t::__('Group'),
                 'Versions'        => t::__('Version'),
                 'ProjectsPhases' => t::__('Phase'),                 
                 'TasksPriority'  => t::__('Priority'),
                 'TasksLabels'     => t::__('Label'),                                  
                 'Name'     => t::__('Name'),
                 'TasksStatus'    => t::__('Status'),
                 'TasksTypes'      => t::__('Type'),                 
                 'AssignedTo'    => t::__('Assigned To'),
                 'CreatedBy'     => t::__('Created By'),
                 'EstimatedTime' => t::__('Est. Time'),
                 'WorkHours' => t::__('Work Hours'),                                                   
                 'StartDate'     => t::__('Start Date'),
                 'DueDate'       => t::__('Due Date'),
                 'Progress'       => t::__('Progress'),
                 'CreatedAt'     => t::__('Created At'),
                );
  }
  
  public static function  getListingOrderByType($q,$type)
  {
    switch($type)
     {
       case 'date_added':           $q->orderBy('t.created_at desc');
         break;
       case 'date_last_commented':  $q->orderBy('t.last_comment_date desc');
         break;
       case 'name':                 $q->orderBy('LTRIM(p.name), LTRIM(t.name)');
         break;
       case 'priority':             $q->orderBy('LTRIM(p.name), tp.sort_order,LTRIM(tp.name), LTRIM(t.name)');
         break;
       case 'status':               $q->orderBy('LTRIM(p.name), ts.group desc, ts.sort_order,LTRIM(ts.name),  LTRIM(t.name)');
         break;
       case 'type':                 $q->orderBy('LTRIM(p.name), tt.sort_order,LTRIM(tt.name), LTRIM(t.name)');
         break;
       case 'label':                $q->orderBy('LTRIM(p.name), tl.sort_order,LTRIM(tl.name), LTRIM(t.name)');
         break; 
       default:                     $q->orderBy('LTRIM(p.name), ts.group desc, ts.sort_order, LTRIM(ts.name), LTRIM(t.name)');
        break;           
     }
     
     return $q;
  }
}
