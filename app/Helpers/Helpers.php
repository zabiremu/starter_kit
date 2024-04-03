<?php

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

/**
 * Returns current timestamp in format = 'Y-m-d-H-m-s-u'
 * @return string
 */
function timestamp()
{
    return Carbon::now()->format('Y-m-d-H-m-s-u');
}

/**
 * Stores an image given an image request and a directory
 * @param UploadedFile $image
 * @param string $old_path
 * @param string $dir
 * @param string $prefix skip if you need clientOriginalName
 * @param string $disk default = public
 * @return string $new_path
 */
function saveImage($image, string $dir, ?string $prefix = '',string $oldImage=null ,string $disk = 'public')
{
    if ($image) {
        if ($prefix === '' || $prefix === null) {
            $prefix = str($image->getClientOriginalName())->slug();
        }
        $ext = $image->extension();
        $name = $prefix . "-" . timestamp() . '.' . $ext;
        $path = $image->move("uploads/$dir", $name, $disk);
        return $path;
    } else {
        return $oldImage;
    }
}

function deleteImage($image, $file)
{
    if(isset($file))
    {
        if(isset($image))
        {
            unlink($image);
        }else{
            return false;
        }
    }else{
        return true;
    }
   
}
/**
 * Generate a perfect invoice number.
 *
 * @return string
 */

function generateInvoiceNumber()
{
    // Prefix for the invoice number
    $prefix = 'INV';

    // Get the current date in Ymd format
    $date = Carbon::now()->format('Ymd');

    // Generate a unique random number to ensure uniqueness
    $random = rand(1,5);

    // Combine prefix, date, and random number to create the invoice number
    $invoiceNumber = $prefix . '-' . $date . '-' . $random;

    return $invoiceNumber;
}
