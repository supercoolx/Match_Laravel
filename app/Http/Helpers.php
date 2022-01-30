<?php
//use App\Upload;


//highlights the selected navigation on admin panel
if (!function_exists('areActiveRoutes')) {
    function areActiveRoutes(array $routes, $output = "active")
    {
        foreach ($routes as $route) {
            if (Route::currentRouteName() == $route) return $output;
        }
    }
}

//highlights the selected navigation on frontend
if (!function_exists('areActiveRoutesHome')) {
    function areActiveRoutesHome(array $routes, $output = "active")
    {
        foreach ($routes as $route) {
            if (Route::currentRouteName() == $route) return $output;
        }
    }
}

//highlights the selected navigation on frontend
if (!function_exists('default_language')) {
    function default_language()
    {
        return env("DEFAULT_LANGUAGE");
    }
}

function timezones()
{
    return Timezones::timezonesToArray();
}

if (!function_exists('app_timezone')) {
    function app_timezone()
    {
        return config('app.timezone');
    }
}
//
//if (!function_exists('api_asset')) {
//    function api_asset($id)
//    {
//        if (($asset = \App\Upload::find($id)) != null) {
//            return $asset->file_name;
//        }
//        return "";
//    }
//}
//
////return file uploaded via uploader
//if (!function_exists('uploaded_asset')) {
//    function uploaded_asset($id)
//    {
//        if (($asset = \App\Upload::find($id)) != null) {
//            return my_asset($asset->file_name);
//        }
//        return null;
//    }
//}

if (!function_exists('my_asset')) {
    /**
     * Generate an asset path for the application.
     *
     * @param string $path
     * @param bool|null $secure
     * @return string
     */
    function my_asset($path, $secure = null)
    {
        return app('url')->asset('public/' . $path, $secure);
    }
}

if (!function_exists('static_asset')) {
    /**
     * Generate an asset path for the application.
     *
     * @param string $path
     * @param bool|null $secure
     * @return string
     */
    function static_asset($path, $secure = null)
    {
        return app('url')->asset('public/' . $path, $secure);
    }
}


if (!function_exists('upload_asset')) {
    /**
     * Generate an asset path for the application.
     *
     * @param string $path
     * @param bool|null $secure
     * @return string
     */
    function upload_asset($path, $secure = null)
    {
        return app('url')->asset('public/uploads/'.$path, $secure);
    }
}

// if (!function_exists('isHttps')) {
//     function isHttps()
//     {
//         return !empty($_SERVER['HTTPS']) && ('on' == $_SERVER['HTTPS']);
//     }
// }

if (!function_exists('getBaseURL')) {
    function getBaseURL()
    {
        $root = '//' . $_SERVER['HTTP_HOST'];
        $root .= str_replace(basename($_SERVER['SCRIPT_NAME']), '', $_SERVER['SCRIPT_NAME']);

        return $root;
    }
}


if (!function_exists('getFileBaseURL')) {
    function getFileBaseURL()
    {
        return getBaseURL() . 'public/';
    }
}


if (!function_exists('isUnique')) {
    /**
     * Generate an asset path for the application.
     *
     * @param string $path
     * @param bool|null $secure
     * @return string
     */
    function isUnique($email)
    {
        $user = \App\User::where('email', $email)->first();

        if ($user == null) {
            return '1'; // $user = null means we did not get any match with the email provided by the user inside the database
        } else {
            return '0';
        }
    }
}

if (!function_exists('isCompany')) {
    function isCompany()
    {
        if (Auth::check() && (Auth::user()->user_type == config("constants.user_type.company")) ) {
            return true;
        }
        return false;
    }
}
if (!function_exists('getAuthAvatar')) {
    function getAuthAvatar()
    {
        if (Auth::check() && (Auth::user()->avatar != '') ) {
            return upload_asset(Auth::user()->avatar);
        }
        return static_asset('assets/img/account.png');
    }
}
if (!function_exists('getAuthName')) {
    function getAuthName()
    {
        if (Auth::check() && (Auth::user()->name != '') ) {
            return Auth::user()->name;
        }
        return '';
    }
}
if (!function_exists('isAgent')) {
    function isAgent()
    {
        if (Auth::check() && (Auth::user()->user_type == config("constants.user_type.agent")) ) {
            return true;
        }
        return false;
    }
}

if (!function_exists('isEngineer')) {
    function isEngineer()
    {
        if (Auth::check() && (Auth::user()->user_type == config("constants.user_type.engineer")) ) {
            return true;
        }
        return false;
    }
}

if (!function_exists('isAdmin')) {
    function isAdmin()
    {
        if (Auth::check() && (Auth::user()->user_type == config("constants.user_type.admin")) ) {
            return true;
        }
        return false;
    }
}


if (!function_exists('getChatLink')) {
    function getChatLink($project)
    {
        if (!Auth::check()) {
            session(['link' => url()->current()]);
            return route('login');
        }
        $user = Auth::user();
        if ($user->user_type == config("constants.user_type.agent") || $user->user_type == config("constants.user_type.company")) {
            return route('chat.link', ['id' => $project->id]);
        }
        if ($user->user_type == config("constants.user_type.engineer")) {
            return route('chat.link', ['id' => $project->id]);
        }
        return 'javascript: void(0);';
    }
}


if (!function_exists('formatBytes')) {
    function formatBytes($bytes, $precision = 2)
    {
        $units = array('B', 'KB', 'MB', 'GB', 'TB');

        $bytes = max($bytes, 0);
        $pow = floor(($bytes ? log($bytes) : 0) / log(1024));
        $pow = min($pow, count($units) - 1);

        // Uncomment one of the following alternatives
        $bytes /= pow(1024, $pow);
        // $bytes /= (1 << (10 * $pow));

        return round($bytes, $precision) . ' ' . $units[$pow];
    }
}

// duplicates m$ excel's ceiling function
if (!function_exists('ceiling')) {
    function ceiling($number, $significance = 1)
    {
        return (is_numeric($number) && is_numeric($significance)) ? (ceil($number / $significance) * $significance) : false;
    }
}

if (!function_exists('convert_url')) {
    function convert_url($str) {
        if($str) {
            $scheme = parse_url($str, PHP_URL_SCHEME);
            if (empty($scheme)) {
                $str = 'http://' . ltrim($str, '/');
            }
            return $str;
        }
        else return '#';
    }
}

if (!function_exists('number_comma')) {
    function number_comma($num) {
        return number_format($num, 0, '', ',');
    }
}

//if (!function_exists('get_images')) {
//    function get_images($given_ids, $with_trashed = false)
//    {
//        if (is_array($given_ids)) {
//            $ids = $given_ids;
//        } elseif ($given_ids == null) {
//            $ids = [];
//        } else {
//            $ids = explode(",", $given_ids);
//        }
//
//
//        return $with_trashed
//            ? Upload::withTrashed()->whereIn('id', $ids)->get()
//            : Upload::whereIn('id', $ids)->get();
//    }
//}
//
////for api
//if (!function_exists('get_images_path')) {
//    function get_images_path($given_ids, $with_trashed = false)
//    {
//        $paths = [];
//        $images = get_images($given_ids, $with_trashed);
//        if (!$images->isEmpty()) {
//            foreach ($images as $image) {
//                $paths[] = !is_null($image) ? $image->file_name : "";
//            }
//        }
//
//        return $paths;
//    }
//}

