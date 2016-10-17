<?php

namespace App\Repositories;

use App\Entities\Project;
use Prettus\Repository\Eloquent\BaseRepository;


class ProjectRepositoryEloquent extends BaseRepository implements ProjectRepository
{

	public function model() {
		return Project::class;
	}

}