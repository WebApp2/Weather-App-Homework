

<?php  

 
$HOME='http://mynbhd.org/Oc/data/';     
$INFILES['jan'] ='012015data.csv';     
$INFILES['feb'] ='022015data.csv';     
$INFILES['march'] ='032015data.csv';     
$INFILES['april'] ='042015data.csv';     
$INFILES['may'] ='052015data.csv';
//$month = $_REQUEST['monthData'];
//$month = 'feb';
//$f = $INFILES[$month];
error_reporting(E_ERROR | E_WARNING | E_PARSE);
//csv_to_json($HOME, $f);     
$ALL_DATA = array();

$cumm = null;
$cumm_count = null;
$averageTemp = null;
$max = 0;


                function csv_to_json($home, $file){
                  global $cumm, $cumm_count, $averageTemp;
                    $FN ="$home/$file";              
                    $DATA = @file( $FN );              
                        if ( !empty( $DATA) )             
                     foreach ( $DATA as $ct => $L ) {                  
                            $ALL_DATA[] = $L;

                            foreach($ALL_DATA as $index =>$val){
                                
                               
                          list($date, $hr, $temp, $b, $a) = split(",", $val);
                                  //Store all temps in an array, key is date
                                  $temps[$date][$hr] = $temp;
                                  $cumm[$date] += $temp;
                                  $cumm_count[$date] += 1;
                              
                              
                          
                          
                         
                          
                          
                           
                         
                            
                            }               
                      }
                     //Get min and max for each date
                      foreach($temps as $date=>$hr){
                        $highLow[$date]['high'] = intval(max($hr));
                        $highLow[$date]['low'] = intval(min($hr));
                      }
                     
                     
                     $file = fopen("jsonData.php" , "w+");
                     //Combine the average, high, and low
                      foreach($cumm as $date=>$total){
                          $average = intval($total/$cumm_count[$date]);
                         $alltemp[$date]['high']=$highLow[$date]['high']; 
                         $alltemp[$date]['average']=$average;
                         $alltemp[$date]['low']=$highLow[$date]['low'];
                         
                        
                      }
                     //Bracket needed for amchart to read data
                      fwrite($file, "[");
                      //Write Date and temps to file in json format
                      foreach($alltemp as $date=>$val){
                       
                          $high =  $val['high'];
                          $average = $val['average'];
                          $low = $val['low'];
                          $keys = array('Date', 'High', 'Average', 'Low' );
                          $line = array($date, $high, $average, $low);
                          $jsonData = array_combine($keys, $line);
                          fwrite($file, json_encode($jsonData).",");
                  
                      }                      
                    //Bracket needed for amchart to read data
                    fwrite($file, "]");
                    
                   fclose($file);  
                   
                }
?>
