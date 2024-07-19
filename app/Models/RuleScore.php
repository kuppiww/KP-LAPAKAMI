<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class RuleScore extends Model
{
    protected $table = "rule_scores";
    protected $primaryKey = "rule_score_id";
    protected $fillable = ['rule_score_id', 'rule_score', 'description', 'rule_score_position', 'created_at', 'created_by', 'updated_at', 'updated_by'];
    protected $casts = ['rule_score_id' => 'string'];

    public $total = 0;

    public function getList($page, $params = [], $search = '')
    {

        $res = false;

        try {

            $sql = DB::table($this->table)
                ->select($this->table . '.*')
                ->orderBy($this->table . '.rule_score_position', 'ASC');

            // Filtering
            if (sizeof($params) > 0) {
                $sql->where($params);
            }

            // Searching
            if (!empty($search)) {
                $sql->where(function ($query) use ($search) {
                    $query->orWhere(DB::raw('LOWER(' . $this->table . '.rule_score)'), 'like', '%' . strtolower($search) . '%')
                        ->orWhere(DB::raw('LOWER(' . $this->table . '.rule_score)'), 'like', '%' . strtolower($search) . '%');
                });
            }

            $this->total = $sql->get()->count();

            // Paging
            $sql->limit($page['limit']);
            $sql->offset($page['start']);

            $res = $sql->get();

        } catch (Exception $e) {
            die($e->getMessage());
        }

        return $res;

    }
}