<?php

namespace Opdavies\Drupalorg\Entity;

class Node extends Entity
{
    /**
     * The distribution project type.
     */
    const TYPE_DISTRIBUTION = 'project_distribution';

    /**
     * The module project type.
     */
    const TYPE_MODULE = 'project_module';

    /**
     * The theme project type.
     */
    const TYPE_THEME = 'project_theme';


  /**
     * Retrieve the project title.
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->get('title');
    }
}
