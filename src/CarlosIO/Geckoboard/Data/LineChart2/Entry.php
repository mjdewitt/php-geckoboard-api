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
    protected $seriesValue;    
      
    public function __construct()
    {
        $this->value ='y_axis';
        $this->label = null;
        $this->format = null;
        $this->unit = null; 
        $this->xAxisName = null; 
        $this->xAxisLabels = array();
        $this->seriesName = null;
        $this->seriesData = array();
                      
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
    public function addSeriesValue($seriesName,$seriesValue)
    {
        $this->seriesData[$seriesName][] = $seriesValue;

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
        $this->xAxisLabels[] = $label;

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
     * @return array
     */
    public function getSeriesData()
    {
    	$return=array();
    	$series = array();
    	$data = array();
    	$seriesDataArray = (array)$this->seriesData;
    	foreach($seriesDataArray as $key=>$value) {
    		$savekey=$key;
    		foreach($value as $key1=>$value1) {
    			$data[]=$value1;
    		}
    			$series[]=array('name'=>$key,'data'=>$data);
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


        $xAxisLabels = $this->xAxisLabels;
				foreach ($xAxisLabels as $key=>$data) {
						$result['x_axis']['labels'][] = $data; 
					}
					 $result['series']=$this->getSeriesData();

        return $result;

    }
}
