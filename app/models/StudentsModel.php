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

    public function getAll($q, $records_per_page = null, $page = null) {
            if (is_null($page)) {
                return $this->db->table('authors')->get_all();
            } else {
                $query = $this->db->table('authors');
                
                // Build LIKE conditions
                $query->like('id', '%'.$q.'%')
                    ->or_like('first_name', '%'.$q.'%')
                    ->or_like('last_name', '%'.$q.'%')
                    ->or_like('email', '%'.$q.'%');

                // Clone before pagination
                $countQuery = clone $query;

                $data['total_rows'] = $countQuery->select_count('*', 'count')
                                                ->get()['count'];

                $data['records'] = $query->pagination($records_per_page, $page)
                                        ->get_all();

                return $data;
            }
        }
    
}
