<?php
$html = <<<EOF
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <link rel="stylesheet" href="$bootstrap4">
    <link rel="stylesheet" href="$css">
  <script src="$jquery"></script>
<script src="$proper"></script>
  <script src="$bootstrapJS"></script>
</head>
    <body>
        <div class="jumbotron text-center" style="margin-bottom:0">
            <h1>Tabellen mit Links</h1>
        </div>

        $nav
        <br/>
        $table
            </tbody>
        </table>
    </body>
</html>
EOF;
echo $html;