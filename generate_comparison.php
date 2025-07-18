<?php
header('Content-Type: application/json');

$env = parse_ini_file('.env');
$openai_api_key = $env['OPENAI_API_KEY'];
$openai_baseurl = $env['OPENAI_BASEURL'];

$input = json_decode(file_get_contents('php://input'), true);

if (!$input || !isset($input['product1']) || !isset($input['product2'])) {
    echo json_encode(['success' => false, 'error' => 'Invalid input data']);
    exit;
}

$product1 = $input['product1'];
$product2 = $input['product2'];

$prompt = "Please provide a detailed comparison between these two products:

Product 1: {$product1['title']}
Description: {$product1['description']}
Price: {$product1['price']}

Product 2: {$product2['title']}
Description: {$product2['description']}
Price: {$product2['price']}

Please provide a comprehensive comparison including:
1. Key features and benefits
2. Price comparison and value analysis
3. Target audience for each product
4. Pros and cons of each product
5. Recommendation based on different use cases

Format the response in HTML with proper styling using Bootstrap classes.";

$data = [
    'model' => 'gpt-3.5-turbo',
    'messages' => [
        [
            'role' => 'user',
            'content' => $prompt
        ]
    ],
    'max_tokens' => 1000,
    'temperature' => 0.7
];

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $openai_baseurl);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    'Content-Type: application/json',
    'Authorization: Bearer ' . $openai_api_key
]);

$response = curl_exec($ch);
$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);

if ($httpCode === 200) {
    $result = json_decode($response, true);
    if (isset($result['choices'][0]['message']['content'])) {
        $comparison = $result['choices'][0]['message']['content'];
        echo json_encode(['success' => true, 'comparison' => $comparison]);
    } else {
        echo json_encode(['success' => false, 'error' => 'Invalid response from OpenAI']);
    }
} else {
    $error = json_decode($response, true);
    $errorMessage = isset($error['error']['message']) ? $error['error']['message'] : 'Unknown error occurred';
    echo json_encode(['success' => false, 'error' => $errorMessage]);
}
?> 