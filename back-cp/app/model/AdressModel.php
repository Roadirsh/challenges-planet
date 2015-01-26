<?php 
	$logger->log('Include', 'loadapp', "Chargement du modèle AdressModel.php", Logger::GRAN_MONTH);

/**
 * AdressModel
 *
 * Requêtes relatifs a la connexion
 *
 * @package 	Framework_L&G
 * @copyright 	L&G
 */

/**
 * choix de l'action
 * instanciation de la class
 */
class AdressModel extends CoreModel{

	private $nomRue;
	private $numRue;
	private $zipcode;
	private $city;
	private $country;
	private $typeAdress;
	
	/**
	 * Constructor
	 */
	function __construct($nom, $num, $zipcode, $country, $city, $type){
		parent::__construct();            
            	$this->setNomRue($nom);
	    		$this->setNumRue($num);
	    		$this->setZipcode($zipcode);
	    		$this->setCountry($country);
	    		$this->setCity($city);
	    		$this->setTypeAdress($type);
   	}
	
		/**
	* Ajout adresse utilisateur
	*/
	public function insertAdress($id)
	{
		$street = $this->getNomRue();
		$num = $this->getNumRue();
		$zipcode = $this->getZipcode();
		$city = $this->getCity();
		$typeAdress = $this->getTypeAdress();
		

		try {
		
	            $insert = $this->connexion->prepare("INSERT INTO `giraudsa`.`cp_adress` (`adress_id`, `ad_date`, `ad_num`, `ad_street`, `ad_zipcode`, `ad_city`, `ad_country`, `ad_type`, `user_user_id`) VALUES (NULL, now(), :num, :street, :zipcode, :city, :country, :typeAdress, :user_id)");
	            
				
				
	            $insert->bindParam(':num', $num);
	            $insert->bindParam(':street', $street);
	            $insert->bindParam(':zipcode', $zipcode);
	            $insert->bindParam(':city', $city);
	            $insert->bindParam(':country', $country);
	            $insert->bindParam(':typeAdress', $typeAdress);
	            $insert->bindParam(':user_id', $id);
	            
				$insert->execute();
				
	        }
	        catch (Exception $e)
	        {
	            echo 'Message:' . $e -> getMessage();
	        }
	} 
		
	/**
	 * SETTERS & GETTERS voir le num de la rue d'un utilisateur
	 */
	public function getNumRue()
	{
		return $this->numRue;
	}
	public function setNumRue($numRue)
	{
		if(is_int($numRue))
		{
			$this->numRue = $numRue;
		}
	}
	
	/**
	 * SETTERS & GETTERS type d'adresse d'un utilisateur
	 */
	public function getTypeAdress()
	{
		return $this->typeAdress;
	}
	public function setTypeAdress($typeAdress)
	{
		if($typeAdress == 'domicile' )
		{
			$this->typeAdress = $typeAdress;
		}
	}
	
	/**
	 * SETTERS & GETTERS voir le nom de la rue d'un utilisateur
	 */
	public function getNomRue()
	{
		return $this->nomRue;
	}
	public function setNomRue($nomRue)
	{
		if(is_string($nomRue))
		{
			$this->nomRue = $nomRue;
		}
	}
		
	/**
	 * SETTERS & GETTERS voir code postal d'un utilisateur
	 */
	public function getZipcode()
	{
		return $this->zipcode;
	}
	public function setZipcode($zipcode)
	{
		if(is_string($zipcode) && strlen($zipcode) <= 9 && strlen($zipcode) >= 1)
		{
			$this->zipcode = $zipcode;
		}
	}
	
	/**
	 * SETTERS & GETTERS voir la ville d'un utilisateur
	 */
	public function getCity()
	{
		return $this->city;
	}
	public function setCity($city)
	{
		if(is_string($city))
		{
			$this->city = $city;
		}
	}
	
	/**
	 * SETTERS & GETTERS voir le pays d'un utilisateur
	 */
	public function getCountry()
	{
		return $this->country;
	}
	public function setCountry($country)
	{
		$arrayCountry = getPays();
		$arrayCountry = array_map('strtolower', $arrayCountry);
		if(in_array($country, $arrayCountry))
		{
			$this->country = $country;
		}
	}
	
}
?>