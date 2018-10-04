<?php

/**
 * Ushahidi Platform Export Job Create Use Case
 *
 * @author     Ushahidi Team <team@ushahidi.com>
 * @package    Ushahidi\Platform
 * @copyright  2014 Ushahidi
 * @license    https://www.gnu.org/licenses/agpl-3.0.html GNU Affero General Public License Version 3 (AGPL3)
 */

namespace Ushahidi\Core\Usecase\Export\Job;

use Ushahidi\Core\Usecase\CreateUsecase;

class CreateJob extends CreateUsecase
{
    protected function getEntity()
	{
		$entity = parent::getEntity();

		// Add user id if this is not provided
		// TODO: throw this away
		if (empty($entity->user_id) && $this->auth->getUserId()) {
			$entity->setState(['user_id' => $this->auth->getUserId()]);
		}

		// Default status filter to 'all' if not provided
		if (empty($entity->filters['status'])) {
			$filters = $entity->filters;
			$filters['status'] = ['all'];
			$entity->setState(['filters' => $filters]);
		}

		return $entity;
	}
}
