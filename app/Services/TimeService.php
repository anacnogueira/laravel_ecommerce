<?php

namespace App\Services;

class TimeService
{	
	protected $timezone;

	public function __construct()
	{
		$this->timezone = new \DateTimeZone('America/Sao_Paulo');
	}

	public function getNow()
	{
		return date_create("Now", $this->timezone);
	}

	public function addSecondsToNow($seconds)
   {
       return date_format(date_add($this->getNow(), date_interval_create_from_date_string($seconds. "seconds")),"Y-m-d H:i:s");
   }

   public function addDaysToNow($days)
   {
      return date_format(date_add($this->getNow(), date_interval_create_from_date_string($days. "days")),"Y-m-d");
   }

    public function addSecondsToDate($date, $seconds)
    {
    	return date_format(date_add(date_create($date), date_interval_create_from_date_string($seconds. "seconds")),"Y-m-d H:i:s");
    }

    public function removeSecondsToNow($seconds)
    {
       return date_format(date_sub($this->getNow(), date_interval_create_from_date_string($seconds. "seconds")),"Y-m-d H:i:s");
    }

    public function setDateToCorrectTimezone($date)
    {
    		return date_format(date_sub(date_create($date), date_interval_create_from_date_string("3 hours")),"Y-m-d H:i:s");
    }

    public function setDateToRFC3339($date)
    {
    	return date_format($date, "Y-m-d\TH:i:s\Z");
    }
}