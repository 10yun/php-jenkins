<?php

class Node
{
    public function deleteNode22222($name)
    {
        //  URL::DELETE_NODE
        $url  = sprintf('computer/%s/doDelete', $name);

        $this->curlPost(
            $url,
            null,
            sprintf('Error deleting %s', $name)
        );
    }
}
