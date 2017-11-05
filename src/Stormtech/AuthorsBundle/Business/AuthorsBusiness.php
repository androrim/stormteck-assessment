<?php

namespace Stormtech\AuthorsBundle\Business;

use Stormtech\AuthorsBundle\Entity\Author;

/**
 * Business rules of Authors
 *
 * @author Leandro de Amorim <androrim@gmail.com>
 */
class AuthorsBusiness
{

    /**
     * Check if Author name is valid
     * 
     * @param Author $author
     * @return boolean FALSE if isn't full name
     */
    public function isValidName(Author $author)
    {
        $name       = trim($author->getName());
        $parts_name = explode(' ', $name);
        
        if (1 === preg_match('~[0-9]~', $name)) {
            return false;
        }

        if (count($parts_name) < 2) {
            return false;
        }


        foreach ($parts_name as $i => $part) {
            $partSize = strlen($part);
            $hasPrev  = isset($parts_name[$i - 1]);
            $haNext   = isset($parts_name[$i + 1]);


            if (!$hasPrev && $partSize < 3) { // eg.: if "Le" return false
                return false;
            }
            elseif (!$hasPrev && !$haNext) { // eg.: if "Leandro" return false
                return false;
            }
            elseif ($hasPrev && !$haNext && $partSize < 3) { // eg.: if "Leandro de" return false
                return false;
            }
            elseif ($hasPrev && $haNext && strlen($parts_name[$i + 1]) < 3) { // eg.: if "Leandro de Am" return false
                return false;
            }
        }

        return true;
    }
}