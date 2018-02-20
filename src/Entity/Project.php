<?php

namespace Opdavies\Drupalorg\Entity;

class Project extends Node
{
    /**
     * The field to use for the number of downloads.
     */
    const FIELD_DOWNLOADS = 'field_download_count';

    /**
     * The field to use for the number of stars.
     */
    const FIELD_STARS = 'flag_project_star_user';

    /**
     * Retrieve the number of downloads.
     *
     * @return int
     */
    public function getDownloads()
    {
        return (int) $this->get(self::FIELD_DOWNLOADS);
    }

    /**
     * Return the number of stars.
     *
     * @return int
     */
    public function getStars()
    {
        return collect($this->get(self::FIELD_STARS))
            ->count();
    }
}
