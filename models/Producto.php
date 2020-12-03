<?php
	
	class Producto {

		private $id;
		private $categoria_id;
		private $nombre;
		private $descripcion;
		private $precio;
		private $stock;
		private $oferta;
		private $fecha;
		private $imagen;
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
	   
	    public function getCategoriaId()
	    {
	        return $this->categoria_id;
	    }
	    
	    public function setCategoriaId($categoria_id)
	    {
	        $this->categoria_id = $categoria_id;	        
	    }
	   
	    public function getNombre()
	    {
	        return $this->nombre;
	    }
	    
	    public function setNombre($nombre)
	    {
	        $this->nombre = $this->db->real_escape_string($nombre);	       
	    }
	   
	    public function getDescripcion()
	    {
	        return $this->descripcion;
	    }
	   
	    public function setDescripcion($descripcion)
	    {
	        $this->descripcion = $this->db->real_escape_string($descripcion);	       
	    }
	   
	    public function getPrecio()
	    {
	        return $this->precio;
	    }
	    
	    public function setPrecio($precio)
	    {
	        $this->precio = $precio;
	        
	    }
	   
	    public function getStock()
	    {
	        return $this->stock;
	    }
	   
	    public function setStock($stock)
	    {
	        $this->stock = $stock;	        
	    }
	   
	    public function getOferta()
	    {
	        return $this->oferta;
	    }
	    
	    public function setOferta($oferta)
	    {
	        $this->oferta = $this->db->real_escape_string($oferta);	     
	    }
	    
	    public function getFecha()
	    {
	        return $this->fecha;
	    }
	   
	    public function setFecha($fecha)
	    {
	        $this->fecha = $fecha;	        
	    }
	  
	    public function getImagen()
	    {
	        return $this->imagen;
	    }
	   
	    public function setImagen($imagen)
	    {
	        $this->imagen = $this->db->real_escape_string($imagen);	        
	    }

	    public function getAll()
	    {
	    	$sql = "SELECT * FROM productos ORDER BY id DESC";
	    	$productos = $this->db->query($sql);
	    	return $productos;
	    }

	    public function getRandom($limit)
	    {
	    	$sql = "SELECT * FROM productos ORDER BY RAND() LIMIT $limit";
	    	$productos = $this->db->query($sql);
	    	return $productos;
	    }

	    public function getOne()
	    {
	    	$sql = "SELECT * FROM productos WHERE id = {$this->getId()}";
	    	$producto = $this->db->query($sql);
	    	return $producto->fetch_object();//para que sea un object usable
	    }

	    public function save()
	    {	
	    	
	    	if(empty($this->getImagen()))
	    	{
	    		$this->setImagen('noDisponible.jpg');
	    	}	    	

	    	$sql = "INSERT INTO productos VALUES (null,{$this->getCategoriaId()},'{$this->getNombre()}','{$this->getDescripcion()}',{$this->getPrecio()},{$this->getStock()},'{$this->getOferta()}',CURDATE(),'{$this->getImagen()}')";

	    	$save = $this->db->query($sql);	    	

	    	$result = false;

	    	if($save)
	    	{
	    		$result = true;
	    	}

	    	return $result;
	    }

	    public function edit()
	    {	    	

	    	$sql = "UPDATE productos SET ";
	    	$sql .= "categoria_id = {$this->getCategoriaId()}";
	    	$sql .= ",nombre = '{$this->getNombre()}'";
	    	$sql .= ",descripcion = '{$this->getDescripcion()}'";
	    	$sql .= ",precio = {$this->getPrecio()}";
	    	$sql .= ",stock = {$this->getStock()}";
	    	$sql .= ",oferta = '{$this->getOferta()}'";
	    	
	    	if(!empty($this->getImagen()))
	    	{
	    		$sql .= ",imagen = '{$this->getImagen()}'";
	    	}

	    	$sql .= " WHERE id = {$this->getId()}";	    	

	    	$save = $this->db->query($sql);	    	

	    	$result = false;

	    	if($save)
	    	{
	    		$result = true;
	    	}

	    	return $result;
	    }

	    public function delete()
	    {
	    	$sql = "DELETE FROM productos WHERE id = {$this->getId()}";

	    	$delete = $this->db->query($sql);

	    	$result = false;

	    	if($delete)
	    	{
	    		$result = true;
	    	}

	    	return $result;
	    }	  
	   
	}