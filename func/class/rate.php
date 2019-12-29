<?php 

class rate extends dbh{

	public function self_rate($cnt_id,$rate=0)
	{
		$sql = "UPDATE content SET selfRate = $rate WHERE id = $cnt_id ";
		$this->connect()->query($sql);	
	}

	public function eval_rate($cnt_id,$rate=0)
	{
		$sql = "UPDATE content SET evalRate = $rate WHERE id = $cnt_id ";
		$this->connect()->query($sql);	
	}
}

?>