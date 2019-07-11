<?php
class DenunciaPost extends EntidadBase{
    private $post;
    private $user;
    private $moderador;
    private $dFecha;
    private $motivo;
    private $fechaMod;
    
    public function __construct($adapter) {
        $table="denunciaPost";
        parent::__construct($table, $adapter);
    }
    
    public function __get($property) { 
        if (property_exists($this, $property)) { 
        return $this->$property; } 
    }

    public function __set($property, $value) { 
        if (property_exists($this, $property)) { 
        $this->$property = $value; } 
        return $this; 
    } 
	
    public function save(){
        
		if($this->moderador){
            $mod=$this->moderador->__get('id');
            $us=$this->user->__get('id');
            $poo=$this->post->__get('id');

			$query= "UPDATE `denunciaPost` SET `idModerador`=$mod,`fechaMod`=NOW() WHERE `idPost`= $poo and `idUsuario`= $us and `dFecha`= '$this->dFecha';";
					
            $save=$this->db()->query($query);
			return $save;
			
		}
		else{
            $us=$this->user->__get('id');
            $poo=$this->post->__get('id');
            $query= "INSERT INTO `denunciaPost`(`idPost`, `idUsuario`, `dFecha`, `motivo`) VALUES ( $poo, $us, NOW(),'$this->motivo');";
			$save=$this->db()->query($query);
			
			return $save;
		}	
    }
}
?>