<!DOCTYPE html>
 <html lang="en">
  <head>
   <title>Codeigniter Pagination Example</title>
  
  </head>
  <body>
   <div class="container">
    <div class="row">
     <div class="col-md-12">
      <div class="row">
      
       <h4>Job Request</h4>
       <table class="table table-striped table-bordered table-condensed">
        <tr><td><strong>Job ID</strong></td><td><strong>Job Description</strong></td><td><strong>Start Date</strong></td><td><strong>Finish Date</strong></td></tr> 
        <?php 
        if(is_array($JR) && count($JR) ) {
         foreach($JR as $jr){     
        ?>
        <tr><td><?=$jr->jobID;?></td><td><?=$jr->jobDescription;?></td><td><?=$jr->startDate;?></td><td><?=$jr->finishDate;?></td></tr>     
           <?php 
         }        
        }?>  
       </table>            
      </div>
     </div>
    </div>
    <div class="row">
              <div class="col-md-12">
      <div class="row"><?php echo $this->pagination->create_links(); ?></div> 
     </div>
    </div>
   </div>    
  </body>
 </html> 