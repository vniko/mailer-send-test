<?php

namespace App\Http\Controllers;

use App\Repositories\ApiRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class ApiController extends Controller
{

    /**
     * @var ApiRepository
     */
    private $repo;

    /**
     * @var string
     */
    private $modelName;

    /**
     * @var string
     */
    private $resourceClass;

    public function __construct(Request $request)
    {
        $this->resolveRepo($request->segment(2));
    }

    private function resolveRepo($model)
    {
        $this->modelName = \Str::studly(\Str::singular($model));
        $this->resourceClass = 'App\Http\Resources\\'. $this->modelName .'Resource';
        if (!class_exists($this->resourceClass)) {
            $this->resourceClass = 'App\Http\Resources\GenericResource';
        }

        $repoClass = 'App\Repositories\\'. $this->modelName .'Repository';
        $this->repo = \App::make($repoClass);


    }

    public function index()
    {
        $data = $this->repo->all();
        return $this->sendResponse($this->resourceClass::collection($data), $this->modelName .' retrieved successfully');
    }

    public function store(Request $request)
    {
        $obj = $this->repo->create($request->all());
        return $this->sendResponse(new $this->resourceClass($obj), $this->modelName .' created successfully');
    }

    public function show($model, $id)
    {
        $obj = $this->repo->find($id);
        return $this->sendResponse(new $this->resourceClass($obj), $this->modelName .' retrieved successfully');
    }

    public function update($model, $id, Request $request)
    {
        $obj = $this->repo->update($request->all(), $id);
        return $this->sendResponse(new $this->resourceClass($obj), $this->modelName .' updated successfully');
    }

    public function destroy($model, $id)
    {
        $this->repo->delete($id);
        return $this->sendSuccess('Object deleted');
    }

    public function getRelation($model, $id,  $relation, Request $request)
    {
        $relation = $this->repo->getRelation($id, $relation, $request->all());
        if ($relation) {
            if ($relation instanceof Collection) {
                if ($record = $relation->first()) {
                    $resourceClass = $this->resolveResourceName((new \ReflectionClass($record))->getShortName());
                    return $this->sendResponse($resourceClass::collection($relation), 'Relation retrieved successfully');
                } else {
                    return $this->sendResponse([], 'Relation  retrieved successfully');
                }
            } else {
                $resourceClass = $this->resolveResourceName((new \ReflectionClass($relation))->getShortName());
                return $this->sendResponse(new $resourceClass($relation), 'Relation  retrieved successfully');
            }
        } else {
            return $this->sendResponse([], 'Relation  retrieved successfully');
        }
    }

    public function storeRelation($model, $id,  $relation, Request $request)
    {
        $relation = $this->repo->storeRelation($id, $relation, $request->all());
        if ($relation) {
            $resourceClass = $this->resolveResourceName((new \ReflectionClass($relation))->getShortName());
            return $this->sendResponse(new $resourceClass($relation), 'Relation '. $relation .' created successfully');
        } else {
            $this->sendError('Unable to create relation');
        }
    }
}
