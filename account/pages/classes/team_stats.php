<?php
class teamstats
{
    public function group_total_display()
    {
         $con_obj = new connection(); 
         
          $statement = $con_obj->prepare('SELECT sum(total_tags) FROM team_tag_0');
          $statement->execute();
          $statement->fetch();
          $statement->bind_result($sum);
                                
           $data = array('total_group_tags'=>$sum);
           
         echo $data['total_group_tags'];
         
    }
}


?>