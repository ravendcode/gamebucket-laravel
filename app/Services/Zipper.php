<?php

namespace App\Services;

use App\Game;
use Illuminate\Support\Facades\DB;

class Zipper
{
    public function unzipGame(array $data, string $nameIndexFile = 'index.unity.html'): Game
    {
        $path = 'games/' . bin2hex(random_bytes(5) . time());
        $fullPath = config('filesystems.disks.public.root') . '/' . $path;

        // DB::beginTransaction();

        $zip = new \ZipArchive;
        $res = $zip->open($data['file']);

        if ($res === TRUE) {
            for ($i = 0; $i < $zip->numFiles; $i++) {
                $filename = $zip->getNameIndex($i);
                $filenames = explode('/', $filename);
                if (count($filenames) === 3) {
                    $path .= '/' . $filenames[0];
                    break;
                }
            }
            $zip->extractTo($fullPath);
            $zip->close();
            $game = Game::create([
                'title' => $data['title'],
                'filename' => $data['file']->getClientOriginalName(),
                'path' => $path,
            ]);
            // DB::commit();
        } else {
            // DB::rollBack();
            abort(500);
        }

        $this->extractBodyFromGame($path, $nameIndexFile);

        return $game;
    }

    private function extractBodyFromGame(string $path, string $nameIndexFile): void
    {
        $xml = new \DomDocument();
        $fullPath = config('filesystems.disks.public.root') . '/' . $path;
        $indexFile = $fullPath . '/' . 'index.html';
        $xml->loadHTMLFile($indexFile);

        $body = $xml->getElementsByTagName('div');
        if ($body and $body->length > 0) {
            $body = $body->item(0);
            $html = $xml->saveHTML($body);
            // $html = str_replace('<body>', '', $html);
            // $html = str_replace('</body>', '', $html);
            // rename($indexFile, $fullPath . '/index.original.html');
            $pathIndexFile = $fullPath . '/' . $nameIndexFile;
            $newFile = fopen($pathIndexFile, "w") or abort(500);
            fwrite($newFile, $html . PHP_EOL);
            fclose($newFile);
        }
    }
}
