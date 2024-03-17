<?php
if (isset($_GET['search']) && !empty($_GET['search'])) {
    $search = $_GET['search'];
}
if (isset($_GET['url']) && !empty($_GET['url'])) {
    $url = $_GET['url'];
}

if (isset($search)) {
    $apiKey = 'AIzaSyDiRsNprgHFlM8QgCWLohNvd3Qq7zDSoqk';
    $cx = 'c570d6382c8b544be';
    $search_url = str_replace(' ', '+', $search);
    $url = "https://www.googleapis.com/customsearch/v1?key={$apiKey}&cx={$cx}&q={$search_url}";

    echo "URL запиту: $url <br>";

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($ch);
    curl_close($ch);

    $items = json_decode($response, true);
} elseif (isset($url)) {
    echo "<div style=\"background-color:#f9f9f9;border:1px solid #ccc;padding:15px;margin-bottom:20px;\">";
    echo "<span style=\"font-size:14px;color:#1a0dab;\">Переданий URL:</span> <a href=\"$url\" style=\"text-decoration:none;color:#1a0dab;\">$url</a>";
    echo "</div>";

    echo "<script>window.location.href = \"$url\";</script>";
} else {
    echo "Змінна search не була передана в запиті.";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Мій Браузер</title>
</head>
<body>
<h2>Мій Браузер</h2>
<form method="GET" action="/index.php">
    <label for="url">URL:</label>
    <input type="url" id="url" name="url" value="">
    <label for="search">Пошук:</label>
    <input type="text" id="search" name="search" value=""><br><br>
    <input type="submit" value="Відправити">
</form>
<?php
if (isset($search) && isset($items["items"])) {
    ?> <h2> Результати пошуку </h2> <?php
    foreach ($items["items"] as $item) {
        ?>
        <div class="item">
            <p class="link"><?php echo $item["displayLink"] ?></p>
            <p class="title">
                <a target="_blank" href="<?php echo $item["link"] ?>">
                    <?php echo $item["title"] ?>
                </a>
            </p>
            <p class="desc"><?php echo $item["snippet"] ?></p> <br> <br>
        </div>
        <?php
    }
}
?>
</body>
</html>
