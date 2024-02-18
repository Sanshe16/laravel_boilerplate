<?php

use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;


if (!function_exists('isApiCall'))
{
    /**
     * Determines if request is an api call.
     *
     * If the request URI contains '/api/v'.
     *
     * @param Request $request
     * @return bool
     */
    function isApiCall($request)
    {
        return strpos($request->getUri(), '/api/') !== false;
    }
}

if (!function_exists('isValidHttpStatus'))
{
    function isValidHttpStatus(int $code): bool
    {
        // thanks @James
        return array_key_exists($code, Response::$statusTexts);
    }
}

if (!function_exists('generateKey'))
{
    function generateKey($minlength = 20, $maxlength = 20, $uselower = true, $useupper = true, $usenumbers = true, $usespecial = false)
    {
        $charset = '';
        if ($uselower)
        {
            $charset .= "abcdefghijklmnopqrstuvwxyz";
        }
        if ($useupper)
        {
            $charset .= "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
        }
        if ($usenumbers)
        {
            $charset .= "123456789";
        }
        if ($usespecial)
        {
            $charset .= "~@#$%^*()_+-={}|][";
        }
        if ($minlength > $maxlength)
        {
            $length = mt_rand($maxlength, $minlength);
        }
        else
        {
            $length = mt_rand($minlength, $maxlength);
        }
        $key = '';
        for ($i = 0; $i < $length; $i++)
        {
            $key .= $charset[(mt_rand(0, strlen($charset) - 1))];
        }
        return $key;
    }
}

if (!function_exists('showNotyf'))
{
    function showNotyf($message, $type = 'error', $x = 'center', $y = 'top')
    {
        $return =  notyf()
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

if (!function_exists('getCurrentVersion'))
{
    /**
     * @return mixed
     */
    function getCurrentVersion()
    {
        if (config('app.is_version') == 'true')
        {
            $composerFile = file_get_contents('../composer.json');
            $composerData = json_decode($composerFile, true);

            return $composerData['version'];
        }
    }
}

if (!function_exists('getAvatarUrl'))
{
    /**
     * return avatar url.
     *
     * @return string
     */
    function getAvatarUrl()
    {
        return 'https://ui-avatars.com/api/';
    }
}

if (!function_exists('getRandomColor'))
{
    /**
     * return random color.
     *
     * @param  int  $userId
     * @return string
     */
    function getRandomColor($userId)
    {
        $colors = ['329af0', 'fc6369', 'ffaa2e', '42c9af', '7d68f0'];
        $index = $userId % 5;

        return $colors[$index];
    }
}

if (!function_exists('getUserImageInitial'))
{
    /**
     * return avatar full url.
     *
     * @param  int  $userId
     * @param  string  $name
     * @return string
     */
    function getUserImageInitial($userId, $name)
    {
        return getAvatarUrl() . "?name=$name&size=100&rounded=true&color=fff&background=" . getRandomColor($userId);
    }
}

if (!function_exists('removeCommaFromNumbers'))
{
    /**
     * @param $number
     * @return string|string[]
     */
    function removeCommaFromNumbers($number)
    {
        return (gettype($number) == 'string' && !empty($number)) ? str_replace(',', '', $number) : $number;
    }
}

if (!function_exists('canAccessResource'))
{
    /**
     * @param  array  $models
     * @param  string  $columnName
     * @param  int  $id
     * @return bool
     */
    function canAccessResource($models, $columnName, $id)
    {
        foreach ($models as $model)
        {
            $result = $model::where($columnName, $id)->exists();
            if ($result)
            {
                return true;
            }
        }

        return false;
    }
}