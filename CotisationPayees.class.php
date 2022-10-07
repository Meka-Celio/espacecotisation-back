<?php 

class CotisationPayee 
{
	// Attributs
	public $sCINMedecin;
	public $sNumRecuTransaction; // string
	public $iIdParamCotisation;


	public function __construct ($sCINMedecin, $sNumRecuTransaction, $iIdParamCotisation) { 
		$this->sCINMedecin 			=	$sCINMedecin;
		$this->sNumRecuTransaction	=	$sNumRecuTransaction;
		$this->iIdParamCotisation	=	$iIdParamCotisation;
	}

	public function get_CINMedecin () {
		return $this->sCINMedecin;
	}

	public function get_NumRecuTransaction () {
		return $this->sNumRecuTransaction;
	}

	public function get_IdParamCotisation () {
		return $this->iIdParamCotisation;
	}

	public function readAttribute () {
		echo "Je suis la CIN : $this->sCINMedecin, de la transaction $this->sNumRecuTransaction, pour l'année : $this->iIdParamCotisation <br>";
	}
}

?>