<!DOCTYPE html>
<html lang="en">
<head>
    <link crossorigin="anonymous" href="https://use.fontawesome.com/releases/v5.6.1/css/all.css"
          integrity="sha384-gfdkjb5BdAXd+lj+gudLWI+BXq4IuLW5IT+brZEZsLFm++aCMlF1V92rMkPaX4PP" rel="stylesheet">
    <link crossorigin="anonymous"
          href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.3/css/bootstrap.min.css"
          integrity="sha512-oc9+XSs1H243/FRN9Rw62Fn8EtxjEYWHXRvjS43YtueEewbS6ObfXcJNyohjHqVKFPoXXUxwc+q1K7Dee6vv9g=="
          rel="stylesheet">
    <link crossorigin="anonymous" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css"
          integrity="sha512-+4zCK9k+qNFUR5X+cKL9EIR+ZOhtIloNl9GIKS57V1MyNsYpYcUrUeQc9vNfzsWfV28IaLL3i96P9sdNyeRssA=="
          rel="stylesheet">
    <meta content="width=device-width, initial-scale=1, shrink-to-fit=no" name="viewport">
    <title>Lightning Network Node Recovery - Ancient channel list</title></head>
    <style type="text/css">
        body {
            font-size: 110%;
        }
    </style>
<body>
<nav class="border-bottom navbar navbar-expand-lg shadow-sm top-nav">
    <a class="navbar-brand" href="index.html"><span>Lightning Network Node Recovery - Ancient channel list</span></a>
</nav>
<div class="container mb-4" style="min-height: 600px; padding-bottom: 100px;">
    <div class="row mt-4">
        <div class="col-12">
            <h1 class="mt-1">Lightning Network Node Recovery - Ancient channel list</h1>
            <p class="text-muted">List of nodes that have unspent outputs in ancient channels with LNBIG and ln2me.</p>
            <p class="mt-1">
                If your node ID or alias appears in the list below, you might be able to sweep some satoshis from very old
                channels your node had with LNBIG or ln2me. <br/>
                If you still have the seed for that node, all you have to do is <a href="https://github.com/lightninglabs/chantools/releases">
                    download the latest release of <code>chantools</code>
                </a> and run the following command:<br/>
                <pre>chantools sweepremoteclosed --feerate 10 --sweepaddr &lt;your_address_to_send_rescued_funds_to&gt;</pre>
            </p>
            <br/><br/>
            <?php
                if (!file_exists("nodes.csv") || !is_readable("nodes.csv")) {
                    die("File not found or not readable.");
                }
            
                echo "<table class=\"table table-sm\">";
                echo "<tr><th scope=\"col\">Node ID</th><th scope=\"col\">Alias</th><th scope=\"col\">Amboss</th><th scope=\"col\">1ml.com</th></tr>";
            
                $file = fopen("nodes.csv", "r");
                while (($data = fgetcsv($file, 1000, ",")) !== false) {
                    if (count($data) == 2) {
                        echo "<tr><td><small><code>" . htmlspecialchars($data[0]) . "</code></small></td><td>" . htmlspecialchars($data[1]) . "</td>";
                        echo "<td><a href=\"https://amboss.space/node/" . htmlspecialchars($data[0]) . "\" target=\"_blank\"><i class=\"fas fa-external-link-alt\"></i> Amboss</a></td>";
                        echo "<td><a href=\"https://1ml.com/node/" . htmlspecialchars($data[0]) . "\" target=\"_blank\"><i class=\"fas fa-external-link-alt\"></i> 1ml</a></td>";
                        echo "</tr>";
                    }
                }
                fclose($file);
            
                echo "</table>";
            ?>
        </div>
    </div>
</div>
<script crossorigin="anonymous"
        integrity="sha512-bLT0Qm9VnAYZDflyKcBaQ2gg0hSYNQrJ8RilYldYQ1FxQYoCLtUjuuRuZo+fjqhx/qtq/1itJ0C2ejDxltZVFg=="
        src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script crossorigin="anonymous" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49"
        src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.3/js/bootstrap.min.js"
        integrity="sha512-8qmis31OQi6hIRgvkht0s6mCOittjMa9GMqtK9hes5iEQBQE/Ca6yGE5FsW36vyipGoWQswBj/QBm2JR086Rkw=="
        crossorigin="anonymous"></script>
</body>
</html>
