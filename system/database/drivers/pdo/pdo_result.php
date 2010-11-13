<?php

/**
 * PDO Result Class
 *
 * This class extends the parent result class: CI_DB_result
 *
 * @category	Database
 * @author		Dready
 * @link			http://dready.jexiste.fr/dotclear/
 */
class CI_DB_pdo_result extends CI_DB_result {

	var $pdo_results = '';
	var $pdo_index = 0;
	/**
	 * Number of rows in the result set
	 *
	* pfff... that's ugly !!!!!!!
	*
	*PHP manual for PDO tell us about nom_rows :
	* "For most databases, PDOStatement::rowCount() does not return the number of rows affected by
	*a SELECT statement. Instead, use PDO::query() to issue a SELECT COUNT(*) statement with the
	*same predicates as your intended SELECT statement, then use PDOStatement::fetchColumn() to
	*retrieve the number of rows that will be returned.
	*
	* which means
	* 1/ select count(*) as c from table where $where
	* => numrows
	* 2/ select * from table where $where
	* => treatment
	*
	* Holy cow !
	*
	 * @access	public
	 * @return	integer
	 */
	function num_rows()
	{
		if ( ! $this->pdo_results ) {
			$this->pdo_results = $this->result_id->fetchAll(PDO::FETCH_ASSOC);
		}
		return sizeof($this->pdo_results);
	}

	// --------------------------------------------------------------------

	/**
	 * Number of fields in the result set
	 *
	 * @access	public
	 * @return	integer
	 */
	function num_fields()
	{
		if ( is_array($this->pdo_results) ) {
			return sizeof($this->pdo_results[$this->pdo_index]);
		} else {
			return $this->result_id->columnCount();
		}
	}

	// --------------------------------------------------------------------

	/**
	 * Field data
	 *
	 * Generates an array of objects containing field meta-data
   *
   * **kt** Broken -- field_data was commented out in pdo_result.php.
   * **kt** HACK: Recopied from http://codeigniter.com/forums/viewthread/83000/
	 * **kt** DB_drive.php already calls _field_data for us, meaning our
   *        result_id is the result_id of the call to the schema table.
   *
	 * @access	public
	 * @return	array
	 */
	function field_data()
	{
		$retval = array();
    /*
    echo "<pre>";
    var_dump($this->result_id);
    var_dump($this->pdo_results);
    echo "</pre>";
    */
    $table_info = $this->pdo_results;
    assert(is_array($table_info));
    foreach ($table_info as $row_info) {
      $F             = new stdClass();
      $F->name       = $row_info['name'];
      $F->type       = $row_info['type'];
      $F->default    = $row_info['dflt_value'];
      $F->max_length = 0;
      $F->primary_key = $row_info['pk'];
      
      $retval[] = $F;
    }

    return $retval;
  }

	// --------------------------------------------------------------------

	/**
	 * Result - associative array
	 *
	 * Returns the result set as an array
	 *
	 * @access	private
	 * @return	array
	 */
	function _fetch_assoc()
	{
		if ( is_array($this->pdo_results) ) {
			$i = $this->pdo_index;
			$this->pdo_index++;
			if ( isset($this->pdo_results[$i]))
				return $this->pdo_results[$i];
			return null;
		}
		return $this->result_id->fetch(PDO::FETCH_ASSOC);
	}

	// --------------------------------------------------------------------

	/**
	 * Result - object
	 *
	 * Returns the result set as an object
	 *
	 * @access	private
	 * @return	object
	 */
	function _fetch_object()
	{
		if ( is_array($this->pdo_results) ) {
			$i = $this->pdo_index;
			$this->pdo_index++;
			if ( isset($this->pdo_results[$i])) {
				$back = '';
				foreach ( $this->pdo_results[$i] as $key => $val ) {
					$back->$key = $val;
				}
				return $back;
			}
			return null;
		}
		return $this->result_id->fetch(PDO::FETCH_OBJ);
	}

}


?>
