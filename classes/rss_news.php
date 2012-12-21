<?php
/*
 * @author Jens Fuchs <fuchs at d-mind.de>
 * @project Redaxo-News-Addon
 * @date 14.11.2012
 * Gibt RSS der News aus
*/


class news_rss 
{ 
		
	public function execute($cat) 
	{
		return self::showList($cat);
	}
	
	
	protected function textile($string)
	{
		if(OOAddon::isAvailable("textile"))
		{
			if($string != "")
			{
				$string = str_replace("\t", "", $string);
				$string = htmlspecialchars_decode($string);
				$string = str_replace("<br />","",$string);
				return rex_a79_textile($string);
			}
		}
		else return $string;
	}
	
	
	private function showList($cat)
	{
		
        $addSql = "";
        if ($cat<>999)
            $addSql = " AND category LIKE '%|".$cat."|%'";
		
		$qry = "	SELECT * 
					FROM ".TBL_NEWS." 
					WHERE (offline_date = \"0000-00-00\" OR (REPLACE(offline_date, \"-\", \"\") > CURDATE() + 0)) 
					AND status=1 
                    ".$addSql."
					ORDER BY online_date DESC
				";
				
		$sql = new rex_sql();
		#$sql->debugsql = true;
		$data = $sql->getArray($qry);
		
		/* create one master array of the records */
		$posts = array();
		foreach ($data as $row)
		{
			$posts[] = array('post'=>$row);
		}
		
        return $posts;
   }
}
?>