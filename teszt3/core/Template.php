<?php

class Template
{
    private string $origHtml, $lastRender;
    private array $flagsData; //Minden flag-hez egy array-nyi data fog tartozni.
    private bool $modified;
    
    public function getFlags() : array
    {
        return array_keys($this->flagsData);
    }
    
    private function __construct(string $html)
    {
        global $cfg;
        $this->modified = true;
        $this->origHtml = $html;
        $this->flagsData = array();
        if(preg_match_all($cfg["flagPattern"], $this->origHtml, $flags))
        {
            foreach($flags[1] as $flag)
            {
                $this->flagsData[$flag] = array();
            }
        }
    }
    
    public static function LoadFromFile(string $filename) : Template
    {
        $html = file_get_contents("template/".$filename);
        return new Template($html);
    }
    
    public static function ParseString(string $html) : Template
    {
        return new Template($html);
    }


    public function AddData(string $flag, string|Template $data, string $dataKey = "") : bool
    {
        if(array_key_exists($flag, $this->flagsData))
        {
            if($dataKey == "")
            {
                $this->flagsData[$flag][] = $data;
            }
            else
            {
                $this->flagsData[$flag][$dataKey] = $data;
            }
            $this->modified = true;
            return true;
        }
        return false;
    }
    
    public function ClearFlag(string $flag) : bool
    {
        if(array_key_exists($flag, $this->flagsData))
        {
            $this->flagsData[$flag] = array();
            $this->modified = true;
            return true;
        }
        return false;
    }
    
    public function GetFlagDataByKey(string $flag, string $dataKey) : Template|string|false
    {
        if(array_key_exists($flag, $this->flagsData) && array_key_exists($dataKey, $this->flagsData[$flag]))
        {
            return $this->flagsData[$flag][$dataKey];
        }
        return false;
    }
    
    public function Render(bool $force = false) : string
    {
        global $cfg;
        if(!$this->modified && !$force)
        {
            return $this->lastRender;
        }
        $this->lastRender = $this->origHtml;
        foreach ($this->flagsData as $flag=>$datas)
        {
            //$finalHtml = str_replace("§".$flag."§", implode("", $datas), $finalHtml);
            $tmp = "";
            foreach ($datas as $data)
            {
                if(is_a($data, "Template"))
                {
                    $tmp .= $data->Render();
                }
                else
                {
                    $tmp .= $data;
                }
            }
            $this->lastRender = str_replace($cfg["flagSign"].$flag.$cfg["flagSign"], $tmp, $this->lastRender);
        }
        $this->modified = false;
        return $this->lastRender;
    }
}
