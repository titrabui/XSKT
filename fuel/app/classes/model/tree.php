<?php
class Model_Tree extends \Orm\Model_Nestedset
{
	/**
	* @var  string  name of the table to be used by this model
	*/
	protected static $_table_name = 'tree';

	/**
	 * @var  array  array of object properties
	 */
	protected static $_properties = array(
		'id',
		'left_id',
		'right_id',
		'tree_id',
		'user_id',
	);

	/**
	 * @var  array  array with the tree configuration
	 */
	protected static $_tree = array(
		'left_field'     => 'left_id',		// name of the tree node left index field
		'right_field'    => 'right_id',		// name of the tree node right index field
		'tree_field'     => 'tree_id',		// name of the tree node tree index field
		'user_field'     => 'user_id',		// name of the tree node user index field
	);

}
