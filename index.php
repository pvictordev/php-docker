<?php
require 'vendor/autoload.php';

use GuzzleHttp\Client;

try {
    // Create a new Guzzle client
    $client = new Client();

    // Make a GET request to the JSONPlaceholder API
    $response = $client->request('GET', 'https://jsonplaceholder.typicode.com/posts');

    if ($response->getStatusCode() === 200) {
        $body = $response->getBody();

        $posts = json_decode($body, true);

        $posts = array_slice($posts, 0, 10);

        // Start generating the HTML content
        echo '<!DOCTYPE html>';
        echo '<html lang="en">';
        echo '<head>';
        echo '<meta charset="UTF-8">';
        echo '<meta name="viewport" content="width=device-width, initial-scale=1.0">';
        echo '<title>Posts Table</title>';
        echo '<link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">';
        echo '</head>';
        echo '<body class="bg-gray-100 p-6">';
        echo '<h1 class="text-2xl font-bold mb-4 text-center">Posts</h1>';
        echo '<div class="overflow-x-auto">';
        echo '<table class="table-auto border-collapse w-3/4 mx-auto bg-white shadow-md rounded">';
        echo '<thead>';
        echo '<tr>';
        echo '<th class="px-4 py-2 border bg-gray-200">ID</th>';
        echo '<th class="px-4 py-2 border bg-gray-200">Title</th>';
        echo '<th class="px-4 py-2 border bg-gray-200">Body</th>';
        echo '</tr>';
        echo '</thead>';
        echo '<tbody>';

        foreach ($posts as $post) {
            echo '<tr>';
            echo '<td class="border px-4 py-2">' . htmlspecialchars($post['id']) . '</td>';
            echo '<td class="border px-4 py-2">' . htmlspecialchars($post['title']) . '</td>';
            echo '<td class="border px-4 py-2">' . htmlspecialchars($post['body']) . '</td>';
            echo '</tr>';
        }

        echo '</tbody>';
        echo '</table>';
        echo '</div>';
        echo '</body>';
        echo '</html>';
    } else {
        echo "Failed to fetch posts. Status code: " . $response->getStatusCode();
    }
} catch (Exception $e) {
    echo "An error occurred: " . $e->getMessage();
}
