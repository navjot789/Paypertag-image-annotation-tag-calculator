<style>
    .holder{
    width: 100%;
    position:relative
  
}
.frame{
    width: 100%;
    height:100%;
    border: 0px;
    border-radius:10px;
   
}
.bar{
    position:absolute;
    top:0;
    left:0;
    width:100%;
    height:48px;
    background-color: #fff;
    border-top-left-radius:10px;
    border-top-right-radius:10px;
        margin-bottom: 10px;
    padding: 0.55rem 1.5rem;
    border-bottom: 1px solid rgba(0,0,0,.05);
  

    }
   @media only screen and (max-width: 600px) {
  .bar {
    background-color: #fff;
    height:120px;
  }
} 
    
</style>
</div>
</div>
</div>

<?php
  if(strlen($_GET['tag_code']) <= 16 || strlen($_GET['tag_code']) > 17 )
  {
      
  ?>
  <div class="container-fluid mt--6">
       <div class="card">
                    <div class="card-header">
                      <h3 class="mb-0"><a href="dashpanel?p=preview_task"><i class="fas fa-arrow-circle-left"></i> Go Back</a></h3>
                    </div>
                    
                       <div class="alert alert-danger alert-dismissible fade show m-4" role="alert">
                                    <span class="alert-icon"><i class="fas fa-times-circle"></i></span>
                                    <span class="alert-text"><strong>ERROR: </strong> INVALID CODE</span>
                                   
                                  </div>    
              
               </div>  
</div>

      
      
<?php  }else
  {
?>
<div class="container-fluid mt--6">
   
        <div class="card">
                   
                    <div class="card-header">
                      <div class="row align-items-center">
                        <div class="col-8">
                          <!-- Title -->
                        <h3 class="mb-0"><a href="dashpanel?p=preview_task"><i class="fas fa-arrow-circle-left"></i> Go Back</a></h3>
                        </div>
                        <div class="col-4 text-right">
                          <a href="dashpanel?p=task_updating&t=<?php echo urlencode(base64_encode($_GET['tag_code']));?>" onclick="return confirm('Are you sure you want to Edit this Task?')" class="btn btn-sm btn-neutral"><i class="fas fa-edit"></i> Update this task?</a>
                        </div>
                      </div>
                    </div>
                    
                    <div class="card-body">
                      <div class="holder">
                            <iframe class="frame"  scrolling="yes"src="https://worker.microwork.io/tagging-mistakes/<?php echo $_GET['tag_code'];?>" style="width: 100%; height: 600px;"></iframe>
                            <div class="bar"><p><i class="fas fa-info-circle"></i> <strong>In order to view Tagging Mistakes, Make sure you were already had loggedin into Microwork Account.</strong></p></div>
                        </div>
                    </div>
                  </div>
</div>

<?php
}?>


              
              
       