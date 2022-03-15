<?php

declare(strict_types=1);

namespace WirelessLogic\PageConsuming;

class PageDownloader extends WebPageConsumer
{
    public function download(string $url): string
    {
        $handle = curl_init();
         
        curl_setopt_array($handle, [
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true
        ]);
         
        $output = curl_exec($handle);
         
        curl_close($handle);

        return $output;
    }
}
