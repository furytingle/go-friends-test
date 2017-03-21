<?php
/**
 * Created by PhpStorm.
 * User: azhylinskiy-developer
 * Date: 21.03.17
 * Time: 15:50
 */

namespace App\Helpers;

use GuzzleHttp\Client;

class FacebookHelper
{
    const BASE_URL = 'https://graph.facebook.com/';

    const VERSION = 'v2.8';

    public function getPosts($userId, $token) {
        $client = new Client([
            'base_uri' => self::BASE_URL . self::VERSION
        ]);

        $response = $client->get("/$userId/posts", [
            'query' => ['access_token' => $token]
        ]);

        $posts = json_decode((string) $response->getBody(), true)['data'];
        foreach ($posts as &$post) {
            //Likes
            $res = $client->get('/' . $post['id'] . '/likes', [
                'query' => ['access_token' => $token]
            ]);
            $attributes = json_decode((string) $res->getBody(), true)['data'];
            $post['attributes'] = $attributes;
        }

        return $posts;
    }
}