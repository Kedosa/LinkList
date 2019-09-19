<?php
$html = <<<EOF
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Link Sammlung</title>
    <link rel="stylesheet" href="$bootstrap4">
    <link rel="stylesheet" href="$css">
    <link rel="stylesheet" href="$fontAwsome">
    <script src="$jquery"></script>
    <script src="$proper"></script>
    <script src="$bootstrapJS"></script>
    <script src="$filterScript"></script>
</head>
    <body class="bg-light">
        $nav                     
                <div class='search'>
                    <form method="post" name='userOutput' class='userForm'>
                        <button type='submit' value='user' name='user' class='userBtn'><span class="fa fa-user-circle"></span></button>
                    </form>
                    <form name='searchInArray' class='form-inline navbar-brand' action='index.php' method='GET'>
                        <input class='form-control mr-sm-2' id='filterInput' onkeyup='filterString()' type='text' name='searchValue' placeholder='search' value="$searched"> 
                        <input type='reset' value='x' class='reset'/>
                        <button class='searchBtn' type='submit'><span class="fa fa-search"></span>
                        </button>
                    </form>
                </div>
            </div>
        </nav>
        <h4 id='searchedCategory'></h4>
        <div class="content">
        $content
        </div>
    </body>
</html>
EOF;
echo $html;
