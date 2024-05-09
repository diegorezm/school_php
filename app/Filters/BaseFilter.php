<?php
namespace App\Filters;

use Illuminate\Http\Request;


class BaseFilter {

    protected $safeParams = [];
    protected $columnMap = [];
    protected $operatorMap = [
        'eq' => '=',
        'lt' => '<',
        'lte' => '<=',
        'gt' => '>',
        'gte' => '>=',
    ];
    /*
    * @return array<string,string,string>
    */
    public function transform(Request $request): array
    {
        $eloArray = [];
        foreach ($this->safeParams as $param => $operators) {
            $query = $request->query($param);
            if(!isset($query)){
                continue;
            }
            $column = $this->columnMap[$param] ?? $param;
            foreach($operators as $operator){
               if (!isset($query[$operator]) || !isset($this->operatorMap[$operator])) {
                    continue;
                }
                $eloArray[] = [$column, $this->operatorMap[$operator], $query[$operator]];
            }
        }
        return $eloArray;
    }
}
