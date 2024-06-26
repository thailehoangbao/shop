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
            $sum += ($list->total_price) * ($list->amount);
        }

        return $sum;
    }

    public static function totalPrice2($lists)
    {
        $sum = 0;
        foreach ($lists as $list) {
            $sum += ($list['total_price']) * ($list['amount']);
        }

        return $sum;
    }

    public static function formatDate($date) {
        return \Carbon\Carbon::parse($date)->format('d:m:Y s:i:H');
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

    public static function shorten($text, $maxWords = 6)
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
        if ($filename == null) return false;

        $oldFilePath = 'uploads/' . $filename;

        // Delete the old file if it exists
        if (Storage::disk('public')->exists($oldFilePath)) {
            Storage::disk('public')->delete($oldFilePath);
        }
    }

    public static function sumComments($comments,$post)
    {
        $sum = 0;
        foreach ($comments as $comment) {
            if ($comment->post_id == $post->id) {
                $sum++;
            }
        }
        return $sum;
    }

    public static function statusPayment ($status): string
    {
        if($status == 0) {
            return '<span class="btn btn-danger btn-xs">Chưa xác nhận đơn</span>';
        } else if($status == 1){
            return '<span class="btn btn-primary btn-xs">Đã xác nhận đơn</span>';
        } else if ($status == 2) {
            return '<span class="btn btn-warning btn-xs">Đang giao hàng</span>';
        } else {
            return '<span class="btn btn-success btn-xs">Đã giao hàng</span>';
        }
    }

    public static function convertImageToBase64($imagePath) {
        $imageData = file_get_contents($imagePath);
        return 'data:image/' . pathinfo($imagePath, PATHINFO_EXTENSION) . ';base64,' . base64_encode($imageData);
    }
}

// Vào composer.json thêm dòng sau: "files": ["app/Helpers/Helpers.php"]
//composer dump-autoload
