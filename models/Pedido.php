<?php
	
	class Pedido {

		private $id;
		private $usuario_id;
		private $provincia;
		private $localidad;
		private $direccion;
		private $coste;
		private $estado;
		private $fecha;
		private $hora;
		private $db;

		public function __construct()
		{
			$this->db = Database::connect();
		}	
	    
	   
	    public function getId()
	    {
	        return $this->id;
	    }
	    
	    public function setId($id)
	    {
	        $this->id = $id;	        
	    }

	    public function getUsuarioId()
	    {
	        return $this->usuario_id;
	    }

	    public function setUsuarioId($usuario_id)
	    {
	        $this->usuario_id = $usuario_id;	        
	    }
	    
	    public function getProvincia()
	    {
	        return $this->provincia;
	    }
	    
	    public function setProvincia($provincia)
	    {
	        $this->provincia = $this->db->real_escape_string($provincia);	        
	    }
	    
	    public function getLocalidad()
	    {
	        return $this->localidad;
	    }
	    
	    public function setLocalidad($localidad)
	    {
	        $this->localidad = $this->db->real_escape_string($localidad);	        
	    }

	    public function getDireccion()
	    {
	        return $this->direccion;
	    }
	   
	    public function setDireccion($direccion)
	    {
	        $this->direccion = $this->db->real_escape_string($direccion);	       
	    }
	   
	    public function getCoste()
	    {
	        return $this->coste;
	    }
	   
	    public function setCoste($coste)
	    {
	        $this->coste = $coste;	        
	    }
	   
	    public function getEstado()
	    {
	        return $this->estado;
	    }

	    public function setEstado($estado)
	    {
	        $this->estado = $estado;	        
	    }
	   
	    public function getFecha()
	    {
	        return $this->fecha;
	    }
	   
	    public function setFecha($fecha)
	    {
	        $this->fecha = $fecha;	        
	    }
	    
	    public function getHora()
	    {
	        return $this->hora;
	    }

	    public function setHora($hora)
	    {
	        $this->hora = $hora;	        
	    }

	    public function getDb()
	    {
	        return $this->db;
	    }
	   
	    public function setDb($db)
	    {
	        $this->db = $db;	       
	    }

	    public function getAll()
	    {
	    	$sql = "SELECT * FROM pedidos ORDER BY id DESC";
	    	$productos = $this->db->query($sql);
	    	return $productos;
	    }	   

	    public function getOne()
	    {
	    	$sql = "SELECT * FROM pedidos WHERE id = {$this->getId()}";
	    	$producto = $this->db->query($sql);
	    	return $producto->fetch_object();//para que sea un object usable
	    }

	    public function save()
	    {    		    	

	    	$sql = "INSERT INTO pedidos VALUES (null,{$this->getUsuarioId()},'{$this->getProvincia()}','{$this->getLocalidad()}','{$this->getDireccion()}',{$this->getCoste()},'confirm',CURDATE(),CURTIME())";

	    	$save = $this->db->query($sql);	    	

	    	$result = false;

	    	if($save)
	    	{
	    		$result = true;
	    	}

	    	return $result;
	    }   
	
    	public function save_linea()
    	{
    		$sql = "SELECT LAST_INSERT_ID() AS pedido_id";

    		$registro = $this->db->query($sql);

    		$pedido_id = $registro->fetch_object()->pedido_id;

    		foreach ($_SESSION['carrito'] as $value) {

    			$producto = $value['producto'];

    			$sql = "INSERT INTO lineas_pedidos VALUES (null,{$pedido_id},{$producto->id},{$value['unidades']})";

    			$save = $this->db->query($sql);

    		}

    		$result = false;

	    	if($save)
	    	{
	    		$result = true;
	    	}

	    	return $result;
   		
    	}
}