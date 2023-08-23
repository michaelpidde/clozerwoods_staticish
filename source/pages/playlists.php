<?php

$title = '- Playlists';

function generate_playlists(string $source_file): string {
    $content = "<div id=\"playlists\">\n";
    $playlists = json_decode(file_get_contents($source_file), true);
    foreach($playlists as $playlist => $categories) {
        $content .= "<section class=\"playlist\">\n";
        $content .= "<h1>{$playlist}</h1>\n";

        foreach($categories as $category => $song) {
            $content .= "<h2>{$category}</h2>\n";
            $content .= "<ul>\n";

            foreach($song as $song) {
                $year = '';
                if($song['year']) {
                    $year = "({$song['year']})";
                }
                $content .= "<li>{$year} {$song['artist']} <a href=\"{$song['url']}\">{$song['song']}</a></li>\n";
            }

            $content .= "</ul>\n";
        }

        $content .= "</section>\n";
    }
    $content .= "</div>\n";

    return $content;
}

ob_start();
require 'source/template/header.php';
echo generate_playlists('source/pages/playlists.json');
require 'source/template/footer.php';
ob_end_flush();
