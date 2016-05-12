<?php
class ColaboradorDAO {
	
	public function select($campo, $termos) {
		$read = new Read();
		$read->ExecRead($campo, "colaboradores", $termos);
		return $read->getResultado();
	}
}