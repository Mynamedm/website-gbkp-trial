<?php

require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);

$html = $kernel->handle(Illuminate\Http\Request::create('/struktur-organisasi', 'GET'))->getContent();

// Extract org-tree section
preg_match('#<div class="org-tree">(.*?)</div>\s*<p class="text-slate-400#s', $html, $m);
if ($m) {
    $tree = $m[1];
    echo 'li: ' . substr_count($tree, '<li>') . PHP_EOL;
    echo 'org-card: ' . substr_count($tree, 'org-card') . PHP_EOL;
    echo 'avatar: ' . substr_count($tree, 'rounded-full object-cover') . PHP_EOL;
    echo 'ul: ' . substr_count($tree, '<ul>') . PHP_EOL;
    
    // List cards
    preg_match_all('#class="org-card[^>]*>.*?text-slate-800[^>]*>([^<]+)</p>#s', $tree, $mm);
    foreach ($mm[1] as $i => $name) {
        echo "  $i: " . trim($name) . PHP_EOL;
    }
} else {
    echo 'Tree not found' . PHP_EOL;
}