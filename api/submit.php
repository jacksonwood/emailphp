<?php
$ch = curl_init();


$token = getenv('API_TOKEN');

curl_setopt($ch, CURLOPT_URL, "https://dust.tt/api/v1/apps/jacksonwood/593f566768/runs");
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    "Authorization: Bearer $token",
    "Content-Type: application/json"
));
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode(array(
    "specification_hash" => "7f6d60dd479ca99fe25b348d6c5c823819343c72731e852f12de95b47afd2bba",
    "config" => array(
        "MODEL" => array(
            "provider_id" => "openai",
            "model_id" => "gpt-3.5-turbo",
            "use_cache" => true
        ),
        "WEBCONTENT" => array(
            "provider_id" => "browserlessapi",
            "use_cache" => true,
            "error_as_output" => false
        )
    ),
    "blocking" => true,
    "inputs" => array(
        array(
            "company_name" => $_POST['company_name'],
            "url" => $_POST['url'],
            "your_name" => $_POST['your_name']
        )
    )
)));

curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$result = curl_exec($ch);

if (curl_errno($ch)) {
    echo 'Error:' . curl_error($ch);
} else {
    echo $result;
}

curl_close($ch);