<?php
$places = [
    "Grand Canal (Venice)",
    "Amalfi Coast",
    "Piazza del Duomo, Florence",
    "Eiffel Tower",
    "Swiss Alps",
    "Acropolis of Athens",
    "Colosseum",
    "Sistine Chapel",
    "Trevi Fountain"
];

$results = [];
foreach ($places as $place) {
    $url = "https://en.wikipedia.org/w/api.php?action=query&titles=" . urlencode($place) . "&prop=pageimages&format=json&pithumbsize=800";
    
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0');
    $output = curl_exec($ch);
    curl_close($ch);
    
    $data = json_decode($output, true);
    if (isset($data['query']['pages'])) {
        $pages = $data['query']['pages'];
        $first_page = reset($pages);
        if (isset($first_page['thumbnail']['source'])) {
            $results[$place] = $first_page['thumbnail']['source'];
        } else {
            $results[$place] = "NO IMAGE";
        }
    }
}

file_put_contents('urls_pkg.json', json_encode($results, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES));
echo "Done\n";
