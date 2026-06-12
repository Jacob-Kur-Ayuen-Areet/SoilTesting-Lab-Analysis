<?php
// namespace app\Helpers\Helper;
use App\Models\SoilSample;

if (!function_exists('generate_lab_number')) {
    function generate_lab_number()
    {
        // Get the last generated lab number from the database, e.g., 'AA00001'
        $lastLabNumber = SoilSample::max('laboratory_number');

        if (!$lastLabNumber) {
            // If no lab numbers are generated yet, start with 'AA00001'
            $nextLabNumber = 'AA00001';
        } else {
            // Extract the numeric part and increment it with leading zeros
            $numericPart = substr($lastLabNumber, 2);
            $nextNumericPart = str_pad((int) $numericPart + 1, strlen($numericPart), '0', STR_PAD_LEFT);

            // Determine the next prefix letters based on the current numeric part
            $prefix = substr($lastLabNumber, 0, 2);
            if ($nextNumericPart === '100000') {
                // If the numeric part reaches '1000000', increment the prefix letters
                $nextPrefix = getNextPrefix($prefix);
                $nextNumericPart = '00001';
            } else {
                $nextPrefix = $prefix;
            }

            // Combine the next prefix and numeric part to form the new lab number
            $nextLabNumber = $nextPrefix . $nextNumericPart;
        }

        // Save the generated lab number in the database for future use
        // DB::table('lab_numbers')->insert([
        //     'lab_number' => $nextLabNumber,
        //     'created_at' => now(),
        //     'updated_at' => now(),
        // ]); 
        // dd($nextLabNumber);

        return $nextLabNumber;
    }
}

if (!function_exists('getNextPrefix')) {
    function getNextPrefix($prefix)
    {
        // Function to increment the prefix letters
        $length = strlen($prefix);
        $lastChar = substr($prefix, -1);
        $restOfPrefix = substr($prefix, 0, $length - 1);

        if ($lastChar === 'Z') {
            // If the last character is 'Z', increment the rest of the prefix recursively
            $restOfPrefix = getNextPrefix($restOfPrefix);
            $nextChar = 'A';
        } else {
            // Increment the last character normally
            $nextChar = chr(ord($lastChar) + 1);
        }

        return $restOfPrefix . $nextChar;
    }
}



if (!function_exists('getUploadPath')) {
    function getUploadPath($user_type)
    {
        return 'uploads/' . $user_type ;
    }
}

if (!function_exists('getFileMetaData')) {
    function getFileMetaData($file)
    {
        //$dataFile['name'] = $file->getClientOriginalName();
        $dataFile['ext'] = $file->getClientOriginalExtension();
        $dataFile['type'] = $file->getClientMimeType();
        $dataFile['size'] = formatBytes($file->getSize());
        return $dataFile;
    }

    if (!function_exists('formatBytes')) {
        function formatBytes($size, $precision = 2)
        {
            $base = log($size, 1024);
            $suffixes = array('B', 'KB', 'MB', 'GB', 'TB');

            return round(pow(1024, $base - floor($base)), $precision) . ' ' . $suffixes[floor($base)];
        }
    }
}
