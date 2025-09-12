<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

/**
 * Model: StudentsModel
 * 
 * Automatically generated via CLI.
 */
class StudentsModel extends Model {

    /**
     * Table associated with the model.
     * @var string
     */
    protected $table = 'students';

    /**
     * Primary key of the table.
     * @var string
     */
    protected $primary_key = 'id';

    public function __construct()
    {
        parent::__construct();
    }
    
}
