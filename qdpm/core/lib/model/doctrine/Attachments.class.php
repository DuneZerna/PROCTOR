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
 * Attachments
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @package    sf_sandbox
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
class Attachments extends BaseAttachments
{
  public static function hasFilesInRequest($files)
  {
    if(isset($files['attachments']))
    {
      foreach($files['attachments'] as $id=>$file)
      {                
        if(strlen($file['name'])>0)
        {
          return true;
        }
      }
    }
    
    return false;
  }
  
  public static function getFileIcon($filename)
  {
    if(strstr($filename,'.'))
    {
      $filename_array = explode('.',$filename);
      $extension = $filename_array[sizeof($filename_array)-1];
      
      if(is_file(sfConfig::get('sf_web_dir') . 'images/fileicons/' . $extension . '.png'))
      {
        return image_tag('fileicons/' . $extension.'.png',array('absolute'=>true)) . ' ';
      }        
    }
    
    return image_tag('fileicons/attachment.png',array('absolute'=>true)) . ' ';
  }
  
  public static function getLink($a) 
  {
    return link_to(substr($a->getFile(),7),'attachments/download?id='.$a->getId());
  }
  
  public static function insertAttachments($files,$bind_type,$bind_id,$info, $sf_user)
  {        
    if(is_array($info))
    foreach($info as $id=>$v)
    {    
      if($a = Doctrine_Core::getTable('Attachments')->find($id))
      {            
        $a->setInfo($v);
        $a->setBindId($bind_id);
        $a->save();
      }      
    }   
  }
  
  public static function clearTmpUploadedFiles($sf_user)
  {
    $q = Doctrine_Core::getTable('Attachments')
                  ->createQuery()
                  ->addWhere('bind_id=?','-' . $sf_user->getAttribute('id'))
                  ;
                         
    foreach($q->execute() as $a)
    {
      if(is_file($file_path = sfConfig::get('sf_upload_dir') . '/attachments/' . $a->getFile()))
      {
        unlink($file_path);
      }
      
      $a->delete();
    }
  }

  public static function deleteAttachmentsByBindId($bind_id,$bind_type)
  {
    $q = Doctrine_Core::getTable('Attachments')
                  ->createQuery()
                  ->addWhere('bind_id=?',$bind_id)
                  ->addWhere('bind_type=?',$bind_type);

    foreach($q->execute() as $a)
    {
      if(is_file($file_path = sfConfig::get('sf_upload_dir') . '/attachments/' . $a->getFile()))
      {
        unlink($file_path);
      }

      $a->delete();
    }
  }
  
  public static function resetAttachments()
  {
    $attachments = Doctrine_Core::getTable('Attachments')
                  ->createQuery()
                  ->addWhere('bind_id>0')
                  ->fetchArray();
                  
     foreach($attachments as $a)
     {

        switch($a['bind_type'])
        {
          case 'projects': $t = 'Projects';
            break;
          case 'tasks': $t = 'Tasks';
            break;
          case 'tickets': $t = 'Tickets';
            break;
          case 'discussions': $t = 'Discussions';
            break;
          case 'comments': $t = 'TasksComments';
            break;
          case 'ticketsComments': $t = 'TicketsComments';
            break;
          case 'discussionsComments': $t = 'DiscussionsComments';
            break;
          case 'projectsComments': $t = 'ProjectsComments';
            break;
          case 'extra_fields': $t = 'ExtraFields';
            break;
        }
        
        if(Doctrine_Core::getTable($t)->createQuery()->addWhere('id=?',$a['bind_id'])->count()==0)
        {
        
          if(is_file($file_path = sfConfig::get('sf_upload_dir') . '/attachments/' . $a['file']))
          {
            unlink($file_path);
          }
      
          Doctrine_Query::create()
          ->delete()
          ->from('Attachments')
          ->andWhere('id=?',$a['id'])
          ->execute();
          
        }
     }
     
  }
}
