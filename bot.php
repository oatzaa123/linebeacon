<?php


$API_URL = 'https://api.line.me/v2/bot/message/reply';
$ACCESS_TOKEN = 'i8oNKSGQ98tPYr4RL8U/+LXMOu94bsBO2+ruq0tTv23Ky4bOL66mDXMofwGkeVS1AEOl91L+fYI70vuyHxW8hjXydZ8/jZJlTBys6CKO/AHT4t7IPlo+qajlquhqo4UphIKj6xq9NJkanK8ybRqLAVGUYhWQfeY8sLGRXgo3xvw='; 
$channelSecret = 'abf7fe0cd7d8df04ea2dd772ea60e48c';


$POST_HEADER = array('Content-Type: application/json', 'Authorization: Bearer ' . $ACCESS_TOKEN);

$request = file_get_contents('php://input');   // Get request content
$request_array = json_decode($request, true);   // Decode JSON to Array
var_export($request_array);


if ( sizeof($request_array['events']) > 0 ) {

    foreach ($request_array['events'] as $event) {

        $reply_message = '';
        $reply_token = $event['replyToken'];

        $text = 'test';
        $data = [
            'replyToken' => $reply_token,
            'messages' => [['type' => 'text', 'text' => json_encode($request_array) ]]  Debug Detail message
            //'messages' => [['type' => 'text', 'text' => $text ]]
        ];
        $post_body = json_encode($data, JSON_UNESCAPED_UNICODE);

        $send_result = send_reply_message($API_URL.'/reply', $POST_HEADER, $post_body);

        echo "Result: ".$send_result."\r\n";
    }
}

echo "OK";




function send_reply_message($url, $post_header, $post_body)
{
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $post_header);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $post_body);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
    $result = curl_exec($ch);
    curl_close($ch);

    return $result;
}

?>
