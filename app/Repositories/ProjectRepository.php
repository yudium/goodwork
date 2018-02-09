<?php

namespace App\Repositories;

use App\Models\Project;

class ProjectRepository
{
    /**
     * @var mixed
     */
    protected $model;

    /**
     * @param Project $project
     */
    public function __construct(Project $project)
    {
        $this->model = $project;
    }

    /**
     * @return mixed
     */
    public function getAllProjects()
    {
        return $this->model->get(['name', 'description']);
    }

    /**
     * @param  mixed $total
     * @return mixed
     */
    public function getLatestProject($total)
    {
        return $this->model->orderBy('created_at', 'desc')->take($total)->get();
    }

    public function getIdFromSlug($slug)
    {
        return $this->model->where('slug', $slug)->first()->id;
    }

    public function storeProject($data)
    {
        return $this->model->create([
            'name'        => $data['name'],
            'slug'        => str_slug($data['name']),
            'description' => $data['description'],
            'office_id'   => $data['office_id'] ?? null,
            'team_id'     => $data['team_id'] ?? null,
        ]);
    }
}