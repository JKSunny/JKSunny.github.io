<?php

$repos = [
    "taysta/TaystJK",
    "MBII/OpenJK",
    "JediofFreedom/JoF_EJK",
    "JKSunny/jk2mv",
    "JKSunny/OpenJK",
    "JKSunny/EternalJK"
];

$results = [];

$headers = [
    "User-Agent: JA-Vulkan-Crawler"
];
if ($token = getenv("GITHUB_TOKEN")) {
    $headers[] = "Authorization: Bearer $token";
}

foreach ($repos as $repo) {

    $url = "https://api.github.com/repos/$repo";

    $ch = curl_init($url);

    curl_setopt_array($ch, [
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_HTTPHEADER => $headers
    ]);
	
	

    $response = curl_exec($ch);

    if ($response === false) {
        $results[$repo] = [
            "error" => curl_error($ch)
        ];

        curl_close($ch);
        continue;
    }

    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

    curl_close($ch);

    if ($httpCode !== 200) {
        $results[$repo] = [
            "error" => "GitHub API returned HTTP $httpCode"
        ];
        continue;
    }

    $data = json_decode($response, true);

    $results[$repo] = [
        "stars" => $data["stargazers_count"] ?? 0,
        "forks" => $data["forks_count"] ?? 0,
        "watchers" => $data["subscribers_count"] ?? 0,
        "open_issues" => $data["open_issues_count"] ?? 0,
        "last_push" => $data["pushed_at"] ?? null,
        "default_branch" => $data["default_branch"] ?? null,
        "html_url" => $data["html_url"] ?? null
    ];
}

// header('Content-Type: application/json');
// echo json_encode($results, JSON_PRETTY_PRINT);

file_put_contents(
    __DIR__ . '/metrics.json',
    json_encode($results, JSON_PRETTY_PRINT)
);

echo "Metrics updated.\n";