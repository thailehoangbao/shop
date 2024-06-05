<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Storage;

class Helpers
{
    public static function active($active = 0): string
    {
        return $active == 0 ? '<span class="btn btn-danger btn-xs">NO</span>'
            : '<span class="btn btn-success btn-xs">YES</span>';
    }

    public static function totalPrice($lists)
    {
        $sum = 0;
        foreach ($lists as $list) {
            $sum += ($list->product->price) * ($list->amount);
        }

        return $sum;
    }

    public static function handleFile($request, $thumbName)
    {

        if ($request->hasFile($thumbName)) {
            // Store the new file
            $file = $request->file($thumbName);
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('uploads', $fileName, 'public');
            return $fileName;
        } else {
            return $request->$thumbName;
        }
    }

    public static function handleUpdateFile($request, $filename, $nameThumb)
    {

        $oldFilePath = 'uploads/' . $filename;

        // Delete the old file if it exists
        if (Storage::disk('public')->exists($oldFilePath)) {
            Storage::disk('public')->delete($oldFilePath);
        }

        if ($request->hasFile($nameThumb)) {
            // Store the new file
            $file = $request->file($nameThumb);
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('uploads', $fileName, 'public');
            return $fileName;
        } else {
            return $filename;
        }
    }

    public static function shorten($text, $maxWords=6)
    {
        $words = explode(' ', $text);
        if (count($words) > $maxWords) {
            return implode(' ', array_slice($words, 0, $maxWords)) . '...';
        }
        return $text;
    }

    public static function shortenHasValue($text, $maxWords)
    {
        $words = explode(' ', $text);
        if (count($words) > $maxWords) {
            return implode(' ', array_slice($words, 0, $maxWords)) . '...';
        }
        return $text;
    }

    public static function deleteFile($filename)
    {
        if($filename == null) return false;

        $oldFilePath = 'uploads/' . $filename;

        // Delete the old file if it exists
        if (Storage::disk('public')->exists($oldFilePath)) {
            Storage::disk('public')->delete($oldFilePath);
        }
    }
}

// Vào composer.json thêm dòng sau: "files": ["app/Helpers/Helpers.php"]
//composer dump-autoload
