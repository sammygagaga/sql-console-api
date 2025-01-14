<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\StoreQueryRequest;
use App\Http\Requests\Api\UpdateQueryRequest;
use App\Models\Query;
use Illuminate\Http\Request;
use function Laravel\Prompts\select;

class QueryController extends Controller
{
    
    public function index()
    {
        $queries = Query::query()
            ->select(['id','query_name','query_text'])
            ->get();
        return response()->json($queries);
    }

    public function store(StoreQueryRequest $request)
    {
     $query=auth()->user()->queries()
            ->create($request->validated());
        return response()->json([
            'id' => $query->id,
            'query_name' => $query->query_name,
            'query_text' => $query->query_text,
        ],201);
    }

    public function show(Query $query)
    {
        return response()->json([
            'id'=> $query->id,
            'query_name' => $query->query_name,
            'query_text' => $query->query_text
        ]);
    }

    public function update(UpdateQueryRequest $request, Query $query)
    {
        if ($request->method() === 'PUT') {
            $query->update([
                'query_name' => $request->input('query_name'),
                'query_text' => $request->input('query_text')
            ]);
        }else{
            $data = [];

            if ($request->has('query_name')) {
                $data['query_name'] = $request->input('query_name');
            }

            if ($request->has('query_text')) {
                $data['query_text'] = $request->input('query_text');
            }

            $query->update($data);
            return response()->json([
                'id' => $query->id,
                'query_name' =>$query->query_name,
                'query_text'=>$query->query_text
            ]);
        }

        return response()->json([
            'id' => $query->id,
            'query_name' =>$query->query_name,
            'query_text'=>$query->query_text
        ]);
    }

    public function destroy(Query $query)
    {
        $query->delete();

        return response()->json([
            'message' => 'Query deleted successfully'
        ]);
    }
}
