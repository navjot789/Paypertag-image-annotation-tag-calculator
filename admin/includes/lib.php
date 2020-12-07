 <?php
    //GETTING DATA FOR PREVIOUS WEEK
   
                $dtFrom = new DateTime; // get current date
                $dtTo = new DateTime;
                
                // format for previous week (no previous year check)
                $dtFrom->setISODate($dtFrom->format('o'), $dtFrom->format('W') - 1);
                // do the same for end date range
                $dtTo->setISODate($dtTo->format('o'), $dtTo->format('W') );
                // subtract 1 day
                $dtTo->sub(new DateInterval('P1D') );
                // convert to iso date for database use
                $dFrom = $dtFrom->format('Y-m-d');
                $dTo   = $dtTo->format('Y-m-d');
                
                
       //GETTING DATA FOR CURRENT WEEK

                $dtFrom_current = new DateTime; // get current date
                $dtTo_current   = new DateTime;
                
                $dtFrom_current->setISODate( $dtFrom_current->format( 'o' ), $dtFrom_current->format( 'W' ) );
                
                $dtTo_current->setISODate( $dtTo_current->format( 'o' ), $dtTo_current->format( 'W' ) );
                // add 1 day
                $dtTo_current->add( new DateInterval( 'P6D' ) );
                
                // convert to iso date for database use
                 $dFrom_current = $dtFrom_current->format( 'Y-m-d' );
             
                 $dTo_current = $dtTo_current->format( 'Y-m-d' );
                 
                 
              
              
                 
                                            
                                                                          
   ?>