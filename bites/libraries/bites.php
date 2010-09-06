<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
* Bites Addon
*
*/
class Bites
{
    public $mojo;
	public $display_name  = 'MojoBites';
	public $addon_version = '0.2';

	// --------------------------------------------------------------------

	/**
	 * Constructor
	 *
	 * @access	public
	 * @return	void
	 */
	function __construct()
	{		
		$this->mojo =& get_instance();
	}

	// -------------------------------------------------------------------- 
	
	public function content($data)
    {
        $params = $data['parameters'];

		//We need the name to do anything..
		if(!isset($params['page']) || !isset($params['region']))
		{
			return;
		}

		$page 	= $data['parameters']['page'];
		$region	= $data['parameters']['region'];

		if($this->mojo->page_model->page_exists($page))
		{
			$this->mojo->db->select('content');
			$this->mojo->db->where('page_url_title', $page);
			$this->mojo->db->where('region_id', $region);
			$query = $this->mojo->db->get('page_regions');
			
			print_r($query);

			if($query->num_rows() > 0 && $query->result_array())
			{
				$content = $query->result_array();
				$content = $content[0]['content'];
				return $content;
			}
		}
    }
}

?>