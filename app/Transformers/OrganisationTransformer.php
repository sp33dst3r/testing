<?php

declare(strict_types=1);

namespace App\Transformers;

use App\Organisation;
use League\Fractal\TransformerAbstract;

/**
 * Class OrganisationTransformer
 * @package App\Transformers
 */
class OrganisationTransformer extends TransformerAbstract
{
    protected $availableIncludes = [
        'user'
    ];

    /**
     * @param Organisation $organisation
     *
     * @return array
     */

    public function transform(Organisation $organisation): array
    {
        return [
            'id' => $organisation->id,
            'name' => $organisation->name,
            'trial_end' => $organisation->trial_end ? $organisation->trial_end->getTimeStamp() : null,
            'subscribed' => $organisation->subscribed,
            'owner_id' => $organisation->owner_user_id,
        ];
    }

    /**
     * @param Organisation $organisation
     *
     * @return \League\Fractal\Resource\Item
     */
    public function includeUser(Organisation $organisation)
    {
        return $this->item($organisation->owner, new UserTransformer());
    }
}
