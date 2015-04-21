
<?php
     
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
                                
                                //Splits each line of CSV data into array, date as key
                                $line = explode(',',$val);
                                $date = $line[0];
                                $hr = $line[1];
                                $temp = $line[2];
                               $temps[$date][$hr] = $temp;                   
                            }               
                      }
                     //Get average, high, and low for each date, by selecting key of date 
                      foreach($temps as $date=>$hr){
                        $allTemps[$date]['high'] = intval(max($hr));
                        $allTemps[$date]['low'] = intval(min($hr));
                        $allTemps[$date]['average'] = intval(array_sum($hr)/count($hr));
                      }
                    
                     $file = fopen("jsonData.php" , "w+");
                     
                     //Bracket needed for amchart to read data
                      fwrite($file, "[");
                      //Write Date and temps to file in json format
                      foreach($allTemps as $date=>$val){
                       
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