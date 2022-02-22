<?php


namespace App\Services;

/**
 * Class ReadCsvFile
 * @package App\Services
 */
final class ReadCsvFile
{
    /**
     * @param string $filePath
     * @return array
     */
    public function readCsvFile(string $filePath): array
    {
        $lines = [];

        $file = fopen($filePath, 'r');

        // Enlever l'entête / la premiere ligne
        // $header = fgetcsv($file, 1024);

        while (!feof($file)) {
            $line = fgetcsv($file, 1024);
            if ($line) {
                $lines[] =  $line;
            }
        }

        fclose($file);

        return $lines;
    }
}
