




<?php  

 
$HOME='http://mynbhd.org/Oc/data/';     
$INFILES['jan'] ='012015data.csv';     
$INFILES['feb'] ='022015data.csv';     
$INFILES['march'] ='032015data.csv';     
$INFILES['april'] ='042015data.csv';     
$INFILES['may'] ='052015data.csv';
$month = 'feb';
//$month = $_REQUEST['monthData'];

$f = $INFILES[$month];
error_reporting(E_ERROR | E_WARNING | E_PARSE);
csv_to_json($HOME, $f);     
$ALL_DATA = array();
$cumm = null;
$cumm_count = null;
$averageTemp = null;

$max = 0;
$min = 5834975;

                function csv_to_json($home, $file){
                  global $cumm, $cumm_count, $averageTemp, $min, $max;
                    $FN ="$home/$file";              
                    $DATA = @file( $FN );              
                        if ( !empty( $DATA) )             
                     foreach ( $DATA as $ct => $L ) {                  
                            $ALL_DATA[] = $L;

                        

                            foreach($ALL_DATA as $index =>$val){
                               
                          list($date, $hr, $temp, $b, $a) = split(",", $val);

                          
                          
                                if(isset($_GET[$date])){
                                  $cumm[$date] += $temp;
                                  $cumm_count[$date] += 1;
                                }
                                else if(isset($_GET[$temp])){
                                  $cumm[$date] += $temp;
                                  $cumm_count[$date] += 1;
                                }
                                else{
                                   $cumm[$date] += $temp;
                                  $cumm_count[$date] += 1;
                                }

                                if ($temp > $max)
                                  { $max = $temp; }

                                $maxTemp[$date] = $max; 
                                echo "date =" . $date ."max=" . $max;

                  

                                if ($temp < $min)
                                  { $min = $temp; }

                                $minTemp[$date] = $min; 
                                echo "date =" . $date . "min=" . $min;
                              
                          
                          
                         
                          
                          
                           
                         
                            
                            }               
                      }
                      
                     
                     $file = fopen("jsonData.php" , "w+");
                     
                      foreach($cumm as $date=>$total){
                          $average = intval($total/$cumm_count[$date]);
                          
                         $averageTemp[$date] += $average;
                        
                      }
                      fwrite($file, "[");
                    foreach($averageTemp as $key => $value){
                       $keys = array('Date', 'Average');
                       $line = array($key, $value);
                      $jsonData =  array_combine($keys, $line);

                        fwrite($file, json_encode($jsonData).",");
                    }
                    fwrite($file, "]");
                   fclose($file);  
                   
                }
?>
