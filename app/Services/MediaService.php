<?php
/**
 * Created by Tanay Kumar Roy<tanayroy12@gmail.com>.
 * User: Tanay
 * Date: 8/3/2020
 * Time: 3:09 PM
 */

namespace App\Services;

use File;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class MediaService
{
    /**
     * Creates a new file name
     * @param UploadedFile $file
     * @return string
     */
    public static function filename(UploadedFile $file)
    {
        return date('Y') . '_' . date('m') . '_' . time() . '-' . sprintf('%04d', rand(1, 9999)) . '.'
            . $file->getClientOriginalExtension();
    }

    /**
     * Moves the uploaded file to preferred directory and
     * @param $type
     * @param UploadedFile $file
     * @return string
     */
    public static function upload($type, UploadedFile $file)
    {
        $filename = self::filename($file);
        $path = 'uploads/' . $type . '/' . file_path($filename);


        $dir = dirname($path);
        if (!file_exists($dir)) {
            mkdir($dir, 0777, true);
        }

        $file->move($dir, $path);
        return $filename;
    }

    /**
     *
     * @param $type
     * @param $filename
     * @return bool
     */
    public static function delete($type, $filename)
    {
        $path = 'uploads/' . $type . '/' . file_path($filename);

        if (File::exists($path)) {
            $filename = File::delete($path);
            return $filename;
        }

        return false;
    }
}
