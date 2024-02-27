<?php

namespace App\Http\Traits;


trait FlashTrait
{
    function showNotyf($message, $type = 'error', $duration = 2000, $x = 'center', $y = 'top')
    {
        $return =  notyf()
            ->duration($duration)
            ->ripple(true)
            ->translate(config()->get('app.locale'))
            ->position('x', $x)
            ->position('y', $y);

        if ($type == 'success')
        {
            $return = $return->addSuccess($message);
        }
        elseif ($type == 'info')
        {
            $return = $return->addInfo($message);
        }
        elseif ($type == 'danger')
        {
            $return = $return->addDanger($message);
        }
        else
        {
            $return = $return->addError($message);
        }

        return $return;
    }
}
