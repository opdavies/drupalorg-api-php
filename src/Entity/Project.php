<?php

namespace Opdavies\Drupalorg\Entity;

class Project extends Node
{
    /**
     * Retrieve the number of downloads.
     *
     * @return int
     */
    public function getDownloads()
    {
        return (int) $this->get('field_download_count');
    }

    /**
     * Return the number of stars.
     *
     * @return int
     */
    public function getStars()
    {
        return collect($this->get('flag_project_star_user'))
            ->count();
    }
}
