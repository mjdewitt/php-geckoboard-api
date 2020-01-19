<?php

namespace CarlosIO\Geckoboard\Data\LineChart2;

/**
 * Class Entry.
 */
class Entry
{
    /**
     * @var string
     */
    protected $value;

    /**
     * @var string
     */
    protected $color = null;

    /**
     * @var string
     */
    protected $label;
    
    /**
     * @var string
     */
    protected $format;    

    /**
     * @var string
     */
    protected $unit;
    
    /**
     * @var string
     */
    protected $name;    
    /**
     * @var string
     */
    protected $seriesName;        
    /**
     * @var string
     */
    protected $seriesType;            
    /**
     * @var string
     */
    protected $seriesIncomplete;                
    /**
     * @var string
     */    
    protected $seriesValue;    
      
    public function __construct()
    {
        $this->value ='y_axis';
        $this->label = null;
        $this->format = null;
        $this->unit = null; 
        $this->xAxisName = null; 
        $this ->xAxisType = null;
        $this->xAxisLabels = array();
        $this->seriesName = null;
        $this->seriesIncomplete = null;
        $this->seriesData = array();
        $this->seriesValue = null;
                      
    }

    
    /**
     * @param $value
     *
     * @return $this
     */
    public function addSeries($seriesName)
    {
        $this->seriesData[$seriesName] = array();

        return $this;
    } 
    /**
     * @param $value
     *
     * @return $this
     */
    public function setSeriesType($seriesType)
    {
    	if ($seriesType != 'datetime') $seriesType = null;
        $this->seriesData['type'] = $seriesType;

        return $this;
    }     
    
    /**
     * @param $value
     *
     * @return $this
     */
    public function setSeriesIncomplete($seriesIncomplete)
    {
    	if ($this->seriesData['type'] == 'datetime') {
        $this->seriesData['incomplete'] = $seriesIncomplete;
      } else {
      	$this->seriesData['incomplete'] = null;;
      }

        return $this;
    }         
    
    /**
     * @param $value
     *
     * @return $this
     */
    public function addSeriesValue($seriesName,$seriesValue1,$seriesValue2=NULL)
    {
//    	$valuesArray=implode(',',$seriesValue);
//    	$values = $valuesArray[1];
//echo '<p><pre>';
//var_dump($seriesValue1);
//echo '<br>';
//var_dump($seriesValue2);
//echo '</pre></p>';
 //   	if (count($values) > 2 ) {
 //   		    	throw new \Exception('Series data has too many entries');
 //   	}
    	
    		if ($seriesValue1 !== null) {
    			if (! is_numeric($seriesValue1) && 
    					(! strtotime($seriesValue1) && 
    					isset( $this->seriesData[$seriesName]['type'] ) && 
    					$this->seriesData[$seriesName]['type'] != 'datetime' ) ) {
    				throw new \Exception('Series X value is not numeric or date');
    			}
    			//echo '<br> is value1 date '.strtotime($seriesValue1);
    			if ( (stristr('-',$seriesValue1) || stristr('/',$seriesValue1)) && strtotime($seriesValue1)  &&  (! isset( $this->seriesData[$seriesName]['type'] ) || $this->seriesData[$seriesName]['type'] != 'datetime') ) {
    				throw new \Exception(' Series is not type datetime and date included in data');
    			}    			
    			if ((stristr('-',$seriesValue1) || stristr('/',$seriesValue1)) &&  strtotime($seriesValue1) && count( $this->xAxisLabels ) ) {
    				throw new \Exception('Series X labels already defined');
    			}    			    			
				}
    		if ($seriesValue2 !== null) {				
      		if (! is_numeric($seriesValue2)  ) {
    				throw new \Exception('Series Y value is not numeric');
    			}  	
    	}
if ($seriesValue2 !== null ) {
        $this->seriesData[$seriesName][] = array($seriesValue1,$seriesValue2);
} else {
	        $this->seriesData[$seriesName][] = $seriesValue1;
}
        return $this;
    }         
    /**
     * @param  $label
     *
     * @return $this
     */
    public function setLabelyAxis($label)
    {
        $this->label = $label;

        return $this;
    }
    public function setFormatyAxis($format)
    {
        $this->format = $format;

        return $this;
    }
    
    public function setUnityAxis($unit)
    {
        $this->unit = $unit;

        return $this;
    }   
    
    public function setSeriesName($name)
    {
        $this->seriesName = $name;

        return $this;
    }  
    /**
     * @param  $label
     *
     * @return $this
     */
    public function setLabelsxAxis($label)
    {
    	    	if (isset($this->seriesData['type']) && $this->seriesData['type'] != 'datetime') {
       $this->xAxisLabels[] = $label;
     } 

        return $this;
    }    
         
    /**
     * @return string
     */
    public function getLabelyAxis()
    {
        return $this->label;
    }
    
    /**
     * @return array
     */
    public function getLabelsxAxis()
    {
        return $this->xAxisLabels;
    }    
    /**
     * @return string
     */
    public function getFormatyAxis()
    {
        return $this->format;
    }
    
    /**
     * @return string
     */
    public function getUnityAxis()
    {
        return $this->unit;
    }    
    
    /**
     * @return string
     */
    public function getSeriesType()
    {
    	if (isset($this->seriesData['type'])) {
        return $this->seriesData['type'];
      } else {
      	return null;
      }
    }  
    /**
     * @return string
     */
    public function getSeriesIncomplete()
    {
    	  if (isset($this->seriesData['incomplete'])) {
        return $this->seriesData['incomplete'];
      } else {
      	return null;
      }
    }      
        /**
     * @return array
     */
    public function getSeriesData()
    {
    	$return=array();
    	$series = array();
    	$data = array();
    	$seriesDataArray = (array)$this->seriesData;
    	unset($seriesDataArray['type']);
    	unset($seriesDataArray['incomplete']);
    	 
    	foreach($seriesDataArray as $key=>$value) {
    		//echo '<br>key= '.$key;
        if (is_string($key)) $name=$key;
    		 if (is_array($value)) {
    		foreach($value as $key1=>$value1) {
    			    	//	echo '<br>key1= '.$key1;
    			$data[]=$value1;
    		}
    	}
    			$series[]=array('name'=>$name,'data'=>$data);
    			$data=array();
    	}

    	
        return $series;
    }       




    /**
     * @return array
     */
    public function toArray()
    {
        $result = array();


        if (null !== $this->format && null !== $this->unit) {
            $result['y_axis'] = array(
            'format'=>$this->format,
            'unit' => $this->unit
            ) ;
        }
        if (null !== $this->getSeriesType() ) {
            $result['x_axis'] = array(
            'type'=>$this->getSeriesType()
            ) ;
        }
        if (null !== $this->getSeriesIncomplete() ) {
            $result['incomplete_from'] = array(
            $this->getSeriesIncomplete()
            ) ;
        }
        if (count($this->xAxisLabels)) {
        $xAxisLabels = $this->xAxisLabels;
				foreach ($xAxisLabels as $key=>$data) {
						$result['x_axis']['labels'][] = $data; 
					}
}
					 $result['series']=$this->getSeriesData();

        return $result;

    }
}
